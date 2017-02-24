<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- 
版本：V1.9 2012.02.17
阿里博客：www.ali727.com
演示网址：http://www.ali727.com/files/unshort/
反馈QQ：80306764
-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>短网址还原 - 短网址分析 - 短网址真实网址</title>
<meta name="copyright" content="Ali727.Com" />
<meta name="keywords" content="短网址程序 短网址原理 短网址源码" />
<meta name="description" content="一款在线还原绝大数短网址的程序。" />
<link rel="stylesheet" type="text/css" href="css/css.css" />
</head>
<body>
<?php
    $info1 = '亲！暂不能解析此类短网址。';
    $info2 = '亲！网址解析失败，请重试。';
    $info3 = '<br/><b><a href="';
    $info4 = '" target="_blank">立即访问>></a></b>';
	$info5 = '亲！不是短网址或无效。';
function unshort($url)
{
global $info1,$info2,$info3,$info4;
    $curl = curl_init();	
    curl_setopt($curl, CURLOPT_URL, $url);	
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
    curl_setopt ($curl, CURLOPT_USERAGENT, 'Mozilla/8.0 (compatible; MSIE 8.0; Windows 7');
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_NOBODY, 0);
	curl_setopt($curl, CURLOPT_TIMEOUT, 15); 
    curl_setopt($curl,CURLOPT_ENCODING, 'gzip'); 
    $data = curl_exec($curl);
    if(!empty($data)){	   
    $message = curl_getinfo($curl);
       curl_close($curl);
	     $status = $message['http_code'];		 
		    if ($status == '301' || $status == '302' ){	
	           $UrlHeader = (get_headers($url,1));  
			   $unurl = $UrlHeader[Location];
			   if(is_array($unurl)) {
                  $unurl = $unurl[0];
				  $unurl .=$info3.$unurl.$info4;
				  return $unurl;
			      }
               else {				  
               $unurl .=$info3.$unurl.$info4;				  
               return $unurl;	
               }			   
		    }		
	  return $info1;	  
	}  
 return $info2;  
}
 
function adfunshort($url)
{
global $info3,$info4,$info5;
    $c = file_get_contents($url);
    $p = "/url = '(.*)';/isU";
    preg_match($p, $c, $content);
    $unurl = $content[1];
    if($unurl == '') {
      return $info5;
      }
    else {
      $unurl .=$info3.$unurl.$info4;
      return $unurl;
      }
}
?>
<div id="all">
<div id="logo">短网址还原 - UnShortURL</div>

<div id="form">
  <form action="" method="POST">
  短网址：<input type="text" name="turl" class="inurl" size="26" />
  <input type="hidden" name="url_done" value="done" />
  <input type="submit" value="提交" class="suburl" />
  </form>
</div>

<div id="trurl">

<?php
$turl = $_POST['turl'];
$url_done= $_POST['url_done'];
if ($url_done == 'done'){
$http = substr($turl,0,7);
   if ($http != 'http://' && $http != 'https:/'){
     $turl = 'http://'.$turl;
	 }
	 $tturl = substr($turl,0,11);
	 if ($tturl == 'http://adf.'){
	  $longurl = adfunshort($turl);
	  }
     else {
      $longurl = unshort($turl); 
      } 
echo " 真实网址为：<br />$longurl ";
}
?>
</div>

<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fe50b127d9c67170c4d161ce894e1b928' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>