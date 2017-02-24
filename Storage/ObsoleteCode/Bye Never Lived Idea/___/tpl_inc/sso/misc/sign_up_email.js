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