<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

error_reporting(0);

$requests = explode("/", strtolower($request));
if ($requests[0] == 'seccode')
{
	include(APP_DIR.'seccode.php');
	return;
}
header("Content-type: text/vnd.wap.wml; charset=utf-8");
echo '<?xml version="1.0" encoding="utf-8"?>';

if ($cache_settings['wapopen'] != 1)
{
	include(template("wapclosed"));
	return;
}

if (!$requests)
{
	include(APP_DIR.'home.php');
	return;
}
$request_app = isset($requests[0]) ? $requests[0] : '';
$apps = array('login', 'logout', 'register', 'pms', 'note', 'travel', 'search', 'help', 'links', 'people', 'home', 'follow', 'comment');
if (!in_array($request_app, $apps))
{
	if ($request_app)
	{
		$request_app = addslashes(stripslashes($request_app));
		$request_user = $db->fetch_first("SELECT * FROM ".DBPREFIX."members WHERE uid = '{$request_app}' OR username = '{$request_app}' LIMIT 1");
		if ($request_user) // 转到用户页面
		{
			include(APP_DIR.'people.php');
			return;
		}
	}
	include(APP_DIR.'home.php');
}
elseif (file_exists(APP_DIR.$request_app.'.php'))
{
	unset($requests[0]);
	!empty($requests) && ($requests = array_values($requests));
	include(APP_DIR.$request_app.'.php');
}
else
{
	include(APP_DIR.'home.php');
}

function wappages($page, $current, $uri) 
{
	if ($page < 2)
	{
		return '';
	}
	else
	{
		$last  = $current - 1 < 1 ? 1 : $current - 1;
		$next  = $current + 1 > $page ? $current : $current + 1;
	}
	$pagecnts = $current == 1 ? "首页 上页 " : "<a href=\"{$uri}&amp;pg=1\">首页</a> <a href=\"{$uri}&amp;pg={$last}\">上页</a> ";
	$pagecnts .= $current == $page ? "下页 末页" : "<a href=\"{$uri}&amp;pg={$next}\">下页</a> <a href=\"{$uri}&amp;pg={$page}\">末页</a>";
	return $pagecnts;
}
?>