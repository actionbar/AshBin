<!DOCTYPE HTML>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('v3',$QC);mysql_query('set names utf8');

$sk='广东省 广州市';$key='';

$TO_CITY='';$AND='';


/*--------------------------------------------------------------*/


$Qs='SELECT id.d AS idd,c.c AS cc,c.p AS cp,c.h AS ch,c.v AS cv,c.o AS co,p1.* FROM p1 LEFT JOIN c ON p1.a=c.i LEFT JOIN id on p1.d=id.i WHERE p1.b=330782 ';


 // 目的地身份证前6位
if(isset($_GET['sto'])&&6==strlen($_GET['sto'])){
$D=$_GET['sto'];  $key='&sto='.$D;
//$D%10000就是省
$Dmod=$D%100;

$Qs='(SELECT id.d AS idd,c.c AS cc,c.p AS cp,c.h AS ch,c.v AS cv,c.o AS co,p1.* FROM p1 LEFT JOIN c ON p1.a=c.i LEFT JOIN id on p1.d=id.i WHERE p1.b=330782 AND p1.d>='.$D.' AND p1.d<='.($D+99).') ';

if($Dmod==0)
{
$Qs='SELECT id.d AS idd,c.c AS cc,c.p AS cp,c.h AS ch,c.v AS cv,c.o AS co,p1.* FROM p1 LEFT JOIN c ON p1.a=c.i LEFT JOIN id on p1.d=id.i WHERE p1.b=330782 AND p1.d>='.$D.' AND p1.d<='.($D+99);
}
else
{
$Dcity=$D-$Dmod;
$Qd=mysql_query('SELECT d FROM id WHERE i='.$Dcity.' LIMIT 1',$QC);
$Qda=mysql_fetch_array($Qd);
$TO_CITY=$Qda['d'];
$Qs='(SELECT id.d AS idd,c.c AS cc,c.p AS cp,c.h AS ch,c.v AS cv,c.o AS co,p1.* FROM p1 LEFT JOIN c ON p1.a=c.i LEFT JOIN id on p1.d=id.i WHERE p1.b=330782 AND p1.d='.$D.') UNION (SELECT id.d AS idd,c.c AS cc,c.p AS cp,c.h AS ch,c.v AS cv,c.o AS co,p1.* FROM p1 LEFT JOIN c ON p1.a=c.i LEFT JOIN id on p1.d=id.i WHERE p1.b=330782 AND p1.d>='.$D.' AND p1.d<='.($D+99).')';
$AND='AND p1.d='.$D;
}
}
if(isset($_GET['sk'])){$sk=$_GET['sk'];$key.='&sk='.$sk;}
if(isset($_GET['sco'])){$AND.=' AND p1.a='.$_GET['sco'];$key.='&sco='.$sco;}
if(strlen($key)>2){$key='s?'.substr($key,1);}

$sp=empty($_GET['sp'])?1:$_GET['sp'];$Qp=($sp-1)*10;

//因为包含全国，所以采用 精确度 模糊匹配
//必须要left join id 不然没有 sto的时候，就是空了
$Qs.=' ORDER BY c.o DESC LIMIT 0,13';
$Qsz='SELECT COUNT(*) FROM p1 WHERE p1.b=330782 '.$AND;


$aC=array('全市','稠城街道','江东街道','后宅街道','稠江街道','廿三里镇','北苑城西','上溪义亭','佛堂赤岸','苏溪大陈');

echo '<title>义乌市',$TO_CITY,'托运价格查询_商务物流网_V-Get!</title><meta name="keywords" content="义乌 物流" /><meta name="description" content="义乌物流查询属于商务物流网，提供义乌,义乌查询,查询托运部,搬厂搬家公司,公司搬家,货车出租,长途客运,国际物流,船公司,报关行等货运物流信息查询服务。" />';

