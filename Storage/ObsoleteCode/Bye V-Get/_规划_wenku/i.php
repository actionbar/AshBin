<?php
header('Content-type:text/html;charset=utf-8'); 
if(empty($_GET['f'])||empty($_GET['t'])){
//echo'<script>location.replace ("index.php") </script>';
echo 'no1';
exit();}
$u=$_GET['f']; //未编译的原始f
//echo $u; exit();
$f=urlencode($u);  //编译成 utf-8的 f
//$f=str_replace('+','%20',$f); 如果中文名包含空格，那么使用urlencode会转化为 + ，但是实际url应该是%20，所以要这样改
$t=$_GET['t'];
$s=str_replace('%','',$f);  //这样获取服务器文件名 把% 替换为空，
$s=strtolower($s);
$S='f/'.$s.'.'.$t;  //所在服务器相对目录及文件名
$z=filesize($S);//echo $S; exit();
 //为了避免是url编码来访问的出现乱码，特别是pdf文件里面的
 
 
 
 
$N=$u.'_V-Get.'.$t;   //下载后的新名称
//$N=str_replace(' ','%20',$N);
//echo $N;exit();
if (!file_exists($S)){ //检查文件是否存在 
  //echo '<script>location.replace("index.php")</script>'; 
  echo $S;
  echo '<br />no2';
  exit;   
  }else{ 
$F=fopen($S,'r'); // 打开文件
// 输入文件标签
Header('Content-type:application/octet-stream');
Header('Accept-Ranges:bytes');
Header('Accept-Length:'.$z);


//Header('Content-Disposition:attachment;filename="'.$N.'"');  使用这种写法，在ie下，会出现把utf-8编译成gb2312出现乱码文件名
//这里一定要注意双引号，不然文件名有空格，那么就无法读取空格后面的了
Header('Content-Disposition:attachment;filename*="utf8\'\''.$N.'"');  //这种写法可以兼容ie下文件名不乱码
// 输出文件内容
echo fread($F,$z);
fclose($F);
exit();}
?>