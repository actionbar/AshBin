<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../data/dbcache/class.php");
require("../../class/user.php");
require("../../data/dbcache/MemberLevel.php");
require("../../data/language/".$ecmslang."/pub/fun.php");

$link=db_connect();
$empire=new mysqlquery();
$enews=$_POST['enews'];
if($enews=="AjaxPl")//Ajax增加评论
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$saytext=$_POST['saytext'];
	$id=$_POST['id'];
	$classid=$_POST['classid'];
	$repid=$_POST['repid'];
	$nomember=$_POST['nomember'];
	$key=$_POST['key'];
	AddPl($username,$password,$nomember,$key,$saytext,$id,$classid,$repid,$_POST);
}
//ajax检查验证码
function ecmsCheckShowKeyAjax($varname,$postval,$dopr,$ecms=0){
	global $public_r;
	$r=explode(',',getcvar($varname,$ecms));
	$cktime=$r[0];
	$pass=$r[1];
	$val=$r[2];
	$time=time();
	if($cktime>$time||$time-$cktime>$public_r['keytime']*60)
	{
		echo 'OutKeytime';exit;
	}
	if(empty($postval)||$postval<>$val)
	{
		echo 'FailKey';exit;
	}
	$checkpass=md5(md5($postval.'EmpireCMS'.$cktime).$public_r['keyrnd']);
	if($checkpass<>$pass)
	{
		echo 'FailKey';exit;
	}
}
//发表评论
function AddPl($username,$password,$nomember,$key,$saytext,$id,$classid,$repid,$add){
	global $empire,$public_r,$class_r,$user_userid,$user_username,$user_password,$user_dopass,$user_tablename,$user_salt,$user_checked,$user_group,$dbtbpre,$level_r;
	
	$saytext = unescape($saytext);
	//验证IP
	eCheckAccessDoIp('pl');
	$id=(int)$id;
	$repid=(int)$repid;
	$classid=(int)$classid;
	//验证码
	$keyvname='checkplkey';
	if($public_r['plkey_ok'])
	{
		ecmsCheckShowKeyAjax($keyvname,$key,1);
	}
	$username=RepPostVar($username);
	$password=RepPostVar($password);
	$muserid=(int)getcvar('mluserid');
	$musername=RepPostVar(getcvar('mlusername'));
	$mgroupid=(int)getcvar('mlgroupid');
	if($muserid)//已登陆
	{
		$username=$musername;
	}
	else
	{
		if(empty($nomember))//非匿名
		{
			//编码转换
			$utfusername=doUtfAndGbk($username,0);
			$password=doUtfAndGbk($password,0);
			
			//密码
			if(empty($user_dopass))
			{
				$password=md5($password);
			}
			if($user_dopass==3)//16位md5
			{
				$password=substr(md5($password),8,16);
			}
			//双重md5
			if($user_dopass==2)
			{
				$ur=$empire->fetch1("select ".$user_userid.",".$user_salt.",".$user_password.",".$user_checked.",".$user_group." from ".$user_tablename." where ".$user_username."='$utfusername' limit 1");
				$password=md5(md5($password).$ur[$user_salt]);
				$cuser=0;
				if($password==$ur[$user_password])
				{
					$cuser=1;
				}
				if(empty($ur[$user_userid]))
				{
					$cuser=0;
				}
			}
			else
			{
				$ur=$empire->fetch1("select ".$user_userid.",".$user_checked.",".$user_group." from ".$user_tablename." where ".$user_username."='$utfusername' and ".$user_password."='$password' limit 1");
				$cuser=0;
				if($ur[$user_userid])
				{
					$cuser=1;
				}
			}
			if(empty($cuser))
			{
				echo 'FailPassword';exit;//用户名或密码错误
			}
			if($ur[$user_checked]==0)
			{
				echo 'NotCheckedUser';exit;//用户名或密码错误
			}
			$muserid=$ur[$user_userid];
			$mgroupid=$ur[$user_group];
		}
		else
		{
			$muserid=0;
		}
	}
	if($public_r['plgroupid'])
	{
		if(!$muserid)
		{
			echo 'GuestNotToPl';exit;
		}
		if($level_r[$mgroupid][level]<$level_r[$public_r['plgroupid']][level])
		{
			echo 'NotLevelToPl';exit;//
		}
	}
	if(!trim($saytext)||!$id||!$classid)
	{
		echo 'EmptyPl'; exit;//评论内容不全[请输入完整]
	}
	//表存在
	if(empty($class_r[$classid][tbname]))
	{
		echo 'ErrorUrl';exit;//评论内容不全[请输入完整]
	}
	if(strlen($saytext)>$public_r[plsize])
	{
		echo 'PlSizeTobig';exit;//评论内容太多,字数超过限制
	}
	$saytime=date("Y-m-d H:i:s");
	$time=time();
	$pltime=getcvar('lastpltime');
	if($pltime)
	{
		if($time-$pltime<$public_r[pltime])
		{echo 'PlOutTime';exit;}
	}
	//是否关闭评论
	$r=$empire->fetch1("select classid,closepl from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where id='$id' and classid='$classid'");
	if(empty($r[classid]))
	{echo 'ErrorUrl';exit;}
	if($class_r[$r[classid]][openpl])
	{echo 'CloseInfoPl';exit;}
	//单信息关闭评论
	if($r['closepl'])
	{
		echo 'CloseInfoPl';exit;
	}
	$sayip=egetip();
	$username=RepPostStr($username);
	$username=str_replace("\r\n","",$username);
	$saytext=nl2br(RepFieldtextNbsp(RepPostStr($saytext)));
	$pr=$empire->fetch1("select plclosewords,plf,plmustf,pldeftb from {$dbtbpre}enewspublic limit 1");
	if($repid)
	{
		if(trim($saytext)=="[quote]".$repid."[/quote]")
		{
			echo 'EmptyPl';exit;
		}
		$saytext=RepPlTextQuote($repid,$saytext,$pr);
	}
	//过滤字符
	$saytext=ReplacePlWord($pr['plclosewords'],$saytext);
	//审核
	if($class_r[$classid][checkpl])
	{$checked=1;}
	else
	{$checked=0;}
	$ret_r=ReturnPlAddF($add,$pr,0);
	//主表
	$sql=$empire->query("insert into {$dbtbpre}enewspl(username,sayip,saytime,id,classid,checked,zcnum,fdnum,userid,isgood,stb) values('".$username."','$sayip','$saytime','$id','$classid','$checked',0,0,'$muserid',0,'$pr[pldeftb]');");
	$plid=$empire->lastid();
	//副表
	$fsql=$empire->query("insert into {$dbtbpre}enewspl_data_".$pr['pldeftb']."(plid,classid,id,saytext".$ret_r['fields'].") values('$plid','$classid','$id','".addslashes($saytext)."'".$ret_r['values'].");");
	//信息表加1
	$usql=$empire->query("update {$dbtbpre}ecms_".$class_r[$classid][tbname]." set plnum=plnum+1 where id='$id'");
	$sql=$empire->query("update phome_enewsmember set userfen=userfen+2 where userid='$muserid'");
	//设置最后发表时间
	$set1=esetcookie("lastpltime",time(),time()+3600*24);
	ecmsEmptyShowKey($keyvname);//清空验证码

    //邮件通知
$remail=$empire->fetch1("select id,userid,title,ismember from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where id='$id' and classid='$classid'");
//if($remail[ismember]==1){
$content=' 亲爱的文友: 您好！

这封信是由情缘e家文章网自动发送的。当您收到这封邮件，是因为您在我们网站发表的文章有新的评论而开设的邮件提醒功能。若有不便之处，还请海涵！如果您并没有访问过我们的网站，或没有进行操作，请忽略这封邮件。您不需要退订或进行其他进一步的操作。

附本站简介：
--------------------------------------------------
文章网（http://www.qyej520.com）优秀的阅读写作平台始建于2011年3月，目前有知名的网络作者入驻，有实力强的编辑管理，[雨祺，维维安，兰亭书香，颖~昕薇]文章转载率高，读者认可度高！在同行短文学网站享有较高的声誉，实现网站与作者，读者双向互赢，文字共鸣是永恒主题！发展至今，PR与百度权重节节攀升，基本实现了秒收录的优秀网站！目前活跃会员达到千人，读者满意，作者开心！因此诞生了新的口号，用文字抒发感情，缘分让你我成为一家人！
--------------------------------------------------


关于投稿，评论那些事：
--------------------------------------------------　
1、在编辑文章时必须顾及页面的美观度，标题不宜超过25字，标题新颖！百度搜索无重复！
　　
2、在编辑内容简介中，从内容中复制两段280字出来。无空行！（为了栏目页更美观，希望大家能理解）
　　
3、在编辑文章内容时，应该用左边的在线排版工具排版好或者用集成的自动排版好后在提交。
　　
4、在编辑审核文章时，百度发现文章出现多个网站，标题可能从该文章内容选取或是在标题后跟您的笔名
　　
5、你若喜欢的文章应该多利用文后的百度分享工具进行分享与评论
　　
6、你觉得你的建议可以提高原文章质量的应给予文章评论
　　
7.、新文友，因为他们需要鼓励和帮助，显示我们老会员的热情和开放应该给予评论！
　　
扩展阅读：情缘文章管理浅谈评论与站内推荐头条：http://www.qyej520.com/html/438.html
--------------------------------------------------

感谢您的访问，祝您使用愉快！天天好心情！

情缘e家管理敬上  http://www.qyej520.com/

管理：雨祺 ，维维安，兰亭书香，颖~昕薇


--------以下是本次收到的评论信息------------
信息标题：'.$remail[title].' 
评论时间：'.date("Y-m-d H:i:s").'
文友昵称：'.$username.'
评论者IP：'.egetip();

$rremail=$empire->fetch1("select username,email from ".$user_tablename." where userid='".$remail[userid]."'");
@include("../class/SendEmail.inc.php");
//EcmsToSendMail("信息作都邮件地址","邮件标题","邮件内容")
$sm=EcmsToSendMail($rremail[email],"您的文章《$remail[title]》被".$username."评论",$content);
//}




	if($sql)
	{
		$reurl=DoingReturnUrl("../pl/?classid=$classid&id=$id",$_POST['ecmsfrom']);
		echo 'AddPlSuccess';exit;
	}
	else
	{echo 'DbError';exit;}
}

