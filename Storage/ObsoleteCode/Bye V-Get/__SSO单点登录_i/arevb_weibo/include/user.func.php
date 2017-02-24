<?php
/**
 * 这里是与用户相关的函数集
 */
function user_login($username, $password, $rememberme = false)
{
	global $db, $logger_uid, $logger_user, $logger_pw;
	if ($logger_uid > 0)
	{
		return false;
	}
	if (empty($username))
	{
		return false;
	}
	$username = daddslashes($username, 1, true);
	$password = md5($password);
	$userinfo = $db->fetch_array($db->query("SELECT * FROM ".DBPREFIX."members WHERE (username = '{$username}' OR email = '{$username}') AND `password` = '{$password}' LIMIT 1", "UNBUFFERED"));
	if (!$userinfo)
	{
		return false;
	}

	$logger_uid = $userinfo['uid'];
	$logger_user = $userinfo['username'];
	$logger_pw = $userinfo['password'];
	dsetcookie('sess_auth', authcode("{$logger_uid}\t{$logger_user}\t{$logger_pw}", 'ENCODE'), ($rememberme ? 31536000 : 86400), 1, true);
	updatesession();

	return true;
}

function user_logout()
{
	global $logger_uid, $logger_user, $logger_pw;
	if ($logger_uid)
	{
		clearcookies();
	}
	$logger_uid = 0;
	$logger_user = $logger_pw = '';
	updatesession();

	return true;
}

function get_user_by_id($uid)
{
	global $db;
	$uid = intval($uid);
	if ($uid < 1)
		return null;
	return $db->fetch_first("SELECT * FROM ".DBPREFIX."members WHERE uid = {$uid} LIMIT 1");
}

function user_follow($who, $whosname, $type = 'add')
{
	global $db, $logger_uid, $logger_user, $timestamp;
	if ($logger_uid < 1 || $logger_uid == $who)
	{
		return false; // not login
	}
	$who = intval($who);
	$whosname = addslashes(stripslashes(trim($whosname)));
	if (get_user_follow($logger_uid, $who) && $type == 'add')
	{
		return true; // 已经是我所关注的了
	}
	if (!get_user_follow($logger_uid, $who) && $type == 'del')
	{
		return true; // 不是我所关注的
	}
	if ($type == 'add')
	{
		$db->query("INSERT INTO ".DBPREFIX."fans(uid, username, who, whosname, addtime) VALUES('{$logger_uid}', '{$logger_user}', '{$who}', '{$whosname}', '{$timestamp}')");
		$db->query("UPDATE ".DBPREFIX."members SET fans = fans+1 WHERE uid = {$who} LIMIT 1");
		$db->query("UPDATE ".DBPREFIX."members SET follows = follows+1 WHERE uid = {$logger_uid} LIMIT 1");
	}
	elseif ($type == 'del')
	{
		$db->query("DELETE FROM ".DBPREFIX."fans WHERE uid = {$logger_uid} AND who = {$who} LIMIT 1");
		$db->query("UPDATE ".DBPREFIX."members SET fans = fans-1 WHERE uid = {$who} LIMIT 1");
		$db->query("UPDATE ".DBPREFIX."members SET follows = follows-1 WHERE uid = {$logger_uid} LIMIT 1");
	}

	return true;
}

function get_user_follow($whosid = 0, $whomid = 0)
{
	global $db;
	$whosid = intval($whosid);
	$whomid = intval($whomid);
	if ($whosid < 1 || $whomid < 1)
	{
		return false;
	}
	return $db->fetch_first("SELECT * FROM ".DBPREFIX."fans WHERE uid = {$whosid} AND who = {$whomid} LIMIT 1");
}

function get_user_follows($whosid = 0, $gettype = 'fans|page', $perpage = 20, $moreinfo = false)
{
	global $db;
	$whosid = max(0, intval($whosid));
	if ($whosid < 1)
	{
		return null;
	}
	@list($usefield, $gettype) = explode('|', $gettype);
	if (!$gettype || ($usefield != 'fans' && $usefield != 'follows'))
	{
		return null;
	}
	$perpage = intval($perpage);
	$perpage < 1 && ($perpage = 10);
	$joinfield = $usefield == 'fans' ? "uid" : "who";
	$usefield = $usefield == 'fans' ? "who" : "uid";
	$sql = $moreinfo ? "SELECT f.*, m.regdate, m.lastvisit, m.credits, m.notes, m.fans, m.follows FROM ".DBPREFIX."fans f LEFT JOIN ".DBPREFIX."members m ON f.{$joinfield} = m.uid WHERE f.{$usefield} = '{$whosid}' ORDER BY f.addtime DESC" : "SELECT * FROM ".DBPREFIX."fans WHERE {$usefield} = '{$whosid}' ORDER BY addtime DESC";
	if ($gettype == 'page') // 分页显示
	{
		$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
		$current = max($current, 1);
		$total = $db->result_first("SELECT count(*) FROM ".DBPREFIX."fans WHERE {$usefield} = '{$whosid}'", "UNBUFFERED");
		$pages = ceil($total/$perpage);
		$current = min($current, $pages);
		if ($current < 1)
		{
			return null;
		}
		$data = $db->fetch_all($sql . " LIMIT ".(($current - 1)*$perpage).", {$perpage}");
		return array('data' => $data, 'current' => $current, 'total' => $total, 'pages' => $pages, 'perpage' => $perpage);
	}
	elseif ($gettype == 'limit') // 显示perpage个
	{
		return $db->fetch_all($sql . " DESC LIMIT {$perpage}");
	}
	return null;
}

function get_user_atmes($uid = 0, $gettype = 'page', $perpage = 10)
{
	global $db;
	$uid = max(0, intval($uid));
	if ($uid < 1)
	{
		return null;
	}
	$perpage = intval($perpage);
	$perpage < 1 && ($perpage = 10);
	if ($gettype == 'page') // 分页显示
	{
		$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
		$current = max($current, 1);
		$total = $db->result_first("SELECT count(*) FROM ".DBPREFIX."note_mentioned WHERE uid = '{$uid}'", "UNBUFFERED");
		$pages = ceil($total/$perpage);
		$current = min($current, $pages);
		if ($current < 1)
		{
			return null;
		}
		$query = $db->query("SELECT n.* FROM ".DBPREFIX."note_mentioned m LEFT JOIN ".DBPREFIX."notes n ON n.nid = m.nid WHERE m.uid = {$uid} ORDER BY nid DESC LIMIT ".(($current - 1)*$perpage).", {$perpage}");
		$atmes = array();
		while($data = $db->fetch_array($query))
		{
			$data['note'] = parse_text($data['note']);
			$data['sgmdate'] = sgmdate($data['dateline']);
			$atmes[] = $data;
		}
		if ($atmes) 
		{
			return array('data' => $atmes, 'current' => $current, 'total' => $total, 'pages' => $pages, 'perpage' => $perpage);
		}
		return null;
	}
	elseif ($gettype == 'limit') // 显示perpage个
	{
		return $db->fetch_all("SELECT n.* FROM ".DBPREFIX."note_mentioned m LEFT JOIN ".DBPREFIX."notes n ON n.nid = m.nid WHERE m.uid = {$uid} ORDER BY nid DESC LIMIT {$perpage}");
	}
	return null;
}
?>