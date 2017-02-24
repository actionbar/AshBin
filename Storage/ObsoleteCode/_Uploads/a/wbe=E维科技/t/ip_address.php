<?php
$v=$_POST['v'];
$i=gethostbyname($v);
$x=file_get_contents('http://www.youdao.com/smartresult-xml/search.s?type=ip&q='.$i);
echo iconv("GBK","UTF-8",$x);
?>