<?php
$Qc=mysql_connect("localhost","root","qwdw114");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
/* 对date 判断，如果date在文章内部不匹配就是404
y 获取年份数据库  d-->date  文章内部获取了年月日之后对比，不正确就404 */
$I=$_GET['i'];$SDT=$_GET['d'];$SY=$_GET['y'];
$Qq=mysql_query('SELECT * FROM f'.$SY.' WHERE i='.$I.' LIMIT 1',$Qc);
/* 404是直接原始文件，而不是伪静态后的文件地址。  这个实在根目录下，所以伪静态就是a/404.php  */
$Qr=mysql_num_rows($Qq);if($Qr==0){header('HTTP/1.1 404 Not Found');header("status: 404 Not Found");include 'a/404.php';exit();}
$Qa=mysql_fetch_array($Qq);
$H=$Qa['h'];$D=$Qa['d'];$K=$Qa['k'];
$T=$Qa['t'];$t=strtotime($T);$t=date('Y-m-d',$t);if($t!=$SDT){header('HTTP/1.1 404 Not Found');header("status: 404 Not Found");include 'a/404.php';exit();}

?>
<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php echo '<title>',$H,'_商务物流新闻_V-Get!</title><meta name="keywords" content="',$K,'" /><meta name="description" content="',$D,'" />';?>
<link href="http://localhost/www.v-getimg.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link rel="stylesheet" type="text/css" href="http://localhost/www.v-getimg.com/i0/i.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/www.v-getimg.com/i0/s2/i.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/www.v-getimg.com/i0/s2/f.css" />
</head>
<script type="text/javascript" src="http://localhost/www.v-getimg.com/i0/i.js"></script>
<body>
<div class="wt ph"><div class="w a"><a href="http://baike.v-get.com/" class="wti" title="返回商务百科首页"></a><a href="#" id="wt"></a><a href="http://wuliu.v-get.com/">首页</a><a href="#">新闻</a><a href="#">百科</a><form action="http://yiwu.wuliu.v-get.com/tuoyun/" id="ws"><input type="text" placeholder="百度搜索" name="sk" class="wsk"/><input type="submit" value="" class="wss"/></form><div class="p"><a href="#" class="e">登录</a><a href="http://i.v-get.com/e/SignUp">注册</a></div></div></div>
<div class="o mt"></div>
<div class="w">

<div class="u">
<div class="i">
<div class="p il"><h1><?php echo $H;?></h1></div><div class="p ir"><p>掌握物流资讯制高点</p><p>wuliu.v-get.com</p></div>
<div class="o"></div>
</div>
<div id="au" class="pr"><img src="http://localhost/www.v-get.com/p8/728x90/a.gif"/></div>
</div>

<div class="v">
<div class="p l">

<div class="c mb">
<div class="m mb">您的位置：
<a href="http://www.v-get.com/">首页</a>&nbsp;&gt;&gt;&nbsp;<a href="http://yiwu.wuliu.v-get.com/news/">新闻导读</a>&nbsp;&gt;&gt;&nbsp;正文<span><a href="#">嘿嘿</a></span></div>
<?php echo '<h1>'.$H.'</h1><div class="ct"><a href="http://www.v-get.com/">http://www.v-get.com</a><span style="margin:0 9px">'.$T.'</span>'.$Qa['n'].'</div>';?>
<div id="d"></div><div class="o mh"></div>
<div id="c"><?php echo $Qa['f'];mysql_close($Qc);?></div>

</div>
<div class="l4 mg">
<h6>新闻标签</h6>
<div class="p">
<?php $ka=explode(' ',$K);
if(count($ka)>0){foreach($ka as $i=>$k){echo '<a href="#">',$k,'</a>';}
}?>
</div>
<div class="q">商务新闻中的词条正文与判断内容仅供用户参考，具体商业操作需要根据商业环境决定。如果您需要最佳的商业解决方案，建议您咨询专业的企业人士。</div>
<div class="o"></div></div>

