<?php
if (!defined("IN_IVB"))
{
	exit("Access Denied!");
}
function my_exception_func($exception)
{
	include_once INCLUDE_DIR . "exception.php";
	$myexcept = new myException();
	$myexcept->log($exception->getMessage());
	$myexcept->output(array('msg' => $exception->getMessage()));
}

function daddslashes($string, $force = 0, $strip = FALSE)
{
	if (!MAGIC_QUOTES_GPC || $force)
	{
		if (is_array($string))
		{
			foreach ($string as $key => $val)
			{
				$string[$key] = daddslashes($val, $force, $strip);
			}
		}
		else
		{
			$string = addslashes($strip ? stripslashes($string) : $string);
		}
	}
	return $string;
}

function random($length, $numeric = 0) {
	PHP_VERSION < '4.2.0' ? mt_srand((double)microtime() * 1000000) : mt_srand();
	$seed = base_convert(md5(print_r($_SERVER, 1).microtime()), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed[mt_rand(0, $max)];
	}
	return $hash;
}

function random_equal(){
	$seed = random(5, 1);
	$max = strlen($seed);
	$math = array('+', '-', '*');
	$hash = '';
	for ($i = 0; $i < $max; $i++){
		$hash .= ($i%2) ? $math[$seed[$i]%3] : $seed[$i];
	}
	return $hash;
}

function getrobot() {
	if(!defined('IS_ROBOT')) {
		$kw_spiders = 'Bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla';
		$kw_browsers = 'MSIE|Netscape|Opera|Konqueror|Mozilla';
		if (!isset($_SERVER['HTTP_USER_AGENT'])) 
		{
			define('IS_ROBOT', FALSE);
		}
		elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'http://') === false && preg_match("/($kw_browsers)/i", $_SERVER['HTTP_USER_AGENT'])) {
			define('IS_ROBOT', FALSE);
		} elseif(preg_match("/($kw_spiders)/i", $_SERVER['HTTP_USER_AGENT'])) {
			define('IS_ROBOT', TRUE);
		} else {
			define('IS_ROBOT', FALSE);
		}
	}
	return IS_ROBOT;
}

function dhtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1',
		str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
	}
	return $string;
}

function dsetcookie($var, $value = '', $life = 0, $prefix = 1, $httponly = false) {
	global $cookiepre, $cookiedomain, $cookiepath, $timestamp, $_SERVER;
	$var = ($prefix ? $cookiepre : '').$var;
	if($value == '' || $life < 0) {
		$value = '';
		$life = -1;
	}
	$life = $life > 0 ? $timestamp + $life : ($life < 0 ? $timestamp - 31536000 : 0);
	$path = $httponly && PHP_VERSION < '5.2.0' ? "$cookiepath; HttpOnly" : $cookiepath;
	$secure = $_SERVER['SERVER_PORT'] == 443 ? 1 : 0;
	if(PHP_VERSION < '5.2.0') {
		setcookie($var, $value, $life, $path, $cookiedomain, $secure);
	} else {
		setcookie($var, $value, $life, $path, $cookiedomain, $secure, $httponly);
	}
}


function updatesession() 
{
	global $sessionupdated;
	if ($sessionupdated)
	{
		return TRUE;
	}

	global $db, $sessionexists, $sessionupdated, $_DSESSION, $onlineip, $onlinehold, $timestamp, $logger_uid, $logger_user, $sess_id;
	empty($onlinehold) && ($onlinehold = 900);

	$lastactivity = isset($_DSESSION['lastactivity']) ? intval($_DSESSION['lastactivity']) : 0;
	if ($sessionexists == 1)
	{
		$db->query("UPDATE ".DBPREFIX."sessions SET uid='$logger_uid', username='$logger_user', lastactivity='$timestamp', seccode = '".$_DSESSION['seccode']."', pageviews = pageviews+1 WHERE sid='$sess_id'");
	}
	else
	{
		$ips = explode('.', $onlineip);
		$db->query("DELETE FROM ".DBPREFIX."sessions WHERE sid = '$sess_id' OR lastactivity<($timestamp-$onlinehold) OR ('$logger_uid' <> '0' AND uid='$logger_uid') OR (uid='0' AND ip1='$ips[0]' AND ip2='$ips[1]' AND ip3='$ips[2]' AND ip4='$ips[3]' AND lastactivity>$timestamp-60)");
		$db->query("INSERT INTO ".DBPREFIX."sessions(sid, ip1, ip2, ip3, ip4, uid, username, lastactivity, seccode) VALUES('{$sess_id}', '$ips[0]', '$ips[1]', '$ips[2]', '$ips[3]', '{$logger_uid}', '{$logger_user}', '{$timestamp}', '".$_DSESSION['seccode']."')", "SILENT");
		if ($logger_uid && $timestamp - $lastactivity > 21600)
		{
			$db->query("UPDATE ".DBPREFIX."members SET lastvisit=lastactivity, lastactivity='$timestamp' WHERE uid='$logger_uid'", 'UNBUFFERED');
		}
	}

	$sessionupdated = 1;
}

function clearcookies() 
{
	global $logger_uid, $logger_user, $logger_pw;
	dsetcookie('sess_id');
	dsetcookie('sess_auth');
	$logger_uid = 0;
	$logger_user = $logger_pw = '';
}

