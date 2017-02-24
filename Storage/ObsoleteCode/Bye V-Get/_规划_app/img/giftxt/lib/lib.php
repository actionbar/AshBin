<?php
function writeTxt2Img($backImage,$posX,$posY,$text,$fontfile,$textFont=5,$textColor="#FF0000") 
{ 
	$back_im = imagecreatefromgif($backImage);		
	imagealphablending($back_im, true); 
	$R = hexdec(substr($textColor,1,2)); 
	$G = hexdec(substr($textColor,3,2)); 
	$B = hexdec(substr($textColor,5));		 
	imagettftext($back_im, $textFont, 0, $posX, $posY, imagecolorallocate($back_im, $R, $G, $B), $fontfile, $text);	
	@unlink($backImage); 
	imagegif($back_im,$backImage);	
	imagedestroy($back_im);	
}
?>