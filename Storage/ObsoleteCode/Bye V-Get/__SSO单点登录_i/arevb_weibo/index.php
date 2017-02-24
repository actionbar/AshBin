<?php
error_reporting(E_ALL);
//set_magic_quotes_runtime(0);
ini_set("magic_quotes_runtime", 0);

$starttime = microtime(true);

define("IN_IVB", true);
define("IVB_ROOT", dirname(__FILE__)."/");
define("NOROBOT", TRUE);

define("INCLUDE_DIR", IVB_ROOT . "include/");
define("DATA_DIR", IVB_ROOT . "sitedata/");
define("ATTACH_DIR", IVB_ROOT . "attachments/");

define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

mb_internal_encoding("UTF-8");

if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS']))
{
	exit('Request tainting attempted.');
}

// opera浏览器会同时获取 favicon.ico，apache重写功能对此处理可能失误 此处先简单处理
if (strpos($_SERVER['REQUEST_URI'], 'favicon.ico') !== false)
{
	exit(header("HTTP/1.1 404 Not Found"));
}

if (!file_exists(IVB_ROOT."config.inc.php")) 
{
	exit('The file \'config.php\' doesn\'t exist which means you haven\'t installed this system. You should go <a href="./install/index.php">install/index.php</a> to install.');
}

require_once(INCLUDE_DIR . 'global.inc.php');

if (!MAGIC_QUOTES_GPC)
{
	$_FILES && ($_FILES = daddslashes($_FILES));
	$_POST && ($_POST = daddslashes($_POST));
	$_GET && ($_GET = daddslashes($_GET));
	$_REQUEST && ($_REQUEST = daddslashes($_REQUEST));
}

getrobot();
if(defined('NOROBOT') && IS_ROBOT)
{
	exit(header("HTTP/1.1 403 Forbidden"));
}

require_once(IVB_ROOT . 'config.inc.php');

if (!empty($_SERVER['REQUEST_URI'])) 
{
	$temp = urldecode($_SERVER['REQUEST_URI']);
	if(strpos($temp, '<') !== false || strpos($temp, '"') !== false)
	{
		exit('Request Bad url');
	}
}

$prelength = strlen($cookiepre);
$_DCOOKIE = array();
foreach ($_COOKIE as $key => $val)
{
	if(substr($key, 0, $prelength) == $cookiepre)
	{
		$_DCOOKIE[(substr($key, $prelength))] = MAGIC_QUOTES_GPC ? $val : daddslashes($val);
	}
}
unset($prelength, $_request, $_key, $_value);

$timestamp = time();

$PHP_SELF = htmlspecialchars($_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
$BASESCRIPT = basename($PHP_SELF);
list($BASEFILENAME) = explode('.', $BASESCRIPT);
$boardurl = htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].substr($PHP_SELF, 0, strrpos($PHP_SELF, '/')).'/');

if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
	$onlineip = getenv('HTTP_CLIENT_IP');
} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
	$onlineip = getenv('HTTP_X_FORWARDED_FOR');
} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
	$onlineip = getenv('REMOTE_ADDR');
} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
	$onlineip = $_SERVER['REMOTE_ADDR'];
}

preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
$onlineip = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';
unset($onlineipmatches);

set_exception_handler('my_exception_func');

/* 包含DB处理函数 */
require_once INCLUDE_DIR . 'db_mysql.class.php';

$db = new dbstuff;
$db->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect, true, $dbcharset);
$dbuser = $dbpw = $pconnect = NULL;

// 先加入cache setting 处理
$cache_settings = @include(DATA_DIR.'cache/cache_settings.php');
if (empty($cache_settings))
{
	$temp_settings = $db->fetch_all("SELECT * FROM ".DBPREFIX."settings");
	if ($temp_settings)
	{
		foreach ($temp_settings as $temp_setting)
		{
			$cache_settings[$temp_setting['variable']] = $temp_setting['value'];
		}
		unset($temp_settings, $temp_setting);
	}
	!empty($cache_settings) && (@file_put_contents(DATA_DIR.'cache/cache_settings.php', "<?php\nreturn ".var_export($cache_settings, true)."\n?>"));
}

