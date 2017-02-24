<?php
require 'global.php';
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve',$QC);mysql_query('set names utf8');

/* isem网络营销RSS  a=4 OR a=8 OR b=3 OR b=6 OR b=9 OR c=2 OR c=3 OR c=4 */
/* itech网络技术RSS  a=1 OR a=2 OR a=3 OR a=6 OR a=8 OR b=1 OR b=6 OR b=9 OR c=2 OR c=4 OR c=5 OR c=6 OR c=7 OR c=8 OR c=9 */

$file=constant('uploadFile').'z/rss/index.xml';
$fp=fopen($file,'w+');
if(is_writable($file)==false) {die("/z/rss/index.xml");exit;}
else{
$text='<?xml version="1.0" encoding="utf-8"?><rss version="2.0"><channel><title>E维科技，关注网络营销</title><link>http://e.v-get.com/</link><description>E维科技为草根站长提供网络创业资讯、网站建设产品、网络营销方案、SEO教程、网站源码、站长论坛、站长工具、网站运营理念以及一站式网络解决方案。</description><lastBuildDate>'.date('D, d M Y H:i:s').' GMT</lastBuildDate><ttl>60</ttl><image><url>http://tp.v-get.com/links/rss/e.v-get.com.gif</url><title>E维科技，关注网络营销</title><link>http://e.v-get.com/</link></image>';

$Qsw3c='SELECT l,h,d,t FROM w3c ORDER BY rand() LIMIT 1';$Qqw3c=mysql_query($Qsw3c,$QC);
$Qaw3c=mysql_fetch_array($Qqw3c);
$Tw3c=$Qaw3c['t'];$Tw3c=strtotime($Tw3c);$tdw3c=date("D, d M Y H:i:s",$Tw3c);
$text.='<item><title>'.$Qaw3c['h'].'</title><description>'.$Qaw3c['d'].'</description><link>http://e.v-get.com/w3c/'.$Qaw3c['l'].'.shtml</link><pubDate>'.$tdw3c.' GMT</pubDate></item>';


$Qs='SELECT i,h,d,t FROM f2013 ORDER BY i DESC LIMIT 9';$Qq=mysql_query($Qs,$QC);
while($Qa=mysql_fetch_array($Qq)){
$T=$Qa['t'];$T=strtotime($T);$t=date('Ymd/His',$T);$td=date("D, d M Y H:i:s",$T);
$text.='<item><title>'.$Qa['h'].'</title><description>'.$Qa['d'].'</description><link>http://e.v-get.com/tech/'.$t.$Qa['i'].'.html</link><pubDate>'.$td.' GMT</pubDate></item>';
}


$Qsw3c='SELECT l,h,d,t FROM w3c ORDER BY rand() LIMIT 1';$Qqw3c=mysql_query($Qsw3c,$QC);
$Qaw3c=mysql_fetch_array($Qqw3c);
$Tw3c=$Qaw3c['t'];$Tw3c=strtotime($Tw3c);$tdw3c=date("D, d M Y H:i:s",$Tw3c);
$text.='<item><title>'.$Qaw3c['h'].'</title><description>'.$Qaw3c['d'].'</description><link>http://e.v-get.com/w3c/'.$Qaw3c['l'].'.shtml</link><pubDate>'.$tdw3c.' GMT</pubDate></item>';

$text.='</channel></rss>';
file_put_contents($file,$text);}



$file=constant('uploadFile').'z/rss/tech.xml';
$fp=fopen($file,'w+');
if(is_writable($file)==false) {die("/z/rss/tech.xml");exit;}
else{
$text='<?xml version="1.0" encoding="utf-8"?><rss version="2.0"><channel><title>站长之家，看那些有趣的科技事</title><link>http://e.v-get.com/tech/</link><description>E维科技科技有趣用风趣幽默的方式把无聊烦躁的互联网科技解说的生动活泼，风趣的PHP教程网站建设教程、网络营销教程等知识网络——让我们一起来让科技更有趣吧！E维科技，专注网络营销！</description><lastBuildDate>'.date('D, d M Y H:i:s').' GMT</lastBuildDate><ttl>60</ttl><image><url>http://tp.v-get.com/links/rss/e.v-get.com.gif</url><title>站长之家，看那些有趣的科技事</title><link>http://e.v-get.com/tech/</link></image>';
$Qs='SELECT i,h,d,t FROM f2013 ORDER BY rand() LIMIT 10';$Qq=mysql_query($Qs,$QC);
while($Qa=mysql_fetch_array($Qq)){
$T=$Qa['t'];$T=strtotime($T);$t=date('Ymd/His',$T);$td=date("D, d M Y H:i:s",$T);
$text.='<item><title>'.$Qa['h'].'</title><description>'.$Qa['d'].'</description><link>http://e.v-get.com/tech/'.$t.$Qa['i'].'.html</link><pubDate>'.$td.' GMT</pubDate></item>';
}
$text.='</channel></rss>';
file_put_contents($file,$text);}
?>