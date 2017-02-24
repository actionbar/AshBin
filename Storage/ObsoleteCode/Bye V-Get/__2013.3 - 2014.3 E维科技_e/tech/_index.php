<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.html?</a>';
exit;
}

require '../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'tech/'.$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$id_out='';  /* 用于判断该id是否被用过，用过就不再用 i!=100 AND i!=201*/

$text=constant('CSSJS').'<title>站长之家，看那些有趣的科技事_E维科技_V-Get!</title><meta name="keywords" content="程序猿,站长,站长之家,站长资讯,网站运营"/><meta name="description" content="E维科技科技有趣用风趣幽默的方式把无聊烦躁的互联网科技解说的生动活泼，风趣的PHP教程网站建设教程、网络营销教程等知识网络——让我们一起来让科技更有趣吧！E维科技，一切只为网络营销！"/><link href="'.constant('VE').'tech/" rel="canonical" /><style type="text/css">';
$index_css=file_get_contents('_index.css');
$index_css=GO_INDEXCSS($index_css);
$text.=$index_css;

$text.='</style>';

$text.=TUN('tech');

$text.='<div class="o mh"></div><div class="mg">'.constant('AD960x60pic').'</div><div class="f a w5 mb"><a href="http://e.v-get.com/tech/programmer_1.html" class="f0">程序猿笑话图片论坛</a><a href="http://e.v-get.com/tool/ad_union.html" class="f0">草根站长广告联盟大全</a><a href="http://e.v-get.com/issue/godaddy.html">主机只需350元/年不限流量</a><a href="http://e.v-get.com/tech/ensure_1.html"><strong>网络维权315在行动</strong></a><a href="http://e.v-get.com/tech/sem_1.html"><strong>搜索引擎优化与网络营销技术</strong></a><a href="http://e.v-get.com/sem/"><strong>网络编辑代写SEO文章</strong></a><a href="http://e.v-get.com/tech/union_1.html"><strong>学网赚广告联盟！月入过万！</strong></a><a href="http://e.v-get.com/tech/pioneer_1.html" class="f0">互联网创业人物访谈</a><a href="http://e.v-get.com/tech/master_1.html" class="f0">站长运营经验与SEO互助</a><a href="http://e.v-get.com/tech/safe_1.html">网站病毒与安全防护</a><a href="http://e.v-get.com/tech/host_1.html"><strong class="f0">域名主机交易信息指南</strong></a><a href="http://e.v-get.com/tech/programmer_1.html"><strong>程序猿笑话与IT美女</strong></a><a href="http://e.v-get.com/tech/social_1.html"><strong class="f0">移动互联网与社交论坛媒体</strong></a><a href="http://e.v-get.com/tech/good_1.html">必备站长工具【好站推荐】</a><a href="http://e.v-get.com/i/topic-76-1.html">赚钱才是硬道理！</a><a href="http://e.v-get.com/tech/news_1.html"><strong>互联网最新资讯一手掌控</strong></a><a href="http://e.v-get.com/tech/pc_1.html"><strong class="f0">计算机硬件与服务器配置</strong></a><a href="http://e.v-get.com/tech/vi_1.html">网站美工与PS设计</a><a href="http://e.v-get.com/tech/game_1.html"><strong>游戏网游资讯不容错过</strong></a><a href="http://e.v-get.com/tech/u/SEO_1.html"><strong class="f0">百度排名优化首页怎么做到？</strong></a><div class="o"></div></div>';
$text.='<div class="mb">'.constant('AD960x60pic').'</div>';
$text.='<div class="v"><div class="f v1"><div class="p l">';
$text.='<div class="d mb po">';
$Qq=mysql_query('SELECT m FROM f2013 WHERE m!="V-Get" GROUP BY m');

while($Qa=mysql_fetch_array($Qq)){$text.='<a href="'.constant('LK').'tech/u/'.$Qa['m'].'_1.html">'.$Qa['m'].'</a>';}

