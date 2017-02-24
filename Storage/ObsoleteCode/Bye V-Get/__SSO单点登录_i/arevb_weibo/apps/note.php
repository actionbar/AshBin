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
		$error_status = false;
		$error_message = "请先登录后再操作";
	}
	elseif (!empty($_POST['submit_post']))
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
	}
	exit(json_encode(array('success' => $error_status, 'message' => $error_message)));
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
		}
		include_once(INCLUDE_DIR."note.func.php");
		// 处理上传图片等信息
		$attaches = null;
		$attaches['img'] = upload_attach('upload_image');
		if (!$attaches['img'])
		{
			unset($attaches['img']);
		}
		if (isset($_POST['link_url']) && !empty($_POST['link_url']) && $_POST['link_url'] != 'http://')
		{
			$_POST['link_url'] = trim($_POST['link_url']);
			$attaches['link']['name'] = empty($_POST['link_name']) ? $_POST['link_url'] : trim($_POST['link_name']);
			$_POST['link_url'] = substr($_POST['link_url'], 0, 7) != 'http://' ? 'http://'.$_POST['link_url'] : $_POST['link_url'];
			$attaches['link']['attachment'] = $_POST['link_url'];
		}
		if (add_note($content, $attaches))
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
	$output = json_encode(array('success' => $error_status, 'message' => $error_message));
	print("<script type='text/javascript'>parent.onPostOver({$output})</script>");
	return;
}
elseif ($action == 'refer')
{
	if ($logger_uid < 1)
	{
		exit("请先登录后再操作");
	}
	include_once(INCLUDE_DIR."note.func.php");
	$note_to_refer = get_note($nid);
	if (!$note_to_refer)
	{
		exit("您想转发的微博不存在或已被删除");
	}
	$note_to_refer['note'] = parse_text($note_to_refer['note']);

	if ($note_to_refer['uid'] == $logger_uid) 
	{
		exit("请不要转发自己的微博");
	}
	if (!empty($_POST['submit_post']))
	{
		$content = isset($_POST['content']) ? addslashes(stripslashes(trim($_POST['content']))) : "";
		if (mb_strlen($content) > 140)
		{
			$content = mb_substr(stripslashes($content), 0, 140);
		}
		if (add_note($content, null, $nid))
		{
			$error_message = "恭喜您，转发微博成功";
		}
		else
		{
			$error_message = "转发微博失败，请您稍候重新发布";
		}
		exit($error_message);
	}
}
elseif ($action == 'comment')
{
	include_once(INCLUDE_DIR."note.func.php");
	$note_to_comment = get_note($nid);
	if (!empty($_POST['submit_post']))
	{
		$content = isset($_POST['content']) ? addslashes(stripslashes(trim($_POST['content']))) : "";
		if (mb_strlen($content) > 140)
		{
			$content = mb_substr(stripslashes($content), 0, 140);
		}
		include_once(INCLUDE_DIR."comment.func.php");
		if (!$note_to_comment)
		{
			$error_status = false;
			$error_message = "您要评论的微博不存在或已被删除";
		}
		elseif ($logger_uid < 1)
		{
			$error_status = false;
			$error_message = "请先登录后再发表评论";
		}
		elseif (add_comment($nid, $content))
		{
			$error_status = true;
			$error_message = "恭喜您，评论微博成功";
		}
		else
		{
			$error_status = false;
			$error_message = "评论微博失败，请您稍候重新发布";
		}
		exit(json_encode(array('success' => $error_status)));
	}
	else
	{
		if (!$note_to_comment)
		{
			$error_status = false;
			$error_message = "您要评论的微博不存在或已被删除";
			include(template("message"));
			return;
		}
		include_once(INCLUDE_DIR."note.func.php");
		$note_to_comment['note'] = parse_text($note_to_comment['note']);
		$people_info = $db->fetch_first("SELECT * FROM ".DBPREFIX."members WHERE uid = ".$note_to_comment['uid']." LIMIT 1");
	}
	$comments = get_comments($nid, 'page', 30);
}
else
{
	include(APP_DIR.'home.php');
	return;
}

include(template("note"));
?>