$request = $_SERVER['REQUEST_URI'];
$pos = strpos($request, '?');
if (false !== $pos) // 有GET数据
{
	$request = substr($request, 0, $pos);
}
if (false !== strpos($request, '//')) // 有多个//时
{
	$request = preg_replace("|/+|iu", "/", $request);
}
$tmp = str_replace(array("http://", "https://"), "", $boardurl);
if (false !== strpos($tmp, '//'))
{
	$tmp = preg_replace("|/+|iu", "/", $tmp);
}
$tmp = substr($tmp, strpos($tmp, '/'));
if (substr($request, 0, strlen($tmp)) == $tmp)
{
	$request = substr($request, strlen($tmp));
}
$request = '/'.ltrim($request, '/');
$tmp = substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], '.'));
$tmp = trim($tmp, '.');

$subdomain = $tmp;
if ($tmp == 'm' || $tmp == '3g')
	$tmp = "3g";
elseif ($tmp == 'wap' || $tmp == 'api' || $tmp == 'www')
	$tmp = $tmp;
else
{
	$request = ltrim($request, '/');
	$pos = strpos($request, '/');
	$tmp = $pos !== false ? substr($request, 0, $pos) : $request;
	if (in_array($tmp, array('m', '3g', 'wap', 'api', 'www')))
	{
		$subdomain = $tmp;
		$tmp == 'm' && ($tmp = '3g');
		$request = $pos !== false ? substr($request, $pos) : '';
	}
	else
		$tmp = 'www';
}

$request = trim($request, '/');
if (is_file(IVB_ROOT.$request))
{
	header("Location: {$boardurl}{$request}");
	exit();
}

$siteurl = !empty($cache_settings['weburl']) ? rtrim($cache_settings['weburl'], '/').'/' : $boardurl;
$tmp == 'www' && ($subdomain = '');
$subdomain && strpos($boardurl, $subdomain) === false && ($boardurl .= $subdomain.'/');
$boardurl = preg_replace("/\/+/", "/", $boardurl);
$boardurl = str_replace("http:/", "http://", $boardurl);

// TODO 3g wap show
$tmp == '3g' && ($tmp = 'wap');
define("APP_CHANEL", $tmp);
define("APP_DIR", IVB_ROOT."apps/".(($tmp&&$tmp!='www')?"{$tmp}/":""));
define("TEMPLATE_DIR", APP_DIR."templates/");
unset($tmp, $pos);

// 处理session
$sess_id = isset($_REQUEST['sid']) ? $_REQUEST['sid'] : (isset($_DCOOKIE['sess_id']) ? $_DCOOKIE['sess_id'] : '');
$system_auth_key = md5($authkey . $_SERVER['HTTP_USER_AGENT']);
@list($logger_uid, $logger_user, $logger_pw) = isset($_REQUEST['auth']) ? $_REQUEST['auth'] : (empty($_DCOOKIE['sess_auth']) ? array('', '', 0) : explode("\t", authcode($_DCOOKIE['sess_auth'], 'DECODE')));
$sessionexists = 0;

