<?php
set_time_limit (30);
foreach($_GET AS $key => $value) {
${$key} = $value;
} 
foreach($_POST AS $key => $value) {
${$key} = $value;
}
$handles = @opendir("fonts/");
while (false !== ($file = (readdir($handles)))) {
if ($file=='.' || $file=='..') { continue; }
$cur_directory[] = $file;
}
sort($cur_directory);
foreach ($cur_directory as $file) {
ob_implicit_flush();
$sfile=str_replace(" ","+",$file);
$bfile=strtolower($file);
$bfile=ucfirst($file);
$bfile=str_replace("-"," ",$bfile);
$bfile=str_replace("_"," ",$bfile);
$bfile=explode(".",$bfile);
$fname=$bfile[0];
$font=$sfile;

if($output=="gif"){
header('Content-type: image/gif');
}else{
header('Content-type: image/png');
}
$text=stripslashes($text);
$text=" ".$fname." ";
$font="fonts/$font";
if($color==""){
$color="#000000";
}else{
$color="#".$color;
}
if($vcolor==""){
$vcolor="#000000";
}else{
$vcolor="#".$vcolor;
}
if($bgcolor==""){
$bgcolor="#FFFFFF";
}else{
$bgcolor="#".$bgcolor;
}
$fsize=20;
$angle = 0;
$L_R_C = 2;
$_bx = imageTTFBbox($fsize,0,$font,$text);
$W = ($W==0)?abs($_bx[2]-$_bx[0]):$W;    //If Height not initialized by programmer then it will detect and assign perfect height.
$H = ($H==0)?abs($_bx[5]-$_bx[3]):$H;    //If Width not initialized by programmer then it will detect and assign perfect width.
$size_x = $W+2;
if($spacing!=""){
if($spacing=="1"){
$size_y = $H;
}
if($spacing=="2"){
$size_y = $H+(round(0.05*($H),0));
}if($spacing=="3"){
$size_y = $H+(round(0.1*($H),0));
}if($spacing=="4"){
$size_y = $H+(round(0.15*($H),0));
}if($spacing=="5"){
$size_y = $H+(round(0.2*($H),0));
}if($spacing=="6"){
$size_y = $H+(round(0.25*($H),0));
}if($spacing=="7"){
$size_y = $H+(round(0.3*($H),0));
}
}else{
$size_y = $H+(round(0.2*($H),0));
}
$_W = abs($_b[2]-$_b[0]);
$_H = abs($_b[5]-$_b[3]);

if ($color[0] == '#'){
$color = substr($color, 1);
if (strlen($color) == 6)
list($r, $g, $b) = array($color[0].$color[1],
$color[2].$color[3],
$color[4].$color[5]);
elseif (strlen($color) == 3)
list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
else
return false;
$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
}
if ($bgcolor[0] == '#'){
$bgcolor = substr($bgcolor, 1);
if (strlen($bgcolor) == 6)
list($bgr, $bgg, $bgb) = array($bgcolor[0].$bgcolor[1],
$bgcolor[2].$bgcolor[3],
$bgcolor[4].$bgcolor[5]);
elseif (strlen($bgcolor) == 3)
list($bgr, $bgg, $bgb) = array($bgcolor[0].$bgcolor[0], $bgcolor[1].$bgcolor[1], $bgcolor[2].$bgcolor[2]);
else
return false;
$bgr = hexdec($bgr); $bgg = hexdec($bgg); $bgb = hexdec($bgb);
}
if ($vcolor[0] == '#'){
$vcolor = substr($vcolor, 1);
if (strlen($vcolor) == 6)
list($r1, $g1, $b1) = array($vcolor[0].$vcolor[1],
$vcolor[2].$vcolor[3],
$vcolor[4].$vcolor[5]);
elseif (strlen($vcolor) == 3)
list($r1, $g1, $b1) = array($vcolor[0].$vcolor[0], $vcolor[1].$vcolor[1], $vcolor[2].$vcolor[2]);
else
return false;
$r1 = hexdec($r1); $g1 = hexdec($g1); $b1 = hexdec($b1);
}


if($mirror=="yes"){
/* Create canvas */
$image = imagecreatetruecolor($size_x, $size_y*2);
$image1 = imagecreatetruecolor($size_x, $size_y*2);
/* Allocate colors */
$background = imagecolorallocate($image, $bgr, $bgg, $bgb);
imagefilledrectangle($image, 0, 0, $size_x, $size_y*2, $background);
$background = imagecolorallocate($image1, $bgr, $bgg, $bgb);
imagefilledrectangle($image1, 0, 0, $size_x, $size_y*2, $background);
}else{
$image = imagecreatetruecolor($size_x, $size_y);
$background = imagecolorallocate($image, $bgr, $bgg, $bgb);
imagefilledrectangle($image, 0, 0, $size_x, $size_y*2, $background);
}
for($j=$size_y;$j>=1;$j--){
$p=$j;
$p = imagecreatetruecolor($size_x, $j);
$background = imagecolorallocate($p, $bgr, $bgg, $bgb);
imagefilledrectangle($p, 0, 0, $size_x, $size_y, $background);
if($alpha=="yes"){
$cl=90+($j-1)*((20-90)/($size_y-2));
}else{
$cl=0;
}
if($j>$size_y/2){
$layerColor[$j] = imagecolorallocatealpha ($p, $r1, $g1, $b1,$cl);  
}else{
$layerColor[$j] = imagecolorallocatealpha ($p, $r, $g, $b,$cl);  
}
imagettftext($p,$fsize,0,0,$H,$layerColor[$j],$font,$text);
imagecopy($image, $p, 0, 0, 0, 0,$W+2, $j);
}

if($mirror=="yes"){

for($j=$size_y;$j>=1;$j--){
$p=$j;
$p = imagecreatetruecolor($size_x, $j);
$background = imagecolorallocate($p, $bgr, $bgg, $bgb);
imagefilledrectangle($p, 0, 0, $size_x, $size_y, $background);
$cl=120+($j-1)*((85-120)/($size_y-2));
if($j>$size_y/2){
$layerColor[$j] = imagecolorallocatealpha ($p, $r1, $g1, $b1,$cl);  
}else{
$layerColor[$j] = imagecolorallocatealpha ($p, $r, $g, $b,$cl);  
}
imagettftext($p,$fsize,0,0,$H,$layerColor[$j],$font,$text);
imagecopy($image1, $p, 0, 0, 0, 0,$W+2, $j);
}
$width                        =    imagesx ( $image );
$height                       =    imagesy ( $image );
$src_x                        =    0;
$src_y                        =    0;
$src_width                    =    $width;
$src_height                   =    $height;
$src_y						  =    $height;
$src_height					  =    -$height;
$imgdest					  =    imagecreatetruecolor ($width, $height);
imagecopyresampled ($imgdest, $image1, 0, 0, $src_x, $src_y, $width, $height, $src_width, $src_height);
imagecopy($imgdest,$image, 0, 0, 0, 0,$width, $height/2);
if($output=="gif"){
imagegif($imgdest);
}else{
imagepng($imgdest);
}
$H="";
$W="";
imagedestroy($imgdest);
}else{
if($output=="gif"){
imagegif($image,"sample/$fname.gif");
}else{
imagepng($image,"sample/$fname.png",100);
}
$H="";
$W="";
imagedestroy($image);
}
$fsize="";
$font="";
$text="";
}
@closedir($handles);
?>
