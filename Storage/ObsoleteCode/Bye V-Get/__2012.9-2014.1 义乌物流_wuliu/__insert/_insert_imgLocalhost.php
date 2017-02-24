<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>*{margin:0;padding:0}p{height:28px;line-height:28px}</style>
<?php

/* 上传远程或本地图片到本地 和 FTP服务器，并制作logo水印 */

if(empty($_GET['p'])||empty($_GET['imgfilecity'])){echo '请输入城市b地址，如yiwu/sh命名/及图片命名';exit;}
else {$p=$_GET['p'];$CITY=$_GET['imgfilecity'];}
?>
<form method="post"  enctype="multipart/form-data" id="S" style="font-size:12px">
<p><?php echo '上传200x200图片自动生成200/',$p,'.jpg  50/',$p,'.gif';?></p><p>图片网址：<input type="text" name="urlfile" style="width:290px"/><input type="file" name="file" onchange="this.form.urlfile.value=this.value.replace('C:\\fakepath\\','http://localhost/tool/__uploadImgTemp/');$('localimg').style.color='#D00';$('localimg').style.fontWeight='700'" style="width:70px;overflow:hidden"><input type="text" name="time" value="<?php echo $p;?>" style="width:75px;border:none;background:none" readonly="readonly"><input type="hidden" name="imgfilecity" value="<?php echo $_GET['imgfilecity'];?>">
<input style="width:50px;height:25px" type="submit" name="Submit" value="上传"></p></form>
<script type="text/javascript" src="http://localhost/www.v-get.com/tu/i.js"></script>


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













/* 缩放图片， $im 图片对象，应用函数之前，你需要用imagecreatefromjpeg()读取图片对象，如果PHP环境支持PNG，GIF，也可使用imagecreatefromgif()，imagecreatefrompng()；,$savefile$filenameWidthoutType 生成的图片名$filetype 最终生成的图片类型（.jpg/.png/.gif）$maxwidth 定义生成图片的最大宽度（单位：像素）$maxheight 生成图片的最大高度（单位：像素）*/
function resizeImage($im,$filenameWidthoutType,$filetype,$maxwidth=640,$maxheight=200)
{
    $pic_width = imagesx($im);
        $newwidth =50;
        $newheight =50;

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

        $filename ='E:\\Webpages\\_Uploads\\wbtp=tp.v-get.com\\j\\3\\'.$filenameWidthoutType.$filetype;
		
		if($filetype=='.gif'){imagegif($newim,$filename);}
		if($filetype=='.png'){imagepng($newim,$filename);}
		/* 75 =图片质量，只有jpeg才可以设置质量 */
		if($filetype=='.jpg'){imagejpeg($newim,$filename,75);}
        imagedestroy($newim);
    }
        







   /* PHP保存远程图片到本地 ，  地址 */
function GrabImage($url,$filenameWidthoutType='',$imgfile='') { 
if($url==""):return false;endif; 
$ftpimgfile='';$localimgfile='';
if($imgfile!=''){$ftpimgfile=$imgfile.'/';$localimgfile=$imgfile.'\\\\';}

$filetype=strrchr($url,"."); 
if($filetype!=".jpg"){echo '只支持200x200的jpg图片';exit;}
$filename=$filenameWidthoutType.$filetype;
ob_start(); readfile($url); $img = ob_get_contents(); ob_end_clean(); $size=strlen($img);
$savefilename='E:\\Webpages\\www.v-get.com\\tp\\j\\3\\'.$localimgfile.'\\200\\'.$filename;
$fp2=@fopen($savefilename,"a"); fwrite($fp2,$img);fclose($fp2); 
$savefilename_upload='E:\\Webpages\\_Uploads\\wbtp=tp.v-get.com\\j\\3\\'.$localimgfile.'\\200\\'.$filename;

$fp_upload=@fopen($savefilename_upload,"a"); fwrite($fp_upload,$img);fclose($fp_upload); 

$im=imagecreatefromjpeg($savefilename);
/* 用于改变图片尺寸 */
/* if($filetype=='.jpg'){$im=imagecreatefromjpeg($savefilename);}
else if($filetype=='.gif'){$im=imagecreatefromgif($savefilename);}else if($filetype=='.png'){$im=imagecreatefrompng($savefilename);} */
/* 用于改变图片尺寸 */
//resizeImage($im,$filenameWidthoutType,$filetype);
/* 水印 */
//imageWaterMark($savefilename,0,'/Webpages/www.v-get.com/tu/ishuiyin.png');
/*用于FTP上传 */
//FTP($ftpimgfile.$filename,$savefilename);

return $filename; 
}


if(isset($_POST['urlfile'])){
$urlfile=$_POST['urlfile'];
if($_FILES["file"]["error"]>0){echo "本地图片上传错误：" . $_FILES["file"]["error"] . "<br />";}
else{
/* $_FILES["file"]["name"] - 被上传文件的名称
$_FILES["file"]["type"] - 被上传文件的类型
$_FILES["file"]["size"] - 被上传文件的大小，以字节计
$_FILES["file"]["tmp_name"] - 存储在服务器的文件的临时副本的名称
$_FILES["file"]["error"] - 由文件上传导致的错误代码 */
//$filetype=strrchr($_FILES["file"]["name"],"."); 不能改名，因为urlfile没有改名
//分别移动至tp.v-get.com/j/ 还有 /_Uploads/wbtp=tp.v-get.com/j/3/co/
if($_FILES["file"]["type"]!='image/jpeg'&&$_FILES["file"]["type"]!='IMAGE/JPEG'){echo '请上传200x200 jpg格式图片';exit;}
 move_uploaded_file($_FILES["file"]["tmp_name"],'../../tp/j/3/'.$CITY.'/'.$_FILES["file"]["name"]);
}
GrabImage($urlfile,$p,$CITY);
}



?>