?>
<link href="http://localhost/www.v-getimg.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://localhost/www.v-getimg.com/i0/i.css" type="text/css" rel="stylesheet" />
<link href="http://localhost/www.v-getimg.com/i0/s3/ct.css" type="text/css" rel="stylesheet"/>
<link href="http://localhost/www.v-getimg.com/i0/s3/ctmain.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://localhost/www.v-getimg.com/i0/i.js"></script>
</head>
<body>
<div class="wt ph"><div class="w a"><a href="http://yiwu.wuliu.v-get.com/" class="wti" title="返回商务物流网首页"></a><a href="#" id="wt" wtz="[义乌托运]">[义乌托运]</a><a href="http://wuliu.v-get.com/" class="wto">首页</a><a href="#">新闻</a><a href="#">百科</a><form action="http://yiwu.wuliu.v-get.com/tuoyun/" id="ws"><input type="text" placeholder="搜索义乌托运" name="sk" class="wsk"/><input type="submit" value="" class="wss"/></form><div class="p"><a href="#" class="e">登录</a><a href="http://localhost/i.v-get.com/e/SignUp">注册</a></div></div></div>
<div class="w"><div id="wtz">
<h4><span>义乌托运</span><a href="#" class="pr">关闭</a></h4>
<table>
<tr><th colspan="2">切换城市</th><td class="wtzo" wtz="yiwu">义乌</td><td wtz="sh">上海</td></tr>
</table><table>
<tr><th colspan="4">切换类型</th></tr>
<tr><td class="tzo" wtz="tuoyun">托运公司</td><td wtz="cangku">仓库出租</td><td wtz="banjia">搬家公司</td><td wtz="huoche">货车出租</td></tr><tr><td wtz="keyun">客运汽车</td><td wtz="peixun">培训中心</td><td wtz="lianyun">联运中心</td><td wtz="shebei">设备物资</td></tr><tr><td wtz="huodai">货代公司</td><td> </td><td> </td><td> </td></tr>
</table>
</div></div>
<div class="o mt"></div>
<div class="w">
<div class="u">
<div class="i">
<div class="p il"><h1>义乌商务物流网</h1></div>
<div class="p ir"><p>义乌商务物流网</p><p>wuliu.v-get.com</p></div>
<div class="o"></div>
</div>
<div id="au" class="pr"><img src="http://localhost/www.v-get.com/p8/728x90/a.gif"/></div>
</div>

<div id="n" class="a"><a href="http://localhost/yiwu.wuliu.v-get.com/">首页</a><i></i><a href="http://wuliu.v-get.com/news/">新闻</a><i></i><a href="http://wuliu.baike.v-get.com/">百科</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/">托运</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/cangku/">仓库</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/banjia/">搬家</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/huoche/">货车</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/keyun/">客运</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/train/">培训</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/join/">联运</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/shebei/">设备</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/huodai/">货代</a></div>
<div class="o mh"></div>
<div class="g"><div class="p gl"><img src="http://localhost/www.v-getimg.com/i0/v145x43.gif"/></div>
<div class="q gr f fh"><p><a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=北京市">北京</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=广东省">广东</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=浙江省">浙江</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=江苏省">江苏</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=山东省">山东</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=河南省">河南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=四川省">四川</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=福建省">福建</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=安徽省">安徽</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=河北省">河北</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=辽宁省">辽宁</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=吉林省">吉林</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=黑龙江省">黑龙江</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=江西省">江西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=贵州省">贵州</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=新疆">新疆</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=西藏">西藏</a></p><p><a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=上海市">上海</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=天津市">天津</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=重庆市">重庆</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=山西省">山西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=陕西省">陕西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=湖北省">湖北</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=云南省">云南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=广西省">广西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=湖南省">湖南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=海南省">海南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=青海省">青海</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=甘肃省">甘肃</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=内蒙古">内蒙古</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=宁夏">宁夏</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=香港">香港</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=台湾省">台湾</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=澳门">澳门</a></p></div></div>
<div class="o mh"></div>



<div class="w v">
<div class="p l"><div class="f d mb"><div id="d"><ul id="dc"></ul></div><div id="dk"></div><div class="db"></div><div class="df"><div class="p ph dfl"><ul><li><a href="http://wuliu.v-get.com/">义乌商务物流网</a></li><li><a href="http://wuliu.baike.v-get.com/">商务物流百科大全</a></li></ul></div><div id="do" class="q a"><a href="#" class="do">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a></div><div class="o"></div></div></div>

