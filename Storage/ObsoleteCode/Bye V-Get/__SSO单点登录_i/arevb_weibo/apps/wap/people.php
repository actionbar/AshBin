<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

if (!$request_user)
{
	include(APP_DIR.'home.php');
	return;
}

$action = isset($requests[1]) ? trim($requests[1]) : "";
$request_user['atmes'] = $db->result_first("SELECT count(*) FROM ".DBPREFIX."note_mentioned WHERE uid = {$request_user['uid']}", "UNBUFFERED");

if ($action == 'atme') 
{
	include_once(INCLUDE_DIR . "note.func.php");
	include_once(INCLUDE_DIR . "user.func.php");
	$atmes = get_user_atmes($request_user['uid']);
	$total = $current = $pages = $perpage = 0;
	if ($atmes)
	{
		$total = $atmes['total'];
		$current = $atmes['current'];
		$pages = $atmes['pages'];
		$perpage = $atmes['perpage'];
		$atmes = $atmes['data'];
		$pagehtml = wappages($pages, $current, miniurl($request_user['uid'].'/atme'));
	}
}
elseif ($action == 'fans')
{
	include_once(INCLUDE_DIR . "user.func.php");
	$fans = get_user_follows($request_user['uid']);
	if ($fans)
	{
		$total = $fans['total'];
		$current = $fans['current'];
		$pages = $fans['pages'];
		$perpage = $fans['perpage'];
		$fans = $fans['data'];
		$pagehtml = wappages($pages, $current, miniurl($request_user['uid'].'/fans'));
	}
}
elseif ($action == 'follows')
{
	include_once(INCLUDE_DIR . "user.func.php");
	$follows = get_user_follows($request_user['uid'], "follows|page");
	if ($follows)
	{
		$total = $follows['total'];
		$current = $follows['current'];
		$pages = $follows['pages'];
		$perpage = $follows['perpage'];
		$follows = $follows['data'];
		$pagehtml = wappages($pages, $current, miniurl($request_user['uid'].'/follows'));
	}
}
elseif ($action == 'comments')
{
	if ($logger_uid < 1)
	{
		include(APP_DIR."login.php");
		return;
	}
	include_once(INCLUDE_DIR."comment.func.php");
	$comments = get_user_comments($logger_uid);
	if ($comments)
	{
		$total = $comments['total'];
		$current = $comments['current'];
		$pages = $comments['pages'];
		$perpage = $comments['perpage'];
		$comments = $comments['data'];
		$pagehtml = wappages($pages, $current, miniurl($request_user['uid'].'/comments'));
	}
}
else
{
	include_once(INCLUDE_DIR . "note.func.php");
	$my_blogs = array();
	$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
	$current = max($current, 1);
	$total = $request_user['notes'];
	$perpage = 10;
	$pages = ceil($total/$perpage);
	$current = min($current, $pages);
	if ($current < 1)
	{
		$my_blogs = array();
	}
	else
	{
		$query = $db->query("SELECT * FROM ".DBPREFIX."notes WHERE uid = {$request_user['uid']} ORDER BY nid DESC LIMIT ".(($current - 1)*$perpage).", ".$perpage);
		while ($data = $db->fetch_array($query))
		{
			$data['note'] = parse_text($data['note']);
			$data['sgmdate'] = sgmdate($data['dateline']);
			$my_blogs[] = $data;
		}
	}
	$pagehtml = wappages($pages, $current, miniurl($request_user['uid']));
}

include(template("people"));
?>