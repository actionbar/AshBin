<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 


if(!isset($_GET['sure'])){

echo '<a href="?sure=ok">确定更新e.v-get.com/host/'.$filename.'.html ？</a>';
exit;
}

require '../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'host/'.$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$id_out='';

$text=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'ir.css" /><title>域名注册_域名查询_免费域名_域名注册查询_E维科技_V-Get!</title><meta name="keywords" content="域名注册,域名查询,免费域名,域名注册查询"/><meta name="description" content="E维科技——领先的域名注册查询服务商。高效的域名查询方便用户选择到最佳的域名注册。金牌品质，值得信赖！域名注册8元起！。E维科技，一切只为网络营销！"/>';

$text.=TUN('host');
$text.='<div class="m mb">当前位置：<a href="'.constant('LK').'">E维科技</a> &gt;&gt; <a href="'.constant('LK').'host/">主机域名</a> &gt;&gt; 域名注册查询</div><div class="v"><div class="p f l"><div class="lv" id="d"><h4 class="lh">主机域名</h4><ul><li><a href="'.constant('LK').'host/domain.html" class="do">域名注册查询</a></li><li><a href="'.constant('LK').'host/free.html">免费虚拟主机<img width="28" height="20" src="'.constant('LTU').'g/hot1.gif"/></a></li><li><a href="'.constant('LK').'host/virtual.html">FTP服务器空间<img width="28" height="20" src="'.constant('LTU').'g/hot2.gif"/></a></li><li><a href="'.constant('LK').'host/vps.html">VPS主机服务器</a></li><li><a href="'.constant('LK').'host/cloud.html">传统独享云主机<img width="28" height="20" src="'.constant('LTU').'g/hot3.gif"/></a></li><li><a href="'.constant('LK').'host/server.html">服务器托管租用</a></li><li><a href="'.constant('LK').'host/icp_beian.html">工信部域名备案</a></li></ul></div><div class="lc"><h4>购买流程</h4><ul><li><a href="'.constant('LK').'web/service.html">a. 客户选择主机类型</a></li><li class="lc2"></li><li><a href="'.constant('LK').'host/domain.html">b. 联系客服付费</a></li><li class="lc2"></li><li><a href="'.constant('LK').'host/">c. 获取主机账号</a></li><li class="lc2"></li><li><a href="'.constant('LK').'web/service_b2.html">d. 查询使用指南</a></li></ul></div><div class="lv mb"><h4>域名资讯</h4><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE m="Domain" '.$id_out.' ORDER BY t DESC LIMIT 10');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.SUB($Qa['h'],13).'</a></li>';}

$text.='</ul></div><div><h4>帮助中心</h4><div id="lii"><p><a href="http://e.v-get.com/open/php-frame.html">框架大全</a><a href="http://e.v-get.com/">源码下载</a></p><p class="lic"><a href="http://e.v-get.com/open/php-social.html">论坛源码</a><a href="http://e.v-get.com/tech/u/SEO_1.html">SEO教程</a></p><p><a href="http://e.v-get.com/open/php-shop.html">PHP商城</a><a href="http://e.v-get.com/open/php-soft.html">开发软件</a></p><p class="lic"><a href="http://e.v-get.com/tech/">码农笑话</a><a href="http://e.v-get.com/s?sk=Discuz">Discuz !</a></p></div></div></div><div class="q r"><style type="text/css">#c li{line-height:28px;height:28px}.c1 li{float:left;width:67px}.c1 li input{margin:0 3px}._9,._9 th,._9 td{border:none}._9 tr{border-bottom:#ddd 1px solid}._8 {border-top:#ddd 1px solid;list-style-position:inside;list-style-type:square}._8 li{border-bottom:#ddd 1px solid;padding:0 25px;line-height:28px;white-space:normal}._t{text-align:center;color:#0075B5;font-weight:700}._7{list-style-type:disc}</style><div class="rt mb"><img src="'.constant('LTP_8').'728x90/h1.jpg" width="728" height="90" alt="E维科技专业主机服务商"/></div><div class="c f mb"><h4>域名注册查询</h4><div class="mf"><form id="cs"><div class="cs"><input type="text" name="sk" class="csk" /><input type="submit" value="" class="css" /></div></form><div id="c"><div class="c1"><ul><li><input type="checkbox" checked="checked" value="com"/>.com</li><li><input type="checkbox" checked="checked" value="cn"/>.cn</li><li><input type="checkbox" checked="checked" value="com.cn"/>.com.cn</li><li><input type="checkbox" checked="checked" value="biz"/>.biz</li><li><input type="checkbox" checked="checked" value="net"/>.net</li><li><input type="checkbox" value="net.cn"/>.net.cn</li><li><input type="checkbox" checked="checked" value="co"/>.co</li><li><input type="checkbox" checked="checked" value="org"/>.org</li><li><input type="checkbox" value="org.cn"/>.org.cn</li><li><input type="checkbox" value="name"/>.name</li><li><input type="checkbox" value="info"/>.info</li><li><input type="checkbox" value="gov.cn"/>.gov.cn</li><li><input type="checkbox" value="tv"/>.tv</li><li><input type="checkbox" value="cc"/>.cc</li></ul></div><div class="o mb"></div></div><table><tr><th>域名名称</th><th>域名种类</th><th>直接客户价格</th></tr><tr><td>英文国际域名</td><td>.com/.net/.org</td><td>￥65.00元/1年 </td></tr><tr><td>Info国际域名</td><td>.info </td><td>￥350.00元/1年</td></tr><tr><td>Biz国际域名</td><td>.biz </td><td>￥220.00元/1年</td></tr><tr><td>英文CC域名</td><td>.cc </td><td>￥320.00元/1年</td></tr><tr><td>手机mobi域名</td><td>.mobi </td><td>￥160.00元/1年</td></tr><tr><td>TV国际域名</td><td>.tv </td><td>￥500.00元/1年</td></tr><tr><td>香港国际域名</td><td>.hk</td><td>￥400.00元/1年</td></tr></table></div></div></div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0('J("'.constant('LTU_8').'t/i.js",function(){$("cs").sk.value=$k("sk")?$k("sk"):"";domain_name()})').constant('TONGJI').'</script></div></body></html>';
file_put_contents($file,$text);
}
?>