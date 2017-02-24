<?php


namespace Mdl\Cache;


class SsoCookie {
    const UNI_SESS_ID = 'sso_sess_id';
    const SIGN_INFO = 'sso_sign_info';

    public function setUniSessId($sess_id){
        $CCookie = new \C\Cache\Cookie();
        $CCookie->path = '/';
        $CCookie->domain = '.luexu.com';
        return $CCookie->offsetSet(self::UNI_SESS_ID, $sess_id, 9999);
    }

    public static function getUniSessId(){
        $CCookie = new \C\Cache\Cookie();
        return $CCookie->offsetGet(self::UNI_SESS_ID);
    }

    public static function removeUniSessId(){
        $CCookie = new \C\Cache\Cookie();
        $CCookie->path = '/';
        $CCookie->domain = '.luexu.com';
        return $CCookie->offsetUnset(self::UNI_SESS_ID);
    }

    public static function removeSignInfo(){
        $CCookie = new \C\Cache\Cookie();
        $CCookie->path = '/';
        $CCookie->domain = '.luexu.com';
        return $CCookie->offsetUnset(self::SIGN_INFO);
    }

    public function setSignInfo($sign_info){
        $CCookie = new \C\Cache\Cookie();
        $CCookie->path = '/';
        $CCookie->domain = '.luexu.com';
        return $CCookie->offsetSet(self::SIGN_INFO, $sign_info, 9999);
    }
} 