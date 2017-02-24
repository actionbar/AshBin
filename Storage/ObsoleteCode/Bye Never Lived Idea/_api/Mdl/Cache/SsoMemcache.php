<?php
namespace Mdl\Cache;


class SsoMemcache {

    /*
     * @todo 对ip进行验证
     * 必须要同时验证ip 和 账号
     * */
    public function showCaptcha($account){
        $sign_in_times = (int)\Conf\Memcache::countSignInTimes()->get($account);

        if($sign_in_times < 2){
            // 7200 sec =  2 hours
            \Conf\Memcache::countSignInTimes()->set($account, $sign_in_times+1, 7200);
            return false;
        }
        else{
            return true;
        }
    }
} 