<!DOCTYPE HTML>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
$Qc=mysql_connect("localhost","wla1Ako","vgt1295EN");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
$aa=array('tuoyun'=>'托运部','cangku'=>'仓库厂房出租','banjia'=>'搬家搬厂公司','huoche'=>'货车出租','keyun'=>'客运长途汽车专线','train'=>'培训物流','join'=>'联运物流','shebei'=>'设备物流','huodai'=>'货代公司');
$aA=array('tuoyun'=>1,'cangku'=>2,'banjia'=>3,'huoche'=>4,'keyun'=>5,'train'=>6,'join'=>7,'shebei'=>8,'huodai'=>9);
$sa=$_GET['sa'];$a=$aa[$sa];$A=$aA[$sa];
$sp=empty($_GET['sp'])?1:$_GET['sp'];$Qp=($sp-1)*10;
$Qk='';$key='';
$Qw='a='.$A.' AND b=330782';
$C=empty($_GET['sc'])?0:(int)$_GET['sc'];
if($C){$Qw='c='.$C.' AND a='.$A.' AND b=330782';$key.='&sc='.$C;}
$Qo='o DESC';
$jsk='';
if(empty($_GET['sk'])){
$Qs="SELECT * FROM c WHERE $Qw ORDER BY ".$Qo." LIMIT $Qp,10";
}
else {
$Qk=$_GET['sk'];
if(isset($Qk{7})&&!isset($Qk{46})){
$Qk=preg_replace('/[[:punct:]]/','',$Qk);
$Qk=str_replace('0579','',$Qk);
$qk=preg_replace('/义乌市?[到|发|至]?/u',' ',$Qk);
$qk=str_replace('物流',' ',$qk);$qk=str_replace('公司',' ',$qk);
$prv=array('/(河北省?)/u','/(山西省?)/u','/(辽宁省?)/u','/(吉林省?)/u','/(黑龙江省?)/u','/(江苏省?)/u','/(浙江省?)/u','/(安徽省?)/u','/(福建省?)/u','/(江西省?)/u','/(山东省?)/u','/(河南省?)/u','/(湖北省?)/u','/(湖南省?)/u','/(广东省?)/u','/(海南省?)/u','/(四川省?)/u','/(贵州省?)/u','/(云南省?)/u','/(陕西省?)/u','/(甘肃省?)/u','/(青海省?)/u');
$qk=preg_replace($prv,' $1 ',$qk);
$qk=str_replace('的',' ',$qk);$qk=str_replace('在',' ',$qk);$qk=str_replace('几区',' ',$qk);
$qk=str_replace('直达',' ',$qk);$qk=str_replace('专线',' ',$qk);
$qk=preg_replace('/[托运|货运][部|站|处]?/u',' ',$qk);
$qk=str_replace('货代','货运代理',$qk);
$qk=preg_replace('/^\s+|(?<=(\s))\1+|\s+$/','',$qk);
$aqk=explode(' ',$qk);
$Qlkc='';$Qlke='';
foreach ($aqk as &$QK){$jsk.=','.$QK;$Qlke.='(d LIKE "%'.$QK.'%" OR h LIKE "%'.$QK.'%") AND ';$Qlkc.='OR h LIKE "%'.$QK.'%" OR d LIKE "%'.$QK.'%" ';}
$Qlke.=$Qw;$Qlkc=substr($Qlkc,3);

$Qw.=' AND ('.$Qlkc.')';
$Qlk='('.$Qlkc.')';
$Qs="(SELECT * FROM c WHERE $Qlke) UNION (SELECT * FROM c WHERE $Qw) LIMIT $Qp,10";
}
else {$jsk=&$Qk;$Qs="SELECT * FROM c WHERE (h LIKE '%".$Qk."%' OR d LIKE '%".$Qk."%') AND $Qw LIMIT $Qp,10";$Qw.=" AND (h LIKE '%".$Qk."%' OR d LIKE '%".$Qk."%')";}
$key.='&sk='.$Qk;
}
$Qsz="SELECT COUNT(*) FROM c WHERE $Qw";
$aC=array('','稠城街道','江东街道','后宅街道','稠江街道','廿三里镇','北苑城西','上溪义亭','佛堂赤岸','苏溪大陈');
$c=$aC[$C];
if(strlen($key)>2){$key='s?'.substr($key,1);}
echo '<title>义乌',$c,$Qk,$a,'查询_商务物流网_V-Get!</title><meta name="keywords" content="义乌 物流 ',$a,' 义乌',$a,' ',$Qk,' ',$c,' ',$c,$Qk,$a,'" /><meta name="description" content="义乌物流',$a,'查询属于商务物流网，提供义乌',$c,$Qk,$a,',义乌',$c,$Qk,$a,'查询,',$c,$a,',查询',$Qk,',托运部,搬厂搬家公司,公司搬家,货车出租,长途客运,国际物流,船公司,报关行等货运物流信息查询服务。" />';
?>
<link href="http://www.v-get.com/www.v-getimg.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://www.v-get.com/www.v-getimg.com/i0/i.css" type="text/css" rel="stylesheet" />
<link href="http://www.v-get.com/www.v-getimg.com/i0/s3/ct.css" type="text/css" rel="stylesheet"/>
<link href="http://www.v-get.com/www.v-getimg.com/i0/s3/ctmain.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://www.v-get.com/www.v-getimg.com/i0/i.js"></script>
</head>
<body>
<div class="wt ph"><div class="w a"><a href="http://yiwu.wuliu.v-get.com/" class="wti" title="返回商务物流网首页"></a><a href="#" id="wt" wtz="[义乌托运]">[义乌托运]</a><a href="http://wuliu.v-get.com/" class="wto">首页</a><a href="http://yiwu.wuliu.v-get.com/news/">新闻</a><a href="#">百科</a><form action="http://yiwu.wuliu.v-get.com/tuoyun/" id="ws"><input type="text" placeholder="搜索义乌托运" name="sk" class="wsk"/><input type="submit" value="" class="wss"/></form><div class="p"><a href="#" class="e">登录</a><a href="http://i.v-get.com/e/SignUp">注册</a></div></div></div>
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
<div id="au" class="pr"><script type="text/javascript">var cpro_id = "u1163355";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
</div>

