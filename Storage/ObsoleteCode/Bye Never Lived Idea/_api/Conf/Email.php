<?php

namespace Conf;


class Email {
    final public static function signUp(){
        $host = 'host';
        $user = 'email_user';
        $pwd= 'email_password';


        $CEmail = new \C\Email();
        $CEmail::$dirEmail = '/C/Email';
        $CEmail->setSMTP($host, $user, $pwd, true);
        $CEmail->setFrom('email_user', 'name');
        return $CEmail;
    }
} 