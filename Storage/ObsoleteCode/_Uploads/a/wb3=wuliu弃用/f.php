<!DOCTYPE HTML><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$Qc=mysql_connect("localhost","wla1Ako","vgt1295EN");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
$I=$_GET['i'];
$Qq=mysql_query('SELECT * FROM c WHERE i='.$I.' LIMIT 1');
$Qa=mysql_fetch_array($Qq);
$H=$Qa['h'];$D=$Qa['d'];
$P=$Qa['p']>0?'<img height="200" width="200" src="http://weigeti.com/i1/v3/200/'.$Qa['p'].'.jpg" alt="'.$H.'"/>':'<script type="text/javascript">var cpro_id="u1189528";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>';
echo '<title>',$H,'_商务物流网_V-Get!</title><meta name="keywords" content="',$H,' 物流公司 托运部 货运代理" /><meta name="description" content="',$D,'"/>';?>
<link href="http://weigeti.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://weigeti.com/i0/c.css" type="text/css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="http://weigeti.com/i0/v3/f.css"/>
<script type="text/javascript" src="http://weigeti.com/i0/c.js?id=2011"></script>
</head>
<body>
<div class="ww">
<div class="t"><div class="w a"><a href="http://yiwu.wuliu.v-get.com/" class="ti" title="返回义乌物流网首页"></a><a href="#" id="t" tz="[义乌托运]">[义乌托运]</a><a href="http://wuliu.v-get.com/" class="to">首页</a><a href="#">新闻</a><a href="#">百科</a><form action="http://yiwu.wuliu.v-get.com/tuoyun/" id="s"><input type="text" placeholder="搜索义乌托运" name="sk" class="sk"/><input type="submit" value="" class="ss"/></form><div class="p"><a href="#" class="e">登录</a><a href="http://i.v-get.com/e/SignUp">注册</a></div></div></div>
<div class="w">
<div id="tz">
<h4><span>义乌托运</span><a href="#" class="h4r">关闭</a></h4>
<table>
<tr><th colspan="2">切换城市</th><td class="tzo" tz="yiwu">义乌</td><td tz="sh">上海</td></tr>
</table><table>
<tr><th colspan="4">切换类型</th></tr>
<tr><td class="tzo" tz="tuoyun">托运公司</td><td tz="cangku">仓库出租</td><td tz="banjia">搬家公司</td><td tz="huoche">货车出租</td></tr><tr><td tz="keyun">客运汽车</td><td tz="peixun">培训中心</td><td tz="lianyun">联运中心</td><td tz="shebei">设备物资</td></tr><tr><td tz="huodai">货代公司</td><td> </td><td> </td><td> </td></tr>
</table>
</div>
<?php echo '<div class="wc"><div class="u"><div class="f i p"><div>',$P,'</div><div class="a" id="i"><a href="http://i.v-get.com/report/views?f=3&o=good"><strong>339</strong><i>好评</i></a><a href="http://i.v-get.com/report/views?f=3" class="ic"><strong>9989</strong><i>浏览</i></a><a href="http://i.v-get.com/report/views?f=3&o=nogood"><strong>5</strong><i>差评</i></a></div></div><div class="g p"><div class="gt a"><h1>',$H,'</h1><a href="#" v="2"></a><a href="#" o="',$Qa['o'],'"></a><a href="http://wuliu.v-get.com/',$I,'" onclick="window.external.addFavorite(\'',$H,'\',\'http://wuliu.v-get.com/',$I,'\');return false" title="',$H,'" rel="sidebar">http://wuliu.v-get.com/',$I,'</a></div><div class="o g2"><a href="#">诚信保障</a><a href="#">企业认证</a></div><div class="g3">发布时间：',$Qa['t'],'</div><div class="g4"><span><a href="http://wuliu.v-get.com/',$I,'" onclick="window.external.addFavorite(\'',$H,'\',\'http://wuliu.v-get.com/',$I,'\');return false" title="',$H,'" rel="sidebar"><em>+</em>关注</a></span><i q="',$Qa['q'],'"></i></div><div class="gc"><p>',$D,'</p></div></div><div class="o"></div></div><div id="d" class="a"></div><div class="o mh"></div><div class="v">';?>

