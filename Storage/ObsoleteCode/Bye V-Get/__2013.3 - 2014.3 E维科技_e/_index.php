<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">Are U Sure To Refresh e.v-get.com/'.$filename.'.html?</a>';
exit;
}

require '_/global.php';$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

require '_/links.php';
$file=constant('uploadFile').$filename.'.html';





$id_out='';/* 用于判断该id是否被用过，用过就不再用 i!=100 AND i!=201*/
$bbs_out='';
$text=constant('CSSJS').'<title>'.constant('SITENAME_E').'，草根站长平台_V-Get!</title><meta name="keywords" content="IT,站长,程序员,程序猿,站长工具,站长之家,草根站长,PHP,站长论坛,SEO,网络营销"/><meta name="description" content="'.constant('SITENAME_E').'为草根站长提供网络创业资讯、网站建设产品、网络营销方案、SEO教程、网站源码、站长论坛、站长工具、网站运营理念以及一站式网络解决方案。"/><style type="text/css">';
$index_css=file_get_contents('_index.css');
$index_css=GO_INDEXCSS($index_css);

// 暂时 compress 函数没有具备对 图片路径的替换，所以暂时用 GO_INDEXCSS
//$COMPRESS=new compress();$index_css=$COMPRESS->js_css($index_css);
$text.=$index_css;

$text.='</style>';

$text.=TUN('e.v-get.com');

$text.='<div class="o mb"></div><div class="mb">'.constant('AD960x60pic').'</div>';

$text.='<div class="v"><div class="p l"><div class="lt">';
$Qq=mysql_query('SELECT i,a,b,c,h,d,m,t FROM f2013 WHERE g>0 AND m!="V-Get" ORDER BY t DESC LIMIT 1');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<h2><a href="'.constant('LK').'tech/">'.$Qa['h'].'</a></h2><div class="mg po">'.SUB($Qa['d'],30).'… [<a href="'.constant('LK').'tech/'.$t.$I.'.html">阅读原文</a>-<a href="'.constant('LK').'tech/'.$asa[$Qa['a']][0].'_1.html">'.$asa[$Qa['a']][1].'</a>-<a href="'.constant('LK').'tech/'.$asb[$Qa['b']][0].'_1.html">'.$asb[$Qa['b']][1].'</a>-<a href="'.constant('LK').'tech/'.$asc[$Qa['c']][0].'_1.html">'.$asc[$Qa['c']][1].'</a>]<i class="pr"><a href="'.constant('LK').'/tech/u/'.$Qa['m'].'_1.html">'.$Qa['m'].'</a></i></div>';

}

