<?php
function badwords($txt)
{
	global $badwords;
	if (!$badwords) 
	{
		$badword_file = DATA_DIR . "cache/cache_badwords.php";
		$badwords = include($badword_file);
		if (!$badwords)
		{
			global $db;
			$data = $db->fetch_all("SELECT * FROM ".DBPREFIX."badwords");
			if ($data)
			{
				foreach ($data as $val)
				{
					$badwords['badword'][] = $val['badword'];
					$badwords['replace'][] = $val['replacement'];
				}
				@file_put_contents($badword_file, "<?php\nreturn ".var_export($badwords, true)."\n?>");
			}
		}
	}
	if (isset($badwords['badword'], $badwords['replace']))
	{
		return str_replace($badwords['badword'], $badwords['replace'], $txt);
	}
	return $txt;
}

function parse_text($txt)
{
	global $boardurl;
	$return = array();

	// 文字内容
	$txt = htmlspecialchars(stripslashes($txt), ENT_QUOTES);
	unset($matches);

	if (preg_match("/\[refer\](.*)\[\/refer\]/ie", $txt, $matches))
	{
		$return['refer'] = parse_text($matches[1]);
		$txt = str_replace($matches[0], '', $txt);
	}
	
	// 图片处理
	if (preg_match("/\[img=([^\]]*)\](.*)\[\/img\]/ie", $txt, $matches))
	{
		if (preg_match("/^attachments\/(\d+)\/(.+)$/i", $matches[1], $submatches))
		{
			$imgurl = "http://".$_SERVER['HTTP_HOST']."/attachments/".$submatches[1]."/120_".$submatches[2];
		}
		else
		{
			$imgurl = $matches[1];
		}
		$return['img'] = array('url' => $imgurl, 'title' => $matches[2]);
		$txt = str_replace($matches[0], "", $txt);
		unset($matches, $submatches, $imgurl);
	}

	// 上传的文件处理
	if (preg_match("/\[file=(\d*)\](.*)\[\/file\]/ie", $txt, $matches))
	{
		$return['file'] = array('url' => miniurl('download?attach='. $matches[1]), 'title' => $matches[2]);
		$txt = str_replace($matches[0], "", $txt);
		unset($matches);
	}

	// 非内容上的URL
	if (preg_match("/\[link=([^\]]*)\](.*)\[\/link\]/ie", $txt, $matches))
	{
		$return['link'] = array('url' => $matches[1], 'title' => $matches[2]);
		$txt = str_replace($matches[0], "", $txt);
		unset($matches);
	}
	
	$message = $txt;
	if (preg_match("/\[text\](.*)\[\/text\]/ie", $txt, $matches))
		$message = $matches[1];

	// 处理链接内容
	if (strpos($message, 'http://') !== false || strpos($message, 'https://') !== false || strpos($message, 'ftp://') !== false)
	{
		if (preg_match_all('#\s*(http|https|ftp)://([^\s\[\]]+)#ie', $message, $matches))
		{
			for ($ix = 0; $ix < count($matches[0]); $ix++)
			{
				if (preg_match('/(javascript|vbscript)/', $matches[0][$ix]))
					continue;
				$matches[0][$ix] = preg_replace('/([\.,\?]|&#33;)$/', '', $matches[0][$ix]);
				$matches[2][$ix] = $matches[1][$ix].'://'.preg_replace('/([\.,\?]|&#33;)$/', '', $matches[2][$ix]);
				$matches[2][$ix] = '<a href="'.$matches[2][$ix].'" target="_blank">'.(strlen($matches[2][$ix]) > 40 ? substr($matches[2][$ix], 0, 25).'...'.substr($matches[2][$ix], -10) : $matches[2][$ix]).'</a>';
			}
			$message = str_replace($matches[0], $matches[2], $message);
		}
		unset($matches);
	}

	// 处理 @我的 信息
	if (preg_match_all('#\[at=(\w+)\]([^\[]*)\[\/at\]#ie', $message, $matches))
	{
		for ($ix = 0; $ix < count($matches[0]); $ix++)
		{
			$matches[2][$ix] = '<a href="'.miniurl($matches[1][$ix]).'">@'.$matches[2][$ix].'</a>';
		}
		$message = str_replace($matches[0], $matches[2], $message);
		unset($matches);
	}

	// 处理 标签 信息
	if (preg_match_all('#\[tag\]([^\[]*)\[\/tag\]#ie', $message, $matches))
	{
		for ($ix = 0; $ix < count($matches[0]); $ix++)
		{
			$matches[1][$ix] = '<a href="'.miniurl("search/tag?keyword=".$matches[1][$ix]).'">'.$matches[1][$ix].'</a>';
		}
		$message = str_replace($matches[0], $matches[1], $message);
		unset($matches);
	}
	$return['message'] = str_replace(array("LTL", "RTR"), array("[", "]"), $message);

	return $return;
}