<div class="p l"><?php echo '<div id="c">',$Qa['f'],'<p>&nbsp;</p></div>';?>

<div id="l2"><a href="#">好评</a><a href="#">差评</a></div>

<div class="h">

<div id="hn"><span class="p"><?php if(isset($_SESSION['si'])){echo '<a href="#" class="fh">',$_SESSION['sa'],'</a><a href="http://i.v-get.com/e/SignOut">退出</a>';} else {echo '<a href="#" class="e">登陆</a><a href="http://i.v-get.com/e/SignUp">注册</a>';}?></span><span class="q">发言请遵守社区公约，还可以输入<i>140</i>字</span></div>
<form id="hs" action="http://i.v-get.com/e/pinglun" method="post">
<input type="hidden" name="hf" value="3^<?php echo $I;?>"/><input type="hidden" name="hip" value="183.154.94.46"/><input type="hidden" name="hadd" value="浙江省金华市"/><input type="hidden" name="hjj" value="0"/>
<textarea name="ht"></textarea>
<div class="lbb"><div class="p">表情</div><div class="p">同时转发到：</div><div class="q"><input type="submit" value="发表评论" class="hs"/></div></div><div class="o"></div>
</form>
<div id="hf">
<iframe src="http://i.v-get.com/e/pinglunlist?b=fafafa&r=529&f=3&g=<?php echo $I;?>&v=<?php echo $H;?>" width="100%" scrolling="no" frameborder="0" height="500" marginheight="0" marginwidth="0"></iframe>
</div>
</div>

</div><div class="p r">
<div class="rt">
<div class="ri"></div>
<div id="ri">
<h4><a href="http://i.v-get.com/report/views?f=3&o=good">企业好评 <span>(399)</span></a><a href="http://i.v-get.com/report/views?f=3&o=good" class="h4r">更多»</a></h4>
<div class="a"><a href="http://wuliu.v-get.com/474" title="义乌市APL美国总统轮船公司"><img src="http://weigeti.com/i1/v3/50/502.gif" alt="义乌市APL美国总统轮船公司"><br>APL美国总统轮船公司</a><a href="http://wuliu.v-get.com/476" title="义乌市MSC地中海航运轮船公司"><img src="http://weigeti.com/i1/v3/50/504.gif" alt="义乌市MSC地中海航运轮船公司"><br>MSC地中海航运轮船公司</a><a href="http://wuliu.v-get.com/478" title="义乌市IFB国桥远航轮船公司"><img src="http://weigeti.com/i1/v3/50/506.gif" alt="义乌市IFB国桥远航轮船公司"><br>IFB国桥远航轮船公司</a></div>
<div class="o"></div>
<h4><a href="http://i.v-get.com/report/views?f=3">浏览搜索量 <span>(9989)</span></a><a href="http://i.v-get.com/report/views?f=3" class="h4r">更多»</a></h4>
<div class="a"><a href="http://wuliu.v-get.com/257" title="义乌市力拓国际货运代理公司"><img src="http://weigeti.com/i1/v3/50/279.gif" alt="义乌市力拓国际货运代理公司"><br>力拓国际货运代理公司</a><a href="http://wuliu.v-get.com/470" title="义乌市泛远国际物流公司"><img src="http://weigeti.com/i1/v3/50/498.gif" alt="义乌市泛远国际物流公司"><br>泛远国际物流公司</a><a href="http://wuliu.v-get.com/719" title="义乌市立方速国际货运代理公司"><img src="http://weigeti.com/i1/v3/50/748.gif" alt="义乌市立方速国际货运代理公司"><br>立方速国际货运代理公司</a></div>
<div class="o"></div>
<h4><a href="http://i.v-get.com/report/views?f=3&o=nogood">企业差评 <span>(5)</span></a><a href="http://i.v-get.com/report/views?f=3&o=nogood" class="h4r">更多»</a></h4>
<div class="a"><a href="http://wuliu.v-get.com/257" title="义乌市力拓国际货运代理公司"><img src="http://weigeti.com/i1/v3/50/279.gif" alt="义乌市力拓国际货运代理公司"><br>力拓国际货运代理公司</a><a href="http://wuliu.v-get.com/477" title="义乌市达贸国际轮船公司"><img src="http://weigeti.com/i1/v3/50/505.gif" alt="义乌市达贸国际轮船公司"><br>达贸国际轮船公司</a><a href="http://wuliu.v-get.com/835" title="义乌市浩远国际快递公司"><img src="http://weigeti.com/i1/v3/50/868.gif" alt="义乌市浩远国际快递公司"><br>浩远国际快递公司</a></div>
<div class="o"></div>
</div>