//替换回复
function RepPlTextQuote($repid,$saytext,$pr){
	global $public_r,$empire,$dbtbpre,$fun_r;
	$r=$empire->fetch1("select username,saytime,stb from {$dbtbpre}enewspl where plid='$repid'");
	$fr=$empire->fetch1("select saytext from {$dbtbpre}enewspl_data_".$r['stb']." where plid='$repid'");
	if($r[username])
	{
		if(!empty($fun_r['plincludewords']))
		{
			$ypost=str_replace('[!--saytime--]',$r[saytime],str_replace('[!--username--]',$r[username],$fun_r['plincludewords']));
		}
		else
		{
			$ypost="Originally posted by <i>".$r[username]."</i> at ".$r[saytime].":<br>";
		}
	}
	$include="<table border=0 width='100%' cellspacing=1 cellpadding=10 bgcolor='#cccccc'><tr><td width='100%' bgcolor='#FFFFFF' style='word-break:break-all'>".$ypost.RepYPlQuote($fr[saytext])."</td></tr></table>";
	$restr=str_replace("[quote]".$repid."[/quote]",$include,$saytext);
	return $restr;
}

//去掉原引用
function RepYPlQuote($text){
	$preg_str="/<table (.+?)<\/table>/is";
	$text=preg_replace($preg_str,"",$text);
	return $text;
}

