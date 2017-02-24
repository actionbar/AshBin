<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<p>&nbsp;</p><p>&nbsp;</p>
<h1>需等待图标加载完全后再执行下一步！！！——————</h1><div><form><select name="uploadfile" style="color:#00F"><option value="">本地Localhost</option><option value="uploadfile">上传file</option><input type="submit"/><a href="__refresh_e.php?zip_and_upload=ok">压缩并上传</a></select></form></div>
<hr>
<?php

// 压缩并上传
if(isset($_GET['zip_and_upload'])&&'ok'==$_GET['zip_and_upload']){
$ROOT=$_SERVER['DOCUMENT_ROOT'];
require($ROOT.'_global/_global.php');
$c_compress_zip=new compress_zip();

$c_compress_zip->path_zip($_SERVER['DOCUMENT_ROOT'].'_Uploads/wbe=e.v-get.com/',$_SERVER['DOCUMENT_ROOT'].'_zip4uploads/e.v-get.com.zip');
}


/* <a href="?sure=ok">更新(e\.v-get\.com\/.+\/)([a-z_\d-]+)(\.[a-z]+)<\/a> 替换成  <a href="http://localhost/$1_$2.php">更新$1$2$3</a>*/
$right_first=array('http://localhost/www.v-get.com/e/tech/__.php'=>'最先替换：http://localhost/e.v-get.com/tech/_.html','http://localhost/www.v-get.com/e/z/__.php'=>'最先替换：http://localhost/e.v-get.com/z/_.html');
$w3c=array('http://localhost/www.v-get.com/e/w3c/_index.php'=>'w3c/index.html首页','http://localhost/www.v-get.com/e/w3c/_sub.php'=>'w3c/sub.php HTML.html','http://localhost/www.v-get.com/e/w3c/_f.php'=>'w3c/f.php内页');
$pages=array('http://localhost/www.v-get.com/e/_/sitemap.php'=>'网站地图：e.v-get.com/sitemap.xml','http://localhost/www.v-get.com/e/_/rss.php'=>'RSS订阅：e.v-get.com/z/rss/**.xml','http://localhost/www.v-get.com/e/_index.php'=>'e.v-get.com/index.html','http://localhost/www.v-get.com/e/services/_index.php'=>'e.v-get.com/services/','http://localhost/www.v-get.com/e/_s.php'=>'e.v-get.com/s?sk=搜索','http://localhost/www.v-get.com/e/host/_index.php'=>'e.v-get.com/host/index.html','http://localhost/www.v-get.com/e/host/_cloud.php'=>'e.v-get.com/host/cloud.html','http://localhost/www.v-get.com/e/host/_domain.php'=>'e.v-get.com/host/domain.html','http://localhost/www.v-get.com/e/host/_free.php'=>'e.v-get.com/host/free.html','http://localhost/www.v-get.com/e/host/_icp_beian.php'=>'e.v-get.com/host/icp_beian.html','http://localhost/www.v-get.com/e/host/_server.php'=>'e.v-get.com/host/server.html','http://localhost/www.v-get.com/e/host/_virtual.php'=>'e.v-get.com/host/virtual.html','http://localhost/www.v-get.com/e/host/_vps.php'=>'e.v-get.com/host/vps.html','http://localhost/www.v-get.com/e/soho/_index.php'=>'e.v-get.com/soho/index.html','http://localhost/www.v-get.com/e/soho/_kefu.php'=>'e.v-get.com/soho/kefu.html','http://localhost/www.v-get.com/e/soho/_kefu_call.php'=>'e.v-get.com/soho/kefu_call.html','http://localhost/www.v-get.com/e/soho/_kefu_callcenter.php'=>'e.v-get.com/soho/kefu_callcenter.html','http://localhost/www.v-get.com/e/soho/_kefu_online.php'=>'e.v-get.com/soho/kefu_online.html','http://localhost/www.v-get.com/e/soho/_kefu_partime.php'=>'e.v-get.com/soho/kefu_partime.html','http://localhost/www.v-get.com/e/soho/_kefu_sales.php'=>'e.v-get.com/soho/kefu_sales.html','http://localhost/www.v-get.com/e/soho/_kefu_telesales.php'=>'e.v-get.com/soho/kefu_telesales.html','http://localhost/www.v-get.com/e/open/_index.php'=>'e.v-get.com/open/index.html','http://localhost/www.v-get.com/e/open/_php.php'=>'e.v-get.com/open/php.html','http://localhost/www.v-get.com/e/open/_php-files.php'=>'e.v-get.com/open/php-files.html','http://localhost/www.v-get.com/e/open/_php-filename.php'=>'e.v-get.com/open/php-filename.html','http://localhost/www.v-get.com/e/open/_php-frame.php'=>'e.v-get.com/open/php-frame.html','http://localhost/www.v-get.com/e/open/_php-shop.php'=>'e.v-get.com/open/php-shop.html','http://localhost/www.v-get.com/e/open/_php-social.php'=>'e.v-get.com/open/php-social.html','http://localhost/www.v-get.com/e/open/_php-cms.php'=>'e.v-get.com/open/php-cms.html','http://localhost/www.v-get.com/e/open/_php-soft.php'=>'e.v-get.com/open/php-soft.html','http://localhost/www.v-get.com/e/sem/_index.php'=>'e.v-get.com/sem/index.html','http://localhost/www.v-get.com/e/soft/_index.php'=>'e.v-get.com/soft/index.html','http://localhost/www.v-get.com/e/tool/_index.php'=>'e.v-get.com/tool/index.html','http://localhost/www.v-get.com/e/tool/_i.php'=>'e.v-get.com/tool/i.php','http://localhost/www.v-get.com/e/vi/_index.php'=>'e.v-get.com/vi/index.html','http://localhost/www.v-get.com/e/web/_index.php'=>'e.v-get.com/web/index.html','http://localhost/www.v-get.com/e/web/_service.php'=>'e.v-get.com/web/service.html','http://localhost/www.v-get.com/e/web/_service_a1.php'=>'e.v-get.com/web/service_a1.html','http://localhost/www.v-get.com/e/web/_service_a2.php'=>'e.v-get.com/web/service_a2.html','http://localhost/www.v-get.com/e/web/_service_a3.php'=>'e.v-get.com/web/service_a3.html','http://localhost/www.v-get.com/e/web/_service_b1.php'=>'e.v-get.com/web/service_b1.html','http://localhost/www.v-get.com/e/web/_service_b2.php'=>'e.v-get.com/web/service_b2.html','http://localhost/www.v-get.com/e/web/_service_b3.php'=>'e.v-get.com/web/service_b3.html','http://localhost/www.v-get.com/e/web/_service_b5.php'=>'e.v-get.com/web/service_b5.html','http://localhost/www.v-get.com/e/tech/_index.php'=>'e.v-get.com/tech/index.html','http://localhost/www.v-get.com/e/tech/u/_index.php'=>'e.v-get.com/tech/u/index.html');
$techf=array('http://localhost/www.v-get.com/e/tech/_f.php'=>'e.v-get.com/tech/f.php','http://localhost/www.v-get.com/e/tech/_i.php'=>'e.v-get.com/tech/i.php','http://localhost/www.v-get.com/e/tech/_i2.php'=>'e.v-get.com/tech/i2.php','http://localhost/www.v-get.com/e/tech/_ig.php'=>'e.v-get.com/tech/ig.php','http://localhost/www.v-get.com/e/tech/u/_i.php'=>'e.v-get.com/tech/u/i.php');
$issue=array('http://localhost/www.v-get.com/e/issue/_godaddy.php'=>'e.v-get.com/issue/godaddy.html');
$zsitemap=array('http://localhost/www.v-get.com/e/z/_index.php'=>'http://localhost/www.v-get.com/e/z/_index.php html格式导航','http://localhost/www.v-get.com/e/z/_link.php'=>'http://localhost/www.v-get.com/e/z/_link.php 外链','http://localhost/www.v-get.com/e/z/_about.php'=>'http://localhost/www.v-get.com/e/z/_about.php 关于我们');
$PAGES=array_merge($right_first,$w3c,$pages,$techf,$issue,$zsitemap);