</div>

<div class="o mh"></div>
<div id="ar" class="fo">
<script type="text/javascript">var cpro_id = "u1208454";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
</div>

</div><div class="o"></div></div></div>
<div class="b">
<div class="bt">|<a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">营销中心</a>|<a href="#">站点地图</a>|<a href="#">隐私策略</a>|<a href="#">用户协议</a>|<a href="#">法律声明</a>|</div>
<p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a> <a  href="http://www.miibeian.gov.cn/" rel="nofollow">ICP12013909</a> All Right Reserved</p></div>
</div>
</div>

<script src="http://weigeti.com/i0/vi/pinglun.js" type="text/javascript"></script>
<script src="http://i.v-get.com/j/iu?f=3&lk=wuliu.v-get.com%2f<?php echo $I;?>%22%3e<?php echo $H;?>&g=<?php echo $I;?>" type="text/javascript"></script>
<script type="text/javascript">
(function(){
 if(N($IU)){
var a=['&o=good','','&o=nogood'];
F($('i^strong'),function(o,i){H(o,$IU[i]);H($('^span',$('ri^h4')[i])[0],'('+$IU[i]+')');
J("http://i.v-get.com/j/views?f=3&o="+a[i]+"&t=1",function(){if(N($VIEWS)){var v=$VIEWS;$A('http://wuliu.v-get.com/j/views','3&v0='+v[0]+'&v1='+v[1]+'&v2='+v[2],$("ri^div.a")[i]);}});});
for(var i=0,x=$i($IU[1]/10000);i<5;i++){if(x<Math.pow(10,i)){F($('i^strong'),function(o){o.style.fontSize=(20-i*2)+"px"});break;}}}
})();

/* (function $e(){
l=$4.URL;
function f(u){
F($("^a.e"),function(o){
H(o.parentNode,'<a href="#'+u+'" class="fh" style="font-size:12px" title="'+u+'">'+u+'</a><a href="http://i.v-get.com/e/SignOut.html?lk='+l+'" style="font-size:12px" onclick="javascript:K(\'EU\',0,0);$3.location.href=this.href;return false">退出</a>');
})
}
if(N(K('EU'))){f(K('EU'),l);}
if(!K('EO')){
J("http://i.v-get.com/j/SignBar?r=<?php echo time();?>",function(){
if(N($EU)){f($EU,l);K('EU',$EU,31);}});

}})(); */


F($("^a.e"),function(o){E(o,$7,function(){$E()})});
J("http://weigeti.com/i0/v3/f.js",function(){});
J("http://weigeti.com/i0/l.js",function(){
var t=$('hs').ht,q=$('hn^span.q')[0];
L1(t.value,q);
E(t,'input',function(){L1(this.value,q)});
F($('l2^a'),function(o){
E(o,$7,function(){
if(!N(K('l<?php echo $I;?>'))){
t.value="为了保障评论的可靠性，好评/差评仅对使用过该公司物流服务的用户使用。";
t.style.borderColor="#33B0F5";
$o(function(){t.value="";$o(function(){t.value="为了保障评论的可靠性，好评/差评仅对使用过该公司物流服务的用户使用。";t.style.borderColor="#33B0F5";},300);t.style.borderColor="#ddd";},300);
t.style.color="#f00";
}})})});
</script>
<script type="text/javascript">var cpro_id="u1132441";</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>
</body>
</html>