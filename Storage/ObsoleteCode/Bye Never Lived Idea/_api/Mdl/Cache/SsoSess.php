<?php


namespace Mdl\Cache;


class SsoSess {
    const SIGN_UID = 'SSO_SIGN_UID';
    const SIGN_INFO = 'SSO_SIGN_INFO';
    const PENDDING_VERIACCOUNT = 'SSO_PENDDING_VERIACCOUNT';
    const VERIACCOUNT = 'SSO_VERIACCOUNT';
    const VERICODE = 'SSO_VERICODE';



    public function setSignUid($uid){
        $CSess = new \C\Cache\Sess();
        $CSess->offsetSet(self::SIGN_UID, $uid);
    }

    public function getSignUid(){
        $CSess = new \C\Cache\Sess();
        return $CSess->offsetGet(self::SIGN_UID);
    }

    public function setSignInfo(array $arr){
        $CSess = new \C\Cache\Sess();
        $CSess->offsetSet(self::SIGN_INFO, $arr);
    }

    public function getSignInfo(){
        $CSess = new \C\Cache\Sess();
        return $CSess->offsetGet(self::SIGN_INFO);
    }

    public function genVericode($veriaccount){
        $CSess = new \C\Cache\Sess();
        $CSess->offsetSet(self::PENDDING_VERIACCOUNT, $veriaccount);
        $CRand = new \C\Rand();
        $vericode = $CRand->genStr(6);
        $CSess->offsetSet(self::VERICODE, $vericode);
        return $vericode;
    }

    public function getThenRemoveVeriaccount(){
        $CSess = new \C\Cache\Sess();
        return $CSess->getThenRemove(self::VERIACCOUNT);
    }

    public function checkVericode($val){
        $CSess = new \C\Cache\Sess();
        if($val == $CSess->offsetGet(self::VERICODE)){
            $CSess->offsetUnset(self::VERICODE);
            $veriaccount = $CSess->getThenRemove(self::PENDDING_VERIACCOUNT);
            $CSess->offsetSet(self::VERIACCOUNT, $veriaccount);
        }
        $sess_variaccount = $CSess->offsetGet(self::VERIACCOUNT);
        return !empty($sess_variaccount);
    }
} 