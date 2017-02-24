<!DOCTYPE HTML><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$Qc=mysql_connect("localhost","root","qwdw114");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
//不考虑对是否找到进行判断，未找到进行跳转，因为页面不会有未找到的链接，只有居心叵测的人才会去找
$I=$_GET['i']; //用乘法的根本无法阻绝别人用算法采集，所以不如直接显示
$Qq=mysql_query('SELECT h,d,m,a,p,o,t,q,f FROM c WHERE i='.$I.' LIMIT 1');
$Qa=mysql_fetch_array($Qq);
$H=$Qa['h'];$D=$Qa['d'];$R=0;$M=$Qa['m'];$bM=(strlen($M)>0)?true:false;$A=$Qa['a'];$aA=array('','tuoyun','cangku','banjia','huoche','keyun','train','join','shebei','huodai');
$sa=$aA[$A];


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
<?php echo '<div class="c"><div class="f ci p"><div>';
if($bM){echo '<img height="200" width="200" src="http://localhost/www.v-getimg.com/i1/s3/200/'.$M.'.jpg" alt="'.$H.'"/>';}
else {
//有P，就是头像，没有就是200*200广告
$P=$Qa['p'];
if($P>0) {echo '<img height="200" width="200" src="http://localhost/www.v-getimg.com/i1/s3/200/'.$Qa['p'].'.jpg" alt="'.$H.'"/>';}
else {echo '<img height="200" width="200" src="http://localhost/www.v-getimg.com/i1/s3/200/0.jpg" alt="200x200广告"/>'; }
}

echo '</div><div class="a" id="ci"><a href="http://localhost/i.v-get.com/report/views?f=3&o=good"><strong>339</strong><i>好评</i></a><a href="http://localhost/i.v-get.com/report/views?f=3" class="ic"><strong>9989</strong><i>浏览</i></a><a href="http://localhost/i.v-get.com/report/views?f=3&o=nogood"><strong>5</strong><i>差评</i></a></div></div><div class="cr p"><div class="ct"><div class="p"><h1>';if($bM){echo '<a href="http://',$M,'.wuliu.v-get.com">',$H,'</a>';}else {echo '<a href="http://wuliu.v-get.com/',$I,'">',$H,'</a>';}echo '</h1></div><div class="p a"><a href="#" v="2"></a><a href="#" o="',$Qa['o'],'"></a><a href="http://wuliu.v-get.com/',$I,'" onclick="window.external.addFavorite(\'',$H,'\',\'http://wuliu.v-get.com/',$I,'\');return false" title="',$H,'" rel="sidebar">http://wuliu.v-get.com/',$I,'</a></div></div><div class="o c2"><a href="#">诚信保障</a><a href="#">企业认证</a></div><div class="c3">发布时间：',$Qa['t'],'</div><div class="c4"><span><a href="http://wuliu.v-get.com/',$I,'" onclick="window.external.addFavorite(\'',$H,'\',\'http://wuliu.v-get.com/',$I,'\');return false" title="',$H,'" rel="sidebar"><em>+</em>关注</a></span><i q="';if($bM){echo 'W',$M,'.wuliu.v-get.com^';}echo '^Jlocalhost/yiwu.wuliu.v-get.com/',$sa,'-price/';
if($R>0){echo '?sco=',$R;}
echo '^Dwuliu.v-get.com/',$I,'map"></i></div><div class="cc"><p>',$D,'</p></div></div><div class="o"></div></div><div id="d" class="a"><a href="http://localhost/yiwu.wuliu.v-get.com/',$sa,'-price/';
if($R>0){echo '?sco=',$R;}
echo '">价格查询</a></div><div class="o mh"></div><div class="vv">';?>

<div class="p l"><?php echo '<div id="f">',$Qa['f'];
if($bM){echo '<p>网　址：<a href="http://',$M,'.wuliu.v-get.com">',$M,'.wuliu.v-get.com</a></p>';}
echo '<p>&nbsp;</p></div>';?>

<div id="l2"><a href="#">好评</a><a href="#">差评</a></div>

<div class="h">

<div id="hn"><span class="p"><?php if(isset($_SESSION['si'])){echo '<a href="#" class="fh">',$_SESSION['sa'],'</a><a href="http://localhost/i.v-get.com/e/SignOut">退出</a>';} else {echo '<a href="#" class="e">登陆</a><a href="http://localhost/i.v-get.com/e/SignUp">注册</a>';}?></span><span class="q">发言请遵守社区公约，还可以输入<i>140</i>字</span></div>
<form id="hs" action="http://localhost/i.v-get.com/e/pinglun.html" method="post">
<input type="hidden" name="hf" value="3^<?php echo $I;?>"/><input type="hidden" name="hip" value="183.154.94.46"/><input type="hidden" name="hadd" value="浙江省金华市"/><input type="hidden" name="hjj" value="0"/>
<textarea name="ht"></textarea>
<div class="lbb"><div class="p">表情</div><div class="p">同时转发到：</div><div class="q"><input type="submit" value="发表评论" class="hs"/></div></div><div class="o"></div>
</form>
<div id="hf">
<iframe src="http://localhost/i.v-get.com/e/pinglunlist?b=fafafa&r=529&f=3&g=<?php echo $I;?>&v=<?php echo $H;?>" width="100%" scrolling="no" frameborder="0" height="500" marginheight="0" marginwidth="0"></iframe>
</div>
</div>

