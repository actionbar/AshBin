<?php

/*$t是0/1；$e是指sx，各个搜索引擎；k=keyword;  x如果设置了，就是精简；没设置就是正常；*/
$t=$_GET['t'];$h='85%';$p='104';$n2='style="display:none"';$n1='';
$x=$_GET['x'];$sx='sx';
if($x){$sx='sx1';$h='95%';$n2='';$p='34';$n1='style="display:none"';}
$e=isset($_GET['e'])?$_GET['e']:array('0');

/*如果是双，就在iframe传到frameset里面执行；如果是单，就直接在当前iframe传递*/
$k=$_GET['k'];
/*
google:
http://www.google.com.tw/custom?hl=zh-CN&inlang=zh-CN&newwindow=1&client=pub-657300513365774&cof=FORID:1%3BGL:1%3BLBGC:336699%3BLC:%230000ff%3BVLC:%23663399%3BGFNT:%230000ff%3BGIMP:%230000ff%3BDIV:%23336699%3B&oe=GB2312&ei=wpSGT8mzOc-XiAeksNi_Bw&start=10&sa=N&q=

http://www.google.com.hk/cse?q=love&cx=partner-pub-4567890669486208:1082015924&ie=GB2312#gsc.tab=0&gsc.page=1&gsc.q=
*/
$l=array(0=>'http://www.baidu.com/baidu?tn=bds&cl=3&ct=2097152&si=hi.baidu.com&ie=UTF-8&oe=UTF-8&hl=zh-CN&word=',12=>'http://www.baidu.com/s?wd=',131=>'http://www.google.com.tw/custom?hl=zh-CN&inlang=zh-CN&newwindow=1&client=pub-657300513365774&cof=FORID:1%3BGL:1%3BLBGC:336699%3BLC:%230000ff%3BVLC:%23663399%3BGFNT:%230000ff%3BGIMP:%230000ff%3BDIV:%23336699%3B&oe=GB2312&ei=wpSGT8mzOc-XiAeksNi_Bw&start=10&meta=cr%3DcountryTW&sa=N&q=',140=>'http://search.yahoo.com/search?p=');

$e0=$e[0];
$js=$e0;

$l0=isset($l[$e0])?$l[$e0]:'http://www.baidu.com/baidu?tn=bds&cl=3&ct=2097152&si=hi.baidu.com&ie=UTF-8&oe=UTF-8&hl=zh-CN&word=';

