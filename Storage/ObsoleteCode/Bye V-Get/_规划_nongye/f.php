<?php
require('c.php');

$I=$_GET['v'];
$A=1;
$B=1;
$a=array('','宠物','家居花草','季节植物','常年植物','牲畜','禽鸟','淡水两栖','海产滩涂','昆虫');
$b=array('','新闻动态','价格趋势','选中育种','环境配置','养殖重点','疾病治愈','加工处理','误区百科','养殖分享');
$t=mysql_query('SELECT * FROM c WHERE i='.$I);
$T=mysql_fetch_array($t);
$H=$T['h'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title><?php echo $H;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link media="all" href="http://localhost/www.v-get.com/nongye/f.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://localhost/www.v-get.com/c/i.js"></script>
<body>
<div class="w"><!--{star:主导航 --><!--{start: 主导航 -->

<div class="t">
<div class="p"><a href="www" name="t"><strong>V-Get！</strong></a>-<a href="">国际</a>- <a href="">国内</a>-<a href="">社会</a>-<a href="">台海</a>-<a href="" >军事</a>-<a href="" >财经</a>-<a href="" >科技</a>-<a href="" >汽车</a>-<a href="" >娱乐</a>-<a href="">篮球</a>-<a href="" >图片</a>-<a href="" >历史</a>-<a href="" >旅游</a>-<a href="" >健康</a>-<a href="" >论坛</a>-<a href="" >博客</a>-<a href="" >直播</a>-<a href="" >英文网</a></div><div class="q"><a href="" >登录|注册</a></div> 
</div>


<div class="w2">
首部
</div>

<div class="n"><span><a href="">V-Get!</a>&gt;<a href="">V-Get! 农业网</a>&gt;<a>正文</a></span> 
<form action="#"><input type="text" class="YS0" value="请输入关键字" name="word"/><input type="submit" class="YS1"  value="搜索" /></form>
 <select><option>所有</option><option>文章</option><option>下载</option></select>
</div>



<div class="o v">
<div class="l">
<div class="c">
<h1><?php echo $H;?></h1>
<div class="c2">
Feed.v-get.com <?php echo $T['t'];?>&nbsp;&nbsp;<?php echo $T['z'];?><span><a href="#yd">讨论(58)</a></span><span>字号:【<a href="javascript:fs(16)">大</a><a href="javascript:fs(14)">中</a><a href="javascript:fs(12)">小</a>】</span><span><a href="javascript:">全文阅读</a></span></div>

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
<div class="q cnt"><img src="http://localhost/www.v-get.com/p2/250x130/5.jpg" /></div>
</div>

<div id="c">
<?php 
echo $T['f'];
?>
</div>

<div class="cn">
<div class="p"><img src="http://localhost/www.v-get.com/p2/250x130/5.jpg" /></div>
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
<div class="l2c"><img src="BD/GG4.jpg" /></div>
<div class="l2v"><a href="">小标题可以是广告</a><a href="#">也可以是内容</a><a href="#">也可以是内容</a><a href="#">也可以是内容</a><a href="#">也可以是内容</a></div>
</div>

<div class="lb">
<div class="YD">
<form action="#" method="post" name="mform" target="_parent" id="mform" onsubmit="return do_submit(this);">
<p><a class="YD1" href="">我要评论</a><a href="">查看评论(1550)</a><span><a href="#">登陆/注册</a><input type="submit" class="fb1"  value="发布" /></span></p>
<textarea  name="area_message" maxlength="254">为了避免浪费资源，就仿造sohu  sina huanqiu格样不用直接下面显示评论，单独评论页面</textarea> 
</form>
</div>

<div class="lb2">
这里广告区
</div>
<div class="lb3">
<h2><a href="" >新闻48小时评论排行</a></h2>
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
  <li><div class="XB2_1"><span><a href="">国际</a></span><a href=""><img src="BD/098eb4273c.jpg" /></a></div><p><a href="">美国一攻击机在德坠毁</a></p></li>
  <li><div class="XB2_1"><span><a href="">中国</a></span><a href=""><img src="BD/3d212b0692.jpg" /></a></div><p><a href="">北川公墓鲜花寄哀思</a></p></li>
  <li><div class="XB2_1"><span><a href="">台海</a></span><a href=""><img src="BD/53e8abd7a2.jpg" /></a></div><p><a href="">比基尼冠军赴高雄议会</a></p></li>
  <li><div class="XB2_1"><span><a href="">财经</a></span><a href=""><img src="BD/6728a85d0c.jpg" /></a></div><p><a href="">赵本山沈阳豪宅似皇宫</a></p></li>
</ul></div>

</div>

</div>
  
  
  
<div class="r">

<div class="YR2">
<h2><a id="DA0" href="#" onmouseover="Xoo(0,1,0)" onmouseout="XCti()">每日推荐</a><a id="DA1" href="#" onmouseover="Xoo(0,1,1)" onmouseout="XCti()">视频推荐</a></h2>
<div><h3><a href="">利政府拒绝反对派有条件停火要求</a></h3>
<ul>
  <li><a href="">菅直人称平息福岛第一核电站事故是持久战</a></li>
  <li><a href="">英媒称利比亚反对派武装中出现&ldquo;不明身份&rdquo;士兵</a></li>
  <li><a href="">日本警方加强网络监控 严防震灾谣言扩散</a></li>
  <li><a href="">多地公布乳企审核情况 部分地区淘汰率达50%</a></li>
  <li><a href="">女子遭罚掌掴交警：随便叫个局长就让你下岗</a></li></ul></div>
</div>

<div class="YR2">
<h2><span><a>视觉焦点</a></span></h2>
<ul class="YRG">
  <li><a title="拥有航母的一大好处" href=""><img src="BD/d1906ab5ca.jpg" /></a><p><a href="">拥有航母的一大好处</a></p></li>
  <li><a title="利比亚反对派跪地祈祷" href=""><img src="BD/2e34e668b1.jpg" /></a><p><a href="">利比亚反对派跪地祈祷</a></p></li>
  <li><a title="全球最疯狂的震撼超载" href=""><img src="BD/92bedca7c1.jpg" /></a><p><a href="">全球最疯狂的震撼超载</a></p></li>
  <li><a title="孟加拉的悲惨性工作者" href=""><img src="BD/e887dbe330.jpg" /></a><p><a href="">孟加拉的悲惨性工作者</a></p></li>
</ul></div>


<div class="YR2">
<h2><span><a href="">环球博客</a></span></h2>
<ul>
  <li><a href="">蔡成平：日本震后重建对我国的影响</a></li>
  <li><a href="">美国为何不再直接参与空袭利比亚</a></li>
  <li><a href="">中国不能总当&ldquo;中东牌局&rdquo;的旁观者</a></li>
  <li><a href="">朝外交官称卡扎菲放弃核武&ldquo;很傻&ldquo;</a></li>
  <li><a href="">清明节：走进墓地与亲人说说不老的怀念</a></li>
</ul></div>


<div class="YR2">
<h2><span><a href="#">社会图集</a></span></h2>
<ul class="YRG">
  <li><a href=""><img src="BD/6f3d3f453a.jpg" /></a><p><a href="">少年戒毒不成爬墙轻生</a></p></li>
  <li><a href=""><img src="BD/595bc120e2.jpg" /></a><p><a href="">美女站轿车上求婚遭拒</a></p></li>
  <li><a href=""><img src="BD/9b1160c30a.jpg" /></a><p><a href="">世界最牛九大柔术大师</a></p></li>
  <li><a href=""><img src="BD/0d3b575a2a.jpg" /></a><p><a href="">日本&ldquo;狗坚强&rdquo;终获救</a></p></li>
</ul></div>


<div class="YR2">
<h2><span><a title="环球论坛" href="YR6">环球论坛</a></span></h2>
<ul class="YRG">
  <li><a href=""><img src="BD/cc00af2363.jpg" /></a><p><a href="">居日华人震时生活</a></p></li>
  <li><a href=""><img src="BD/04d6a52a11.jpg" /></a><p><a href="">王伟烈士私家照</a></p></li>
</ul>
<ul>
  <li><a href="">日教科书侵占钓鱼岛 不见百名专家抗议</a></li>
  <li><a href="">白皮书强调尊守国际法：为海外驻军准备</a></li>
  <li><a href="">俄报：千名美海军陆战队员正前往利比亚</a></li>
  <li><a href="">韩国俄罗斯寸土不让　中国拱手相让</a></li>
  <li><a href="">再次被辱：援日燃油必须运至西南港口</a></li>
</ul></div>


<div class="YR2">
<h2><span><a>热点专题</a></span></h2>
<ul>
  <li><a href="">乌鲁木齐一公交车与火车相撞</a></li>
  <li><a href="">解读日本核电站爆炸</a></li>
  <li><a href="">&ldquo;发现号&rdquo;终极之旅</a></li>
  <li><a href="">台媒关注日本地震</a></li>
  <li><a href="">利比亚&ldquo;空袭&rdquo;全球经济</a></li>
</ul></div>


<div class="YR2">
<h2><span><a href="#">点击排行</a></span>
<a id="DB0" href="#" onmouseover="Xoo(1,3,0)" onmouseout="XCti()">新闻</a>
<a id="DB1" href="#" onmouseover="Xoo(1,3,1)" onmouseout="XCti()">军事</a>
<a id="DB2" href="#" onmouseover="Xoo(1,3,2)" onmouseout="XCti()">台海</a>
<a id="DB3" href="#" onmouseover="Xoo(1,3,3)" onmouseout="XCti()">财经</a></h2>
<div id="B_0">
<ol>
  <li><a href="">中国加紧研新超级计算机 美夺回桂冠未可知</a></li>
  <li><a href="">对利战争或引爆军售市场 中国武器将受追捧</a></li>
  <li><a href="">日称军舰再遭中国飞机迫近 向中方抗议(图)</a></li>
  <li><a href="">美称陷10年战争泥潭 中国军力首次接近美军</a></li>
  <li><a href="">西方若给利反对派武器会被卡扎菲缴获将丢人</a></li>
  <li><a href="">印智库称东盟不团结 南海争端无力对付中国</a></li>
  <li><a href="">美刊剖析我海军发展方向 称舰队模式将仿美</a></li>
  <li><a href="">我专家评西方或用贫铀弹空袭利比亚：不人道</a></li>
  <li><a href="">利反对派称只要卡扎菲军停止进攻就准备停火</a></li>
</ol></div>
<div id="B_1" style="DISPLAY: none">
<ol>
  <li><a href="">利比亚反对派官员称西方轰炸反政府军系&ldquo;误会&rdquo;</a></li>
  <li><a href="">2011全球最美女性排行榜：你最中意哪一个</a></li>
  <li><a href="">利反对派临时政府对反政府军遭轰炸表示&ldquo;遗憾&rdquo;</a></li>
  <li><a href="">卡扎菲之子被指可能正考虑背叛父亲</a></li>
  <li><a href="">河南富家子领补助 校方：贫困生爱面子不申报</a></li>
  <li><a href="">民政部回应公墓20年后续费：墓穴只有使用权</a></li>
  <li><a href="">卡扎菲：该下台的不是我 而是西方国家领导人</a></li>
  <li><a href="">利比亚反对派鸣枪庆祝胜利 引北约战机误炸13人死</a></li>
  <li><a href="">利比亚有关银行向中国提出保函延期申请</a></li>
</ol></div>
<div id="B_2" style="DISPLAY: none">
<ol>
  <li><a href="">中国加紧研新超级计算机 美夺回桂冠未可知</a></li>
  <li><a href="">对利战争或引爆军售市场 中国武器将受追捧</a></li>
  <li><a href="">日称军舰再遭中国飞机迫近 向中方抗议(图)</a></li>
  <li><a href="">美称陷10年战争泥潭 中国军力首次接近美军</a></li>
  <li><a href="">泰国借中国火箭炮技术研首款国产火箭炮(图)</a></li>
  <li><a href="">西方若给利反对派武器会被卡扎菲缴获将丢人</a></li>
  <li><a href="">印智库称东盟不团结 南海争端无力对付中国</a></li>
  <li><a href="">美刊剖析我海军发展方向 称舰队模式将仿美</a></li>
  <li><a href="">我专家评西方或用贫铀弹空袭利比亚：不人道</a></li>
</ol></div>
<div id="B_3" style="DISPLAY: none">
<ol>
  <li><a href="">李敖广东演讲：我最佩服共产党能够富国强兵</a></li>
  <li><a href="">台中将：两岸合作捍卫民族疆域防止列强再侵略</a></li>
  <li><a href="">陈菊主动要求7月能与市议长一起登陆行销高雄</a></li>
  <li><a href="">台湾前高官：大陆核安技术成功　欧美做不成</a></li>
  <li><a href="">邱毅吁两岸建军事互信 称不做美遏制大陆棋子</a></li>
  <li><a href="">黑人太长! 范范砸重金订做大床好&ldquo;办事&rdquo;(图)</a></li>
  <li><a href="">澳媒吁台青年关心&ldquo;民族前途&rdquo; 推进两岸统一</a></li>
  <li><a href="">台媒：苏贞昌两岸论述暴露对两岸关系的贫乏性</a></li>
  <li><a href="">台&ldquo;外长&rdquo;：百亿捐款说明台日历史等方面很密切</a></li>
</ol></div>
</div>
</div>

</div><!--}end:XA--><!--{start: 主导航 -->

</div>

<script>function fs(x){$('c').style.fontSize=x+'px'}</script>
</body></html>
