<?php
$Qc=mysql_connect('localhost','bk020vgt','VGTmm_258_v');mysql_select_db('v2',$Qc);mysql_query('set names utf8');
$site=$_GET['s'];
echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
if($site=='baike.v-get.com'){
$Qq=mysql_query('SELECT i,t FROM f ORDER BY t DESC');
while($Qa=mysql_fetch_array($Qq))
{$T=$Qa['t'];$t=strstr(' ','T',$T);
echo '<url><loc>http://baike.v-get.com/view/',$Qa['i'],'.html</loc><priority>0.8</priority><lastmod>',$t,'+08:00</lastmod><changefreq>yearly</changefreq></url>';}
echo '</urlset>';exit();
}

if($site=='yiwuwuliu.baike.v-get.com'){

$Qy=mysql_query('SELECT count(*) FROM f WHERE s=3 AND b=330782');
$Qz=mysql_fetch_array($Qy);$Qt=$Qz[0];$Pz=ceil($Qt/10);$Pz++;
for($i=1;$i<$Pz;++$i){
echo '<url><loc>http://yiwuwuliu.baike.v-get.com/logistics/index_',$i,'.html</loc><priority>0.8</priority><lastmod>2013-03-03T07:25:35+08:00</lastmod><changefreq>monthly</changefreq></url>';}
echo '</urlset>';exit();
}
?>