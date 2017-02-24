<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.php?</a>';
exit;
}
require '../_/co.php';
$file=constant('uploadFile').'/co/'.$filename.'.php';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$text='<?php '.constant('CO_SQL').'$Qq=mysql_query(\'SELECT b,h,he,k,d,r,q,n,lt,x,y,z,zz,t,adt,tj FROM co WHERE e="\'.$E.\'" LIMIT 1\');$Qr=mysql_num_rows($Qq);if($Qr==0){header(\'Location: http://wuliu.v-get.com/\');exit();}$Qa=mysql_fetch_array($Qq);$B=$Qa[\'b\'];$H=$Qa[\'h\'];$K=$Qa[\'k\'];$Z=$Qa[\'z\'];$LT=$Qa[\'lt\'];$TA=$Qa[\'adt\'];$now=time();$ad=($TA>$now)?false:true;echo \'<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>FAQ \',$Z,\'_\',$H,\'_\',$K,\'_商务物流网_V-Get!</title><meta name="keywords" content="\',$K,\'" /><meta name="description" content="\',$H,\'常见问题，主要经营\',$Z,$Qa[\'d\'],\'"/>\';?>'.COTUN($filename).'<div class="q r"><div class="o mh"></div><div class="m cc"><div>您现在的位置：<?php echo \'<a href="http://\',$E,\'.wuliu.v-get.com/">\',$H,\'</a>\';?> &gt; 常见问题</div></div><div class="mf"><?php echo $Qa[\'n\'];?></div></div><div class="o mh"></div>'.constant('CO_VBB');
file_put_contents($file,$text);}
?>