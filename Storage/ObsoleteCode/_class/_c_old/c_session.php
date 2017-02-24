<?php
session_start();

// session
class c_sess {

    static function all(){
        return $_SESSION;
    }
    
    function id($value = false){
        if($value === false){return session_id();}
        else{session_id($value);}
    }

    function newId($delete_old_session = false){
        session_regenerate_id($delete_old_session);
    }

    function name($value = false){
        if($value === false){return session_name();}
        else{session_name($value);}
    }
    
    function saveDir($dir= false){
        if($dir === false){return session_save_path();}
        else{
            if(is_dir($value))
                session_save_path($value);
            else
                throw new Exception('c_sess.saveDir() "'. $value .'" is not a valid directory.');        
        }
    }
    
    
    function close(){
        if(session_id()!=='')
            @session_write_close();
    }
    
    function set($sess_key, $sess_value){
        $_SESSION[$sess_key, $sess_value);
    }
    
    function get($sess_key){
        return isset($_SESSION[$sess_key]) ? $_SESSION[$sess_key] : null;
    }
      /*
    session_unset  --->  unset
    Just use unset to unset any array index. And Session itself is an array. So use unset to unset your particular session index. You are wrong in the case of session_unset and session_destroy functions as they don't accept any parameters.

Also the point to note is that, you should not be using session_destroy as it will unset all available sessions. For eg. while loggin out, you may not be wanting to lose your products in cart formed using session.
session_destroy — Destroys all data registered to a session

session_unset — Frees all session variables

session_unset just clears the $_SESSION variable. It’s equivalent to doing:

$_SESSION = array(); So this does only affect the local $_SESSION variable instance but not the session data in the session storage.
*/

    
    function remove($sess_key){
        unset($_SESSION[$sess_key]);
    }
    
    function destroy(){
        if(session_id()!==''){
            @session_unset();
            @session_destroy();
        }
    }

    function cookieParams($value = false){
        if($value === false){return session_save_path();}
        else{
            $data=session_get_cookie_params();
            extract($data);
            extract($value);
            if(isset($httponly))
                session_set_cookie_params($lifetime,$path,$domain,$secure,$httponly);
            else
                session_set_cookie_params($lifetime,$path,$domain,$secure);
        }
    }

    function cookieMode($value = false){
         if($value === false){
            if(ini_get('session.use_cookies')==='0')
                return 'none';
            elseif(ini_get('session.use_only_cookies')==='0')
                return 'allow';
            else
                return 'only';
        }
        else{
            if($value==='none'){
                ini_set('session.use_cookies','0');
                ini_set('session.use_only_cookies','0');
            }
            elseif($value==='allow'){
                ini_set('session.use_cookies','1');
                ini_set('session.use_only_cookies','0');
            }
            elseif($value==='only'){
                ini_set('session.use_cookies','1');
                ini_set('session.use_only_cookies','1');
            }
            else
                throw new Exception('c_session.cookieMode can only be "none", "allow" or "only".');
        }
    }

    
    
    public function getGCProbability()
	{
		return (float)(ini_get('session.gc_probability')/ini_get('session.gc_divisor')*100);
	}
    
    

    // 静态 public static function 内部不能用 动态 $this-> 函数，必须改成 动态的 

    function SetMd5RandSession($session_name, $prefix='LueXue - ',  $suffix=' - Winner!'){  // 产生并存储一个随机session，并返回这个值
        $str = $prefix . rand(9999,999999999) . $suffix;
        $str = md5($str);
        $this -> SetSession($session_name, $str);
        return $str;
    }
    
        // 产生一个随机的 4位数（手机验证码），由于验证比较短，所以这个设置的识别时间也必须很短，保证在45秒内
    function SetNumRandSession($session_name){
        $str = rand(1000,9999);
        $this -> SetSession($session_name, $str);
        return $str;
    }


//在发送 cookie 时，cookie 的值会自动进行 URL 编码。接收时会进行 URL 解码。如果你不需要这样，可以使用 setrawcookie() 代替。
// 子域名可以设置  .luexu.com  让所有子域名获取 sso_session_id，但是不能跨域
    function SetCookie($cookie_name, $value, $expire_day, $path  = '/', $domain = false, $secure = false){
        $expire = c_clientconf::Time() + 3600 * $expire_day;  // 多少天后过期，可以是小数
        setcookie($cookie_name, $value, $expire, $path, $domain, $secure);
    }
    // setrawcookie() 与 setcookie() 几乎完全相同，不同的是不会在发往客户机时，对 cookie 值进行自动 URL 编码。
    function SetRawCookie($cookie_name, $value, $expire_day, $path  = '/', $domain = false, $secure = false){
        $expire = c_clientconf::Time() + 3600 * $expire_day;  // 多少天后过期，可以是小数
        setrawcookie($cookie_name, $value, $expire, $path, $domain, $secure);
    }

    function UnsetCookie($cookie_name){
        setcookie($cookie_name,'', c_clientconf::Time() - 3600);
    }

    static function GetCookie($cookie_name){
        return isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';
        //$HTTP_COOKIE_VARS["TestCookie"];
    }
}