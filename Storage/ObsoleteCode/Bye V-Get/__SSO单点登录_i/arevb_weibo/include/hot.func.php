<?php
function get_hot_peos()
{
	global $db;
	$hot_peos_cache = DATA_DIR . 'cache/cache_hot_peos.php';
	if (file_exists($hot_peos_cache) && filemtime($hot_peos_cache)-$timestamp < 600)
	{
		$hot_peos = include($hot_peos_cache);
	}
	else
	{
		$hot_peos = array();
		$query = $db->query("SELECT uid, username FROM ".DBPREFIX."sessions WHERE uid > 0 AND lastactivity > ".($timestamp - 3600)." GROUP BY uid ORDER BY pageviews DESC LIMIT 30");
		while ($data = $db->fetch_array($query))
		{
			$hot_peos[] = $data;
		}
		count($hot_peos) > 6 && file_put_contents($hot_peos_cache, "<?php\nreturn ".var_export($hot_peos, true).";\n?>");
	}
	if (count($hot_peos) > 8)
	{
		shuffle($hot_peos);
		$hot_peos = array_slice($hot_peos, 0, 8);
	}
	return $hot_peos;
}

function get_hot_tags()
{
	global $db;
	$hot_tags_cache = DATA_DIR . 'cache/cache_hot_tags.php';
	if (file_exists($hot_tags_cache) && filemtime($hot_tags_cache)-$timestamp < 600)
	{
		$hot_tags = include($hot_tags_cache);
	}
	else
	{
		$hot_tags = array();
		$query = $db->query("SELECT * FROM ".DBPREFIX."tags WHERE updateline > '".($timestamp - 86400)."' ORDER BY total DESC LIMIT 20");
		while ($data = $db->fetch_array($query))
		{
			if ($data['total'] < 1)
				continue;
			$hot_tags[] = $data;
		}
		count($hot_tags) > 0 && file_put_contents($hot_tags_cache, "<?php\nreturn ".var_export($hot_tags, true).";\n?>");
	}
	return $hot_tags;
}
?>