<?php
$c=mysql_connect("localhost","nsa1Ako","fch6895_EgN");mysql_select_db("v7",$c);mysql_query("set names utf8");$p=empty($_GET['p'])?1:$_GET['p'];$P=($p-1)*20;
//这里是列表，不用descrition和keyword最好，这样好自动调取，避免重复
?><!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>新闻列表_V-Get News</title><link href="http://weigeti.com/p0/favicon.ico" type="image/ico" rel="shortcut icon"/><link rel="stylesheet" type="text/css" href="http://baike.v-get.com/f.css" /><style type="text/css">.c{padding:13px;width:616px}#m{height:28px;line-height:28px;background:#E5ECF9;border:#E5ECF9 1px solid;border-radius:3px;padding:0 9px}.pg{text-align:right;height:28px;line-height:28px}.pg a{margin:0 5px}.pg .po{color:#999;text-decoration:none}#c{padding:0 50px 0 11px;width:555px;border-top:#e5ecf9 1px solid;border-bottom:#e5ecf9 1px solid}#c a{text-decoration:underline;color:#00c}#c div{margin:15px 0}#c h2{font-size:14px;line-height:20px}#c h2 a{margin-right:15px}#c h2 a:visited{color:#810081}#c h2 span{color:#666;font-size:11px;font-weight:400}#c p{line-height:22px}#c p a{color:#7A77C8}</style></head><script type="text/javascript" src="http://weigeti.com/p0/c.js"></script><body><div class="w"><div class="t"><a href="http://www.v-get.com/">V-Get!首页</a>-<a href="http://news.v-get.com/">新闻</a>-<a href="http://baike.v-get.com/">百科</a>-<a href="http://wuliu.v-get.com/">物流</a></div><div class="n"><div class="p i"><img i="http://weigeti.com/p0/v7b.gif" /></div><div class="q s"><form action="http://www.google.com/search" target="_blank"><input name="hl" value="zh-CN" type="hidden"/><input name="domains" value="v-get.com" type="hidden"/><input name="ie" value="utf-8" type="hidden"/><select name="sitesearch"><option value="v-get.com">全网</option><option value="news.v-get.com"/>新闻</option><option value="baike.v-get.com"/>百科</option><option value="wuliu.v-get.com"/>物流</option></select><input name="q" id="sk" type="text"><input type="submit" value="搜索" class="ss" /></form></div></div><div class="o v"><div class="p l"><div class="f c"><div id="m">您的位置：<a href="http://www.v-get.com/">V-Get!首页</a>&nbsp;&gt;&nbsp;<a href="http://news.v-get.com/">商务新闻</a>&nbsp;&gt;&nbsp;新闻列表</div>
<?php
$ry=mysql_query("SELECT COUNT(*) FROM f");
$rq=mysql_query("SELECT * FROM f ORDER BY t DESC LIMIT $P,20");
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/20);$pg='';
if($Pz>1){
$Pp=$p-1;$Pn=$p+1;
$Pq=($Pp==1)?'':'_'.$Pp;
switch ($p)
{ case 1:$pg='<div class="pg"><a class="po">首页</a><a class="po">前一页&lt;</a>第<b>1</b>页<a href="http://news.v-get.com/list/index_2.html" target="_self">&gt;下一页</a><a href="http://news.v-get.com/list/index_'.$Pz.'.html" target="_self">共'.$Pz.'页</a></div>';break;
 case $Pz:$pg='<div class="pg"><a href="http://news.v-get.com/list/index_1.html" target="_self">首页</a><a href="http://news.v-get.com/list/index_'.$Pp.'.html" target="_self">前一页&lt;</a>第<b>'.$p.'</b>页<a class="po">&gt;下一页</a><a class="po">第'.$p.'页</a></div>';break;
  default:$pg='<div class="pg"><a href="http://news.v-get.com/list/index_1.html" target="_self">首页</a><a href="http://news.v-get.com/list/index_'.$Pp.'.html" target="_self">前一页&lt;</a>第<b>'.$p.'</b>页<a href="http://news.v-get.com/list/index_'.$Pn.'.html" target="_self">&gt;下一页</a><a href="http://news.v-get.com/list/index_'.$Pz.'.html" target="_self">第'.$Pz.'页</a></div>';break;
}}
$pg='';
echo $pg.'<div id="c">';

