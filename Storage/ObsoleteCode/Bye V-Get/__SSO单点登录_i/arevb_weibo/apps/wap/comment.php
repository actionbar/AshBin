<?php
if (!defined("IN_IVB"))
	exit("Access Denied");

$cmtid = isset($requests[0]) ? intval($requests[0]) : 0;
$action = isset($requests[1]) ? trim($requests[1]) : "";
if ($action == 'del') 
{
	if ($logger_uid < 1) 
	{
		include(APP_DIR."login.php");
		return;
	}
	if (!empty($_POST['submit_post']))
	{
		include_once(INCLUDE_DIR."comment.func.php");
		if (del_comment($logger_uid, $cmtid))
		{
			$error_status = true;
			$error_message = "恭喜您，删除评论成功";
		}
		else
		{
			$error_status = false;
			$error_message = "删除评论失败，请稍候重试";
		}
		include(template("message"));
		return;
	}

	include(template("comment"));
}
else
{
	include(APP_DIR."home.php");
}
?>