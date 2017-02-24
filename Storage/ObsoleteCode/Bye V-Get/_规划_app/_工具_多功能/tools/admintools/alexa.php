<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.

	$Id: whois.php 204 2008-05-22 10:15:09Z hao32 $
*/

//note 加载MooPHP框架
require dirname(__FILE__) . '/MooPHP/MooPHP.php';
require dirname(__FILE__) . '/MooPHP/Global.function.php';

$tpl_name = 'alexa信息查询';

$url = MooGetGPC('url', 'string');
$url = str_replace('http://', '', $url);
$url = str_replace('www.', '', $url);
if($url) {	
	$AlexaUrl = 'http://xml.alexa.com/data?cli=10&dat=nsa&ver=quirk-searchstatus&url=' . $url;
	$AlexaContent = file_get_contents($AlexaUrl);
	preg_match('/<POPULARITY[^>]*URL[^>]*TEXT[^>]*\"([0-9]+)\"/i', $AlexaContent, $re);
	//获得traffic rank值
	$TRank = $re[1];
	// note 判断是不是存在POPULARITY
	$isExist = preg_match('/POPULARITY/i', $AlexaContent);
}

include MooTemplate("alexa_index");
