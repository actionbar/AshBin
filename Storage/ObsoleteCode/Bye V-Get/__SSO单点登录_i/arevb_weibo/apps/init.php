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

$sourcefrom = array("wap" => "WAP", "www" => "网站", "api" => "客户端");
if (!$requests)
{
	include(APP_DIR.'home.php');
	return;
}
$request_app = isset($requests[0]) ? $requests[0] : '';
$apps = array('login', 'logout', 'register', 'pms', 'note', 'travel', 'search', 'help', 'links', 'people', 'home', 'follow', 'comment', 'setting');

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
?>