$text.='</div><div class="mc"><div id="mc"><ul><li><a href="'.constant('LK').'web/"><img width="698" height="238" src="'.constant('LTP_8').'698x238/mc1.jpg" alt="'.constant('SITENAME_E').'，卓越的网站开发能力_V-Get!"/></a></li><li><a href="'.constant('LK').'sem/"><img width="698" height="238" src="'.constant('LTP_8').'698x238/mc3.jpg" alt="'.constant('SITENAME_E').'，一切只为网络营销_V-Get!"/></a></li><li><a href="'.constant('LK').'tech/sem_1.html"><img width="698" height="238" src="'.constant('LTP_8').'698x238/mc4.jpg" alt="'.constant('SITENAME_E').'，专注于互联网营销_V-Get!"/></a></li><li><a href="'.constant('LK').'tech/u/SEO_1.html"><img width="698" height="238" src="'.constant('LTP_8').'698x238/mc2.jpg" alt="'.constant('SITENAME_E').'，营销不是你想的那么简单_V-Get!"/></a></li><li><a href="'.constant('LK').'tech/"><img width="698" height="238" src="'.constant('LTP_8').'698x238/mc5.jpg" alt="'.constant('SITENAME_E').'，不一样的优化推广_V-Get!"/></a></li></ul><div id="mco" class="a"><a class="mco">1</a><a>2</a><a>3</a><a>4</a><a>5</a></div></div></div><div class="o mh"></div><div class="l2"><div class="p"><h2><a href="'.constant('LK').'web/">企业网站建设</a></h2><p><a href="'.constant('LK').'web/service.html">建站</a><a href="'.constant('LK').'host/icp_beian.html">备案</a><a href="'.constant('LK').'host/domain.html">域名</a><a href="'.constant('LK').'host/">主机</a><a href="#">邮箱</a><a href="#">维护</a></p></div><div class="p l22"><h2><a href="'.constant('LK').'sem/">网络营销策划</a></h2><p><a href="'.constant('LK').constant('MENU_BBS').'/topic-62-1.html">SEO</a><a href="'.constant('LK').constant('MENU_BBS').'/topic-2-1.html">PPC</a><a href="'.constant('LK').constant('MENU_BBS').'/topic-61-1.html">广告</a><a href="'.constant('LK').constant('MENU_BBS').'/topic-50-1.html">B2C</a><a href="'.constant('LK').constant('MENU_BBS').'/topic-54-1.html">外贸</a><a href="'.constant('LK').constant('MENU_BBS').'/topic-63-1.html">营销</a></p></div><div class="p l23"><h2><a href="'.constant('LK').'soho/">任务外包托管</a></h2><p><a href="'.constant('LK').constant('MENU_BBS').'/topic-39-1.html">程序外包</a><a href="'.constant('LK').constant('MENU_BBS').'/topic-45-1.html">软文</a><a href="'.constant('LK').constant('MENU_BBS').'/topic-47-1.html">网编</a><a href="'.constant('LK').'soho/kefu.html">网店托管</a></p></div><div class="q"><h2><a href="'.constant('LK').'tech/">站长技术交流</a></h2><p><a href="'.constant('LK').'tech/u/PHP_1.html">PHP</a><a href="'.constant('LK').'tech/u/Database_1.html">SQL</a><a href="'.constant('LK').'tech/u/SEO_1.html">SEO</a><br><a href="'.constant('LK').'tech/u/HTML_1.html">前端</a><a href="'.constant('LK').constant('MENU_BBS').'/">BBS</a><a href="'.constant('LK').'open/">开源</a></p></div></div><div class="o mh"></div><div class="o mh"></div><div id="c"><div class="ct"><strong>站长焦点：</strong><a href="http://e.v-get.com/tech/20130911/050704741.html" class="f3">又打飞机啦！</a><a href="http://e.v-get.com/tool/ad_union.html">广告联盟大全</a><a href="http://e.v-get.com/open/php-frame.html">PHP框架</a><a href="http://e.v-get.com/w3c/">W3CSchool 在线教程</a><a href="http://e.v-get.com/tech/20130701/111111633.html">语希范</a><a href="http://e.v-get.com/tech/u/PHP_1.html">PHP</a></div>';


$Qq=mysql_query('SELECT l,a,h,d,k FROM w3c ORDER BY t DESC LIMIT 1',$QC);
$Qa=mysql_fetch_array($Qq);
$A=$Qa['a'];
$text.='<div class="cc"><a href="'.constant('LK').'w3c/" class="p" title="W3CSchool 在线教程"><img width="180" height="135" src="'.constant('V1_e').'180x135/w3c.jpg" alt="W3CSchool 在线教程"></a><h2><a href="'.constant('VE').'w3c/'.$Qa['l'].'.html">'.$Qa['h'].'</a></h2><p><span>[<a href="'.constant('LK').'w3c/'.$Qa['a'].'.html">'.$A.' 教程</a>]</span>　'.$Qa['d'].'</p><p>标签: '.GO_KEY2LINK($Qa['k'],constant('VE').'s?se=w3c&sk=$1').'</p><div class="o"></div></div>';



