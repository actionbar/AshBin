<?php
header("Content-type: text/html; charset=utf-8");
if(empty($_GET['f'])||empty($_GET['t'])){
//echo'<script>location.replace ("http://www.v-get.com/") </script>';
echo $_GET['f'];echo $_GET['t'];
echo 'no1';
exit();}
$u=$_GET['f'];
$f=urlencode($u);
$t=$_GET['t'];
$s=str_replace('%','',$f);$s=strtolower($s); 
$S='f/'.$s.'.'.$t; 
$z=filesize($S);$u=urldecode($u);
$N=$u.'_V-Get.'.$t;
if(!file_exists($S)){
//echo '<script>location.replace("http://baike.v-get.com/")</script>';
echo '<br />no2';
exit;   
}
else{ 
$F=fopen($S,'r');
Header('Content-type:application/octet-stream');
Header('Accept-Ranges:bytes');
Header('Accept-Length:'.$z);
Header('Content-Disposition:attachment;filename*="utf8\'\''.$N.'"');
echo fread($F,$z);
fclose($F);
exit();}
?>