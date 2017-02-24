<!DOCTYPE>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
$cn=mysql_connect("localhost","root","qwdw114");mysql_select_db("v3",$cn);mysql_query("set names utf8"); 
$sa=$_GET['sa'];
$aa=array('tuoyun'=>'物流公司','cangku'=>'仓库厂房出租','banjia'=>'搬家搬厂公司','huoche'=>'货车出租','keyun'=>'客运长途汽车专线','train'=>'培训物流','join'=>'联运物流','shebei'=>'设备物流','huodai'=>'货代公司');
$ca=array('','黄埔徐汇','长宁静安','浦东','普陀闸北','虹口杨浦','闵行松江','宝山崇明','嘉定青浦','金山奉贤');
$aA=array('tuoyun'=>1,'cangku'=>2,'banjia'=>3,'huoche'=>4,'keyun'=>5,'train'=>6,'join'=>7,'shebei'=>8,'huodai'=>9);
$a=$aa[$sa];
$A=$aA[$sa];
$where='(a='.$A.' AND (b=310000 OR b=0))'; 
$C=0;$K='';$key='';
$sp=empty($_GET['sp'])?1:$_GET['sp'];$P=($sp-1)*10;
if(!empty($_GET['sc'])){$C=$_GET['sc'];$where='(c='.$C.' AND a='.$A.' AND b=310000)';$key='s?sc='.$C.'&sk=';}
$c=$ca[$C];
$sql="SELECT * FROM c WHERE $where ORDER BY o DESC LIMIT $P,10"; /* 如果没有k,那么sql就是这些 */
$sql_All="SELECT COUNT(*) FROM c WHERE $where";

