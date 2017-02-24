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
   z/ct_sitemap.xml
   z/ct_sitemap_tag.xml 搜索
   sitemap_wuliu 在tp内，全部都收录
   */
$top='<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'; 
foreach($SUB_CT as $cts=>$cta){
$ct=$cta[1];
$file=constant('uploadFile').'z/'.$ct.'.xml';
$fp=fopen($file,'w+');
if(is_writable($file)==false) {die('wuliu='.$ct.'.xml');exit;}
else{
$text='';
$act=array('http://'.$ct.'.wuliu.v-get.com/','http://'.$ct.'.wuliu.v-get.com/news/','http://'.$ct.'.wuliu.v-get.com/tuoyun/','http://'.$ct.'.wuliu.v-get.com/cangku/','http://'.$ct.'.wuliu.v-get.com/banjia/','http://'.$ct.'.wuliu.v-get.com/huoche/','http://'.$ct.'.wuliu.v-get.com/keyun/','http://'.$ct.'.wuliu.v-get.com/join/','http://'.$ct.'.wuliu.v-get.com/shebei/','http://'.$ct.'.wuliu.v-get.com/huodai/');
foreach($act as $i=>$a){$text.='<url><loc>'.$a.'</loc><lastmod>2013-03-06T02:14:48+08:00</lastmod><priority>1</priority><changefreq>monthly</changefreq></url>';}

$text=$top.$text.'</urlset>';
file_put_contents($file,$text);
}
  } 
?>