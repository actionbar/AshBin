<?php 
include('../c/vc_sql.php');
session_start();
header("Content-type: image/png"); 
$im = @imagecreatetruecolor(70, 24) or die("½¨Á¢Í¼ÏñÊ§°Ü"); 
$background_color = imagecolorallocate($im, 255, 255, 255); 
imagefill($im,0,0,$background_color); 
$line_color = imagecolorallocate($im,rand(50,180),rand(50,180),rand(50,180)); 
imageline($im,0,rand(2,24),70,rand(0,24),$line_color); 
imageline($im,rand(2,70),0,rand(0,70),24,$line_color); 
$k='0123456789';
$S='';
$K=$k[rand(0,9)];$x=18*rand(0,3);
$mix = imagecolorallocate($im,200,200,200);
imagechar($im,12,$x,rand(1,4),$K,$mix); 

for($i=0;$i<4;++$i){ 
$K=$k[rand(0,9)];$S.=$K;
$x=18*$i+4;
imagechar($im,18,$x,rand(1,4),$K,$line_color); 
} 
imagepng($im); 
$_SESSION['svc']=$S;
imagedestroy($im); 
?> 