<div id="n" class="a"><a href="http://yiwu.wuliu.v-get.com/">首页</a><i></i><a href="http://yiwu.wuliu.v-get.com/news/">新闻</a><i></i><a href="http://yiwuwuliu.baike.v-get.com/logistics/index_1.html">百科</a><i></i><a href="http://yiwu.wuliu.v-get.com/tuoyun/">托运</a><i></i><a href="http://yiwu.wuliu.v-get.com/cangku/">仓库</a><i></i><a href="http://yiwu.wuliu.v-get.com/banjia/">搬家</a><i></i><a href="http://yiwu.wuliu.v-get.com/huoche/">货车</a><i></i><a href="http://yiwu.wuliu.v-get.com/keyun/">客运</a><i></i><a href="http://yiwu.wuliu.v-get.com/train/">培训</a><i></i><a href="http://yiwu.wuliu.v-get.com/join/">联运</a><i></i><a href="http://yiwu.wuliu.v-get.com/shebei/">设备</a><i></i><a href="http://yiwu.wuliu.v-get.com/huodai/">货代</a></div>
<div class="o mh"></div>
<div class="g"><div class="p gl"><img src="http://www.v-get.com/www.v-getimg.com/i0/v145x43.gif" alt="物流认证"/></div>
<div class="q gr f fh"><p><a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=北京市">北京</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=广东省">广东</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=浙江省">浙江</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=江苏省">江苏</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=山东省">山东</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=河南省">河南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=四川省">四川</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=福建省">福建</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=安徽省">安徽</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=河北省">河北</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=辽宁省">辽宁</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=吉林省">吉林</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=黑龙江省">黑龙江</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=江西省">江西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=贵州省">贵州</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=新疆">新疆</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=西藏">西藏</a></p><p><a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=上海市">上海</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=天津市">天津</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=重庆市">重庆</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=山西省">山西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=陕西省">陕西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=湖北省">湖北</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=云南省">云南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=广西省">广西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=湖南省">湖南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=海南省">海南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=青海省">青海</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=甘肃省">甘肃</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=内蒙古">内蒙古</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=宁夏">宁夏</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=香港">香港</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=台湾省">台湾</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/?sk=澳门">澳门</a></p></div></div>
<div class="o mh"></div>



