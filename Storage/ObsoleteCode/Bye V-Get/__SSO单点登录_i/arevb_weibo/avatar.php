<?php
error_reporting(0);
$uid = isset($_GET['uid']) ? $_GET['uid'] : 0;
$size = isset($_GET['size']) ? $_GET['size'] : '';
$random = isset($_GET['random']) ? $_GET['random'] : '';

$avatar = 'sitedata/avatar/'.get_avatar($uid, $size);
if (file_exists(dirname(__FILE__).'/'.$avatar))
{
	$random = !empty($random) ? rand(1000, 9999) : '';
	$avatar_url = './'.(empty($random) ? $avatar : "$avatar?random=$random");
}
else
{
	$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
	$avatar_url = "public/images/noavatar_$size.jpg";
}
if(empty($random)) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Last-Modified:".date('r'));
	header("Expires: ".date('r', time() + 86400));
}

header("Location: $avatar_url");
exit;

function get_avatar($uid, $size = 'middle') {
	$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
	$uid = abs(intval($uid));
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	return $dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2)."_avatar_$size.jpg";
}
?>