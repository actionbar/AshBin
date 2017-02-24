<?php
if (!defined("IN_IVB"))
	exit("Access Denied");

$action = isset($requests[0]) ? trim($requests[0]) : "";
$nid = 0;
if (is_numeric($action))
{
	$nid = intval($action);
	$action = isset($requests[1]) ? trim($requests[1]) : "";
}
if (empty($action)) 
{
	include(APP_DIR.'home.php');
	return;
}

if ($action == 'del') 
{
	if ($logger_uid < 1)
	{
		include(APP_DIR.'login.php');
		return;
	}
	if (!empty($_POST['submit_post']))
	{
		include_once(INCLUDE_DIR."note.func.php");
		if (del_note($logger_uid, $nid))
		{
			$error_status = true;
			$error_message = "恭喜您，删除微博成功";
		}
		else
		{
			$error_status = false;
			$error_message = "删除微博失败，请稍候重试";
		}
		include(template("message"));
		return;
	}
}
elseif ($action == 'post')
{
	if ($logger_uid < 1)
	{
		include(APP_DIR.'login.php');
		return;
	}
	if (!empty($_POST['submit_post']))
	{
		$content = isset($_POST['content']) ? addslashes(stripslashes(trim($_POST['content']))) : "";
		if (mb_strlen($content) > 140)
		{
			$content = mb_substr(stripslashes($content), 0, 140);
			include(template("note"));
			return;
		}
		include_once(INCLUDE_DIR."note.func.php");
		if (add_note($content))
		{
			$error_status = true;
			$error_message = "恭喜您，发布微博成功";
		}
		else
		{
			$error_status = false;
			$error_message = "发布微博失败，请您稍候重新发布";
		}
	}
	else
	{
		$error_status = false;
		$error_message = "非法操作，请返回重试";
	}
	include(template("message"));
	return;
}
elseif ($action == 'refer')
{
	if ($logger_uid < 1)
	{
		include(APP_DIR.'login.php');
		return;
	}
	include_once(INCLUDE_DIR."note.func.php");
	$note_to_refer = get_note($nid);
	if (!$note_to_refer)
	{
		$error_status = false;
		$error_message = "您要转发的微博不存在或已被删除";
		include(template("message"));
		return;
	}
	if ($note_to_refer['uid'] == $logger_uid) 
	{
		$error_status = false;
		$error_message = "请不要转发自己的微博";
		include(template("message"));
		return;
	}
	if (!empty($_POST['submit_post']))
	{
		$content = isset($_POST['content']) ? addslashes(stripslashes(trim($_POST['content']))) : "";
		if (mb_strlen($content) > 140)
		{
			$content = mb_substr(stripslashes($content), 0, 140);
			$action = 'commentmore';
			include(template("note"));
			return;
		}
		if (add_note($content, null, $nid))
		{
			$error_status = true;
			$error_message = "恭喜您，转发微博成功";
		}
		else
		{
			$error_status = false;
			$error_message = "转发微博失败，请您稍候重新发布";
		}
		include(template("message"));
		return;
	}
}
elseif ($action == 'comment')
{
	include_once(INCLUDE_DIR."note.func.php");
	$note_to_comment = get_note($nid);
	if (!$note_to_comment)
	{
		$error_status = false;
		$error_message = "您要评论的微博不存在或已被删除";
		include(template("message"));
		return;
	}
	if (!empty($_POST['submit_post']))
	{
		if ($logger_uid < 1)
		{
			include(APP_DIR.'login.php');
			return;
		}
		$content = isset($_POST['content']) ? addslashes(stripslashes(trim($_POST['content']))) : "";
		if (mb_strlen($content) > 140)
		{
			$content = mb_substr(stripslashes($content), 0, 140);
			$action = 'refermore';
			include(template("note"));
			return;
		}
		include_once(INCLUDE_DIR."comment.func.php");
		if (add_comment($nid, $content))
		{
			$error_status = true;
			$error_message = "恭喜您，评论微博成功";
		}
		else
		{
			$error_status = false;
			$error_message = "评论微博失败，请您稍候重新发布";
		}
		include(template("message"));
		return;
	}
	else
	{
		include_once(INCLUDE_DIR."note.func.php");
		$note_to_comment['note'] = parse_text($note_to_comment['note']);
	}
	$comments = get_comments($nid, 'page');
}
else
{
	include(APP_DIR.'home.php');
	return;
}

include(template("note"));
?>