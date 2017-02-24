<!DOCTYPE html><html><head><title>一木一天堂原创编辑</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>#top a{padding:5px 9px}</style><base target="_blank">
</head>
<body>
<div id="top"><a href="editor_xxxxx_sitemap.php">原创文章</a><a href="editor_xxxxx_sitemap.php?vget=good">推荐文章</a><a href="editor_xxxxx_sitemap.php?vget=ebook">网络E文</a><a href="editor_xxxxx_sitemap.php?vget=tag">转载文章</a><a href="http://e.v-get.com/tech/">E维科技</a></div>
<?php
$mysqladd='localhost';  
$mysqluser='YMytt13902'; 
$mysqlpass='FckU01Dwdcl'; 

$DB='e_13030302';
$pre='pre_';
$TBuid=$pre.'common_member';
$TBthread=$pre.'forum_thread';
$connect=mysql_connect($mysqladd,$mysqluser,$mysqlpass);mysql_select_db($DB,$connect);mysql_query('set names utf8');

$sp=empty($_GET['sp'])?1:$_GET['sp'];$Qp=($sp-1)*30;
if(empty($_GET['vget'])){$VGET='';
$Qs='SELECT tid,subject FROM '.$TBthread.' WHERE subject LIKE "%<V/>" ORDER BY dateline DESC LIMIT '.$Qp.',30';
$Qsz='SELECT COUNT(*) FROM '.$TBthread.' WHERE subject LIKE "%<V/>" ORDER BY dateline DESC';
}
else 
{$VGET=$_GET['vget'];
if($VGET=='tag'){$Qs='SELECT tid,subject FROM '.$TBthread.' WHERE subject LIKE "%<T/>" ORDER BY dateline DESC LIMIT '.$Qp.',30';
$Qsz='SELECT COUNT(*) FROM '.$TBthread.' WHERE subject LIKE "%<T/>" ORDER BY dateline DESC';}
else if($VGET=='ebook'){$Qs='SELECT tid,subject FROM '.$TBthread.' WHERE subject LIKE "%<E/>" ORDER BY dateline DESC LIMIT '.$Qp.',30';
$Qsz='SELECT COUNT(*) FROM '.$TBthread.' WHERE subject LIKE "%<E/>" ORDER BY dateline DESC';}
else {$Qs='SELECT tid,subject FROM '.$TBthread.' WHERE subject LIKE "%<G/>" ORDER BY dateline DESC LIMIT '.$Qp.',30';
$Qsz='SELECT COUNT(*) FROM '.$TBthread.' WHERE subject LIKE "%<G/>" ORDER BY dateline DESC';}
}
 $Qq=mysql_query($Qs);$Qqz=mysql_query($Qsz);
	 $Qz=mysql_fetch_array($Qqz);
	 $Qt=$Qz[0];$Qpz=ceil($Qt/30);
	 while($Qa=mysql_fetch_array($Qq)){echo '<p><a href="http://xxxxx.com/bbs/thread-',$Qa['tid'],'-1-1.html">',$Qa['subject'],'</a></p>';}
	mysql_close();
if($Qpz>1){
$Qpp=$sp-1;$Qpn=$sp+1;
$Qpq=($Qpp==1)?'':$Qpp;
switch ($sp)
{ case 1:echo '<div id="p"><a class="po">首页</a><a class="po">前一页&lt;</a>第<span class="pc">1</span>页<a href="editor_xxxxx_sitemap.php?vget=',$VGET,'&sp=2" target="_self">&gt;下一页</a><a href="editor_xxxxx_sitemap.php?vget=',$VGET,'&sp=',$Qpz,'" target="_self">共',$Qpz,'页</a></div>';break;
 case $Qpz:echo '<div id="p"><a href="editor_xxxxx_sitemap.php?vget=',$VGET,'" target="_self">首页</a><a href="editor_xxxxx_sitemap.php?vget=',$VGET,'&sp=',$Qpq,'" target="_self">前一页&lt;</a>第<span class="pc">',$sp,'</span>页<a class="po">&gt;下一页</a><a class="po">第',$sp,'页</a></div>';break;
  default:echo '<div id="p"><a href="editor_xxxxx_sitemap.php?vget=',$VGET,'" target="_self">首页</a><a href="editor_xxxxx_sitemap.php?vget=',$VGET,'&sp=',$Qpq,'" target="_self">前一页&lt;</a>第<span class="pc">'.$sp.'</span>页<a href="editor_xxxxx_sitemap.php?vget=',$VGET,'&sp=',$Qpn,'" target="_self">&gt;下一页</a><a href="editor_xxxxx_sitemap.php?vget=',$VGET,'&sp=',$Qpz,'" target="_self">第',$Qpz,'页</a></div>';break;
}
} 
	 
?>
</body></html>