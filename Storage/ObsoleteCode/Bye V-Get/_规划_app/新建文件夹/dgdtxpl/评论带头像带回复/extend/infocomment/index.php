<?php
require('../../class/connect.php');
require("../../class/userfun.php");
require('../../class/db_sql.php');
require('../../data/dbcache/class.php');
require("ip.php");
$link=db_connect();
$empire=new mysqlquery();
$editor=1;

//-------- 插件参数设置开始 -------

//每页显示记录数
$line=5;

//每页显示分页链接数
$page_line=8;

//是否返回总评论数显示(1为返回评论数，0为不返回)
$returnshowplnum=1;

//-------- 插件参数设置结束 -------


//-------- 分页 --------
$page=(int)$_GET['page'];
$offset=$page*$line; //总偏移量

//评论JS分页导航函数
function user_jspage($num,$line,$page_line,$page,$search){
	if($num<=$line)
	{
		return '';
	}
	$search=htmlspecialchars($search,ENT_QUOTES);
	$snum=1;//最小页数
	$totalpage=ceil($num/$line);//取得总页数
	//上一页
	if($page<>0)
	{
		$toppage='<a href="#ecms" onclick="javascript:CommentToPage(0);">首页</a> ';
		$pagepr=$page-1;
		$prepage='<a href="#ecms" onclick="javascript:CommentToPage('.$pagepr.');">上一页</a>';
	}
	//下一页
	if($page!=$totalpage-1)
	{
		$pagenex=$page+1;
		$nextpage=' <a href="#ecms" onclick="javascript:CommentToPage('.$pagenex.');">下一页</a>';
		$lastpage=' <a href="#ecms" onclick="javascript:CommentToPage('.($totalpage-1).');">尾页</a>';
	}
	$starti=$page-$snum<0?0:$page-$snum;
	$no=0;
	for($i=$starti;$i<$totalpage&&$no<$page_line;$i++)
	{
		$no++;
		if($page==$i)
		{
			$is_1="<b>";
			$is_2="</b>";
		}
		else
		{
			$is_1='<a href="#ecms" onclick="javascript:CommentToPage('.$i.');">';
			$is_2="</a>";
		}
		$pagenum=$i+1;
		$returnstr.=" ".$is_1.$pagenum.$is_2;
	}
	$returnstr=$toppage.$prepage.$returnstr.$nextpage.$lastpage;
	return $returnstr;
}

$id=(int)$_GET['id'];
$classid=(int)$_GET['classid'];
if(empty($id)||empty($classid))
{
	exit();
}
if(empty($class_r[$classid][tbname]))
{
	exit();
}
$n_r=$empire->fetch1("select id,classid,plnum from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where id='$id' limit 1");
if(!$n_r[id]||$classid!=$n_r[classid])
{
	exit();
}
$search="&classid=$classid&id=".$id;


//-------- 查询SQL --------

//取得评论总数
if($class_r[$classid][checkpl])//需审核
{
	$totalquery="select count(*) as total from {$dbtbpre}enewspl where id='$id' and classid='$classid' and checked=0";
	$num=$empire->gettotal($totalquery);
}
else
{
	$num=$n_r['plnum'];
}
//select查询SQL
$query="select plid,saytime,sayip,username,zcnum,fdnum,userid,stb from {$dbtbpre}enewspl where id='$id' and classid='$classid' and repl=0";
$query.=" order by plid desc limit $offset,$line";
$sql=$empire->query($query);

