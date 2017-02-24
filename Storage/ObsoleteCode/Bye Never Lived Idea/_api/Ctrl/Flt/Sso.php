<?php
namespace Ctrl\Flt;


class Sso {
    public function hiddenEmail($email){

        return empty($email) ? $email : substr($email, 0, 2) . '***' . strrchr($email, '@');
    }

    public function hiddenPhone($phone){
        return empty($phone) ? $phone : substr($phone, 0, 2) . '******' . substr($phone, -1);
    }
} 