$ll=$l0.$k;
$K='http://localhost:8080/hao.v-get.com/s?t='.$t.'&k='.$k.'&e%5B%5D='.$e0;
if(isset($e[1])){
$e1=$e[1];
$K.='&e%5B%5D='.$e1;
$js.='_'.$e1;
$l1=isset($l[$e1])?$l[$e1]:'http://www.baidu.com/baidu?tn=bds&cl=3&ct=2097152&si=hi.baidu.com&ie=UTF-8&oe=UTF-8&hl=zh-CN&word=';	
$lr=$l1.$k;
	$w='<iframe src="'.$ll.'" width="50%" height="'.$h.'"  framespacing="0" frameborder="0" scrolling="Auto" noresize="noresize"></iframe>
<iframe src="'.$lr.'" width="50%" height="'.$h.'"  framespacing="0" frameborder="0" scrolling="Auto" noresize="noresize"></iframe>';}
else {$w='<iframe src="'.$ll.'" width="100%" height="'.$h.'"  framespacing="0" frameborder="0" scrolling="Auto" noresize="noresize"></iframe>';}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta content="text/html; charset=gb2312" http-equiv="Content-Type" />
<head>
<title>V-Get!享受商务好生活！</title>
<style type="text/css">
<!--
html{overflow:hidden;}/*设置滚动不可用，与下面class=c的position:absolute; height:100%;width:100%共同成就了让下面全屏显示*/
*{margin:0}
body{font:12px "Tahoma","SimSun";}
a{color:#00c}
.p{float:left}
#s{POSITION: absolute; DISPLAY: none; TOP: 0px; LEFT: 10px}
#s a{CURSOR: hand; TEXT-DECORATION: none}

#t{height:70px; background:url(http://localhost:8080/v-get.com/www/h_blue.gif) repeat-x;}
#st{height:25px;line-height:30px;line-height:33px\9;font-size:14px}
#st a{margin:8px}
#st .sto{ text-decoration:none; color:#333; font-weight:800; cursor: text;}
.sb{height:40px;line-height:40px;}
.sb input{margin-right:9px;}
#k{font:16px/22px arial;height:25px;width:560px;}
.s1{border:0;width:89px;height:30px;padding-top:2px\9;font-family:"Tahoma","SimSun"; font-weight:800; color:#333;background:#ddd url(http://localhost:8080/v-get.com/www/i-30.png);cursor:pointer}
.s1o{background-position:-95px 0}



.n{height:32px;line-height:32px;border-top:#dad7cf 1px solid;border-bottom:#dad7cf 1px solid; background:url(http://localhost:8080/v-get.com/www/bg_btn.png) repeat-x}
.n a{border-right: #e4e1da 1px solid;text-align:center;color:#645a44;text-decoration:none; }
.n .nl{width:99px; display:inline-block;float:left;color:#350}
.n span a{padding:8px 15px; }
.n a:hover{ background:url(http://localhost:8080/v-get.com/www/bg_btn_hover.png) repeat-x;}
.n .no{ background:url(http://localhost:8080/v-get.com/www/bg_btn_active_yellow.png) repeat-x;}
.n form{width:750px;float:left;vertical-align:middle; overflow:hidden}
.n input{margin:0 3px 0 19px;vertical-align:middle}


/*1024 * 768最长用，默认*/
#c{height:100%;width:100%;position: absolute;text-align:center;top:<?php echo $p;?>px;}
#c iframe{ float:left}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/i.js"></script>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/hao/i.js"></script>
<body>
<div <?php echo $n1;?>>
<div id="t">
<img src="http://localhost:8080/v-get.com/www/soupic.gif" width="220" height="50" class="p"/>
<div id="st">
<a href="http://localhost:8080/www.v-get.com/s?a=0">常用</a><a href="http://localhost:8080/cn.v-get.com/s?e%5B%5D=1">网页</a><a href="http://localhost:8080/www.v-get.com/s?a=0">媒体</a><a href="http://localhost:8080/www.v-get.com/s?a=0">购物</a><a href="http://localhost:8080/www.v-get.com/s?a=0">B2B</a><a href="http://localhost:8080/www.v-get.com/s?a=0">百科<!--BBS地图+百科--></a><a href="http://localhost:8080/www.v-get.com/s?a=0">娱乐</a><a href="http://localhost:8080/www.v-get.com/s?a=0">下载<!--MP3+视频--></a>
</div>

<form action="http://localhost:8080/hao.v-get.com/s" class="sb" name="s" method="get"><input type="hidden" value="0" name="t" /><input type="hidden" name="x" value="0" />
<input type="text" size="100" id="k" name="k" value="<?php echo $k;?>" /><input type="submit"  onmouseout="this.className='s1'" onmousedown="this.className='s1 s1o'"  value="V-Get!" class="s1"/><span>推荐：<a href="#">设普通版为主页</a></span>
<div class="n">
<a href="<?php echo $K.'&x=1';?>" class="nl">收起&nbsp;&uarr;</a>
<span id="sx"><input 
type="checkbox" name="e[]"/>V-Get!<input 
type="checkbox" name="e[]"/>Google<input 
type="checkbox" name="e[]"/>百度<input 
type="checkbox" name="e[]"/>Yahoo<input 
type="checkbox" name="e[]"/>搜狗<input 
type="checkbox" name="e[]"/>搜索
</span>
</div>

</form>
</div>





</div>

<div class="n" <?php echo $n2;?>>
<a href="<?php echo $K.'&x=0';?>" class="nl">展开&nbsp;&darr;</a>
<form action="http://localhost:8080/hao.v-get.com/s" method="get"><span id="sx1"><input type="checkbox" name="e[]" value="0" checked="checked" t="1" />V-Get!<input type="checkbox" name="e[]" value="12" />百度<input type="checkbox" name="e[]" value="13" />Google<input type="checkbox" name="e[]" value="32" />淘宝<input type="checkbox" name="e[]" value="42" />阿里巴巴<input type="checkbox" name="e[]" value="420" />Alibaba</span><input type="text" name="k"  value="<?php echo $k;?>" /><input type="hidden" name="t" value="0" /><input type="hidden" name="x" value="1" /><input type="submit" value="V-Get!" /></form><span>推荐：<a href="#">设精简版为主页</a><a href="">物流</a></span>
</div>


<div id="c">
<?php echo $w;?>
</div>

<script language="javascript" type="text/javascript">
<!--

<?php echo 'O2("'.$sx.'",'.$t.',"'.$js.'",'.$x.');';?>

-->
</script>
</body></html>