<div class="w v">
<div class="p l"><div class="f d mb"><div id="d"><ul id="dc"></ul></div><div id="dk"></div><div class="db"></div><div class="df"><div class="p ph dfl"><ul><li><a href="http://wuliu.v-get.com/">义乌商务物流网</a></li><li><a href="http://wuliu.baike.v-get.com/">商务物流百科大全</a></li></ul></div><div id="do" class="q a"><a href="#" class="do">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a></div><div class="o"></div></div></div>
<div class="f mb l2">
<ul><li><a href="http://wuliu.v-get.com/news/2013-01-01/3.html">义乌市制定全国首个国际货代地方标准</a> </li>
<li>[<a href="http://yiwu.wuliu.v-get.com/tool/yiwu-tuoyun-price.html" class="f1">托运价格</a>]&nbsp;<a href="http://yiwu.wuliu.v-get.com/tool/yiwu-tuoyun-price.html#gd">义乌到广州托运多少钱？</a></li>
</ul>
</div>
<div class="f mb l3">
<h4>物流直达</h4>
<ul>
<li><a href="#">国际区号</a>┆<a href="#">各国港口</a>┆<a href="#">托运价格</a></li><li><a href="#">火车运价</a>┆<a href="#">铁路货场</a>┆<a href="#">保价费率</a></li><li><a href="#">车牌查询</a>┆<a href="http://wuliu.v-get.com/143">惠芳物流</a>┆<a href="http://wuliu.v-get.com/151">松盛运输</a></li><li><a href="http://wuliu.v-get.com/318">发发家政</a>┆<a href="http://wuliu.v-get.com/489">义乌搬家</a>┆<a href="http://wuliu.v-get.com/428">物流中心</a></li><li><a href="http://wuliu.v-get.com/495">金茂大厦</a>┆<a href="http://wuliu.v-get.com/507">海关大楼</a>┆<a href="http://kaibang.wuliu.v-get.com/">凯邦进仓</a></li><li><a href="http://wuliu.v-get.com/444">殴递快递</a>┆<a href="http://wuliu.v-get.com/438">汇川快递</a>┆<a href="http://wuliu.v-get.com/439">龙邦快递</a></li><li><a href="http://wuliu.v-get.com/466">恒风货代</a>┆<a href="http://wuliu.v-get.com/477">海平物流</a>┆<a href="http://wuliu.v-get.com/280">德翔国际</a></li><li><a href="http://wuliu.v-get.com/481">东方海运</a>┆<a href="http://wuliu.v-get.com/497">海德国际</a>┆<a href="http://wuliu.v-get.com/704">永达货运</a></li>
</ul>
</div>

<div class="f mb l4">
<h4>网点城市</h4>
<ul class="l3c">
<li>华东地区--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=江苏">江</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=浙江">浙</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=安徽">皖</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=福建">闽</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=江西">赣</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=山东">鲁</a></li>
<li><a href="http://sh.wuliu.v-get.com/">上海</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=杭州">杭州</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=金华">金华</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=温州">温州</a>┆<a href="http://kaibang.wuliu.v-get.com/">宁波</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=济南">济南</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=青岛">青岛</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=菏泽">菏泽</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=保定">保定</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=南昌">南昌</a></li>
<li>北方地区--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=河北">冀</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=山西">晋</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=内蒙古">蒙</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=辽宁">辽</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=吉林">吉</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=黑龙江">黑</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=北京">北京</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=天津">天津</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=太原">太原</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=呼和浩特">呼市</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=石家庄">石家庄</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=沈阳">沈阳</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=长春">长春</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=包头">包头</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=大同">大同</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=二连">二连</a></li>
<li>华南地区--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广东">粤</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=湖北">鄂</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=湖南">湘</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=河南">豫</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广西">桂</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=海南">琼</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广州">广州</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=深圳">深圳</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=韶关">韶关</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=武汉">武汉</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=襄阳">襄阳</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=长沙">长沙</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=南昌">南昌</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=南宁">南宁</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=海口">海口</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=柳州">柳州</a></li>
<li>西部--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=四川">川</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=贵州">贵</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=云南">滇</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=西藏">藏</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=陕西">陕</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=甘肃">甘</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=宁夏">宁</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=青海">青</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=新疆">疆</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=重庆">重庆</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=西安">西安</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=成都">成都</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=昆明">昆明</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=拉萨">拉萨</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=兰州">兰州</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=天水">天水</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=银川">银川</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=西宁">西宁</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=乌鲁木齐">乌市</a></li>
</ul>
</div>

