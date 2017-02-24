<?php
namespace Ctrl;


class TfSsoSign implements \Tf\Sso\SignIf{

    public function signIn(\Tf\Sso\SignInSt $sign_in_st){
        $Mdl = new \Mdl\TfSso();
        return $Mdl->signIn($sign_in_st);
    }

    public function signOut(){
        // use cross domain cookie to get sso session id

        $Mdl = new \Mdl\TfSso();
        $Mdl->signOut();
    }

    public function isAccountValid($account, $account_type){
        $Mdl = new \Mdl\TfSso();
        $Mdl->isAccountValid($account, $account_type);
    }

    public function sendVericodeForSignUp($account, $account_type = 0){

        if($account_type == \Tf\Sso\AccountTypeEnum::PHONE){
            $this->sendPhoneVericodeForSignUp($account);
        }
        else{
            $this->sendEmailVericodeForSignUp($account);
        }
    }


    public function sendVericode($account = null, $account_type){
        if($account_type == \Tf\Sso\AccountTypeEnum::PHONE){
            $this->sendPhoneVericode($account);
        }
        else{
            $this->sendEmailVericode($account);
        }
    }

    private function sendEmailVericodeForSignUp($email){

        $Sess = new \Mdl\Cache\SsoSess();
        $date = date('Y年m月d日', $_SERVER['REQUEST_TIME']);
        $vericode = $Sess->genVericode($email);
        $subject = '账号 - 激活注册邮箱';
        $verilink = '/sso/?vericode=' . $vericode . '&account=' . $email . '#email';
        $time = date('H:i', $_SERVER['REQUEST_TIME']);
        $CTpl = new \C\Tpl();
        $file = '/api.luexu.com/tpl/pop-up/email/sso/send_vericode_for_sign_up.htm';

        $msgHtml = $CTpl->assignPartial($file, [
            'vericode' => $vericode,
            'verilink' => $verilink,
            'date' => $date,
            'time' => $time,
            'email' => $email,
        ]);
        $Email = \Conf\Email::signUp();
        $Email->setAddressee($email);
        $Email->subject = $subject;
        $Email->msgHtml = $msgHtml;
        $Email->send();
    }

    /*
     *
     *  uid + email(new)  =  bindding new
     *  only uid = verify from exist Email
     * */
    private function sendEmailVericode($email = null){
        $Sess = new \Mdl\Cache\SsoSess();
        $uid = $Sess->getSignUid();
        if(empty($uid)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_PERMISSION;
            $Err->msg = '用户尚未登陆';
            throw $Err;
        }

        if(empty($email)){
            $Mdl = new \Mdl\TfSso();
            $email = $Mdl->getEmail($uid);
        }

        $date = date('Y年m月d日', $_SERVER['REQUEST_TIME']);
        $vericode = $Sess->genVericode($email);
        $subject = '账号 - 邮箱身份验证';
        $CTpl = new \C\Tpl();
        $file = '/api.luexu.com/tpl/pop-up/email/sso/send_vericode.htm';
        $msgHtml = $CTpl->assignPartial($file, [
            'vericode' => $vericode,
            'date' => $date,
        ]);

        $Email = \Conf\Email::signUp();
        $Email->setAddressee($email);
        $Email->subject = $subject;
        $Email->msgHtml = $msgHtml;
        $Email->send();
    }

    private function sendPhoneVericodeForSignUp($phone){

    }

    private function sendPhoneVericode($phone = null){

    }


    public function verify($vericode){
        $Sess = new \Mdl\Cache\SsoSess();
        if(!$Sess->checkVericode($vericode)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_VERIFY;
            $Err->msg = $vericode .'效验码错误';
            throw $Err;
        }
    }

    /*
     * only pwd = init
     * uid + pwd = reset
     * */
    public function initPwd($pwd){
        $Sess = new \Mdl\Cache\SsoSess();
        $variaccount = $Sess->getThenRemoveVeriaccount();
        if(empty($variaccount)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_VERIFY;
            $Err->msg = $variaccount .'账号尚未激活';
            throw $Err;
        }
        $uid = $Sess->getSignUid();
        $Mdl = new \Mdl\TfSso();
        if(empty($uid)){
            $Mdl->initPwd($pwd, $variaccount);
        }
        else{
            $Mdl->resetPwd($pwd, $variaccount, $uid);
        }
    }


    public function bind($account, $account_type = null){
        $Sess = new \Mdl\Cache\SsoSess();
        $variaccount = $Sess->getThenRemoveVeriaccount();
        if(empty($variaccount)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_VERIFY;
            $Err->msg = '账号尚未激活';
            throw $Err;
        }

        $uid = $Sess->getSignUid();
        if(empty($uid)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_PERMISSION;
            $Err->msg = '用户尚未登陆';
            throw $Err;
        }
        $Mdl = new \Mdl\TfSso();
        /*
         * account == variaccount  ==> email / phone
         * account_type == username ==> username
         * */
        if($account == $variaccount || $account_type == \Tf\Sso\AccountTypeEnum::USERNAME){
            $Mdl->bind($account, $account_type, $uid);
        }
    }

    /*
     * variaccount must unequal account
     * */
    public function unbind($account, $account_type = null){
        $Sess = new \Mdl\Cache\SsoSess();
        $variaccount = $Sess->getThenRemoveVeriaccount();
        if(empty($variaccount)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_VERIFY;
            $Err->msg = '账号尚未激活';
            throw $Err;
        }

        $uid = $Sess->getSignUid();
        if(empty($uid)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_PERMISSION;
            $Err->msg = '用户尚未登陆';
            throw $Err;
        }
        $Mdl = new \Mdl\TfSso();
        // variaccount must unequal account
        if($variaccount != $account){
            $Mdl->unbind($account, $account_type, $uid);
        }

    }

} 