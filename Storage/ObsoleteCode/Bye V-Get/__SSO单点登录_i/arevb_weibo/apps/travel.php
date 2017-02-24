<?php
if (!defined("IN_IVB"))
	exit("Access Denied");

$filter = isset($_GET['filter']) ? trim($_GET['filter']) : "";
$total_sql = "SELECT COUNT(*) FROM ".DBPREFIX."notes";
if ($filter == 'comments')
{
	$more_condition = " WHERE comments > 0 AND dateline > ".($timestamp - 604800); // 一周内
}
elseif ($filter == 'refers')
{
	$more_condition = " WHERE refers > 0 AND dateline > ".($timestamp - 604800);
}
else
{
	$more_condition = '';
}
$total = $db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."notes ".$more_condition);
$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
$current = max($current, 1);
$perpage = 20;
$pages = ceil($total/$perpage);
$current = min($current, $pages);
$travel_notes = array();
if ($current > 0)
{
	include_once(INCLUDE_DIR."note.func.php");
	if ($filter == 'comments') 
	{
		$more_condition .= " ORDER BY comments DESC, dateline DESC";
	}
	elseif ($filter == 'refers')
	{
		$more_condition .= " ORDER BY refers DESC, dateline DESC";
	}
	else
	{
		$more_condition .= " ORDER BY nid DESC";
	}
	$sql = "SELECT * FROM ".DBPREFIX."notes".$more_condition." LIMIT ".(($current - 1)*$perpage).", ".$perpage;
	$query = $db->query($sql);
	while ($data = $db->fetch_array($query))
	{
		$data['note'] = parse_text($data['note']);
		$data['sgmdate'] = sgmdate($data['dateline']);
		$travel_notes[] = $data;
	}
}
$pagehtml = multi_page($pages, total, $current, miniurl("travel?filter=".$filter));

include_once(INCLUDE_DIR."hot.func.php");
$hot_peos = get_hot_peos();
$hot_tags = get_hot_tags();

$menuon = 'travel';
include(template("travel"));
?>