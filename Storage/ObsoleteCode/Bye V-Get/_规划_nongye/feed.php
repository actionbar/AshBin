<?php
require('c.php');
/*市场，价格信息，政策导向：把农产品交易类供需单独出来，(中国)农贸城-农产品批发市场：nongmao.v-get.com类似wuliu那些提出供应商和销售商*/
$n=array('教程—养猪 养牛 养羊','新闻','导向','品种','棚舍','秘诀','病害','处理','百科','案例');
$C=$_GET['c'];
$c=($C<1)?'':'c='.$C.' AND';
$B=$_GET['b'];
$b=($B<1)?'':'b='.$B.' AND';
$p=$_GET['p'];

$w=$c.$b.' a=1';
$pl='http://localhost:8080/nongye.v-get.com/feed-'.$B.'-'.$C;

$WT="SELECT COUNT(i) FROM c WHERE $w";

$QT=mysql_fetch_array(mysql_query($WT));
$PT=$QT[0];$pT=ceil($PT/24);
$P=($p-1)*24;
$W="SELECT * FROM c WHERE $w LIMIT $P,24";
$q=mysql_query($W);
$ps='';
if($pT>1){
$pp=$p-1;$pn=$p+1;$p0=1;$p9=$pT+1;	
if($p>1){$ps='<a href="'.$pl.'-'.$pp.'/">上一页</a>';}
/*if($pT>5){if($p<3){$p9=6;}else if($p>$pT-2){$p0=$pT-4;}else{$p0=$p-2;$p9=$p+3;}}
for($I=$p0;$I<$p9;$I++){if($I==$p){$px='class="po"';}else{$px='';}echo '<a href="'.$pl.'-'.$I.'/" '.$px.'>'.$I.'</a>';}*/
$ps.='<a class="po">'.$p.'</a>';
if($p<$pT){$ps.='<a href="'.$pl.'-'.$pn.'/">下一页</a>';}
}
//echo mb_convert_encoding ("淘宝", "HTML-ENTITIES", "gb2312");    //输出：&#20320;&#22909;
//echo mb_convert_encoding ("&#20320;&#22909;", "gb2312", "HTML-ENTITIES");    //输出：你好   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="gb2312"><head><title>养殖<?php echo $n[$B]?></title>
<!--先做好义乌市场，其他的技术以后再说-->
<meta content="text/html; charset=gb2312" http-equiv="content-type" />
<meta name="keywords" content="外贸 物流 托运 车源 货源" />
<link href="http://localhost:8080/v-get.com/c/favicon.ico" type="image/ico" rel="shortcut icon" />
<!--我看好多大站，如网易，迅雷，css文件都写在页面内部，我一般是单独写一个css文件，页面引用，请问这样有什么区别吗，我觉得可能是有效率的问题吧，请大虾讲解一二，谢过了。当然有区别，在一个页面里，一次请求就下载完成了，如果分成多个文件，就需要好几个请求才能完成，也就是说，你可以把css放置在另一个域名下，这样就可以同步从两个站点去下载页面和对应的css文件。这就好比大型网站都把图片放置在单独的域名下，以分摊页面服务器压力。当然这是针对只用一次的css；如果多次用，还是独立比较好。gb2312更利于 正则查找，所以绝对简体中文的页面就用gb2312 -->
<link rel="stylesheet" type="text/css" href="shengchu.css" />
<link rel="stylesheet" type="text/css" href="http://localhost:8080/v-get.com/nongye/shengchu.css" />
</head>
<script type="text/javascript" src="http://localhost:8080/v-get.com/c/c.js"></script>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/wuliu/ajax_index.js"></script>
<body>
<div class="w">
<div class="t">
<a href="http://www.v-get.com/"><strong>V-Get!</strong></a><a href="#">外贸</a>-<a href="#">商讯</a>-<a href="#">招商</a>-<a href="#">商法</a>-<a href="#">商经</a>-<a href="">物流</a>-<a href="">娱乐</a><span class="q"><a href="">登录</a></span>
</div>


