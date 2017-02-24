<?php
if (!defined("IN_IVB"))
	exit("Access Denied");

$search_item = isset($requests[0]) ? trim($requests[0]) : "";
$search_filter = isset($_REQUEST['filter']) ? trim($_REQUEST['filter']) : "";
if ($search_filter == 'tags' || $search_filter == 'people')
{
	$search_item = $search_filter;
}
else
{
	$search_filter = 'tags';
}
$keyword = isset($_REQUEST['keyword']) ? addslashes(stripslashes(trim($_REQUEST['keyword']))) : "";
if ($search_item == 'tag')
{
	if (empty($keyword))
	{
		$tag_notes = array();
	}
	else
	{
		$total = $db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."tag2note WHERE tagname = '{$keyword}'");
		$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
		$current = max($current, 1);
		$perpage = 20;
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
		$pagehtml = multi_page($pages, total, $current, miniurl("search/tag?keyword=".stripslashes($keyword)));
	}
}
elseif ($search_item == 'tags')
{
	// 只显示最近使用的100个
	$query = $db->query("SELECT tagname, total FROM ".DBPREFIX."tags WHERE total > 0".(empty($keyword) ? "" : " AND tagname LIKE '%{$keyword}%'")." ORDER BY updateline DESC LIMIT 100");
	$search_tags = array();
	$count_max = $count_min = 1;
	while ($data = $db->fetch_array($query))
	{
		$search_tags[] = $data;
		$count_max = max($count_max, $data['total']);
		$count_min = min($count_min, $data['total']);
	}
	$count_scale = $count_max - $count_min;
	if ($count_scale > 5)
	{
		$font_step = ceil($count_scale/5);
	}
	else
	{
		$font_step = 1;
	}
}
elseif ($search_item == 'peoples')
{
	$total = $db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."sessions WHERE uid > 0");
	$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
	$current = max($current, 1);
	$perpage = 15;
	$pages = ceil($total/$perpage);
	$current = min($current, $pages);
	if ($current < 1)
	{
		$hot_peos = array();
	}
	else
	{
		$query = $db->query("SELECT m.uid, m.username, m.gender, m.regdate, m.credits, m.notes, m.fans, m.follows FROM ".DBPREFIX."sessions s LEFT JOIN ".DBPREFIX."members m ON m.uid = s.uid WHERE s.uid > 0 GROUP BY s.uid ORDER BY s.pageviews DESC LIMIT ".(($current - 1)*$perpage).", ".$perpage);
		while ($data = $db->fetch_array($query))
		{
			$hot_peos[] = $data;
		}
	}
	$pagehtml = multi_page($pages, total, $current, miniurl("search/peoples"));
}
elseif ($search_item == 'people')
{
	$total = $db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."members".(empty($keyword) ? "" : " WHERE username LIKE '%$keyword%'"));
	$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
	$current = max($current, 1);
	$perpage = 15;
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
	$pagehtml = multi_page($pages, total, $current, miniurl("search/people?keyword=".stripslashes($keyword)));
}
else
{
	include(APP_DIR.'home.php');
	return;
}

include(template("search"));
?>