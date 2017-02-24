<?php
if(!defined('IN_IVB')) {
	exit('Access Denied');
}

function parse_template($tplfile, $tpldir) {
	global $timestamp, $subtemplates;

	$nest = 6;
	$file = basename($tplfile, '.html');
	$objfile = DATA_DIR . "templates/".APP_CHANEL."/_" .str_replace('/', '_', $tpldir). "{$file}.tpl.php";

	if(!@$fp = fopen($tplfile, 'r'))
	{
		exit("Current template file 'templates/".($tpldir ? $tpldir : '')."$file.html' not found or have no access!");
	}

	$template = @fread($fp, filesize($tplfile));
	fclose($fp);

	$var_regexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
	$const_regexp = "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)";

	$subtemplates = array();
	for($i = 1; $i<=3; $i++)
	{
		if(strpos($template, '{subtemplate') !== false)
		{
			$template = preg_replace("/[\n\r\t]*\{subtemplate\s+([a-z0-9_]+)(\s+[a-z0-9_\/]*)?\}[\n\r\t]*/ies", "loadsubtemplate('\\1','\\2')", $template);
		}
	}

	$template = preg_replace("/([\n\r]+)\t+/s", "\\1", $template);

	//过滤 <!--{}-->
	$template = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $template);

	//替换 PHP 换行符
	$template = str_replace("{LF}", "<?=\"\\n\"?>", $template);

	//替换直接变量输出
	$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", "<?=\\1?>", $template);
	$template = preg_replace("/$var_regexp/es", "addquote('<?=\\1?>')", $template);
	$template = preg_replace("/\<\?\=\<\?\=$var_regexp\?\>\?\>/es", "addquote('<?=\\1?>')", $template);

	$headeradd = '';

	//文件头的子模板文件判断
	if(!empty($subtemplates))
	{
		$headeradd .= "\n0\n";
		foreach ($subtemplates as $subtpl)
		{
			$headeradd .= "|| checktplrefresh('".$tplfile."', '".$subtpl."', $timestamp, '".$tpldir."')\n";
		}
		$headeradd .=";";
	}

	$template = "<? if(!defined('IN_IVB')) exit('Access Denied'); {$headeradd}?>\n$template";

	//替换模板载入命令
	$template = preg_replace("/[\n\r\t]*\{template\s+([a-z0-9_]+)(\s+[a-z0-9_\/]*)?\}[\n\r\t]*/is", "\n<? include template('\\1', '\\2'); ?>\n", $template);
	$template = preg_replace("/[\n\r\t]*\{template\s+([a-z0-9_]+)(\s+[a-z0-9_\/]*)?\}[\n\r\t]*/is", "\n<? include template('\\1', '\\2'); ?>\n", $template);

	//替换特定函数
	$template = preg_replace("/[\n\r\t]*\{eval\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('<? \\1 ?>','')", $template);
	$template = preg_replace("/[\n\r\t]*\{echo\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('<? echo \\1; ?>','')", $template);
	$template = preg_replace("/([\n\r\t]*)\{elseif\s+(.+?)\}([\n\r\t]*)/ies", "stripvtags('\\1<? } elseif(\\2) { ?>\\3','')", $template);
	$template = preg_replace("/([\n\r\t]*)\{else\}([\n\r\t]*)/is", "\\1<? } else { ?>\\2", $template);

	//替换循环函数及条件判断语句
	for($i = 0; $i < $nest; $i++) {
		$template = preg_replace("/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\}[\n\r]*(.+?)[\n\r]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('<? if(is_array(\\1)) { foreach(\\1 as \\2) { ?>','\\3<? } } ?>')", $template);
		$template = preg_replace("/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('<? if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>','\\4<? } } ?>')", $template);
		$template = preg_replace("/([\n\r\t]*)\{if\s+(.+?)\}([\n\r]*)(.+?)([\n\r]*)\{\/if\}([\n\r\t]*)/ies", "stripvtags('\\1<? if(\\2) { ?>\\3','\\4\\5<? } ?>\\6')", $template);
	}

	$template = preg_replace("/\{$const_regexp\}/s", "<?=\\1?>", $template);

	//删除 PHP 代码断间多余的空格及换行
	$template = preg_replace("/ \?\>[\n\r]*\<\? /s", " ", $template);

	//其他替换
	$template = preg_replace("/\"(http)?[\w\.\/:]+\?[^\"]+?&[^\"]+?\"/e", "transamp('\\0')", $template);
	$template = preg_replace("/\<script[^\>]*?src=\"(.+?)\"(.*?)\>\s*\<\/script\>/ise", "stripscriptamp('\\1', '\\2')", $template);
	$template = preg_replace("/[\n\r\t]*\{block\s+([a-zA-Z0-9_]+)\}(.+?)\{\/block\}/ies", "stripblock('\\1', '\\2')", $template);

	if(!@$fp = fopen($objfile, 'w')) {
		dexit("Directory './data/templates/' not found or have no access!");
	}

	flock($fp, 2);
	fwrite($fp, $template);
	fclose($fp);
}

function loadsubtemplate($file, $tpldir = '') {
	global $subtemplates;
	$tpldir = empty($tpldir) ? "" : trim(trim($tpldir), '/') . '/';
	$tplfile = TEMPLATE_DIR . $tpldir . $file . '.html';

	$content = @implode('', file($tplfile));
	$subtemplates[] = $tplfile;
	return $content;
}

function transamp($str) {
	$str = str_replace('&', '&amp;', $str);
	$str = str_replace('&amp;amp;', '&amp;', $str);
	$str = str_replace('\"', '"', $str);
	return $str;
}

function addquote($var) {
	return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
}

function stripvtags($expr, $statement) {
	$expr = str_replace("\\\"", "\"", preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr));
	$statement = str_replace("\\\"", "\"", $statement);
	return $expr.$statement;
}

function stripscriptamp($s, $extra) {
	$extra = str_replace('\\"', '"', $extra);
	$s = str_replace('&amp;', '&', $s);
	return "<script src=\"$s\" type=\"text/javascript\"$extra></script>";
}

function stripblock($var, $s) {
	$s = str_replace('\\"', '"', $s);
	$s = preg_replace("/<\?=\\\$(.+?)\?>/", "{\$\\1}", $s);
	preg_match_all("/<\?=(.+?)\?>/e", $s, $constary);
	$constadd = '';
	$constary[1] = array_unique($constary[1]);
	foreach($constary[1] as $const) {
		$constadd .= '$__'.$const.' = '.$const.';';
	}
	$s = preg_replace("/<\?=(.+?)\?>/", "{\$__\\1}", $s);
	$s = str_replace('?>', "\n\$$var .= <<<EOF\n", $s);
	$s = str_replace('<?', "\nEOF;\n", $s);
	return "<?\n$constadd\$$var = <<<EOF\n".$s."\nEOF;\n?>";
}

?>