<div class="mb" id="al"><script type="text/javascript">var sogou_ad_id=150888,sogou_ad_height=250,sogou_ad_width=250;</script><script language='JavaScript' type='text/javascript' src='http://images.sohu.com/cs/jsfile/js/c.js'></script>
</div>

<div class="f mb l5">
<h4>新闻报道</h4>
<div class="v_t">
<dl><dt><a href="http://baike.v-get.com/view/214.html"><img i="http://www.v-get.com/www.v-getimg.com/i8/70x70/482.gif" alt="物流企业如何开发客户？"/></a></dt>
  <dd><h3><a href="http://baike.v-get.com/view/214.html">物流企业如何开发客户？</a></h3><p>物流业竞争日趋激烈，怎么才能“锁定目标、全力出击”,扩大物流市场份额<a href="http://baike.v-get.com/view/214.html">[详细]</a></p></dd>
</dl>
</div>
<ul>
  <li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=0&sk=外贸进仓"><span class="f1">外贸进仓</span></a>：<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=外贸进仓">义乌到宁波外贸进仓便宜到家</a> </li>
  <li><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=%E4%BF%9D%E9%99%A9"><span class="f3">物流保险</span></a>：<a href="http://baike.v-get.com/view/19.html">国际货代投责任险获全额赔偿</a></li>
  <li><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=货运代理">货运代理</a>：<a href="http://baike.v-get.com/view/192.html">CIF合同货物运输风险承担案</a></li>
  <li><a href="http://yiwu.wuliu.v-get.com/keyun/"><span class="f6">长途客运</span></a>：<a href="http://baike.v-get.com/view/13.html">江东客运站：儿童可“邮寄”</a></li>
  <li><a href="http://kaibang.wuliu.v-get.com/"><span class="f2">凯邦物流</span></a>：<a href="http://www.ywwuliu.com/">凯邦外贸进仓货运代理公司</a></li>
  </ul>
 </div>



<div class="mb"><script type="text/javascript">var cpro_id="u1150348";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
<div class="f l6">
<h4>搜索排行榜</h4>
<ul class="l3c">
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B9%BF%E8%A5%BF%E7%9C%81+%E7%8E%89%E6%9E%97%E5%B8%82+%E6%A1%82%E6%9E%97%E5%B8%82">义乌→广西、玉林、桂林龚大姐物流</a></li>
<li><a href="http://kaibang.wuliu.v-get.com/">义乌→上海、宁波外贸进仓</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E7%A6%8F%E5%B7%9E%E5%B8%82+%E6%BC%B3%E5%B7%9E%E5%B8%82+%E8%8E%86%E7%94%B0%E5%B8%82">义乌→福州、漳州、莆田、龙岩托运</a></li>

<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%8D%97%E9%98%B3%E5%B8%82+%E4%BF%A1%E9%98%B3%E5%B8%82">义乌→南阳、信阳</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%8D%97%E6%98%8C%E5%B8%82">义乌→南昌专线</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B1%B1%E4%B8%9C%E7%9C%81+%E8%8F%8F%E6%B3%BD%E5%B8%82+%E8%81%8A%E5%9F%8E%E5%B8%82">义乌→菏泽、聊城</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E9%81%B5%E4%B9%89%E5%B8%82">义乌→江西遵义</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%AE%89%E5%BE%BD%E7%9C%81+%E9%98%9C%E9%98%B3%E5%B8%82">义乌→阜阳、界首</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B1%B1%E4%B8%9C%E7%9C%81+%E9%82%AF%E9%83%B8%E5%B8%82">义乌→邯郸物流</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E8%8A%9C%E6%B9%96%E5%B8%82+%E9%93%9C%E9%99%B5%E5%B8%82+%E9%A9%AC%E9%9E%8D%E5%B1%B1%E5%B8%82">义乌→芜湖、铜陵、马鞍山、池州市</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E4%BA%91%E5%8D%97%E7%9C%81+%E7%91%9E%E4%B8%BD%E5%B8%82+%E5%A4%A7%E7%90%86%E5%B8%82">义乌→瑞丽、大理</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E6%88%90%E9%83%BD%E5%B8%82">义乌→成都特快</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E9%93%B6%E5%B7%9D%E5%B8%82+%E5%8C%85%E5%A4%B4%E5%B8%82">义乌→包头、银川</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B9%BF%E5%B7%9E%E5%B8%82">义乌→广州物流</a></li>
</ul>
</div>

