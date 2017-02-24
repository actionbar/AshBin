<!DOCTYPE html>
                <html>
                <head>
                    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
              <title>掠需注册</title><meta name="description" content="fsdasdfsa"><meta name="keywords" content="dfas,dfss"><script type="text/javascript" src="http://www.luexu.com/_cdn/jq2.1.1.js"></script><link href="http://www.luexu.com/_cdn/y.css" rel="stylesheet" type="text/css"><script type="text/javascript" src="http://www.luexu.com/_cdn/y.js"></script><link href="http://www.luexu.com/_cdn/www/i.css" rel="stylesheet" type="text/css"><script type="text/javascript" src="http://www.luexu.com/_cdn/www/i.js"></script><script>// if logined move url to edit
if (Y.cookie('sso_sign_info')) {
    alert('已经登陆 ' + ' = ' +Y.cookie('sso_sign_info'));
    //window.location.href = '{^Url::edit}';
}


</script><style type="text/css">
    .l{width:770px;height:390px}
.c a{color:#3b5998}

.s-err-tip{line-height:42px}





#sso-sign-up-tab{margin:0 0 18px 0;border:1px solid #fff;height:42px;}
#sso-sign-up-tab a{width:50%;font:600 20px/42px "微软雅黑";}
#sso-sign-up-tab .sso-sign-up-tab-ao{background:#fff;color:#333;}


#sign-up-email{display: none}

/* 采用 16:10  如果用 16:9 会很长*/
.s-nation-flag{background:url(http://www.luexu.com/_cdn/www/reg_flag.png) no-repeat scroll 6px 10px #fff; width:32px; height:20px;padding:11px 6px;}
.s-nation-code{width:38px;height:42px;font:400 16px/42px "微软雅黑";color:#666;background:#fff;}
.s-mobile{width:206px}
.send-msg{width:120px;height:42px;font:400 16px/42px "微软雅黑";background:0;border:0;cursor:pointer;background:#aaa;color:#fff}
.send-msg-pause{cursor:text;}

.r{width:300px}


.reg-tab{margin:0 0 18px 0;border:1px solid #fff;height:42px;}
.reg-tab a{width:50%;font:600 20px/42px "微软雅黑";}
.reg-tab .reg-tab-ao{background:#fff;color:#333;}</style>
                </head>
                <body><div class="u">
    <div class="w po">

        <a href="/" class="p i" title="抢需求，上掠需！">抢需求，上掠需！</a>

        <div class="a p n">
            <a href="">首页</a>
            <a href="">掠需</a>
            <a href="">案例</a>
            <a href="">论文</a>
        </div>

        <div class="pr a t t-reg">
            <a href="http://www.luexu.com/sso/" class="sso-reg">注册</a>
            <a href="#" class="sso-line">|</a>
            <a href="http://www.luexu.com/sso/sign_in.html" class="sso-login">登陆</a>
        </div>
    </div>

</div>
                <div class="w-v">
                    <div class="w">
                        <div class="v">
          



<div class="q r">

    <div class="c">
        <div class="a" id="sso-sign-up-tab">
            <a href="http://www.luexu.com/sso/#phone" class="sso-sign-up-tab-ao">手机注册</a>
            <a href="http://www.luexu.com/sso/#email">邮箱注册</a>
        </div>
        <fieldset class="sso-sign-up-tab-block">
    <form method="post">
        <p class="s-err-tip"></p>


        <div class="ov">
            <a class="p s-nation-flag"></a>
            <span class="p s-nation-code">0086</span>
            <input type="text" data-type="placelen int" data-len="11" placeholder="请输入中国大陆手机号"
                   class="p s-input s-mobile" name="{^RQST_ACCOUNT}">
        </div>

        <div class="ov">
            <input type="text" data-type="int" data-len="4" class="p w-v-input w-v-svc" placeholder="短信激活码">
            <input type="button" class="p send-msg" value="获取短信">
        </div>

        <div>
            <input type="checkbox" checked="checked" disabled="disabled">
            我已阅读&同意
            <a href="#">《掠需网注册协议》</a>
        </div>


        <div class="submit-outer">
            <a href="#" id="s-login-submit"><span>注 册 掠 需</span></a>
        </div>
    </form>
</fieldset>
        <fieldset class="sso-sign-up-tab-block">
    <form method="post" id="sso_sign_up_email" class="sso_sign_up">

        <div class="ov">
            <input name="accounttype" class="sso_sign_up_account_type" type="hidden" value="3">
            <input name="account" class="p s-input sso_sign_up_account" type="text" data-type="placelen account" data-len="5-27" placeholder="请输入邮箱" value="951173723@qq.com">
        </div>

        <div class="sso_sign_up_vericode_item">
            <input name="" class="sso_sign_up_vericode" type="text" placeholder="激活码" data-type="" data-len="6">
            <a href="javascript:void(0)" class="sso_send_vericode">发送激活码</a>
        </div>

        <div>
            <input name="pwd" class="sso_sign_up_pwd" type="password" placeholder="密码" disabled="disabled">
        </div>


        <div>
            <input type="checkbox" checked="checked" disabled="disabled">
            我已阅读&同意
            <a href="#">《掠需网注册协议》</a>
        </div>


        <div class="sso-submit-item">
            <input class="sso_sign_up_submit" type="submit" value="注 册 掠 需"  disabled="disabled">
        </div>
    </form>
</fieldset>
    </div>
    <div>
        使用以下账号直接登陆
    </div>
</div>


<script type="text/javascript" src="http://www.luexu.com/_cdn/thrift0.9.1.js"></script><script type="text/javascript" src="http://www.luexu.com/_cdn/www/sso/sign/sso_types.js"></script><script type="text/javascript" src="http://www.luexu.com/_cdn/www/sso/sign/Sign.js"></script>


<script type="text/javascript">
    Y.D('sso-sign-up-tab', 'click');
    





/*
 var transport = new Thrift.Transport("http://c-b.luexu.com/v1/sso/");
 var protocol  = new Thrift.Protocol(transport);
 var handler = new Tf.Sso.SsoSignClient(protocol);

 try {
 var sign_info_st = new Tf.Sso.SignInfoSt();
 sign_info_st.email = '951173723@qq.com';
 sign_info_st.account_type = 3;
 sign_info_st.pwd = '123456';
 handler.signIn(sign_info_st);

 document.write("调用 hello 成功:<br>"+result);
 } catch(err){
 document.write("调用 hello 出错:<br>"+err.id+"<br>"+err.msg);
 }
 */

    
    /*
 *  是否传递了验证码和账号  vericode=123&account=xxxx
 * */

(function () {
    var v = Y.l('vericode'), a = Y.l('account');
    if (v && a) {
        var h = '#sso_sign_up_' + (window.location.hash.substr(1));
        $(h).find('.sso_sign_up_account').val(a).attr('disabled', true);
        $(h).find('.sso_sign_up_vericode').val(v);
        $(h).find('.sso_sign_up_vericode').attr('disabled', true);
        vericodeSent($(h));

    }
})();


function vericodeSent(form) {
    $(form).find('.sso_send_vericode').hide();
    $(form).find('.sso_sign_up_pwd').attr('disabled', false);
    $(form).find('.sso_sign_up_submit').attr('disabled', false);
}


$('.sso_send_vericode').click(function () {
    var s = $(this).parents('form'), a = $(s).find('.sso_sign_up_account').val(), a_type = $(s).find('.sso_sign_up_account_type').val();

    try {
        tfSendVericodeForSignUp(a, a_type);
        vericodeSent(s);

    } catch (e) {
        YS.errTip(this, e);
    }
});


/*
 * 默认错误
 * */
function Err(e) {
    /// console.log(Tf.Sso.ErrIdEnum);
    var x = Tf.Sso.ErrIdEnum;
    var m = function (s) {
        return e.msg || s
    }
    switch (e.id) {
        case x.ERR_SERVER:
            throw m('服务器错误');
            break;
        case x.ERR_NOT_EXISTS:
            throw m('没有找到');
            break;
        case x.ERR_REPEATED:
            throw m('重复');
            break;
        case x.ERR_USER_INPUT:
            throw m('输入错误');
            break;
        case x.ERR_CAPTCHA:
            throw m('验证码错误');
            break;
        case x.ERR_VERIFY:
            throw m('验证错误');
            break;
        case x.ERR_PERMISSION:
            throw m('权限错误');
            break;
        default:
            throw m('未知错误');
    }
}


function tfSendVericodeForSignUp(a, a_type) {
    try {
        var transport = new Thrift.Transport("http://www.luexu.com/api.luexu.com/1/sso/?p=json");
        var protocol = new Thrift.Protocol(transport);
        var tfSsoSign = new Tf.Sso.SignClient(protocol);
        tfSsoSign.isAccountValid(a, a_type);
        tfSsoSign.sendVericodeForSignUp(a, a_type);

    } catch (e) {
        Err(e);
    }

}


$('.sso_sign_up').submit(function (e) {
    e.preventDefault();

    var vericode = $(this).find('.sso_sign_up_vericode').val(), pwd=$(this).find('.sso_sign_up_pwd').val();

    try {
        var transport = new Thrift.Transport("http://www.luexu.com/api.luexu.com/1/sso/?p=json");
        var protocol = new Thrift.Protocol(transport);
        var tfSsoSign = new Tf.Sso.SignClient(protocol);
        tfSsoSign.verify(vericode);
        tfSsoSign.initPwd(pwd);
        alert('注册成功，执行跳转');

    } catch (e) {
        Err(e);
    }



});
</script>
                        </div>
          
                    </div>
                </div>
          <script type="text/javascript" src="http://www.luexu.com/_cdn/www/i.js"></script><script type="text/javascript" src="http://www.luexu.com/_cdn/ys.js"></script>
                </body>
                </html>
              