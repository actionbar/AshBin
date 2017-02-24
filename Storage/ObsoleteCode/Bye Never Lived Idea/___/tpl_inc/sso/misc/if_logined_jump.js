// if logined move url to edit
if (Y.cookie('{<CookieName::SSO_SESS_VAL}')) {
    alert('已经登陆 ' + ' = ' +Y.cookie('{<CookieName::SSO_SESS_VAL}'));
    //window.location.href = '{^Url::edit}';
}


