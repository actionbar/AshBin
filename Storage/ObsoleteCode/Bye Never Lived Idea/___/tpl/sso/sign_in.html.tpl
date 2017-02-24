<!--
layoutIndex
sh=登陆掠需
sd=fsdasdfsa
sk=dfas,dfss
-->
<style>
    {<->inc('sso/misc/i.css')}
    {<->inc('sso/misc/login.css')}
</style>


<div class="p l">
    <div id="a770x390"></div>
</div>

<div class="q r">
    <div class="sso-pop-sign-in">
        <form method="post" class="po-p sso-sign-in" id="sso-sign-in">
            <input name="{<Param::ACCOUNT_TYPE}" id="sso-account-type" type="hidden">

            <p>
                <label id="sso-label-account" class="sso-label sso-label-account"
                       for="sso-account">{<Lang::ACCOUNT_USERNAME}/手机/邮箱</label>
                <input name="{<Param::ACCOUNT}" id="sso-account" class="sso-input" type="text"
                       data-type="placelen account" data-len="5-27" placeholder="{<Lang::ACCOUNT_USERNAME}/手机/邮箱">
            </p>

            <p>
                <label id="sso-label-pwd" class="sso-label sso-label-pwd" for="sso-pwd">密码</label>
                <input name="{<Param::PWD}" id="sso-pwd" class="sso-input" type="password" data-len="6-21"
                       placeholder="请输入密码">
            </p>

            <p class="a ov sso-captcha-item">
                <label id="sso-label-captcha" class="sso-label sso-label-captcha" for="sso-captcha">密码</label>
                <input name="{<Param::CAPTCHA}" id="sso-captcha" class="p sso-input sso-captcha" type="text"
                       data-len="4" data-type="captcha" autocomplete="off" placeholder="验证码">
                <a href="#" id="sso-captcha-img" class="sso-captcha-img"></a>
                <a href="#" id="sso-captcha-change" class="sso-captcha-change">换一张</a>
            </p>

            <p>
                <input type="checkbox" checked="checked">
                下次自动登陆
                <a href="#" class="pr">忘记密码</a>
            </p>


            <p class="sso-submit-item">
                <input class="sso-submit" type="submit" value="登 陆 掠 需">
            </p>

            <p>
                使用以下账号直接登陆
                <a class="pr" href="{<Url::SSO_SIGN_UP}">立即注册</a>
            </p>

        </form>
    </div>
</div>

{<->embed([
    Url_s::_THRIFT,
    Url_s::WWW_SSO_SIGN_TF_SIGN_TYPES,
    Url_s::WWW_SSO_SIGN_TF_SIGN
])}

<script>


    {<->inc([
        'sso/misc/i.js',
        'sso/misc/login.js'
    ])}

    Y.J('http://www.luexu.com/_cdn/_misc/ad/sso.js', function () {
        $('#a770x390').html(ad)
    });



</script>