<div class="l5"><!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_tieba"></a>
<a class="bds_ty"></a>
<a class="bds_mshare"></a>
<span class="bds_more"></span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=609302" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END --></div>
<div class="o mh mg"></div>
<div class="a728x90 mg lv"><img src="http://localhost/www.v-get.com/i8/728x90/0.gif" /></div>
<div class="h">
<div class="ht">
<div id="hn"><span class="p"><?php if(isset($_SESSION['si'])){echo '<a href="#" class="fh">',$_SESSION['sa'],'</a><a href="http://localhost/i.v-get.com/e/SignOut">退出</a>';} else {echo '<a href="#" class="e">登陆</a><a href="http://localhost/i.v-get.com/e/SignUp">注册</a>';}?></span><span class="q">发言请遵守社区公约，还可以输入<i>140</i>字</span></div>
<form id="hs" action="http://localhost/i.v-get.com/e/pinglun.html" method="post">
<input type="hidden" name="hf" value="3^<?php echo $I;?>"/><input type="hidden" name="hip" value="183.154.94.46"/><input type="hidden" name="hadd" value="浙江省金华市"/><input type="hidden" name="hjj" value="0"/>
<textarea name="ht"></textarea>
<div class="lbb"><div class="p">表情</div><div class="p">同时转发到：</div><div class="q"><input type="submit" value="发表评论" class="hs"/></div></div><div class="o"></div>
</form>
</div>
<div id="hf">

</div>
</div>

<div class="f l7 a">
<div class="l7t"><a href="http://wuliu.v-get.com/" class="l7l">物流公司黄页与运费线路专业查询“商务物流网”</a><a href="http://e.v-get.com/">没有网站？找E维科技！有了网站没有效果？找E维科技！</a><div class="o"></div></div>
<a href="http://baike.v-get.com/view/62.html">企业怎么才能安全操作货物出口非洲托收支付及快速到账</a><a href="http://baike.v-get.com/view/31.html">义乌市宾王客运中心长途客运汽车票价及时刻表查询</a><a href="http://e.v-get.com/sem/">企业忙？也不懂网络营销？适应不了新时代营销怎么办？</a><a href="http://weigeti.com/">微个体网，一个有性格、感性与性感并存的交友网站</a><a href="#">海外营销与外贸从业人员必备的B2B商务导航网址大全</a><a href="http://e.v-get.com/tool/">网络营销怎么少得了SEO优化工具，查询百度排名</a><a href="http://baike.v-get.com/view/20.html">没办COC证书的货物出口承运损失该怎么追究相应责任</a><a href="http://e.v-get.com/vi/">企业品牌形象VI视觉设计，企业文化形象化最佳途径</a><a href="http://e.v-get.com/office/">客服成本越来越高？招聘的新客服又专业也不负责任？</a><a href="http://baike.v-get.com/view/55.html">外贸出口公司申请办理出口退税业务和出口退税计算</a>
<div class="o"></div>
</div>



</div>
<div class="q r">

<div class="a250x250 mg"></div>
<div class="f mg">
<h4>每日推荐</h4>
<div class="ri a">
<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2"><img i="http://localhost/www.v-getimg.com/i8/110x90/1302260652031.jpg" alt="义乌商务物流网" /><br>义乌商务物流网</a><a href="http://yiwu.wuliu.v-get.com/huodai/"><img i="http://localhost/www.v-getimg.com/i8/110x90/1302260652032.jpg" alt="义乌DHL TNT UPS国际快递"/><br>DHL TNT UPS</a>
</div>
<div class="o"></div>
<ul>
<li><a href="http://baike.v-get.com/view/24.html">集装箱运输—国际多式联运优势</a></li>

