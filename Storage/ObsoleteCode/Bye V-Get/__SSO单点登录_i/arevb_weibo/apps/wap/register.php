<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

if ($logger_uid > 0)
{
	include(APP_DIR."home.php");
	return;
}

if ($cache_settings['wapregister'] != 1)
{
	$error_status = false;
	$error_message = "请通过web网站注册，谢谢。";
	include(template("message"));
	return;
}

if (!empty($_POST['submit_post']))
{
	$username = isset($_POST['username']) ? trim($_POST['username']) : "";
	$password = isset($_POST['password']) ? trim($_POST['password']) : "";
	$repassword = isset($_POST['repassword']) ? trim($_POST['repassword']) : "";
	$email = isset($_POST['email']) ? trim($_POST['email']) : "";
	$seccode = isset($_POST['seccode']) ? intval($_POST['seccode']) : "";
	eval("\$secresult=".$_DSESSION['seccode'].";");

	if (!$username || $username != addslashes($username))
	{
		$error_message = "您所输入的用户名不合法。";
	}
	elseif ($db->result_first("SELECT uid FROM ".DBPREFIX."members WHERE username = '{$username}'"))
	{
		$error_message = "您所输入的用户名已存在。";
	}
	elseif (strlen($password) < 6 || strlen($password) > 20 || $password != $repassword)
	{
		$error_message = "密码输入不合法，请保证密码长度大于5小于20，并且两次密码输入相同。";
	}
	elseif (strlen($email) < 7 || !preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email))
	{
		$error_message = "您输入的Email格式不合法。";
	}
	elseif ($db->result_first("SELECT uid FROM ".DBPREFIX."members WHERE email = '{$email}' LIMIT 1"))
	{
		$error_message = "您所输入的Email已被注册。";
	}
	elseif ($secresult != $seccode)
	{
		$error_message = "您所输入的验证码错误";
	}
	else
	{
		$db->query("INSERT INTO ".DBPREFIX."members(username, password, regip, regdate, lastvisit, lastactivity, email) VALUES('{$username}', '".md5($password)."', '{$onlineip}', '{$timestamp}', '{$timestamp}', '{$timestamp}', '{$email}')");
		if ($db->affected_rows() > 0)
		{
			$error_status = true;
			$error_message = "恭喜您，成功注册了本站会员";
		}
		else
		{
			$error_status = false;
			$error_message = "注册过程出现错误，请您检查输入是否有误，并稍后重试";
		}
		include(template("message"));
		return;
	}
	$_DSESSION['seccode'] = random_equal();
	updatesession();
}
else
{
	if (isset($requests[0]) && $requests[0] == 'seccode')
	{
		$_DSESSION['seccode'] = random_equal();
		updatesession();
	}
}

include(template("register"));
?>