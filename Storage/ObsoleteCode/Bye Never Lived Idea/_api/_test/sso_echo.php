<?php

echo '内存使用：', memory_get_usage(), ' byte （未执行PHP代码）', PHP_EOL, '<br>', PHP_EOL;

/*
 * 用户浏览器信息 
 */
var_dump($_SERVER['HTTP_USER_AGENT']);

header("Content-Type: text/html;charset=utf-8");

include __DIR__ .'/../c_tf.php';




include \Conf\Server::DOCUMENT_ROOT . '/Ctrl/TfSsoSign.php';


$SsoSignHandle = new \Ctrl\TfSsoSign();

try{

    session_start();
    var_dump($_SESSION);

    $SignInSt = new \Tf\Sso\SignInSt();
    $SignInSt->account = '951173723@qq.com';
    $SignInSt->account_type = 3;
    $SignInSt->pwd = '123456';
    $SignInSt->captcha = '';
    //var_dump($SsoSignHandle->signIn($SignInSt));

    $sess_id = session_id();
    //$SsoSignCtrl->signOut($sess_id);


    
    //session_destroy();

    /*$SsoSignHandle->isAccountValid('951173723@qq.com', \Tf\Sso\AccountTypeEnum::EMAIL);*/

    /*$SsoSignHandle->sendVericodeForSignUp('951173723@qq.com', \Tf\Sso\AccountTypeEnum::EMAIL);*/
    /*$SsoSignHandle->sendVericode('951173723@qq.com', \Tf\Sso\AccountTypeEnum::EMAIL);*/
    /*$SsoSignHandle->sendVericode(null, \Tf\Sso\AccountTypeEnum::EMAIL);*/
    /*$SsoSignHandle->verify('NiimC5');*/
    /*$SsoSignHandle->initPwd('123456');*/

      //$SsoSignHandle->bind('云上旭', \Tf\Sso\AccountTypeEnum::USERNAME);
    /*$SsoSignHandle->bind('951173723@qq.com', \Tf\Sso\AccountTypeEnum::EMAIL);*/



    /*$SsoSignHandle->unbind('951173723@qq.com', \Tf\Sso\AccountTypeEnum::EMAIL);*/

} catch(\Tf\Sso\Err $Err){
    echo 'Error Id: ', $Err->id, '; Error Message: ', $Err->msg;
}


echo PHP_EOL, '<br> 内存使用：', memory_get_usage(), ' bytes （执行完PHP代码）', PHP_EOL, '<br>', PHP_EOL; // 406048
//unset($tmp);
// echo '', memory_get_usage(); // 313952