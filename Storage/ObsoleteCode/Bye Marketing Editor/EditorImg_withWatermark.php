<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>*{margin:0;padding:0}p{height:28px;line-height:28px}.changecolor p{color:#090;font-weight:700}</style>
<?php
if(!isset($_GET['imgtime'])&&!isset($_GET['site'])){header("Location: http://e.v-get.com/tech/");exit;}
else {$imgtime=$_GET['imgtime'];$site=$_GET['site'];}
?>
<form method="post" enctype="multipart/form-data" id="S" style="font-size:12px"><div id="changecolor"><p>* 百度、腾讯等图片设置了禁止外用，所以这类图片无法通过链接上传，请复制到本地再上传。</p><p>* 其他网址图片可以直接复制图片网址就可以上传。</p><p>* 下面如果显示图片了，就表示上传成功-不要管图片尺寸</p></div><p>图片网址：<input type="text" name="urlfile" style="height:22px;width:290px" onblur="C($('changecolor'),'');" onfocus="C($('changecolor'),'changecolor');"/><input type="file" name="file" onchange="this.form.urlfile.value=this.value.replace('C:\\fakepath\\','http://tp.v-get.com/e/<?php echo $site;?>/');$('localimg').style.color='#D00';$('localimg').style.fontWeight='700'" style="width:70px;overflow:hidden"><input type="hidden" name="site" value="<?php echo $_GET['site'];?>">
</p><p>图片描述 alt：<input style="height:22px;width:250px" name="imgalt" value="<?php echo isset($_POST['imgalt'])?$_POST['imgalt']:'';?>"><input type="text" name="time" value="<?php echo $imgtime;?>" style="width:75px;height:22px;border:none;background:none;margin:0 0 0 9px"><input type="text" name="timeid" value="<?php echo isset($_POST['timeid'])?($_POST['timeid']+1):'1';?>" style="height:22px;width:20px;margin:0 9px 0 0"><input style="width:50px;height:25px" type="submit" name="Submit" value="上传"></p></form>
<script type="text/javascript" src="http://tu.v-get.com/i.js"></script>
<script>
$("S").timeid.value=$i($("S").timeid.value)+1;
E($("S").imgalt,"input",function(){
if(L($("imgforfile").value)>0){
$("imgforfile").value=$("imgforfile").value.replace(/alt="[^"]+" /g,"");$("imgforfile").value=$("imgforfile").value.replace(/<p>.+<\/p>/g,"");
$("imgforfile").value=$("imgforfile").value.replace("<img",\'<img alt="\'+this.value+\'"\');$("imgforfile").value=$("imgforfile").value+"<p>"+this.value+"</p>";}
});

</script>

<?php
function imageWaterMark($groundImage,$waterPos=9,$waterImage,$xOffset=-9,$yOffset=-5)
{
 
     if(!empty($waterImage) && file_exists($waterImage)) {
         $water_info = getimagesize($waterImage);
         $water_w=$water_info[0];
         $water_h= $water_info[1];

         switch($water_info[2])   {
             case 1:$water_im = imagecreatefromgif($waterImage);break;
             case 3:$water_im = imagecreatefrompng($waterImage);break;
             default:return 1;
         }
     }
     if(!empty($groundImage) && file_exists($groundImage)) {
         $ground_info = getimagesize($groundImage);
         $ground_w     = $ground_info[0];
         $ground_h     = $ground_info[1];

         switch($ground_info[2]) {
             case 1:$ground_im = imagecreatefromgif($groundImage);break;
             case 2:$ground_im = imagecreatefromjpeg($groundImage);break;
             case 3:$ground_im = imagecreatefrompng($groundImage);break;
             default:return 1;
         }
     } else {
         return 2;
     }
         $w = $water_w;
         $h = $water_h;
         $label = "图片的";
     if( ($ground_w < $w) || ($ground_h < $h) ) {
         return 3;
     }
     switch($waterPos) {
         case 0:
             $posX = rand(0,($ground_w - $w));$posY = rand(0,($ground_h - $h));break;
         case 1:$posX = 0;$posY = 0;break;
         case 2:$posX = ($ground_w - $w) / 2;$posY = 0;break;
         case 3:$posX = $ground_w - $w;$posY = 0;break;
         case 4:$posX = 0;$posY = ($ground_h - $h) / 2;break;
         case 5:$posX = ($ground_w - $w) / 2;$posY = ($ground_h - $h) / 2;break;
         case 6:$posX = $ground_w - $w;$posY = ($ground_h - $h) / 2;break;
         case 7:$posX = 0;$posY = $ground_h - $h;break;
         case 8:$posX = ($ground_w - $w) / 2;$posY = $ground_h - $h;break;
         case 9:$posX = $ground_w - $w;$posY = $ground_h - $h;break;
         default:$posX = rand(0,($ground_w - $w));$posY = rand(0,($ground_h - $h));break;     
     }
     imagealphablending($ground_im, true);
     imagecopy($ground_im, $water_im, $posX + $xOffset, $posY + $yOffset, 0, 0, $water_w,$water_h);
     @unlink($groundImage);
     switch($ground_info[2]) {
         /* 使用  imageinterlace($im,1) 可以使JPEG图片先显示模糊的轮廓，再慢慢清晰，而不是从上到下逐行显示图片  */
         case 1:imagegif($ground_im,$groundImage);break;
         case 2:imageinterlace($ground_im,1);imagejpeg($ground_im,$groundImage,100);break;
         case 3:imagepng($ground_im,$groundImage);break;
         default: return 6;
     }

     if(isset($water_info)) unset($water_info);
     if(isset($water_im)) imagedestroy($water_im);
     unset($ground_info);
     imagedestroy($ground_im);
     return 0;
}


function resizeImage($im,$filenameWidthoutType,$filetype,$savefile,$maxwidth=640,$maxheight=200)
{
    $pic_width = imagesx($im);
	if($pic_width<641):return false;endif;
	
    $pic_height = imagesy($im);
    $maxheight=($maxwidth/$pic_width)*$pic_height;
	$maxheight=(INT)$maxheight;
	
    if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
    {
        if($maxwidth && $pic_width>$maxwidth)
        {
            $widthratio = $maxwidth/$pic_width;
            $resizewidth_tag = true;
        }

        if($maxheight && $pic_height>$maxheight)
        {
            $heightratio = $maxheight/$pic_height;
            $resizeheight_tag = true;
        }

        if($resizewidth_tag && $resizeheight_tag)
        {$ratio = ($widthratio<$heightratio)?$widthratio:$heightratio;}

        if($resizewidth_tag && !$resizeheight_tag)
            $ratio = $widthratio;
        if($resizeheight_tag && !$resizewidth_tag)
            $ratio = $heightratio;

        $newwidth = $pic_width * $ratio;
        $newheight = $pic_height * $ratio;

        if(function_exists("imagecopyresampled"))
        {
            $newim = imagecreatetruecolor($newwidth,$newheight);
           imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        }
        else
        {
            $newim = imagecreate($newwidth,$newheight);
           imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        }

        $filename = $savefile.$filenameWidthoutType.$filetype;
		
		if($filetype=='.gif'){imagegif($newim,$filename);}
		if($filetype=='.png'){imagepng($newim,$filename);}
		if($filetype=='.jpg'){imagejpeg($newim,$filename,75);}
        imagedestroy($newim);
    }
        
}

function GrabImage($url,$filenameWidthoutType='',$site,$filetype,$savefilename) { 
if($url==""):return false;endif; 
$savefile=$site.'/';

$filename=$filenameWidthoutType.$filetype;
ob_start(); readfile($url); $img = ob_get_contents(); ob_end_clean(); $size=strlen($img);
$savefilename=$savefile.$filename;
$fp2=@fopen($savefilename,"a"); fwrite($fp2,$img);fclose($fp2); 
if($filetype=='.gif'){
$fgif=fopen($savefilename, 'rb');
$gifcontent = fread($fgif, filesize($savefilename));
fclose($fgif);
if(!strpos($gifcontent,chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0')){
$im=imagecreatefromgif($savefilename);
resizeImage($im,$filenameWidthoutType,$filetype,$savefile);
imageWaterMark($savefilename,9,$site.'.png');}
}
else {
if($filetype=='.jpg'){$im=imagecreatefromjpeg($savefilename);}
else if($filetype=='.png'){$im=imagecreatefrompng($savefilename);}
resizeImage($im,$filenameWidthoutType,$filetype,$savefile);
imageWaterMark($savefilename,9,$site.'.png');
}




$imgalt=$_POST['imgalt'];
$imgsize=getimagesize($savefilename);//$imgsize[0] 宽  1 高
if(strlen($imgalt)>0){echo '<textarea style="width:100%;height:45px" id="imgforfile"><div style="text-align:center"><img alt="',$imgalt,'" src="http://tp.v-get.com/e/',$savefilename,'" width="',$imgsize[0],'" height="',$imgsize[1],'"><p>',$imgalt,'</p></div></textarea>';}
else {echo '<textarea style="width:100%;height:45px" id="imgforfile"><div style="align:center"><img src="http://tp.v-get.com/e/',$savefilename,'" width="',$imgsize[0],'" height="',$imgsize[1],'"></div></textarea>';}
echo '<p></p><img src="http://tp.v-get.com/e/',$savefilename,'" width="500" height="250" alt="FTP服务器图片，没成功就没显示"><p>远程图片地址：http://tp.v-get.com/e/',$savefilename,'<p>';


}
if(isset($_POST['urlfile'])&&isset($_POST['time'])&&isset($_POST['timeid'])){
$urlfile=$_POST['urlfile'];$timeandid=$_POST['time'].$_POST['timeid'];


$uploadfile=$_FILES["file"];
if($uploadfile["error"]>0){$filetype=strrchr($urlfile,"."); if($filetype!=".gif" && $filetype!=".jpg"&& $filetype!=".png"){echo '不支持',$filetype,'格式的图片，仅支持.gif\.jpg\.png图片';exit;};
$site=$_POST['site'];
$savefilename=$site.'/'.$timeandid.$filetype;}
else{
$filetype=$uploadfile["type"];$filetype=substr($filetype,6);if($filetype=='jpeg'){$filetype='jpg';}$filetype='.'.$filetype;
if($filetype!=".gif" && $filetype!=".jpg"&& $filetype!=".png"){echo '不支持',$filetype,'格式的图片，仅支持.gif\.jpg\.png图片';exit;};
$savefilename=$site.'/'.$timeandid.$filetype;
copy($uploadfile["tmp_name"],$savefilename);
}



GrabImage($urlfile,$timeandid,$site,$filetype,$savefilename);
}



?>