<?php
function resize_attach_img($src)
{
	if (!file_exists($src))
	{
		return false;
	}
	list($w, $h, $tp) = getimagesize($src);
	if ($w == 0 || $h == 0)
	{
		return false;
	}
	if ($tp != IMAGETYPE_GIF && $tp != IMAGETYPE_JPEG && $tp != IMAGETYPE_PNG)
	{
		return false;
	}
	$pos = strrpos($src, '/');
	if ($pos)
	{
		$fnleft = substr($src, 0, $pos+1);
		$fnright = substr($src, $pos+1);
	}
	else
	{
		$fnleft = '';
		$fnright = $src;
	}
	$fn1 = $fnleft . '300_' . $fnright;
	$fn2 = $fnleft . '120_' . $fnright;

	$srcp = false;
	switch($tp)
	{
		case IMAGETYPE_GIF:
			$srcp = imagecreatefromgif($src);
			break;
		case IMAGETYPE_JPEG:
			$srcp = imagecreatefromjpeg($src);
			break;
		case IMAGETYPE_PNG:
			$srcp = imagecreatefrompng($src);
			break;
	}
	if (!$srcp)
	{
		return false;
	}
	$neww1 = $newh1 = 300;
	$neww2 = $newh2 = 120;
	if ($w < $neww1)
	{
		$neww1 = $w;
		$newh1 = $h;
	}
	else
		$newh1 = round($neww1 * $h / $w);
	if ($w < $neww2)
	{
		$neww2 = $w;
		$newh2 = $h;
	}
	else
		$newh2 = round($neww2 * $h / $w);
	$dstp1 = imagecreatetruecolor($neww1, $newh1);
	$dstp2 = imagecreatetruecolor($neww2, $newh2);
	$res1 = imagecopyresampled($dstp1, $srcp, 0, 0, 0, 0, $neww1, $newh1, $w, $h);
	$res2 = imagecopyresampled($dstp2, $srcp, 0, 0, 0, 0, $neww2, $newh2, $w, $h);
	if (!$res1 || !$res2)
	{
		imagedestroy($srcp);
		imagedestroy($dstp1);
		imagedestroy($dstp2);
		return FALSE;
	}
	switch ($tp) 
	{
		case IMAGETYPE_GIF:
			$res1 = imagegif($dstp1, $fn1);
			$res2 = imagegif($dstp2, $fn2);
			break;
		case IMAGETYPE_JPEG:
			$res1 = imagejpeg($dstp1, $fn1, 100);
			$res2 = imagejpeg($dstp2, $fn2, 100);
			break;
		case IMAGETYPE_PNG:
			$res1 = imagepng($dstp1, $fn1);
			$res2 = imagepng($dstp2, $fn2);
			break;
	}
	imagedestroy($srcp);
	imagedestroy($dstp1);
	imagedestroy($dstp2);
	if (!$res1 || !$res2) 
	{
		@unlink($fn1);
		@unlink($fn2);
		return false;
	}
	chmod($fn1, 0777);
	chmod($fn2, 0777);
	return true;
}

function set_home($uid, $dir = '.')
{
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	!is_dir($dir.'/'.$dir1) && mkdir($dir.'/'.$dir1, 0777);
	!is_dir($dir.'/'.$dir1.'/'.$dir2) && mkdir($dir.'/'.$dir1.'/'.$dir2, 0777);
	!is_dir($dir.'/'.$dir1.'/'.$dir2.'/'.$dir3) && mkdir($dir.'/'.$dir1.'/'.$dir2.'/'.$dir3, 0777);
}

function get_home($uid)
{
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	return $dir1.'/'.$dir2.'/'.$dir3;
}

