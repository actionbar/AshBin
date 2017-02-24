<?php
 //获取客户端配置信息
class c_clientconf{
	static function time(){
		return time();
	}
    static function intIP(){
        return ip2long(self::ip());  // 32位的为负数，64位的为正数
    }
    static function ip(){
        $ip=false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if($ip){
                array_unshift($ips, $ip); $ip = FALSE;
            }
            for($i = 0; $i < count($ips); $i++){
                if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])){
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }
}