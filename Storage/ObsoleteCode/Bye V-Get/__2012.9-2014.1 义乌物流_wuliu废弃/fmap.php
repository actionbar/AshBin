<!DOCTYPE HTML><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$Qc=mysql_connect("localhost","root","qwdw114");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
//不考虑对是否找到进行判断，未找到进行跳转，因为页面不会有未找到的链接，只有居心叵测的人才会去找
$I=$_GET['i']; //用乘法的根本无法阻绝别人用算法采集，所以不如直接显示
$Qq=mysql_query('SELECT h,d,m,a,p,o,t,q,z FROM c WHERE i='.$I.' LIMIT 1');
$Qa=mysql_fetch_array($Qq);
$H=$Qa['h'];$D=$Qa['d'];$R=0;$M=$Qa['m'];$bM=(strlen($M)>0)?true:false;$A=$Qa['a'];$aA=array('','tuoyun','cangku','banjia','huoche','keyun','train','join','shebei','huodai');
$sa=$aA[$A];
//有P，就是头像，没有就是200*200广告
$P=$Qa['p']>0?'<img height="200" width="200" src="http://localhost/www.v-getimg.com/i1/s3/200/'.$Qa['p'].'.jpg" alt="'.$H.'"/>':'<img height="200" width="200" src="http://localhost/www.v-getimg.com/i1/s3/200/0.jpg" alt="200x200广告"/>'; 
echo '<title>',$H,'_商务物流网_V-Get!</title><meta name="keywords" content="',$H,' 物流公司 托运部 货运代理" /><meta name="description" content="',$D,'"/>';?>
<link href="http://localhost/www.v-getimg.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://localhost/www.v-getimg.com/i0/i.css" type="text/css" rel="stylesheet" />
<link href="http://localhost/www.v-getimg.com/i0/s3/ct.css" type="text/css" rel="stylesheet"/>
<link href="http://localhost/www.v-getimg.com/i0/s3/f.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="http://localhost/www.v-getimg.com/i0/i.js"></script>
</head>
<body>
<!--采用cookie，-->
<div class="ww">
<div class="wt"><div class="w a"><a href="http://yiwu.wuliu.v-get.com/" class="wti" title="返回义乌物流网首页"></a><a href="#" id="wt" wtz="[义乌托运]">[义乌托运]</a><a href="http://wuliu.v-get.com/" class="wto">首页</a><a href="#">新闻</a><a href="#">百科</a><form action="http://yiwu.wuliu.v-get.com/tuoyun/" id="ws"><input type="text" placeholder="搜索义乌托运" name="sk" class="wsk"/><input type="submit" value="" class="wss"/></form><div class="p"><a href="#" class="e">登录</a><a href="http://localhost/i.v-get.com/e/SignUp">注册</a></div></div></div>
<div class="w"><div id="wtz">
<h4><span>义乌托运</span><a href="#" class="pr">关闭</a></h4>
<table>
<tr><th colspan="2">切换城市</th><td class="wtzo" wtz="yiwu">义乌</td><td wtz="sh">上海</td></tr>
</table><table>
<tr><th colspan="4">切换类型</th></tr>
<tr><td class="wtzo" wtz="tuoyun">托运公司</td><td wtz="cangku">仓库出租</td><td wtz="banjia">搬家公司</td><td wtz="huoche">货车出租</td></tr><tr><td wtz="keyun">客运汽车</td><td wtz="peixun">培训中心</td><td wtz="lianyun">联运中心</td><td wtz="shebei">设备物资</td></tr><tr><td wtz="huodai">货代公司</td><td> </td><td> </td><td> </td></tr>
</table>
</div></div>
<div class="mt"></div>
<div class="w">
<div class="u">
<div class="i">
<div class="p il"><h1><?php echo $H;?></h1></div>
<div class="p ir"><p>义乌商务物流网</p><p>wuliu.v-get.com</p></div>
<div class="o"></div>
</div>
<div id="au" class="pr"><img src="http://localhost/www.v-get.com/p8/728x90/a.gif"/></div>
</div>
<div class="o mh"></div>









<div class="v">
<?php echo '<div class="c"><div class="f ci p"><div>',$P,'</div></div><div class="cr p"><div class="ct"><div class="p"><h1>';if($bM){echo '<a href="http://',$M,'.wuliu.v-get.com">',$H,'</a>';}else {echo '<a href="http://wuliu.v-get.com/',$I,'">',$H,'</a>';}echo '</h1></div><div class="p a"><a href="#" v="2"></a><a href="#" o="',$Qa['o'],'"></a><a href="http://wuliu.v-get.com/',$I,'" onclick="window.external.addFavorite(\'',$H,'\',\'http://wuliu.v-get.com/',$I,'\');return false" title="',$H,'" rel="sidebar">http://wuliu.v-get.com/',$I,'</a></div></div><div class="o c2"><a href="#">诚信保障</a><a href="#">企业认证</a></div><div class="c3">发布时间：',$Qa['t'],'</div><div class="c4"><span><a href="http://wuliu.v-get.com/',$I,'" onclick="window.external.addFavorite(\'',$H,'\',\'http://wuliu.v-get.com/',$I,'\');return false" title="',$H,'" rel="sidebar"><em>+</em>关注</a></span><i q="',$Qa['q'],'^Jlocalhost/yiwu.wuliu.v-get.com/',$sa,'-price/';
if($R>0){echo '?sco=',$R;}
if($bM){echo '^W',$M,'.wuliu.v-get.com';}
echo '"></i></div><div class="cc"><p>',$D,'</p></div></div><div class="o"></div></div><div class="o mh"></div><div id="d" class="mg"></div>';?>



					<div id="fmap">&nbsp;</div>
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
					<script type="text/javascript">
					
					    
					
					</script>

<div class="o mh mg"></div>
</div>

<div class="b">
<div class="bt">|<a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">营销中心</a>|<a href="#">站点地图</a>|<a href="#">隐私策略</a>|<a href="#">用户协议</a>|<a href="#">法律声明</a>|</div>
<p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a> <a  href="http://www.miibeian.gov.cn/" rel="nofollow">ICP12013909</a> All Right Reserved</p></div>
</div>
</div>
<script type="text/javascript">
J('http://localhost/www.v-getimg.com/i0/s3/c.js');












</script>
</body>
</html>