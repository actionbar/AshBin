
<?php
$e=$_GET['e'];
$l=array('0'=>'http://www.baidu.com/baidu?tn=bds&cl=3&ct=2097152&si=hi.baidu.com&ie=UTF-8&oe=UTF-8&hl=zh-CN&word=','12'=>'http://www.baidu.com/s?wd=','13'=>'http://www.google.com.hk/cse?q=love&cx=partner-pub-4567890669486208:1082015924&ie=GB2312#gsc.tab=0&gsc.page=1&gsc.q=','13e'=>'http://search.yahoo.com/search?p=');
$k=$_GET['k'];
$e0=$e[0];
$l0=isset($l[$e0])?$l[$e0]:$l['0'];

$e1=$e[1];
$l1=isset($l[$e1])?$l[$e1]:$l['0'];
$ll=$l0.$k;
$lr=$l1.$k;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
  <frameset cols="50%,*" frameborder="0">
    <frame src="<?php echo $ll;?>"/>
    <frame src="<?php echo $lr;?>"/>
     <noframes> <body>  body is here</body> </noframes>
  </frameset>
</html>
