<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.php?</a>';
exit;
}

require '../../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'tech/u/'.$filename.'.php';

$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$text='<?php
'.constant('Upload_database').'
$M=$_GET[\'su\'];
$sp=empty($_GET[\'sp\'])?1:$_GET[\'sp\'];$Qp=($sp-1)*30;
$Qq=mysql_query(\'SELECT * FROM f2013 WHERE m="\'.$M.\'" ORDER BY t DESC LIMIT \'.$Qp.\',30\',$QC);
$Qy=mysql_query(\'SELECT COUNT(*) FROM f2013 WHERE m="\'.$M.\'"\');
$Qz=mysql_fetch_array($Qy);
$Qt=$Qz[0];$Pz=ceil($Qt/30);
?>';
$text.=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU').'f.css" /><link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'tech/f.css" /><?php echo \'<title>\',$M,\'_E维站长之家_V-Get!</title><meta name="keywords" content="\',$M,\',SEO,站长之家,网络营销,PHP教程"/>\';?>';

$text.=TUN('tech');

$text.='<div class="o mh"></div><div class="mg a960x60">'.constant('A960x60a').'</div><div class="v"><div class="p l"><div class="vb1c">
<?php
echo \'<div class="m mb">您的位置：
<a href="'.constant('LK').'">首页</a>&nbsp;&gt;&gt;&nbsp;<a href="'.constant('LK').'tech/">站长之家</a>&nbsp;&gt;&gt;&nbsp;<a href="'.constant('LK').'tech/u/">网络编辑</a>&nbsp;&gt;&gt;&nbsp;<a href="'.constant('LK').'tech/u/\',$M,\'_1.html">\',$M,\'</a><span></span></div>\';
while($Qa=mysql_fetch_array($Qq)){
$T=$Qa[\'t\'];$t=strtotime($T);$t=date(\'Ymd/His\',$t);
echo \'<h2><a href="'.constant('LK').'tech/\',$t,$Qa[\'i\'],\'.html">\',$Qa[\'h\'],\'</a><i>\',$T,\'</i></h2><p>\',$Qa[\'d\'],\'</p>\';}
if($Pz>1){
$Pp=$sp-1;$Pn=$sp+1;
switch ($sp)
{ case 1:echo \'<div class="pg"><a class="po">首页</a><a class="po">前一页&lt;</a>第<i>1</i>页<a href="'.constant('LK').'tech/u/\',$M,\'_2.html" target="_self">&gt;下一页</a><a href="'.constant('LK').'tech/u/\'.$M.\'_\',$Pz,\'.html" target="_self">共\'.$Pz.\'页</a></div>\';break;
 case $Pz:echo \'<div class="pg"><a href="'.constant('LK').'tech/u/\',$M,\'_1.html" target="_self">首页</a><a href="'.constant('LK').'tech/u/\'.$M.\'_\',$Pp,\'.html" target="_self">前一页&lt;</a>第<i>\'.$sp.\'</i>页<a class="po">&gt;下一页</a><a class="po">第\'.$sp.\'页</a></div>\';break;
  default:echo \'<div class="pg"><a href="'.constant('LK').'tech/u/\',$M,\'_1.html" target="_self">首页</a><a href="'.constant('LK').'tech/u/\'.$M.\'_\',$Pp,\'.html" target="_self">前一页&lt;</a>第<i>\'.$sp.\'</i>页<a href="'.constant('LK').'tech/u/\'.$M.\'_\',$Pn,\'.html" target="_self">&gt;下一页</a><a href="'.constant('LK').'tech/u/\'.$M.\'_\',$Pz,\'.html" target="_self">第\'.$Pz.\'页</a></div>\';break;
}}
?></div></div><div class="q r">';
/* 这里是tech文章右侧，服务器不需要有，所以本地 */
$htmlrt=fopen('../_.html','r') or exit("Unable to open file!");
while(!feof($htmlrt)){$text.=fgets($htmlrt);}
fclose($htmlrt);
$text.='</div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().constant('TONGJI').'</script></div>'.constant('ADxuanfu').'</body></html>';
file_put_contents($file,$text);}
?>