<?php
/**
*缓存函数文件
*/
!defined('IN_TW') && exit('Access Denied');
/**
* 将缓存写入文件
*
* @param string $script 文件名
* @param string $cachedata 缓存数据
* @param string $prefix
*/
function writetocache($script, $cachedata = '',$dir='express',$prefix = 'cache_') {
	$dir = TW_ROOT.'./data/cache/'.$dir.'/';
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if($fp = @fopen("$dir$prefix$script.php", 'wb')) {
		fwrite($fp, "<?php\n//TeraWit cache file, DO NOT modify me!".
			"\n//Created: ".date("M j, Y, G:i").
			"\n//Identify: ".md5($prefix.$script.'.php'.$cachedata)."\n\n$cachedata?>");
		fclose($fp);
	} else {
		exit('Can not write to cache files, please check directory ./cache/ and ./cache/express/ .');
	}
}
function arrayeval($array, $level = 0) {
	if(!is_array($array)) {
		return "'".$array."'";
	}
	if(is_array($array) && function_exists('var_export')) {
		return var_export($array, true);
	}

	$space = '';
	for($i = 0; $i <= $level; $i++) {
		$space .= "\t";
	}
	$evaluate = "Array\n$space(\n";
	$comma = $space;
	if(is_array($array)) {
		foreach($array as $key => $val) {
			$key = is_string($key) ? '\''.addcslashes($key, '\'\\').'\'' : $key;
			$val = !is_array($val) && (!preg_match("/^\-?[1-9]\d*$/", $val) || strlen($val) > 12) ? '\''.addcslashes($val, '\'\\').'\'' : $val;
			if(is_array($val)) {
				$evaluate .= "$comma$key => ".arrayeval($val, $level + 1);
			} else {
				$evaluate .= "$comma$key => $val";
			}
			$comma = ",\n$space";
		}
	}
	$evaluate .= "\n$space)";
	return $evaluate;
}
/**
* 检查一个文件是否是缓存文件
*
* @param string 文件名
* @param string 前缀
*/
function is_cachefile($script,$prefix='cache_'){
	$dir = TW_ROOT.'./data/cache/express/';
	return file_exists($dir.$prefix.$script.'.php');
}
/**
* 返回一个缓存文件的绝对路径
*
* @param string 文件名
* @param string 前缀
*/
function cachefile($script,$prefix='cache_'){
	$dir = TW_ROOT.'./data/cache/express/';
	return $dir.$prefix.$script.'.php';
}
?>