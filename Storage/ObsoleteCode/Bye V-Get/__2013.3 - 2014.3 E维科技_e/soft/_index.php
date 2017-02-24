<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4);
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新e.v-get.com/host/'.$filename.'.html ？</a>';
exit;
}

require '../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'soft/'.$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{$id_out='';

$text=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'ir.css" /><title>应用软件开发定制_E维科技_V-Get!</title><meta name="keywords" content="应用开发,app开发,软件开发,软件定制"/><meta name="description" content="E维科技倾心为企业定制应用软件开发、网站建设营销推广和移动电子商务利用手机、iPad、掌上电脑等实现企业功能性优化，节约企业生产力。E维科技，专注网络营销！"/>';

$text.=TUN('soft');
$text.='<div class="m mb">当前位置：<a href="'.constant('LK').'">E维科技</a> &gt;&gt; 软件设计</div><div class="v"><div class="p f l"><div class="lv" id="d"><h4 class="lh">主机域名</h4><ul><li><a href="'.constant('LK').'host/domain.html">域名注册查询</a></li><li><a href="'.constant('LK').'host/free.html">免费虚拟主机</a></li><li><a href="'.constant('LK').'host/virtual.html">FTP服务器空间</a></li><li><a href="'.constant('LK').'host/vps.html">VPS主机服务器</a></li><li><a href="'.constant('LK').'host/cloud.html">传统独享云主机</a></li><li><a href="'.constant('LK').'host/server.html">服务器托管租用</a></li><li><a href="'.constant('LK').'host/icp_beian.html">工信部域名备案</a></li></ul></div><div class="lc"><h4>购买流程</h4><ul><li><a href="'.constant('LK').'web/service.html">a. 客户选择主机类型</a></li><li class="lc2"></li><li><a href="'.constant('LK').'host/domain.html">b. 联系客服付费</a></li><li class="lc2"></li><li><a href="'.constant('LK').'host/">c. 获取主机账号</a></li><li class="lc2"></li><li><a href="'.constant('LK').'web/service_b2.html">d. 查询使用指南</a></li></ul></div><div class="lv mb"><h4>软件资讯</h4><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=6 '.$id_out.' ORDER BY t DESC LIMIT 10');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.SUB($Qa['h'],13).'</a></li>';}

$text.='</ul></div><div><h4>帮助中心</h4><div id="lii"><p><a href="http://e.v-get.com/open/php-frame.html">框架大全</a><a href="http://e.v-get.com/">源码下载</a></p><p class="lic"><a href="http://e.v-get.com/open/php-social.html">论坛源码</a><a href="http://e.v-get.com/tech/u/SEO_1.html">SEO教程</a></p><p><a href="http://e.v-get.com/open/php-shop.html">PHP商城</a><a href="http://e.v-get.com/open/php-soft.html">开发软件</a></p><p class="lic"><a href="http://e.v-get.com/tech/">码农笑话</a><a href="http://e.v-get.com/s?sk=Discuz">Discuz !</a></p></div></div></div><div class="q r f"><h4>软件开发<span> Software Development</span></h4><div class="mf"><p>企业现代化管理可以使用计算机软件来优化很多传统流程，可以节约很多劳动成本和时间。义乌的楼先生1995年在国际商贸城开了一家财务公司，以前楼先生需要招聘很多财务专业的员工来统计财务数据。在统计数据时，需要反复核查很多遍，而即使这么小心的核查，也有时候会出现很多细小的问题，过多的员工让楼先生的财务公司陷入困境……</p><div id="cda" class="f a"><a href="#" class="cda">服务内容</a><a href="#">开发过程</a></div><div class="o"></div><div class="cd"><div class="fo mf"><img src="'.constant('LTP_8').'r/1.jpg" width="500" height="293" alt="iPhone App开发"/></div><h3>软件开发离我们到底有多远？</h3><p>很多人会觉得企业用不到定制软件，或者觉得软件离自己很远。其实软件就在我们身边！</p><p>App 是英文Application的简称，由于iPhone等智能手机的流行，现在的APP多指智能手机的第三方应用程序。目前比较著名的App商店有Apple的iTunes商店里面的App Store，Android的Google Play Store，诺基亚的ovi store，还有Blackberry用户的BlackBerry App World，以及微软的应用商城。</p><p>苹果的iOS系统，app格式有ipa，pxl，deb，谷歌的Android系统，app格式为APK，诺基亚的S60系统，APP格式有sis，sisx，微软的WindowsPhone系统，app格式为xap。</p><div class="fo mf"><img src="'.constant('LTP_8').'r/2.jpg" width="500" height="276" alt="手机应用软件开发"/></div><p>一开始APP只是作为一种第三方应用的合作形式参与到互联网商业活动中去的，随着互联网越来越开放化，APP作为一种萌生与iPhone的盈利模式开始被更多的互联网商业大亨看重，如腾讯的微博开发平台，百度的百度应用平台都是</p><p>APP思想的具体表现，一方面可以积聚各种不同类型的网络受众，另一方面借助APP平台获取流量，其中包括大众流量和定向流量。</p><p>物联网时代的到来，使用手机自动开车，回家了自动开门，工厂不同温度的时候用电脑自动根据气温调整空调温度，节约能源……物流公司可以利用软件自动查询物流状态，财务公司可以使用财务软件自动化计算数据，食品工厂利用软件自动调馅搅拌，利用软件可以自动化给员工批量购买过年的火车票和信息统计……</p><p>&nbsp;</p></div><div class="cd"><div class="fo mf"><img src="'.constant('LTP_8').'r/3.jpg" width="321" height="312" alt="E维科技软件开发五大特性"/></div><div class="fo mf"><img src="'.constant('LTP_8').'r/4.jpg" width="600" height="586" alt="E维科技软件开发流程"/></div></div></div></div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0('F2()').constant('TONGJI').'</script></div></body></html>';
file_put_contents($file,$text);}
?>