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
$text='<?php '.constant('CO_SQL').'$Qq=mysql_query(\'SELECT b,h,he,k,r,q,s,p,lt,x,y,z,zz,t,adt,tj FROM co WHERE e="\'.$E.\'" LIMIT 1\');$Qr=mysql_num_rows($Qq);if($Qr==0){header(\'Location: http://wuliu.v-get.com/\');exit();}$Qa=mysql_fetch_array($Qq);$B=$Qa[\'b\'];$H=$Qa[\'h\'];$K=$Qa[\'k\'];$Z=$Qa[\'z\'];$LT=$Qa[\'lt\'];$TA=$Qa[\'adt\'];$now=time();$ad=($TA>$now)?false:true;echo \'<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>联系我们_\',$H,\'_\',$Z,$K,\'_商务物流网_V-Get!</title><meta name="keywords" content="\',$K,\'" /><meta name="description" content="\',$H,\'联系方式。我们专注于\',$Z,$Qa[\'r\'],\'"/>\';?>'.COTUN($filename).'<div class="q r"><div class="o mh"></div><div class="m cc"><div>您现在的位置：<?php echo \'<a href="http://\',$E,\'.wuliu.v-get.com/">\',$H,\'</a>\';?> &gt; 企业荣誉</div></div><div class="mf"><?php echo $Qa[\'s\'],\'<p>\网　址：\',$E,\'.wuliu.v-get.com\';?><div class="o mh"></div><div id="map"></div><script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script><script type="text/javascript">(function(){var m=new BMap.Map("map"),p=new BMap.Point(<?php echo $Qa[\'p\'];?>),k=new BMap.Marker(p),w;m.centerAndZoom(p,13);m.enableScrollWheelZoom();m.addControl(new BMap.NavigationControl());m.addControl(new BMap.ScaleControl());m.addControl(new BMap.OverviewMapControl());m.addOverlay(k);<?php echo \'w=new BMap.InfoWindow(\',"\'",\'<div class="map"><img src="http://'.constant('localhost').'tp.v-get.com/j/3/co/70/\',$E,\'.gif" /><ul>\',$Qa[\'r\'],\'<li>网　址：\',$E,\'.wuliu.v-get.com</li></ul></div>\',"\'",\',{title:"\',$H,\'"});\';?>k.openInfoWindow(w);k.addEventListener($7,function(){this.openInfoWindow(w);})})()</script></div></div><div class="o mh"></div>'.constant('CO_VBB');
file_put_contents($file,$text);}
?>