<!------------循环结构--->
<div class="f mb l2">
<ul><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/3.html">义乌市制定全国首个国际货代地方标准</a> </li>
<li>[<a href="http://localhost/yiwu.wuliu.v-get.com/tool/yiwu-tuoyun-price.html" class="f1">托运价格</a>]&nbsp;<a href="http://localhost/yiwu.wuliu.v-get.com/tool/yiwu-tuoyun-price.html#gd">义乌到广州托运多少钱？</a></li>
</ul>
</div>
<div class="f mb l3">
<h4>物流直达</h4>
<ul>
<li><a href="#">国际区号</a>┆<a href="#">各国港口</a>┆<a href="#">托运价格</a></li><li><a href="#">火车运价</a>┆<a href="#">铁路货场</a>┆<a href="#">保价费率</a></li><li><a href="#">车牌查询</a>┆<a href="http://wuliu.v-get.com/143">惠芳物流</a>┆<a href="http://wuliu.v-get.com/151">松盛运输</a></li><li><a href="http://wuliu.v-get.com/318">发发家政</a>┆<a href="http://wuliu.v-get.com/489">义乌搬家</a>┆<a href="http://wuliu.v-get.com/428">物流中心</a></li><li><a href="http://wuliu.v-get.com/495">金茂大厦</a>┆<a href="http://wuliu.v-get.com/507">海关大楼</a>┆<a href="http://wuliu.v-get.com/278">安邦快递</a></li><li><a href="http://wuliu.v-get.com/444">殴递快递</a>┆<a href="http://wuliu.v-get.com/438">汇川快递</a>┆<a href="http://wuliu.v-get.com/439">龙邦快递</a></li><li><a href="http://wuliu.v-get.com/466">恒风货代</a>┆<a href="http://wuliu.v-get.com/477">海平物流</a>┆<a href="http://wuliu.v-get.com/280">德翔国际</a></li><li><a href="http://wuliu.v-get.com/481">东方海运</a>┆<a href="http://wuliu.v-get.com/497">海德国际</a>┆<a href="http://wuliu.v-get.com/704">永达货运</a></li>
</ul>
</div>

<div class="f mb l4">
<h4>网点城市</h4>
<ul class="l3c">
<li>华东地区--<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=江苏">江</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=浙江">浙</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=安徽">皖</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=福建">闽</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=江西">赣</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=山东">鲁</a></li>
<li><a href="http://sh.wuliu.v-get.com/">上海</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=杭州">杭州</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=金华">金华</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=温州">温州</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=宁波">宁波</a></li>
<li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=济南">济南</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=青岛">青岛</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=菏泽">菏泽</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=保定">保定</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=南昌">南昌</a></li>
<li>北方地区--<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=河北">冀</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=山西">晋</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=内蒙古">蒙</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=辽宁">辽</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=吉林">吉</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=黑龙江">黑</a></li>
<li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=北京">北京</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=天津">天津</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=太原">太原</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=呼和浩特">呼市</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=石家庄">石家庄</a></li>
<li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=沈阳">沈阳</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=长春">长春</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=包头">包头</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=大同">大同</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=二连">二连</a></li>
<li>华南地区--<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=广东">粤</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=湖北">鄂</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=湖南">湘</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=河南">豫</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=广西">桂</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=海南">琼</a></li>
<li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=广州">广州</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=深圳">深圳</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=韶关">韶关</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=武汉">武汉</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=襄阳">襄阳</a></li>
<li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=长沙">长沙</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=南昌">南昌</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=南宁">南宁</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=海口">海口</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=柳州">柳州</a></li>
<li>西部--<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=四川">川</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=贵州">贵</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=云南">滇</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=西藏">藏</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=陕西">陕</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=甘肃">甘</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=宁夏">宁</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=青海">青</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=新疆">疆</a></li>
<li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=重庆">重庆</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=西安">西安</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=成都">成都</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=昆明">昆明</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=拉萨">拉萨</a></li>
<li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=兰州">兰州</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=天水">天水</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=银川">银川</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=西宁">西宁</a>┆<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sk=乌鲁木齐">乌市</a></li>
</ul>
</div>

<div class="mb" id="al" a="250x250"></div>