</div>

<div class="p c">
<div class="cs">

<?php

echo '<form action="http://yiwu.wuliu.v-get.com/',$sa,'/s" id="cs"><input type="hidden" id="scity" value="yiwu"/>
<div class="p" id="csc"><input type="text" class="sk" value="',$Qk,'" placeholder="请直接输入所到城市，多区域用空格隔开" name="sk" maxlength="15"/><input type="button" class="cscr" id="cscr"/><div><h5><span>物流搜索</span><a href="#" class="pr">关闭</a></h5><table><tr><th colspan="5">搜索排行</th></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=国际快递">国际快递</a></td><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=俄罗斯">俄罗斯专线</a></td><td colspan="3"><a href="http://yiwu.wuliu.v-get.com/keyun/">义乌 “宾王客运中心” 长途客车行李托运</a></td></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=合肥">安徽合肥</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=无锡">江苏无锡</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=福州">福建福州</a></td></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广州">广东广州</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%A4%96%E8%B4%B8%E8%BF%9B%E4%BB%93">外贸进仓</a></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=邮政小包 国际快递">邮政小包</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/cangku/s?sc=1">国际物流中心临时仓库</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=DHL ARAMEX TNT UPS">DHL ARAMEX TNT UPS</a></td></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=五爱">五爱停车场</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=江东货运市场">江东货运市场物流托运</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=1&sk=江北下朱">江北下朱货运市场托运部</a></td></tr></table></div></div>

<div class="p sc"></div>

<div class="q"><input type="submit" value="" class="ss" /></div>

</form>';

?>

</div>
<div id="acs" class="fo f"><script type="text/javascript">var cpro_id = "u1141631";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
<div class="c3 f">
<ul>
<li class="c3t">交警提醒：义乌货车限时进城，请货车避开16:30-19:00驶入限货城区</li>
<li>
<?php 
echo '<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=1&sk=',$Qk,'">稠城街道</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=',$Qk,'">江东街道</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=3&sk=',$Qk,'">后宅街道</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=4&sk=',$Qk,'">稠江街道</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=5&sk=',$Qk,'">廿三里镇</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=6&sk=',$Qk,'">北苑城西</a></li><li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=7&sk=',$Qk,'">上溪义亭</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=8&sk=',$Qk,'">佛堂赤岸</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=9&sk=',$Qk,'">苏溪大陈</a>';
?>
<a href="http://yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html">托运价格</a><a href="http://yiwu.wuliu.v-get.com/keyun/">客车托运</a><a href="http://wuliu.v-get.com/news/2013-01-01/193.html">限货区域</a>
</li>
</ul>
</div>
<?php 
	 $Qq=mysql_query($Qs);
	 $Qz=mysql_fetch_array(mysql_query($Qsz));
	 $Qt=$Qz[0];$Qpz=ceil($Qt/10);
	
echo '<div class="f cc"><div class="cct">|&nbsp;&nbsp;义乌',$a,'<span>约',$Qt,'个</span></div><div id="c">';	 
	 
     while($Qa=mysql_fetch_array($Qq)){
	 $I=$Qa['i'];$M=$Qa['m'];$bM=(strlen($M)>0)?true:false;
	 $h=$Qa['h'];$v=$Qa['v'];$bP=$Qa['p'];
	 echo '<div class="cv">
		 <h2><a href="http://wuliu.v-get.com/',$I,'" class="h2c">',$h,'</a>';
		 if($bM){echo '<a href="http://',$M,'.wuliu.v-get.com/">[官网]</a>';}
		 echo '<a v="',$v,'"></a><a o="',$Qa['o'],'"></a><a href="#" class="h2r pr" b="',$I,'"></a></h2><div class="o p cl"><a href="';
		 if($bM){echo $M,'.wuliu.v-get.com"><img src="http://www.v-get.com/www.v-getimg.com/i1/s3/50/',$M,'.gif" alt="',$h,'';}
		 else {echo 'wuliu.v-get.com/',$I,'"><img src="http://www.v-get.com/www.v-getimg.com/i1/s3/50/',$bP,'.gif" alt="',$h,'';}
		 echo '"></a>
		 </div>
		 <div class="p cr"><p>',$Qa['d'],'</p></div>
	 <div class="o cb"><div class="p">wuliu.v-get.com/',$I,'&nbsp;&nbsp;',$Qa['t'],'</div><div q="';
	  if($bM){echo 'W',$M,'.wuliu.v-get.com^';}
	 echo $Qa['q'],'^Dwuliu.v-get.com/',$I,'map" class="q"></div></div>
	 <div class="o cz"><p class="f1">正在为您查找',$h,'的详细信息，请稍等...</p></div><div class="o"></div></div>';
	 }
