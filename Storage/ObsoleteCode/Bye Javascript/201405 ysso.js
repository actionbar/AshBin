(function () {

    function f() {
    }

    f.prototype = {
        captcha: function (j) {
            //json  {node='#sso-captcha',width=, height=, inputname='svc', imgnode='#sso-captcha-img',morenode='#sso-captcha-more'}
            var i = c.replace(/[^\w]/g, ''), g = i + '-img', m = i + '-more';
            var l = 'http://sso.luexu.com/c-b/captcha.php?w=100&h=42&f=24&t=' + Y.t();
            $(c).hide();
            $(c).addClass('ov');
            $(c).html('<input type="text" _len="4" _type="captcha" autocomplete="off" placeholder="验证码" class="p w-v-input w-v-svc" name="{^RQST_VERIFY_CODE}"><img src="' + l + '" id="' + g + '" width="100" height="42" alt="验证码"><a href="#" id="' + m + '">换一张</a>');
            $(c).show(150);
        },

        init: function () {
        }

    };

    window.YSSO = new f(); //内部使用，避免重复
    $(document).ready(function () {
        YSSO.init()
    });


})
    ();