<div class="f mb l5">
<h4>新闻报道</h4>
<div class="v_t">
<dl><dt><a href="http://baike.v-get.com/view/214.html"><img i="http://weigeti.com/p2/3b/482.gif" alt="物流企业如何开发客户？"/></a></dt>
  <dd><h3><a href="http://baike.v-get.com/view/214.html">物流企业如何开发客户？</a></h3><p>物流业竞争日趋激烈，怎么才能“锁定目标、全力出击”,扩大物流市场份额<a href="http://baike.v-get.com/view/214.html">[详细]</a></p></dd>
</dl>
</div>
<ul>
  <li><a href="http://localhost/yiwu.wuliu.v-get.com/huodai/s?sk=国际快递"><span class="f1">国际快递</span></a>：<a href="http://localhost/yiwu.wuliu.v-get.com/huodai/s?sk=邮政小包">全新推出邮政小包便宜到家</a> </li>
  <li><a href="http://localhost/yiwu.wuliu.v-get.com/huodai/s?sk=%E4%BF%9D%E9%99%A9"><span class="f3">物流保险</span></a>：<a href="http://baike.v-get.com/view/19.html">国际货代投责任险获全额赔偿</a></li>
  <li><a href="http://localhost/yiwu.wuliu.v-get.com/huodai/s?sk=货运代理">货运代理</a>：<a href="http://baike.v-get.com/view/192.html">CIF合同货物运输风险承担案</a></li>
  <li><a href="http://localhost/yiwu.wuliu.v-get.com/keyun/"><span class="f6">长途客运</span></a>：<a href="http://baike.v-get.com/view/13.html">江东客运站：儿童可“邮寄”</a></li>
  <li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/"><span class="f2">托运公司</span></a>：<a href="http://baike.v-get.com/view/91.html">航空公司行李托运如何理赔</a></li>
  </ul>
 </div>


<div class="f l6 mb">
<h4>搜索排行榜</h4>
<ul class="l3c">
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B9%BF%E8%A5%BF%E7%9C%81+%E7%8E%89%E6%9E%97%E5%B8%82+%E6%A1%82%E6%9E%97%E5%B8%82">义乌→广西、玉林、桂林龚大姐物流</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%AE%81%E6%B3%A2%E5%B8%82+%E6%85%88%E6%BA%AA%E5%B8%82">义乌→宁波、慈溪</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E6%98%86%E6%98%8E%E5%B8%82">义乌→昆明专线</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E7%A6%8F%E5%B7%9E%E5%B8%82+%E6%BC%B3%E5%B7%9E%E5%B8%82+%E8%8E%86%E7%94%B0%E5%B8%82">义乌→福州、漳州、莆田、龙岩托运</a></li>

<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%8D%97%E9%98%B3%E5%B8%82+%E4%BF%A1%E9%98%B3%E5%B8%82">义乌→南阳、信阳</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%8D%97%E6%98%8C%E5%B8%82">义乌→南昌专线</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B1%B1%E4%B8%9C%E7%9C%81+%E8%8F%8F%E6%B3%BD%E5%B8%82+%E8%81%8A%E5%9F%8E%E5%B8%82">义乌→菏泽、聊城</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E9%81%B5%E4%B9%89%E5%B8%82">义乌→江西遵义</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%AE%89%E5%BE%BD%E7%9C%81+%E9%98%9C%E9%98%B3%E5%B8%82">义乌→阜阳、界首</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B1%B1%E4%B8%9C%E7%9C%81+%E9%82%AF%E9%83%B8%E5%B8%82">义乌→邯郸物流</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E8%8A%9C%E6%B9%96%E5%B8%82+%E9%93%9C%E9%99%B5%E5%B8%82+%E9%A9%AC%E9%9E%8D%E5%B1%B1%E5%B8%82">义乌→芜湖、铜陵、马鞍山、池州市</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E4%BA%91%E5%8D%97%E7%9C%81+%E7%91%9E%E4%B8%BD%E5%B8%82+%E5%A4%A7%E7%90%86%E5%B8%82">义乌→瑞丽、大理</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E6%88%90%E9%83%BD%E5%B8%82">义乌→成都特快</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E9%93%B6%E5%B7%9D%E5%B8%82+%E5%8C%85%E5%A4%B4%E5%B8%82">义乌→包头、银川</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B9%BF%E5%B7%9E%E5%B8%82">义乌→广州物流</a></li>
</ul>
</div>
<div a="250x250"><img src="http://localhost/www.v-get.com/i8/250x250/0.gif"/></div>

 </div>
