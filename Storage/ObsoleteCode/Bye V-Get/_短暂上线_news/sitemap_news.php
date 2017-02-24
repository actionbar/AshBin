<?php
//2012-09-30     mb.xml      2==b   站点上链接越重要，那么priority应该越高，主页一般为1，view 到最后应该为0.5以上
$c=mysql_connect("localhost","root","qwdw114");mysql_select_db("v7",$c);  mysql_query("set names utf8");
echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9  http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';


$d=date("Y-m-d\TH:i:s");
$ry=mysql_query('SELECT COUNT(*) FROM f');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/20);$Pz++;
for ($i=1;$i<$Pz;$i++){echo '<url><loc>http://news.v-get.com/list/index_'.$i.'.html</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}
//最新 WHERE t>"2012-10-24 04:20:32"   数据库自动更新t： on update CURRENT_TIMESTAMP，任何修改过程都会修改t 
$rq=mysql_query('SELECT * FROM f WHERE t>"2012-10-24 04:20:32" ORDER BY i DESC');
while($r=mysql_fetch_array($rq)){$t=$r['t'];$t=strtotime($t);$e=date("Y-m-d\TH:i:s",$t);
echo '<url><loc>http://news.v-get.com/view/'.$r['i'].'.html</loc><news:news><news:publication><news:name>商务新闻_V-Get!</news:name><news:language>zh-cn</news:language></news:publication><news:genres>PressRelease, Blog</news:genres><news:publication_date>'.$e.'+08:00</news:publication_date><news:title>'.$r['h'].'</news:title><news:keywords>'.$r['k'].'</news:keywords></news:news></url>';
}
echo '</urlset>';

?>