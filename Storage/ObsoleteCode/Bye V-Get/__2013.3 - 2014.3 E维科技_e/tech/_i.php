<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.php?</a>';
exit;
}
//因为经常localhost和 远程共用，所以会出现用Localhost生成的__.html是localhost路径，这里对于需要直接修改单个页面的，需要重新修改一次右侧
if(empty($_GET['rightok'])){echo '<iframe src="http://localhost/www.v-get.com/e/tech/__.php?sure=ok" style="display:none"></iframe>';}
require '../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'tech/'.$filename.'.php';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{

$c_mysql_page=new mysql_page();
$text='<?php
'.constant('Upload_database').'
$SQ=$_GET[\'sq\'];'.constant('TECH_I').'$ASQ=$asq[$SQ];unset($asq);
if(count($ASQ)<1){header(\'HTTP/1.1 404 Not Found\');header("status: 404 Not Found");include \'a/404.php\';exit();}
$ASQ0=$ASQ[0];$ASQ1=$ASQ[1];
$sp=empty($_GET[\'sp\'])?1:$_GET[\'sp\'];$Qp=($sp-1)*'.constant('TECH_I_page_article').';
$Qq=mysql_query(\'SELECT i,t,h,g,d FROM f2013 WHERE \'.$ASQ0.\' ORDER BY i DESC LIMIT \'.$Qp.\','.constant('TECH_I_page_article').'\',$QC);
$Qy=mysql_query(\'SELECT COUNT(*) FROM f2013 WHERE \'.$ASQ0);
$Qz=mysql_fetch_array($Qy);
$Qt=$Qz[0];$Pz=ceil($Qt/'.constant('TECH_I_page_article').');
?>';
$text.=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU').'f.css" /><link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'tech/f.css" /><?php echo \'<title>\',$ASQ1,\'_E维站长之家_V-Get!</title><meta name="keywords" content="\',$ASQ1,\',SEO,站长之家,网络营销,PHP教程"/><meta name="description" content="\',$ASQ[2],\'"/>\';?>';

$text.=TUN('tech');

$text.='<div class="o mh"></div><div class="mg">'.constant('AD960x90pic').'</div><div class="v"><div class="l"><div class="vb1c"><?php
echo \'<div class="m mb">您的位置：<a href="'.constant('LK').'">首页</a>&nbsp;&gt;&gt;&nbsp;<a href="'.constant('LK').'tech/">站长之家</a>&nbsp;&gt;&gt;&nbsp;<a href="'.constant('LK').'tech/\',$SQ,\'_1.html">\',$ASQ1,\'</a><span></span></div>\';
while($Qa=mysql_fetch_array($Qq)){
$T=$Qa[\'t\'];$t=strtotime($T);$t=date(\'Ymd/His\',$t);
$G=$Qa[\'g\'];
echo \'<h2><a href="'.constant('LK').'tech/top\',$G,\'_1.html" class="fg\',$G,\'" title="推荐"></a><a href="'.constant('LK').'tech/\',$t,$Qa[\'i\'],\'.html">\',$Qa[\'h\'],\'</a><i>\',$T,\'</i></h2><p>\',$Qa[\'d\'],\'</p>\';
}

'.$c_mysql_page->show('sp1',constant('LK').'tech/[$SQ]_1.html',constant('LK').'tech/[$SQ]_{_}.html','$Pz','$sp').'


?></div></div><div class="r">';
/* 读取由_.php生成的_.html 并且修改后的_.html *//* 这里是tech文章右侧，服务器不需要有，所以本地 */
$htmlrt=fopen('_.html','r') or exit("Unable to open file!");
while(!feof($htmlrt)){$text.=fgets($htmlrt);}
fclose($htmlrt);

$text.='</div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().constant('TONGJI').'</script></div>'.constant('AD120x270xfboth').'</body></html>';
file_put_contents($file,$text);}
?>