function add_note($note = '', $attaches = null, $refer_id = 0)
{
	global $logger_uid, $logger_user, $timestamp, $db;
	if ($logger_uid < 1 || empty($logger_user))
	{
		return false;
	}
	$refer_id = intval($refer_id);
	$note = preg_replace("/\<[^\<\>]*\>/i", " ", $note);
	$note = str_replace(array("[", "]"), array("LTL", "RTR"), $note);
	$tagnames = $metioned = null;
	$refer_note = get_note($refer_id);
	if ($refer_note)
	{
		$note = !empty($note) ? $note : "转自";
		$note .= $refer_note['refer_id'] > 0 ? " // " : " [refer]";
		$note .= "[at=".$refer_note['uid']."]".$refer_note['username']."[/at]:";
		$metioned[] = $refer_note['uid'];
		$note .= $refer_note['note'];
		$note .= $refer_note['refer_id'] > 0 ? "" : "[/refer]";
	}
	else
		$refer_id = 0;
	
	if ($attaches && is_array($attaches))
	{
		foreach ($attaches as $key => $val)
		{
			if ($key != 'link' && $key != 'img' && $key != 'file')
				continue;
			$note .= (!$note ? "分享: " : ""). "[{$key}=".$val['attachment']."]".$val['name']."[/{$key}]";
		}
	}

	// @我的 处理
	if (preg_match_all("#@([\w_-]+|[^\s@:：]+)#ie", $note, $matches))
	{
		foreach ($matches[1] as $atk => $ats)
		{
			if (strlen($ats) > 15)
			{
				continue;
			}
			$uid = $db->result_first("SELECT uid FROM ".DBPREFIX."members WHERE username = '".daddslashes($ats)."' LIMIT 1");
			$uid > 0 && ($metioned[] = $uid);
			$matches[1][$atk] = $uid > 0 ? "[at={$uid}]{$ats}[/at]" : $ats;
		}
		$metioned = array_unique($metioned);
		$note = str_replace($matches[0], $matches[1], $note);
		unset($matches);
	}
	
	// 标签 处理
	if (preg_match_all("/\#([^\#]+)\#/ie", $note, $matches))
	{
		foreach ($matches[1] as $tagk => $tagname)
		{
			if (strlen($tagname) > 20 || empty($tagname)) 
			{
				continue;
			}
			$tagnames[] = $tagname;
			$matches[1][$tagk] = "[tag]{$tagname}[/tag]";
		}
		$tagnames = array_unique($tagnames);
		$note = str_replace($matches[0], $matches[1], $note);
		unset($matches);
	}

	$note = addslashes(stripslashes($note));

	$db->query("INSERT INTO ".DBPREFIX."notes(uid, username, note, dateline, `from`, refer_id) VALUES('{$logger_uid}', '{$logger_user}', '{$note}', '{$timestamp}', '".APP_CHANEL."', '{$refer_id}')");
	$nid = $db->insert_id();
	if ($nid < 1)
	{
		return false;
	}

	$refer_id > 0 && $db->query("UPDATE ".DBPREFIX."notes SET refers = refers+1 WHERE nid = {$refer_id} LIMIT 1");

	$db->query("UPDATE ".DBPREFIX."members SET notes = notes+1 WHERE uid = {$logger_uid} LIMIT 1");

	if ($metioned)
	{
		$metion_sql = "INSERT INTO ".DBPREFIX."note_mentioned(nid, uid) VALUES";
		$metion_sql_more = '';
		foreach ($metioned as $metion)
		{
			$metion = intval($metion);
			$metion > 0 && ($metion_sql_more .= (empty($metion_sql_more) ? "" : ",")."('{$nid}', '{$metion}')");
		}
		!empty($metion_sql_more) && ($db->query($metion_sql.$metion_sql_more));
	}

	if ($tagnames)
	{
		$tag_sql = "INSERT INTO ".DBPREFIX."tag2note(tagname, nid) VALUES";
		$tag_sql_more = '';
		foreach ($tagnames as $tagname)
		{
			$tag_sql_more .= (empty($tag_sql_more) ? "" : ",")."('{$tagname}', '{$nid}')";
			$db->query("UPDATE ".DBPREFIX."tags SET updateline = '{$timestamp}', total = total+1 WHERE tagname = '{$tagname}' LIMIT 1");
			$db->affected_rows() < 1 && ($db->query("INSERT INTO ".DBPREFIX."tags(tagname, updateline, total) VALUES('{$tagname}', '{$timestamp}', '1')"));
		}
		!empty($tag_sql_more) && ($db->query($tag_sql . $tag_sql_more));
	}

	if ($attaches)
	{
		$attach_sql = "INSERT INTO ".DBPREFIX."note_attaches(nid, uid, attachtype, dateline, filename, filetype, filesize, attachment) VALUES";
		$attach_sql_more = '';
		foreach ($attaches as $key => $val)
		{
			if ($key != 'link' && $key != 'img' && $key != 'file')
				continue;
			$attach_sql_more .= (empty($attach_sql_more) ? "" : ",")."('{$nid}', '{$logger_uid}', '{$key}', '{$timestamp}', '".$val['name']."', '".$val['type']."', '".$val['size']."', '".$val['attachment']."')";
		}
		!empty($attach_sql_more) && ($db->query($attach_sql.$attach_sql_more));
	}
	
	return true;
}