</div><div class="p r">

<div id="map"></div><script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script><script type="text/javascript">(function(){var m=new BMap.Map("map"),p=new BMap.Point(120.083163,29.336384),k=new BMap.Marker(p);m.centerAndZoom(p,13);m.enableScrollWheelZoom();m.addControl(new BMap.NavigationControl());m.addControl(new BMap.ScaleControl());m.addControl(new BMap.OverviewMapControl());k.setAnimation(BMAP_ANIMATION_BOUNCE);m.addOverlay(k);m.addEventListener($7,function(){$3.open("http://wuliu.v-get.com/1map")})})();</script>

<div class="rt">
<div class="ri"></div>
<div id="ri">
<h4><a href="http://i.v-get.com/report/views?f=3&o=good">企业好评 <span>(399)</span></a><a href="http://i.v-get.com/report/views?f=3&o=good" class="pr">更多»</a></h4>
<div class="a"><a href="http://wuliu.v-get.com/474" title="义乌市APL美国总统轮船公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/502.gif" alt="义乌市APL美国总统轮船公司"><br>APL美国总统轮船公司</a><a href="http://wuliu.v-get.com/476" title="义乌市MSC地中海航运轮船公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/504.gif" alt="义乌市MSC地中海航运轮船公司"><br>MSC地中海航运轮船公司</a><a href="http://wuliu.v-get.com/478" title="义乌市IFB国桥远航轮船公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/506.gif" alt="义乌市IFB国桥远航轮船公司"><br>IFB国桥远航轮船公司</a></div>
<div class="o"></div>
<h4><a href="http://i.v-get.com/report/views?f=3">浏览搜索量 <span>(9989)</span></a><a href="http://i.v-get.com/report/views?f=3" class="pr">更多»</a></h4>
<div class="a"><a href="http://wuliu.v-get.com/257" title="义乌市力拓国际货运代理公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/279.gif" alt="义乌市力拓国际货运代理公司"><br>力拓国际货运代理公司</a><a href="http://wuliu.v-get.com/470" title="义乌市泛远国际物流公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/498.gif" alt="义乌市泛远国际物流公司"><br>泛远国际物流公司</a><a href="http://wuliu.v-get.com/719" title="义乌市立方速国际货运代理公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/748.gif" alt="义乌市立方速国际货运代理公司"><br>立方速国际货运代理公司</a></div>
<div class="o"></div>
<h4><a href="http://i.v-get.com/report/views?f=3&o=nogood">企业差评 <span>(5)</span></a><a href="http://i.v-get.com/report/views?f=3&o=nogood" class="pr">更多»</a></h4>
<div class="a"><a href="http://wuliu.v-get.com/257" title="义乌市力拓国际货运代理公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/279.gif" alt="义乌市力拓国际货运代理公司"><br>力拓国际货运代理公司</a><a href="http://wuliu.v-get.com/477" title="义乌市达贸国际轮船公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/505.gif" alt="义乌市达贸国际轮船公司"><br>达贸国际轮船公司</a><a href="http://wuliu.v-get.com/835" title="义乌市浩远国际快递公司"><img src="http://localhost/www.v-getimg.com/i1/s3/50/868.gif" alt="义乌市浩远国际快递公司"><br>浩远国际快递公司</a></div>
<div class="o"></div>
</div>
</div>
<div class="o mh"></div>



<div id="ar" class="fo">
<img src="http://localhost/www.v-get.com/p8/250x250/2.jpg" width="250" height="250"/>
</div>
</div><div class="o"></div></div></div>
<div class="o"></div>
<div class="b">
<div class="bt">|<a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">营销中心</a>|<a href="#">站点地图</a>|<a href="#">隐私策略</a>|<a href="#">用户协议</a>|<a href="#">法律声明</a>|</div>
<p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a> <a  href="http://www.miibeian.gov.cn/" rel="nofollow">ICP12013909</a> All Right Reserved</p></div>
</div>
</div>
<script type="text/javascript">
J('http://localhost/www.v-getimg.com/i0/s3/c.js');
J("http://localhost/www.v-getimg.com/i0/s3/f.js",function(){iu(<?php echo $I;?>,"<?php echo $H;?>")});












</script>
</body>
</html>