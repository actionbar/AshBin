<?php
$L=$_POST['v'];
$L="http://data.alexa.com/data/?cli=10&dat=snba&ver=7.0&url=".$L;
$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$L);curl_exec($ch);
?>