//禁用字符
function ReplacePlWord($plclosewords,$text){
	global $empire,$dbtbpre;
	if(empty($text))
	{
		return $text;
	}
	toCheckCloseWord($text,$plclosewords,'HavePlCloseWords');
	return $text;
}

//返回字段
function ReturnPlAddF($add,$pr,$ecms=0){
	global $empire,$dbtbpre;
	$fr=explode(',',$pr['plf']);
	$count=count($fr)-1;
	$ret_r['fields']='';
	$ret_r['values']='';
	for($i=1;$i<$count;$i++)
	{
		$f=$fr[$i];
		$fval=RepPostStr($add[$f]);
		//必填
		if(strstr($pr[plmustf],','.$f.','))
		{
			if(!trim($fval))
			{
				$chfr=$empire->fetch1("select fname from {$dbtbpre}enewsplf where f='$f' limit 1");
				$GLOBALS['msgmustf']=$chfr['fname'];
				printerror('EmptyPlMustF','',1);
			}
		}
		$fval=nl2br(RepFieldtextNbsp($fval));
		$ret_r['fields'].=",".$f;
		$ret_r['values'].=",'".addslashes($fval)."'";
	}
	return $ret_r;
}

//支持/反对评论
function DoForPl($add){
	global $empire,$dbtbpre;
	$classid=(int)$add['classid'];
	$id=(int)$add['id'];
	$plid=(int)$add['plid'];
	$dopl=(int)$add['dopl'];
	$doajax=(int)$add['doajax'];
	if(!$classid||!$id||!$plid)
	{
		$doajax==1?ajax_printerror('','','ErrorUrl',1):printerror('ErrorUrl','',1);
	}
	//连续发表
	if(getcvar('lastforplid'.$plid))
	{
		$doajax==1?ajax_printerror('','','ReDoForPl',1):printerror('ReDoForPl','',1);
	}
	if($dopl==1)
	{
		$f='zcnum';
		$msg='DoForPlGSuccess';
	}
	else
	{
		$f='fdnum';
		$msg='DoForPlBSuccess';
	}
	$sql=$empire->query("update {$dbtbpre}enewspl set ".$f."=".$f."+1 where plid='$plid' and id='$id' and classid='$classid'");
	if($sql)
	{
		esetcookie('lastforplid'.$plid,$plid,time()+30*24*3600);	//最后发布
		if($doajax==1)
		{
			$nr=$empire->fetch1("select ".$f." from {$dbtbpre}enewspl where plid='$plid' and id='$id' and classid='$classid'");
			ajax_printerror($nr[$f],$add['ajaxarea'],$msg,1);
		}
		else
		{
			printerror($msg,$_SERVER['HTTP_REFERER'],1);
		}
	}
	else
	{
		$doajax==1?ajax_printerror('','','DbError',1):printerror('DbError','',1);
	}
}
function unescape($str) {
         $str = rawurldecode($str); 
         preg_match_all("/%u.{4}|&#x.{4};|&#d+;|.+/U",$str,$r); 
         $ar = $r[0]; 
         foreach($ar as $k=>$v) { 
                  if(substr($v,0,2) == "%u") 
                           $ar[$k] = iconv("UCS-2","GBK",pack("H4",substr($v,-4))); 
                  elseif(substr($v,0,3) == "&#x") 
                           $ar[$k] = iconv("UCS-2","GBK",pack("H4",substr($v,3,-1))); 
                  elseif(substr($v,0,2) == "&#") { 
                           $ar[$k] = iconv("UCS-2","GBK",pack("n",substr($v,2,-1))); 
                  } 
         } 
         return join("",$ar); 
}
?>