echo '</div>';
mysql_close();
if($Qpz>1){
$Qpp=$sp-1;$Qpn=$sp+1;
$Qpq=($Qpp==1)?'':'-'.$Qpp;
switch ($sp)
{ case 1:echo '<div id="p"><a class="po">首页</a><a class="po">前一页&lt;</a>第<span class="pc">1</span>页<a href="http://yiwu.wuliu.v-get.com/',$sa,'-2/',$key,'" target="_self">&gt;下一页</a><a href="http://yiwu.wuliu.v-get.com/',$sa,'-',$Qpz,'/',$key,'" target="_self">共',$Qpz,'页</a></div>';break;
 case $Qpz:echo '<div id="p"><a href="http://yiwu.wuliu.v-get.com/',$sa,'/',$key,'" target="_self">首页</a><a href="http://yiwu.wuliu.v-get.com/',$sa,$Qpq,'/',$key,'" target="_self">前一页&lt;</a>第<span class="pc">',$sp,'</span>页<a class="po">&gt;下一页</a><a class="po">第',$sp,'页</a></div>';break;
  default:echo '<div id="p"><a href="http://yiwu.wuliu.v-get.com/',$sa,'/',$key,'" target="_self">首页</a><a href="http://yiwu.wuliu.v-get.com/',$sa,$Qpq,'/',$key,'" target="_self">前一页&lt;</a>第<span class="pc">'.$sp.'</span>页<a href="http://yiwu.wuliu.v-get.com/',$sa,'-',$Qpn,'/',$key,'" target="_self">&gt;下一页</a><a href="http://yiwu.wuliu.v-get.com/',$sa,'-',$Qpz,'/',$key,'" target="_self">第',$Qpz,'页</a></div>';break;
}
}
echo '</div>';

?>
</div>

<div class="q f r fh">


<div class="rw rt mg">
<h4>|<a href="#">物流服务</a></h4><ul class="fo"><li><a href="#">我是企业：我要发布物流信息</a></li><li><a href="#">我是个人：我要申请个人认证</a></ul>
  

<div class="ar1 f">
<div id="ar1" class="fh"><ul><li><a href="http://wuliu.v-get.com/price/jinhua12306.html">义乌西站铁路货运场查询表</a></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车托运到临沂多少钱</a></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费多少</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li><li><a href="http://wuliu.v-get.com/price/jinhua12306.html">义乌西站铁路货运场查询表</a></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车托运到临沂多少钱</a></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费多少</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li></ul></div>
</div>
</div>

