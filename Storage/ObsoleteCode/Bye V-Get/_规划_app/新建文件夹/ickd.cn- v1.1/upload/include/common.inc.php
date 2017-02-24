<?php

	set_magic_quotes_runtime(0);
	define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	define('TW_ROOT',substr(dirname(__FILE__),0,-7));
	define('IN_TW',true);
//	error_reporting(0);
	$time=$_SERVER['REQUEST_TIME'];

	if(PHP_VERSION < '4.1.0') {
		$_GET = &$HTTP_GET_VARS;
		$_POST = &$HTTP_POST_VARS;
		$_COOKIE = &$HTTP_COOKIE_VARS;
		$_SERVER = &$HTTP_SERVER_VARS;
		$_ENV = &$HTTP_ENV_VARS;
		$_FILES = &$HTTP_POST_FILES;
	}
	if(!defined('CURSCRIPT')){
		define('CURSCRIPT','index');
	}
	require TW_ROOT.'./include/global.func.php';
	require TW_ROOT.'./include/cache.func.php';

	getrobot();
	if(defined('NOROBOT') && IS_ROBOT) {
		exit(header("HTTP/1.1 403 Forbidden"));
	}
	foreach(array('_COOKIE', '_POST', '_GET') as $_request) {
		foreach($$_request as $_key => $_value) {
			$_key{0} != '_' && $$_key = daddslashes(trim($_value));
		}
	}
	require TW_ROOT.'./data/config.inc.php';
	require TW_ROOT.'./include/HttpClient.class.php';

   if($gzipcompress && function_exists('ob_gzhandler') && !in_array(CURSCRIPT, array('attachment', 'wap')) && !$inajax) {
		ob_start('ob_gzhandler');
	} else {
		$gzipcompress = 0;
		ob_start();
	}
	$request=$html=$queryAddStr=$htmlfilename='';
	$onlineip=onlineip();
?>