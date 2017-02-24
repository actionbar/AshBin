<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.

	$Id: whois.php 204 2008-05-22 10:15:09Z hao32 $
*/

//note 加载MooPHP框架
require dirname(__FILE__) . '/MooPHP/MooPHP.php';
require dirname(__FILE__) . '/MooPHP/Global.function.php';

$tpl_name = '搜索引擎收录与反向链接查询';

$site = MooGetGPC('site', 'string');
$site = str_replace('http://', '', $site);
if($site) {
	$buffer = @file_get_contents('http://www.baidu.com/s?wd=site%3A' . $site, 'r');
		if($buffer) {
			$BaiduSite = cut($buffer, '找到相关网页', '篇');
			$BaiduSite = str_replace(array('约', ','), '', $BaiduSite);
		}
	$buffer = @file_get_contents('http://www.baidu.com/s?wd=domain%3A' . $site, 'r');
		if($buffer) {
			$BaiduDomain = cut($buffer, '找到相关网页', '篇');
			$BaiduDomain = str_replace(array('约', ','), '', $BaiduDomain);
		}
	$buffer = @file_get_contents('http://www.google.cn/search?q=site%3A' . $site, 'r');
		if($buffer) {
			$GoogleSite = cut($buffer, '有 <b>', '</b> ');
			$GoogleSite = str_replace(',', '', $GoogleSite);
		}	
	$buffer = @file_get_contents('http://www.google.cn/search?q=link%3A' . $site, 'r');
		if($buffer) {
			$GoogleLink = cut($buffer, '有 <b>', '</b> 项');
			$GoogleLink = str_replace(',', '', $GoogleLink);
		}
}

include MooTemplate("site_index");

function cut($file, $from, $end) {
	$message = explode($from, $file);
	$message = explode($end, $message[1]);
	return $message[0];
}