<div class="u">
<div class="p i"><a title="麦城，生活更加方便！" href="#"><img src="http://localhost:8080/v-get.com/i/i.gif" /></a></div>
<div class="q g">
<div class="gt">
<ul>
<li><a href="ci1.php">国际</a><a href="">义乌</a><a href="">科技</a><a href="">军事</a></li><li><a href="ci3.php">设备</a><a href="">设备</a><a href="">求购</a><a href="">供应</a><a href="">财经</a></li><li><a href="i.htm?bb=0">综合</a><a href="i1.htm?bb=1">生发</a><a href="i2.htm?bb=2">园版</a><a href="i3.htm?bb=3">工作版</a></li>
</ul>
<ul><li><a href="ci2.php">汽票</a><a href="">车票</a><a href="#">机票</a><a href="http://localhost:8080/v-get.com/p.v-get.com/c.php">运工</a></li><li><a href="http://localhost:8080/v-get.com/c.php">软件</a><a href="http://localhost:8080/v-get.com/c.php?a=3">托运</a><a href="http://localhost:8080/v-get.com/c.php?a=1">快递</a><a href="">外汇</a><a href="">贷款</a></li><li>fsafsfsdfs
</li>
</ul>
</div>
<div class="gb">
 <!--热区就靠收集关键词/点击率。搜索的*2，点击的*1-->
   <a href="#"><b>热区</b></a>
   <a href="../search.php">搜索提示</a>
   <a href="i.php?a=3">托运</a>
   <a href="i.php?a=3157">义乌托运</a>
   <a href="../_liandong.php">二级联动</a>
   <a href="i.php">多页面分开</a>
   <a href="#">上海海洋大学</a>
   <a href="#">上海外国语大学</a>
   <a href="#">沈阳工业大学</a>
   <a href="#">腐女</a>
   <a href="#">军对外国际关系学院</a>
   <a href="#">娱乐</a>
</div>
</div>
<!--end of class=G-->
</div>
<div class="w3">
<div class="p w3l"><img src="http://localhost:8080/v-get.com/i/wuliu/a/ci7gg1.gif" /></div>
<div class="q w3r"><ul><li><a href="#">6小时掌握学英语的秘诀--点击看答案</a></li>
<li><a href="#">6小时掌握学英语的秘诀--点击看答案</a></li>
<li><a href="#"><span class="f9">6小时掌握学英语的秘诀--点击看答案</span></a></li>
<li><a href="#">6小时掌握学英语的秘诀--点击看答案</a></li>
</ul></div></div>


<DIV class="o n"><div class="p"><A href="http://localhost:8080/farm.v-get.com/feed/">首页</A><A href="http://localhost:8080/farm.v-get.com/feed-1-<?php echo $C;?>/">新闻</A><A href="http://localhost:8080/farm.v-get.com/feed-2-<?php echo $C;?>/">政策市场</A><A href="http://localhost:8080/farm.v-get.com/feed-3-<?php echo $C;?>/">选种育种</A><A href="http://localhost:8080/farm.v-get.com/feed-4-<?php echo $C;?>/">棚舍配置</A><A href="http://localhost:8080/farm.v-get.com/feed-5-<?php echo $C;?>/">养殖秘诀</A><a href="http://localhost:8080/farm.v-get.com/feed-6_<?php echo $C;?>/">病害</a><A href="http://localhost:8080/farm.v-get.com/feed-7-<?php echo $C;?>/">加工处理</A><A href="http://localhost:8080/farm.v-get.com/feed-8-<?php echo $C;?>/">误区百科</a><A href="http://localhost:8080/farm.v-get.com/feed-9-<?php echo $C;?>/">养殖案例</A></div><form class="q ns" action="a.php" method="post"><div id="nss" class="p"><label>速运</label><ul><li value=1>快递</li><li value=2>仓储</li><li value=4>搬家</li><li value=5>货车</li><li value=6>货源</li><li value=7>货代</li><li value=8>船代</li></ul></div>
<input type="hidden" id="ZZZZZ" value=3>
<input type="text" name="" class="nsk"/>
<input type="image" class="nss" src="http://localhost:8080/v-get.com/i/yule/nss.png" /></form>
</div>


<div class="o e">
<span class="el"><a href="#">媒体头条</a></span>
<div id="m0">
<ul id="m0c">
<li><a href="#">媒体头条，最多29个汉字；可以包括很多东西在里面的</a></li>
<li><a href="#">这一切都是为了什么你要离开我？</a></li>
<li><a href="#">1111111111111我？</a></li>
<li><a href="#">222222222222？</a></li>
<li><a href="#">333333333333333？</a></li>
<li><a href="#">444444444444444我？</a></li>
<li><a href="#">5555555555</a></li>
<li><a href="#">5555555666666我？</a></li>
</ul>
</div>
<span><a href="2033/">关注</a></span>
<div id="m1">
<ul id="m1c">
<li><a href="#">热点关注区，最多14个汉字</a></li>
<li><a href="#">轻轻的我走了，</a></li>
<li><a href="#">正如我轻轻的来</a></li>
<li><a href="#">我轻轻的招手，</a></li>
<li><a href="#">作别西天的云彩。</a></li>
<li><a href="#">那河畔的金柳，</a></li>
<li><a href="#">是夕阳中的新娘</a></li>
<li><a href="#">波光里的艳影，</a></li>
</ul></div>

