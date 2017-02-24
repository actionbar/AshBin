<?php
$Qc=mysql_connect('localhost','nsa1Ako','fch6895_EgN');mysql_select_db('v7',$Qc);mysql_query('set names utf8');
$site=$_GET['s'];


if($site=='news.v-get.com'){
echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9  http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
$Qq=mysql_query('SELECT i,h,k,t FROM f2013 ORDER BY t DESC');
while($Qa=mysql_fetch_array($Qq))
{$T=$Qa['t'];$t=strtotime($T);$YR=date('Y',$t);$TD=str_replace(' ','T',$T);

echo '<url><loc>http://news.v-get.com/',$YR,'/',$Qa['i'],'.html</loc><news:news><news:publication><news:name>商务新闻网_V-Get!</news:name><news:language>zh-cn</news:language></news:publication><news:genres>PressRelease, Blog</news:genres><news:publication_date>',$TD,'+08:00</news:publication_date><news:title>',$Qa['k'],'</news:title><news:keywords>',$Qa['k'],'</news:keywords></news:news><lastmod>',$TD,'+08:00</lastmod><changefreq>yearly</changefreq></url>';}
echo '</urlset>';exit();
}
echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
if($site=='yiwuwuliu.news.v-get.com'){

$Qy=mysql_query('SELECT count(*) FROM f2013 WHERE s=3 AND b=330782 ORDER BY t DESC');
$Qz=mysql_fetch_array($Qy);$Qt=$Qz[0];$Pz=ceil($Qt/10);$Pz++;
for($i=1;$i<$Pz;++$i){
echo '<url><loc>http://yiwuwuliu.news.v-get.com/logistics/index_',$i,'.html</loc><priority>0.8</priority><lastmod>2013-03-03T07:25:35+08:00</lastmod><changefreq>monthly</changefreq></url>';}
echo '</urlset>';exit();
}
?>