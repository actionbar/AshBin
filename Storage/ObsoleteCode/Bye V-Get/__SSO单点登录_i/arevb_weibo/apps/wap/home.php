<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

if (empty($request_app) && $logger_uid > 0)
{
	$datas = $db->fetch_array($db->query("SELECT notes, fans, follows FROM ".DBPREFIX."members WHERE uid = {$logger_uid} LIMIT 1", "UNBUFFERED"));
	$datas['atmes'] = $db->result_first("SELECT count(*) FROM ".DBPREFIX."note_mentioned WHERE uid = {$logger_uid}", "UNBUFFERED");

	include(template("myhome"));
	return;
}
include_once(INCLUDE_DIR . "note.func.php");

$hot_blogs_cache = DATA_DIR . 'cache/cache_hot_blogs.php';
if (file_exists($hot_blogs_cache) && filemtime($hot_blogs_cache)-$timestamp < 300)
{
	$hot_blogs = include($hot_blogs_cache);
}
else
{
	$hot_refer_blogs = $hot_cmt_blogs = array();
	$query = $db->query("SELECT * FROM ".DBPREFIX."notes WHERE dateline > ".($timestamp - 604800)." ORDER BY refers DESC, dateline DESC LIMIT 8");
	while($data = $db->fetch_array($query))
	{
		$data['note'] = parse_text($data['note']);
		$data['sgmdate'] = sgmdate($data['dateline']);
		$hot_refer_blogs[$data['nid']] = $data;
	}
	$query = $db->query("SELECT * FROM ".DBPREFIX."notes WHERE dateline > ".($timestamp - 604800)." ORDER BY comments DESC, dateline DESC LIMIT 8");
	while($data = $db->fetch_array($query))
	{
		$data['note'] = parse_text($data['note']);
		$data['sgmdate'] = sgmdate($data['dateline']);
		!isset($hot_refer_blogs[$data['nid']]) && ($hot_cmt_blogs[$data['nid']] = $data);
	}
	$hot_blogs = array_values($hot_refer_blogs);
	$hot_blogs = array_merge($hot_blogs, array_values($hot_cmt_blogs));
	unset($hot_refer_blogs, $hot_cmt_blogs);
	count($hot_blogs) > 0 && file_put_contents($hot_blogs_cache, "<?php\nreturn ".var_export($hot_blogs, true).";\n?>");
}
$hot_blogs = array_slice($hot_blogs, 0, 6);

include_once(INCLUDE_DIR."hot.func.php");
$hot_peos = get_hot_peos();
$hot_tags = get_hot_tags();

include(template("home"));
?>