<form action="#" class="q"><input type="text" class="es0" value="请输入关键字" name="word"/> <input type="submit" class="es1"  value="搜索" /></form>
 <select><option>所有</option><option>文章</option><option>下载</option></select>
</div>

<!--id=ln1   height=1144-->

<!--上左class=l-->
<div class="w6"> <img src="http://localhost:8080/v-get.com/i/wuliu/a/zzidc980.gif" /> </div>
<div class="v">
<div class="p l">
<!--d height:244px-->

<div class="d">
<div id="d">
<ul id="dc">
<li><a href="1"><img src="http://localhost:8080/v-get.com/c/farm/a/d1202050912170.jpg" /></a></li>
</ul>
</div>
<div id="dk"><a href="">1.运辉物流，一路成就所托</a></div><div class="db"></div>
<div class="df"><a href="#">这里有最美丽的羽毛</a><span id="do"><a href="#" class="do">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a></span></div>
</div>

<!------------循环结构--->
<div class="lw">
<ul><li><a href="#" class="br">这里是其他附属,如物流危机等显示区域</a> </li>

<li>[<a href="#">危机处理</a>]<a href="#">船已离港,如何解决未办理ciq</a></li>
</ul>
</div>

<div class="lw">
<h2><a href="#" class="p">信息推广</a><a class="q" href="#">更多&gt;&gt;</a></h2>
<ul class="l3c">
<li><a href="#">需求：30吨车福建至北京</a></li>
<li><a href="#">需求：3位义乌到安徽汽车位</a></li>
<li><a href="#">需求：3位义乌到安徽汽车位</a></li>
<li><a href="#">需求：3位义乌到安徽汽车位</a></li>
<li><a href="#">供应：3位义乌到安徽汽车位</a></li>
<li><a href="#">供应：3位义乌到安徽汽车位</a></li>
<li><a href="#">供应：3位义乌到安徽汽车位</a></li>
<li><a href="#">供应：3位义乌到安徽汽车位</a></li>
</ul>
</div>
<div class="l4"><!--88px-->
<img src="http://localhost:8080/v-get.com/i/wuliu/a/l.gif" />
</div>
<div class="lw">
<h2><a href="#" class="p">新闻报道</a><a class="q" href="#">更多&gt;&gt;</a></h2>
<div class="l5t">
<dl><dt><a href="#"><img src="http://localhost:8080/v-get.com/i/wuliu/a/a6.jpg" /></a></dt>
  <dd><span><a href="#"><font color="#000000"><b>欢迎ups进驻v-get物流中心</b></font></a></span><br /><span>涉案2．532亿元，已追回4240万，冻结7000万资或房产<a class="mo2" href="#">[详细]</a></span></dd>
</dl>
</div>
<ul class="l_b">
  <li><a href="#"><font color="#990000">马云</font>：要组建中国最大的、服务最好的物流公司</a> </li>
  <li><a href="2011-02/1520032"><font color="#0000ff">顺丰速递</font>：让实惠、便捷顺风下去</a></li>
  <li><a href="2011-02/1520032"><del>圆通物流</del>：实拍圆通员工暴拆客户快递</a></li>
  <li><a href="2011-02/1520032"><font color="#ff6633">捷皓快运</font>：恭祝李丽华荣升总裁</a></li>
  <li><a href="2011-02/1520032"><font color="#00ff00">嘉豪搬家</font>：庆国庆，义乌嘉豪搬新居大优惠</a></li>
  </ul>
 </div>



 </div>
<!--class=l结束-->
 
 

<div class="p c">

<div class="cw cs">
<form action="javascript:void(0)" onsubmit="javascript:form();return">

<label id="z0" for="zb">牲畜</label><input type="hidden" id="zb" value="000"/>
<select id="sa"  onchange="ajax_c()"><option></option><option value="1">新闻</option><option value="2">价格</option><option value="3">选种育种</option><option value="4">棚舍配置</option><option value="5">养殖方式</option><option value="6">病害</option><option value="7">加工处理</option><option value="8">误区百科</option><option value="9">养殖案例</option></select>
<input type="text" id="sk" onmouseover="this.focus();this.select()"/>

