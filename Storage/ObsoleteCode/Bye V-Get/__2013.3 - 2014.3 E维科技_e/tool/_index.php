<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4);
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新e.v-get.com/host/'.$filename.'.html ？</a>';
exit;
}

require '../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');
require '../_/tool_app.php';
$file=constant('uploadFile').'tool/'.$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{

$text=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'ir.css" /><title>站长工具查询，尽在站长工具_E维科技_V-Get!</title><meta name="keywords" content="站长工具,PR查询,SEO工具,网站工具,网站查询"/><meta name="description" content="站长工具查询，尽在E维科技站长之家。您可以用站长工具查询SEO数据变化、Alexa网站排名查询、友情链接批量检测、检测网站死链、蜘蛛访问、HTML格式检测、网站速度测试、友情链接检查、网站域名IP查询、PR、权重查询、Whois查询等"/>';

$text.=TUN('tool');
$text.='<div class="m mb">当前位置：<a href="'.constant('LK').'">E维科技</a> &gt;&gt; 站长工具</div><div class="v"><div class="p f l"><div class="lv" id="d"><h4 class="lh">站长工具</h4><ul>';
foreach($TOOL_APP as $tool_left=>$tool_left_more){
if($tool_left_more[0]==0||$tool_left_more[1]==0||$tool_left_more[2]==0){
$text.='<li><a href="'.constant('LK').'tool/'.$tool_left.'.html">'.$tool_left_more[5].'</a></li>';
}
}
$text.='</ul></div><div class="lc"><h4>服务流程</h4><ul><li><a href="'.constant('LK').'web/service.html">a. 客户选择建站产品</a></li><li class="lc2"></li><li><a href="'.constant('LK').'host/domain.html">b. 注册域名</a></li><li class="lc2"></li><li><a href="'.constant('LK').'host/">c. 选购主机空间</a></li><li class="lc2"></li><li><a href="'.constant('LK').'web/service_b2.html">d. 网站维护</a></li><li class="lc2"></li><li><a href="'.constant('LK').'sem/">e. 搜索引擎SEO优化</a></li><li class="lc2"></li><li><a href="'.constant('LK').'web/service_b5.html">f. 广告营销</a></li><li class="lc2"></li><li><a href="'.constant('LK').'soho/">g. 网站全托管</a></li></ul></div></div><div class="q r"><div class="c f mb"><h4>站长工具</h4><div class="a vv0a">';
foreach($TOOL_APP as $tool=>$tool_more){
if($tool_more[0]==0||$tool_more[1]==0||$tool_more[2]==0){
$text.='<a href="'.constant('LK').'tool/'.$tool.'.html" title="'.$tool_more[5].'"><img width="64" height="64" src="'.constant('LTP_8').'64/'.$tool.'.gif" alt="'.$tool_more[5].'"/><br>'.$tool_more[4].'</a>';
}
}
$text.='<div class="o"></div></div></div><div class="mb a728x90">'.constant('A728x90a').'</div><div class="rwb f"><h4>站长工具导航</h4><div class="rv"><ul><li>网站信息查询：<a href="http://e.v-get.com/tool/alexa_rank.html">ALEXA排名查询</a>-<a href="http://e.v-get.com/tool/google_pr.html">Google PR查询</a>-<a href="#">收录/反链查询</a>-<a href="#">死链接检测/全站PR查询</a>-<a href="#">网页GZIP压缩检测</a>-<a href="http://e.v-get.com/tool/google_pr.html">PR输出值查询</a></li><li>搜索优化查询：<a href="#">长尾关键字</a><a href="#">友情链接检测</a><a href="#">关键词排名查询</a><a href="#">关键词密度查询</a><a href="#">搜索引擎模拟</a><a href="#">网页META信息</a><a href="#">百度收录</a><a href="#">百度权重查询</a></li><li>域名IP类查询：<a href="#">域名删除时间查询</a><a href="http://e.v-get.com/tool/domain_whois.html">域名WHOIS查询</a><a href="http://e.v-get.com/tool/ip_address.html">IP查询</a><a href="#">IP WHOIS查询</a><a href="#">同IP网站查询</a><a href="#">备案查询</a><a href="#">过期域名查询</a><a href="#">Dns查询</a><a href="#">NsLookup</a></li><li>加密解密相关：<a href="http://e.v-get.com/tool/code_md5.html">MD5加密</a>-<a href="#">文字加密解密</a>-<a href="#">ESCAPE加/解密</a>-<a href="#">BASE64加/解密</a>-<a href="#">URL加密</a>-<a href="#">迅雷,快车,旋风URL加/解密</a></li><li>编码转换相关：<a href="#">Ascii/Native编码互转</a>-<a href="#">Unicode编码</a>-<a href="#">UTF-8编码</a>-<a href="#">简繁体火星文互转</a>-<a href="#">汉字转换拼音</a>-<a href="#">Unix时间戳</a>-<a href="http://e.v-get.com/tool/urlencode_urldecode.html">URL编码/解码</a></li><li>HTML相关类： <a href="#">HTML/JS互转</a>-<a href="#">HTML/UBB代码转换</a>-<a href="#">HTML标签检测</a>-<a href="#">HTML代码转换器</a>-<a href="#">JS/HTML格式化</a>-<a href="http://e.v-get.com/tool/code_ascii.html">HTML特殊符号对照表</a></li><li>Js/Css相关类： <a href="#">JS加/解密</a>-<a href="#">JS代码混淆</a>-<a href="http://e.v-get.com/tool/html_editor.html">CSS在线编辑器</a>-<a href="#">Css压缩/格式化</a>-<a href="#">JS混淆加密压缩</a>-<a href="#">正则在线测试</a></li><li>其他常用测试：<a href="#">查看网页源代码</a>-<a href="#">拼音字典</a>-<a href="#">OPEN参数生成器</a>-<a href="#">网页代码调试器</a>-<a href="#">在线调色板</a>-<a href="#">网页颜色选择器</a>-<a href="#">颜色代码查询</a></li><li>其他类别查询：<a href="#">SEO数据风向标</a><a href="#">PR更新历史</a><a href="#">大小写转换</a><a href="#">路由器追踪</a><a href="#">HTTP状态查询</a><a href="#">超级Ping</a><a href="#">端口扫描</a><a href="#">网速测试</a><a href="#">虚拟主机评测</a><a href="#">91查</a></li></ul></div></div></div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().constant('TONGJI').'</script></div></body></html>';
file_put_contents($file,$text);}
?>