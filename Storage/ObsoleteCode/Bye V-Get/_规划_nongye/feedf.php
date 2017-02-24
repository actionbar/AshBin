<?php
require('c.php');

$I=$_GET['i'];


$t=mysql_query('SELECT * FROM c WHERE i='.$I);
$T=mysql_fetch_array($t);
$H=$T['h'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title><?php echo $H;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link media="all" href="f.css" type="text/css" rel="stylesheet" />
<link media="all" href="http://localhost:8080/v-get.com/nongye/f.css" type="text/css" rel="stylesheet" />
<link href="http://localhost:8080/v-get.com/c/favicon.ico" type="image/ico" rel="shortcut icon" />
<script type="text/javascript" src="http://localhost:8080/v-get.com/c/c.js"></script>
<body>
<div class="w"><!--{star:主导航 --><!--{start: 主导航 -->

<div class="t">
<div class="p"><a href="www" name="t"><strong>V-Get！</strong></a>-<a href="">国际</a>- <a href="">国内</a>-<a href="">社会</a>-<a href="">台海</a>-<a href="" >军事</a>-<a href="" >财经</a>-<a href="" >科技</a>-<a href="" >汽车</a>-<a href="" >娱乐</a>-<a href="">篮球</a>-<a href="" >图片</a>-<a href="" >历史</a>-<a href="" >旅游</a>-<a href="" >健康</a>-<a href="" >论坛</a>-<a href="" >博客</a>-<a href="" >直播</a>-<a href="" >英文网</a></div><div class="q"><a href="" >登录|注册</a></div> 
</div>


<div class="w2">
<img src="http://localhost:8080/v-get.com/c8/950x90/nyff1.jpg"/>
</div>

<div class="n"><span><a href="">V-Get!</a>&gt;<a href="">微农业</a>&gt;<a>正文</a></span> 
<form action="#"><input type="text" class="YS0" value="请输入关键字" name="word"/><input type="submit" class="YS1"  value="搜索" /></form>
 <select><option>所有</option><option>文章</option><option>下载</option></select>
</div>



<div class="o v">
<div class="p l">
<div class="c">
<h1><?php echo $H;?></h1>
<div class="c2">
Nongye.v-get.com <?php echo $T['t'];?>&nbsp;&nbsp;<?php echo $T['z'];?><span><a href="#yd">讨论(58)</a></span><span>字号:【<a href="javascript:fs(16)">大</a><a href="javascript:fs(14)">中</a><a href="javascript:fs(12)">小</a>】</span><span><a href="javascript:">全文阅读</a></span></div>

<div class="cn">
<div class="p cnl">
<ul>
<li><a href="">一二三四五六七八九十一共有二十个汉字长度</a></li>
<li><a href="">用5行目的是为了左边广告图片美观</a></li>
<li><a href="">这里是相关相似文章</a></li>
<li><a href="">这里是相关相似文章</a></li>
<li><a href="">这里是相关相似文章</a></li>
</ul>
</div>
<div class="q cnt"><img src="http://localhost:8080/v-get.com/c8/250x130/GG2.jpg"/></div>
</div>

<div id="c">
<?php 
echo $T['f'];
?>
</div>

<div class="cn">
<div class="p"><img src="http://localhost:8080/v-get.com/c8/250x130/GG2.jpg"/></div>
<div class="q cnl">
<ul>
<li><a href="">一二三四五六七八九十一共有二十个汉字长度</a></li>
<li><a href="">用5行目的是为了左边广告图片美观</a></li>
<li><a href="">这里是相关相似文章</a></li>
<li><a href="">这里是相关相似文章</a></li>
<li><a href="">这里是相关相似文章</a></li>
</ul>
</div>
</div>

<div class="cb">
<span><a href="#yd">讨论(58)</a></span><span>字号:【<a href="javascript:fs(16)">大</a><a href="javascript:fs(14)">中</a><a href="javascript:fs(12)">小</a>】</span><span><a href="javascript:">全文阅读</a></span><span><a href="javascript:">打印预览</a></span><span><a href="#t" name="yd">上移顶部</a></span>
</div>
</div>

<div class="l2">
<div class="l2v"><a href="#">超级广告区，已经对SEO优化了；使用H2</a></div>
<div class="l2c"><img src="http://localhost:8080/v-get.com/c8/640x90/GG4.jpg"/></div>
<div class="l2v"><a href="">小标题可以是广告</a><a href="#">也可以是内容</a><a href="#">也可以是内容</a><a href="#">也可以是内容</a><a href="#">也可以是内容</a></div>
</div>

<div class="lb">
<div class="m">
<form action="#" method="post" name="mform" target="_parent" id="mform" onsubmit="return do_submit(this)">
<p><a class="YD1" href="">我要评论</a><a href="">查看评论(1550)</a><span><a href="#">登陆/注册</a><input type="submit" class="fb1"  value="发布" /></span></p>
<textarea  name="ma" maxlength="254">为了避免浪费资源，就仿造sohu  sina huanqiu格样不用直接下面显示评论，单独评论页面</textarea> 
</form>
</div>

<div class="lb2">
<img src="http://localhost:8080/v-get.com/c8/580x90/369179_585-90.jpg"/>
</div>
<div class="lb3">
<h2><a href="" >热点排行</a></h2>
<ul>
  <li><a href="">媒体称救灾显露日本自卫队机动能力世界第一</a></li>
  <li><a href="">外媒评世界十大空军：中国第5 位列英以之后</a></li>
  <li><a href="">日称军舰再遭中国飞机迫近 向中方抗议(图)</a></li>
  <li><a href="">强化围堵中国：美试图在印境内部署反导武器</a></li>
  <li><a href="">美称陷10年战争泥潭 中国军力首次接近美军</a></li>
</ul></div>

<div class="lb4">
<h2>图片新闻</h2>
<ul>
  <li><div class="XB2_1"><span><a href="">国际</a></span><a href=""><img src="http://localhost:8080/v-get.com/c8/120x90/a.jpg"/></a></div><p><a href="">美国一攻击机在德坠毁</a></p></li>
  <li><div class="XB2_1"><span><a href="">中国</a></span><a href=""><img src="http://localhost:8080/v-get.com/c8/120x90/a.jpg"/></a></div><p><a href="">北川公墓鲜花寄哀思</a></p></li>
  <li><div class="XB2_1"><span><a href="">台海</a></span><a href=""><img src="http://localhost:8080/v-get.com/c8/120x90/a.jpg"/></a></div><p><a href="">比基尼冠军赴高雄议会</a></p></li>
  <li><div class="XB2_1"><span><a href="">财经</a></span><a href=""><img src="http://localhost:8080/v-get.com/c8/120x90/a.jpg"/></a></div><p><a href="">赵本山沈阳豪宅似皇宫</a></p></li>
</ul></div>

</div>

</div>
  
  
  
<div class="r">
<div class="rv ri">
<img src="http://localhost:8080/v-get.com/c8/310x250/nyffri_1.jpg"/>
</div>

<div class="rv r2">
<h2>媒体头条</h2>
<h3><a href="">陕西：咸阳一酒店1斤羊肉饺子116元 店员"这是店内规定"</a></h3>
<ul class="rc">
  <li>【<a href="">农业</a>】<a href="">上海：喜看金山农民发"羊"财(图)</a></li>
  <li>【<a href="">物流</a>】<a href="">英媒称利比亚反对派武装中出现&ldquo;不明身份&rdquo;士兵</a></li>
  <li>【<a href="">物流</a>】<a href="">日本警方加强网络监控 严防震灾谣言扩散</a></li>
  <li>【<a href="">物流</a>】<a href="">多地公布乳企审核情况 部分地区淘汰率达50%</a></li>
  <li>【<a href="">物流</a>】<a href="">女子遭罚掌掴交警：随便叫个局长就让你下岗</a></li>  
  <li>【<a href="">物流</a>】<a href="">菅直人称平息福岛第一核电站事故是持久战</a></li>
  <li>【<a href="">物流</a>】<a href="">英媒称利比亚反对派武装中出现&ldquo;不明身份&rdquo;士兵</a></li>
  <li>【<a href="">物流</a>】<a href="">日本警方加强网络监控 严防震灾谣言扩散</a></li>
  <li>【<a href="">物流</a>】<a href="">多地公布乳企审核情况 部分地区淘汰率达50%</a></li>
  <li>【<a href="">物流</a>】<a href="">女子遭罚掌掴交警：随便叫个局长就让你下岗</a></li></ul>
</div>

<div class="rv ri">
<img src="http://localhost:8080/v-get.com/c8/310x250/nyffri_1.jpg"/>
</div>

<div class="rv">
<h2><a>视觉焦点</a></h2>
<ul class="rvi">
  <li><a title="拥有航母的一大好处" href=""><img src="BD/d1906ab5ca.jpg" /></a><p><a href="">拥有航母的一大好处</a></p></li>
  <li><a title="利比亚反对派跪地祈祷" href=""><img src="BD/2e34e668b1.jpg" /></a><p><a href="">利比亚反对派跪地祈祷</a></p></li>
  <li><a title="全球最疯狂的震撼超载" href=""><img src="BD/92bedca7c1.jpg" /></a><p><a href="">全球最疯狂的震撼超载</a></p></li>
  <li><a title="孟加拉的悲惨性工作者" href=""><img src="BD/e887dbe330.jpg" /></a><p><a href="">孟加拉的悲惨性工作者</a></p></li>
</ul></div>







<div class="rv">
<h2><a title="环球论坛" href="YR6">环球论坛</a></h2>
<ul class="rvi">
  <li><a href=""><img src="BD/cc00af2363.jpg" /></a><p><a href="">居日华人震时生活</a></p></li>
  <li><a href=""><img src="BD/04d6a52a11.jpg" /></a><p><a href="">王伟烈士私家照</a></p></li>
</ul>
<ul class="rc">
  <li><a href="">日教科书侵占钓鱼岛 不见百名专家抗议</a></li>
  <li><a href="">白皮书强调尊守国际法：为海外驻军准备</a></li>
  <li><a href="">俄报：千名美海军陆战队员正前往利比亚</a></li>
  <li><a href="">韩国俄罗斯寸土不让　中国拱手相让</a></li>
  <li><a href="">再次被辱：援日燃油必须运至西南港口</a></li>
</ul></div>
</div>

</div><!--}end:XA--><!--{start: 主导航 -->

</div>

<script>function fs(x){$('c').style.fontSize=x+'px'}</script>
</body></html>
