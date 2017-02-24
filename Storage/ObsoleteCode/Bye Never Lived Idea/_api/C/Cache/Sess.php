<?php
namespace C\Cache;

if(!session_id())
    session_start();

class Sess implements \ArrayAccess{
    const CAPTCHA_SESS_NAME = 'CSessCaptcha';
    const VERICODE_SESS_NAME = 'dfsdf';

    public function conn(){

    }

    public function offsetExists($sess_key){

    }
    public function offsetSet($sess_key, $value, $exp_in_sec = 0){
        $_SESSION[$sess_key] = $value;
    }

    public function offsetGet($sess_key){
        return isset($_SESSION[$sess_key]) ? $_SESSION[$sess_key] : null;
    }

    public function offsetUnset($sess_key){
        unset($_SESSION[$sess_key]);
    }


    public function getAll(){
        return $_SESSION;
    }


    /*
  session_unset  --->  unset
  Just use unset to unset any array index. And Session itself is an array. So use unset to unset your particular session index. You are wrong in the case of session_unset and session_destroy functions as they don't accept any parameters.

Also the point to note is that, you should not be using session_destroy as it will unset all available sessions. For eg. while loggin out, you may not be wanting to lose your products in cart formed using session.
session_destroy ¡ª Destroys all data registered to a session

session_unset ¡ª Frees all session variables

session_unset just clears the $_SESSION variable. It¡¯s equivalent to doing:

$_SESSION = array(); So this does only affect the local $_SESSION variable instance but not the session data in the session storage.
*/



    public function destroy(){
        if(session_id() !== ''){
            @session_unset();
            @session_destroy();
        }
    }


    public function genCaptcha($code_len = 4){
        $CRand = new \C\Rand();
        $captcha = $CRand->genCaptcha($code_len);
        $captcha_to_lower = strtolower($captcha);
        $this->offsetSet(self::CAPTCHA_SESS_NAME, $captcha_to_lower, 0);
        return $captcha;
    }

    public function checkCaptcha($captcha){
        return $captcha == $this->getThenRemove(self::CAPTCHA_SESS_NAME);
    }



    public function getThenRemove($sess_key){ // 获取即销毁
        if(isset($_SESSION[$sess_key])){
            $sess = $_SESSION[$sess_key];
            $this->offsetUnset($sess_key);
            return $sess;
        }
        return null;
    }

    public function getId(){
        return session_id();
    }

    public function setId($val){
        // 重设session id 必须要在 session_start 之前，所以不能通过这个设置session id
        session_write_close();
        session_id($val);
        session_start();
    }

    public function genSessId($del_old_session = false){
        session_regenerate_id($del_old_session);
    }

    public function getName(){
        return session_name();
    }

    public function setName($val){
        return session_name($val);
    }

    public function getSaveDir(){
        return session_save_path();
    }

    public function setSaveDir($dir){
        if(is_dir($dir))
            session_save_path($dir);
        else
            throw new Exception('c_sess.saveDir() "' . $dir . '" is not a valid directory.');
    }


    public function close(){
        if(session_id() !== '')
            @session_write_close();
    }


    /*  function cookieParams($value = false) {
          if ($value === false) {
              return session_save_path();
          } else {
              $data = session_get_cookie_params();
              extract($data);
              extract($value);
              if (isset($httponly))
                  session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly); else
                  session_set_cookie_params($lifetime, $path, $domain, $secure);
          }
      }*/

    public function cookieMode($value = false){
        if($value === false){
            if(ini_get('session.use_cookies') === '0')
                return 'none';
            elseif(ini_get('session.use_only_cookies') === '0')
                return 'allow';
            else
                return 'only';
        }
        else{
            if($value === 'none'){
                ini_set('session.use_cookies', '0');
                ini_set('session.use_only_cookies', '0');
            }
            elseif($value === 'allow'){
                ini_set('session.use_cookies', '1');
                ini_set('session.use_only_cookies', '0');
            }
            elseif($value === 'only'){
                ini_set('session.use_cookies', '1');
                ini_set('session.use_only_cookies', '1');
            }
            else
                throw new Exception('c_session.cookieMode can only be "none", "allow" or "only".');
        }
    }


    public function getGCProbability(){
        return (float)(ini_get('session.gc_probability') / ini_get('session.gc_divisor') * 100);
    }


}