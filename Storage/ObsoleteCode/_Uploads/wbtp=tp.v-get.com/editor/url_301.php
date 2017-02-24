<?php
//FEIUP是上传图片的，避免被黑客利用，所以这里伪装名称url_301.php 
//feimgkey 用于提示，唯一值是id=felo，命名为   $("felo").value+'1'  
/* 没有 唯一命名，就用 时间命名133/dhis_1.jpg  用年月做目录，便于以后备份   ym/nm
同时要防止别人上传非法文件
 */
if(empty($_GET['ym'])||empty($_GET['nm'])||empty($_GET['site'])||empty($_GET['user'])||empty($_GET['check'])){Header('HTTP/1.1 301 Moved Permanently');Header('Location: http://e.v-get.com/');exit;}

else {
$USER=$_GET['user'];
//下面判断是不是可以上传，避免黑客利用
$CHECK=$_GET['check'];
require('user.php');
$Auser=$Usercheck[$USER];
if(!array_key_exists($USER,$Usercheck)||$CHECK!=$Auser[3]){Header('HTTP/1.1 301 Moved Permanently');Header('Location: http://e.v-get.com/');exit;}




// 如果有menu 就目录不是年份了
$ym=empty($_GET['menu'])?$_GET['ym']:$_GET['menu'];

$nmcss='';
// 如果有name 就命名不是时间了，而是命名 _1
$nm=empty($_GET['name'])?$_GET['nm']:$_GET['name'];if(isset($_POST['nm'])&&$nm!=$_POST['nm']){$nm=$_POST['nm'];$nmcss='color:#f00;';}$site=$_GET['site'];



}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>*{margin:0;padding:0}p{height:28px;line-height:28px}textarea{resize:vertical}.changecolor p{color:#090;font-weight:700}@media screen and (-webkit-min-device-pixel-ratio:0) {.input_file{width:70px;}}</style>
<form method="post" enctype="multipart/form-data" id="s" style="font-size:12px"><div id="changecolor"><p>* 百度、腾讯等图片设置了禁止外用，所以这类图片无法通过链接上传，请下载到本地再上传。</p><p>* 其他网址图片可以直接复制图片网址就可以上传，仅支持.jpg/.gif/.png格式图片。</p><p>* 下面如果显示图片了，就表示上传成功-不要管图片尺寸</p><p>* 居左居右结束要用 <span style="color:#C00">&lt;p class=&#34;o mh&#34;&gt;&lt;/p&gt;</span> 隔开</p></div>

<p><input type="text" name="datetime" value="<?php echo $_GET['datetime'];?>">
 <input type="checkbox" name="watermark" checked="checked">：水印（>150x150 px）</p>

<p>图片网址：<input type="text" name="urlfile" style="height:22px;width:290px" onblur="C($('changecolor'),'');" onfocus="C($('changecolor'),'changecolor');"/><input type="file" name="file" onchange="this.form.urlfile.value=this.value.replace('C:\\fakepath\\','http://tp.v-get.com/i/<?php echo $site;?>/');$('localimg').style.color='#D00';$('localimg').style.fontWeight='700'" class="input_file"><input type="hidden" name="site" value="<?php echo $_GET['site'];?>"><select name="float"><option value="o">居中</option><option value="p">居左</option><option value="q">居右</option></select>
</p><p>图片简介 alt：<input style="height:22px;width:250px" name="imgalt" value="<?php echo isset($_POST['imgalt'])?$_POST['imgalt']:'';?>"><input type="text" name="ym" value="<?php echo $ym;?>" style="width:21px;height:22px;border:none;background:none;margin:0 0 0 9px">/<input type="text" name="nm" value="<?php echo $nm,'" style="width:60px;height:22px;border:none;background:none;',$nmcss;?>"><input type="text" name="timeid" value="<?php echo isset($_POST['timeid'])?($_POST['timeid']+1):'1';?>" style="height:22px;width:20px;margin:0 9px 0 0"><input style="width:50px;height:25px" type="submit" name="Submit" value="上传"></p></form>
<div id="imgexist"></div>
<script type="text/javascript" src="http://tu.v-get.com/i.js"></script>
<script>
$("s").onsubmit=function(){if(L($("s").imgalt.value)<3){alert("请输入描述");return O}}
var datetime=Date.parse($r($("s").datetime.value,/\-/g,'/')),dt=new Date(datetime),now=new Date();

//没有上传后的显示图片，并且时间保持在30秒=30000毫秒之外才判断是否存在那张图片
if(!$("imgshow")&&30000<(now-datetime)){
var imgl='<img src="http://tp.v-get.com/i/'+<?php echo $site;?>+'/'+$("s").ym.value+'/'+$("s").nm.value+$("s").timeid.value
//三种可能
H($("imgexist"),imgl+'.gif" title="gif" alt="gif"><br>'+imgl+'.png" title="png" alt="png"><br>'+imgl+'.jpg" title="jpg" alt="jpg"><br>');
}

</script>

<?php
function imageWaterMark($groundImage,$filetype,$width,$height,$waterImage)
{
     if(!empty($waterImage)&&file_exists($waterImage)) {
	 
         $water_info = getimagesize($waterImage);
         $water_w=$water_info[0];$water_h= $water_info[1];
		 $water_im=imagecreatefrompng($waterImage);
         switch($filetype) {
             case '.gif':$ground_im = imagecreatefromgif($groundImage);break;
             case '.jpg':$ground_im = imagecreatefromjpeg($groundImage);break;
             case '.png':$ground_im = imagecreatefrompng($groundImage);break;
             default:return 1;
         }
		
     } else {echo 'Watermark Doesn&#39; Exit!';return false;}
         $w=$water_w;$h=$water_h;//if(($width<$w)||($height<$h)){return 3;}
	 $posX=rand(0,($width - $w));$posY = rand(0,($height - $h));
     imagealphablending($ground_im,true);
     imagecopy($ground_im,$water_im,$posX,$posY,0,0,$water_w,$water_h);
     @unlink($groundImage);
     switch($filetype) {
       /* 使用  imageinterlace($im,1) 可以使JPEG图片先显示模糊的轮廓，再慢慢清晰，而不是从上到下逐行显示图片  */
         case '.gif':imagegif($ground_im,$groundImage);break;
         case '.jpg':imageinterlace($ground_im,1);imagejpeg($ground_im,$groundImage,100);break;
         case '.png':imagepng($ground_im,$groundImage);break;
         default: return 6;
     }

     if(isset($water_info)) unset($water_info);
     if(isset($water_im)) imagedestroy($water_im);
     imagedestroy($ground_im);
     return 0;
}


function resizeImage($im,$filenameWidthoutType,$filetype,$pic_width,$pic_height,$savefile)
{
	if($pic_width<641):return false;endif;
    
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
  //ImageCopyResized()函数在所有GD版本中有效，但其缩放图像的算法比较粗糙。ImageCopyResamples()，其像素插值算法得到的图像边缘比较平滑，但该函数的速度比ImageCopyResized()慢。
        /* if(function_exists("imagecopyresampled"))
        { */
            $newim = imagecreatetruecolor($newwidth,$newheight);
           imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        /* }
        else
        {
            $newim = imagecreate($newwidth,$newheight);
           imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        } */

        $filename = $savefile.$filenameWidthoutType.$filetype;
		
		if($filetype=='.gif'){imagegif($newim,$filename);}
		if($filetype=='.png'){imagepng($newim,$filename);}
		if($filetype=='.jpg'){imagejpeg($newim,$filename,100);}
        imagedestroy($newim);
    }
        
}

