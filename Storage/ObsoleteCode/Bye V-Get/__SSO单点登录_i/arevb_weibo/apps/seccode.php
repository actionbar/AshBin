<?php
if (!defined("IN_IVB"))
	exit("Access Denied");

// 获取新sec
if (isset($requests[1]) && $requests[1] == 'new')
{
	$_DSESSION['seccode'] = random_equal();
	updatesession();
}

$width=120;
$height=40;
$_DSESSION['seccode'];
$img = ImageCreate($width, $height); 
ImageColorAllocate($img, mt_rand(230,250), mt_rand(230,250), mt_rand(230,250)); 
$color = ImageColorAllocate($img, 0, 0, 0); 
$offset = 0; 
for ($ix = 0; $ix < strlen($_DSESSION['seccode']); $ix++)
{
	$offset += 16;
	$txtcolor = ImageColorAllocate($img, mt_rand(0,255), mt_rand(0,150), mt_rand(0,255));
	ImageChar($img, mt_rand(3,5), $offset, mt_rand(10,20), $_DSESSION['seccode'][$ix], $txtcolor);
}
for ($ix = 0; $ix < 100; $ix++)
{
	$pxcolor = ImageColorAllocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	ImageSetPixel($img, mt_rand(0,$width), mt_rand(0,$height), $pxcolor);
}
header('Content-type: image/png');
ImagePng($img);
?>