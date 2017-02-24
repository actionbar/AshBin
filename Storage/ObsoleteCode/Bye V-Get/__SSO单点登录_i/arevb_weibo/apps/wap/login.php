<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

if ($logger_uid > 0)
{
	include(APP_DIR."home.php");
	return;
}
if (!empty($_POST['submit_post']))
{
	include_once(INCLUDE_DIR . 'user.func.php');
	$username = isset($_POST['username']) ? trim($_POST['username']) : "";
	$password = isset($_POST['password']) ? trim($_POST['password']) : "";

	$_DSESSION['seccode'] = random_equal();
	$error_status = user_login($username, $password);
	if ($error_status)
	{
		$error_message = "您好，{$username} 欢迎您回来！";
	}
	else
	{
		$error_message = "您所输入的用户名或密码错误，请返回重新输入。";
	}
	include(template("message"));
	exit();
}

include(template("login"));

exit();
?>