<?php
if (!defined("IN_IVB"))
	exit("Access Denied");

$cmtid = isset($requests[0]) ? intval($requests[0]) : 0;
$action = isset($requests[1]) ? trim($requests[1]) : "";
if ($action == 'del') 
{
	if (!empty($_POST['submit_post']))
	{
		include_once(INCLUDE_DIR."comment.func.php");
		if ($logger_uid < 1) 
		{
			$error_status = false;
			$error_message = "请先登录后再操作";
		}
		elseif (del_comment($logger_uid, $cmtid))
		{
			$error_status = true;
			$error_message = "恭喜您，删除评论成功";
		}
		else
		{
			$error_status = false;
			$error_message = "删除评论失败，请稍候重试";
		}
		exit(json_encode(array('success' => $error_status, 'message' => $error_message)));
	}
}

include(APP_DIR."home.php");
?>