$text.='</div>';
$text.='<div class="mg"><a href="http://e.v-get.com/sem/"><img src="http://tp.v-get.com/j/270x60/8_seo.gif" width="270" height="50" alt="SEO原创文章代写"></a></div>';
/* 业界资讯 */
$text.='<div class="l3"><h4><a href="'.constant('LK').'tech/news_1.html">业界资讯</a><a href="'.constant('LK').'tech/news_1.html" class="pr">更多»</a></h4>';

$i=0;$Qql3=mysql_query('SELECT i,h,d,t FROM f2013 WHERE c=1 ORDER BY t DESC LIMIT 7');



while($Ql3=mysql_fetch_array($Qql3)){
$c1I=$Ql3['i'];$id_out.=' AND i!='.$c1I;$c1T=$Ql3['t'];$c1t=strtotime($c1T);$c1t=date('Ymd/His',$c1t);
$H=$Ql3['h'];
if($i==0){$D=$Ql3['d'];$text.='<a href="'.constant('LK').'tech/'.$c1t.$c1I.'.html" class="ai"><img src="'.constant('LTP_8').'f/tech60_1.gif?d='.YMD().'" width="60" height="60" alt="'.$Ql3['h'].'"/><h3>'.$H.'</h3><p>'.SUB($D,28).'…</p></a><div class="o mh"></div>';$i++;}
else if($i==1){$D=$Ql3['d'];$text.='<a href="'.constant('LK').'tech/'.$c1t.$c1I.'.html" class="ai"><img src="'.constant('LTP_8').'f/tech60_2.gif?d='.YMD().'" width="60" height="60" alt="'.$Ql3['h'].'"/><h3>'.$H.'</h3><p>'.SUB($D,28).'…</p></a></div><div class="o mh mb"></div><ul class="rl r5">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$c1t.$c1I.'.html">'.$H.'</a></li>';}


}
$text.='</ul>';

$text.='<div class="mg"><a href="http://e.v-get.com/sem/"><img src="http://tp.v-get.com/j/270x60/8_seo.gif" width="270" height="50" alt="SEO原创文章代写"></a></div>';
$text.='</div>';

$Qqct=mysql_query('SELECT i,h,d,t FROM f2013 WHERE 1 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$D=$QCt['d'];
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$H=$QCt['h'];
$text.='<div class="p c"><a class="ct" href="'.constant('LK').'tech/'.$ctt.$ctI.'.html"><h2>'.$H.'</h2><p>'.SUB($D,53).'…</p></a>';

$text.='<div class="o mh"></div><p class="po mg"><a href="http://e.v-get.com/s?sk=AdSense">[2013 AdSense加油站报名开启]</a><a href="http://e.v-get.com/tech/" class="pr">[站长往这看！]</a></p>';

$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE a=2 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<ul class="rl"><li>[<a href="'.constant('LK').'tech/top9_1.html">置顶</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';

$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE g=9 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/top8_1.html">优秀</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE g=8 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/top3_1.html">爆料</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE g=3 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/top1_1.html">推荐</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE g=1 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/vi_1.html">视觉</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li></ul>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE a=4 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<ul class="rl"><li>[<a href="'.constant('LK').'tech/sem_1.html">营销</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE a=8 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/union_1.html">网赚</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE b=9 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/se_1.html">搜索</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE k LIKE "%SEO%" '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/u/SEO_1.html">优化</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE c=8 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/manage_1.html">运营</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li></ul>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE c=9 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<ul class="rl"><li>[<a href="'.constant('LK').'open/">开源</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE c=9 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/program_1.html">技术</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE a=7 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/programmer_1.html">码农</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE c=7 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/safe_1.html">安全</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE c=4 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/trend_1.html">趋势</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li></ul>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE b=3 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<ul class="rl"><li>[<a href="'.constant('LK').'tech/shop_1.html">电商</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE b=6 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/smart_1.html">手机</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE b=5 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/mv_1.html">影音</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE c=3 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/ensure_1.html">维权</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li>';
$Qqct=mysql_query('SELECT i,h,t FROM f2013 WHERE a=5 '.$id_out.' ORDER BY t DESC LIMIT 1');
$QCt=mysql_fetch_array($Qqct);
$ctI=$QCt['i'];$id_out.=' AND i!='.$ctI;$ctT=$QCt['t'];$ctt=strtotime($ctT);$ctt=date('Ymd/His',$ctt);
$text.='<li>[<a href="'.constant('LK').'tech/vi_1.html">设计</a>] <a href="'.constant('LK').'tech/'.$ctt.$ctI.'.html">'.$QCt['h'].'</a></li></ul></div>';

$text.='<div class="q r"><h4><a href="'.constant('LK').'tech/pioneer_1.html">创业访谈</a><a href="'.constant('LK').'tech/pioneer_1.html" class="pr">更多»</a></h4>';

$i=0;$Qqrt=mysql_query('SELECT i,h,d,t FROM f2013 WHERE c=2 '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qrt=mysql_fetch_array($Qqrt)){
$rtI=$Qrt['i'];$id_out.=' AND i!='.$rtI;$rtT=$Qrt['t'];$rtt=strtotime($rtT);$rtt=date('Ymd/His',$rtt);
if($i==0){$H=$Qrt['h'];$D=$Qrt['d'];$text.='<a href="'.constant('LK').'tech/'.$rtt.$rtI.'.html" class="ai"><img src="'.constant('LTP_8').'f/tech110x90_1.gif?d='.YMD().'" height="110" width="90" alt="'.SUB($H,11).'…"/><h3>'.$Qrt['h'].'</h3><p>'.SUB($D,43).'…</p><div class="o"></div></a><div class="o mh"></div><ul class="rl r2">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$rtt.$rtI.'.html">'.$Qrt['h'].'</a></li>';}
}
$text.='</ul>';


$text.='<div class="mg"><a href="http://e.v-get.com/tech/smart_1.html"><img src="http://tp.v-get.com/j/270x106/8_tech_0.jpg" width="270" height="90" alt="中国智能手机应用大赛"></a></div><h4 class="h4b"><a href="'.constant('LK').'tech/ensure_1.html">网络维权</a><a href="'.constant('LK').'tech/ensure_1.html" class="pr">更多»</a></h4><div class="ai">';

$i=0;$Qqr2=mysql_query('SELECT i,h,t FROM f2013 WHERE c=3 '.$id_out.' ORDER BY t DESC LIMIT 7');
while($Qr2=mysql_fetch_array($Qqr2)){
$r2I=$Qr2['i'];$id_out.=' AND i!='.$r2I;$r2T=$Qr2['t'];$r2t=strtotime($r2T);$r2t=date('Ymd/His',$r2t);
$H=$Qr2['h'];
if($i==0){$text.='<a href="'.constant('LK').'tech/'.$r2t.$r2I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_2.gif?d='.YMD().'" width="110" height="90" alt="'.$H.'"/><br>'.SUB($H,8).'</a>';$i++;}
else if($i==1){$text.='<a href="'.constant('LK').'tech/'.$r2t.$r2I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_3.gif?d='.YMD().'" width="110" height="90" alt="'.$H.'"/><br>'.SUB($H,8).'</a></div><div class="o mh"></div><ul class="rl r5">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$r2t.$r2I.'.html">'.$H.'</a></li>';}


}

$text.='</ul>';

$text.='</div><div class="o"></div></div><div class="o mh"></div><div class="f v2"><div class="p l"><h4><a href="'.constant('LK').'tech/trend_1.html">趋势传言</a><a href="'.constant('LK').'tech/trend_1.html" class="pr">更多»</a></h4>';

$i=0;$Qq=mysql_query('SELECT i,h,d,t FROM f2013 WHERE c=4 '.$id_out.' ORDER BY t DESC LIMIT 9');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$D=$Qa['d'];$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html" class="ai"><img src="'.constant('LTP_8').'f/tech60_3.gif?d='.YMD().'"/><h3>'.$H.'</h3><p>'.SUB($D,28).'…</p></a><div class="o mh mb"></div><ul class="rl r5">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}


}

$text.='</ul>';

$text.='<div class="mg a270x60"></div><h4 class="h4b"><a href="'.constant('LK').'tech/good_1.html">优秀推荐</a><a href="'.constant('LK').'tech/good_1.html" class="pr">更多»</a></h4>';

$i=0;$Qq=mysql_query('SELECT i,h,d,t FROM f2013 WHERE c=6 '.$id_out.' ORDER BY t DESC LIMIT 7');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$D=$Qa['d'];$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html" class="ai"><img src="'.constant('LTP_8').'f/tech60_4.gif?d='.YMD().'"/><h3>'.$H.'</h3><p>'.SUB($D,28).'…</p></a><div class="o mh mb"></div><ul class="rl r5">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}


}

$text.='</ul>';

$text.='<div class="a270x60"></div></div><div class="p c"><h4><a href="'.constant('LK').'tech/web_1.html">网站建设</a><a href="'.constant('LK').'tech/web_1.html" class="pr">更多»</a></h4>';


$Web=array('','<a href="'.constant('LK').'tech/master_1.html">站长</a>','<a href="'.constant('LK').'tech/vertical_1.html">垂直</a>','<a href="'.constant('LK').'tech/shop_1.html">电商</a>','<a href="'.constant('LK').'tech/pc_1.html">微机</a>','<a href="'.constant('LK').'tech/se_1.html">搜索</a>','<a href="'.constant('LK').'tech/sem_1.html">营销</a>','<a href="'.constant('LK').'tech/pioneer_1.html">创业</a>','<a href="'.constant('LK').'tech/manage_1.html">运营</a>','<a href="'.constant('LK').'tech/trend_1.html">趋势</a>','<a href="'.constant('LK').'tech/programmer_1.html">码农</a>');

$i=0;$Qq=mysql_query('SELECT i,h,d,t FROM f2013 WHERE a=2 '.$id_out.' ORDER BY t DESC LIMIT 11');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$D=$Qa['d'];$text.='<a class="ct" href="'.constant('LK').'tech/'.$t.$I.'.html"><h2>'.SUB($H,17).'</h2><p>'.SUB($D,53).'…</p></a><p class="po mg"><a href="'.constant('LK').'web/">[2013 E维科技网站建设优惠]</a><a href="'.constant('LK').'sem/" class="pr">[百度推广网络营销]</a></p><ul class="rl">';}
else {$text.='<li>['.$Web[$i].'] <a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
if($i==5){$text.='</ul><ul class="rl">';}

$i++;
}


$text.='</ul><h4><a href="'.constant('LK').'tech/pc_1.html">计算机</a><a href="'.constant('LK').'tech/pc_1.html" class="pr">更多»</a></h4><ul class="rl">';
$Pc=array('<a href="'.constant('LK').'tech/safe_1.html">安全</a>','<a href="'.constant('LK').'tech/host_1.html">主机</a>','<a href="'.constant('LK').'tech/master_1.html">站长</a>','<a href="'.constant('LK').'tech/manage_1.html">管理</a>','<a href="'.constant('LK').'tech/trend_1.html">趋势</a>','<a href="'.constant('LK').'tech/program_1.html">技术</a>','<a href="'.constant('LK').'tech/news_1.html">资讯</a>','<a href="'.constant('LK').'tech/pioneer_1.html">访谈</a>','<a href="'.constant('LK').'tech/ensure_1.html">维权</a>','<a href="'.constant('LK').'tech/vertical_1.html">垂直</a>');

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE b=1 '.$id_out.' ORDER BY t DESC LIMIT 10');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li>['.$Pc[$i].'] <a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
if($i==4){$text.='</ul><ul class="rl">';}

$i++;
}
$text.='</ul>';

$text.='</div><div class="q r"><h4><a href="'.constant('LK').'tech/u/">编辑专题</a><a href="'.constant('LK').'tech/u/" class="pr">更多»</a></h4>';
$editor_M='V-Get';
$Qq=mysql_query('SELECT h,d,m,t FROM f2013 WHERE m!="V-Get" '.$id_out.'  ORDER BY t DESC LIMIT 1');
while($Qa=mysql_fetch_array($Qq)){
$M=$Qa['m'];$editor_M=$M;
$H=$Qa['h'];$D=$Qa['d'];
$text.='<a href="'.constant('LK').'tech/u/'.$M.'_1.html" class="ai"><img src="'.constant('LTP_8').'tech/110x90'.$M.'.gif"/><h3>'.$H.'</h3><p>'.$M.'：'.SUB($D,38).'…</p><div class="o"></div></a><div class="o mh"></div>';

}

$Qq=mysql_query('SELECT h,d,m,t FROM f2013 WHERE m!="V-Get" AND m!="'.$editor_M.'" '.$id_out.'  ORDER BY t DESC LIMIT 1');
while($Qa=mysql_fetch_array($Qq)){
$M=$Qa['m'];$H=$Qa['h'];$D=$Qa['d'];
$text.='<a href="'.constant('LK').'tech/u/'.$M.'_1.html" class="ai"><img src="'.constant('LTP_8').'tech/110x90'.$M.'.gif"/><h3>'.$H.'</h3><p>'.$M.'：'.SUB($D,38).'</p><div class="o"></div></a><div class="o mh"></div>';

}
$text.='<div class="mg a270x60"></div><h4 class="h4b"><a href="'.constant('LK').'tech/u/">编辑技术</a><a href="'.constant('LK').'tech/u/" class="pr">更多»</a></h4><ul class="rl r5">';

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE m!="V-Get" '.$id_out.' ORDER BY t DESC LIMIT 11');

while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html"><strong>'.$Qa['h'].'</strong></a></li>';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}

}

$text.='</ul><div class="r9"><a href="'.constant('LK').'tool/" class="r9l">工具</a><a href="'.constant('LK').'tool/alexa_rank.html">Alexa排名</a><a href="'.constant('LK').'tool/domain_whois.html">WhoIs查询</a><a href="#">IP查询</a><a href="#">网速测试</a><a href="#">反链查询</a><a href="#">站长交易</a><a href="#">网站SEO查询</a><a href="#">虚拟主机评测</a><a href="#">友情链接检测</a><a href="#">网站备案查询</a><a href="'.constant('LK').'tool/google_pr.html">谷歌PR查询</a><a href="#">百度权重查询</a><a href="'.constant('LK').'tool/keyword_bd.html">关键词排名查询</a></div></div><div class="o"></div></div><div class="o mh"></div><div class="mg">'.constant('AD960x90pic').'</div><div class="f v3"><div class="p l"><h4><a href="'.constant('LK').'tech/game_1.html">网游娱乐</a></h4>';

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE b=4 '.$id_out.' ORDER BY t DESC LIMIT 7');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$text.='<div class="ai"><a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_4.gif?d='.YMD().'" width="110" height="90" alt="'.$H.'"/><br>'.SUB($H,9).'</a>';$i++;}
else if($i==1){$H=$Qa['h'];$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_5.gif?d='.YMD().'" width="110" height="90" alt="'.$H.'"/><br>'.SUB($H,9).'</a></div><div class="o mh"></div><ul class="rl r5">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
}
$text.='</ul><div class="mg a270x60"></div><h4 class="h4b"><a href="'.constant('LK').'tech/mv_1.html">音乐视频</a><a href="'.constant('LK').'tech/mv_1.html" class="pr">更多»</a></h4><ul class="rl r5">';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE b=5 '.$id_out.' ORDER BY t DESC LIMIT 8');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
}
$text.='</ul></div><div class="p c"><h4><a href="'.constant('LK').'tech/social_1.html">社交</a></h4><ul class="rl">';
$Social=array('<a href="'.constant('LK').'tech/safe_1.html">安全</a>','<a href="'.constant('LK').'tech/host_1.html">主机</a>','<a href="'.constant('LK').'tech/master_1.html">站长</a>','<a href="'.constant('LK').'tech/manage_1.html">管理</a>','<a href="'.constant('LK').'tech/trend_1.html">趋势</a>','<a href="'.constant('LK').'tech/program_1.html">技术</a>','<a href="'.constant('LK').'tech/programmer_1.html">情感</a>','<a href="'.constant('LK').'tech/pioneer_1.html">访谈</a>','<a href="'.constant('LK').'tech/ensure_1.html">维权</a>','<a href="'.constant('LK').'tech/vertical_1.html">垂直</a>');

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE b=2 '.$id_out.' ORDER BY t DESC LIMIT 10');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li>['.$Social[$i].'] <a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
if($i==4){$text.='</ul><ul class="rl">';}
$i++;
}
$text.='</ul><h4><a href="'.constant('LK').'tech/smart_1.html">移动</a></h4><ul class="rl">';
$Smart=array('<a href="'.constant('LK').'tech/safe_1.html">安全</a>','<a href="'.constant('LK').'tech/host_1.html">主机</a>','<a href="'.constant('LK').'tech/master_1.html">站长</a>','<a href="'.constant('LK').'tech/manage_1.html">管理</a>','<a href="'.constant('LK').'tech/trend_1.html">趋势</a>','<a href="'.constant('LK').'tech/program_1.html">技术</a>','<a href="'.constant('LK').'tech/news_1.html">资讯</a>','<a href="'.constant('LK').'tech/pioneer_1.html">访谈</a>','<a href="'.constant('LK').'tech/ensure_1.html">维权</a>','<a href="'.constant('LK').'tech/vertical_1.html">垂直</a>');

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE b=6 '.$id_out.' ORDER BY t DESC LIMIT 10');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li>['.$Smart[$i].'] <a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
if($i==4){$text.='</ul><ul class="rl">';}
$i++;
}
$text.='</ul></div><div class="q r"><h4><a href="'.constant('LK').'tech/safe_1.html">安全防护</a><a href="'.constant('LK').'tech/safe_1.html" class="pr">更多»</a></h4>';

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE c=7 '.$id_out.' ORDER BY t DESC LIMIT 7');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$text.='<div class="ai"><a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_6.gif?d='.YMD().'" width="110" height="90" alt="'.$H.'"/><br>'.SUB($H,8).'</a>';$i++;}
else if($i==1){$H=$Qa['h'];$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_7.gif?d='.YMD().'" width="110" height="90" alt="'.$H.'"/><br>'.SUB($H,8).'</a></div><div class="o mh"></div><ul class="rl r5">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
}
$text.='</ul><h4 class="h4b"><a href="'.constant('LK').'tech/master_1.html">站长经验</a><a href="'.constant('LK').'tech/master_1.html" class="pr">更多»</a></h4><div class="o mh"></div><ul class="rl r5">';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE c=5 '.$id_out.' ORDER BY t DESC LIMIT 11');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
}
$text.='</ul></div><div class="o"></div></div><div class="o mh"></div><div class="mg">'.constant('AD960x90pic').'</div><div class="f v4"><div class="p l"><h4><a href="'.constant('LK').'tech/vi_1.html">视觉设计</a></h4>';
$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=5 '.$id_out.' ORDER BY t DESC LIMIT 7');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$text.='<div class="ai"><a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_8.gif?d='.YMD().'" width="110" height="90" alt="'.$H.'"/><br>'.SUB($H,9).'</a>';$i++;}
else if($i==1){$H=$Qa['h'];$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_9.gif?d='.YMD().'" width="110" height="90" alt="'.$H.'"/><br>'.SUB($H,9).'</a></div><div class="o mh"></div><ul class="rl r5">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
}
$text.='</ul><div class="mg a270x60"></div><h4 class="h4b"><a href="'.constant('LK').'tech/soft_1.html">软件设计</a><a href="'.constant('LK').'tech/soft_1.html" class="pr">更多»</a></h4><ul class="rl r5">';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=6 '.$id_out.' ORDER BY t DESC LIMIT 10');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
}
$text.='</ul></div><div class="p c">';

