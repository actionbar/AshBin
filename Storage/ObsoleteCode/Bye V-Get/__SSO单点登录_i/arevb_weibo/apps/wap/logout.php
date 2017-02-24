<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");
if ($logger_uid < 1)
{
	$error_status = true;
	clearcookies();
}
else
{
	include_once(INCLUDE_DIR . "user.func.php");
	$_DSESSION['seccode'] = random_equal();
	$error_status = user_logout();
}
if ($error_status)
{
	$error_message = "您已经成功退出。";
}
else
{
	$error_message = "退出失败，系统错误，您可以稍候重试。";
}
include(template("message"));
?>