while($r=mysql_fetch_array($rq)){
$I=$r['i'];
echo '<div><h2><a href="http://news.v-get.com/view/'.$I.'.html" target="_blank">'.$r['h'].'</a><span>'.$r['t'].'</span></h2><p>'.$r['d'].'<a href="http://www.google.com.hk/search?hl=zh-CN&domains=v-get.com&sitesearch=v-get.com&ie=utf-8&q=%E4%B9%89%E4%B9%8C'.$r['k'].'&x=0&y=0">相似阅读</a></p></div>';
}
echo '</div>'.$pg;
echo '</div></div>';
?>
<div class="q r"><div class="rw"><script type="text/javascript">var cpro_id="u1132461"</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div><div class="f rw"><h5>每日推荐</h5><ul class="pu"><li><a href="http://wuliu.v-get.com/426"><img i="http://weigeti.com/p2/3a/426.gif" alt="义乌江东货运市场托运部"/></a><br /><a href="http://yiwu.wuliu.v-get.com/tuoyun/?sc=2&sk=%E6%B1%9F%E4%B8%9C%E8%B4%A7%E8%BF%90%E5%B8%82%E5%9C%BA">江东货运市场全国第一</a></li><li><a href="http://wuliu.v-get.com/281"><img i="http://weigeti.com/p2/3a/281.gif" alt="义乌国际快递"/></a><br /><a href="http://yiwu.wuliu.v-get.com/huodai/?sc=0&sk=%E5%9B%BD%E9%99%85%E5%BF%AB%E9%80%92">快递单号及运费查询</a></li></ul><ul class="ru"><li><a href="http://baike.v-get.com/view/7.html">高额货物丢失托运只赔300元 打官司要求全赔</a></li><li><a href="http://baike.v-get.com/view/20.html">没办COC证书的货物出口承运损失该怎么办？</a></li>
<li><a href="http://baike.v-get.com/view/3.html">货代公司良莠不齐 该怎样辨提单陷阱慧眼能识</a></li>
<li><a href="http://baike.v-get.com/view/21.html">国际集装箱运输方式整箱FCL和拼箱LCL</a></li>
<li><a href="http://baike.v-get.com/view/19.html">国际货运代理投保责任险，获得全额赔偿</a></li>
<li><a href="http://baike.v-get.com/view/30.html">义乌宾王客运中心</a> <a href="http://baike.v-get.com/view/31.html">宾王客运中心票价及时刻表</a></li>
<li><a href="http://baike.v-get.com/view/287.html">不可不说的外贸潜规则</a> <a href="http://baike.v-get.com/view/285.html">外贸管制及报关规范</a></li>
</ul>
</div>
<div class="f rw"><h5>热点导读</h5>
<ul class="pu"><li><a href="http://wuliu.v-get.com/504"><img i="http://weigeti.com/p2/3a/504.gif" alt="MSC地中海航运公司"/></a><br /><a href="http://yiwu.wuliu.v-get.com/huodai/">MSC地中海航运公司</a></li><li><a href="http://wuliu.v-get.com/502"><img i="http://weigeti.com/p2/3a/502.gif" alt="APL美国总统轮船公司"/></a><br /><a href="http://yiwu.wuliu.v-get.com/huodai/?sc=0&sk=%E8%88%B9%E5%85%AC%E5%8F%B8">美国总统轮船APL公司</a></li></ul>
<ul class="ru">
<li><a href="http://baike.v-get.com/view/23.html">Combined Transport by Rail and Sea</a></li>
<li><a href="http://baike.v-get.com/view/22.html">International Multimodai Transport</a></li>
<li><a href="http://baike.v-get.com/view/24.html">集装箱运输—国际多式联运IMT的优势是什么？</a></li>
<li><a href="http://baike.v-get.com/view/56.html">外贸公司丢失了出口退税票据该怎么办呢？</a></li>
<li><a href="http://baike.v-get.com/view/50.html">《中华人民共和国进出口商品检验法》</a></li>
<li><a href="http://baike.v-get.com/view/46.html">国际货运集装箱出口通关操作流程[货代必知]</a></li>
<li><a href="http://baike.v-get.com/view/41.html">国际贸易进出口货运操作全套单证[外贸必备]</a></li>
</ul>
</div>
<div class="f rw"><h5>视觉商感</h5>
<ul class="pu"><li><a href="http://wuliu.v-get.com/748"><img i="http://weigeti.com/p2/3a/748.gif" alt="义乌立方速国际货运"/></a><br /><a href="http://yiwu.wuliu.v-get.com/huodai-4/?sc=0&sk=%E5%9B%BD%E9%99%85%E8%B4%A7%E8%BF%90">义乌立方速国际货运</a></li><li><a href="http://wuliu.v-get.com/465"><img i="http://weigeti.com/p2/3a/465.gif" alt="义乌金来国际货运代理公司"/></a><br /><a href="http://yiwu.wuliu.v-get.com/huodai/">义乌金来货运代理公司</a></li><li><a href="http://wuliu.v-get.com/279"><img i="http://weigeti.com/p2/3a/279.gif" alt="义乌力拓国际货运代理公司"/></a><br /><a href="http://yiwu.wuliu.v-get.com/huodai/?sc=0&sk=%E8%B4%A7%E8%BF%90%E4%BB%A3%E7%90%86">义乌力拓货运代理公司</a></li><li><a href="http://wuliu.v-get.com/498"><img i="http://weigeti.com/p2/3a/498.gif" alt="义乌泛远国际物流公司"/></a><br /><a href="http://yiwu.wuliu.v-get.com/huodai-2/?sc=0&sk=%E5%9B%BD%E9%99%85%E7%89%A9%E6%B5%81">义乌泛远国际物流公司</a></li></ul>
<div class="o"></div></div>
<div class="f rw">
<ul class="pu"><li><a href="http://wuliu.v-get.com/41706">义乌吉飞国际快递专线</a></li><li><a href="http://wuliu.v-get.com/278">义乌安邦国际快递公司</a></li><li><a href="http://wuliu.v-get.com/1071">义乌→江苏选通如托运</a></li><li><a href="http://wuliu.v-get.com/41166">义乌汇成国际货运报关</a></li><li><a href="http://wuliu.v-get.com/203">义乌定远货运代理公司</a></li><li><a href="http://wuliu.v-get.com/318">义乌发发搬家家政公司</a></li><li><a href="http://yiwu.wuliu.v-get.com/keyun/">义乌长途大巴联系方式</a></li><li><a href="http://yiwu.wuliu.v-get.com/cangku/">外贸来义乌怎么找仓库</a></li>
<li><a href="http://wuliu.v-get.com/714">上海铭顺货运广州专线</a></li><li><a href="http://wuliu.v-get.com/414">上海文昌物流宁波专线</a></li></ul>
<div class="o" style="height:5px"></div>
</div>
<div class="f rw"><h5>热点导读</h5><ul class="ru"><li><a href="http://baike.v-get.com/view/62.html">外贸公司该怎么安全操作出口托收及快速到账？</a></li>
<li><a href="http://baike.v-get.com/view/57.html">国际物流中怎么填写海运提单 (Ocean B/L)？</a></li>
<li><a href="http://baike.v-get.com/view/63.html">L/C信用证付款</a> <a href="http://baike.v-get.com/view/61.html">托收付款</a> <a href="http://baike.v-get.com/view/60.html">T/T电汇付款</a></li>
<li><a href="http://baike.v-get.com/view/55.html">外贸出口公司如何申请办理出口退税业务？</a></li>
<li><a href="http://baike.v-get.com/view/54.html">外贸业务员必知出口货物退税是什么！</a></li>
<li><a href="http://www.v-get.com/view/wuliu/51.html">办理出口许可证及其申请表内容规范</a></li>
<li><a href="http://baike.v-get.com/view/48.html">商业发票CI</a> <a href="http://baike.v-get.com/view/49.html">形式发票PI</a> <a href="http://baike.v-get.com/view/47.html">装箱单PL</a> <a href="http://baike.v-get.com/view/53.html">手册报关</a></li>
<li><a href="http://baike.v-get.com/view/45.html">国际货运中如何发送和交接国际集装箱</a></li>
<li><a href="http://baike.v-get.com/view/40.html">国际物流集装箱场站各类货物的装箱操作指南</a></li>
</ul>
</div>
</div>
</div>
<div class="o"></div>
<div class="b">
<p class="f bt">
<a href="http://help.v-get.com/about.html">关于我们</a>|<a href="http://help.v-get.com/partners.html">合作伙伴</a>|<a href="#">营销中心</a>|<a href="http://help.v-get.com/contact.html">联系我们</a>|<a href="http://www.v-get.com/sitemap.html">网站地图</a>|<a href="#">微个体网</a>|<a href="http://help.v-get.com/copyright.html">版权声明</a>
</p><p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a> <a href="http://www.miibeian.gov.cn/" rel="nofollow" style="color:#666">ICP12013909</a> All Right Reserved</p>
</div>
</div><div style="display:none"><script type="text/javascript">Q();A();var _bdhmProtocol=(("https:"==document.location.protocol)?" https://":" http://");document.write(unescape("%3Cscript src='"+_bdhmProtocol+"hm.baidu.com/h.js%3F0beb0f56d3bdf553f93a39ec3856a6a9' type='text/javascript'%3E%3C/script%3E"));</script></div><script type="text/javascript">var cpro_id = "u1132441";</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>
</body></html>