$ci=0;$ca='a';$carr=$asa;
$Qq=mysql_query('SELECT i,a,b,c,t,g,h,k,d FROM f2013 WHERE 1 '.$id_out.' ORDER BY t DESC LIMIT 18',$QC);
while($Qa=mysql_fetch_array($Qq)){
$ci++;
if($ci>9){$ci=1;$ca='c';$carr=$asc;}
$I=$Qa['i'];$A=$Qa['a'];$B=$Qa['b'];$C=$Qa['c'];
$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$id_out.=' AND i!='.$I;
$text.='<div class="cc"><a href="'.constant('LK').'tech/'.$carr[$ci][0].'_1.html" class="p" title="'.$carr[$ci][1].'"><img width="180" height="135" src="'.constant('V1_e').'180x135/'.$carr[$ci][0].'.jpg" alt="'.$carr[$ci][1].'"></a><h2><a href="'.constant('VE').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></h2><p><span>[<a href="'.constant('LK').'tech/'.$asa[$A][0].'_1.html">'.$asa[$A][1].'</a>-<a href="'.constant('LK').'tech/'.$asb[$B][0].'_1.html">'.$asb[$B][1].'</a>-<a href="'.constant('LK').'tech/'.$asc[$C][0].'_1.html">'.$asc[$C][1].'</a>]</span>　'.$Qa['d'].'</p><p>'.(($Qa['g']>0)?'<span><a href="'.constant('VE').'tech/top'.$Qa['g'].'_1.html">'.$Garr[$Qa['g']].'</a></span>: ':'标签: ').GO_KEY2LINK($Qa['k'],constant('VE').'s?sk=$1').'</p><div class="o"></div></div>';
}
$text.='</div></div><div class="q r"><div class="rt mg"><h2><a href="http://e.v-get.com/tech/pioneer_1.html">IT 创业榜</a><i>&nbsp;</i></h2>';
$ITmansql='';$kITman=array();
foreach($ITCelebrity as $ITman=>$ITmanE){$kITman[]=$ITman;$ITmansql.=' OR k LIKE "%'.$ITman.',%"';}
$ITmansql='('.substr($ITmansql,3).')';
$Qq=mysql_query("SELECT i,k,h,d,t FROM f2013 WHERE $ITmansql $id_out ORDER BY t DESC LIMIT 1");
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$K=$Qa['k'];$aK=explode(',',$K);
// in_array() 区分大小写，所以$kITsite里面 小写=>名称
foreach($aK as $k){$k=strtolower($k);if(in_array($k,$kITman)){$pK=$k;break;}}
$text.='<a href="'.constant('LK').'s?sk='.$pK.'" class="ai"><img src="'.constant('LTP_8').'tag60/'.$ITCelebrity[$pK].'.gif" width="60" height="60" alt="'.$pK.'"><h3>'.$Qa['h'].'</h3><p>'.$pK.'：'.$Qa['d'].'</p></a><div class="o mh"></div>';}

$ITsitesql='';$kITsite=array();
foreach($ITSite as $ITsite=>$ITsiteE){$kITsite[]=$ITsite;$ITsitesql.=' OR k LIKE "%'.$ITsite.',%"';}
$ITsitesql='('.substr($ITsitesql,3).')';
$Qq=mysql_query("SELECT i,k,h,d,t FROM f2013 WHERE $ITsitesql $id_out ORDER BY t DESC LIMIT 1");
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$K=$Qa['k'];$aK=explode(',',$K);
foreach($aK as $k){$k=strtolower($k);if(in_array($k,$kITsite)){$pK=$k;break;}}
$text.='<a href="'.constant('LK').'s?sk='.$pK.'" class="ai"><img src="'.constant('LTP_8').'tag60/'.$ITSite[$pK].'.gif" width="60" height="60" alt="'.$pK.'"><h3>'.$Qa['h'].'</h3><p>'.$pK.'：'.$Qa['d'].'</p></a>';}

$text.='<div class="o mh"></div><div id="rt"><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE c=2 '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.SUB($Qa['h'],15).'</a></li>';}
$text.='</ul></div></div>';


$text.='<div class="r2 f mg"><div id="r2n" class="a"><a href="'.constant('LK').'tech/programmer_1.html" class="rao">程序猿！</a><a href="'.constant('LK').'tech/web_1.html" style="border-left:#ddd 1px solid;border-right:#ddd 1px solid">建站教程</a><a href="'.constant('LK').'tech/union_1.html">网赚联盟</a></div><div class="o"></div><ul style="display:block">';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=7 '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qa=mysql_fetch_array($Qq)){$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
$text.='</ul><ul>';


