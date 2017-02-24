<?php
$L=$_POST['v'];
$L= 'http://panda.www.net.cn/cgi-bin/check_muitl.cgi?domain='.$L;
$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$L);curl_exec($ch);curl_close($ch);
//echo $h,'<br>';
//上面内容是：com|baidu.com|211|Domain name is not available
//$H=explode('|',$h);$e=$H[2];
//210 可以注册 211 已被注册  212 域名参数传输错误 213超时  214未知错误
//if($e=='210'){echo '<p class="f8">',$l,'：域名可以注册</p>';}
//else {echo '<p class="f9">',$l,'：域名已被注册</p>';}
?>