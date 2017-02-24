<?php
if (!defined("IN_IVB"))
	exit("Access Denied");

$search_item = isset($requests[0]) ? trim($requests[0]) : "";
$keyword = isset($_REQUEST['keyword']) ? addslashes(stripslashes(trim($_REQUEST['keyword']))) : "";
if ($search_item == 'tag')
{
	if (empty($keyword))
	{
		$error_status = false;
		$error_message = "未找到您所需要的结果，请返回重新查找";
		include(template("message"));
		return;
	}
	$total = $db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."tag2note WHERE tagname = '{$keyword}'");
	$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
	$current = max($current, 1);
	$perpage = 10;
	$pages = ceil($total/$perpage);
	$current = min($current, $pages);
	if ($current < 1)
	{
		$tag_notes = array();
	}
	else
	{
		include_once(INCLUDE_DIR . "note.func.php");
		$query = $db->query("SELECT n.* FROM ".DBPREFIX."tag2note t LEFT JOIN ".DBPREFIX."notes n ON n.nid = t.nid WHERE t.tagname = '{$keyword}' ORDER BY nid DESC LIMIT ".(($current - 1)*$perpage).", ".$perpage);
		$tag_notes = array();
		while ($data = $db->fetch_array($query))
		{
			$data['note'] = parse_text($data['note']);
			$data['sgmdate'] = sgmdate($data['dateline']);
			$tag_notes[] = $data;
		}
	}
	if (empty($tag_notes))
	{
		$error_status = false;
		$error_message = "未找到您所需要的结果，请返回重新查找";
		include(template("message"));
		return;
	}
	$pagehtml = wappages($pages, $current, miniurl("search/tag?keyword=".stripslashes($keyword)));
}
elseif ($search_item == 'tags')
{
	$total = $db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."tags" . (empty($keyword) ? "" : " WHERE tagname LIKE '%$keyword%'"));
	$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
	$current = max($current, 1);
	$perpage = 10;
	$pages = ceil($total/$perpage);
	$current = min($current, $pages);
	if ($current < 1)
	{
		$search_tags = array();
	}
	else
	{
		$query = $db->query("SELECT * FROM ".DBPREFIX."tags" . (empty($keyword) ? "" : " WHERE tagname LIKE '%$keyword%'")." ORDER BY total DESC, updateline DESC LIMIT ".(($current - 1)*$perpage).", ".$perpage);
		while ($data = $db->fetch_array($query))
		{ 
			$search_tags[] = $data;
		}
	}
	$pagehtml = wappages($pages, $current, miniurl("search/tags?keyword=".stripslashes($keyword)));
}
elseif ($search_item == 'people')
{
	$total = $db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."members".(empty($keyword) ? "" : " WHERE username LIKE '%$keyword%'"));
	$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
	$current = max($current, 1);
	$perpage = 10;
	$pages = ceil($total/$perpage);
	$current = min($current, $pages);
	if ($current < 1)
	{
		$search_peoples = array();
	}
	else
	{
		$query = $db->query("SELECT uid, username, lastvisit, notes, fans, follows FROM ".DBPREFIX."members".(empty($keyword) ? "" : " WHERE username LIKE '%$keyword%'")." ORDER BY lastvisit DESC LIMIT ".(($current - 1)*$perpage).", ".$perpage);
		while ($data = $db->fetch_array($query))
		{
			$search_peoples[] = $data;
		}
	}
	$pagehtml = wappages($pages, $current, miniurl("search/people?keyword=".stripslashes($keyword)));
}
else
{
	include(APP_DIR.'home.php');
	return;
}
include(template("search"));
?>