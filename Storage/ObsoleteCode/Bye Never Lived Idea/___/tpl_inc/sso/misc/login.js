/*
 *  thrift
 * */

var tfSsoSign = function () {

};


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


function tfSignIn(a, a_type, p, c) {
    try {
        var transport = new Thrift.Transport("http://www.luexu.com/api.luexu.com/1/sso/?p=json");
        var protocol = new Thrift.Protocol(transport);
        var tfSsoSign = new Tf.Sso.SignClient(protocol);
        var sign_in_st = new Tf.Sso.SignInSt();
        sign_in_st.account = a;
        sign_in_st.account_type = a_type;
        sign_in_st.pwd = p;
        sign_in_st.captcha = c.toLowerCase();
        tfSsoSign.signIn(sign_in_st);
        signInJump();

    } catch (e) {
        Err(e);
    }

}

function signInJump() {
    alert('登陆成功');
}


$("#sso-sign-in").submit(function (e) {
    e.preventDefault();
    var a = $('#sso-account').val(), p = $('#sso-pwd').val(), c = $('#sso-captcha').val();
    try {
        tfSignIn(a, 0, p, c);
    }
    catch (e) {
        showCaptcha('#sso-captcha-img');
        YS.errTip(this, e);
    }


});


function showCaptcha(c) {
    var i = c + ' img';

    function f() {
        $(i).hide(99);
        var l = $(i).prop('src');
        l = l.replace(/(\&t=)\d+/, '$1' + Y.t());
        $(i).prop('src', l);
        $(i).show(99);
    }

    if ($(i).attr('src')) {
        f();
    }
    else {
        $('.sso-captcha-outer').show(100);

        var l = 'http://www.luexu.com/api.luexu.com/cgi-bin/captcha/?w=' + $(c).width() + '&h=' + $(c).height() + '&f=' + $(c).css('font-size').replace('px', '') + '&t=' + Y.t();

        var s = '<img src="' + l + '" alt="验证码">';
        $(c).append(s);
        $('#sso-captcha-change').click(function () {
            f()
        });
    }

}