function upload_attach($varname = 'attach')
{
	global $attach_deeper_dir, $timestamp;
	$safeext = array('jpg', 'jpeg', 'gif', 'png');
	$imgext = array('jpg', 'jpeg', 'gif', 'png');

	if (empty($_FILES[$varname]) || empty($_FILES[$varname]['size']))
	{
		return false;
	}
	$attach = $_FILES[$varname];
	$attach['ext'] = strtolower(trim(substr(strrchr($attach['name'], '.'), 1, 10)));
	$extension = in_array($attach['ext'], $safeext) ? $attach['ext'] : 'attach';
	$attachtype = in_array($extension, $imgext) ? 'img' : 'file';
	$attach['name'] = htmlspecialchars($attach['name'], ENT_QUOTES);
	if (strlen($attach['name']) > 90)
	{
		$attach['name'] = 'abbr_'.md5($attach['name']).'.'.$attach['ext'];
	}

	empty($attach_deeper_dir) && $attach_deeper_dir = "month_".date("Ym", $timestamp);
	$attach_dir = ATTACH_DIR.$attach_deeper_dir;
	if (!is_dir($attach_dir))
	{
		@mkdir($attach_dir, 0777);
		@fclose(fopen($attach_dir.'/index.htm', 'w'));
	}
	$attachname = preg_replace("/(php|phtml|php3|php4|jsp|exe|dll|asp|cer|asa|shtml|shtm|aspx|asax|cgi|fcgi|pl)(\.|$)/i", "_\\1\\2",date('ymdHi').substr(md5($attach['name'].microtime().random(6)), 8, 16).'.'.$extension);
	$attach['attachment'] = $attach_deeper_dir . '/' . $attachname;
	$target = $attach_dir .'/'. $attachname;

	$attach_saved = false;
	if (@copy($attach['tmp_name'], $target) || (function_exists('move_uploaded_file') && @move_uploaded_file($attach['tmp_name'], $target)))
	{
		@unlink($attach['tmp_name']);
		$attach_saved = true;
	}

	if (!$attach_saved && @is_readable($attach['tmp_name']))
	{
		@$fp = fopen($attach['tmp_name'], 'rb');
		@flock($fp, 2);
		@$attachedfile = fread($fp, $attach['size']);
		@fclose($fp);

		@$fp = fopen($target, 'wb');
		@flock($fp, 2);
		if(@fwrite($fp, $attachedfile))
		{
			@unlink($attach['tmp_name']);
			$attach_saved = true;
		}
		@fclose($fp);
	}

	if ($attach_saved)
	{
		@chmod($target, 0644);
		$width = $height = $type = 0;
		if ($attachtype == 'img')
		{
			$imagesize = @getimagesize($target);
			list($width, $height, $type) = (array)$imagesize;
			$size = $width * $height;
			if ($size > 16777216 || $size < 4 || empty($type) || !in_array($type, array(1,2,3)))
			{
				@unlink($target);
				return false;
			}

			include_once INCLUDE_DIR."image.func.php";
			// 图片缩放
			resize_attach_img($target);
		}

		return $attach;
	}

	return false;
}

