<?php
$L=$_POST['v'];
$L=gethostbyname($L);
$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$L);curl_exec($ch);curl_close($ch);
?>