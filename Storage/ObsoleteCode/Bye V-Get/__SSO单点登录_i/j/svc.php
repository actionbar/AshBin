<?php 
include('../c/vc_sql.php');	//验证码写入数据库
session_start();
header("Content-type: image/png"); 
//创建真彩色白纸 
$im = @imagecreatetruecolor(70, 24) or die("建立图像失败"); 
//获取背景颜色 
$background_color = imagecolorallocate($im, 255, 255, 255); 
//填充背景颜色(这个东西类似油桶) 
imagefill($im,0,0,$background_color); 
//获取边框颜色 
//$border_color = imagecolorallocate($im,200,200,200); 
//画矩形，边框颜色200,200,200 
//imagerectangle($im,0,0,69,23,$border_color); 

//逐行炫耀背景，全屏用1或0 
//for($i=2;$i<22;$i++){ 
//获取随机淡色 
//$line_color = imagecolorallocate($im,rand(200,255),rand(200,255),rand(200,255)); 
//画线 
//imageline($im,2,$i,47,$i,$line_color); 
//} 
//imageline ( resource$image , int$x1 , int$y1 , int$x2 , int$y2 , int$color )
//imageline() 用 color 颜色在图像 image 中从坐标 x1，y1 到 x2，y2（图像左上角为 0, 0）画一条线段。 

//获取随机较深颜色 
$line_color = imagecolorallocate($im,rand(50,180),rand(50,180),rand(50,180)); 
imageline($im,0,rand(2,24),70,rand(0,24),$line_color); 
imageline($im,rand(2,70),0,rand(0,70),24,$line_color); 

//设置印上去的文字 a-zA-Z0-9，外面采用echo str_shuffle("ABCEFGgIJ4KLpNOPQRSTUVWXZabcHdefhMijDklmnoqrstuvwxyz01235Y6789");就可以获取打乱了的字符
//因为数字只有10个，所以为了保证数字可以显示，数字写两份，共20个
//$k='vWEy2ifRYUJ5spG2LrSZDAu8d4bBKjz6mel06VQ13HP89g5XFqCkIowx10Ta437NOMctn79h';
//商务网定位是商务人士，所以相对较老，验证码就模仿百度，用纯数字的就好
$k='0123456789';

$S='';
//写入随机字串 

//设置字体大小 $font_size=18; 
$K=$k[rand(0,9)];$x=18*rand(0,3);
$mix = imagecolorallocate($im,200,200,200);
imagechar($im,12,$x,rand(1,4),$K,$mix); 

for($i=0;$i<4;++$i){ 
$K=$k[rand(0,9)];$S.=$K;
//x 位置
$x=18*$i+4;
//画文字 

imagechar($im,18,$x,rand(1,4),$K,$line_color); 
} 

//显示图片 
imagepng($im); 
$_SESSION['svc']=$S;
//销毁图片 
imagedestroy($im); 
?> 