if(isset($_GET['sure']))
{
foreach($PAGES as $i=>$v){
//因为经常localhost和 远程共用，所以会出现用Localhost生成的__.html是localhost路径，这里对于需要直接修改单个页面的，需要重新修改一次右侧
//用 rightok 就可以避免内页单独更新时需要独立更新一次 __.php了
echo '<iframe src="',$i,'?sure=ok&rightok=ok" style="width:80px;height:80px;border:0" scrolling="auto"></iframe>';
}
echo '<p>等待加载完毕，看ico图标，加载完毕后再跳转！！！</p></p><p>tech/i.php  f.php i2.php ig.php 必须要先修改tech/_.php之后生成的.html之后，修改完这个html之后，再修改 ，请到页面内对照tech/f.php 修改 tech/_.html</p>';



}

/* 一定要判断本地，否则PHP程序出错，经常会把远程目录出现localhost/网址*/
$GO_LOCAL_file='_/_GO_LOCAL.php';
if(isset($_GET['uploadfile'])){
if (is_writable($GO_LOCAL_file) == false) {die("文件没有找到");exit;}
else {
if($_GET['uploadfile']==''||$_GET['uploadfile']=='localhost'){$text='<?php define(\'GO_LOCAL\',\'\');?>';echo '<p style="color:#FF0000">当前生成：<strong style="color:#0C0">本地Localhost</strong></p>';}
else {$text='<?php define(\'GO_LOCAL\',\'uploadfile\');?>';echo '<p style="color:#FF0000">当前生成：<strong style="color:#0C0">服务器Upload</strong>上传页面</p>';}
file_put_contents($GO_LOCAL_file,$text);

}}
else {require $GO_LOCAL_file;$isupld=constant('GO_LOCAL');$isupld=($isupld=='uploadfile')?'uploadfile文件':'localhost本地';echo '<p style="color:#FF0000">当前生成：<strong style="color:#0C0">'.$isupld.'</strong></p>';}

echo '<h2><a href="?sure=ok">确定更新所有的页面？</a></h2><hr>';
foreach($PAGES as $i=>$v){echo '<p><a href="',$i,'">',$v,'</a></p>';}

?>