<?php
if (!defined("IN_IVB"))
	exit("Access Denied");

if ($logger_uid < 1)
{
	include(APP_DIR.'login.php');
	return;
}
$who = isset($requests[0]) ? intval($requests[0]) : 0;
if ($who < 1 || !($whosname = $db->result_first("SELECT username FROM ".DBPREFIX."members WHERE uid = {$who}")))
{
	$error_status = false;
	$error_message = "您希望关注的用户不存在，或已被删除";
	include(template("message"));
	return;
}

if (!empty($_POST['submit_post']))
{
	include(INCLUDE_DIR."user.func.php");
	$action = isset($_POST['action']) && $_POST['action'] == 'del' ? 'del' : 'add';
	if (user_follow($who, $whosname, $action))
	{
		$error_status = true;
		$error_message = '恭喜您，对用户"'.$whosname.'"的'.($action == 'del' ? '取消' : '').'关注操作成功';
	}
	else
	{
		$error_status = false;
		$error_message = '您对用户"'.$whosname.'"的'.($action == 'del' ? '取消' : '').'关注操作失败，请稍候重试';
	}
	include(template("message"));
	return;
}

$action = isset($requests[1]) ? trim($requests[1]) : '';
include(template("follow"));
?>