$membertablefields = "m.uid AS logger_uid, m.username AS logger_user, m.is_admin, m.password AS logger_pw, m.email AS logger_email, m.lastvisit, m.lastactivity, m.newpm, m.notes, m.fans, m.follows";
if ($sess_id)
{
	if ($logger_uid)
	{
		// 从SESSION数据表和member数据表中读取信息
		$query = $db->query("SELECT s.sid AS sess_id, s.pageviews AS spageviews, s.seccode, $membertablefields FROM ".DBPREFIX."sessions s, ".DBPREFIX."members m WHERE m.uid = s.uid AND CONCAT_WS('.',s.ip1,s.ip2,s.ip3,s.ip4)='$onlineip' AND m.uid='$logger_uid' AND m.password='$logger_pw'");
	}
	else
	{
		// 单独从SESSION数据表中读取信息 
		$query = $db->query("SELECT sid AS sess_id, uid AS sessionuid, seccode, pageviews AS spageviews FROM ".DBPREFIX."sessions WHERE sid = '$sess_id' AND CONCAT_WS('.',ip1,ip2,ip3,ip4)='$onlineip'");
	}

	if ($_DSESSION = $db->fetch_array($query))
	{
		$sessionexists = 1;
		if (isset($_DSESSION['sessionuid']) && !empty($_DSESSION['sessionuid']))
		{
			// 从数据库中取出用户信息，并与$_DSESSION融合
			$_DSESSION = array_merge($_DSESSION, $db->fetch_first("SELECT $membertablefields FROM ".DBPREFIX."members m WHERE m.uid = '$_DSESSION[sessionuid]'"));
		}
	}
	else
	{
		if ($_DSESSION = $db->fetch_first("SELECT sid AS sess_id, seccode, pageviews AS spageviews FROM ".DBPREFIX."sessions WHERE sid = '$sess_id' AND CONCAT_WS('.',ip1,ip2,ip3,ip4) = '$onlineip'"))
		{
			clearcookies();
			$sessionexists = 1;
		}
	}
}

if (!$sessionexists)
{
	if ($logger_uid) 
	{
		if (!($_DSESSION = $db->fetch_first("SELECT $membertablefields FROM ".DBPREFIX."members m WHERE m.uid = '{$logger_uid}' AND m.password = '{$logger_pw}'")))
		{
			clearcookies();
		}
	}

	$_DSESSION['sess_id'] = random(6);
	$_DSESSION['seccode'] = random_equal();
	$sess_id = $_DSESSION['sess_id'];
}

$_DSESSION['dateformat'] = !isset($_DSESSION['dateformat']) || empty($_DSESSION['dateformat']) ? 'Y-n-j' : $_DSESSION['dateformat'];
$_DSESSION['timeformat'] = !isset($_DSESSION['timeformat']) || empty($_DSESSION['timeformat']) ? 'H:i' : $_DSESSION['timeformat'];
$_DSESSION['timeoffset'] = isset($_DSESSION['timeoffset']) && $_DSESSION['timeoffset'] != 9999 ? $_DSESSION['timeoffset'] : '8';

$_DSESSION['lastvisit'] = !isset($_DSESSION['lastvisit']) || empty($_DSESSION['lastvisit']) ? $timestamp - 86400 : $_DSESSION['lastvisit'];
$_DSESSION['timenow'] = array('time' => gmdate($_DSESSION['dateformat'] . ' ' . $_DSESSION['timeformat'], $timestamp + 3600 * $_DSESSION['timeoffset']), 'offset' => ($_DSESSION['timeoffset'] >= 0 ? ($_DSESSION['timeoffset'] == 0 ? '' : '+'.$_DSESSION['timeoffset']) : $_DSESSION['timeoffset']));

$logger_uid = isset($_DSESSION['logger_uid']) ? $_DSESSION['logger_uid'] : 0;
$logger_user = isset($_DSESSION['logger_user']) ? $_DSESSION['logger_user'] : '';
$logger_pw = isset($_DSESSION['logger_pw']) ? $_DSESSION['logger_pw'] : '';

if (empty($_DCOOKIE['sess_id']) || $sess_id != $_DCOOKIE['sess_id'])
{
	dsetcookie('sess_id', $sess_id, 604800, 1, true);
}

include APP_DIR . 'init.php';

//print("<hr />");
//$endtime = microtime(true);
//print("<div style='color:666;font-size:12;text-align:center'>执行SQL语句：".$db->querynum."个， 运行时间： ".sprintf("%.4f", $endtime - $starttime)."秒</div>");
?>