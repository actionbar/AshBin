<?php
/* 
    ERR
        REQUEST ==> 请求错误
        RESPONSE  ==> 返回错误
        SERVER ==> 系统错误
 */
define('ERR_VARNAME', 'ERR');  // use for json key name



define('ERR_SERVER', 1);  // system or server maintenance
define('ERR_NOT_FOUND', 2);  // db not found or page not found
define('ERR_REPEATED', 3);  // db value exits, cant create one more

define('ERR_USER_INPUT', 5);  // user send illegal words or something illegal
define('ERR_CAPTCHA',7);  // temporary verification
define('ERR_VERIFY', 8);  // username or pwd error, or verify code error
define('ERR_PERMISSION', 9);  // need login, or permissions neccesarry , username not setted that cant 
function ERR($error_const){  // 以后一旦报致命性错误，给管理员发送邮件
	echo json_encode([ERR_VARNAME=>$error_const]);
	exit();
}
