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
function GrabImage($url,$filenameWidthoutType='',$site,$filetype,$savefilename) { 
if($url==""):return false;endif; 
$savefile=$site.'/';

$filename=$filenameWidthoutType.$filetype;
ob_start(); readfile($url); $img = ob_get_contents(); ob_end_clean(); $size=strlen($img);
$savefilename=$savefile.$filename;
$fp2=@fopen($savefilename,"a"); fwrite($fp2,$img);fclose($fp2); 

$imgalt=$_POST['imgalt'];
$imgsize=getimagesize($savefilename);//$imgsize[0] 宽  1 高
if(strlen($imgalt)>0){echo '<textarea style="width:100%;height:45px" id="imgforfile"><div style="text-align:center"><img alt="',$imgalt,'" src="http://tp.v-get.com/e/',$savefilename,'" width="',$imgsize[0],'" height="',$imgsize[1],'"><p>',$imgalt,'</p></div></textarea>';}
else {echo '<textarea style="width:100%;height:45px" id="imgforfile"><div style="align:center"><img src="http://tp.v-get.com/e/',$savefilename,'" width="',$imgsize[0],'" height="',$imgsize[1],'"></div></textarea>';}
echo '<p>远程图片地址：http://tp.v-get.com/e/',$savefilename,'<p><p></p><img src="http://tp.v-get.com/e/',$savefilename,'" width="',$imgsize[0],'" height="',$imgsize[1],'" alt="FTP服务器图片，没成功就没显示">';


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