<?php
session_start();

/* session + cookie 由于session 必须要基于 cookie
*/

class CSess {
    static $randVerifyCodeSessName = 'CSessRandVerifyCodeSessName'; // random session name

    /*R
     * set session of random value for verify
     * 后台判断verifyCode是否正确的同时，还需要判断依据验证过的账号值，双重验证
     * 随机session只能用一次，且由于必须是手机号、邮箱通过后才能才能通过，所以所有的情况设置为一种就可以了
     * */
    function setRandSess($char_len = 4, $num_only = false) {
        // 方便辨识的字符串，邮箱用数字+字母混合的4位，手机用数字
        $chars = $num_only ? '1234567890' : 'abcdefhkmnprstuvwxyzABCDEFGHJKMNPRSTUVWXYZ2345678';
        $chars_len = strlen($chars) - 1;
        $verify_code = '';

        for ($i = 0; $i < $char_len; $i++) {
            // abcdefghkmnprstuvwxyzABCDEFGHJKMNPRSTUVWXYZ23456789  长度是 51，  也就是  0-50
            //mt_rand() 比 rand() 快四倍
            $rand = mt_rand(0, $chars_len);
            $verify_code .= $chars[$rand];
        }

        /*写入session的不区分大小写，全部是小写*/
        if (!$num_only) {
            $verify_code = strtolower($verify_code);
        }
        $this->set(self::$randVerifyCodeSessName, $verify_code);
        return $verify_code;
    }

    function checkRandSess($value) { // 获取一次，就自动销毁
        $value = strtolower($value);
        return $value == $this->getDisposable(self::$randVerifyCodeSessName);
    }


    function all() {
        return $_SESSION;
    }

    function set($sess_key, $value) {
        $_SESSION[$sess_key] = $value;
    }

    function get($sess_key) {
        return isset($_SESSION[$sess_key]) ? $_SESSION[$sess_key] : null;
    }

    function getDisposable($sess_key) { // 获取即销毁
        if (isset($_SESSION[$sess_key])) {
            $sess = $_SESSION[$sess_key];
            $this->remove($sess_key);
            return $sess;
        }
        return null;
    }

    function id($value = false) {
        if ($value === false) {
            return session_id();
        }
        else {
            // 重设session id 必须要在 session_start 之前，所以不能通过这个设置session id
            session_write_close();
            session_id($value);
            session_start();
        }
    }

    function newSessId($delete_old_session = false) {
        session_regenerate_id($delete_old_session);
    }

    function name($value = false) {
        if ($value === false) {
            return session_name();
        }
        else {
            return session_name($value);
        }
    }

    function saveDir($dir = false) {
        if ($dir === false) {
            return session_save_path();
        }
        else {
            if (is_dir($dir))
                session_save_path($dir);
            else
                throw new Exception('c_sess.saveDir() "' . $dir . '" is not a valid directory.');
        }
    }


    function close() {
        if (session_id() !== '')
            @session_write_close();
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


    function remove($sess_key) {
        unset($_SESSION[$sess_key]);
    }

    function destroy() {
        if (session_id() !== '') {
            @session_unset();
            @session_destroy();
        }
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

    function cookieMode($value = false) {
        if ($value === false) {
            if (ini_get('session.use_cookies') === '0')
                return 'none';
            elseif (ini_get('session.use_only_cookies') === '0')
                return 'allow';
            else
                return 'only';
        }
        else {
            if ($value === 'none') {
                ini_set('session.use_cookies', '0');
                ini_set('session.use_only_cookies', '0');
            }
            elseif ($value === 'allow') {
                ini_set('session.use_cookies', '1');
                ini_set('session.use_only_cookies', '0');
            }
            elseif ($value === 'only') {
                ini_set('session.use_cookies', '1');
                ini_set('session.use_only_cookies', '1');
            }
            else
                throw new Exception('c_session.cookieMode can only be "none", "allow" or "only".');
        }
    }


    public function getGCProbability() {
        return (float)(ini_get('session.gc_probability') / ini_get('session.gc_divisor') * 100);
    }


    // 子域名可以设置  .luexu.com  让所有子域名获取 sso_session_id，但是不能跨域
    //$secure 指明Cookie是否仅通过安全的HTTPS值为0或1，如果为1，则cookie只能在HTTPS连接
    function cookie($cookie_name, $value = false, $expire_days = 9, $path = '/', $domain = false, $secure = false, $is_value_raw = false) {
        if ($value === false) { // getCookie
            return isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : null;
            //$HTTP_COOKIE_VARS["TestCookie"];
        }
        else {
            $expire = time() + $expire_days * 86400; // 多少天后过期
            if ($is_value_raw) { // origin cookie value --> high performance
                return setrawcookie($cookie_name, $value, $expire, $path, $domain, $secure);
            }
            else { // urlencode cookie value
                return setcookie($cookie_name, $value, $expire, $path, $domain, $secure);
            }
        }
    }

    /* 如果 上面set 的cookie设置了 $domain，下面remove必须也要设置$domain，否则这个removeCookie就失败
    */
    function removeCookie($cookie_name, $path = '/', $domain = false) {

        if (isset($_COOKIE[$cookie_name])) {
            $expire = time() - 86400;
            unset($_COOKIE[$cookie_name]);
            return setcookie($cookie_name, '', $expire, $path, $domain);
        }
        return true;
    }
}