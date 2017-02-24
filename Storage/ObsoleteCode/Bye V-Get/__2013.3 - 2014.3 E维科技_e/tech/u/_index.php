<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.html?</a>';
exit;
}

require '../../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'tech/u/'.$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$text=constant('CSSJS').'<link href="'.constant('LTU_8').'tech/u.css" rel="stylesheet" type="text/css"  /><title>网络编辑_E维站长之家_V-Get!</title></head><body><div id="div1">';

$Qs='SELECT m FROM f2013 WHERE m!="V-Get" GROUP BY m';
$Qq=mysql_query($Qs,$QC);
while($Qa=mysql_fetch_array($Qq)){$M=$Qa['m'];$text.='<a href="'.constant('LK').'tech/u/'.$M.'_1.html" class="f0">'.$M.'</a>';
}
$text.='<a href="'.constant('LK').'tech/host_1.html">主机域名</a><a href="'.constant('LK').'tech/web_1.html">网站建设</a><a href="'.constant('LK').'tech/soho_1.html">云端办公</a><a href="'.constant('LK').'tech/sem_1.html">网络营销</a><a href="'.constant('LK').'tech/vi_1.html">视觉设计</a><a href="'.constant('LK').'tech/soft_1.html">软件应用</a><a href="'.constant('LK').'tech/union_1.html">网赚联盟</a><a href="'.constant('LK').'tech/notice_1.html">E维公告</a><a href="'.constant('LK').'tech/pc_1.html">计算机</a><a href="'.constant('LK').'tech/social_1.html">社交论坛</a><a href="'.constant('LK').'tech/shop_1.html">电子商务</a><a href="'.constant('LK').'tech/game_1.html">网游娱乐</a><a href="'.constant('LK').'tech/mv_1.html">影视音乐</a><a href="'.constant('LK').'tech/smart_1.html">移动互联网</a><a href="'.constant('LK').'tech/home_1.html">综合门户</a><a href="'.constant('LK').'tech/vertical_1.html">垂直网站</a><a href="'.constant('LK').'tech/se_1.html">搜索引擎</a><a href="'.constant('LK').'tech/news_1.html">业界资讯</a><a href="'.constant('LK').'tech/pioneer_1.html" class="f2">创业访谈</a><a href="'.constant('LK').'tech/ensure_1.html">网络维权</a><a href="'.constant('LK').'tech/trend_1.html">趋势传闻</a><a href="'.constant('LK').'tech/master_1.html" class="f1">站长经验</a><a href="'.constant('LK').'tech/good_1.html">作品推荐</a><a href="'.constant('LK').'tech/safe_1.html">安全防护</a><a href="'.constant('LK').'tech/manage_1.html">运营管理</a><a href="'.constant('LK').'tech/program_1.html">技术资源</a></div><div class="pn"><script type="text/javascript">$M($("div1"),280,62,874,582);'.constant('TONGJI').'</script></div></body></html>';
file_put_contents($file,$text);}
?>