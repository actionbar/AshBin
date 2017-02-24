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
$text='<?php '.constant('CO_SQL').'$Qq=mysql_query(\'SELECT b,h,he,k,m,f,r,q,lt,x,y,z,zz,t,adt,tj FROM co WHERE e="\'.$E.\'" LIMIT 1\');$Qr=mysql_num_rows($Qq);if($Qr==0){header(\'Location: http://wuliu.v-get.com/\');exit();}$Qa=mysql_fetch_array($Qq);$B=$Qa[\'b\'];$H=$Qa[\'h\'];$K=$Qa[\'k\'];$Z=$Qa[\'z\'];$LT=$Qa[\'lt\'];$TA=$Qa[\'adt\'];$now=time();$ad=($TA>$now)?false:true;echo \'<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>服务项目_\',$Z,\'_\',$H,\'_\',$K,\'_商务物流网_V-Get!</title><meta name="keywords" content="\',$K,\'" /><meta name="description" content="\',$Qa[\'m\'],\'"/>\';?>'.COTUN($filename).'<div class="q r"><div class="o mh"></div><div class="m cc"><div>您现在的位置：<?php echo \'<a href="http://\',$E,\'.wuliu.v-get.com/">\',$H,\'</a>\';?> &gt; 服务项目</div></div>
<?php echo \'<div class="a ca">\';$Qqi=mysql_query(\'SELECT * FROM coi WHERE e="\'.$E.\'" AND x=1\');while($Qai=mysql_fetch_array($Qqi)){$iP=$Qai[\'p\'];$iH=$Qai[\'h\'];echo \'<a href="http://'.constant('localhost').'\',$E,\'.wuliu.v-get.com/logistics/exhibition.html?i=1&show=\',$iP,\'"><img src="http://'.constant('localhost').'tp.v-get.com/j/3/co/205x110/\',$E,\'_\',$Qai[\'p\'],\'.jpg" width="205" height="110" alt="\',$iH,\'"/><br><strong>\',$iH,\'</strong><br>\',$Qai[\'d\'],\'</a>\';}echo \'</div><div class="o"></div>\';?><div class="mf"><?php echo $Qa[\'f\'];?></div></div><div class="o mh"></div>'.constant('CO_VBB');
file_put_contents($file,$text);}
?>