if(!empty($_GET['sk'])){$K=$_GET['sk'];$where.=' AND (h LIKE "%'.$K.'%" OR d LIKE "%'.$K.'%" OR d LIKE "%全国%")';
$key='s?sc='.$C.'&sk='.$K;
$sql="SELECT *,(h like '%$K%' OR d LIKE '%$K%') AS OD FROM c WHERE $where ORDER BY OD DESC,o DESC LIMIT $P,10"; 
$sql_All="SELECT COUNT(*) FROM c WHERE $where";
};	
echo '<title>上海'.$c.$K.$a.'查询_商务物流网_V-Get!</title><meta name="keywords" content="上海,物流,'.$a.',上海'.$a.','.$K.',上海到'.$K.$a.',物流查询,'.$c.'" /><meta name="description" content="上海物流'.$a.'查询隶属于商务物流网，内容涉及上海-'.$K.$a.',上海'.$K.$a.'查询,托运部,搬家搬厂公司,公司搬家,货车出租,长途客运,国际物流,船公司,报关行等货运物流信息查询。" />';
?><link href="http://weigeti.com/p0/favicon.ico" type="image/ico" rel="shortcut icon" /><link rel="stylesheet" type="text/css" href="http://wuliu.v-get.com/c.css" />
<style type="text/css">.cc b{background:url(http://weigeti.com/p0/i.png) no-repeat;display:inline-block;cursor:pointer}
#m2{overflow:hidden;height:84px;margin:0 0 9px;background:#F0FFC4;border-radius:5px} 
#m2 li{line-height:28px;height:28px;padding:0 5px} 
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
<body>
<div class="t">
<div class="tc">
<div class="p"><a href="http://www.v-get.com/"><strong>V-Get!</strong></a><a href="http://news.v-get.com/">新闻</a>-<a href="http://baike.v-get.com/">百科</a></div>
</div>
</div>
<div class="w">


<div class="u"><div class="p i"><a href="http://wuliu.v-get.com/"><img i="http://weigeti.com/p2/3yiwu.gif" src="义乌物流网_V-Get!" height="70" width="160" /></a></div><div class="q g"><div><ul><li><a href="http://news.v-get.com/">新闻</a><a href="http://tv.cntv.cn/live/cctv13/" rel="nofollow">联播</a><a href="http://news.ifeng.com/mil/" rel="nofollow">军事</a><a href="http://news.sina.com.cn/society/" rel="nofollow">社会</a><a href="http://tv.cntv.cn/live/cctv5/" rel="nofollow">体育</a><a href="http://www.12306.cn/" rel="nofollow">火车票</a></li>
<li><a href="http://www.taobao.com/" rel="nofollow">淘宝</a><a href="http://www.360buy.com/" rel="nofollow">京东</a><a href="http://www.dangdang.com/" rel="nofollow">当当</a><a href="http://www.zhuoyue.com/" rel="nofollow">卓越</a><a href="http://www.vancl.com/" rel="nofollow">凡客</a><a href="http://www.amazon.cn/" rel="nofollow">亚马逊</a></li><li><a href="http://astro.lady.qq.com/" rel="nofollow">星座</a><a href="http://www.readnovel.com/" rel="nofollow">小说</a><a href="http://www.52tian.net/" rel="nofollow">动漫</a><a href="http://www.997788.com/" rel="nofollow">收藏</a><a href="http://yiwu.wuliu.v-get.com/">义乌</a><a href="http://sh.wuliu.v-get.com/m/sh.html">手机版</a></li>
</ul><ul><li><a href="http://tv.cntv.cn/live/cctv2/" rel="nofollow">财经</a><a href="http://tv.cntv.cn/live/cctv10/" rel="nofollow">科技</a><a href="http://tv.cntv.cn/live/cctv7/" rel="nofollow">农业</a><a href="http://flight.qunar.com/" rel="nofollow">飞机票</a><a href="http://baike.v-get.com/">百科</a><a href="http://www.elong.com/" rel="nofollow">酒店</a></li>
<li><a href="https://www.alipay.com/" rel="nofollow">支付宝</a><a href="http://www.ccb.com/" rel="nofollow">建行</a><a href="http://www.abchina.com/" rel="nofollow">农行</a><a href="http://www.icbc.com.cn/" rel="nofollow">工行</a><a href="http://www.cmbchina.com/" rel="nofollow">招商</a><a href="http://www.boc.cn/" rel="nofollow">中行</a></li>
<li><a href="http://detail.zol.com.cn/notebook_index/subcate16_list_1.html" rel="nofollow">电脑</a><a href="http://detail.zol.com.cn/digital_camera_index/subcate15_list_1.html" rel="nofollow">数码</a><a href="http://detail.zol.com.cn/cell_phone_index/subcate57_list_1.html" rel="nofollow">手机</a><a href="http://www.cncn.com/" rel="nofollow">旅游</a><a href="http://www.500wan.com/" rel="nofollow">彩票</a><a href="http://www.4399.com/" rel="nofollow">小游戏</a></li></ul></div><div class="o gb"><strong>热区</strong><!--@ub--><a href="http://sh.wuliu.v-get.com/huodai/s?sc=0&sk=上海港">上海港</a><a href="http://sh.wuliu.v-get.com/huodai/s?sc=0&sk=海运">海运</a><a href="http://sh.wuliu.v-get.com/huodai/s?sc=0&sk=代理订舱">代理订舱</a><a href="http://sh.wuliu.v-get.com/huodai/s?sc=0&sk=植检">植检</a><a href="http://sh.wuliu.v-get.com/huoche/s?sc=0&sk=江东">江东货车出租</a><a href="http://sh.wuliu.v-get.com/huoche/s?sc=0&sk=江东">江东货车出租</a><a href="http://sh.wuliu.v-get.com/banjia/s?sc=0&sk=长途货运">长途货运</a><a href="http://sh.wuliu.v-get.com/cangku/s?sc=0&sk=内陆口岸">内陆口岸仓库</a><a href="http://sh.wuliu.v-get.com/keyun/s?sc=0&sk=安徽">上海到安徽长途汽车</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=株洲">上海到株洲托运</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=南阳">上海到南阳托运</a><!--@ub--></div></div></div>
<div id="an">
<div class="p"><script type="text/javascript">netease_union_user_id=6208393;netease_union_site_id=55963;netease_union_worktype=27;netease_union_promote_type=3;netease_union_width=728;netease_union_height=90;netease_union_link_id=1437;
</script><script type="text/javascript" src="http://union.netease.com/sys_js/display.js"></script></div>
<div class="q">
<ul><!--@an--><li><a href="http://news.v-get.com/view/183.html">2013年上海国际危化品供应链与物流</a></li><li><a href="http://news.v-get.com/view/181.html">上海举行“关检合作促进外贸稳定增</a></li><li><a href="http://news.v-get.com/view/177.html" style="color:#f00">2012亚洲国际动力传动与控制技术展</a></li><li><a href="http://news.v-get.com/view/113.html">上海外高桥保税区引领现代物流分拨</a></li><!--@an--></ul></div></div>

<div id="n"><div class="p"><a href="http://sh.wuliu.v-get.com/">首页</a><a href="http://sh.wuliu.v-get.com/news/154-0-0/index_1.html">新闻</a><a href="http://sh.wuliu.v-get.com/baike/154-0-0/index_1.html">百科</a><a href="http://sh.wuliu.v-get.com/tuoyun/">托运</a><a href="http://sh.wuliu.v-get.com/cangku/">仓库</a><a href="http://sh.wuliu.v-get.com/banjia/">搬家</a><a href="http://sh.wuliu.v-get.com/huoche/">货车</a><a href="http://sh.wuliu.v-get.com/keyun/">客运</a><a href="http://sh.wuliu.v-get.com/train/">培训</a><a href="http://sh.wuliu.v-get.com/join/">联运</a><a href="http://sh.wuliu.v-get.com/shebei/">设备</a><a href="http://sh.wuliu.v-get.com/huodai/">货代</a></div><div class="q ns"><form class="q ns" action="http://www.google.com/search" target="_blank"><input type="hidden" name="hl" value="zh-CN" /><input name="domains" type="hidden" value="v-get.com" /><input type="hidden" name="sitesearch" value="v-get.com" /><input type="hidden" name="ie" value="utf-8" /><input type="text" name="q" class="nsk" /><input type="image" class="nss" src="http://weigeti.com/p0/nss.png" /></form></div></div><div class="v"><div class="p l"><div class="f d"><div id="d"><ul id="dc"></ul></div><div id="dk"></div><div class="db"></div><div class="df"><a href="http://wuliu.v-get.com/">中国物流第一品牌</a><span id="do"><a href="#" class="do">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a></span></div></div><div class="f lw"><ul><!--@ld--><li><a href="http://news.v-get.com/view/171.html">中国物流学会会长撰文敦促物流企业创新</a></li><!--@ld--><li>[<a href="http://sh.wuliu.v-get.com/price/sh-tuoyun.html" class="f1">托运价格</a>]<a href="http://sh.wuliu.v-get.com/price/sh-tuoyun.html#z">上海到杭州托运需要多少钱？</a></li></ul></div><div class="f lw l3"><h5>物流直达</h5><ul>
<?php
$cs='';for($i=1;$i<count($ca);$i++)
{$cc=$ca[$i];if($i==3){$cc=$cc.substr($a,0,6);}
$cs.='&#9478;<a href="http://sh.wuliu.v-get.com/'.$sa.'/s?sc='.$i.'">'.$cc.'</a>';if($i%3==0){echo '<li>'.substr($cs,7).'</li>';$cs='';}}
?><li><a href="http://wuliu.v-get.com/baike/countrycode.html">国际区号</a>┆<a href="http://wuliu.v-get.com/line/ports.html">各国港口</a>┆<a href="http://sh.wuliu.v-get.com/price/sh-tuoyun.html">托运价格</a></li><li><a href="http://wuliu.v-get.com/730">海顺国际</a>┆<a href="http://wuliu.v-get.com/706">环航国际</a>┆<a href="http://wuliu.v-get.com/729">格勒储运</a></li><li><a href="http://wuliu.v-get.com/737">冠申货运</a>┆<a href="http://wuliu.v-get.com/714">铭顺物流</a>┆<a href="http://wuliu.v-get.com/738">中铁快运</a></li><li><a href="http://wuliu.v-get.com/761">华宜物流</a>┆<a href="http://wuliu.v-get.com/735">大众搬家</a>┆<a href="http://wuliu.v-get.com/731">长远搬家</a></li><li><a href="http://wuliu.v-get.com/705">香港物流</a>┆<a href="http://wuliu.v-get.com/753">贵祥物流</a>┆<a href="http://wuliu.v-get.com/724">安新托运</a></li><li><a href="http://wuliu.v-get.com/414">文昌物流</a>┆<a href="http://wuliu.v-get.com/721">友存托运</a>┆<a href="http://wuliu.v-get.com/717">高燕物流</a></li><li><a href="http://wuliu.v-get.com/708">悦汝货运</a>┆<a href="http://wuliu.v-get.com/728">龙圣托运</a>┆<a href="http://wuliu.v-get.com/768">迅凯托运</a></li><li><a href="http://wuliu.v-get.com/744">祥顺运输</a>┆<a href="http://wuliu.v-get.com/733">亮敏物流</a>┆<a href="http://wuliu.v-get.com/736">柏氏专线</a></li></ul></div><div class="f lw"><h5>网点城市</h5><ul class="l3c"><li>华东地区--<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=江苏">江</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=浙江">浙</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=安徽">皖</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=福建">闽</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=江西">赣</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=山东">鲁</a></li><li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=上海">上海</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=杭州">杭州</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=金华">金华</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=温州">温州</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=宁波">宁波</a></li><li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=济南">济南</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=青岛">青岛</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=菏泽">菏泽</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=保定">保定</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=南昌">南昌</a></li><li>北方地区--<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=河北">冀</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=山西">晋</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=内蒙古">蒙</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=辽宁">辽</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=吉林">吉</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=黑龙江">黑</a></li><li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=北京">北京</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=天津">天津</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=太原">太原</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=呼和浩特">呼市</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=石家庄">石家庄</a></li><li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=沈阳">沈阳</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=长春">长春</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=包头">包头</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=大同">大同</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=二连">二连</a></li><li>华南地区--<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=广东">粤</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=湖北">鄂</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=湖南">湘</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=河南">豫</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=广西">桂</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=海南">琼</a></li><li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=广州">广州</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=深圳">深圳</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=韶关">韶关</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=武汉">武汉</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=襄阳">襄阳</a></li><li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=长沙">长沙</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=南昌">南昌</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=南宁">南宁</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=海口">海口</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=柳州">柳州</a></li><li>西部--<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=四川">川</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=贵州">贵</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=云南">滇</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=西藏">藏</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=陕西">陕</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=甘肃">甘</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=宁夏">宁</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=青海">青</a><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=新疆">疆</a></li><li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=重庆">重庆</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=西安">西安</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=成都">成都</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=昆明">昆明</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=拉萨">拉萨</a></li>
<li><a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=兰州">兰州</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=天水">天水</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=银川">银川</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=西宁">西宁</a>┆<a href="http://sh.wuliu.v-get.com/tuoyun/s?sc=0&sk=乌鲁木齐">乌市</a></li>
</ul>
</div>

<div class="f li" id="al1"><script type="text/javascript">alimama_pid="mm_32477935_3326590_10951253";alimama_width=250;alimama_height=250</script><script src="http://a.alimama.cn/inf.js" type="text/javascript"></script></div>

<div class="f lw">
<h5>新闻报道</h5>
<div class="l_t">
<dl><dt><a href="http://baike.v-get.com/view/214.html"><img i="http://weigeti.com/p2/3b/482.gif" alt="物流企业该怎么开发客户呢？"/></a></dt>
  <dd><span><a href="http://baike.v-get.com/view/214.html"><strong>物流企业该怎么开发客户呢？</strong></a></span><br /><span>物流业竞争日趋激烈，又该如何扩大企业的市场份额<a href="http://baike.v-get.com/view/214.html">[详细]</a></span></dd>
</dl>
</div>
<ul>
  <li><a href="http://sh.wuliu.v-get.com/huodai/s?sc=0&sk=国际快递"><span class="f1">国际快递</span></a>：<a href="http://sh.wuliu.v-get.com/huodai/s?sc=0&sk=邮政小包">全新推出邮政小包便宜到家</a> </li>
  <li><a href="http://sh.wuliu.v-get.com/huodai/s?sc=0&sk=%E4%BF%9D%E9%99%A9"><span class="f3">物流保险</span></a>：<a href="http://baike.v-get.com/view/19.html">国际货代投责任险获全额赔偿</a></li>
  <li><a href="http://sh.wuliu.v-get.com/huodai/s?sc=0&sk=货运代理">货运代理</a>：<a href="http://baike.v-get.com/view/192.html">CIF合同货物运输风险承担案</a></li>
  <li><a href="http://sh.wuliu.v-get.com/keyun/"><span class="f6">长途客运</span></a>：<a href="http://baike.v-get.com/view/13.html">江东客运站：儿童可“邮寄”</a></li>
  <li><a href="http://sh.wuliu.v-get.com/tuoyun/"><span class="f2">托运公司</span></a>：<a href="http://baike.v-get.com/view/91.html">航空公司行李托运如何理赔</a></li>
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

echo '<form onsubmit="sF(\'sh\',\'上海\',this);return false" action="http://sh.wuliu.v-get.com/'.$sa.'/s" method="get" id="s">
<select name="sa"><option value="tuoyun">托运</option><option value="cangku">仓库</option><option value="banjia">搬家</option><option value="huoche">货车</option><option value="keyun">客运</option><option value="train">培训</option><option value="join">联运</option><option value="shebei">设备</option><option value="huodai">货代</option></select>
<input type="text" class="sk" value="'.$K.'" onmouseover="this.focus();this.select()"  name="sk"/>
<select name="sc"><option value="0"></option><option value="1">黄埔徐汇</option><option value="2">长宁静安</option><option value="3">浦东</option><option value="4">普陀闸北</option><option value="5">虹口杨浦</option><option value="6">闵行松江</option><option value="7">宝山崇明</option><option value="8">嘉定青浦</option><option value="9">金山奉贤</option></select>
<input type="submit" value="" class="ss" />
</form>';

?>

</div>

<div class="ci" id="ac"><img i="http://weigeti.com/p8/468x60/31544.gif"/></div>
<div id="m2">
<ul id="m2o">
<li>1. 如果联系物流服务时，请说您是从<a href="http://wuliu.v-get.com/">商务物流网</a>上看到的，谢谢！</li>
<li>2. 下午16:00-19:00货车禁入城区，货车或托运请避开这个时间段进城。</li>
<li>3. 遇到本站认证物流纠纷请致函本站，我们会给予您更专业的法律援助。</li>
</ul>
</div>

<?php 
echo '<div class="f cc"><h1>|&nbsp;&nbsp;上海'.$a.'</h1><div id="c">';

/*--------------------------------------------------------------*/	
	 $ty=mysql_query($sql);
	 $tya=mysql_fetch_array(mysql_query($sql_All));
	 $lna=$tya[0];$Pz=ceil($lna/10);
     while($tr=mysql_fetch_array($ty)){
	 $i=$tr['i'];
	 $h=$tr['h'];$v=$tr['v'];$bP=$tr['p'];
	
	 
	 echo '<div class="cv">
		 <h2><span class="p"><a href="http://wuliu.v-get.com/'.$i.'">'.$h.'</a><i v="'.$v.'"></i><i o="'.$tr['o'].'"></i></span><b class="q" b="'.$i.'"></b></h2><div class="o p cl">
		 <a href="http://wuliu.v-get.com/'.$i.'">';
		 if($bP){echo '<img i="http://weigeti.com/p2/3i/'.$i.'.gif" alt="'.$h.'">';}
		 else {echo '<img i="http://weigeti.com/p2/3i/0.gif" alt="'.$h.'">';}
		 echo '</a>
		 </div>
		 <div class="p cr"><p>'.$tr['d'].'</p></div>
	 <div class="o cb"><div class="p">wuliu.v-get.com/'.$i.'&nbsp;&nbsp;'.$tr['t'].'</div><div q="'.$tr['q'].'" class="q"></div></div>
	 <div id="cz'.$i.'" class="o cz"><p class="f1">正在为您查找<strong>'.$h.'</strong>的详细信息，请稍等...</p></div><div class="o"></div></div>';
	 }

echo '</div>';
/*--------------------------------------------------------------*/	


if($Pz>1){
$Pp=$sp-1;$Pn=$sp+1;
$Pq=($Pp==1)?'':'-'.$Pp;
switch ($sp)
{ case 1:echo '<div id="p"><a class="po">首页</a><a class="po">前一页&lt;</a>第<span class="pc">1</span>页<a href="http://sh.wuliu.v-get.com/'.$sa.'-2/'.$key.'" target="_self">&gt;下一页</a><a href="http://sh.wuliu.v-get.com/'.$sa.'-'.$Pz.'/'.$key.'" target="_self">共'.$Pz.'页</a></div>';break;
 case $Pz:echo '<div id="p"><a href="http://sh.wuliu.v-get.com/'.$sa.'/'.$key.'" target="_self">首页</a><a href="http://sh.wuliu.v-get.com/'.$sa.$Pq.'/'.$key.'" target="_self">前一页&lt;</a>第<span class="pc">'.$sp.'</span>页<a class="po">&gt;下一页</a><a class="po">第'.$sp.'页</a></div>';break;
  default:echo '<div id="p"><a href="http://sh.wuliu.v-get.com/'.$sa.'/'.$key.'" target="_self">首页</a><a href="http://sh.wuliu.v-get.com/'.$sa.$Pq.'/'.$key.'" target="_self">前一页&lt;</a>第<span class="pc">'.$sp.'</span>页<a href="http://sh.wuliu.v-get.com/'.$sa.'-'.$Pn.'/'.$key.'" target="_self">&gt;下一页</a><a href="http://sh.wuliu.v-get.com/'.$sa.'-',$Pz.'/'.$key.'" target="_self">第'.$Pz.'页</a></div>';break;
}
}
echo '<div class="o"></div></div>';

?>

</div>

<div class="q f r">

<div class="rw rt">
<h5>|&nbsp;&nbsp;物流服务</h5>
<ul>
  <li><a href="#">我是企业：我要发布物流信息</a></li>
  <li><a href="#">我是网友：我要提供好的建议</a></li>
</ul>
<div id="ar1"><ul><li><a href="http://wen.v-get.com/view/7.html">义乌到嘉兴托运多少钱一吨</a></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车托运到临沂多少钱</a></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费多少</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li></ul></div>
</div>
<div class="iu8 rw">
<h5>|&nbsp;&nbsp;<a href="http://sh.wuliu.v-get.com/news/154-0-0/index_1.html">物流新闻</a></h5>
<ul><!--@rt--><li><a target="_blank" href="http://news.v-get.com/view/183.html">2013年上海国际危化品供应链</a></li><li><a target="_blank" href="http://news.v-get.com/view/181.html">上海举行“关检合作促进外贸</a></li><li><a target="_blank" href="http://news.v-get.com/view/180.html">物流业在上海的营业税改征增</a></li><li><a target="_blank" href="http://news.v-get.com/view/179.html">山东德州华北商贸物流区蓄势</a></li><li><a target="_blank" href="http://news.v-get.com/view/178.html">泛太平洋海运会议标志深圳成</a></li><li><a target="_blank" href="http://news.v-get.com/view/177.html">2012亚洲国际动力传动与控制</a></li><li><a target="_blank" href="http://news.v-get.com/view/176.html">钢铁贸易需要构建现代化钢铁</a></li><li><a target="_blank" href="http://news.v-get.com/view/175.html">南宁铁路局与大型物流企业加</a></li><li><a target="_blank" href="http://news.v-get.com/view/174.html">电商短板物流自建不如协同发</a></li><!--@rt--></ul></div>
<div class="iu9 rw">
<h5>|&nbsp;&nbsp;企业展台</h5>
<div class="r_t"><dl><dt><a href="http://wuliu.v-get.com/281"><img i="http://weigeti.com/p2/3b/281.gif" /></a></dt><dd><span><a href="http://wuliu.v-get.com/281"><strong>中国邮政 速达全球</strong></a></span></br><span>物流巨头央企EMS发展物流利弊该如何评判？</span><a href="http://news.v-get.com/view/85.html">[详细]</a></dd></dl></div><ul><li><a href="http://wuliu.v-get.com/728">上海龙圣托运→新疆、重庆</a></li><li><a href="http://wuliu.v-get.com/745">上海日星托运→张家港专线</a> </li><li><a href="http://wuliu.v-get.com/765">上海盛辉物流→江苏、浙江</a></li><li><a href="http://wuliu.v-get.com/770">上海广东物流→美杰托运部</a></li><li><a href="http://wuliu.v-get.com/744">上海祥顺运输→北京、广东</a></li><li><a href="http://wuliu.v-get.com/768">上海迅凯托运→江西、四川</a></li><li><a href="http://wuliu.v-get.com/726">上海怀历物流→长沙、湘潭</a></li><li><a href="http://wuliu.v-get.com/723">上海春安货运→福建抚州线</a></li><li><a href="http://wuliu.v-get.com/750">上海凌红运输→江西南昌线</a></li><li><a href="http://wuliu.v-get.com/719">上海万通物流→南平、三明</a></li><li><a href="http://wuliu.v-get.com/772">上海海顺物流→苏州托运处</a></li><li><a href="http://wuliu.v-get.com/769">上海集装箱运输→温州台州</a></li><li><a href="http://wuliu.v-get.com/707">上海宏盛托运→南京、深圳</a></li></ul></div>
<div class="iu2 rw">
<h5>|&nbsp;&nbsp;<a href="http://sh.wuliu.v-get.com/baike/154-0-0/index_1.html">物流百科</a></h5>
<ul><!--@rb--><li><a target="_blank" href="http://baike.v-get.com/view/352.html">江西农民童木根成就年营业额</a></li><li><a target="_blank" href="http://baike.v-get.com/view/351.html">密码箱不翼而飞，申乐物流赔</a></li><li><a target="_blank" href="http://baike.v-get.com/view/350.html">冷链物流应该协作发展</a></li><li><a target="_blank" href="http://baike.v-get.com/view/348.html">中国物流与采购联合会 (Chin</a></li><li><a target="_blank" href="http://baike.v-get.com/view/347.html">中国物流学会 (China Societ</a></li><li><a target="_blank" href="http://baike.v-get.com/view/346.html">物流公司送错地点又损坏货物</a></li><li><a target="_blank" href="http://baike.v-get.com/view/345.html">韩国长锦商船公司 Sinokor M</a></li><li><a target="_blank" href="http://baike.v-get.com/view/344.html">全球主要海运港口航线路线图</a></li><li><a target="_blank" href="http://baike.v-get.com/view/343.html">迪拜阿联酋航运公司 Emirate</a></li><!--@rb--></ul></div></div></div><div class="o" style="height:9px"></div><div class="b"><p class="f bt">|<a href="#">关于我们</a>|<a href="#">合作伙伴</a>|<a href="#">营销中心</a>|<a href="#">联系我们</a>|<a href="http://wuliu.v-get.com/index_1.html">网站地图</a>|<a href="#">微个体网</a>|<a href="http://sh.wuliu.v-get.com/m/yiwu.html">手机版</a>|</p><p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a> <a href="http://www.miibeian.gov.cn/" rel="nofollow" style="color:#666">ICP12013909</a> All Right Reserved</p></div></div>
<div style="display:none">
<script type="text/javascript">
J('http://wuliu.v-get.com/a.js',function(){cF('sh.');cB('#f0ffc4',$('c^DIV'))});
$("s").sa.options[<?php echo ($A-1);?>].selected="selected";
$("s").sc.options[<?php echo $C;?>].selected="selected";
$A('','_blank');$A('n','_self',3);Q();
var kk<?php echo '="'.$K.'"';?>;
if(L(kk)>0){H($('c'),$('c').innerHTML.replace(/(<?php echo $K;?>)/ig,"<span class='f1'>$1</span>"))}
var _bdhmProtocol=(("https:"==document.location.protocol)?" https://":" http://");document.write(unescape("%3Cscript src='"+_bdhmProtocol+"hm.baidu.com/h.js%3Fe0a8998d85ee8ddd24d2c38e4f5c9032' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
</body></html>
