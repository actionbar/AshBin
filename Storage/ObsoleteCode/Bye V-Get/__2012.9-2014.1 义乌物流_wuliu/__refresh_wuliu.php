<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<p>&nbsp;</p><p>&nbsp;</p>
<h1>需等待图标加载完全后再执行下一步！！！——————</h1><div><form><select name="uploadfile" style="color:#00F"><option value="">本地Localhost</option><option value="uploadfile">上传file</option><input type="submit"/></select></form></div>
<hr>
<?php
/* <a href="?sure=ok">更新(e\.v-get\.com\/.+\/)([a-z_\d-]+)(\.[a-z]+)<\/a> 替换成  <a href="http://localhost/$1_$2.php">更新$1$2$3</a>*/
$right_first=array('http://localhost/www.v-get.com/wuliu/news/__.php'=>'最先替换：http://localhost/www.v-get.com/wuliu/news/__.html','http://localhost/www.v-get.com/wuliu/ct/_co.php'=>'替换ct/_co.php页面的相似推荐企业');
$index=array('http://localhost/www.v-get.com/wuliu/_co.php'=>'http://localhost/www.v-get.com/wuliu/co.php','http://localhost/www.v-get.com/wuliu/_co301.php'=>'http://localhost/www.v-get.com/wuliu/co301.php');
$news=array('http://localhost/www.v-get.com/wuliu/news/_f.php'=>'http://localhost/www.v-get.com/wuliu/news/f.php');
$ct=array('http://localhost/www.v-get.com/wuliu/ct/_ct_index.php'=>'wuliu/ct/ct.html 替换所有分页','http://localhost/www.v-get.com/wuliu/ct/_ct.php'=>'wuliu/ct/ct.php 替换所有分页');
$sitemap=array('http://localhost/www.v-get.com/wuliu/_/sitemap_ct.php'=>'wuliu/_/sitemap_ct.php 城市网站地图');
$PAGES=array_merge($right_first,$index,$news,$ct,$sitemap);


if(isset($_GET['sure']))
{
$T=date('Y-m-d H:i:s');
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('vwuliu',$QC);mysql_query('set names utf8');
$Qqo=mysql_query('SELECT i,p,m,e,v FROM c WHERE p>0',$QC);
/* 因为系统问题，如果全部更新会很慢，所以只对有p的更新
只对没有头像p的random一次，update c set o=RAND()*50 WHERE p==0 
RAND()*50+$V*50+$E?50:0+$M?50:0+论坛积分/10
*/
while($Qao=mysql_fetch_array($Qqo)){
$M=0;$Credits=0;
$E=empty($Qao['e'])?0:50;
$V=$Qao['v']*50;
if(!empty($Qao['m'])){$M=50;$Qqdz=mysql_query('SELECT credits FROM dz_common_member WHERE username="'.$Qao['m'].'"');$Qadz=mysql_fetch_array($Qqdz);$Qrdz=mysql_num_rows($Qqdz);if($Qrdz>0){$Credits=$Qadz['credits'];$Credits/=10;}
}
$O=rand(0,50);$O+=50+$M+$E+$V+$Credits;$O=floor($O);
mysql_query('UPDATE c SET o='.$O.', t="'.$T.'"'.' WHERE i='.$Qao['i']);
}




echo '<p style="color:#F00">数据库o排序更新完成</p>';


foreach($PAGES as $i=>$v){
//因为经常localhost和 远程共用，所以会出现用Localhost生成的__.html是localhost路径，这里对于需要直接修改单个页面的，需要重新修改一次右侧
//用 rightok 就可以避免内页单独更新时需要独立更新一次 __.php了
echo '<iframe src="',$i,'?sure=ok&rightok=ok" style="width:80px;height:80px;border:0" scrolling="auto"></iframe>';
}
echo '<p>等待加载完毕，看ico图标，加载完毕后再跳转！！！</p></p><p>news/i.php  f.php i2.php ig.php 必须要先修改news/__.php之后生成的_.html之后，修改完这个html之后，再修改 ，请到页面内对照news/f.php 修改 news/_.html</p>';
}




$GO_LOCAL_file='_/_GO_LOCAL.php';

if(isset($_GET['uploadfile'])){

if (is_writable($GO_LOCAL_file) == false) {die("文件没有找到");exit;}
else {
if($_GET['uploadfile']==''||$_GET['uploadfile']=='localhost'){$text='<?php define(\'GO_LOCAL\',\'\');?>';echo '<p style="color:#FF0000">当前生成：<strong style="color:#0C0">Localhost</strong>本地</p>';}
else {$text='<?php define(\'GO_LOCAL\',\'uploadfile\');?>';echo '<p style="color:#FF0000">当前生成：<strong style="color:#0C0">Upload</strong>上传页面</p>';}
file_put_contents($GO_LOCAL_file,$text);}}
else {require $GO_LOCAL_file;$isupld=constant('GO_LOCAL');$isupld=($isupld=='uploadfile')?'uploadfile文件':'localhost本地';echo '<p style="color:#FF0000">当前生成：<strong style="color:#0C0">'.$isupld.'</strong></p>';}

echo '<h2><a href="?sure=ok">确定更新所有的页面？</a></h2><hr>';
foreach($PAGES as $i=>$v){echo '<p><a href="',$i,'">',$v,'</a></p>';}



$COs=array('http://localhost/www.v-get.com/wuliu/co/_index.php'=>'co/index.php  yiwukb.wuliu.v-get.com','http://localhost/www.v-get.com/wuliu/co/_about.php'=>'co/about.php','http://localhost/www.v-get.com/wuliu/co/_certificate.php'=>'co/certificate.php','http://localhost/www.v-get.com/wuliu/co/_contact.php'=>'co/contact.php','http://localhost/www.v-get.com/wuliu/co/_exhibition.php'=>'co/exhibition.php','http://localhost/www.v-get.com/wuliu/co/_faq.php'=>'co/faq.php','http://localhost/www.v-get.com/wuliu/co/_honor.php'=>'co/honor.php','http://localhost/www.v-get.com/wuliu/co/_logistics.php'=>'co/logistics.php','http://localhost/www.v-get.com/wuliu/co/_news.php'=>'co/news.php','http://localhost/www.v-get.com/wuliu/co/_services.php'=>'co/services.php','http://localhost/www.v-get.com/wuliu/co/_sitemap.php'=>'co/sitemap.php');
if(isset($_GET['cos'])){
foreach($COs as $i=>$v){

echo '<iframe src="',$i,'?sure=ok&rightok=ok" style="display:none"></iframe>';
}


}
echo '<hr>三级域名yiwukb.wuliu.v-get.com ，不需要经常更新<hr><p><a href="?cos=ok">确定更新所有三级域名的页面？</a></p>';
foreach($COs as $i=>$v){echo '<p><a href="',$i,'">',$v,'</a></p>';}

?>