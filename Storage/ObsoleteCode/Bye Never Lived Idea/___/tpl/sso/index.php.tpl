<!--
layoutIndex
sh=掠需注册
sd=fsdasdfsa
sk=dfas,dfss
-->
<style>
    {<->inc('sso/misc/i.css')}
</style>



<div class="q r">

    <div class="c">
        <div class="a" id="sso-sign-up-tab">
            <a href="{<Url::SSO_SIGN_UP_PHONE}" class="sso-sign-up-tab-ao">手机注册</a>
            <a href="{<Url::SSO_SIGN_UP_EMAIL}">邮箱注册</a>
        </div>
        {<->inc('sso/sign_up_phone')}
        {<->inc('sso/sign_up_email')}
    </div>
    <div>
        使用以下账号直接登陆
    </div>
</div>


{<->embed([
Url_s::_THRIFT,
Url_s::WWW_SSO_SIGN_TF_SIGN_TYPES,
Url_s::WWW_SSO_SIGN_TF_SIGN
])}


<script type="text/javascript">
    Y.D('sso-sign-up-tab', 'click');
    {<->inc('sso/misc/i.js')}
    {<->inc('sso/misc/sign_up_phone.js')}
    {<->inc('sso/misc/sign_up_email.js')}
</script>