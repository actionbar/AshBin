<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");


include_once(INCLUDE_DIR."hot.func.php");
$hot_peos = get_hot_peos();
$hot_tags = get_hot_tags();

include_once(INCLUDE_DIR . "note.func.php");
if (empty($request_app) && $logger_uid > 0)
{
	// 我的博客
	$query = $db->query("SELECT * FROM ".DBPREFIX."notes WHERE uid = {$logger_uid} AND dateline > '".($timestamp - 604800)."' ORDER BY nid DESC LIMIT 10");
	$my_blogs = array();
	while($data = $db->fetch_array($query))
	{
		$data['note'] = parse_text($data['note']);
		$my_blogs[] = $data;
	}

	$menuon = 'myhome';
	$usermenu = 'index';
	include(template("myhome"));
	return;
}
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
		$hot_refer_blogs[$data['nid']] = $data;
	}
	$query = $db->query("SELECT * FROM ".DBPREFIX."notes WHERE dateline > ".($timestamp - 604800)." ORDER BY comments DESC, dateline DESC LIMIT 8");
	while($data = $db->fetch_array($query))
	{
		$data['note'] = parse_text($data['note']);
		!isset($hot_refer_blogs[$data['nid']]) && ($hot_cmt_blogs[$data['nid']] = $data);
	}
	$hot_blogs = array_values($hot_refer_blogs);
	$hot_blogs = array_merge($hot_blogs, array_values($hot_cmt_blogs));
	unset($hot_refer_blogs, $hot_cmt_blogs);
	count($hot_blogs) > 0 && file_put_contents($hot_blogs_cache, "<?php\nreturn ".var_export($hot_blogs, true).";\n?>");
}
$hot_blogs = array_slice($hot_blogs, 0, 10);

$menuon = 'home';
include(template("home"));
?>