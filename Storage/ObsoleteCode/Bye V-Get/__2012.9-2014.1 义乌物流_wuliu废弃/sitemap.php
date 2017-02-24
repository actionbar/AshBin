<?php
require('c.php');

$boo=0;


echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
//<url><loc>http://wuliu.v-get.com/baike/chepai.html</loc><priority>0.8</priority><lastmod>2012-10-24T04:25:35+08:00</lastmod><changefreq>yearly</changefreq></url><url><loc>http://wuliu.v-get.com/baike/countrycode.html</loc><priority>0.8</priority><lastmod>2012-10-24T04:25:35+08:00</lastmod><changefreq>yearly</changefreq></url><url><loc>http://wuliu.v-get.com/line/ports.html</loc><priority>0.8</priority><lastmod>2012-10-24T04:25:35+08:00</lastmod><changefreq>yearly</changefreq></url><url><loc>http://wuliu.v-get.com/line/</loc><priority>0.8</priority><lastmod>2012-10-24T04:25:35+08:00</lastmod><changefreq>monthly</changefreq></url><url><loc>http://wuliu.v-get.com/line/shiplist.html</loc><priority>0.8</priority><lastmod>2012-10-24T04:25:35+08:00</lastmod><changefreq>monthly</changefreq></url><url><loc>http://wuliu.v-get.com/price/sh12306.html</loc><priority>0.8</priority><lastmod>2012-10-28T04:25:35+08:00</lastmod><changefreq>yearly</changefreq></url><url><loc>http://wuliu.v-get.com/price/jinhua12306.html</loc><priority>0.8</priority><lastmod>2012-10-28T04:25:35+08:00</lastmod><changefreq>yearly</changefreq></url><url><loc>http://wuliu.v-get.com/price/yiwu-tuoyun.html</loc><priority>0.3</priority><lastmod>2012-10-28T04:25:35+08:00</lastmod><changefreq>yearly</changefreq></url><url><loc>http://wuliu.v-get.com/price/sh-tuoyun.html</loc><priority>0.3</priority><lastmod>2012-10-28T04:25:35+08:00</lastmod><changefreq>yearly</changefreq></url>
$d=date("Y-m-d\TH:i:s");
$ry=mysql_query('SELECT COUNT(*) FROM c');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/13);$Pz++;
//每周会自动刷新o，所以这个是周变
for ($i=1;$i<$Pz;$i++){echo '<url><loc>http://wuliu.v-get.com/index_'.$i.'.html</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

//最新 WHERE t>"2012-10-28 07:10:47"  html 格式的，类似百科那种列表，就是最好的html网站地图
$rq=mysql_query('SELECT * FROM c WHERE t>"2012-10-28 07:10:47" ORDER BY i DESC');
while($r=mysql_fetch_array($rq)){
echo '<url><loc>http://wuliu.v-get.com/'.$r['i'].'</loc><priority>0.5</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>yearly</changefreq></url>';}
echo '</urlset>';


?>