function upload_avatar($uid = 0, $varname = 'attach')
{
	if ($uid < 1)
	{
		return false;
	}
	$imgext = array('jpg', 'jpeg', 'gif', 'png');
	$extension = "jpg";
	if (empty($_FILES[$varname]) || empty($_FILES[$varname]['size']))
	{
		return false;
	}
	$attach = $_FILES[$varname];
	$attach['ext'] = strtolower(trim(substr(strrchr($attach['name'], '.'), 1, 10)));
	if (!in_array($attach['ext'], $imgext))
	{
		return false;
	}
	list($w, $h, $tp) = getimagesize($attach['tmp_name']);
	if($w == 0 || $h == 0)
	{
		return false;
	}
	if($tp != IMAGETYPE_GIF && $tp != IMAGETYPE_JPEG && $tp != IMAGETYPE_PNG)
	{
		return false;
	}

	$attach_saved = false;
	$target = DATA_DIR . "tmp/avatar_".$uid.'.'.$attach['ext'];
	if (@copy($attach['tmp_name'], $target) || (function_exists('move_uploaded_file') && @move_uploaded_file($attach['tmp_name'], $target)))
	{
		@unlink($attach['tmp_name']);
		$attach_saved = true;
	}

	if (!$attach_saved && @is_readable($attach['tmp_name']))
	{
		@$fp = fopen($attach['tmp_name'], 'rb');
		@flock($fp, 2);
		@$attachedfile = fread($fp, $attach['size']);
		@fclose($fp);

		@$fp = fopen($target, 'wb');
		@flock($fp, 2);
		if(@fwrite($fp, $attachedfile))
		{
			@unlink($attach['tmp_name']);
			$attach_saved = true;
		}
		@fclose($fp);
	}

	if (!$attach_saved)
	{
		return false;
	}

	$home = DATA_DIR."avatar/".get_home($uid);
	if (!is_dir($home))
	{
		set_home($uid, DATA_DIR."avatar/");
	}
	$uid = sprintf("%09d", $uid);
	$fn1 = $home .'/'. substr($uid, -2)."_avatar_big.jpg";
	$fn2 = $home .'/'. substr($uid, -2)."_avatar_middle.jpg";
	$fn3 = $home .'/'. substr($uid, -2)."_avatar_small.jpg";
	$srcp = false;
	switch ($tp)
	{
		case IMAGETYPE_GIF:
			$srcp = imagecreatefromgif($target);
			break;
		case IMAGETYPE_JPEG:
			$srcp = imagecreatefromjpeg($target);
			break;
		case IMAGETYPE_PNG:
			$srcp = imagecreatefrompng($target);
			break;
	}
	if (!$srcp)
	{
		return FALSE;
	}
	$dstp1	= imagecreatetruecolor(120, 120);
	$dstp2	= imagecreatetruecolor(50, 50);
	$dstp3	= imagecreatetruecolor(30, 30);
	$res1	= imagecopyresampled($dstp1, $srcp, 0, 0, $w>$h?round(($w-$h)/2):0, $w>$h?0:round(($h-$w)/2), 120, 120, min($w,$h), min($w,$h));
	$res2	= imagecopyresampled($dstp2, $srcp, 0, 0, $w>$h?round(($w-$h)/2):0, $w>$h?0:round(($h-$w)/2), 50, 50, min($w,$h), min($w,$h));
	$res3	= imagecopyresampled($dstp3, $srcp, 0, 0, $w>$h?round(($w-$h)/2):0, $w>$h?0:round(($h-$w)/2), 30, 30, min($w,$h), min($w,$h));
	imagedestroy($srcp);
	if (!($res1 && $res2 && $res3))
	{
		imagedestroy($dstp1);
		imagedestroy($dstp2);
		imagedestroy($dstp3);
		return FALSE;
	}
	switch($tp)
	{
		case IMAGETYPE_GIF:
			imagegif($dstp1, $fn1);
			imagegif($dstp2, $fn2);
			imagegif($dstp3, $fn3);
			break;
		case IMAGETYPE_JPEG:
			imagejpeg($dstp1, $fn1, 100);
			imagejpeg($dstp2, $fn2, 100);
			imagejpeg($dstp3, $fn3, 100);
			break;
		case IMAGETYPE_PNG:
			imagepng($dstp1, $fn1);
			imagepng($dstp2, $fn2);
			imagepng($dstp3, $fn3);
			break;
	}
	imagedestroy($dstp1);
	imagedestroy($dstp2);
	imagedestroy($dstp3);

	if (!file_exists($fn1) || !file_exists($fn2) || !file_exists($fn3))
	{
		@unlink($fn1);
		@unlink($fn2);
		@unlink($fn3);
		return FALSE;
	}
	chmod($fn1, 0777);
	chmod($fn2, 0777);
	chmod($fn3, 0777);
	@unlink($target);
	return TRUE;
}
?>