$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=2 '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qa=mysql_fetch_array($Qq)){$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
$text.='</ul><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=8 '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qa=mysql_fetch_array($Qq)){$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
$text.='</ul></div>';
$text.='<div class="f r3 mg"><h4>快捷通道<a href="http://e.v-get.com/z/" class="pr">更多 &gt;&gt;</a></h4><p><a href="http://e.v-get.com/open/php-frame.html">框架大全</a><a href="http://e.v-get.com/tool/">站长工具</a><a href="http://e.v-get.com/open/php-social.html">论坛源码</a></p><p class="r3c"><a href="http://e.v-get.com/open/php-shop.html">PHP商城</a><a href="http://e.v-get.com/open/php-soft.html">开发软件</a><a href="http://e.v-get.com/tech/u/SEO_1.html">SEO教程</a></p><p><a href="http://e.v-get.com/tech/u/HTML_1.html">前端开发</a><a href="http://e.v-get.com/js/">JS特效库</a><a href="http://e.v-get.com/s?sk=Discuz">Discuz !</a></p></div><div class="mg"><a href="http://e.v-get.com/"><img src="'.constant('LTP_8').'r4.jpg" height="41" width="250" alt="网站故障查询"/></a></div><div class="mg">'.constant('AD250x250pic').'</div><div class="r6 mg"><h4>最新活动<a href="'.constant('LK').'issue/godaddy.html" class="pr">更多 &gt;&gt;</a></h4><dl><dt><img src="'.constant('LTP_8').'44x31/1.jpg" width="44" height="31" alt="150G美国主机350元/年"/></dt><dd><h3 style="color:#f00"><a href="'.constant('LK').'issue/godaddy.html">150G美国主机350元/年</a></h3><p>Godaddy 主机30%优惠，.com域名仅需7.99美元。</p></dd></dl><div class="o"></div><dl><dt><img src="'.constant('LTP_8').'44x31/2.jpg" width="44" height="31" alt="如何做一个合格的网络编辑"/></dt><dd><h3><a href="'.constant('LK').'issue/editor.html">如何做一个合格的网络编辑</a></h3><p>网络编辑不是码字员也不是粘贴工，是一个用笔写灵魂的职业。 </p></dd></dl><div class="o"></div><dl><dt><img src="'.constant('LTP_8').'44x31/3.jpg" width="44" height="31" alt="纯CSS绘制各种形状"/></dt><dd><h3><a href="'.constant('LK').'js/css/planar_graph.shtml">纯CSS绘制各种形状</a></h3><p>用纯CSS也能绘制五角星、心形等。</p></dd></dl></div><div class="r7 f mg"><div id="r7n" class="a"><a href="'.constant('LK').'tech/u/" style="border-left:#ddd 1px solid;border-right:#ddd 1px solid">技术标签</a><a href="'.constant('LK').'sem/" class="rao">网络营销</a><a href="'.constant('LK').'tech/safe_1.html">安全漏洞</a></div><div class="o"></div><ul style="display:block">';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE m!="V-Get" '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
$text.='</ul><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=4 '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qa=mysql_fetch_array($Qq)){$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
$text.='</ul><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE c=7 '.$id_out.' ORDER BY t DESC LIMIT 6');
while($Qa=mysql_fetch_array($Qq)){$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}

$text.='</ul></div><div class="f r8 mb"><h4><a href="'.constant('LK').'z/link.html">友情链接</a></h4><div id="r8"><ul>';
foreach($LINKS_INDEX as $links=>$link){
$text.='<li>'.$link.'</li>';
}

$Qq=mysql_query('SELECT  h,i,t FROM f2013 WHERE (k LIKE "%友情链接%" OR k LIKE "%SEO%") '.$id_out.' ORDER BY t DESC LIMIT 8,'.(28-$LINKS_INDEX_Number));
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}

$text.='</ul></div></div><div class="mg"><iframe width="250" height="500" frameborder="0" scrolling="no" src="http://widget.weibo.com/list/list.php?language=zh_cn&width=250&height=500&listid=3627146142773166&appkey=3657814714&uname=E%E7%BB%B4%E7%A7%91%E6%8A%80&uid=3551642801&listname=E%E7%BB%B4%E7%A7%91%E6%8A%80&color=d2d2d2,ffffff,333333,0088FF,ffffff,f3f3f3&showcreate=1&isborder=1&info=0&sidebar=1&footbar=1&skin=0&dpc=1"></iframe></div><div class="mb a250x250">'.constant('AD250x250fixed').'</div></div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">B($("^div.cc"),"#F9FAFD");J("'.constant('V0_e').'i.js",function(){function mc(h,n){var a=$("mco^a");if(n==0||n)$("mc").scrollLeft=n*h;else{n=$("mc").scrollLeft/h;(n==(L(a)-1))?n=0:n++}F(a,function(o){C(o,"")});C(a[n],"mco")}M($("mc"),3,1,5000,I,mc);F($("mco^a"),function(o,i){E(o,$8,function(){mc($m($("^li",$("mc"))[0],1),i)})});F($("l3da^a"),function(a,i){E(a,$8,function(){F($("l3da^a"),function(b){C(b,"")});C(a,"l3da");F($("l3^ul"),function(u){D(u)});D($("l3^ul")[i],1);});});M($("rt"),0,1,2000,I);F(["2","7"],function(n){F($("r"+n+"n^a"),function(a,i){E(a,$8,function(){F($("r"+n+"n^a"),function(b){C(b,"")});C(a,"rao");F($("^ul",$("^div.r"+n)[0]),function(u){D(u)});D($("^ul",$("^div.r"+n)[0])[i],1);});});});M($("r8"),0,1,2500,I,5);A("c","_blank")});'.constant('TONGJI').constant('indexJS').'</script></div>'.constant('AD120x270xfboth').'</body></html>';
$FILE->write($file,$text);
?>