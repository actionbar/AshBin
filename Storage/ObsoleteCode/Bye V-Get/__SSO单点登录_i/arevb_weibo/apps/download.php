<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

$attach_id = isset($_GET['attach']) ? intval($_GET['attach']) : 0;
if ($attach_id < 1)
{
	exit();
}
$fileinfo = $db->fetch_first("SELECT dateline, filename, filetype, filesize, attachment FROM ".DBPREFIX."note_attaches WHERE aid = {$attach_id} AND attachtype = 'file' LIMIT 1");
if (!$fileinfo)
{
	exit();
}
$down_file = ATTACH_DIR.$fileinfo['attachment'];
if (file_exists($down_file)) 
{
	exit();
}
$filesize = empty($fileinfo['filesize']) ? @filesize($down_file) : $fileinfo['filesize'];
ob_start();
$range = 0;
if (!empty($_SERVER['HTTP_RANGE']))
{
	list($range) = explode('-',(str_replace('bytes=', '', $_SERVER['HTTP_RANGE'])));
}
if ($range <= 0)
{
	// 记录
	$db->query("UPDATE ".DBPREFIX."note_attaches SET downloads=downloads+1 WHERE aid = {$attach_id} LIMIT 1");
}
ob_end_clean();
dheader('Date: '.gmdate('D, d M Y H:i:s', $fileinfo['dateline']).' GMT');
dheader('Last-Modified: '.gmdate('D, d M Y H:i:s', $fileinfo['dateline']).' GMT');
dheader('Content-Encoding: none');
dheader('Content-Disposition: attachment; filename='.$fileinfo['filename']);
dheader("Content-Type: ".(empty($fileinfo['filetype']) ? "application/octet-stream" : $fileinfo['filetype']));
if ($range > 0)
{
	$rangesize = ($filesize - $range) > 0 ?  ($filesize - $range) : 0;
	dheader('Accept-Ranges: bytes');
	dheader('Content-Length: '.$rangesize);
	dheader('HTTP/1.1 206 Partial Content');
	dheader('Content-Range: bytes='.$range.'-'.($filesize-1).'/'.($filesize));
	if ($fp = @fopen($down_file, 'rb'))
	{
		@fseek($fp, $range);
		if (function_exists('fpassthru'))
		{
			@fpassthru($fp);
		}
		else
		{
			echo @fread($fp, $filesize);
		}
	}
	@fclose($fp);
}
else
{
	dheader('Content-Length: '.$filesize);
	@readfile($down_file);
}
@flush(); @ob_flush();
function dheader($string, $replace = true, $http_response_code = 0) {
	$string = str_replace(array("\r", "\n"), array('', ''), $string);
	if(empty($http_response_code) || PHP_VERSION < '4.3' ) {
		@header($string, $replace);
	} else {
		@header($string, $replace, $http_response_code);
	}
	if(preg_match('/^\s*location:/is', $string)) {
		exit();
	}
}
?>