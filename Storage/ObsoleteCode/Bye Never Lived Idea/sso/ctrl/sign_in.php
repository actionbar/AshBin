<?php
require '../../api.luexu.com/c_tf.php';


if(empty($_POST['account'])){
    echo '没有传值';
    exit();

}


$SignInSt = new \Tf\Sso\SignInSt();
$SignInSt->account = $_POST['account'];
$SignInSt->account_type = $_POST['accounttype'];
$SignInSt->pwd = $_POST['pwd'];
$SignInSt->captcha = $_POST['captcha'];
$TfSsoSign = new \Ctrl\TfSsoSign();
try{
    $sign_info = $TfSsoSign->signIn($SignInSt);
    $sign_in_url = 'http://www.luexu.com/sso/sign_in.html';
    $refer = empty($_SERVER["HTTP_REFERER"]) || $sign_in_url == $_SERVER["HTTP_REFERER"] ? '跳转' : $_SERVER["HTTP_REFERER"];
    echo 'Login-Success - Do Url Jump To ', $refer;

}
catch(\Tf\Sso\Err $Err){
echo 'Error Code: ', $Err->id, '; Error Message: ', $Err->msg;

}