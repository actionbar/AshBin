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

$text=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'ir.css" /><title>免费ICP工信部网站域名备案查询_E维科技_V-Get!</title><meta name="keywords" content="ICP,工信部,ICP备案,网站备案,域名备案,备案,免费备案"/><meta name="description" content="ICP备案查询网,工业和信息化部ICP/IP地址/域名信息备案查询平台、工信部网站免费备案查询。提供ICP备案查询,网站备案查询,域名备案查询,查备案号,API调用,不用输验证码,速度快,数据实时更新。E维科技，一切只为网络营销！"/>';

$text.=TUN('host');
$text.='<div class="m mb">当前位置：<a href="'.constant('LK').'">E维科技</a> &gt;&gt; <a href="'.constant('LK').'host/">主机域名</a> &gt;&gt; ICP域名备案</div><div class="v"><div class="p f l"><div class="lv" id="d"><h4 class="lh">主机域名</h4><ul><li><a href="'.constant('LK').'host/domain.html">域名注册查询</a></li><li><a href="'.constant('LK').'host/free.html">免费虚拟主机<img width="28" height="20" src="'.constant('LTU').'g/hot1.gif"/></a></li><li><a href="'.constant('LK').'host/virtual.html">FTP服务器空间<img width="28" height="20" src="'.constant('LTU').'g/hot2.gif"/></a></li><li><a href="'.constant('LK').'host/vps.html">VPS主机服务器</a></li><li><a href="'.constant('LK').'host/cloud.html">传统独享云主机<img width="28" height="20" src="'.constant('LTU').'g/hot3.gif"/></a></li><li><a href="'.constant('LK').'host/server.html">服务器托管租用</a></li><li><a href="'.constant('LK').'host/icp_beian.html" class="do">工信部域名备案</a></li></ul></div><div class="lc"><h4>购买流程</h4><ul><li><a href="'.constant('LK').'web/service.html">a. 客户选择主机类型</a></li><li class="lc2"></li><li><a href="'.constant('LK').'host/domain.html">b. 联系客服付费</a></li><li class="lc2"></li><li><a href="'.constant('LK').'host/">c. 获取主机账号</a></li><li class="lc2"></li><li><a href="'.constant('LK').'web/service_b2.html">d. 查询使用指南</a></li></ul></div><div class="lv mb"><h4>备案资讯</h4><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE (m="Domain" OR h LIKE "%ICP%" OR f LIKE "%ICP%" OR h LIKE "%备案%" OR f LIKE "%备案%" OR f LIKE "%工信部%") '.$id_out.' ORDER BY t DESC LIMIT 10');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.SUB($Qa['h'],13).'</a></li>';}

$text.='</ul></div><div><h4>帮助中心</h4><div id="lii"><p><a href="http://e.v-get.com/open/php-frame.html">框架大全</a><a href="http://e.v-get.com/">源码下载</a></p><p class="lic"><a href="http://e.v-get.com/open/php-social.html">论坛源码</a><a href="http://e.v-get.com/tech/u/SEO_1.html">SEO教程</a></p><p><a href="http://e.v-get.com/open/php-shop.html">PHP商城</a><a href="http://e.v-get.com/open/php-soft.html">开发软件</a></p><p class="lic"><a href="http://e.v-get.com/tech/">码农笑话</a><a href="http://e.v-get.com/s?sk=Discuz">Discuz !</a></p></div></div></div><div class="q r"><div class="rt mb"><img src="'.constant('LTP_8').'728x90/h1.jpg" width="728" height="90" alt="E维科技专业主机服务商"/></div><div class="c f mb"><h4>ICP域名备案</h4><div class="mf"><form id="cs"><div class="cs"><input type="text" name="sk" class="csk" /><input type="submit" value="" class="css" /></div></form><div id="c"></div><div class="vh7c"><p>根据中华人民共和国国务院、信息产业部等相关部门公布的《互联网信息服务管理办法》及《非经营性互联网信息服务备案管理办法》（中华人民共和国信息产业部令第33号）等互联网相关法律法规的规定：非经营性网站必须履行备案手续。经营性网站需要去当地通信管理局办理ICP许可证。购买香港,美国,韩国等海外空间则无需备案。</p><p><h5>网站未进行ICP备案的风险</h5><p>为了规范网络安全化，维护网站经营者的合法权益，保障网民的合法利益，促进互联网行业健康发展，全国将不间断的开展对国内各大小网站（包括企业及个人站点）的严格审查工作，对于没有合法备案的网站，根据网站性质，将予以罚款，严重的关闭网站，以此规范网络安全，打击一切利用网络资源进行不法活动的犯罪行为。</p><P>根据工信部电管（2010）64号文件《工业和信息化部关于进一步落实网站备案信真实性核验工作方案》从2010年6.20日开始执行网站备案需拍照。</p><h5>主体为个人</h5><p>网站负责人携带与初审合格上传资料一致的个人有效证件原件、核验单、信息安全管理协议原件各一式两份进行核验；</p><h3>特殊管局要求，另需携带以下资料：</h3><p>陕西、重庆、湖北、浙江地区备案客户需携带域名证书复印件进行核验；</p><p>湖南需携带域名证书彩色打印件进行核验；</p><p>湖北个人性质证件住所地址非湖北省内，须提供"湖北暂住证"；</p><p>浙江个体工商户没有公章的核验单上可以不盖章，但要在备注中说明；安全管理协议必须加盖合同章。</p><h5>主体为企业：</h5><p>网站负责人携带与初审合格上传资料一致的个人有效证件原件、核验单、信息安全管理协议原件各一式两份进行核验；</p><p>核验单必须加盖公章省份： 江苏、贵州、陕西、江西、重庆、内蒙古、湖北、湖南、西藏</p><h3>特殊管局要求，另需携带以下资料：</h3><p>陕西（主体信息下有5个或者5个以上域名的）备案客户需携带所有域名证书复印件进行核验并加盖公章；如果当面核验的不是法人，需提供法人的身份证复印件；</p><p>重庆备案客户需携带域名证书复印件、营业执照复印件（加盖单位公章）进行核验；主体负责人必须是法人，若网站负责人进行核验，需提供对应的授权书（加盖单位公章）及法人身份证；湖北备案客户需携带域名证书复印件进行核验并加盖单位公章；</p><p>湖南备案客户需携带域名证书彩色打印件进行核验；若网站负责人进行核验，需提供对应的授权书（加盖单位公章）。</p><img src="'.constant('LTP_8').'h/h7.jpg" alt="ICP域名备案流程" width="572" height="691"/></div></div></div></div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0('J("'.constant('LTU').'v8/t/i.js",function(){$("cs").sk.value=$k("sk")?$k("sk"):"";icp_beian()})').constant('TONGJI').'</script></div></body></html>';
file_put_contents($file,$text);
}