<li><a href="http://baike.v-get.com/view/56.html">丢失出口退税票据应该怎么办呢？</a></li>
<li><a href="http://baike.v-get.com/view/21.html">国际集装箱运整箱FCL和拼箱LCL</a></li>
<li><a href="http://baike.v-get.com/view/3.html">该怎样辨别货代公司物流提单陷阱</a></li>
<li><a href="http://baike.v-get.com/view/19.html">国际货运代理投保责任险 获全赔</a></li>
<li><a href="http://baike.v-get.com/view/287.html">外贸潜规则</a>和<a href="http://baike.v-get.com/view/285.html">外贸管制及报关规范</a></li>
<li><a href="http://baike.v-get.com/view/46.html">国际货运集装箱出口通关操作流程</a></li>
</ul>
</div>
<div class="f mg">
<h4>每日推荐</h4>
<div class="ri a">
<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2"><img i="http://localhost/www.v-getimg.com/i8/110x90/1302260652033.jpg" alt="义乌江东货运市场托运部" /><br>义乌江东货运市场</a><a href="http://baike.v-get.com/view/344.html"><img i="http://localhost/www.v-getimg.com/i8/110x90/1302260652034.jpg" alt="全球主要海运港口航线路线图"/><br>海运港口航线图</a>
</div>
<div class="o"></div>
<ul>
<li><a href="http://baike.v-get.com/view/282.html">我国出口报检规定</a> <a href="http://baike.v-get.com/view/243.html">包装技术分类</a></li>
<li><a href="http://baike.v-get.com/view/245.html">物流企业代理运作方案设计规范</a></li>
<li><a href="http://baike.v-get.com/view/244.html">国际贸易CIF条款信用证支付案例</a></li>
<li><a href="http://baike.v-get.com/view/241.html">多式联运经营人和货运代理人</a></li>
<li><a href="http://baike.v-get.com/view/79.html">托运人对于托运危险货物的义务</a></li>
<li><a href="http://baike.v-get.com/view/69.html">仓库GSP认证的库房硬件要求</a></li>
<li><a href="http://baike.v-get.com/view/43.html">国际贸易集装箱进口操作[实例]</a></li>
</ul>
</div>
<div class="a250x250 mg"></div>
<div class="rv mg r4">
<h4>大家爱看</h4>
<dl><dt><a href="http://baike.v-get.com/view/280.html"><img i="http://localhost/www.v-getimg.com/i8/90x60/1302260723011.jpg" alt="国际货运物流中托运人对危险货物的义务和责任"/></a></dt><dd><a href="http://baike.v-get.com/view/280.html">国际货运物流中托运人对危险货物的义务和责任</a></dd><dt><a href="http://baike.v-get.com/view/276.html"><img i="http://localhost/www.v-getimg.com/i8/90x60/1302260723012.jpg" alt="物流企业如何发挥顾客资产的战略竞争优势"/></a></dt><dd><a href="http://baike.v-get.com/view/276.html">我国物流企业如何发挥顾客资产的战略竞争优势</a></dd><dt><a href="http://baike.v-get.com/view/275.html"><img i="http://localhost/www.v-getimg.com/i8/90x60/1302260723013.jpg" alt="中小企业物流管理竞争力的三个重要方面"/></a></dt><dd><a href="http://baike.v-get.com/view/275.html">中小企业物流管理竞争力的三个重要方面</a></dd><dt><a href="http://baike.v-get.com/view/249.html"><img i="http://localhost/www.v-getimg.com/i8/90x60/1302260723015.jpg" alt="现代物流与供应链管理"/></a></dt><dd><a href="http://baike.v-get.com/view/249.html">现代物流与供应链管理</a></dd></dl>
<div class="o"></div>
</div>
<div class="f rv mg r5">
<h4>热评</h4>
<ul>
<li><a href="http://baike.v-get.com/view/207.html">网络证据在货物运输审判中的适用</a></li>
<li><a href="http://baike.v-get.com/view/192.html">CIF合同货物运输的风险承担案</a></li>
<li><a href="http://baike.v-get.com/view/194.html">CIF提单无地址的出口保险索赔案</a></li>
<li><a href="http://baike.v-get.com/view/14.html">公路货运保险合同争议案代理词</a></li>
<li><a href="http://baike.v-get.com/view/98.html">笔记本丢失 货运公司只赔250元</a></li>
<li><a href="http://baike.v-get.com/view/177.html">优化仓储资金投向的理性思考</a></li>
<li><a href="http://baike.v-get.com/view/176.html">该怎么定位规划新仓库的建设？</a></li>
<li><a href="http://baike.v-get.com/view/178.html">自动仓库的出/入库管理流程</a></li>
<li><a href="http://baike.v-get.com/view/208.html">配送中心如何优化配送流程</a></li>
</ul>
</div>
<div class="a250x250 mg"></div>
<div class="f rv mg r6">
<h4>大家爱看</h4>
<h3><a href="http://baike.v-get.com/view/272.html">搬家行业乱加价 消费者受损难维权</a></h3>
<dl><dt><a href="http://baike.v-get.com/view/272.html"><img i="http://localhost/www.v-getimg.com/i8/90x60/1302260723014.jpg" alt="搬家行业无合同乱加价 消费者受损难维权"/></a></dt><dd>搬家公司准入门槛低，而索赔难、收费乱、无合同最让市民上火</dd></dl>
<div class="o"></div>
<ul>
<li><a href="http://baike.v-get.com/view/64.html">怎么选择搬家公司省钱又方便？</a></li>
<li><a href="http://baike.v-get.com/view/65.html">搬家风水与搬迁禁忌习俗</a></li>
<li><a href="http://baike.v-get.com/view/7.html">托运丢货只赔300元 打官司获全赔</a></li>
<li><a href="http://baike.v-get.com/view/11.html">国际货运代理的法律地位和责任划分</a></li>
<li><a href="http://baike.v-get.com/view/210.html">国际货运船舶不适航导致货物损坏案</a></li>
<li><a href="http://baike.v-get.com/view/214.html">物流企业该怎么开发客户呢？</a></li>
</ul>
</div>
<div class="f rfa mg">
<h4>商务新闻</h4>
<div class="a"><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/214.html">义乌快递年后忙不停</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/199.html">长沙物流50年不过时</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/195.html">骗取邮费诈骗升级</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/192.html">物流“最后一公里”</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/184.html">物流园空置率高？</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/182.html">上海冷链物流已成规模</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/151.html">物流园区转型升级</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/148.html">“长江上游航运中心”</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/134.html">中国物流效率太低！</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/119.html">网络物流人才建设</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/109.html">高端搬家市场空白</a><a href="http://localhost/wuliu.v-get.com/news/2013-01-01/2013-01-01/87.html">货运代理的唯一出路</a></div>
<div class="o">
</div>

</div>
<div class="a250x250 mg"></div>
</div>

<div class="o"></div>
</div>
<div class="o mh"></div>
<div class="b w">
<p class="bn"><a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">合作分销</a>|<a href="#">人才招聘</a>|<a href="#">网上兼职</a>|<a href="#">合作加盟</a>|<a href="#">广告服务</a>|<a href="#">合作伙伴</a>|<a href="#">E维公益</a>|<a href="#">投诉建议</a>|<a href="#">网站地图</a>|<a href="#">法律声明</a></p><p>商务物流 版权所有 ICP备12013909号</p><p>Copyright &copy; 2012-2013<a href="http://www.v-get.com/">V-Get.com</a>All Right Reserved.</p><div class="ba a"><a href="http://s.v-get.com/l?l=www.saic.gov.cn/"></a><a href="http://s.v-get.com/l?l=www.cnnic.cn"></a><a href="http://s.v-get.com/l?l=www.cyberpolice.cn"></a><a href="http://s.v-get.com/l?l=www.szfw.org"></a></div>
</div>


<script language="javascript">
J('http://localhost/www.v-getimg.com/i0/s2/f.js');
</script>

</body></html>
