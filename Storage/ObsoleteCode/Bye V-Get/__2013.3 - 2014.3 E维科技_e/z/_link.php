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

$text=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('V0').'f.css" /><link rel="stylesheet" type="text/css" href="'.constant('V0_e').'tech/f.css" /><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>友情链接_E维科技_V-Get!</title><meta name="keywords" content="友情链接,外链交换,换链,E维科技"/><meta name="description" content="E维科技诚邀站长技术、网络科技、网络营销、SEO等相关技术网站交换友情链接，共同交流网站技术。提高网站PR排名，友情连接网自动审核！">';

$text.=TUN(0);

$text.='<div class="o mh"></div><div class="mg a960x60">'.constant('A960x60a').'</div><div class="v"><div class="p l"><div class="c">'.ZAtab($filename).'<div class="o mh"></div><div class="lki a"><a href="http://e.v-get.com/"><img src="'.constant('L_TP').'links/e.v-get.com.gif" alt="E维科技，一切只为网络营销" width="165" height="40"></a><a href="http://e.v-get.com/tech/"><img src="'.constant('L_TP').'links/e.v-get.com%252ftech%252f.gif" alt="科技很有趣！" width="165" height="40"></a><a href="http://e.v-get.com/i/"><img src="'.constant('L_TP').'links/e.v-get.com%252fi%252f.gif" alt="E维科技站长论坛" width="165" height="40"></a><a href="http://e.v-get.com/tool/"><img src="'.constant('L_TP').'links/e.v-get.com%252ftool%252f.gif" alt="站长工具" width="156" height="40"></a></div><div class="o mh"></div><div class="lk3 a"><a href="'.constant('LK').'tech/" class="lk3t">科技有趣</a>';
foreach($asa as $a=>$ak){if($ak!=''){$text.='<a href="'.constant('LK').'tech/'.$ak[0].'_1.html">'.$ak[1].'</a>';}}
foreach($asb as $a=>$ak){if($ak!=''){$text.='<a href="'.constant('LK').'tech/'.$ak[0].'_1.html">'.$ak[1].'</a>';}}
foreach($asb as $a=>$ak){if($ak!=''){$text.='<a href="'.constant('LK').'tech/'.$ak[0].'_1.html">'.$ak[1].'</a>';}}
$text.='<div class="o"></div><a href="'.constant('LK').constant('MENU_BBS').'/" class="lk3t">站长论坛</a><div class="o"></div>';

$QC_i=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve_i',$QC_i);mysql_query('set names utf8');
$QsI='SELECT fid,name FROM '.constant('discuz_pre').'forum_forum WHERE type="group" AND status=1 ORDER BY displayorder';$QqI=mysql_query($QsI,$QC_i);while($QaI=mysql_fetch_array($QqI)){$text.='<a href="'.constant('LK').constant('MENU_BBS').'/bbs-'.$QaI['fid'].'.html" class="lk3t">'.$QaI['name'].'</a>';}
$text.='<div class="o"></div>';
$QsI='SELECT fid,name FROM '.constant('discuz_pre').'forum_forum WHERE type="forum" AND status=1 ORDER BY displayorder';$QqI=mysql_query($QsI);while($QaI=mysql_fetch_array($QqI)){$text.='<a href="'.constant('LK').constant('MENU_BBS').'/topic-'.$QaI['fid'].'-1.html">'.$QaI['name'].'</a>';}
$text.='<div class="o"></div>';

$text.='</div><div class="lk4"><h3>欢迎PR≧1的网站交换友情链接，请您登陆<a href="'.constant('LK').constant('MENU_BBS').'/topic-85-1.html">换链论坛</a>申请！</h3><p>E维科技图片链接：</p><textarea rows="3"><a href="http://e.v-get.com/" title="E维科技，一切只为网络营销！"><img src="'.constant('L_TP').'links/e.v-get.com.gif" alt="E维科技，一切只为网络营销！"/></a></textarea><p>E维科技文字链接：</p><textarea rows="2"><a href="http://e.v-get.com/" title="E维科技，一切只为网络营销！">V-Get!</a></textarea></div></div></div><div class="q r">';
/* 读取由_.php生成的_.html 并且修改后的_.html *//* 这里是tech文章右侧，服务器不需要有，所以本地 */
$htmlrt=fopen('_.html','r') or exit("Unable to open file!");
while(!feof($htmlrt)){$text.=fgets($htmlrt);}
fclose($htmlrt);

$text.='</div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().'J("'.constant('LTU').'fd.js");'.constant('TONGJI').'</script></div>'.constant('ADxuanfu').'</body></html>';
file_put_contents($file,$text);}
?>