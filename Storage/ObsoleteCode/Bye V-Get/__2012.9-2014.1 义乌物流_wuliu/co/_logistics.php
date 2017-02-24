<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.php?</a>';
exit;
}
require '../_/co.php';
$file=constant('uploadFile').'/co/'.$filename.'.php';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$text='<?php '.constant('CO_SQL').'$Qq=mysql_query(\'SELECT co.b,co.h,co.he,co.k,co.d,co.a,co.m,co.g,co.r,co.q,co.lt,co.x,co.y,co.z,co.zz,co.t,co.adt,coi.h AS ih,coi.p AS ip,coi.x AS ix FROM co LEFT JOIN coi ON co.e=coi.e WHERE co.e="\'.$E.\'"\');$Qr=mysql_num_rows($Qq);if($Qr==0){header(\'Location: http://wuliu.v-get.com/\');exit();}$Qa=mysql_fetch_array($Qq);$B=$Qa[\'b\'];$H=$Qa[\'h\'];$K=$Qa[\'k\'];$Z=$Qa[\'z\'];$LT=$Qa[\'lt\'];$TA=$Qa[\'adt\'];$now=time();$ad=($TA>$now)?false:true;echo \'<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>网站地图_\',$H,\'_\',$Z,$K,\'_商务物流网_V-Get!</title><meta name="keywords" content="\',$K,\'" /><meta name="description" content="\',$H,\'网站地图，承接\',$Z,\'服务。\',$Qa[\'d\'],\'"/>\';?>'.COTUN($filename).'<div class="q r"><div class="o mh"></div><div class="m cc"><div>您现在的位置：<?php echo \'<a href="http://\',$E,\'.wuliu.v-get.com/">\',$H,\'</a>\';?> &gt; 网站地图</div></div><div class="mf"><?php echo \'<h3><a href="http://\',$E,\'.wuliu.v-get.com/logistics/about.html">关于我们</a></h3><p>\',$Qa[\'a\'],\'</p><h3><a href="http://\',$E,\'.wuliu.v-get.com/logistics/services.html">我们的服务</a></h3><p>\',$Qa[\'e\'],\'</p><h3><a href="http://\',$E,\'.wuliu.v-get.com/logistics/honor.html">我们的荣誉</a></h3><p>\',$Qa[\'g\'],\'</p><h3><a href="http://\',$E,\'.wuliu.v-get.com/logistics/exhibition.html">企业展厅</a></h3><div class="a h3a">\';while($Qa=mysql_fetch_array($Qq)){echo \'<a href="http://\',$E,\'.wuliu.v-get.com/logistics/exhibition.html?i=\',$Qa[\'ix\'],\'&show=\',$Qa[\'ip\'],\'">\',$Qa[\'ih\'],\'（图）</a>\';}echo \'</div><div class="o"></div><h3><a href="http://\',$E,\'.wuliu.v-get.com/logistics/news.html">新闻公告</a></h3><p>及时发布公司新闻、物流招聘信息、物流价格、与运营状况交流的公告系统，方便广大客户快速了解<?php echo $H;?>发展动态。</p><h3><a href="http://\',$E,\'.wuliu.v-get.com/logistics/contact.html">联系我们</a></h3><p>全面的、详细的公司联系方式和地图标记，让您直观的查询到\',$H,\'的联络方式和地理位置。</p><h3><a href="http://\',$E,\'.wuliu.v-get.com/logistics/faq.html">常见问题</a></h3><p>挑选最常用的物流问答案例，让客户更快捷的了解公司的服务状况。常见问题仅作为商务物流网参考，具体详细问题请通过“<a href="http://\',$E,\'.wuliu.v-get.com/logistics/contact.html">联系我们</a>”与\',$H,\'沟通询问，获得最新、最可靠的回答。</p>\';?></div></div><div class="o mh"></div>'.constant('CO_VBB');
file_put_contents($file,$text);}
?>