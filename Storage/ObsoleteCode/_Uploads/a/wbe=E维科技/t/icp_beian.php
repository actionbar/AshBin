<?php
$l=$_POST['v'];
$h= file_get_contents('http://api.befen.net/icp.php?domain='.$l);
echo iconv("GB2312","UTF-8",$h);
?>