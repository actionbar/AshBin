<?php
// Request

// 不需要post的，用一个字符；需要post的，用s开头
define('RQST_URL_RETURN', 'rtn');


define('RQST_ACCOUNT','ssoa');
define('RQST_ACCOUNT_TYPE','ssot');
define('RQST_PASSWORD','ssop');

// 任何重置密码都需要手机、邮箱验证，不再需要new password
//define('RQST_NEW_PASSWORD','ssopnew');
define('RQST_NETWORK','snetwork');
define('RQST_DEVICE_ID','sdevid');
define('RQST_DEVICE_CONFIG_ID','sdevconfid');


define('RQST_SSO_TOKEN', 'sso_token');
define('RQST_SSO_SESS_ID', 'sso_sess_id');
define('RQST_SSO_SESS_NAME', 'sso_sess_name');
define('RQST_SSO_SHOW_CAPTCHA', 'sso_show_captcha');


define('RQST_SSO_USERNAME', 'suser');
define('RQST_SSO_MAIL', 'smail');
define('RQST_SSO_MOBILE', 'smobile');

define('RQST_SSO_USER_STATUS', 'sso_user_status');
define('RQST_SSO_AVATAR', 'sso_user_avatar');
define('RQST_SSO_AVATAR_DEFAULT_URL', 'sso_user_avatar');


define('RQST_LONGITUDE', 'slo');
define('RQST_LATITUDE', 'sla');

define('RQST_VERIFY_CODE', 'svc');
define('RQST_CAPTCHA_CODE', 'scaptcha');

define('RQST_LIMIT', 'lmt');  // LIMIT  limit, offset
define('RQST_OFFSET', 'off');

define('RQST_PAGE', 'pg');
define('RQST_HEADER', 'sh');
define('RQST_DESCRIPTION', 'sd');
define('RQST_KEYWORDS', 'sk');
define('RQST_FILETEXT', 'sf');
define('RQST_TIME', 'st');