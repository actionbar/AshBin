<?php
$L=$_POST['v'];
$L= 'http://panda.www.net.cn/cgi-bin/check_muitl.cgi?domain='.$L;
$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$L);curl_exec($ch);
?>