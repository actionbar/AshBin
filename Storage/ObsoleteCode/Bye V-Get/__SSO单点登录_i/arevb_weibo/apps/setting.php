<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

if ($logger_uid < 1)
{
	include(APP_DIR.'login.php');
	return;
}

$action = isset($requests[0]) ? trim($requests[0]) : "";
if ($action == 'avatar') 
{
	if (!empty($_POST['submit_post']))
	{
		include_once(INCLUDE_DIR."image.func.php");
		if (upload_avatar($logger_uid, 'newavatar'))
		{
			$error_message = "恭喜您，上传新头像成功。";
		}
		else
		{
			$error_message = "上传新头像失败，请稍候重试。";
		}
		$url_forward = miniurl("setting/avatar");
		include(template("message"));
		return;
	}
}
elseif ($action == 'password')
{
	if (!empty($_POST['submit_post']))
	{
		$old_pass = isset($_POST['password']) ? trim($_POST['password']) : "";
		$new_pass = isset($_POST['npassword']) ? trim($_POST['npassword']) : "";
		$rnew_pass = isset($_POST['rnpassword']) ? trim($_POST['rnpassword']) : "";

		if (md5($old_pass) != $_DSESSION['logger_pw'])
		{
			$error_message = "当前密码不匹配，请重新输入。";
		}
		elseif (strlen($new_pass) < 6 || strlen($new_pass) > 20 || $new_pass != $rnew_pass)
		{
			$error_message = "新密码输入不合法，请保证密码长度大于5小于20，并且两次密码输入相同。";
		}
		else
		{
			$db->query("UPDATE ".DBPREFIX."members SET password = '".md5($new_pass)."' WHERE uid = {$logger_uid} LIMIT 1");
			if ($db->affected_rows() > 0) 
			{
				$error_message = "恭喜您，修改密码成功。";
			}
			else
			{
				$error_message = "修改密码失败，请稍候重试。";
			}
		}
		$url_forward = miniurl("setting/password");
		include(template("message"));
		return;
	}
}
elseif ($action == 'web')
{
	if ($_DSESSION['is_admin'] != 1) 
	{
		$error_message = "对不起，此服务只针对管理员。";
		include(template('message'));
		return;
	}

	include(APP_DIR.'adminset.php');
	return;
}
else
{
	$action = 'profile';
	$profile_info = $db->fetch_first("SELECT gender, email, bday FROM ".DBPREFIX."members WHERE uid = {$logger_uid} LIMIT 1");
	if (!empty($_POST['submit_post']))
	{
		$gender = isset($_POST['gender']) ? intval($_POST['gender']) : 0;
		$email = isset($_POST['email']) ? trim($_POST['email']) : "";
		$bday_y = isset($_POST['bday_year']) ? intval($_POST['bday_year']) : "";
		$bday_m = isset($_POST['bday_month']) ? intval($_POST['bday_month']) : "";
		$bday_d = isset($_POST['bday_day']) ? intval($_POST['bday_day']) : "";
		if ($bday_y < 1980 || $bday_y > date("Y", $timestamp) || $bday_m < 1 || $bday_m > 12 || $bday_d < 1 || $bday_d > 31)
		{
			$bday = '0000-00-00';
		}
		else
		{
			$bday = $bday_y.'-'.$bday_m.'-'.$bday_d;
		}
		if (($gender !== 0 && $gender !== 1 && $gender !== 2) || $gender == $profile_info['gender'])
		{
			$gender = -1;
		}
		if (strlen($email) < 7 || !preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email))
		{
			$email = '';
		}
		if (!preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", $bday) || $bday == $profile_info['bday'])
		{
			$bday = '';
		}
		if ($email == $profile_info['email'])
		{
			$email = '';
		}
		else
		{
			$error_message = "您所输入的Email已被注册。";
		}

		if (empty($error_message) && ($gender > -1 || !empty($email) || !empty($bday)))
		{
			$sql = "UPDATE ".DBPREFIX."members SET ";
			$gender > -1 && ($sql .= "gender = {$gender}, ");
			!empty($email) && ($sql .= "email = '".addslashes(stripslashes($email))."', ");
			!empty($bday) && ($sql .= "bday = '{$bday}', ");
			$sql = trim($sql, ', ');
			$sql .= " WHERE uid = '{$logger_uid}' LIMIT 1";
			$db->query($sql);
			if ($db->affected_rows() > 0)
			{
				$error_message = "恭喜您，编辑用户信息成功。";
			}
			else
			{
				$error_message = "编辑用户信息失败，请稍候重试";
			}
		}
		else
		{
			$error_message = "恭喜您，编辑用户信息成功。";
		}
		$url_forward = miniurl("setting");
		include(template("message"));
		return;
	}
	$email = $profile_info['email'];
	$gender = $profile_info['gender'];
	list($bday_y, $bday_m, $bday_d) = explode('-', $profile_info['bday']);
}

$menuon = 'setting';
include(template('setting'));
?>