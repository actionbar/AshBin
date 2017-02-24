<?php
require 'global.php';
require 'ct.php';
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('vwuliu',$QC);mysql_query('set names utf8');

$time=time();
$now=date('Y-m-d\TH:i:s');

/* sitemap_menu.xml  sitemap目录
   sitemap.xml 大类/所有目录
   z/sitemap.xml 静态其他内页
   z/sitemap_i.xml 论坛
   z/ct.sitemap.xml
   z/ct.sitemap_tag.xml 搜索
   sitemap_wuliu 在tp内，全部都收录
   */


   
  

/*———————————————————————————————sitemap目录—————————————————————————————*/
$file=constant('uploadFile').'sitemap_menu.xml';$fp=fopen($file,'w+');
if(is_writable($file)==false) {die("sitemap_menu.xml");exit;}
else{
$text='<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><sitemap><loc>http://wuliu.v-get.com/sitemap.xml</loc><lastmod>'.$now.'</lastmod></sitemap><sitemap><loc>http://wuliu.v-get.com/z/sitemap.xml</loc><lastmod>'.$now.'</lastmod></sitemap><sitemap><loc>http://wuliu.v-get.com/z/sitemap_i.xml</loc><lastmod>'.$now.'</lastmod></sitemap>';
foreach($SUB_CT as $CT=>$cta){
$text.='<sitemap><loc>http://'.$cta[1].'.wuliu.v-get.com/z/sitemap.xml</loc><lastmod>'.$now.'</lastmod></sitemap><sitemap><loc>http://'.$cta[1].'.wuliu.v-get.com/z/sitemap_tag.xml</loc><lastmod>'.$now.'</lastmod></sitemap>';}
$text.='<sitemap><loc>http://tp.v-get.com/sitemap_wuliu.xml</loc><lastmod>'.$now.'</lastmod></sitemap></sitemapindex>';
file_put_contents($file,$text);
}
/*———————————————————————————————sitemap目录 —————————————————————————————*/

  
   
$top='<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';   
   
   
   
  
   
$file_all=constant('uploadFile4TP').'sitemap_wuliu.xml';   
$text_all='';