<div class="r2 rw"><h4>|<a href="http://yiwu.wuliu.v-get.com/news/">义乌物流</a></h4><ul><?php
$Qqn=mysql_query('SELECT t,i,h FROM news WHERE b=330782 ORDER BY t DESC LIMIT 9',$Qc);
while($Qan=mysql_fetch_array($Qqn)){
$Tn=$Qan['t'];$tn=strtotime($Tn);$DTn=date('Y-m-d',$tn);$Hn=$Qan['h'];
echo '<li><a href="http://wuliu.v-get.com/news/',$DTn,'/',$Qa['i'],'.html" title="',$Hn,'">',$Hn,'</a></li>';
}
?></ul>
</div>
<div class="r3 rw mg">
<h4>|<a href="http://i.v-get.com/report/views?f=3">企业展台</a></h4>
<div class="v_t"><dl><dt><a href="http://wuliu.v-get.com/news/2013-01-01/85.html"><img i="http://www.v-get.com/www.v-getimg.com/i8/70x70/281.gif" alt="中国邮政速递"></a></dt><dd><h3><a href="hhttp://wuliu.v-get.com/news/2013-01-01/85.html">国际品牌 邮政速递</a></h3><p>物流“领导”品牌EMS<br>何敌UPS/DHL/TNT<br>国际物流品牌？<a href="http://wuliu.v-get.com/news/2013-01-01/85.html">[详细]</a></p></dd></dl>
</div>
<div id="ar3" class="ph">
<ul>
<li>
<a href="http://wuliu.v-get.com/1">义乌龚大姐托运→广西专线</a></li><li><a href="http://kaibang.wuliu.v-get.com/">义乌凯邦物流→上海、宁波</a></li><li><a href="http://wuliu.v-get.com/199">义乌鸿航托运→芜湖、合肥</a></li><li><a href="http://wuliu.v-get.com/207">义乌粤发物流→广州、香港</a></li><li><a href="http://wuliu.v-get.com/220">义乌北津二托→北京、天津</a></li><li><a href="http://wuliu.v-get.com/28">义乌唐雅泰托运→唐山周边</a></li><li><a href="http://wuliu.v-get.com/28">义乌郑州托运→郑州、开封</a></li><li><a href="http://wuliu.v-get.com/233">义乌晋都托运→运城、临汾</a></li><li><a href="http://wuliu.v-get.com/179">义乌润东托运→济宁、日照</a></li><li><a href="http://wuliu.v-get.com/145">义乌义襄托运→襄阳、十堰</a></li><li><a href="http://wuliu.v-get.com/9">义乌洪发托运→贵阳、凯里</a></li><li><a href="http://wuliu.v-get.com/23">义乌惠民托运→成都、宜宾</a></li><li><a href="http://wuliu.v-get.com/212">义乌大绿谷物流→无锡专线</a>
</li>
</ul>
</div>
</div>
<div class="mg"><script type="text/javascript">var sogou_ad_id=149961,sogou_ad_height=200,sogou_ad_width=200;</script><script language='JavaScript' type='text/javascript' src='http://images.sohu.com/cs/jsfile/js/c.js'></script>
</div>


<div class="r4 rw mg">
<h4>|<a href="http://wuliu.baike.v-get.com/">物流百科</a></h4>
<ul><li><a href="http://baike.v-get.com/view/353.html">民营物流快递企业该如何在“</a></li><li><a href="http://baike.v-get.com/view/352.html">江西农民童木根成就年营业额</a></li><li><a href="http://baike.v-get.com/view/351.html">密码箱不翼而飞，申乐物流赔</a></li><li><a href="http://baike.v-get.com/view/350.html">冷链物流应该协作发展</a></li><li><a href="http://baike.v-get.com/view/348.html">中国物流与采购联合会 (Chin</a></li><li><a href="http://baike.v-get.com/view/347.html">中国物流学会 (China Societ</a></li><li><a href="http://baike.v-get.com/view/346.html">物流公司送错地点又损坏货物</a></li><li><a href="http://baike.v-get.com/view/345.html">韩国长锦商船公司 Sinokor M</a></li><li><a href="http://baike.v-get.com/view/344.html">全球主要海运港口航线路线图</a></li><li><a href="http://baike.v-get.com/view/351.html">密码箱不翼而飞，申乐物流赔</a></li></ul>
</div>
<div class="mg"><script type="text/javascript">var sogou_ad_id=149961,sogou_ad_height=200,sogou_ad_width=200;</script><script language='JavaScript' type='text/javascript' src='http://images.sohu.com/cs/jsfile/js/c.js'></script></div>

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
J('http://www.v-get.com/www.v-getimg.com/i0/s3/c.js');
J('http://www.v-get.com/www.v-getimg.com/i0/s3/a.js');
function cK(s,n){F($p(s,","),function(k){if(T(k)){H($("c"),$r(H($("c")),RegExp("(>[^<]{0,})("+k+")([^>]{0,}<)","ig"),"$1<span class=\"f0\">$2</span>$3"))}});C($("n^a")[n],"no")}
cK(<?php echo '"',$jsk,'",',$A+2;?>);
</script>
<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fe0a8998d85ee8ddd24d2c38e4f5c9032' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
<script type="text/javascript">var cpro_id="u1132441";</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>

</body></html>
