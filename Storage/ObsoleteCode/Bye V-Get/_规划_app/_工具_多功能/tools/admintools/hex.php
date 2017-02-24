<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.

	$Id: whois.php 204 2008-05-22 10:15:09Z hao32 $
*/

//note 加载MooPHP框架
require dirname(__FILE__) . '/MooPHP/MooPHP.php';
require dirname(__FILE__) . '/MooPHP/Global.function.php';

$tpl_name = '网址转换成HEX编码';

$url = MooGetGPC('url', 'string');
$url = str_replace('http://', '', $url);
if($url) {
	$HexUrl = StrToHex($url);
}

include MooTemplate("hex_index");

//把网址转换成HEX编码
function StrToHex($string) {
	$hex="";
	for ($i = 0; $i < strlen($string); $i++)
	$hex .= '%' . dechex(ord($string[$i]));
	//$hex = strtoupper($hex);
	return $hex;
}
/* hao32 note 把HEX编码转化成正常的网址的函数(备用)
function HexToStr($hex) { 
	$hex = str_replace('%', '', $hex);
	$string = "";
	for ($i = 0; $i < strlen($hex) - 1; $i += 2)
	$string .= chr(hexdec($hex[$i].$hex[$i + 1]));
	return $string;
}
*/

