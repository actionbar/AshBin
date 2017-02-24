<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">Are U Sure To Refresh '.$filename.'.php?</a>';
exit;
}

require '../_/global.php';
require '../_/z.php';

$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'z/'.$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$id_out='';

$text=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('V0').'f.css" /><link rel="stylesheet" type="text/css" href="'.constant('V0_e').'tech/f.css" /><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>网站地图_E维科技_V-Get!</title><meta name="keywords" content="E维科技,网站地图,sitemap"/>';

$text.=TUN(0);

$text.='<div class="o mh"></div><div class="mg a960x60">'.constant('A960x60a').'</div><div class="v"><div class="p l"><div class="c">'.ZAtab($filename).'<div class="o mh"></div><div class="lki a"><a href="http://e.v-get.com/"><img src="'.constant('L_TP').'links/e.v-get.com.gif" alt="E维科技，专注网络营销" width="165" height="40"></a><a href="http://e.v-get.com/tech/"><img src="'.constant('L_TP').'links/e.v-get.com%252ftech%252f.gif" alt="科技很有趣！" width="165" height="40"></a><a href="http://e.v-get.com/i/"><img src="'.constant('L_TP').'links/e.v-get.com%252fi%252f.gif" alt="E维科技站长论坛" width="165" height="40"></a><a href="http://e.v-get.com/tool/"><img src="'.constant('L_TP').'links/e.v-get.com%252ftool%252f.gif" alt="站长工具" width="165" height="40"></a></div><div class="o mh"></div><div class="lk3 a"><a href="'.constant('LK').'tech/" class="lk3t">科技有趣</a><a href="'.constant('LK').'z/rss/tech.xml" class="lk3r">RSS订阅</a><a href="'.constant('LK').'z/rss/isem.xml" class="lk3r">网络营销RSS</a><a href="'.constant('LK').'z/rss/itech.xml" class="lk3r">网络技术RSS</a><a href="'.constant('LK').'z/rss/programmer.xml" class="lk3r">程序猿RSS</a><div class="o"></div>';
/* 网络营销RSS  a=4 OR a=8 OR b=3 OR b=6 OR b=9 OR c=2 OR c=3 OR c=4 */
/* 网络技术RSS  a=1 OR a=2 OR a=3 OR a=6 OR a=8 OR b=1 OR b=6 OR b=9 OR c=2 OR c=4 OR c=5 OR c=6 OR c=7 OR c=8 OR c=9 */
foreach($asa as $a=>$ak){if($ak!=''){$text.='<a href="'.constant('LK').'tech/'.$ak[0].'_1.html">'.$ak[1].'</a>';}}
foreach($asb as $a=>$ak){if($ak!=''){$text.='<a href="'.constant('LK').'tech/'.$ak[0].'_1.html">'.$ak[1].'</a>';}}
foreach($asc as $a=>$ak){if($ak!=''){$text.='<a href="'.constant('LK').'tech/'.$ak[0].'_1.html">'.$ak[1].'</a>';}}
foreach($Garr as $g=>$ga){
$text.='<a href="'.constant('LK').'tech/top'.$g.'_1.html">'.$ga.'</a>';
}
$text.='<div class="o"></div><a href="'.constant('LK').constant('MENU_BBS').'/" class="lk3t">站长论坛</a><div class="o"></div>';

$QC_i=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve_i',$QC_i);mysql_query('set names utf8');
$QsI='SELECT fid,name FROM '.constant('discuz_pre').'forum_forum WHERE type="group" AND status=1 ORDER BY displayorder';$QqI=mysql_query($QsI,$QC_i);while($QaI=mysql_fetch_array($QqI)){
$gid=$QaI['fid'];
$text.='<a href="'.constant('LK').constant('MENU_BBS').'/bbs-'.$QaI['fid'].'.html" class="lk3n">'.$QaI['name'].'</a>';
$Qsf='SELECT fid,name FROM '.constant('discuz_pre').'forum_forum WHERE fup='.$gid.' AND status=1 ORDER BY displayorder';$Qqf=mysql_query($Qsf,$QC_i);while($Qaf=mysql_fetch_array($Qqf)){$text.='<a href="'.constant('LK').constant('MENU_BBS').'/topic-'.$Qaf['fid'].'-1.html">'.$Qaf['name'].'</a>';}
$text.='<div class="o"></div>';
}

$text.='</div></div></div><div class="q r">';
/* 读取由_.php生成的_.html 并且修改后的_.html *//* 这里是tech文章右侧，服务器不需要有，所以本地 */
$htmlrt=fopen('_.html','r') or exit("Unable to open file!");
while(!feof($htmlrt)){$text.=fgets($htmlrt);}
fclose($htmlrt);

$text.='</div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().'J("'.constant('LTU').'fd.js");'.constant('TONGJI').'</script></div>'.constant('ADxuanfu').'</body></html>';
file_put_contents($file,$text);}
?>