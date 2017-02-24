<?php
require '_/global.php';
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve',$QC);mysql_query('set names "UTF-8"');


echo '';
exit;

$file=constant('uploadFile').'w3c/index.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$text='';
$text.=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'tech/f.css" /><head><title>W3CSchool 在线教程_'.constant('SITENAME_E').'_V-Get!</title><meta name="keywords" content="W3C,W3C 手册,W3C 教程,PHP教程,HTML教程,W3School,W3CSchool,CSS教程,JS教程"/>'.TUN('').'<div class="o mh"></div><div class="mg a960x60">'.constant('AD960x60pic').'</div><div class="v"><div class="w3cindex">';
$Qs2='SELECT * FROM w3c';$Qq2=mysql_query($Qs2);
while($Qa2=mysql_fetch_array($Qq2)){
$text.='<p><a href="'.constant('VE').'w3c/'.$Qa2['l'].'.html">'.$Qa2['h'].'</a></p>';
}
$text.='</div>';


$text.=constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.constant('TONGJI').'</script></div></body></html>';
file_put_contents ($file,$text); 
}

?>