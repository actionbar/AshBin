<?php
require '../../api.luexu.com/c_tf.php';


$TfSsoSign = new \Ctrl\TfSsoSign();
try{
$sign_info = $TfSsoSign->signOut();
$sign_in_url = 'http://www.luexu.com/sso/sign_in.html';
$refer = empty($_SERVER["HTTP_REFERER"]) || $sign_in_url == $_SERVER["HTTP_REFERER"] ? '跳转' : $_SERVER["HTTP_REFERER"];
echo 'Sign Out Success - Do Url Jump To ', $refer;

}
catch(\Tf\Sso\Err $Err){
echo 'Error Code: ', $Err->id, '; Error Message: ', $Err->msg;

}