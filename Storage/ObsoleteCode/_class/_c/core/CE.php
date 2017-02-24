<?php

/*
 *  系统的  Exception 类使用说明
 * 类似 zend framwork 的 response 类， CE类里面执行所有面向客户端的输出、header等
 *
 *http://php.net/manual/en/class.errorexception.php
 * http://www.php.net/manual/zh/class.exception.php
 *  http://www.jaceju.net/blog/archives/1121/
 *
 * class Exception{
    protected $message = 'Unknown exception';   // 异常信息
    protected $code = 0;                        // 用户自定义异常代码
    protected $file;                            // 发生异常的文件名
    protected $line;                            // 发生异常的代码行号

    function __construct($message = null, $code = 0);

    final function getMessage();                // 返回异常信息
    final function getCode();                   // 返回异常代码
    final function getFile();                   // 返回发生异常的文件名
    final function getLine();                   // 返回发生异常的代码行号
    final function getTrace();                  // backtrace() 数组
    final function getTraceAsString();          // 已格成化成字符串的 getTrace() 信息

    //  可重载的方法
    function __toString();                       // 可输出的字符串
    }



 *
 * 使用方法
 *
 * function xxx(){}
 *
 *
 * set_exception_handler('xxx');
 * if(){
 *     throw new CErr(errMsg, errCode,);
 * }
 *
 * 或者
 *try {
    echo inverse(5) . "\n";
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
// Continue execution
echo 'Hello World';


--------------------------
class a{
    function f(){
        if(bool)

    }
}



 * */

class CE extends ErrorException {

    //http://tool.oschina.net/commons  contentType

    /*
     *  application/json
     *  text/html
     * text/xml
     * application/x-javascript
     * */

    static $charset = 'utf-8';
    static $errKey = 'ERR';

/*define('ERR_VARNAME', 'ERR');  // use for json key name
define('ERR_ERROR', 1);  // Fatal errors
define('ERR_SERVER_MAINTENANCE', 2);  // system or server maintenance
define('ERR_NOT_FOUND', 3);  // db not found or page not found
define('ERR_VALUE_REPEATED', 4);  // db value exits, cant create one more
define('ERR_USER', 5);  // user send illegal words or something illegal
define('ERR_VERIFY', 8);  // temporary verification
define('ERR_PERMISSION', 9);  // need login, or permissions neccesarry
    function ERR($error_const){  // 以后一旦报致命性错误，给管理员发送邮件
        echo json_encode([ERR_VARNAME=>$error_const]);
        exit();
    }*/


    static function json($val) { // 输出 包含 Header, Exception, Body 等
        //header('Content-Type:application/json;charset=' . self::$charset);
        if(is_int($val)){  // 输出errId
            $rtn = json_encode([self::$errKey=>$val]);
            die($rtn);
        }

        echo json_encode($val);

    }



}