<?php
function get_pm_nums($uid, $folder = 'inbox', $isnew = true)
{
	global $db;
	$uid = intval($uid);
	if ($uid < 1)
	{
		return 0;
	}
	if ($folder == 'inbox')
	{
		$useufield = 'msgtoid';
	}
	elseif ($folder == 'outbox')
	{
		$useufield = 'msgfromid';
	}
	else
	{
		return 0;
	}
	return $db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."pms WHERE {$useufield} = '{$uid}' AND folder = '{$folder}'".($isnew ? " AND `new` = 1" : ""));
}

function get_pms($uid, $perpage = 10, $folder = 'inbox', $isnew = true)
{
	global $db;
	$uid = intval($uid);
	if ($uid < 1)
	{
		return null;
	}
	$perpage = intval($perpage);
	$perpage < 1 && ($perpage = 10);
	if ($folder == 'inbox')
	{
		$useufield = 'msgtoid';
	}
	elseif ($folder == 'outbox')
	{
		$useufield = 'msgfromid';
	}
	else
	{
		return null;
	}
	$pms_count = get_pm_nums($uid, $folder, $isnew);
	if ($pms_count < 1)
	{
		return null;
	}
	$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
	$pages = ceil($pms_count / $perpage);
	$current = min($pages, max($current, 1));
	$data = $db->fetch_all("SELECT * FROM ".DBPREFIX."pms WHERE {$useufield} = '{$uid}' AND folder = '{$folder}'".($isnew ? " AND `new` = 1" : "")." ORDER BY dateline DESC LIMIT ".(($current-1)*$perpage).", {$perpage}");
	return array('current' => $current, 'total' => $pms_count, 'pages' => $pages, 'perpage' => $perpage, 'data' => $data);
}

function send_pm($subject, $message, $msgfrom, $msgto, $savebox = true)
{
	global $db, $timestamp;
	$subject = addslashes(stripslashes($subject));
	$message = addslashes(stripslashes($message));
	if (empty($subject) && empty($message))
	{
		return false;
	}
	if (!isset($msgfrom['uid'], $msgfrom['username'], $msgto['uid'], $msgto['username']))
	{
		return false;
	}
	if ($msgfrom['uid'] == $msgto['uid'])
	{
		return false;
	}
	$sql = "INSERT INTO ".DBPREFIX."pms(msgfrom, msgfromid, msgto, msgtoid, folder, `new`, subject, dateline, message) VALUES";
	$sql_more = "('".$msgfrom['username']."', '".$msgfrom['uid']."', '".$msgto['username']."', '".$msgto['uid']."', 'inbox', '1', '{$subject}', '{$timestamp}', '{$message}')";
	if ($savebox)
	{
		$sql_more .= ", ('".$msgfrom['username']."', '".$msgfrom['uid']."', '".$msgto['username']."', '".$msgto['uid']."', 'outbox', '0', '{$subject}', '{$timestamp}', '{$message}')";
	}
	$db->query($sql.$sql_more);
	if ($db->affected_rows() > 0) 
	{
		$db->query("UPDATE ".DBPREFIX."members SET newpm = newpm+1 WHERE uid = ".$msgto['uid']." AND newpm < 20");
		return true;
	}
	return false;
}

function del_pms($uid, $pmids)
{
	global $db;
	$uid = intval($uid);
	if (is_array($pmids))
	{
		$pmids = array_unique($pmids);
	}
	else
	{
		$pmids = array(intval($pmids));
	}
	$pmids = array_diff($pmids, array(0));
	$pmids = array_values($pmids);
	if ($uid < 1 || empty($pmids))
	{
		return false;
	}
	$pminfos = $db->fetch_all("SELECT pmid, msgfromid, msgtoid, folder, `new` FROM ".DBPREFIX."pms WHERE pmid IN ('".implode("','", $pmids)."')");
	if (!$pminfos)
	{
		return false;
	}
	$pmids = array();
	$outnews = 0;
	foreach ($pminfos as $pminfo)
	{
		if (!(($pminfo['msgfromid'] == $uid && $pminfo['folder'] == 'outbox') || ($pminfo['msgtoid'] == $uid && $pminfo['folder'] == 'inbox')))
			continue;
		$pmids[] = $pminfo['pmid'];
		$pminfo['new'] > 0 && ($outnews = $outnews+1);
	}
	if (!empty($pmids))
	{
		$db->query("DELETE FROM ".DBPREFIX."pms WHERE pmid IN ('".implode("','", $pmids)."')");
		if ($db->affected_rows() > 0)
		{
			if ($outnews > 0)
			{
				$orinews = $db->result_first("SELECT newpm FROM ".DBPREFIX."members WHERE uid = {$uid} LIMIT 1", 'UNBUFFERED');
				$nownews = max(0, ($orinews - $outnews));
				$db->query("UPDATE ".DBPREFIX."members SET newpm = ".($nownews)." WHERE uid = '{$uid}' LIMIT 1");
			}
			return $db->affected_rows();
		}
	}
	return false;
}

function del_folder_pms($uid, $folder = 'inbox')
{
	$uid = intval($uid);
	if ($uid < 1)
	{
		return false;
	}
	if ($folder == 'inbox')
	{
		$useufield = 'msgtoid';
	}
	elseif ($folder == 'outbox')
	{
		$useufield = 'msgfromid';
	}
	else
	{
		return false;
	}
	$db->query("DELETE FROM ".DBPREFIX."pms WHERE {$useufield} = {$uid} AND folder = '{$folder}'");
	if ($db->affected_rows() > 0)
	{
		$folder == 'inbox' && $db->query("UPDATE ".DBPREFIX."members SET newpm = 0 WHERE uid = {$uid} LIMIT 1");
		return true;
	}
	return false;
}
?>