<div class="p c">
<!--这里有弹出层，所以不能用overflow:hidden-->
<div class="cs">


<?php
//这里td的a，作为热门搜索，是链接，及时更新
echo '<form action="http://localhost/yiwu.wuliu.v-get.com/tuoyun-price/s" id="cs"><input type="hidden" id="scity" value="yiwu"/><input type="hidden" name="sto" value="440100"/>
<div class="p po" id="csc"><input type="text" class="sk" value="',$sk,'" name="sk" readonly="readonly"/><input type="button" class="cscr" id="cscr"/><div class="csd"><h5><span>托运价格</span><a href="#" class="pr">关闭</a></h5><div class="csdn">搜索排行</div><div class="a"><a href="#">链接广告</a><div class="o"></div></div><div class="csdn">城市直达</div><div class="a" id="csa"><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=110000">北京市</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=310000">上海市</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=120000">天津市</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=500000">重庆市</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=340000">安徽省ａ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=350000">福建省ｆ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=620000">甘肃省ｇ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=440000">广东省ｇ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=450000">广西ｇ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=520000">贵州省ｇ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=460000">海南省ｈ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=130000">河北省ｈ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=410000">河南省ｈ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=230000">黑龙江ｈ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=420000">湖北省ｈ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=430000">湖南省ｈ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=220000">吉林省ｊ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=320000">江苏省ｊ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=360000">江西省ｊ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=210000">辽宁省ｌ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=150000">内蒙古ｎ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=640000">宁夏ｎ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=630000">青海省ｑ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=610000">陕西省ｓ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=370000">山东省ｓ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=140000">山西省ｓ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=510000">四川省ｓ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=650000">新疆ｘ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=540000">西藏ｘ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=530000">云南省ｙ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=330000">浙江省ｚ</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=710000">台湾省</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=810000">香港</a><a href="http://yiwu.wuliu.v-get.com/tuoyun-price/?sto=820000">澳门</a><div class="o"></div></div></div></div>

<div class="p sc"></div>

<div class="q"><input type="submit" value="" class="ss" /></div>

</form>';

?>

</div>
<div id="acs" class="fo f">
<img src="http://weigeti.com/p8/468x60/31544.gif"/>
</div>
<div class="c3 f">
<ul>
<li class="c3t">交警提醒：义乌货车限时进城，请货车避开16:30-19:00驶入限货城区</li>
<li>
<?php
$Qk='';
echo '<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=1&sk=',$Qk,'">稠城街道</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=',$Qk,'">江东街道</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=3&sk=',$Qk,'">后宅街道</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=4&sk=',$Qk,'">稠江街道</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=5&sk=',$Qk,'">廿三里镇</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=6&sk=',$Qk,'">北苑城西</a></li><li><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=7&sk=',$Qk,'">上溪义亭</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=8&sk=',$Qk,'">佛堂赤岸</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/s?sc=9&sk=',$Qk,'">苏溪大陈</a>';
?>
<a href="http://localhost/yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html">托运价格</a><a href="http://localhost/yiwu.wuliu.v-get.com/keyun/">客车托运</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/193.html">限货区域</a>
</li>
</ul>
</div>
<!--关注度采用每周，或者每月统计百度的-->
<?php

	 $Qq=mysql_query($Qs,$QC);
	 $Qz=mysql_fetch_array(mysql_query($Qsz,$QC));
	 $Qt=$Qz[0];$Qpz=ceil($Qt/10);

