<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.

	$Id: MooPHP.php 184 2008-05-22 06:13:57Z kimi $
*/


//note 定义MooPHP框架基本常量
define('IN_MOOPHP', TRUE);
//note MooPHP的核心版本，例如：0.21 alpha
define('MOOPHP_VERSION', '0.91.178 alpha');
//note 正在被访问的文件路径，例如：D:\web\MooPHP\
define('MOOPHP_ROOT', substr(__FILE__, 0, -10));
//note 正在被访问的文件URL，例如：http://www.ccvita.com/MooPHP
define('MOOPHP_URL', strtolower(substr($_SERVER['SERVER_PROTOCOL'], 0, strpos($_SERVER['SERVER_PROTOCOL'], '/'))).'://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
//note REQUEST_URI
define('REQUEST_URI', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : (isset($_SERVER['argv']) ? $_SERVER['PHP_SELF'].'?'.$_SERVER['argv'][0] : $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING']));
define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

//note 禁止对全局变量注入
if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) {
	exit('Request tainting attempted.');
}

//note MooPHP基础数组
$_MooPHP = $_MooBlock = $_MooCacheConfig = $_MooClass = array();
//note 数据库信息初始化
$dbHost = $dbName = $dbUser = $dbPasswd = $dbPconnect = '';

//note 加载MooPHP配置文件
require_once MOOPHP_ROOT.'/MooConfig.php';

//note 定义MooPHP配置常量
!defined('MOOPHP_ALLOW_BLOCK') && define('MOOPHP_ALLOW_BLOCK', TRUE);
!defined('MOOPHP_ALLOW_CACHE') && define('MOOPHP_ALLOW_CACHE', FALSE);
!defined('MOOPHP_ALLOW_MYSQL') && define('MOOPHP_ALLOW_MYSQL', FALSE);
!defined('MOOPHP_DATA_DIR') && define('MOOPHP_DATA_DIR', MOOPHP_ROOT.'./../Moo-data');
!defined('MOOPHP_TEMPLATE_DIR') && define('MOOPHP_TEMPLATE_DIR', '../Moo-templates');
!defined('MOOPHP_TEMPLATE_URL') && define('MOOPHP_TEMPLATE_URL', 'Moo-templates');

//note 加载MooPHPCache配置文件
if(MOOPHP_ALLOW_BLOCK) {
	MOOPHP_ALLOW_CACHE && require_once MOOPHP_ROOT.'/MooCacheConfig.php';
	$cache = MooAutoLoad('MooCache');
}

//note 如果系统需要使用MYSQL则，初始化
if(MOOPHP_ALLOW_MYSQL) {
	$db = MooAutoLoad('MooMySQL');
	$db->connect($dbHost, $dbUser, $dbPasswd, $dbName, $dbPconnect, $dbCharset);
}

//note 初始化常用变量
$timestamp = time();

//note 对GPC变量进行安全处理
if (!MAGIC_QUOTES_GPC) {
	$_GET = MooAddslashes($_GET);
	$_POST = MooAddslashes($_POST);
	$_COOKIE = MooAddslashes($_COOKIE);
	$_REQUEST = MooAddslashes($_REQUEST);
	$_SERVER = MooAddslashes($_SERVER);
	$_FILES = MooAddslashes($_FILES);
}

/**
* 自动加载默认类文件函数，并将其初始化
* @param string $classname - 类名
* @return class
*/
function MooAutoLoad($classname) {
	global $_MooClass;

	if(empty($_MooClass[$classname])) {
		require_once MOOPHP_ROOT.'/libraries/'.$classname.'.class.php';
		$_MooClass[$classname]= & new $classname;
		return $_MooClass[$classname];
	} else {
		return $_MooClass[$classname];
	}

}

/**
* 为变量或者数组添加转义
* @param string $value - 字符串或者数组变量
* @return array
*/
function MooAddslashes($value) {
	return $value = is_array($value) ? array_map('MooAddslashes', $value) : addslashes($value);
}

/**
* 模块函数
* @param string $type - 类型
* @param string $name - 结果集的数组名称
* @param string $param - 参数
* @return array
*/
function MooBlock($param) {
	global $_MooClass;
	
	$_MooClass['MooCache']->getBlock($param);

}

/**
* 根据中文裁减字符串
* @param string $string - 待截取的字符串
* @param integer $length - 截取字符串的长度
* @param string $dot - 缩略后缀
* @return string 返回带省略号被裁减好的字符串
*/
function MooCutstr($string, $length, $dot = ' ...') {
	global $charset;

	if(strlen($string) <= $length) {
		return $string;
	}
	$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);
	$strcut = '';
	if(strtolower($charset) == 'utf-8') {
		$n = $tn = $noc = 0;
		while($n < strlen($string)) {
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif (194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif (224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif (240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif (248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif ($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) {
				break;
			}
		}
		if($noc > $length) {
			$n -= $tn;
		}
		$strcut = substr($string, 0, $n);
	} else {
		for($i = 0; $i < $length; $i++) {
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}
	$strcut = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);

	return $strcut.$dot;
}

/**
* 获取缓存文件路径。
* @param string $cacheFile - 缓存文件名
* @return string 返回缓存文件绝对路径
*/
function MooCacheFile($cacheFileName) {

	$cacheFile = MOOPHP_DATA_DIR.'/cache/cache_'.$cacheFileName.'.php';

	if(!@file_exists($cacheFile)) {
		$_MooClass['MooCache']->setCache($cacheFileName);
	}
	return $cacheFile;

}

/**
* 获取GPC变量。对于type为integer的变量强制转化为数字型
* @param string $key - 权限表达式
* @param string $type - integer 数字类型；string 字符串类型；array 数组类型
* @param string $var - R $REQUEST变量；G $GET变量；P $POST变量；C $COOKIE变量
* @return string 返回经过过滤或者初始化的GPC变量
*/
function MooGetGPC($key, $type = 'integer', $var = 'R') {
	switch($var) {
		case 'G': $var = &$_GET; break;
		case 'P': $var = &$_POST; break;
		case 'C': $var = &$_COOKIE; break;
		case 'R': $var = &$_REQUEST; break;
	}
	switch($type) {
		case 'integer':
			$return = intval($var[$key]);
			break;
		case 'string':
			$return = isset($var[$key]) ? $var[$key] : NULL;
			break;
		case 'array':
			$return = isset($var[$key]) ? $var[$key] : array();
			break;
		default:
			$return = intval($var[$key]);
	}
	return $return;
}

/**
* 将特殊字符转成 HTML 格式。比如<a href='test'>Test</a>转换为&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;
* @param string $value - 字符串或者数组变量
* @return array
*/
function MooHtmlspecialchars($value) {
	return is_array($value) ? array_map('MooHtmlspecialchars', $value) : preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1', str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $value));
}

/**
* 检查是否正确提交了表单 //debug 此函数还处于调试阶段
* @param string $var 需要检查的变量
* @param string $allowget 是否允许GET方式
* @param string $seccodecheck 验证码检测是否开启
* @return 返回是否正确提交了表单
*/
function MooSubmit($var, $allowget = 0, $seccodecheck = 0) {

	if(empty($GLOBALS['_REQUEST'][$var])) {
		return FALSE;
	} else {
		global $_SERVER;
		if($allowget || ($_SERVER['REQUEST_METHOD'] == 'POST' && (empty($_SERVER['HTTP_REFERER']) ||
			preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'])))) {
			return TRUE;
		} else {
			showmessage('submit_invalid');//debug 此处还缺少
		}
	}
}

/**
* 加载模板
* @param string $file - 模板文件名
* @return string 返回编译后模板的系统绝对路径
*/
function MooTemplate($file) {

	$tplfile = MOOPHP_ROOT.MOOPHP_TEMPLATE_DIR.'/'.$file.'.htm';
	$objfile = MOOPHP_DATA_DIR.'/templates/'.$file.'.tpl.php';

	if(@filemtime($tplfile) > @filemtime($objfile)) {
		//note 加载模板类文件
		$T = MooAutoLoad('MooTemplate');
		$T->complie($tplfile, $objfile);
	}

	return $objfile;
}

/**
* 写文件
* @param string $file - 需要写入的文件，系统的绝对路径加文件名
* @param string $content - 学要写入的内容
* @param string $mod - 写入模式，默认为w
* @param boolean $exit - 不能写入是否中断程序，默认为中断
* @return boolean 返回是否写入成功
*/
function MooReadFile($file, $exit = TRUE) {
	if(!@$fp = @fopen($file, $mod)) {
		if($exit) {
			exit('MooPHP File :<br>'.$file.'<br>Have no access to write!');
		} else {
			return false;
		}
	} else {
		@$data = fread($fp,filesize($cachefile));
		fclose($fp);
		return $data;
	}
}

/**
* 写文件
* @param string $file - 需要写入的文件，系统的绝对路径加文件名
* @param string $content - 学要写入的内容
* @param string $mod - 写入模式，默认为w
* @param boolean $exit - 不能写入是否中断程序，默认为中断
* @return boolean 返回是否写入成功
*/
function MooWriteFile($file, $content, $mod = 'w', $exit = TRUE) {
	if(!@$fp = @fopen($file, $mod)) {
		if($exit) {
			exit('MooPHP File :<br>'.$file.'<br>Have no access to write!');
		} else {
			return false;
		}
	} else {
		@flock($fp, 2);
		@fwrite($fp, $content);
		@fclose($fp);
		return true;
	}
}
