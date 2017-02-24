<?php
namespace C;


class Flt {
    /*
     *  safe sql string
     */
    public function safeStr($str){
        return !strpos($str, '\'');
    }

    public function isEmail($val){
        return preg_match('/^[\w\-\.]+\@[\w\-]+(\.[a-z]+)+$/', $val);
    }
    public function isPhone($val){
        return preg_match('/^1\d{10}$/', $val);
    }
    public function isUsername($val){
        // 匹配 中文  '/[\x{4e00}-\x{9fa5a}]/u'  以中文英文开头，且只中文、英文、数字、-和下划线
        return preg_match('/^[\x{4e00}-\x{9fa5a}a-zA-Z][\x{4e00}-\x{9fa5}\w\-]+$/u', $val);
    }
} 