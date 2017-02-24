<?php
function add_comment($nid, $content) 
{
	global $db, $logger_uid, $logger_user, $timestamp;
	if ($logger_uid < 1 || !$logger_user)
	{
		return false;
	}
	$nid = intval($nid);
	$content = preg_replace("/\<[^\<\>]*\>/i", " ", $content);
	if ($nid < 1 || empty($content))
	{
		return false;
	}
	$content = htmlspecialchars($content, ENT_QUOTES);
	$db->query("INSERT INTO ".DBPREFIX."note_comments(nid, uid, username, dateline, comment, `from`) VALUES('{$nid}', '{$logger_uid}', '{$logger_user}', '{$timestamp}', '{$content}', '".APP_CHANEL."')");
	if ($db->insert_id())
	{
		$db->query("UPDATE ".DBPREFIX."notes SET comments = comments+1 WHERE nid = {$nid} LIMIT 1");
		return true;
	}
	return false;
}

function del_comment($uid = 0, $mid = 0)
{
	global $db;
	$mid = intval($mid);
	$minfo = $db->fetch_first("SELECT * FROM ".DBPREFIX."note_comments WHERE mid = {$mid} LIMIT 1", "UNBUFFERED");
	if (!$minfo)
	{
		return true;
	}
	if ($uid != $minfo['uid'])
	{
		return false;
	}
	$db->query("DELETE FROM ".DBPREFIX."note_comments WHERE mid = {$mid} LIMIT 1");
	$db->query("UPDATE ".DBPREFIX."notes SET comments = comments-1 WHERE nid = '".$minfo['nid']."' LIMIT 1");
	return true;
}

function get_user_comments($uid = 0, $type = 'page', $perpage = 10)
{
	global $db;
	$uid = intval($uid);
	if ($uid < 1)
	{
		return null;
	}
	$perpage = intval($perpage);
	$perpage < 1 && ($perpage = 10);
	if ($gettype == 'limit')
	{
		return $db->fetch_all("SELECT m.*, n.uid AS note_uid, n.username AS note_user FROM ".DBPREFIX."note_comments m LEFT JOIN ".DBPREFIX."notes n ON n.nid = m.nid WHERE m.uid = {$uid} ORDER BY mid DESC LIMIT {$perpage}");
	}
	else
	{
		$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
		$current = max($current, 1);
		$total = $db->result_first("SELECT count(*) FROM ".DBPREFIX."note_comments WHERE uid = {$uid}", "UNBUFFERED");
		$pages = ceil($total/$perpage);
		$current = min($current, $pages);
		if ($current < 1)
		{
			return null;
		}
		$data = $db->fetch_all("SELECT m.*, n.uid AS note_uid, n.username AS note_user FROM ".DBPREFIX."note_comments m LEFT JOIN ".DBPREFIX."notes n ON n.nid = m.nid WHERE m.uid = {$uid} ORDER BY mid DESC LIMIT ".(($current - 1)*$perpage).", {$perpage}");
		return array('data' => $data, 'current' => $current, 'total' => $total, 'pages' => $pages, 'perpage' => $perpage);
	}
	return null;
}
?>