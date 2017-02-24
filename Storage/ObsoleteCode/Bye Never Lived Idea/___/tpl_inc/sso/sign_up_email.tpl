<fieldset class="sso-sign-up-tab-block">
    <form method="post" id="sso_sign_up_email" class="sso_sign_up">

        <div class="ov">
            <input name="{<Param::ACCOUNT_TYPE}" class="sso_sign_up_account_type" type="hidden" value="{<\Tf\Sso\AccountTypeEnum::EMAIL}">
            <input name="{<Param::ACCOUNT}" class="p s-input sso_sign_up_account" type="text" data-type="placelen account" data-len="5-27" placeholder="请输入邮箱" value="951173723@qq.com">
        </div>

        <div class="sso_sign_up_vericode_item">
            <input name="" class="sso_sign_up_vericode" type="text" placeholder="激活码" data-type="" data-len="6">
            <a href="javascript:void(0)" class="sso_send_vericode">发送激活码</a>
        </div>

        <div>
            <input name="{<Param::PWD}" class="sso_sign_up_pwd" type="password" placeholder="密码" disabled="disabled">
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