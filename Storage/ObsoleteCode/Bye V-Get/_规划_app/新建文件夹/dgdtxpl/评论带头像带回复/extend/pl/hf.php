<?php
require("../../class/connect.php");
require("../../class/db_sql.php");
require("../../data/dbcache/class.php");
require("../../class/user.php");
require("../../data/dbcache/MemberLevel.php");
require("../../data/language/".$ecmslang."/pub/fun.php");
$link=db_connect();
$empire=new mysqlquery();
//验证登陆
$username = getcvar('mlusername');
$muserid=(int)getcvar('mluserid');
$mgroupid=(int)getcvar('mlgroupid');
$enews=$_POST['enews'];
$saytext = unescape( $_POST['content'] );
$nomember =(int)$_POST['nomember'];

if($enews=="ajaxpl")//Ajax增加评论
{
	global $empire,$public_r,$class_r,$user_userid,$user_username,$user_password,$user_dopass,$user_tablename,$user_salt,$user_checked,$user_group,$dbtbpre,$level_r;
	if( ! $nomember )//非匿名
		{
		
			if( ! $muserid){
			
			
			//编码转换
			$utfusername=doUtfAndGbk($username,0);
			$password=doUtfAndGbk($password,0);
			
			//echo $utfusername.' - '.$password;exit;
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
			$sql  = "select ".$user_userid.",".$user_checked.",".$user_group." from ".$user_tablename." where ".$user_username."='$utfusername' and ".$user_password."='$password' limit 1";
			
				$ur=$empire->fetch1($sql);
			
				$cuser=0;
				if($ur[$user_userid])
				{
					$cuser=1;
				}
			}
			
			if(empty($cuser))
			{
				echo 'FailPassword';
				exit;
			}
			if($ur[$user_checked]==0)
			{
				echo 'NotCheckedUser';
				exit;
			}
			$muserid=$ur[$user_userid];
			$mgroupid=$ur[$user_group];
			}
			
		}
		else{
			$muserid=0;
			$username = '';
		}
	
	
	//	评论权限
	if($public_r['plgroupid'])
	{
		if(!$muserid)
		{
			echo 'CloseInfoPl1';exit;
		}
		if($level_r[$mgroupid][level]<$level_r[$public_r['plgroupid']][level])
		{
			echo 'CloseInfoPl1';exit;
		}
	}

	if(!trim($saytext)){
		echo 'kong';
		exit;
	}
	//验证提交IP
	eCheckAccessDoIp('pl');
	$id=(int)$_POST['id'];
	$pid = (int)$_POST['pid'];
	$classid=(int)$_POST['classid'];
	$sayip=egetip();
	$saytext=nl2br(RepFieldtextNbsp(RepPostStr($saytext)));
	$saytime=date("Y-m-d H:i:s");
	$time=time();
	$pltime=getcvar('lastpltime');
	//评论内容限制
	if(strlen($saytext)>$public_r[plsize])
	{
		echo 'PlSizeTobig';exit;//评论内容太多,字数超过限制
	}
    if($time-$pltime<$public_r[pltime])
	{	
	    echo 'PlOutTime';exit;//评论时间超过限制
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
	
	
	$saytext = preg_replace('/{:/','<img src="'.$public_r['newsurl'].'skin/qqface/ali/',$saytext);
	$saytext = preg_replace('/:}/','.gif" width="35" height="35" />',$saytext);
	//查询屏蔽字符
	$pr=$empire->fetch1("select plclosewords,plf,plmustf,pldeftb from {$dbtbpre}enewspublic limit 1");
	//过滤字符
	$saytext=ReplacePlWord($pr['plclosewords'],$saytext);
	//$saytime=date("Y-m-d H:i:s");
	$time=time();
	$pltime=getcvar('lastpltime');
	
	
	if($pltime)
	{
		if($time-$pltime<$public_r[pltime])
		{printerror("PlOutTime","history.go(-1)",1);}
	}
	$pr=$empire->fetch1("select plclosewords,plf,plmustf,pldeftb from {$dbtbpre}enewspublic limit 1");
	//审核
	if($class_r[$classid][checkpl])
	{$checked=1;}
	else
	{$checked=0;}
	$ret_r=ReturnPlAddF($add,$pr,0);
	//主表
	$sql=$empire->query("insert into {$dbtbpre}enewspl(username,sayip,saytime,id,classid,checked,zcnum,fdnum,userid,isgood,stb,repl) values('".$username."','$sayip','$saytime','$id','$classid','$checked',0,0,'$muserid',0,'$pr[pldeftb]','$pid');");
	$plid=$empire->lastid();
	//副表
	$fsql=$empire->query("insert into {$dbtbpre}enewspl_data_".$pr['pldeftb']."(plid,classid,id,saytext".$ret_r['fields'].") values('$plid','$classid','$pid','".addslashes($saytext)."'".$ret_r['values'].");");
	//信息表加1
	$usql=$empire->query("update {$dbtbpre}ecms_".$class_r[$classid][tbname]." set plnum=plnum+1 where id='$id'");
	$sql=$empire->query("update phome_enewsmember set userfen=userfen+1 where userid='$muserid'");
	//设置最后发表时间
	esetcookie("lastpltime",time(),time()+3600*24);
	echo 'Success';
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

//禁用字符
function ReplacePlWord($plclosewords,$text){
	global $empire,$dbtbpre;
	if(empty($text))
	{
		return $text;
	}
	toCheckCloseWord2($text,$plclosewords,'HavePlCloseWords');
	return $text;
}

function toCheckCloseWord2($word,$closestr,$mess){
	if($closestr&&$closestr!='|')
	{
		$checkr=explode('|',$closestr);
		$ckcount=count($checkr);
		for($i=0;$i<$ckcount;$i++)
		{
			if($checkr[$i]&&stristr($word,$checkr[$i]))
			{
				echo 'mg';
				exit;
			}
		}
	}
}


