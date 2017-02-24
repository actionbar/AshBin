<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">Are U Sure To Refresh '.$filename.'.php?</a>';
exit;
}

require '../_/global.php';
require '../_/z.php';

$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'z/'.$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$id_out='';

$text=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('V0').'f.css" /><link rel="stylesheet" type="text/css" href="'.constant('V0_e').'tech/f.css" /><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>关于E维科技_V-Get!</title><meta name="keywords" content="E维科技,网络营销"/><meta name="description" content="E维科技诚邀站长技术、网络科技、网络营销、SEO等相关技术网站交换友情链接，共同交流网站技术。提高网站PR排名，友情连接网自动审核！">';

$text.=TUN(0);

$text.='<div class="o mh"></div><div class="mg a960x60">'.constant('A960x60a').'</div><div class="v"><div class="p l"><div class="c">'.ZAtab($filename).'<div class="o mh"></div><div class="mf"><p>E维科技网络营销公司（e.v-get.com）隶属于微商务网（www.v-get.com），是致力于在中国市场提供互联网战略营销顾问服务的专业公司，公司对互联网广告整合营销和推广有着独特的想法和构思，突破传统的营销模式，提倡大胆开放式的营销策略。</p><p>E维科技探索中国品牌营销发展的本地化、中西合璧、国际化营销策略，协助企业拥有正确的网络营销策略和执行方案。E维科技在企业网络营销上坚持为企业提供一站式网络营销产品，所谓一站式网络营销是指帮助客户从网站建站、内容维护、广告推广、效果转化。</p><h2 style="color:#0774C7;font:bold 16px \'微软雅黑\';height:40px;line-height:40px">E维科技网络营销服务内容：</h2><h3 style="margin:9px 0 0;height:28px;line-height:28px;color:#0774C7;font:bold 15px \'微软雅黑\'">搜索引擎优化营销 <span style="color:#888;font-weight:400;font-size:12px;font-family:arial"> Search Engine Optimization</span></h3><p>搜索引擎优化营销是指SEO、关键词广告、关键词竞价排名、搜索引擎定位广告。搜索引擎在网络营销中的地位尤其重要，每天各行各业的人使用搜索引擎搜索信息。通过搜索引擎营销能直接带来流量与终端客户。 </p><p>E维科技通过对客户网站进行整站优化，挑选出部分主关键词，配合其他营销方式，使其达到搜索引擎的首页位置，同时提高网站的权重，并带动更多长尾关键词的自然排名的提升。再结合搜索引擎竞价，制定出精确的竞价关键词和优秀的创意内容，给客户带来更多的订单。</p><h3 style="margin:9px 0 0;height:28px;line-height:28px;color:#0774C7;font:bold 15px \'微软雅黑\'">微信微博口碑营销 <span style="color:#888;font-weight:400;font-size:12px;font-family:arial"> Word of Mouth Marketing</span></h3><p>口碑营销是指企业努力使消费者通过亲朋好友之间的交流将自己的产品信息、品牌传播开来。这种营销方式成功率高、可信度强，这种以口碑传播为途径的营销方式，称为口碑营销。从企业营销的实践层面分析，口碑营销是企业运用各种有效的手段，引发企业的顾客对其产品、服务以及企业整体形象的谈论和交流，并激励顾客向其周边人群进行介绍和推荐的市场营销方式和过程。 </p><p>据E维科技网络调查研究，31%的被采访对象肯定他们的朋友会购买自己推荐的产品。26%的被采访对象会说服朋友不要买某品牌的产品。由此可见，消费者对潜在消费者的推荐或建议，往往能够促成潜在消费者的购买决策。 </p><p>E维科技在互联网中拥有众多的门户网站、媒体、行业网站、论坛、博客、SNS资源，并且与很多微博大号、微信名人有密切的合作，为消费者提供需要的产品和服务，同时制定合理的口碑推广计划，让消费者自动传播企业产品和服务的良好评价，从而让人们通过口碑了解产品、树立品牌、加强市场认知度，最终达到企业销售产品和提高企业形象的目的。</p><h3 style="margin:9px 0 0;height:28px;line-height:28px;color:#0774C7;font:bold 15px \'微软雅黑\'">软广告营销 <span style="color:#888;font-weight:400;font-size:12px;font-family:arial"> Marketing of Soft Article</span></h3><p>软文营销是连同新闻、公关、主题促销等一系列销售系统所组成的最新的营销方式。通过借助文字表达与舆论传播使消费者认同某种概念、观点和分析思路，从而达到企业品牌宣传、产品销售的目的。</p><p>E维科技拥有专业、经验丰富的软文写手以及文案策划人员，利用丰富的门户网站、媒体资源，以强有力的针对性心理攻击迅速实现产品销售的文字模式和口头传软文营销传播，让企业信息覆盖上千万人的眼球。从而扩大企业的品牌知名度和美誉度，提升企业的形象，增加企业的销售收入。 </p><p>E维科技拥有500多家门户网站、媒体资源，与众多门户网站、媒体建立了良好的合作关系，并有机会与新浪、腾讯、网易、搜狐、百度、雅虎等大型资讯站编辑合作。</p><h3 style="margin:9px 0 0;height:28px;line-height:28px;color:#0774C7;font:bold 15px \'微软雅黑\'">广告直推营销 <span style="color:#888;font-weight:400;font-size:12px;font-family:arial"> Marketing of Advertising</span></h3><p>搜索引擎优化做的再好，在百度平台上也比不上百度推广用户排名。所以直推广告对于快速提升企业品牌有非常高效的作用，而直推广告价格比较昂贵，随着假广告等因素，不少网民一看的“推广”二字的网站基本都有排斥心理，而结合其他营销方式才能更高效的提升企业品牌价值。直接通过网站的广告位置进行投放推广，可以直接借用其他网络媒体推广。 </p><p>E维科技针对企业网站找出正确有效的广告投放媒体，通过制定专业的广告投放计划，利用媒体公开而广泛地向公众宣传企业网站、企业信息和形象，从而扩大企业品牌影响力。用较低的广告费用，来达到较好的效果。</p><h3 style="margin:9px 0 0;height:28px;line-height:28px;color:#0774C7;font:bold 15px \'微软雅黑\'">病毒式营销策略 <span style="color:#888;font-weight:400;font-size:12px;font-family:arial"> Viral Marketing</span></h3><p>病毒式营销利用的是用户口碑传播的原理。在互联网上，这种“口碑传播”更为方便，可以像病毒一样迅速蔓延，因此病毒式营销（病毒性营销）成为一种高效的信息传播方式，而且，由于这种传播是用户之间自发进行的，因此几乎是不需要费用的网络营销手段。</p><p>通过爆炸性的营销话题，让推广信息在互联网上指数传播，病毒式营销和传统行销相比，受众自愿接受的特点使得成本更少，收益更多更加明显。</p><ul><li>意见反馈：<a href="http://e.v-get.com/i/topic-56-1.html" style="color:#2a7ec4">http://e.v-get.com/i/topic-56-1.html</a></li><li>网站论坛：<a href="http://e.v-get.com/i/" style="color:#2a7ec4">http://e.v-get.com/i/</a></li></ul></div></div></div><div class="q r">';
/* 读取由_.php生成的_.html 并且修改后的_.html *//* 这里是tech文章右侧，服务器不需要有，所以本地 */
$htmlrt=fopen('_.html','r') or exit("Unable to open file!");
while(!feof($htmlrt)){$text.=fgets($htmlrt);}
fclose($htmlrt);

$text.='</div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().'J("'.constant('LTU').'fd.js");'.constant('TONGJI').'</script></div>'.constant('ADxuanfu').'</body></html>';
file_put_contents($file,$text);}
?>