function del_note($uid = 0, $nid = 0)
{
	global $db;
	if ($uid < 1)
	{
		return false;
	}
	$note = get_note($nid);
	if (!$note)
	{
		return true;
	}
	if ($uid != $note['uid'])
	{
		return false;
	}
	$db->query("DELETE FROM ".DBPREFIX."notes WHERE nid = {$nid} LIMIT 1");
	$db->query("UPDATE ".DBPREFIX."members SET notes = notes-1 WHERE uid = ".$note['uid']." LIMIT 1");
	$db->query("DELETE FROM ".DBPREFIX."note_mentioned WHERE nid = {$nid}");

	// tags的处理
	$tagnames = $db->fetch_all("SELECT tagname FROM ".DBPREFIX."tag2note WHERE nid = {$nid}");
	if ($tagnames) 
	{
		$del_tags = array();
		foreach ($tagnames as $tagname)
		{
			$del_tags[] = $tagname['tagname'];
		}
		if (!empty($del_tags))
		{
			$db->query("UPDATE ".DBPREFIX."tags SET total = total - 1 WHERE tagname IN ('".implode("','", $del_tags)."')");
		}
		$db->query("DELETE FROM ".DBPREFIX."tag2note WHERE nid = {$nid}");
	}

	// attach
	if ($note['refer_id'] > 0)
		$sele_nid = $note['refer_id'];
	else
		$sele_nid = $note['nid'];

	if (!$sele_nid)
	{
		return true;
	}
	$attaches = $db->fetch_all("SELECT * FROM ".DBPREFIX."note_attaches WHERE nid = {$sele_nid}");
	// 看是不是还有转发
	if ($attaches && ($db->result_first("SELECT COUNT(*) FROM ".DBPREFIX."notes WHERE refer_id = {$sele_nid}", "UNBUFFERED") < 1))
	{
		foreach ($attaches as $attach)
		{
			if ($attach['attachtype'] == 'link')
				continue;
			$attach_dirs = explode("/", trim($attach['atatchment'], '/'));
			$filename = $attach_dirs[count($attach_dirs)-1];
			unset($attach_dirs[count($attach_dirs)-1]);
			$attach_dirs = !empty($attach_dirs) ? implode("/", $attach_dirs)."/" : "";
			if ($attach['attachtype'] == 'img')
			{
				@unlink(DATA_DIR."attachments/".$attach_dirs."300_".$filename);
				@unlink(DATA_DIR."attachments/".$attach_dirs."120_".$filename);
			}
			@unlink(DATA_DIR."attachments/".$attach_dirs.$filename);
		}
		$db->query("DELETE FROM ".DBPREFIX."note_attaches WHERE nid = {$sele_nid}");
	}

	// 看是否需要删除缓存
	$cache_notes = @include(DATA_DIR."cache/cache_hot_blogs.php");
	if ($cache_notes)
	{
		foreach ($cache_notes as $cache_note)
		{
			if ($cache_note['nid'] == $nid && $cache_note['uid'] == $uid) 
			{
				@unlink(DATA_DIR."cache/cache_hot_blogs.php");
				break;
			}
		}
	}
	return true;
}

function get_note($nid = 0)
{
	global $db;
	$nid = intval($nid);
	if ($nid < 1)
	{
		return null;
	}
	return $db->fetch_array($db->query("SELECT * FROM ".DBPREFIX."notes WHERE nid = {$nid} LIMIT 1", "UNBUFFERED"));
}

function get_comments($nid, $gettype = 'limit', $perpage = 10)
{
	global $db;
	$nid = intval($nid);
	if ($nid < 1)
		return null;
	$perpage = intval($perpage);
	$perpage < 1 && ($perpage = 10);
	if ($gettype == 'limit')
	{
		return $db->fetch_all("SELECT * FROM ".DBPREFIX."note_comments WHERE nid = {$nid} ORDER BY mid DESC LIMIT {$perpage}");
	}
	else
	{
		$current = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
		$current = max($current, 1);
		$total = $db->result_first("SELECT count(*) FROM ".DBPREFIX."note_comments WHERE nid = {$nid}", "UNBUFFERED");
		$pages = ceil($total/$perpage);
		$current = min($current, $pages);
		if ($current < 1)
		{
			return null;
		}
		$data = $db->fetch_all("SELECT * FROM ".DBPREFIX."note_comments WHERE nid = {$nid} ORDER BY mid DESC LIMIT ".(($current - 1)*$perpage).", {$perpage}");
		return array('data' => $data, 'current' => $current, 'total' => $total, 'pages' => $pages, 'perpage' => $perpage);
	}
	return null;
}
?>