<input type="submit" class="csb" value="" /></form>



</form>


</div>
<div class="cv"><a href="#"><img src="http://localhost:8080/v-get.com/i/wuliu/a/qywlgd.gif" /></a></div>
<div class="c3">
<a href="http://localhost:8080/nongye.v-get.com/feed-0-1-1/" class="a1">畜牧</a><a href="#" class="a1">羊</a><a href="#" class="a3">牛</a>
</div>
<?php 
echo '<div id="pt" class="pg">';
echo $ps;
echo '</div>';
?>
<div class="cw" id="c">
<ul>
<?php 
while($Q=mysql_fetch_array($q)){echo '<li><span>['.$n[$Q['b']].']</span><a href="http://localhost:8080/nongye.v-get.com/feed/'.$Q['i'].'.html">'.$Q['h'].'</a></li>';}?>
</ul>
</div>

<?php 
echo '<div id="p" class="pg">';
echo $ps;
echo '</div>';
?>
</div>

<div class="q r">

<div class="rw">
<h2><a href="" class="p">物流服务</a><a class="q" href="">更多&gt;&gt;</a></h2>
<ul class="rtt">
  <li><img src="http://localhost:8080/v-get.com/i/g/s11.gif" /><a href="#" class="rtbt">我是企业：我要发布物流信息</a></li>
  <li><img src="http://localhost:8080/v-get.com/i/g/s16.gif" /><a href="#">我是个人：我要寻求物流服务</a></li>
</ul>
<ul id="a3">
      <li><a href="#">可变动90模块广告</a></li>
      <li><a href="#">联想一体台式机成就行业应用 </a></li>
      <li><a href="#">你还在用一次性筷子么？</a></li>
      <li><a href="#">你还在用一次性筷子么？</a></li>   
</ul>
</div>



<div class="rw">
<h2><a href="" class="p">企业展台</a><a class="q" href="">更多&gt;&gt;</a></h2>
<div class="rt_t">
<dl>
  <dt><a href=""><img src="http://localhost:8080/v-get.com/i/wuliu/a/rg.jpg" border="0" /></a></dt>
   <dd><span><a href=""><font color="000000"><b>国际品质 速达全球</b></font></a></span></br>
      <span>5.12大地震发生后，tnt中国立即开展了一系列救助行动。</span><a class="mo2" href="">[详细]</a>
  </dd>
</dl>
</div>
<ul class="rt_b">
  <li><a href="5089-1-1" target="_blank">中国物流日运总量世界第一</a> </li>
  <li><a href="4239-1-1" target="_blank">法律越来越健全 民众反少安全感</a> </li>
</ul></div><!--时间：2011-03-13 15:01:40-->


<div class="rw">
<h2><a href="" class="p">诚信会员</a><a class="q" href="">更多&gt;&gt;</a></h2>
<ul class="rt_a">
  <li><a href="#">义乌龚大姐托运，广东福建专线</a></li>
  <li><a href="#">义乌小李托运处</a> <a href="#">埃塞俄比亚专线</a></li>
  <li><a href="#">义乌海平货代公司</a><a href="#">宁波速达快递</a></li>
  <li><a href="#">义乌金石运外贸公司</a><a href="#">义乌石峰速运</a></li>
  <li><a href="#">温州仁达船运</a><a href="#">义乌金祥搬家</a></li>
  <li><a href="#">义乌必达搬家，全市低价酬宾搬新居</a></li>
</ul></div>


<div id="a4"><!--width:210px ;height =70;大尺寸广告位72n-2-->
<ol>
<li><a href=""><img src="http://localhost:8080/v-get.com/i/wuliu/a/r2.gif" /></a></li>
<li class="rb2"><a href="">这里又是广告</a></li>
<li><a href=""><img src="http://localhost:8080/v-get.com/i/wuliu/a/r3.gif" /></a></li>
<li class="rb2"><a href="">这里又是广告</a></li>


</ol>
</div>
</div>

</div>


