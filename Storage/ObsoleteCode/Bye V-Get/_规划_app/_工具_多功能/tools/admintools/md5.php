<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.

	$Id: whois.php 204 2008-05-22 10:15:09Z hao32 $
*/

//note ╪стьMooPHP©Р╪э
require dirname(__FILE__) . '/MooPHP/MooPHP.php';
require dirname(__FILE__) . '/MooPHP/Global.function.php';

$tpl_name = 'md5╪фкЦ';
$md5 = $_POST['md5'];
if ($md5) {
	if ($_POST['radio'] == c32) {
		$md5_result = strtoupper(md5($md5));
	} elseif ($_POST['radio'] == l32) {
		$md5_result = md5($md5);
	} elseif ($_POST['radio'] == c16 ) {
		$md5_result = strtoupper(substr(md5($md5), 8, 16));
	} elseif ($_POST['radio'] == l16 ) {
		$md5_result = substr(md5($md5), 8, 16);
	}
}
include MooTemplate("md5_index");

