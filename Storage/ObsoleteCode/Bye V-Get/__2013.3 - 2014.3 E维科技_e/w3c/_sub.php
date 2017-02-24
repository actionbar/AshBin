<?php
require '_/global.php';
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve',$QC);mysql_query('set names "UTF-8"');



$Qs='SELECT a FROM w3c GROUP BY a';$Qq=mysql_query($Qs);
while($Qa=mysql_fetch_array($Qq)){
$A=$Qa['a'];
$file=constant('uploadFile').'w3c/'.$A.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$text='';
$text.=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'tech/f.css" /><head><title>'.$A.' 教程_W3C手册_V-Get!</title><meta name="keywords" content="'.$A.','.$A.' 教程,W3C,W3C 手册,W3C 教程"/>'.TUN('').'<div class="o mh"></div><div class="mg a960x60">'.constant('AD960x60pic').'</div><div class="v"><div class="l"><div class="c"><div class="m mb">您的位置：<a href="'.constant('VE').'">首页</a>&nbsp;&gt;&gt;&nbsp;<a href="'.constant('VE').'w3c/">W3CSchool 教程</a>&nbsp;&gt;&gt;&nbsp;<a href="'.constant('VE').'w3c/'.$A.'.html">'.$A.' 教程</a>&nbsp;&gt;&gt;&nbsp;正文<span></span></div><div class="w3cl">';
$Qs2='SELECT * FROM w3c WHERE a="'.$A.'"';$Qq2=mysql_query($Qs2);
while($Qa2=mysql_fetch_array($Qq2)){
$text.='<p><a href="'.constant('VE').'w3c/'.$Qa2['l'].'.html">'.$Qa2['h'].'</a></p>';
}
$text.='</div></div></div><div class="r"></div>';


$text.=constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.constant('TONGJI').'</script></div></body></html>';
file_put_contents ($file,$text); 
}
}
?>