<?php
namespace C;
/*
 *  客户端在服务器上，当前的信息
 * header
 */

class Client {
    /*如果你想知道脚本开始执行(译注：即服务器端收到客户端请求)的时刻，使用$_SERVER['REQUEST_TIME']要好于time()。
PS：$_SERVER['REQUEST_TIME']保存了发起该请求时刻的时间戳，而time()则返回当前时刻的Unix时间戳。*/
    static function intTime() { // 整数型时间
        return $_SERVER['REQUEST_TIME'];
    }

    /*ip2long() 转出来的数值应该都是正整数, 但是在某些机器转出负数, 刚开始以为是 PHP 版本问题, 后来做些测试, 确定是系统版本 32bits 和 64bits 的问题.

32 bits ip2long(): -2147483648 ~ 214748364764
64 bits ip2long(): 0 ~ 42949672945

    ip2long 有bug，用自己写的

*/
    static function intIp() {
        $arr = explode('.', self::ip());
        return (($arr[0] * 256 + $arr[1]) * 256 + $arr[2]) * 256 + $arr[3];
    }


    /*
     * @todo 暂时只会ipv4的，未来才扩展到ipv6
     * */
    static function binIp(){   // 数据库 unhex()  set  ip = 0x7F000001;
        $arr = explode('.', self::ip());
        $rtn = '0x';

        foreach($arr as $x){
            $x = (int)$x;
            $rtn .= $x<16 ? '0' : '';
            $rtn .= dechex($x);
        }
        return $rtn;
    }

    static function ip() {
        $ip = false;
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = false;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match('/^(10|172\.16|192\.168)\./', $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    function Move302($url) { // 临时跳转
        header('Location:' . $url);
        exit();
    }

    function Move301($url) { // 永久跳转
        header('HTTP/1.1 301 Moved Permanently');
        header('Location:' . $url);
        exit();
    }

}