$Shop=array('','<a href="'.constant('LK').'tech/master_1.html">站长</a>','<a href="'.constant('LK').'tech/vertical_1.html">垂直</a>','<a href="'.constant('LK').'tech/shop_1.html">电商</a>','<a href="'.constant('LK').'tech/pc_1.html">微机</a>','<a href="'.constant('LK').'tech/se_1.html">搜索</a>','<a href="'.constant('LK').'tech/sem_1.html">营销</a>','<a href="'.constant('LK').'tech/pioneer_1.html">创业</a>','<a href="'.constant('LK').'tech/manage_1.html">运营</a>','<a href="'.constant('LK').'tech/trend_1.html">趋势</a>','<a href="'.constant('LK').'tech/news_1.html">资讯</a>');

$i=0;$Qq=mysql_query('SELECT i,h,d,t FROM f2013 WHERE b=3 '.$id_out.' ORDER BY t DESC LIMIT 11');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$D=$Qa['d'];$text.='<a class="ct" href="'.constant('LK').'tech/'.$t.$I.'.html"><h2>'.SUB($H,17).'</h2><p>'.SUB($D,53).'…</p></a><div class="o mh"></div><p class="po mg"><a href="'.constant('LK').'tech/shop_1.html">[电子商务E-Commerce运营]</a><a href="'.constant('LK').'tech/smart_1.html" class="pr">[移动互联网]</a></p><ul class="rl">';}
else {$text.='<li>['.$Shop[$i].'] <a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
if($i==5){$text.='</ul><ul class="rl">';}


$i++;
}

