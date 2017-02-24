<?php
namespace Mdl;


class TfSso{

    private function setAccount($class, $account, $type = 0){
        $CFlt = new \C\Flt();
        if(empty($type)){
            $is_username = $CFlt->isUsername($account);
            $is_email = $CFlt->isEmail($account);
            $is_phone = $CFlt->isPhone($account);
        }
        else{
            $is_username = $type == \Tf\Sso\AccountTypeEnum::USERNAME;
            $is_email = $type == \Tf\Sso\AccountTypeEnum::EMAIL;
            $is_phone = $type == \Tf\Sso\AccountTypeEnum::PHONE;
            if(!$CFlt->safeStr($account)){
                $Err = new \Tf\Sso\Err();
                $Err->id = \Tf\Sso\ErrIdEnum::ERR_USER_INPUT;
                $Err->msg = '账号格式不正确';
                throw $Err;
            }
        }

        if($is_username){
            $class->fldAccount = $class::USERNAME;
            $class->valAccount = $account;
        }
        else if($is_email){
            $class->fldAccount = $class::EMAIL;
            $class->valAccount = $account;
        }
        else if($is_phone){
            $class->fldAccount = $class::PHONE;
            $class->valAccount = $account;
        }
        else{
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_USER_INPUT;
            $Err->msg = $account . '账号格式无法匹配';
            throw $Err;
        }
    }

    public function isAccountValid($account, $account_type){
        $SsoSign = new \Mdl\Dal\Sso\Sign();
        $this->setAccount($SsoSign, $account, $account_type);
        $account_cond = $SsoSign->accountCond();

        if(\Conf\MySqli::readSso()->existsVal($SsoSign::TB, $account_cond)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_REPEATED;
            $Err->msg = '账号已经存在';
            throw $Err;
        }
    }


    public function signIn(\Tf\Sso\SignInSt $sign_in_st){

        $account = $sign_in_st->account;

        $CSess = new \C\Cache\Sess();

        $SsoMemcache = new \Mdl\Cache\SsoMemcache();
        if($SsoMemcache->showCaptcha($account)){
            $captcha = $sign_in_st->captcha;
            if(empty($captcha) || !$CSess->checkCaptcha($captcha)){
                $Err = new \Tf\Sso\Err();
                $Err->id = \Tf\Sso\ErrIdEnum::ERR_CAPTCHA;
                //$Err->msg = '验证码错误';
                throw $Err;
            }
        }


        $SsoSign = new \Mdl\Dal\Sso\Sign();
        $SsoSign->pwd = $sign_in_st->pwd;
        $this->setAccount($SsoSign, $account, $sign_in_st->account_type);
        $Qs = $SsoSign->signIn();
        $Qa = \Conf\MySqli::readSso()->queryOne($Qs);
        if(empty($Qa)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_VERIFY;
            $Err->msg = '账号或密码错误';
            throw $Err;
        }
        $uid = (int)$Qa[$SsoSign::ID];
        $username = $Qa[$SsoSign::USERNAME];
        $email = $Qa[$SsoSign::EMAIL];
        $phone = $Qa[$SsoSign::PHONE];
        unset($Qa);

        $FltSso = new \Ctrl\Flt\Sso();
        $email = $FltSso->hiddenEmail($email);
        $phone = $FltSso->hiddenPhone($phone);

        $SignInfoSt = new \Tf\Sso\SignInfoSt();
        $SignInfoSt->username = $username;
        $SignInfoSt->email = $email;
        $SignInfoSt->phone = $phone;

        $sign_info = [
            \Tf\Sso\AccountTypeEnum::USERNAME => $username,
            \Tf\Sso\AccountTypeEnum::EMAIL => $email,
            \Tf\Sso\AccountTypeEnum::PHONE => $phone
        ];

        $Sess = new \Mdl\Cache\SsoSess();
        $Sess->setSignUid($uid);
        $Sess->setSignInfo($sign_info);
        // 有些地方，比如手机根本不需要cookie，所以cookie由前端自己控制
        // 但是session id 需要由这里统一

        $sess_id = $CSess->getId();
        $CCookie = new \Mdl\Cache\SsoCookie();
        $CCookie->setUniSessId($sess_id);
        $CCookie->setSignInfo($sign_info);

        return $SignInfoSt;
    }

