<!DOCTYPE HTML>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
$QC=mysql_connect("localhost","wla1Ako","vgt1295EN");mysql_select_db("v3",$QC);mysql_query("set names utf8");
$aa=array('tuoyun'=>'托运公司','cangku'=>'仓库厂房出租','banjia'=>'搬家搬厂公司','huoche'=>'货车出租','keyun'=>'客运长途汽车专线','train'=>'培训物流','join'=>'联运物流','shebei'=>'设备物流','huodai'=>'货代公司');
$aA=array('tuoyun'=>1,'cangku'=>2,'banjia'=>3,'huoche'=>4,'keyun'=>5,'train'=>6,'join'=>7,'shebei'=>8,'huodai'=>9);
$sa=$_GET['sa'];$a=$aa[$sa];$A=$aA[$sa];
$sp=empty($_GET['sp'])?1:$_GET['sp'];$Qp=($sp-1)*10;
$Qk='';$key='';
$Qw='a='.$A.' AND b=210'; 
$C=empty($_GET['sc'])?0:(int)$_GET['sc'];
if($C){$Qw='c='.$C.' AND a='.$A.' AND b=210';$key.='&sc='.$C;}
$Qo='o DESC';
$jsk='';
if(empty($_GET['sk'])){
$Qs="SELECT * FROM c WHERE $Qw ORDER BY ".$Qo." LIMIT $Qp,10"; /* 如果没有k,那么sql就是这些 */}
else {
$Qk=$_GET['sk'];
$Qlku=$Qw.' AND kw>0';
if(isset($Qk{7})&&!isset($Qk{46})){
$Qk=preg_replace('/[[:punct:]]/','',$Qk);$Qk=str_replace('021','',$Qk);
$qk=preg_replace('/义乌市?[到|发|至]?/u',' ',$Qk);
$qk=str_replace('物流',' ',$qk);$qk=str_replace('公司',' ',$qk);
$prv=array('/(河北省?)/u','/(山西省?)/u','/(辽宁省?)/u','/(吉林省?)/u','/(黑龙江省?)/u','/(江苏省?)/u','/(浙江省?)/u','/(安徽省?)/u','/(福建省?)/u','/(江西省?)/u','/(山东省?)/u','/(河南省?)/u','/(湖北省?)/u','/(湖南省?)/u','/(广东省?)/u','/(海南省?)/u','/(四川省?)/u','/(贵州省?)/u','/(云南省?)/u','/(陕西省?)/u','/(甘肃省?)/u','/(青海省?)/u');
$qk=preg_replace($prv,' $1 ',$qk);
$qk=str_replace('的',' ',$qk);$qk=str_replace('在',' ',$qk);$qk=str_replace('几区',' ',$qk);
$qk=str_replace('直达',' ',$qk);$qk=str_replace('专线',' ',$qk);
$qk=preg_replace('/[托运|货运][部|站|处]?/u',' ',$qk);
$qk=preg_replace('/^\s+|(?<=(\s))\1+|\s+$/','',$qk);
$aqk=explode(' ',$qk);
$Qlkc='';$Qlke='';
foreach ($aqk as &$QK){$jsk.=','.$QK;$Qlke.='(d LIKE "%'.$QK.'%" OR h LIKE "%'.$QK.'%") AND ';$Qlkc.='OR h LIKE "%'.$QK.'%" OR d LIKE "%'.$QK.'%" ';}
$Qlke.=$Qw;$Qlkc=substr($Qlkc,3);
$Qw.=' AND ('.$Qlkc.')';
$Qlk='('.$Qlkc.')';

$Qs="(SELECT * FROM c WHERE $Qlke) UNION (SELECT * FROM c WHERE $Qw) UNION (SELECT * FROM c WHERE $Qlku) LIMIT $Qp,10";
}
else {$jsk=&$Qk;$Qs="(SELECT * FROM c WHERE (h LIKE '%".$Qk."%' OR d LIKE '%".$Qk."%') AND $Qw) UNION (SELECT * FROM c WHERE $Qlku) LIMIT $Qp,10";$Qw.=" AND (h LIKE '%".$Qk."%' OR d LIKE '%".$Qk."%')";}
$key.='&sk='.$Qk;
}
$Qsz="SELECT COUNT(*) FROM c WHERE $Qw";
$aC=array('','黄埔徐汇','长宁静安','浦东新区','普陀闸北','虹口杨浦','闵行松江','宝山崇明','嘉定青浦','金山奉贤');
$c=$aC[$C];
if(strlen($key)>2){$key='s?'.substr($key,1);}
echo '<title>上海',$c,$Qk,$a,'查询_商务物流网_V-Get!</title><meta name="keywords" content="上海 物流 ',$a,' 上海',$a,' ',$Qk,' ',$c,' ',$c,$Qk,$a,'" /><meta name="description" content="上海物流',$a,'查询属于商务物流网，提供上海',$c,$Qk,$a,',上海',$c,$Qk,$a,'查询,',$c,$a,',查询',$Qk,',托运部,搬厂搬家公司,公司搬家,货车出租,长途客运,国际物流,船公司,报关行等货运物流信息查询服务。" />';
?><link href="http://weigeti.com/p0/favicon.ico" type="image/ico" rel="shortcut icon" />
<link rel="stylesheet" type="text/css" href="http://wuliu.v-get.com/c.css" />
<style type="text/css">.c3{overflow:hidden;height:84px;margin:5px 0;background:#F0FFC4;border-radius:5px;color:#666} 
.c3 li{line-height:28px;height:28px;padding:0 5px} 
.c3 a{padding:0 9px;color:#333;text-decoration:none}
.c3 a:hover{color:#f60}
.c3t{margin:0 9px}
.cc b{background:url(http://weigeti.com/p0/i.png) no-repeat;display:inline-block;cursor:pointer}
.cct{background-position:0 -260px;height:28px;line-height:28px;border-radius:5px;font-size:14px;text-indent:9px;color:#fff;position:relative}
.cct span{font-size:12px;position:absolute;right:9px}
.ct{line-height:28px;border-bottom:#ccc 1px solid;color:#666;position:relative}
.ct a{padding:0 9px;color:#333;text-decoration:none}
.ct a.cto,#ct a:hover{color:#f60}
.cv{padding:5px}
.cl{width:67px;text-align:center;font-size:12px}
.cl img{width:50px;height:50px;padding-top:3px;border-radius:5px}
.cr{width:380px}
h2{margin:5px 0;font-size:14px;font-weight:400;line-height:16px;height:16px;over-flow:hidden}
h2 I{visibility:hidden;}
h2 a{color:#00c;margin-right:3px}
.cc b{visibility:hidden;width:16px;height:14px;}
.cc b{background-position:-75px -75px}
.cc p{line-height:22px}
.cb{color:#008000;height:22px;line-height:22px}
.cb a{margin-left:3px}
.cz{display:none;font-size:12px;padding:3px 9px}
.cz h2{font-size:12px;font-weight:800}
.cz p strong{color:#333}
.cz table{border:#ddd 1px solid;font-size:12px;border-collapse:collapse;text-align:center;width:100%;margin:9px 0}
.cz tr{line-height:22px}
.cz th,td{border-right:1px solid #ddd;border-bottom:1px solid #ddd;padding:3px 5px}
.cz td a{margin:0 5px}
.cz img{max-width:100%}
#p{text-align:right;height:36px;line-height:36px}
#p a{margin:0 5px}
#p .po{color:#999;text-decoration:none}
.pc{font-weight:800;margin:0 3px}
</style>
</head>
<script type="text/javascript" src="http://weigeti.com/p0/c.js"></script>
<body><div class="w u">
<div class="p i"><h1><a href="http://wuliu.v-get.com/">义乌物流查询_商务物流网_V-Get!</a></h1></div>
</div>
<div class="o"></div>
<div id="n"><div class="w"><a href="http://sh.wuliu.v-get.com/">首页</a><a href="http://wuliu.news.v-get.com/">新闻</a><a href="http://wuliu.baike.v-get.com/">百科</a><a href="http://sh.wuliu.v-get.com/tuoyun/">托运</a><a href="http://sh.wuliu.v-get.com/cangku/">仓库</a><a href="http://sh.wuliu.v-get.com/banjia/">搬家</a><a href="http://sh.wuliu.v-get.com/huoche/">货车</a><a href="http://sh.wuliu.v-get.com/keyun/">客运</a><a href="http://sh.wuliu.v-get.com/train/">培训</a><a href="http://sh.wuliu.v-get.com/join/">联运</a><a href="http://sh.wuliu.v-get.com/shebei/">设备</a><a href="http://sh.wuliu.v-get.com/huodai/">货代</a></div></div>
<div id="m"><div class="w"><div class="p"><strong>物流公司黄页</strong><a href="http://www.v-get.com/">V-Get!</a>&gt;<a href="http://wuliu.v-get.com/">商务物流网</a>&gt;<a href="http://yiwu.wuliu.v-get.com/">义乌物流公司</a>&gt; <?php echo $a;?>查询</div><div class="q"><script type="text/javascript">var cpro_id="u1158457";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div></div></div>
<div class="o w v">
<div class="p l"><div class="f d"><div id="d"><ul id="dc"></ul></div><div id="dk"></div><div class="db"></div><div class="df"><a href="http://wuliu.v-get.com/">中国物流第一品牌</a><span id="do"><a href="#" class="do">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a></span></div></div>

<!------------循环结构--->
<div class="f lw">
<ul><li><a href="http://news.v-get.com/view/3.html">义乌市制定全国首个国际货代地方标准</a> </li>
<li>[<a href="http://yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html" class="f1">托运价格</a>]<a href="http://yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html#gd">义乌到广州托运多少钱？</a></li>
</ul>
</div>
<div class="f lw l3">
<h5>物流直达</h5>
<ul>
<?php
$cs='';
for($i=1;$i<count($ca);$i++)
{$cc=$ca[$i];if($i<6){$cc=$cc.substr($a,0,6);}
$cs.='&#9478;<a href="http://yiwu.wuliu.v-get.com/'.$sa.'/s?sc='.$i.'">'.$cc.'</a>';if($i%3==0){echo '<li>',substr($cs,7),'</li>';$cs='';}
}

?>
<li><a href="http://wuliu.v-get.com/help/timezone_tools.html">国际区号</a>┆<a href="http://wuliu.v-get.com/help/ports_tools.html">各国港口</a>┆<a href="http://yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html">托运价格</a></li><li><a href="http://wuliu.v-get.com/price/12306.html">火车运价</a>┆<a href="http://wuliu.v-get.com/help/shhuochang_table.html">铁路货场</a>┆<a href="http://wuliu.v-get.com/price/12306baojia.html">保价费率</a></li><li><a href="http://wuliu.v-get.com/help/chepai_chaxun.html">车牌查询</a>┆<a href="http://wuliu.v-get.com/143">惠芳物流</a>┆<a href="http://wuliu.v-get.com/151">松盛运输</a></li><li><a href="http://wuliu.v-get.com/318">发发家政</a>┆<a href="http://wuliu.v-get.com/489">义乌搬家</a>┆<a href="http://wuliu.v-get.com/428">物流中心</a></li><li><a href="http://wuliu.v-get.com/495">金茂大厦</a>┆<a href="http://wuliu.v-get.com/507">海关大楼</a>┆<a href="http://wuliu.v-get.com/278">安邦快递</a></li><li><a href="http://wuliu.v-get.com/444">殴递快递</a>┆<a href="http://wuliu.v-get.com/438">汇川快递</a>┆<a href="http://wuliu.v-get.com/439">龙邦快递</a></li><li><a href="http://wuliu.v-get.com/466">恒风货代</a>┆<a href="http://wuliu.v-get.com/477">海平物流</a>┆<a href="http://wuliu.v-get.com/280">德翔国际</a></li><li><a href="http://wuliu.v-get.com/481">东方海运</a>┆<a href="http://wuliu.v-get.com/497">海德国际</a>┆<a href="http://wuliu.v-get.com/704">永达货运</a></li>
</ul>
</div>

<div class="f lw">
<h5>网点城市</h5>
<ul class="l3c">
<li>华东地区--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=江苏">江</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=浙江">浙</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=安徽">皖</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=福建">闽</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=江西">赣</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=山东">鲁</a></li>
<li><a href="http://sh.wuliu.v-get.com/">上海</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=杭州">杭州</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=金华">金华</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=温州">温州</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=宁波">宁波</a></li>
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

<div class="lw"><script type="text/javascript">var cpro_id="u1150348";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>

<div class="f lw">
<h5>新闻报道</h5>
<div class="l_t">
<dl><dt><a href="http://baike.v-get.com/view/214.html"><img src="http://weigeti.com/p2/3b/482.gif" alt="物流企业如何开发客户？"/></a></dt>
  <dd><span><a href="http://baike.v-get.com/view/214.html"><strong>物流企业如何开发客户？</strong></a></span><br /><span>物流业竞争日趋激烈，该怎样<br>扩大市场份额<a href="http://baike.v-get.com/view/214.html">[详细]</a></span></dd>
</dl>
</div>
<ul>
  <li><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=国际快递"><span class="f1">国际快递</span></a>：<a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=邮政小包">全新推出邮政小包便宜到家</a> </li>
  <li><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=%E4%BF%9D%E9%99%A9"><span class="f3">物流保险</span></a>：<a href="http://baike.v-get.com/view/19.html">国际货代投责任险获全额赔偿</a></li>
  <li><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=货运代理">货运代理</a>：<a href="http://baike.v-get.com/view/192.html">CIF合同货物运输风险承担案</a></li>
  <li><a href="http://yiwu.wuliu.v-get.com/keyun/"><span class="f6">长途客运</span></a>：<a href="http://baike.v-get.com/view/13.html">江东客运站：儿童可“邮寄”</a></li>
  <li><a href="http://yiwu.wuliu.v-get.com/tuoyun/"><span class="f2">托运公司</span></a>：<a href="http://baike.v-get.com/view/91.html">航空公司行李托运如何理赔</a></li>
  </ul>
 </div>


<div class="f lw">
<h5>搜索排行榜</h5>
<ul class="l3c">
<li><a href="http://wuliu.v-get.com/3">义乌→宁波、慈溪</a>，<a href="http://wuliu.v-get.com/88">义乌→杭州</a></li>
<li><a href="http://wuliu.v-get.com/106">义乌→福州、漳州、莆田、龙岩</a></li>
<li><a href="http://wuliu.v-get.com/2">义乌→南宁、百色、北海、柳州</a></li>
<li><a href="http://wuliu.v-get.com/97">义乌→横川、信阳</a>，<a href="http://wuliu.v-get.com/95">义乌→南昌</a></li>
<li><a href="http://wuliu.v-get.com/85">义乌→菏泽、聊城</a>，<a href="http://wuliu.v-get.com/86">义乌→遵义</a></li>
<li><a href="http://wuliu.v-get.com/82">义乌→阜阳、界首</a>，<a href="http://wuliu.v-get.com/70">义乌→邯郸</a></li>
<li><a href="http://wuliu.v-get.com/71">义乌→芜湖、铜陵、马鞍山、池州</a></li>
<li><a href="http://wuliu.v-get.com/73">义乌→瑞丽、大理</a>，<a href="http://wuliu.v-get.com/74">义乌→成都</a></li>
<li><a href="http://wuliu.v-get.com/53">义乌→包头、银川</a>，<a href="http://wuliu.v-get.com/46">义乌→合肥</a></li>
</ul>
</div>
 </div>
<div class="p c">
<div class="f cs">



<?php

echo '<form action="http://sh.wuliu.v-get.com/',$sa,'/s" onsubmit="sF(this);return false">
<div class="p" id="csc"><input type="text" class="sk" name="sk" placeholder="请直接输入所到城市，多区域用空格隔开" maxlength="15" value="',$Qk,'"/><input type="button" class="cscr" onclick="sC(\'sh.\',',$A,',this.form.sk)"/><div><h5><span>物流搜索</span><a href="javascript:void(0)" onclick="D($(\'z\'));D($(\'csc^div\')[0]);">关闭</a></h5><table><tr><th colspan="5">搜索排行</th></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=国际快递">国际快递</a></td><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=俄罗斯">俄罗斯专线</a></td><td colspan="3"><a href="http://yiwu.wuliu.v-get.com/keyun/">义乌 “宾王客运中心” 长途客车行李托运</a></td></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=合肥">安徽合肥</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=无锡">江苏无锡</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=福州">福建福州</a></td></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广州">广东广州</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=哈尔滨">哈尔滨市</a></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=邮政小包 国际快递">邮政小包</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/cangku/s?sc=1">国际物流中心临时仓库</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=DHL ARAMEX TNT UPS">DHL ARAMEX TNT UPS</a></td></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=五爱">五爱停车场</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=江东货运市场">江东货运市场物流托运</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=1&sk=江北下朱">江北下朱货运市场托运部</a></td></tr></table></div></div><div class="p"><select name="sc"><option value="0"></option><option value="1">黄埔徐汇</option><option value="2">长宁静安</option><option value="3">浦东新区</option><option value="4">普陀闸北</option><option value="5">虹口杨浦</option><option value="6">闵行松江</option><option value="7">宝山崇明</option><option value="8">嘉定青浦</option><option value="9">金山奉贤</option></select></div><div class="q"><input type="submit" value="V-Get!" class="ss" /></div></form>';

?>

</div><script type="text/javascript">var cpro_id="u1141631"</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script><div class="c3"><ul><li class="c3t">交警提醒：义乌货车限时进城，请货车避开16:30-19:00驶入限货城区</li><li>
<?php 
echo '<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=1&sk=',$Qk,'">黄埔徐汇</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=2&sk=',$Qk,'">长宁静安</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=3&sk=',$Qk,'">浦东新区</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=4&sk=',$Qk,'">普陀闸北</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=5&sk=',$Qk,'">虹口杨浦</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=6&sk=',$Qk,'">闵行松江</a></li><li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=7&sk=',$Qk,'">宝山崇明</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=8&sk=',$Qk,'">嘉定青浦</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=9&sk=',$Qk,'">金山奉贤</a>';
?><a href="http://sh.wuliu.v-get.com/price/sh-tuoyun.html">托运价格</a><a href="http://sh.wuliu.v-get.com/keyun/">客车托运</a><a href="http://news.v-get.com/view/193.html">限货区域</a>
</li></ul>
</div>

<?php 
	 $ty=mysql_query($Qs);$tya=mysql_fetch_array(mysql_query($Qsz));$lna=$tya[0];$Qpz=ceil($lna/10);
echo '<div class="f cc"><div class="cct">|&nbsp;&nbsp;上海',$a,'<span>约',$lna,'个</span></div><div class="ct"><a href="#" class="cto">默认</a><a href="#">信用</a><a href="#">保障</a><a href="#">访问量</a><a href="#">公里价格</a><a href="#">公里速度</a></div><div id="c">';		 
     while($tr=mysql_fetch_array($ty)){
	 $i=$tr['i'];
	 $h=$tr['h'];$v=$tr['v'];$bP=$tr['p'];
	
	 
	 echo '<div class="cv">
		 <h2><span class="p"><a href="http://wuliu.v-get.com/',$i,'">',$h,'</a><i v="',$v,'"></i><i o="',$tr['o'],'"></i></span><b class="q" b="',$i,'"></b></h2><div class="o p cl">
		 <a href="http://wuliu.v-get.com/',$i,'"><img src="http://weigeti.com/p2/3i/',$bP,'.gif" alt="',$h,'"></a>
		 </div>
		 <div class="p cr"><p>',$tr['d'],'</p></div>
	 <div class="o cb"><div class="p">wuliu.v-get.com/',$i,'&nbsp;&nbsp;',$tr['t'],'</div><div q="',$tr['q'],'" class="q"></div></div>
	 <div id="cz',$i,'" class="o cz"><p class="f1">正在为您查找<strong>',$h,'</strong>的详细信息，请稍等...</p></div><div class="o"></div></div>';
	 }

echo '</div>';
/*--------------------------------------------------------------*/	
mysql_close(); 

if($Qpz>1){
$Qpp=$sp-1;$Qpn=$sp+1;
$Qpq=($Qpp==1)?'':'-'.$Qpp;
switch ($sp)
{ case 1:echo '<div id="p"><a class="po">首页</a><a class="po">前一页&lt;</a>第<span class="pc">1</span>页<a href="http://sh.wuliu.v-get.com/',$sa,'-2/',$key,'" target="_self">&gt;下一页</a><a href="http://sh.wuliu.v-get.com/',$sa,'-',$Qpz,'/',$key,'" target="_self">共',$Qpz,'页</a></div>';break;
 case $Qpz:echo '<div id="p"><a href="http://sh.wuliu.v-get.com/',$sa,'/',$key,'" target="_self">首页</a><a href="http://sh.wuliu.v-get.com/',$sa,$Qpq,'/',$key,'" target="_self">前一页&lt;</a>第<span class="pc">',$sp,'</span>页<a class="po">&gt;下一页</a><a class="po">第',$sp,'页</a></div>';break;
  default:echo '<div id="p"><a href="http://sh.wuliu.v-get.com/',$sa,'/',$key,'" target="_self">首页</a><a href="http://sh.wuliu.v-get.com/',$sa,$Qpq,'/',$key,'" target="_self">前一页&lt;</a>第<span class="pc">',$sp,'</span>页<a href="http://sh.wuliu.v-get.com/',$sa,'-',$Qpn,'/',$key,'" target="_self">&gt;下一页</a><a href="http://sh.wuliu.v-get.com/',$sa,'-',$Qpz,'/',$key,'" target="_self">第',$Qpz,'页</a></div>';break;
}
}
echo '</div>';

?>
</div>

<div class="q f r">


<div class="rw rt">
<h5>|&nbsp;&nbsp;物流服务</h5>
<ul>
  <li><a href="http://wuliu.v-get.com/help/contact_center.html">我是企业：我要发布物流信息</a></li>
  <li><a href="http://wuliu.v-get.com/help/contact_center.html">我是网友：我要提供好的建议</a></li>
</ul>
<div id="ar1"><ul><li><a href="http://wuliu.v-get.com/help/jhhuochang_table.html">义乌西站铁路货运场查询表</a></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车托运到临沂多少钱</a></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费多少</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li></ul></div></div>
<div class="iu8 rw">
<h5>|&nbsp;&nbsp;<a href="http://wuliu.news.v-get.com/">物流新闻</a></h5>
<ul>
<li><a href="http://news.v-get.com/view/192.html">物流“最后一公里”决定电商</a></li><li><a href="http://news.v-get.com/view/191.html">“双十一”物流快递或取代电</a></li><li><a href="http://news.v-get.com/view/190.html">江苏降低物流成本，促进物流</a></li><li><a href="http://news.v-get.com/view/189.html">申通“撇腿”京东，电商和物</a></li><li><a href="http://news.v-get.com/view/188.html">国际物流企业抢占国内市场，</a></li><li><a href="http://news.v-get.com/view/187.html">南宁力争亚洲最大特色农产品</a></li><li><a href="http://news.v-get.com/view/186.html">广西钦州保税港区欲成中国-</a></li><li><a href="http://news.v-get.com/view/185.html">北京物流动真格，24小时监控</a></li><li><a href="http://news.v-get.com/view/184.html">我国物流园空置率为何那么高</a></li></ul>
</div>
<div class="iu9 rw">
<h5>|&nbsp;&nbsp;企业展台</h5>
<div class="r_t"><dl><dt><a href="http://wuliu.v-get.com/281"><img src="http://weigeti.com/p2/3b/281.gif"></a></dt><dd><span><a href="http://wuliu.v-get.com/281"><strong>中国邮政 速达全球</strong></a></span><br><span>物流巨头央企EMS发展物流利弊该如何评判？</span><a href="http://news.v-get.com/view/85.html">[详细]</a></dd></dl>
</div>
<ul>
<li>
<a href="http://wuliu.v-get.com/1">义乌龚大姐托运→广西专线</a></li><li><a href="http://wuliu.v-get.com/202">义乌广通托运→贵阳、遵义</a> </li><li><a href="http://wuliu.v-get.com/199">义乌鸿航托运→芜湖、合肥</a></li><li><a href="http://wuliu.v-get.com/207">义乌粤发物流→广州、香港</a></li><li><a href="http://wuliu.v-get.com/220">义乌北津二托→北京、天津</a></li><li><a href="http://wuliu.v-get.com/28">义乌唐雅泰托运→唐山周边</a></li><li><a href="http://wuliu.v-get.com/28">义乌郑州托运→郑州、开封</a></li><li><a href="http://wuliu.v-get.com/233">义乌晋都托运→运城、临汾</a></li><li><a href="http://wuliu.v-get.com/179">义乌润东托运→济宁、日照</a></li><li><a href="http://wuliu.v-get.com/145">义乌义襄托运→襄阳、十堰</a></li><li><a href="http://wuliu.v-get.com/9">义乌洪发托运→贵阳、凯里</a></li><li><a href="http://wuliu.v-get.com/23">义乌惠民托运→成都、宜宾</a></li><li><a href="http://wuliu.v-get.com/212">义乌大绿谷物流→无锡专线</a>
</li>

</ul>

</div>
<div class="iu2 rw">
<h5>|&nbsp;&nbsp;<a href="http://wuliu.baike.v-get.com/">物流百科</a></h5>
<ul><li><a href="http://baike.v-get.com/view/353.html">民营物流快递企业该如何在“</a></li><li><a href="http://baike.v-get.com/view/352.html">江西农民童木根成就年营业额</a></li><li><a href="http://baike.v-get.com/view/351.html">密码箱不翼而飞，申乐物流赔</a></li><li><a href="http://baike.v-get.com/view/350.html">冷链物流应该协作发展</a></li><li><a href="http://baike.v-get.com/view/348.html">中国物流与采购联合会 (Chin</a></li><li><a href="http://baike.v-get.com/view/347.html">中国物流学会 (China Societ</a></li><li><a href="http://baike.v-get.com/view/346.html">物流公司送错地点又损坏货物</a></li><li><a href="http://baike.v-get.com/view/345.html">韩国长锦商船公司 Sinokor M</a></li><li><a href="http://baike.v-get.com/view/344.html">全球主要海运港口航线路线图</a></li></ul>
</div>

</div>

</div>
<div class="o" style="height:9px"></div>
<div class="b"><p class="f bt">|<a href="http://wuliu.v-get.com/help/about_center.html">关于我们</a>|<a href="http://wuliu.v-get.com/help/contact_center.html">联系我们</a>|<a href="#">营销中心</a>|<a href="http://wuliu.v-get.com/index_1.html">站点地图</a>|<a href="http://wuliu.v-get.com/help/privacy_center.html">隐私策略</a>|<a href="http://wuliu.v-get.com/help/agree_center.html">用户协议</a>|<a href="http://wuliu.v-get.com/help/law_center.html">法律声明</a>|</p><p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a><a href="http://www.miibeian.gov.cn/" rel="nofollow" style="color:#666">ICP12013909</a> All Right Reserved</p></div>
<div id="z"></div>
<div style="display:none">
<script type="text/javascript">
J('http://wuliu.v-get.com/a.js',function(){cB("#F0FFC4",$("c^div"));cF("sh.");B($('csc^td'),'#DFEDFE','');});
A('','_blank');A('n','_self',3);Q();B($('^input'),'','#000','','#bbb');
<?php
echo 'F($p("',$jsk,'",","),function(k){if(L(k)>0){H($("c"),$r(H($("c")),RegExp("(>[^<]{0,})("+k+")([^>]{0,}<)","ig"),"$1<span class=\"f1\">$2</span>$3"))}});$("n^a")['.($A+2).'].className="no";';?>
var _bdhmProtocol=(("https:"==document.location.protocol)?" https://":" http://");document.write(unescape("%3Cscript src='"+_bdhmProtocol+"hm.baidu.com/h.js%3Fbe4278dfff73bf556fc464c5129ebed0' type='text/javascript'%3E%3C/script%3E"));</script>
</div><script type="text/javascript">var cpro_id="u1132441";</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>
</body></html>
