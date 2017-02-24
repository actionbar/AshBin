<?php

class Url{
    /*
     * domain [域名]luexu.com
     * server_name [域名]luexu.com / sso.luexu.com
referer [前一链接]
http_host [含http / https的根网址 和端口号] http://www.luexu.com http://sso.luexu.com:8080 （非80口，输出端口号）

    */
    /*
     * 全部都是小写，如需大写需要在网站内添加   |ucfirst / ucwords / strtoupper
     * */
    const SERVER_DOMAIN = 'luexu.com';
    /*
     *  {<Cn::DOMAIN | ucfirst}  == 输出  Luexu.com
     * */

    const _ = 'http://www.luexu.com';

    /*
     * 这里必须只能放置 http://www.luexu.com 的网址，非这个网址，必须重新放
     * */

    // default is sign up
    const SSO = 'http://www.luexu.com/sso/';
    const SSO_SIGN_UP = 'http://www.luexu.com/sso/';
    const SSO_SIGN_UP_PHONE = 'http://www.luexu.com/sso/#phone';
    const SSO_SIGN_UP_EMAIL = 'http://www.luexu.com/sso/#email';
    const SSO_SIGN_IN = 'http://www.luexu.com/sso/sign_in.html';
    /*
     * 由于Ajax不能跨域，而以后采用根目录制度，所以把判断放到根目录，主站用ajax，分站用直接post过来，然后跳转回去
     * */


}

?>