function GrabImage($url,$filenameWidthoutType='',$site,$filetype,$savefile,$ym) { 
if($url==""):return false;endif; 

$filename=$filenameWidthoutType.$filetype;
ob_start(); readfile($url); $img = ob_get_contents(); ob_end_clean(); $size=strlen($img);
$savename=$savefile.$filename;
$fp2=@fopen($savename,"a"); fwrite($fp2,$img);fclose($fp2); 
if($filetype=='.gif'){
$fgif=fopen($savename,'rb');$gifcontent=fread($fgif, filesize($savename));fclose($fgif);
if(!strpos($gifcontent,chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0')){
$im=imagecreatefromgif($savename);
$width=imagesx($im);$height=imagesy($im);
if($width>640){resizeImage($im,$filenameWidthoutType,$filetype,$width,$height,$savefile);
//赋值新的$width / $height

$imgsize=getimagesize($savename);
$width=$imgsize[0];$height=$imgsize[1];

}
if(isset($_POST['watermark'])&&$width>150&&$height>150){imageWaterMark($savename,$filetype,$width,$height,'watermark/'.$site.'.png');}
}
}
else {
//网站关闭 global，所以尽量避免使用global
if($filetype=='.jpg'){$im=imagecreatefromjpeg($savename);}
else if($filetype=='.png'){
$im=imagecreatefrompng($savename);}
$width=imagesx($im);$height=imagesy($im);
if($width>640){resizeImage($im,$filenameWidthoutType,$filetype,$width,$height,$savefile);

$imgsize=getimagesize($savename);
$width=$imgsize[0];$height=$imgsize[1];
}
if(isset($_POST['watermark'])&&$width>150&&$height>150){echo 'lo';imageWaterMark($savename,$filetype,$width,$height,'watermark/'.$site.'.png');}
}

$imgalt=$_POST['imgalt'];


/* 写入数据库 ，避免有些图片没有被使用，就需要删除掉，这里保存所有信息，保存图片状态为0（未使用），之后在文章发布之后判断是否使用 */
//对于w3c不需要网络编辑写，就不需要插入数据库

/* if('w3c'!=$ym){
$QC=mysql_connect('hdm-094.hichina.com','hdm0940519','MySQL0img1314');mysql_select_db('hdm0940519_db',$QC);mysql_query('set names utf8');
$TB='vgt_t'.$site;
//存在则更新，不存在则插入 
$Qs='INSERT INTO '.$TB.' (p,h,q,w,g,t,u) VALUES ("'.$filenameWidthoutType.'","'.$imgalt.'","'.$filetype.'",'.$width.','.$height.',"'.$_POST['datetime'].'",0) ON DUPLICATE KEY UPDATE h="'.$imgalt.'",q="'.$filetype.'",w='.$width.',g='.$height.',t="'.$_POST['datetime'].'"';
$Qq=mysql_query($Qs,$QC) or die ('Insert Into E.V-Get.com Aritle failed: '.mysql_error());
} */

$float=$_POST['float'];
echo '<textarea style="width:100%;height:45px" id="imgforfile">';
if('o'==$float){echo '<p class="fo"><img alt="',$imgalt,'" src="http://tp.v-get.com/i/',$site,'/',$ym,'/',$filename,'" width="',$width,'" height="',$height,'"><br>',$imgalt,'</p>';}
else{echo '<p><strong>',$imgalt,'</strong></p><img class="'.$float.'" alt="',$imgalt,'" src="http://tp.v-get.com/i/',$site,'/',$ym,'/',$filename,'" width="',$width,'" height="',$height,'"><p class="o mh"></p>';}

echo '</textarea><div id="imgshow"><p>远程图片地址：http://tp.v-get.com/i/',$site,'/',$ym,'/',$filename,'<p><p></p><img src="http://tp.v-get.com/i/',$site,'/',$ym,'/',$filename,'" width="',$width,'" height="',$height,'" alt="FTP服务器图片，没成功就没显示"></div>';


}


if(isset($_POST['urlfile'])&&isset($_POST['ym'])&&isset($_POST['nm'])&&isset($_POST['site'])&&isset($_POST['timeid'])){

$urlfile=$_POST['urlfile'];$ym=$_POST['ym'];$nm_id=$_POST['nm'].$_POST['timeid'];$uploadfile=$_FILES["file"];$site=$_POST['site'];
/* 不存在文件夹就重建 ，默认设置777权限，而上级目录需要是777，因为这里需要执行mkdir 函数*/


if(!is_dir('../i/'.$site.'/'.$ym.'/')){mkdir('../i/'.$site.'/'.$ym.'/');}

if($uploadfile["error"]>0){$filetype=strrchr($urlfile,".");$filetype=strtolower($filetype);if($filetype!=".gif"&&$filetype!=".jpg"&&$filetype!=".png"){echo '不支持',$filetype,'格式的图片，仅支持.gif\.jpg\.png图片';exit;};
}
else{
$filetype=$uploadfile["type"];$filetype=substr($filetype,6);$filetype=strtolower($filetype);if($filetype=='jpeg'){$filetype='jpg';}$filetype='.'.$filetype;
if($filetype!=".gif" && $filetype!=".jpg"&& $filetype!=".png"){echo '不支持',$filetype,'格式的图片，仅支持.gif\.jpg\.png图片';exit;};



$savename='../i/'.$site.'/'.$ym.'/'.$nm_id.$filetype;
copy($uploadfile["tmp_name"],$savename);
}

$savefile='../i/'.$site.'/'.$ym.'/';

GrabImage($urlfile,$nm_id,$site,$filetype,$savefile,$ym);
}



?>