<?php
namespace Mdl\Dal\Sso;


class Sign{
    const TB = 'sso_sign';
    const ID = 'i';
    const USERNAME = 'u';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const PWD = 'pwd';

    public $id;
   /* public $username;
    public $email;
    public $phone;*/
    public $pwd;

    // combined account = email / username / phone
    public $fldAccount;
    public $valAccount;


    public function accountCond(){
        return $this->fldAccount .'="'. $this->valAccount.'"';
    }

    public function signIn(){
        return 'SELECT i,u,email,phone FROM sso_sign WHERE ' . $this->accountCond() . ' AND pwd="' . $this->pwd . '" LIMIT 1';
    }

    public function getEmail(){
        return 'SELECT email FROM sso_sign WHERE i=' . $this->id . ' LIMIT 1';
    }

    public function insert(){
        return 'INSERT INTO sso_sign SET ' . $this->accountCond() . ', pwd="' . $this->pwd . '"';
    }

    public function resetPwd(){
        return 'UPDATE sso_sign SET pwd="' . $this->pwd . '" WHERE i=' . $this->id . ' AND ' . $this->accountCond() . ' LIMIT 1';
    }


    public function bind(){
        // can't user $this->accountCond()
        // this filed must be not null

        return 'UPDATE sso_sign SET ' . $this->accountCond() . ' WHERE i=' . $this->id .' AND '. $this->fldAccount .' IS NULL';
    }

    public function unbind(){
        return 'UPDATE sso_sign SET ' . $this->fldAccount . '=NULL WHERE i=' . $this->id . ' AND ' . $this->accountCond();
    }
}