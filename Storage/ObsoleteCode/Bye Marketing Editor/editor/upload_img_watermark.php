<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>*{margin:0;padding:0}p{height:28px;line-height:28px}textarea{resize:vertical}.changecolor p{color:#090;font-weight:700}@media screen and (-webkit-min-device-pixel-ratio:0) {.input_file{width:70px;}}</style>
<?php
if(!isset($_GET['imgtime'])||!isset($_GET['site'])||!isset($_GET['datetime'])){header("Location: http://e.v-get.com/tech/");exit;}
else {$imgtime=$_GET['imgtime'];$site=$_GET['site'];$datetime=$_GET['datetime'];}
?>
<form method="post" enctype="multipart/form-data" id="S" style="font-size:12px"><div id="changecolor"><p>* 百度、腾讯等图片设置了禁止外用，所以这类图片无法通过链接上传，请下载到本地再上传。</p><p>* 其他网址图片可以直接复制图片网址就可以上传，仅支持.jpg/.gif/.png格式图片。</p><p>* 下面如果显示图片了，就表示上传成功-不要管图片尺寸</p></div><p>图片网址：<input type="text" name="urlfile" style="height:22px;width:290px" onblur="C($('changecolor'),'');" onfocus="C($('changecolor'),'changecolor');"/><input type="file" name="file" onchange="this.form.urlfile.value=this.value.replace('C:\\fakepath\\','http://tp.v-get.com/i/<?php echo $site;?>/');$('localimg').style.color='#D00';$('localimg').style.fontWeight='700'" class="input_file"><input type="hidden" name="site" value="<?php echo $_GET['site'];?>"><input type="hidden" name="datetime" value="<?php echo $datetime;?>">
</p><p>图片简介 alt：<input style="height:22px;width:250px" name="imgalt" value="<?php echo isset($_POST['imgalt'])?$_POST['imgalt']:'';?>"><input type="text" name="time" value="<?php echo $imgtime;?>" style="width:75px;height:22px;border:none;background:none;margin:0 0 0 9px"><input type="text" name="timeid" value="<?php echo isset($_POST['timeid'])?($_POST['timeid']+1):'1';?>" style="height:22px;width:20px;margin:0 9px 0 0"><input style="width:50px;height:25px" type="submit" name="Submit" value="上传"></p></form>
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
function imageWaterMark($groundImage,$waterImage)
{$isWaterImage = FALSE;
     if(!empty($waterImage)&&file_exists($waterImage)) {
         $isWaterImage=TRUE;
         $water_info = getimagesize($waterImage);
         $water_w=$water_info[0];$water_h= $water_info[1];
		 //默认png格式图片
         $water_im=imagecreatefrompng($waterImage);
         /* switch($water_info[2]) {
             case 1:$water_im = imagecreatefromgif($waterImage);break;
             case 3:$water_im = imagecreatefrompng($waterImage);break;
             default:return 1;} */
     }
     if(!empty($groundImage)&&file_exists($groundImage)) {
         $ground_info = getimagesize($groundImage);
         $ground_w= $ground_info[0]; $ground_h= $ground_info[1];

         switch($ground_info[2]) {
             case 1:$ground_im = imagecreatefromgif($groundImage);break;
             case 2:$ground_im = imagecreatefromjpeg($groundImage);break;
             case 3:$ground_im = imagecreatefrompng($groundImage);break;
             default:return 1;
         }
     } else {return 2;}
         $w=$water_w;$h=$water_h;
     if(($ground_w<$w)||($ground_h<$h)){return 3;}
	 // 默认位置右下角 距边 x=-9 y=-5
	 $posX=$ground_w-$w-9;$posY=$ground_h-$h-5;
	 
    /*  默认位置右下角  ，这里添加不同位置
	  switch($waterPos) {
         case 0:$posX=rand(0,($ground_w-$w));$posY=rand(0,($ground_h-$h));break;
         case 9:$posX=$ground_w-$w;$posY=$ground_h-$h;break;
         default:$posX = rand(0,($ground_w - $w));$posY = rand(0,($ground_h - $h));break;     
     } */
     imagealphablending($ground_im,true);
     imagecopy($ground_im,$water_im,$posX,$posY,0,0,$water_w,$water_h);
     @unlink($groundImage);
     switch($ground_info[2]) {
         case 1:imagegif($ground_im,$groundImage);break;
         case 2:imagejpeg($ground_im,$groundImage,100);break;
         case 3:imagepng($ground_im,$groundImage);break;
         default: return 6;
     }

     if(isset($water_info)) unset($water_info);
     if(isset($water_im)) imagedestroy($water_im);
     unset($ground_info);
     imagedestroy($ground_im);
     return 0;
}


function resizeImage($im,$filenameWidthoutType,$filetype,$savefile)
{$pic_width=imagesx($im);
//最大宽度 640px，高度不限制，小于641px的图片不改变尺寸
	if($pic_width<641):return false;endif;
    $pic_height=imagesy($im);
    $maxheight=(640/$pic_width)*$pic_height;
	$maxheight=(INT)$maxheight;
	
    if(($pic_width >640)||($maxheight && $pic_height > $maxheight))
    {if($pic_width>640){$widthratio=640/$pic_width;$resizewidth_tag=true;}
     if($maxheight && $pic_height>$maxheight){$heightratio=$maxheight/$pic_height;$resizeheight_tag=true;}

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
		if($filetype=='.jpg'){imagejpeg($newim,$filename,100);}
        imagedestroy($newim);
    }
        
}

function GrabImage($url,$filenameWidthoutType='',$site,$filetype,$savefile) { 
if($url==""):return false;endif; 

$filename=$filenameWidthoutType.$filetype;
ob_start(); readfile($url); $img = ob_get_contents(); ob_end_clean(); $size=strlen($img);
$savename=$savefile.$filename;
$fp2=@fopen($savename,"a"); fwrite($fp2,$img);fclose($fp2); 
if($filetype=='.gif'){
$fgif=fopen($savename,'rb');$gifcontent=fread($fgif, filesize($savename));fclose($fgif);
if(!strpos($gifcontent,chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0')){
$im=imagecreatefromgif($savename);
resizeImage($im,$filenameWidthoutType,$filetype,$savefile);
imageWaterMark($savename,'watermark/'.$site.'.png');}
}
else {
if($filetype=='.jpg'){$im=imagecreatefromjpeg($savename);}
else if($filetype=='.png'){$im=imagecreatefrompng($savename);}
resizeImage($im,$filenameWidthoutType,$filetype,$savefile);
imageWaterMark($savename,'watermark/'.$site.'.png');
}

$QC=mysql_connect('hdm-094.hichina.com','hdm0940519','MySQL0img1314');mysql_select_db('hdm0940519_db',$QC);mysql_query('set names utf8');

$imgalt=$_POST['imgalt'];$datetime=$_POST['datetime'];
$imgsize=getimagesize($savename);//$imgsize[0] 宽  1 高
$imgw=$imgsize[0];$imgh=$imgsize[1];

$TB='t'.$site;
$Qs='INSERT INTO '.$TB.' (h,p,q,l,w,g,t) VALUES ("'.$imgalt.'","'.$filenameWidthoutType.'","'.$filetype.'","",'.$imgw.','.$imgh.',"'.$datetime.'")';
$Qq=mysql_query($Qs,$QC);



if(strlen($imgalt)>0){echo '<textarea style="width:100%;height:45px" id="imgforfile"><div class="fo"><img alt="',$imgalt,'" i="',$site,'/',$filename,'" width="',$imgw,'" height="',$imgh,'"><p>',$imgalt,'</p></div></textarea>';}
else {echo '<textarea style="width:100%;height:45px" id="imgforfile"><div class="fo"><img i="',$site,'/',$filename,'" width="',$imgw,'" height="',$imgh,'"></div></textarea>';}
echo '<p>远程图片地址：http://tp.v-get.com/i/',$site,'/',$filename,'<p><p></p><img src="http://tp.v-get.com/i/',$site,'/',$filename,'" width="',$imgw,'" height="',$imgh,'" alt="FTP服务器图片，没成功就没显示">';


}



if(isset($_POST['urlfile'])&&isset($_POST['time'])&&isset($_POST['site'])&&isset($_POST['timeid'])&&isset($_POST['datetime'])){

$urlfile=$_POST['urlfile'];$timeandid=$_POST['time'].$_POST['timeid'];$uploadfile=$_FILES["file"];$site=$_POST['site'];

if($uploadfile["error"]>0){$filetype=strrchr($urlfile,".");$filetype=strtolower($filetype);if($filetype!=".gif"&&$filetype!=".jpg"&&$filetype!=".png"){echo '不支持',$filetype,'格式的图片，仅支持.gif\.jpg\.png图片';exit;};
}
else{
$filetype=$uploadfile["type"];$filetype=substr($filetype,6);$filetype=strtolower($filetype);if($filetype=='jpeg'){$filetype='jpg';}$filetype='.'.$filetype;
if($filetype!=".gif" && $filetype!=".jpg"&& $filetype!=".png"){echo '不支持',$filetype,'格式的图片，仅支持.gif\.jpg\.png图片';exit;};
$savename='../i/'.$site.'/'.$timeandid.$filetype;
copy($uploadfile["tmp_name"],$savename);
}

$savefile='../i/'.$site.'/';

GrabImage($urlfile,$timeandid,$site,$filetype,$savefile);
}



?>