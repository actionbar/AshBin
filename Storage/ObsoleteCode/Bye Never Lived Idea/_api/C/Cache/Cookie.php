<?php


namespace C\Cache;


class Cookie implements \ArrayAccess{
    public $path = '/';
    public $domain = false;  //'.luexu.com'
    public $secure = false;
    public $is_val_raw = false;

    public function offsetExists($offset){

    }
    /*
     *
     * 1.domain表示的是cookie所在的域，默认为请求的地址，如网址为www.test.com/test/test.aspx，那么domain默认为www.test.com。而跨域访问，如域A为t1.test.com，域B为t2.test.com，那么在域A生产一个令域A和域B都能访问的cookie就要将该cookie的domain设置为.test.com；如果要在域A生产一个令域A不能访问而域B能访问的cookie就要将该cookie的domain设置为t2.test.com。

  2.path表示cookie所在的目录，asp.net默认为/，就是根目录。在同一个服务器上有目录如下：/test/,/test/cd/,/test/dd/，现设一个cookie1的path为/test/，cookie2的path为/test/cd/，那么test下的所有页面都可以访问到cookie1，而/test/和/test/dd/的子页面不能访问cookie2。这是因为cookie能让其path路径下的页面访问。

  3.浏览器会将domain和path都相同的cookie保存在一个文件里，cookie间用*隔开。

  4.含值键值对的cookie：以前一直用的是nam=value单键值对的cookie，一说到含多个子键值对的就蒙了。现在总算弄清楚了。含多个子键值对的cookie格式是name=key1=value1&key2=value2。可以理解为单键值对的值保存一个自定义的多键值字符串，其中的键值对分割符为&，当然可以自定义一个分隔符，但用asp.net获取时是以&为分割符。
     * */

    // 子域名可以设置  .luexu.com  让所有子域名获取 sso_session_id，但是不能跨域
    //$secure 指明Cookie是否仅通过安全的HTTPS值为0或1，如果为1，则cookie只能在HTTPS连接
    public function offsetSet($k, $v, $exp_in_sec = 0){
        $expiration = $_SERVER['REQUEST_TIME'] + $exp_in_sec; // 多少秒后过期

        if(is_array($v)){
            $v = json_encode($v);
        }

        if($this->is_val_raw){ // origin cookie value --> high performance
            return setrawcookie($k, $v, $expiration, $this->path,  $this->domain,  $this->secure);
        }
        else{ // urlencode cookie value
            return setcookie($k, $v, $expiration,  $this->path,  $this->domain,  $this->secure);
        }

    }

    public function offsetGet($k){
        //$HTTP_COOKIE_VARS["TestCookie"];
        return isset($_COOKIE[$k]) ? $_COOKIE[$k] : null;
    }



    /* 如果 上面set 的cookie设置了 $domain，下面remove必须也要设置$domain，否则这个removeCookie就失败
    */
    public function offsetUnset($k){
        if($this->offsetGet($k)){
            $expire = time() - 86400;
            unset($_COOKIE[$k]);
            return setcookie($k, '', $expire, $this->path, $this->domain);
        }
        return true;
    }

} 