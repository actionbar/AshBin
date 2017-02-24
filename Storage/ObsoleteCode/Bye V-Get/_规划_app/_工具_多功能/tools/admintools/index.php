<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.

	$Id: whois.php 204 2008-05-22 10:15:09Z hao32 $
*/

//note 加载MooPHP框架
require dirname(__FILE__) . '/MooPHP/MooPHP.php';
require dirname(__FILE__) . '/MooPHP/Global.function.php';

$tpl_name = '客齐齐站长工具集合';


$tpl_name_array = array(pr值查询, 收录与反向链接, 查看关键字排名, Alexa查询, ip物理查询, whois查询, 网址转HEX编码);

include MooTemplate("index");