<div class="banner" id="a5">
<img src="http://localhost:8080/v-get.com/i/wuliu/a/w8.jpg" />
</div>
<ul id="gg4_1">
  <li><a href="" title='人间&quot;胸器&quot;的销魂'>最多写七个汉字</a></li>
  <li><a href="35442" title="憾！性感双面女王">憾！性感双面女王</a></li>
  <li><a href="41782" title="香车里的桃色诱惑">香车里的桃色诱惑</a></li>
  <li><a href="49107" title="靠身体出位的车模">靠身体出位的车模</a></li>
  <li><a href="58241" title="清纯的卡哇伊girl">清纯的卡哇伊girl</a></li>
  <li><a href="#" title="制服女郎清凉诱惑">制服女郎清凉诱惑</a></li>
  <li><a href="#" title="中/美/韩最火辣车模">中/美/韩最火辣车模</a></li>
  <li><a href="#" title="中/美/韩最火辣车模">中/美/韩最火辣车模</a></li>
  <li><a href="#" title="中/美/韩最火辣车模">中/美/韩最火辣车模</a></li>
</ul>
<!--固定9行<7汉字模式-->
<div class="a6"></div>
<div class="b">
<div class="b1">
|<a href="siteinfo/about">我的麦城网</a>
|<a href="siteinfo/copyright">版权声明</a>
|<a href="hezuo/siteinfo">广告服务</a>
|<a href="siteinfo/contact">联系我们</a>
|<a href="siteinfo/subscribe">活着杂志圈</a>
|<a href="siteinfo/job">麦城网招聘</a>
|<a href="sitemap">网站导航</a>|
</div>
<ul>
<li><a href="siteinfo/servicelicense">互联网新闻信息服务许可证</a>
<a href="http://www.miibeian.gov.cn/"> 京icp备10216229号</a></li>
<li><a href="siteinfo/tvlicense">《广播电视节目制作经营许可证》((广媒)字第179号)</a></li>
<li><a href="siteinfo/vpermits">网络传播视听节目许可证(0108322)</a></li>
<li><a href="siteinfo/icp">电信与信息服务业务经营许可证号090455</a></li>
<li><a href="siteinfo/druglicense">互联网药品信息服务资格证书(京)-经营性-2009-0016</a></li>
<li><a href="siteinfo/tellicense">增值电信业务许可证 b2-20090462</a></li>
<li><a href="siteinfo/culture">网络文化经营许可证（文网文【2010】221号）</a></li>
<li><a href="siteinfo/healthcare">互联网医疗保健信息服务(京卫网审[2010]第0056号)</a></li>
<li><a href="siteinfo/publication">互联网出版许可证（新出网证（京）字085号）</a></li>
</ul>
<p>copyright &copy; 2007-2011 magwu inc. all right reserved 版权所有<a href="#" ><img src="#" /></a></p>
</div>


<div id="ec"></div>
<div id="eb"></div>
<div id="z"></div>
<div id="b"></div>
</div>
<script language="javascript" type="text/javascript">
<?php echo 'P('.$p.','.$pT.',"'.$pl.'");';?>

H($('dc'),'');
var MK=[{"l":'http://localhost:8080/farm.v-get.com/feed/29.html',"p":"http://localhost:8080/v-get.com/c/farm/a/d1202050912170.jpg","k":'田茂根靠山吃山 和谐养羊发"羊财"'},{"l":'http://localhost:8080/farm.v-get.com/feed/30.html',"p":"http://localhost:8080/v-get.com/c/farm/a/d1202050912171.jpg","k":'苏祥义和他的“老苏品牌”青山羊'},{"l":'http://localhost:8080/farm.v-get.com/feed/3.html',"p":"http://localhost:8080/v-get.com/c/farm/a/d110523095309448.jpg","k":'如何管理规模养羊场'},{"l":'http://localhost:8080/farm.v-get.com/feed/22.html',"p":"http://localhost:8080/v-get.com/c/farm/a/d0706180000009.jpg","k":'走出波尔山羊改良的误区'},{"l":'http://localhost:8080/farm.v-get.com/feed/19.html',"p":"http://localhost:8080/v-get.com/c/farm/a/d1201030844480.jpg","k":'叶集擦亮"羊"名片'}];
for(I=0;I<5;I++){
	var a=$('do^A'),k=MK[I],r=k.l;
	a[I].href=r;
	E(a[I],$8,function(){for(I=0;I<5;I++)if(a[I]==this)MD(I)});
	$('dc').innerHTML+='<li><a href="'+r+'"><img src="'+k.p+'" /></a></li>';
	}
M('d',218,5,5000,MD);


$A();
nss_init();
var zn=9;
input(zn);


M('m0',16,30,3000);


Q();B('#eee','^tr');

M('m1',16,30,3000);
M('m2',28,40,3000);/*id,高度，速度，间隔时间*/

</script>
</body></html>