$file=constant('uploadFile').'sitemap.xml';
$fp=fopen($file,'w+');$fp4TP=fopen($file_all,'w+');
if(is_writable($file)==false||is_writable($file_all)==false) {die("wuliu=sitemap.xml或者 tp=sitemap_wuliu.xml文件没有找到");exit;}
else{
$text='';
/* 1.0 的 每周更新 */
$a10=array('http://yiwu.wuliu.v-get.com/','http://e.v-get.com/tech/','http://e.v-get.com/i/');
foreach($a10 as $i=>$a){$text.='<url><loc>'.$a.'</loc><priority>1.0</priority><lastmod>'.$now.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

/* 0.8 每年更新，但是很重要的 */
$a8=array('http://e.v-get.com/web/','http://e.v-get.com/host/','http://e.v-get.com/soho/','http://e.v-get.com/sem/','http://e.v-get.com/vi/','http://e.v-get.com/soft/','http://e.v-get.com/open/','http://e.v-get.com/tool/');
foreach($a8 as $i=>$a){$text.='<url><loc>'.$a.'</loc><priority>0.9</priority><changefreq>monthly</changefreq></url>';}


$text_all=$text;
$text=$top.$text.'</urlset>';
file_put_contents($file,$text);
}




/*———————————————————————————————其他—————————————————————————————*/
$file=constant('uploadFile').'z/sitemap.xml';$fp=fopen($file,'w+');
if(is_writable($file)==false) {die("z/sitemap.xml");exit;}
else{
$text='';

/* 0.7 每年更新，但是很重要的 */
$a7=array('http://e.v-get.com/open/php.html','http://e.v-get.com/open/php-frame.html','http://e.v-get.com/open/php-social.html','http://e.v-get.com/web/service.html','http://e.v-get.com/web/service_a1.html','http://e.v-get.com/web/service_a2.html','http://e.v-get.com/web/service_a3.html','http://e.v-get.com/web/service_b1.html','http://e.v-get.com/web/service_b2.html','http://e.v-get.com/web/service_b3.html','http://e.v-get.com/web/service_b5.html','http://e.v-get.com/soho/kefu.html','http://e.v-get.com/soho/kefu_call.html','http://e.v-get.com/soho/kefu_online.html','http://e.v-get.com/soho/kefu_partime.html','http://e.v-get.com/soho/kefu_sales.html','http://e.v-get.com/soho/kefu_callcenter.html','http://e.v-get.com/soho/kefu_telesales.html');
//下面 $toolname必须要存在，否则$tool就是数组，而带了 => $toolname ，$tool就是名称
foreach($TOOL_APP as $tool=>$toolname){array_push($a7,'http://e.v-get.com/tool/'.$tool.'.html');}
foreach($a7 as $i=>$a){$text.='<url><loc>'.$a.'</loc><lastmod>2013-03-06T02:14:48+08:00</lastmod><priority>0.6</priority><changefreq>yearly</changefreq></url>';}

/* 0.6 issue内部主题存档 */
$a6=array('http://e.v-get.com/issue/godaddy.html','http://e.v-get.com/issue/editor.html');
foreach($a6 as $i=>$a){$text.='<url><loc>'.$a.'</loc><lastmod>2013-03-06T02:14:48+08:00</lastmod><priority>0.6</priority><changefreq>yearly</changefreq></url>';}
$text_all.=$text;
$text=$top.$text.'</urlset>';
file_put_contents($file,$text);
}
/*———————————————————————————————其他结束 —————————————————————————————*/

/*———————————————————————————————tech —————————————————————————————*/
$file=constant('uploadFile').'z/sitemap_tech.xml';$fp=fopen($file,'w+');
if(is_writable($file)==false) {die("z/sitemap_tech.xml");exit;}
else{
$text='<url><loc>http://e.v-get.com/tech/</loc><lastmod>'.$now.'+08:00</lastmod><priority>1</priority><changefreq>weekly</changefreq></url><url><loc>http://e.v-get.com/tech/u/</loc><lastmod>2013-03-06T02:14:48+08:00</lastmod><priority>0.7</priority><changefreq>yearly</changefreq></url>';
/* 0.9 的 每月更新，$now要减一个月 */
$a9=array_merge($TECH_I_sitemap,$TECH_I_TOP_sitemap);
foreach($a9 as $tech_i=>$a){
$Qy=mysql_query('SELECT COUNT(*) FROM f2013 WHERE '.$a[0],$QC);$Qz=mysql_fetch_array($Qy);$Qt=$Qz[0];$Pz=ceil($Qt/constant('TECH_I_page_article'));
for($i=1;$i<$Pz;$i++){
$text.='<url><loc>http://e.v-get.com/tech/'.$tech_i.'_'.$i.'.html</loc><lastmod>'.$now.'+08:00</lastmod><priority>0.7</priority><changefreq>monthly</changefreq></url>';
}
}
$Qs='SELECT m FROM f2013 WHERE m!="V-Get" GROUP BY m';$Qq=mysql_query($Qs,$QC);
while($Qa=mysql_fetch_array($Qq)){
$M=$Qa['m'];
$text.='<url><loc>http://e.v-get.com/tech/u/'.$M.'_1.html</loc><lastmod>'.$now.'+08:00</lastmod><priority>0.6</priority><changefreq>monthly</changefreq></url>';
}


/* 0.5 文章存档 */
$Qs='SELECT i,t FROM f2013 ORDER BY i DESC';$Qq=mysql_query($Qs,$QC);
while($Qa=mysql_fetch_array($Qq)){
$T=$Qa['t'];$T=strtotime($T);$t=date('Ymd/His',$T);$td=date("Y-m-d\TH:i:s",$T);
$text.='<url><loc>http://e.v-get.com/tech/'.$t.$Qa['i'].'.html</loc><priority>0.5</priority><lastmod>'.$td.'+08:00</lastmod><changefreq>yearly</changefreq></url>';}


$text_all.=$text;
$text=$top.$text.'</urlset>';
file_put_contents($file,$text);
}
/*———————————————————————————————tech 结束—————————————————————————————*/






/*———————————————————————————————tech 搜索—————————————————————————————*/
$file=constant('uploadFile').'z/sitemap_tag.xml';$fp=fopen($file,'w+');
if(is_writable($file)==false) {die("z/sitemap_tech.xml");exit;}
else{
$text='<url><loc>http://e.v-get.com/tech/</loc><lastmod>'.$now.'+08:00</lastmod><priority>1</priority><changefreq>weekly</changefreq></url>';

$key_arr='';
$Qs='SELECT k FROM f2013';$Qq=mysql_query($Qs,$QC);
while($Qa=mysql_fetch_array($Qq)){$key_arr.=','.$Qa['k'];}
$key_arr=substr($key_arr,1);
$key_arr=explode(',',$key_arr);
$key_arr=array_flip(array_flip($key_arr));
foreach($key_arr as $keys=>$key){

$text.='<url><loc>http://e.v-get.com/s?sk='.$key.'</loc><priority>0.3</priority><lastmod>'.$now.'+08:00</lastmod><changefreq>monthly</changefreq></url>';
}
$text_all.=$text;
$text=$top.$text.'</urlset>';
file_put_contents($file,$text);
}
/*———————————————————————————————tech 搜索 结束—————————————————————————————*/





/*———————————————————————————————论坛 —————————————————————————————*/
$file=constant('uploadFile').'z/sitemap_i.xml';$fp=fopen($file,'w+');
if(is_writable($file)==false) {die("z/sitemap_i.xml");exit;}
else{
$text='<url><loc>http://e.v-get.com/i/</loc><lastmod>'.$now.'+08:00</lastmod><priority>1</priority><changefreq>weekly</changefreq></url>';

$QsGroup='SELECT fid FROM dc_forum_forum where type="group" AND status=1';$QqGroup=mysql_query($QsGroup,$QC);
while($QaGroup=mysql_fetch_array($QqGroup)){
$text.='<url><loc>http://e.v-get.com/i/bbs-'.$QaGroup['fid'].'.html</loc><priority>0.8</priority><lastmod>2013-06-24T02:14:48+08:00</lastmod><changefreq>yearly</changefreq></url>';
}

$QsClass='SELECT fid FROM dc_forum_forum where type="forum" AND status=1';$QqClass=mysql_query($QsClass,$QC);
while($QaClass=mysql_fetch_array($QqClass)){
$text.='<url><loc>http://e.v-get.com/i/topic-'.$QaClass['fid'].'-1.html</loc><priority>0.7</priority><lastmod>'.$now.'+08:00</lastmod><changefreq>weekly</changefreq></url>';
}

$QsUser='SELECT author FROM dc_forum_thread GROUP BY authorid';$QqUser=mysql_query($QsUser,$QC);
while($QaUser=mysql_fetch_array($QqUser)){
$text.='<url><loc>http://e.v-get.com/i/'.$QaUser['author'].'</loc><priority>0.7</priority><lastmod>'.$now.'+08:00</lastmod><changefreq>monthly</changefreq></url>';
}

$QsBBS='SELECT tid,dateline FROM dc_forum_thread ORDER BY tid DESC';$QqBBS=mysql_query($QsBBS,$QC);
while($QaBBS=mysql_fetch_array($QqBBS)){
$T=$QaBBS['dateline'];$td=date("Y-m-d\TH:i:s",$T);
$text.='<url><loc>http://e.v-get.com/i/tip-'.$QaBBS['tid'].'-1.html</loc><priority>0.3</priority><lastmod>'.$td.'+08:00</lastmod><changefreq>yearly</changefreq></url>';
}
$text_all.=$text;
$text=$top.$text.'</urlset>';
file_put_contents($file,$text);
}
/*———————————————————————————————论坛结束 —————————————————————————————*/







$text_all=$top.$text_all.'</urlset>';


file_put_contents($file_all,$text_all);
?>