$text.='</ul><ul class="rl">';

$Industry=array('<a href="'.constant('LK').'tech/master_1.html">站长</a>','<a href="'.constant('LK').'tech/vertical_1.html">垂直</a>','<a href="'.constant('LK').'tech/shop_1.html">电商</a>','<a href="'.constant('LK').'tech/pc_1.html">微机</a>','<a href="'.constant('LK').'tech/se_1.html">搜索</a>','<a href="'.constant('LK').'tech/sem_1.html">营销</a>','<a href="'.constant('LK').'tech/pioneer_1.html">创业</a>','<a href="'.constant('LK').'tech/manage_1.html">运营</a>','<a href="'.constant('LK').'tech/trend_1.html">趋势</a>','<a href="'.constant('LK').'tech/news_1.html">资讯</a>');
$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE b=8 '.$id_out.' ORDER BY t DESC LIMIT 10');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li>['.$Industry[$i].'] <a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
if($i==4){$text.='</ul><ul class="rl">';}
$i++;
}
$text.='</ul></div><div class="q r"><h4><a href="'.constant('LK').'tech/soho_1.html">家居办公</a><a href="'.constant('LK').'tech/soho_1.html" class="pr">更多»</a></h4>';

$i=0;$Qq=mysql_query('SELECT i,h,d,t FROM f2013 WHERE a=3 '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$D=$Qa['d'];$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html" class="ai"><img src="'.constant('LTP_8').'tech/110x90office.gif" width="110" height="90" alt="'.$Qa['h'].'"/><h3>'.SUB($H,11).'</h3><p>'.SUB($D,43).'…</p><div class="o"></div></a><div class="o mh"></div><ul class="rl r2">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
}

$text.='</ul><div class="mg a270x106">'.constant('A270x106b').'</div><h4 class="h4b"><a href="'.constant('LK').'tech/union_1.html">网赚联盟</a><a href="'.constant('LK').'tech/union_1.html" class="pr">更多»</a></h4>';

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=8 '.$id_out.' ORDER BY t DESC LIMIT 7');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$H=$Qa['h'];
if($i==0){$text.='<div class="ai"><a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_10.gif?d='.YMD().'" width="110" height="90" alt="'.$Qa['h'].'"/><br>'.SUB($H,8).'</a>';$i++;}
else if($i==1){$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/tech110x90_11.gif?d='.YMD().'" width="110" height="90" alt="'.$Qa['h'].'"><br>'.SUB($H,8).'</a></div><div class="o mh"></div><ul class="rl r5">';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
}
$text.='</ul></div><div class="o"></div></div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0('$M($("^div.d")[0])').constant('TONGJI').'</script></div>'.constant('AD120x270xfboth').'</body></html>';
file_put_contents($file,$text);}
?>