echo '<div class="cct">|&nbsp;&nbsp;义乌市托运价格<span>约',$Qt,'个</span></div><div id="price">';
     while($Qa=mysql_fetch_array($Qq)){
	 $CH=$Qa['ch'];
	 $A=$Qa['a'];


echo '<table><tr><td colspan="2"><h2><a href="http://wuliu.v-get.com/',$A,'" class="h2c">',$CH,'</a><a v="',$Qa['cv'],'"></a><a o="',$Qa['co'],'"></a></h2></td><td colspan="2"><div class="po a"><a href="#">汽车运输 2-3天</a><a href="#" class="pr h2r" b="',$A,'"></a></div></td><tr><tr><td class="mo"><a href="http://wuliu.v-get.com/',$A,'" title="',$CH,'"><img src="http://localhost/www.v-getimg.com/i1/s3/50/',$Qa['cp'],'.gif" alt="',$CH,'"/></a></td><td>从：义乌市 ',$aC[$Qa['cc']],'<br>到：',$TO_CITY,' ',$Qa['idd'],'</td><td class="price3">起步价：',$Qa['o'],'元<br>重货：<strong class="f6">',$Qa['p'],'</strong>/公斤<br>泡货：',$Qa['q'],'/立方</td><td class="mq"><a href="http://wuliu.v-get.com/',$A,'"><img src="http://localhost/www.v-getimg.com/i0/g/qk.gif"/></a></td></tr><tr><td colspan="4"><div class="cz"><p class="f1">正在为您查找',$CH,'的详细信息，请稍等...</p></div></td></tr></table>';

	 }
echo '</div>';
/*--------------------------------------------------------------*/
mysql_close();
if($Qpz>1){
$Qpp=$sp-1;$Qpn=$sp+1;
$Qpq=($Qpp==1)?'':'-'.$Qpp;
switch ($sp)
{ case 1:echo '<div id="p"><a class="po">首页</a><a class="po">前一页&lt;</a>第<span class="pc">1</span>页<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun-price-2/',$key,'" target="_self">&gt;下一页</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun-price-',$Qpz,'/',$key,'" target="_self">共',$Qpz,'页</a></div>';break;
 case $Qpz:echo '<div id="p"><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun-price/',$key,'" target="_self">首页</a><a href="http://localhost/yiwu.wuliu.v-get.com/',$sa,$Qpq,'/',$key,'" target="_self">前一页&lt;</a>第<span class="pc">',$sp,'</span>页<a class="po">&gt;下一页</a><a class="po">第',$sp,'页</a></div>';break;
  default:echo '<div id="p"><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun-price/',$key,'" target="_self">首页</a><a href="http://localhost/yiwu.wuliu.v-get.com/',$sa,$Qpq,'/',$key,'" target="_self">前一页&lt;</a>第<span class="pc">'.$sp.'</span>页<a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun-price-',$Qpn,'/',$key,'" target="_self">&gt;下一页</a><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun-price-',$Qpz,'/',$key,'" target="_self">第',$Qpz,'页</a></div>';break;
}
}


?>
</div>

<div class="q f r fh">


<div class="rw rt mg">
<h4>|<a href="#">物流服务</a></h4><ul class="fo"><li><a href="#">我是企业：我要发布物流信息</a></li><li><a href="#">我是个人：我要申请个人认证</a></ul>


<div class="ar1 f">
<div id="ar1" class="fh"><ul><li><a href="http://wuliu.v-get.com/price/jinhua12306.html">义乌西站铁路货运场查询表</a></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车托运到临沂多少钱</a></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费多少</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li><li><a href="http://wuliu.v-get.com/price/jinhua12306.html">义乌西站铁路货运场查询表</a></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车托运到临沂多少钱</a></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费多少</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li></ul></div>
</div>
</div>

