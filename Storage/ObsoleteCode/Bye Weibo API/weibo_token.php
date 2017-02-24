<?php

// 通过登录界面点击下面，设置session的cookie
//https://api.weibo.com/oauth2/authorize?client_id=00000&response_type=code&redirect_uri=http%3A%2F%2Fwww.luexu.com%2Fa%2Fapi%2Fsinawbtoken.php

// x= sina/qq  e=e/wuliu  用于区分不同token
if(!isset($_GET['e'])||!isset($_GET['x'])||!isset($_GET['t'])){exit();}
$e=$_GET['e'];
$x=$_GET['x'];
$token_json=$_GET['t'];
$token=json_decode($token_json,true);
//{"access_token":"2.00_X13sDWhoXzD05fsfsdfd0o6T7gB","remind_in":"670586","expires_in":670586,"uid":"00000"}
//access_token =token，expires_in  = 失效日期，uid =授权的uid

$uid=$token['uid'];
$access_token=$token['access_token'];
$expires=$token['expires_in'];
$expires+=time();
// token_esinas000000
$cookie='token_'.$e.'_'.$x.$uid;

// 设置为时间的，否则不知道过期起点时间，uid被写入文件夹
$text='{"access_token":"'.$access_token.'","expires":'.$expires.'}';


// 由于跨浏览器，所以cookie必须要写入文件
$file='token/'.$cookie.'.txt';
$fp=fopen($file,'w+');
if(is_writable($file)==false) {die($file);exit;}
else{file_put_contents($file,$text);echo '&#25104;&#21151;&#20889;&#20837; '.$file;}



?>