function template($file, $tpldir = '') 
{
	$tpldir = empty($tpldir) ? '' : trim(trim($tpldir), '/') . '/';
	$tplfile = TEMPLATE_DIR . $tpldir . $file . '.html';
	$objfile = DATA_DIR . 'templates/'.APP_CHANEL.'/'.'_'.str_replace('/', '_', $tpldir).$file.'.tpl.php';
	@checktplrefresh($tplfile, $tplfile, filemtime($objfile), $tpldir);
	return $objfile;
}

function checktplrefresh($tplfile, $subfile, $timecompare, $tpldir) 
{
	if (empty($timecompare) || @filemtime($subfile) > $timecompare) 
	{
		require_once INCLUDE_DIR . 'template.func.php';
		parse_template($tplfile, $tpldir);
		return true;
	}
	return false;
}

// 分页显示
function multi_page($page, $total, $current, $mpurl, $maxpages = 6)
{
	unset($_GET['pg']);
	$_gets = array();
	foreach ($_GET as $key => $val)
	{
		$_gets[] = "{$key}=".urlencode($val);
	}
	$mpurl .= '?'.implode("&", $_gets);
	unset($key, $val, $_gets);
	$mpurl = rtrim($mpurl, '?');

	$shownum = $showkbd = FALSE;
	$lang['prev'] = '上一页';
	$lang['next'] = '下一页';

	$multipage = '';
	$mpurl .= strpos($mpurl, '?') ? '&amp;' : '?';
	if ($page > 1) // 只显示多于一个页面的列表
	{
		$offset = 2;
		if ($maxpages > $page)
		{
			$from = 1;
			$to = $page;
		}
		else
		{
			$from = $current - $offset;
			$to = $from + $maxpages - 1;
			if ($from < 1)
			{
				$to = $current + 1 - $from;
				$from = 1;
				if ($to - $from < $maxpages)
				{
					$to = $maxpages;
				}
			}
			elseif ($to > $page)
			{
				$from = $page - $maxpages + 1;
				$to = $page;
			}
		}

		$multipage = ($current - $offset > 1 && $page > $maxpages ? '<a href="'.$mpurl.'pg=1" class="first">1 ...</a>' : '').($current > 1 ? '<a href="'.$mpurl.'pg='.($current - 1).'" class="prev">'.$lang['prev'].'</a>' : '');
		for ($i = $from; $i <= $to; $i++)
		{
			$multipage .= $i == $current ? '<strong>'.$i.'</strong>' : '<a href="'.$mpurl.'pg='.$i.'">'.$i.'</a>';
		}
		$multipage .= ($to < $page ? '<a href="'.$mpurl.'pg='.$page.'" class="last">... '.$page.'</a>' : ''). ($current < $page ? '<a href="'.$mpurl.'pg='.($current+1).'" class="next">'.$lang['next'].'</a>' : ''). ($showkbd && $page > $maxpages ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\''.$mpurl.'pg=\'+this.value; return false;}" /></kbd>' : '');

		$multipage = $multipage ? '<div class="pages">'.($shownum ? '<em>&nbsp;'.$total.'&nbsp;</em>' : '').$multipage.'</div>' : '';
	}
	return $multipage;
}

//时间格式化
function sgmdate($timestamp='', $format=1) {
	global $_DSESSION;
	$dateformat = $_DSESSION['dateformat'];
	if(empty($timestamp)) {
		$timestamp = $GLOBALS['timestamp'];
	}
	$result = '';
	if($format) {
		$time = $GLOBALS['timestamp'] - $timestamp;
		if($time > 24*3600) {
			$result = gmdate($dateformat, $timestamp + $_DSESSION['timeoffset'] * 3600);
		} elseif ($time > 3600) {
			$result = intval($time/3600).'小时之前';
		} elseif ($time > 60) {
			$result = intval($time/60).'分钟之前';
		} elseif ($time > 0) {
			$result = $time.'秒之前';
		} else {
			$result = '刚刚';
		}
	} else {
		$result = gmdate($dateformat, $timestamp + $_DSESSION['timeoffset'] * 3600);
	}
	return $result;
}

function formhash()
{
	global $formhash, $timestamp, $logger_uid;
	if (empty($formhash))
	{
		$formhash = substr(md5(substr($timestamp, 0, -7).'|'.$logger_uid.'|'.md5($GLOBALS['system_auth_key']).'|'), 8, 8);
	}
	return $formhash;
}

function miniurl($url)
{
	global $boardurl, $sess_id, $direct_to_url;
	if (APP_CHANEL == 'www')
	{
		return $boardurl.$url;
	}
	if (strpos($url, '?') !== false)
	{
		$url .= '&sid='.$sess_id;
		$url = str_replace("&", "&amp;", $url);
	}
	else
	{
		$url .= '?sid='.$sess_id;
	}
	return $boardurl.$url;
}

function imgurl($url, $type = 'small')
{
	global $siteurl, $sess_id;
	$slash = strrpos($url, '/');
	if ($slash !== false)
	{
		$left = substr($url, 0, $slash+1);
		$right = substr($url, $slash+1);
		$url = $left.($type == 'small' ? '120_' : ($type == 'middle' ? '300_' : '')).$right;
	}
	return $siteurl.'attachments/'.$url;
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
	global $system_auth_key;
    $ckey_length = 4;

    $key = md5($key ? $key : $system_auth_key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}
?>