$listpage=user_jspage($num,$line,$page_line,$page,$search);
//require('template/index.temp.php'); //导入模板文件
$plstep=$num-$page*$line;//起始楼层
while($r=$empire->fetch($sql))
{
	//循环回复
	$sql_hf = $empire->query("select plid,saytext from {$dbtbpre}enewspl_data_".$r[stb]." where id='$r[plid]'");
	
	//
	$plusername=$r[username];
	if(empty($r[username]))
	{
		$plusername='匿名';
	}



	if($r[userid])
	{
		$plusername="<a href='$public_r[newsurl]e/space/?userid=$r[userid]' target='_blank'>$r[username]</a>";
	}
	//ip
	$sayip=ToReturnXhIp($r[sayip]);
	//副表
	$fr=$empire->fetch1("select saytext from {$dbtbpre}enewspl_data_".$r[stb]." where plid='$r[plid]'");
	$saytext=RepPltextFace(stripSlashes($fr['saytext']));//替换表情
	$includelink=" onclick=\"javascript:document.saypl.saytext.value+='[quote]".$r[plid]."[/quote]';document.saypl.repid.value='".$r[plid]."';document.saypl.saytext.focus();\"";
?>

<div class="decmt-box2">
   <ul>
     <li>
<div class="comtItem clearfix">
<div class="userInfo">
<div class="name"> <a href="/e/space/?userid=<?=$r[userid]?>" title="" target="_blank"> <?=$plusername?> </a> </div>
<div class="photo"> <a href="/e/space/?userid=<?=$r[userid]?>" title="" target="_blank"> <img width="50" height="50"  src="<?=pl_getuserpic($r[userid]);?>" alt="" /> </a> </div>
</div><div class="comtInfo">
<div class="pubTime"><span class="mgr10">发表于</span><span class=""><?=$r[saytime]?>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 来自:<?echo convertip("$r[sayip]","./");?>&nbsp;&nbsp;<?=user_time($r[saytime],1)?> </span></div>
<div class="comtCont">
<p class="reply_c"> <?=$saytext?> </p>
<div class="action"> <span> <img src="<?=$public_r[newsurl]?>skin/images/ding.gif" width="16" height="19" /><a href="JavaScript:makeRequest('<?=$public_r[newsurl]?>e/enews/?enews=DoForPl&plid=<?=$r[plid]?>&classid=<?=$classid?>&id=<?=$id?>&dopl=1&doajax=1&ajaxarea=zcpldiv<?=$r[plid]?>','EchoReturnedText','GET','');"> 顶 </a>(<span id="zcpldiv<?=$r[plid]?>"><?=$r[zcnum]?></span>)&nbsp;&nbsp; <img src="<?=$public_r[newsurl]?>skin/images/cai.gif" width="16" height="19" /><a href="JavaScript:makeRequest('<?=$public_r[newsurl]?>e/enews/?enews=DoForPl&plid=<?=$r[plid]?>&classid=<?=$classid?>&id=<?=$id?>&dopl=0&doajax=1&ajaxarea=fdpldiv<?=$r[plid]?>','EchoReturnedText','GET','');"> 踩 </a>(<span id="fdpldiv<?=$r[plid]?>"><?=$r[fdnum]?></span>)&nbsp;&nbsp; <img src="<?=$public_r[newsurl]?>skin/images/huifu.gif" width="16" height="19" /> <a href="javascript:doreply(<?=$r[plid]?>)">回复</a>&nbsp;&nbsp; </span></div>

<div id="reply_<?=$r[plid]?>" class="replyform">
<input class="wInput" type="text" name="retxt<?=$r[plid]?>" id="retxt<?=$r[plid]?>"/>
<input class="wOk" type="button" value=" 回 复 " onclick="replsubmit(<?=$r[plid]?>);"/>
<input type="hidden" id="re<?=$r[plid]?>" name="re<?=$r[plid]?>" value="<?=$r[plid]?>" />
</div>
<?php
	while($r_hf=$empire->fetch($sql_hf))
	{
	$arr = pl_getusername($r_hf[plid]);
	?>
<div class="retxt"> <a class="photo" href="/e/space/?userid=<?=$arr[1]?>" title="" target="_blank"><img width="50" height="50"  src="<?=pl_getuserpic($arr[1]);?>" alt="" width="40px;" /> </a>
<div class="text">
<p class="name"> <a class="mgr10"  href="/e/space/?userid=<?=$arr[1]?>" title="" target="_blank"> <?=$arr[0]?></a> <span class="gray9"> <?=$arr[2]?> </span> </p>
<p class="reretxt"> <?=$r_hf['saytext']?> </p>
</div>
</div>
<?php
	}	
	?>
</div>
</div>
</div>
</div>
<?php
}
?>

  </li>
 </ul>
</div>

<div class="epages" style="clear:both;border-top:1px solid #ccc; line-height:30px;padding:3px 0px 0px 5px;"><?=$listpage?></div>
<?php
function pl_getusername($puid){
	global $empire;
	$arr = Array();
	$sql="select username,userid,saytime from phome_enewspl where plid=".$puid;
	$p_r=$empire->fetch1($sql);
	$arr[0]=$p_r[username];
	$arr[1]=$p_r[userid];
	$arr[2]=$p_r[saytime];
	return $arr;
}
function pl_getuserpic($puid){
	global $empire,$public_r;
	$userpic='';
	$sql="select userpic from phome_enewsmemberadd where userid=".$puid;
	$p_r=$empire->fetch1($sql);
	if($p_r[userpic]==''){
		$userpic=$public_r[newsurl].'e/data/images/nouserpic.gif';
	}else{
		$userpic = $p_r[userpic];
	}
	return $userpic;
}
db_close(); //关闭MYSQL链接
$empire=null; //注消操作类变量
?>