<div class="r2 rw"><h4>|<a href="http://wuliu.v-get.com/news/">物流新闻</a></h4><ul><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/192.html">物流“最后一公里”决定电商</a></li><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/191.html">“双十一”物流快递或取代电</a></li><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/190.html">江苏降低物流成本，促进物流</a></li><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/189.html">申通“撇腿”京东，电商和物</a></li><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/188.html">国际物流企业抢占国内市场，</a></li><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/187.html">南宁力争亚洲最大特色农产品</a></li><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/186.html">广西钦州保税港区欲成中国-</a></li><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/185.html">北京物流动真格，24小时监控</a></li><li><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/184.html">我国物流园空置率为何那么高</a></li></ul>
</div>
<div class="r3 rw mg">
<h4>|<a href="http://i.v-get.com/report/views?f=3">企业展台</a></h4>
<div class="v_t"><dl><dt><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/85.html"><img i="http://weigeti.com/p2/3b/281.gif"></a></dt><dd><h3><a href="hhttp://localhost/wuliu.v-get.com/news/2013-01-01/85.html">国际品牌 邮政速递</a></h3><p>物流“领导”品牌EMS<br>何敌UPS/DHL/TNT<br>国际物流品牌？<a href="http://localhost/wuliu.v-get.com/news/2013-01-01/85.html">[详细]</a></p></dd></dl>
</div>
<div id="ar3" class="ph">
<ul>
<li>
<a href="http://wuliu.v-get.com/1">义乌龚大姐托运→广西专线</a></li><li><a href="http://wuliu.v-get.com/202">义乌广通托运→贵阳、遵义</a> </li><li><a href="http://wuliu.v-get.com/199">义乌鸿航托运→芜湖、合肥</a></li><li><a href="http://wuliu.v-get.com/207">义乌粤发物流→广州、香港</a></li><li><a href="http://wuliu.v-get.com/220">义乌北津二托→北京、天津</a></li><li><a href="http://wuliu.v-get.com/28">义乌唐雅泰托运→唐山周边</a></li><li><a href="http://wuliu.v-get.com/28">义乌郑州托运→郑州、开封</a></li><li><a href="http://wuliu.v-get.com/233">义乌晋都托运→运城、临汾</a></li><li><a href="http://wuliu.v-get.com/179">义乌润东托运→济宁、日照</a></li><li><a href="http://wuliu.v-get.com/145">义乌义襄托运→襄阳、十堰</a></li><li><a href="http://wuliu.v-get.com/9">义乌洪发托运→贵阳、凯里</a></li><li><a href="http://wuliu.v-get.com/23">义乌惠民托运→成都、宜宾</a></li><li><a href="http://wuliu.v-get.com/212">义乌大绿谷物流→无锡专线</a>
</li>
</ul>
</div>
</div>

<div id="arc" class="mg"><img src="http://localhost/www.v-get.com/p8/200x200/a.gif"/></div>

<div class="r4 rw mg">
<h4>|<a href="http://wuliu.baike.v-get.com/">物流百科</a></h4>
<ul><li><a href="http://baike.v-get.com/view/353.html">民营物流快递企业该如何在“</a></li><li><a href="http://baike.v-get.com/view/352.html">江西农民童木根成就年营业额</a></li><li><a href="http://baike.v-get.com/view/351.html">密码箱不翼而飞，申乐物流赔</a></li><li><a href="http://baike.v-get.com/view/350.html">冷链物流应该协作发展</a></li><li><a href="http://baike.v-get.com/view/348.html">中国物流与采购联合会 (Chin</a></li><li><a href="http://baike.v-get.com/view/347.html">中国物流学会 (China Societ</a></li><li><a href="http://baike.v-get.com/view/346.html">物流公司送错地点又损坏货物</a></li><li><a href="http://baike.v-get.com/view/345.html">韩国长锦商船公司 Sinokor M</a></li><li><a href="http://baike.v-get.com/view/344.html">全球主要海运港口航线路线图</a></li></ul>
</div>

<div class="r5">
<form><fieldset><legend>公告栏</legend></fieldset></form>
<div class="r5c"><p>为了更好确保物流信息准确，商务<br>物流网暂停收录未认证用户的物流<br>信息。<a href="#">查看详情&gt;&gt;</a></p>
<p><a href="#">物流企业认证说明</a></p><p><a href="#">物流企业举报处理中心</a></p><p><a href="#">物流帮助</a></p><p><a href="#">广告与合作咨询</a></p><p>欢迎为商务物流网提出宝贵建议。</p><p><a href="#">宝贵建议</a><br><a href="#">专业人士帮助</a></p>
</div>
</div>

</div>

</div>
<div class="o" style="height:9px"></div>
<div class="b">
<p class="f bt">|<a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">营销中心</a>|<a href="#">站点地图</a>|<a href="#">隐私策略</a>|<a href="#">用户协议</a>|<a href="#">法律声明</a>|</p><p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a><a href="http://www.miibeian.gov.cn/" rel="nofollow" style="color:#666">ICP12013909</a> All Right Reserved</p></div>
<div style="display:none">
<script type="text/javascript">

J('http://localhost/www.v-getimg.com/i0/s3/c.js');
J('http://localhost/www.v-getimg.com/i0/s3/p.js');



//这句话如果放到J(function(){})里面就会出问题了！！！背景触发无法变色，所以需要注意



//J('http://localhost/www.v-get.com/i8/a.js');
</script>
</div>
</body></html>