    public function signOut(){
        $CSess = new \C\Cache\Sess();
        //$agent_sess = $CSess->getId();
        // 任何平台下获取sso session id 都是通过 .luexu.com 的cookie！！
        // 统一session 必须所有站一开始就自动生成，而不是直接用sso生成，否则会出错
        // 暂时全部由www入口

        /*$client_sess_id = \Mdl\Cache\SsoCookie::getUniSessId();
        if(!empty($client_sess_id) && $agent_sess != $client_sess_id){
            $CSess->setId($client_sess_id);
        }*/
        $CSess->destroy();

        \Mdl\Cache\SsoCookie::removeUniSessId();
        \Mdl\Cache\SsoCookie::removeSignInfo();

    }


    public function getEmail($uid){
        $SsoSign = new \Mdl\Dal\Sso\Sign();
        $SsoSign->id = $uid;
        $Qs = $SsoSign->getEmail();
        $email = \Conf\MySqli::readSso()->queryVal($Qs);
        if(empty($email)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_NOT_EXISTS;
            $Err->msg = '没有发现绑定的邮箱';
            throw $Err;
        }
        return $email;
    }

    public function initPwd($pwd, $variaccount){
        $SsoSign = new \Mdl\Dal\Sso\Sign();
        $this->setAccount($SsoSign, $variaccount);
        $SsoSign->pwd = $pwd;
        $Qs = $SsoSign->insert();
        $uid = \Conf\MySqli::writeSso()->execId($Qs);
        if(empty($uid)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_SERVER;
            $Err->msg = '注册失败';
            throw $Err;
        }

        $FltSso = new \Ctrl\Flt\Sso();
        if(empty($SsoSign->email)){
            $email = null;
            $phone = $FltSso->hiddenPhone($variaccount);
        }
        else{
            $email = $FltSso->hiddenEmail($variaccount);
            $phone = null;
        }

        $sign_info = [
            null,
            $email,
            $phone
        ];
        $Sess = new \Mdl\Cache\SsoSess();
        $Sess->setSignUid($uid);
        $Sess->setSignInfo($sign_info);
    }

    public function resetPwd($pwd, $variaccount, $uid){
        $SsoSign = new \Mdl\Dal\Sso\Sign();
        $SsoSign->id = $uid;
        $this->setAccount($SsoSign, $variaccount);
        $SsoSign->pwd = $pwd;
        $Qs = $SsoSign->resetPwd();
        if(!\Conf\MySqli::writeSso()->exec($Qs)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_SERVER;
            $Err->msg = '密码修改失败';
            throw $Err;
        }
    }

    public function bind($account, $account_type, $uid){
        $SsoSign = new \Mdl\Dal\Sso\Sign();
        $SsoSign->id = $uid;
        $this->setAccount($SsoSign, $account, $account_type);
        $Qs = $SsoSign->bind();
        if(!\Conf\MySqli::writeSso()->exec($Qs)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_SERVER;
            $Err->msg = '账号绑定失败';
            throw $Err;
        }
        $Sess = new \Mdl\Cache\SsoSess();
        $sign_info = $Sess->getSignInfo();

        if($SsoSign->fldAccount == $SsoSign::USERNAME){
            $sign_info[\Tf\Sso\AccountTypeEnum::USERNAME] = $account;
        }
        else{
            $FltSso = new \Ctrl\Flt\Sso();
            if($SsoSign->fldAccount == $SsoSign::EMAIL){
                $sign_info[\Tf\Sso\AccountTypeEnum::EMAIL] = $FltSso->hiddenEmail($account);
            }
            else{
                $sign_info[\Tf\Sso\AccountTypeEnum::PHONE] = $FltSso->hiddenPhone($account);
            }
        }

        $Sess->setSignInfo($sign_info);
    }


    public function unbind($account, $account_type, $uid){
        $SsoSign = new \Mdl\Dal\Sso\Sign();
        $SsoSign->id = $uid;
        $this->setAccount($SsoSign, $account, $account_type);

        if(empty($SsoSign->fldAccount) || $SsoSign::USERNAME == $SsoSign->fldAccount){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_USER_INPUT;
            $Err->msg = '用户名仅可以设置一次，不可解绑';
            throw $Err;
        }
        $Qs = $SsoSign->unbind();
        if(!\Conf\MySqli::writeSso()->exec($Qs)){
            $Err = new \Tf\Sso\Err();
            $Err->id = \Tf\Sso\ErrIdEnum::ERR_SERVER;
            $Err->msg = '解绑账号错误';
            throw $Err;
        }
    }
} 