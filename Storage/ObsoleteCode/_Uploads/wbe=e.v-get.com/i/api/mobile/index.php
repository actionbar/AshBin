<?php
if(!empty($_SERVER['QUERY_STRING'])) {
	$dir = '../../source/plugin/mobile/';
	chdir($dir);if((isset($_GET['check']) && $_GET['check'] == 'check' || $_SERVER['QUERY_STRING'] == 'check') && is_file('check.php')) {require_once 'check.php';} elseif(is_file('mobile.php')) {require_once 'mobile.php';}}
?>