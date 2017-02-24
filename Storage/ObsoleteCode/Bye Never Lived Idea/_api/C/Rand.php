<?php
namespace C;


class Rand{
    public $pattern = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public function genNum($len = 4){
        $rtn = '';
        for($i = 0; $i < $len; $i++){
            $rtn .= mt_rand(0, 10);
        }
        return $rtn;
    }

    public function genStr($len = 4){
        $pattern_len = strlen($this->pattern) - 1;
        $rtn = '';

        for($i = 0; $i < $len; $i++){
            // abcdefghkmnprstuvwxyzABCDEFGHJKMNPRSTUVWXYZ23456789  长度是 51，  也就是  0-50
            //mt_rand() 比 rand() 快四倍
            $rand = mt_rand(0, $pattern_len);
            $rtn .= $this->pattern[$rand];
        }
        return $rtn;
    }


    public function genCaptcha($len = 4){
        $this->pattern = 'abcdefhkmnprstuvwxyzABCDEFGHJKMNPRSTUVWXYZ2345678';
        return $this->genStr($len);
    }
}