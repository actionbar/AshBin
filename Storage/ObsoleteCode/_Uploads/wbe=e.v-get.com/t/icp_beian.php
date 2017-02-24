<?php
$L=$_POST['v'];
$L='http://www.icpchaxun.com/beian.aspx?icpType=-1&icpValue='.$L;
$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$L);curl_exec($ch);
?>