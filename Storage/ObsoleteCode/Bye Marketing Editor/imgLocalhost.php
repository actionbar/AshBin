<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>*{margin:0;padding:0}p{height:28px;line-height:28px}</style>
<?php

/* 上传远程或本地图片到本地 和 FTP服务器，并制作logo水印 */

if(!isset($_GET['imgtime'])&&!isset($_GET['imgfile'])){echo '请输入文件imgtime命名或图片文件夹，数字';exit;}
else {$imgtime=$_GET['imgtime'];}
?>
<form method="post"  enctype="multipart/form-data" id="S" style="font-size:12px"><p>图片网址：<input type="text" name="urlfile" style="width:290px"/><input type="file" name="file" onchange="this.form.urlfile.value=this.value.replace('C:\\fakepath\\','http://localhost/tool/__uploadImgTemp/');$('localimg').style.color='#D00';$('localimg').style.fontWeight='700'" style="width:70px;overflow:hidden"><input type="text" name="time" value="<?php echo $imgtime;?>" style="width:75px;border:none;background:none" readonly="readonly"><input type="text" name="timeid" value="<?php echo isset($_POST['timeid'])?($_POST['timeid']+1):'1';?>" style="width:20px"><input type="hidden" name="imgfile" value="<?php echo $_GET['imgfile'];?>">
</p><p>本地图片：<span id="localimg">localhost/Temp/</span>　　alt：<input style="width:250px" name="imgalt" value="<?php echo isset($_POST['imgalt'])?$_POST['imgalt']:'';?>"><input style="width:50px;height:25px" type="submit" name="Submit" value="上传"></p></form>
<script type="text/javascript" src="http://localhost/www.v-get.com/tu/i.js"></script>
<script>
$("S").timeid.value=$i($("S").timeid.value)+1;
E($("S").imgalt,"input",function(){
$("imgforfile").value=$("imgforfile").value.replace(/alt="[^"]+" /g,"");$("imgforfile").value=$("imgforfile").value.replace(/<p>.+<\/p>/g,"");
$("imgforfile").value=$("imgforfile").value.replace("<img",\'<img alt="\'+this.value+\'"\');$("imgforfile").value=$("imgforfile").value+"<p>"+this.value+"</p>";
});
</script>

<?php

function FTP($destination_file,$source_file){
if(!$source_file||!$destination_file){echo '请检查源文件或目的文件';return false;}
$ftp_server = "223.7.144.88";$ftp_user = "hmu047088";$ftp_pass = "i0VGt13Eo1";
$conn_id = ftp_connect($ftp_server) or die("FTP无法连接");
ftp_login($conn_id, $ftp_user, $ftp_pass) or die("FTP帐号或密码错误");
ftp_pasv($conn_id, true);
ftp_put($conn_id,'htdocs/i/'.$destination_file,$source_file,FTP_BINARY) or die("上传ftp_put连接失败");
$imgsize= getimagesize($source_file);//$imgsize[0] 宽  1 高
$imgalt=$_POST['imgalt'];
if(strlen($imgalt)>0){echo '<textarea style="width:100%;height:45px" id="imgforfile"><div class="fo"><img alt="',$imgalt,'" i="',$destination_file,'" width="',$imgsize[0],'" height="',$imgsize[1],'"><p>',$imgalt,'</p></div></textarea>';}
else {echo '<textarea style="width:100%;height:45px" id="imgforfile"><div class="fo"><img i="',$destination_file,'" width="',$imgsize[0],'" height="',$imgsize[1],'"></div></textarea>';}
echo '<p></p><img src="http://localhost/www.v-get.com/tp/i/',$destination_file,'" width="500" height="250" alt="本地图片，没成功就没显示"><p>本地图片http://localhost/www.v-get.com/tp/i/',$destination_file,'</p><img src="http://tp.v-get.com/i/',$destination_file,'" width="500" height="250" alt="FTP服务器图片，没成功就没显示"><p>htdocs/i/',$destination_file,'远程图片<p>';
ftp_close($conn_id);
}


/*
* 功能：PHP图片水印 (水印支持图片或文字)
* 参数：
*       $groundImage     背景图片，即需要加水印的图片，暂只支持GIF,JPG,PNG格式；
*       $waterPos        水印位置，有10种状态，0为随机位置；
*       $waterImage      图片水印，即作为水印的图片，暂只支持GIF,JPG,PNG格式；
*       $xOffset         水平偏移量，即在默认水印坐标值基础上加上这个值，默认为0，如果你想留给水印留
*                       出水平方向上的边距，可以设置这个值,如：2 则表示在默认的基础上向右移2个单位,-2 表示向左移两单位
*       $yOffset         垂直偏移量，即在默认水印坐标值基础上加上这个值，默认为0，如果你想留给水印留
*                       出垂直方向上的边距，可以设置这个值,如：2 则表示在默认的基础上向下移2个单位,-2 表示向上移两单位
* 返回值：
*        0   水印成功
*        1   水印图片格式目前不支持
*        2   要水印的背景图片不存在
*        3   需要加水印的图片的长度或宽度比水印图片或文字区域还小，无法生成水印
*        4   字体文件不存在
*        5   水印文字颜色格式不正确
*        6   水印背景图片格式目前不支持
*/
function imageWaterMark($groundImage,$waterPos=0,$waterImage='/Webpages/www.v-get.com/tu/ishuiyin.png',$xOffset=-9,$yOffset=-5)
{
   $isWaterImage = FALSE;
     //读取水印文件
     if(!empty($waterImage) && file_exists($waterImage)) {
         $isWaterImage = TRUE;
         $water_info = getimagesize($waterImage);
         $water_w     = $water_info[0];//取得水印图片的宽
         $water_h     = $water_info[1];//取得水印图片的高

         switch($water_info[2])   {    //取得水印图片的格式  
             case 1:$water_im = imagecreatefromgif($waterImage);break;
             case 3:$water_im = imagecreatefrompng($waterImage);break;
             default:return 1;
         }
     }

     //读取背景图片
     if(!empty($groundImage) && file_exists($groundImage)) {
         $ground_info = getimagesize($groundImage);
         $ground_w     = $ground_info[0];//取得背景图片的宽
         $ground_h     = $ground_info[1];//取得背景图片的高

         switch($ground_info[2]) {    //取得背景图片的格式  
             case 1:$ground_im = imagecreatefromgif($groundImage);break;
             case 2:$ground_im = imagecreatefromjpeg($groundImage);break;
             case 3:$ground_im = imagecreatefrompng($groundImage);break;
             default:return 1;
         }
     } else {
         return 2;
     }

     //水印位置
         $w = $water_w;
         $h = $water_h;
         $label = "图片的";
     if( ($ground_w < $w) || ($ground_h < $h) ) {
         return 3;
     }
     switch($waterPos) {
         case 0://随机
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

     //设定图像的混色模式
     imagealphablending($ground_im, true);
     imagecopy($ground_im, $water_im, $posX + $xOffset, $posY + $yOffset, 0, 0, $water_w,$water_h);//拷贝水印到目标文件         
    

     //生成水印后的图片
     @unlink($groundImage);
     switch($ground_info[2]) {//取得背景图片的格式
         case 1:imagegif($ground_im,$groundImage);break;
         case 2:imagejpeg($ground_im,$groundImage,100);break;
         case 3:imagepng($ground_im,$groundImage);break;
         default: return 6;
     }

     //释放内存
     if(isset($water_info)) unset($water_info);
     if(isset($water_im)) imagedestroy($water_im);
     unset($ground_info);
     imagedestroy($ground_im);
     //
     return 0;
}












/* 缩放图片， $im 图片对象，应用函数之前，你需要用imagecreatefromjpeg()读取图片对象，如果PHP环境支持PNG，GIF，也可使用imagecreatefromgif()，imagecreatefrompng()；,$savefile$filenameWidthoutType 生成的图片名$filetype 最终生成的图片类型（.jpg/.png/.gif）$maxwidth 定义生成图片的最大宽度（单位：像素）$maxheight 生成图片的最大高度（单位：像素）*/
function resizeImage($im,$filenameWidthoutType,$filetype,$savefile='E:\\Webpages\\www.v-get.com\\tp\\i\\',$maxwidth=640,$maxheight=200)
{
    $pic_width = imagesx($im);
	/* 如果宽度小于640,就不需要压缩 */
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
            $newim = imagecreatetruecolor($newwidth,$newheight);//ImageCopyResized()函数在所有GD版本中有效，但其缩放图像的算法比较粗糙。ImageCopyResamples()，其像素插值算法得到的图像边缘比较平滑，但该函数的速度比ImageCopyResized()慢。
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
		/* 75 =图片质量，只有jpeg才可以设置质量 */
		if($filetype=='.jpg'){imagejpeg($newim,$filename,75);}
        imagedestroy($newim);
    }
        
}






   /* PHP保存远程图片到本地 ，  地址 */
function GrabImage($url,$filenameWidthoutType='',$imgfile='',$savefile='E:\\Webpages\\www.v-get.com\\tp\\i\\') { 
if($url==""):return false;endif; 
$ftpimgfile='';$localimgfile='';
if($imgfile!=''){$ftpimgfile=$imgfile.'/';$localimgfile=$imgfile.'\\\\';}

$filetype=strrchr($url,"."); 
if($filetype!=".gif" && $filetype!=".jpg"&& $filetype!=".png"):return false;endif; 
if($filenameWidthoutType=="") {$filenameWidthoutType=date("_YmdHis");} 
$filename=$filenameWidthoutType.$filetype;
ob_start(); readfile($url); $img = ob_get_contents(); ob_end_clean(); $size=strlen($img);
$savefilename=$savefile.$localimgfile.$filename;
$fp2=@fopen($savefilename,"a"); fwrite($fp2,$img);fclose($fp2); 
/* 用于改变图片尺寸 */
if($filetype=='.jpg'){$im=imagecreatefromjpeg($savefilename);}
else if($filetype=='.gif'){$im=imagecreatefromgif($savefilename);}else if($filetype=='.png'){$im=imagecreatefrompng($savefilename);}
/* 用于改变图片尺寸 */
resizeImage($im,$filenameWidthoutType,$filetype,$savefile.$localimgfile);
/* 水印 */
imageWaterMark($savefilename,0,'/Webpages/www.v-get.com/tu/ishuiyin.png');
/*用于FTP上传 */
FTP($ftpimgfile.$filename,$savefilename);

return $filename; 
}


if(isset($_POST['imgfile'])&&isset($_POST['urlfile'])&&isset($_POST['time'])&&isset($_POST['timeid'])){
$urlfile=$_POST['urlfile'];$timeandid=$_POST['time'].$_POST['timeid'];

if($_FILES["file"]["error"]>0){echo "本地图片上传错误：" . $_FILES["file"]["error"] . "<br />";}
else{
/* $_FILES["file"]["name"] - 被上传文件的名称
$_FILES["file"]["type"] - 被上传文件的类型
$_FILES["file"]["size"] - 被上传文件的大小，以字节计
$_FILES["file"]["tmp_name"] - 存储在服务器的文件的临时副本的名称
$_FILES["file"]["error"] - 由文件上传导致的错误代码 */
//$filetype=strrchr($_FILES["file"]["name"],"."); 不能改名，因为urlfile没有改名
 move_uploaded_file($_FILES["file"]["tmp_name"],'__uploadImgTemp/'.$_FILES["file"]["name"]);
}

$imgfile=$_POST['imgfile'];
GrabImage($urlfile,$timeandid,$imgfile);
}



?>