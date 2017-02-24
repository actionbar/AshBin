<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4);

/* 这里是i f i2 ig 的右边更新 */
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.php?</a>';
exit;
}

require '../_/global.php';
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');
/* 这里是tech文章右侧，服务器不需要有，所以本地 */
$file=$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$id_out='';
$TOP=array(1,3,8,9);
$text='<div class="f mg"><h4><a href="'.constant('LK').'tech/u/SEO_1.html">SEO专题</a></h4>';

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE b=9 OR m="SEO" '.$id_out.' ORDER BY t DESC LIMIT 9');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$H=$Qa['h'];
if($i==0){$text.='<div class="ai a"><a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/z110x90_1.gif" width="110" height="90" alt="'.$Qa['h'].'" /><br>'.SUB($H,8).'</a>';$i++;}
else if($i==1){$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/z110x90_2.gif" width="110" height="90" alt="'.$Qa['h'].'"/><br>'.SUB($H,8).'</a></div><div class="o"></div><ul>';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$H.'</a></li>';}
}

$text.='</ul></div><div class="f mg"><h4><a href="'.constant('LK').'tech/union_1.html">联盟网赚</a></h4>';
$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=8 '.$id_out.' ORDER BY t DESC LIMIT 9');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$H=$Qa['h'];
if($i==0){$text.='<div class="ai a"><a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/z110x90_3.gif" width="110" height="90" alt="'.$Qa['h'].'" /><br>'.SUB($H,8).'</a>';$i++;}
else if($i==1){$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/z110x90_4.gif" width="110" height="90" alt="'.$Qa['h'].'"/><br>'.SUB($H,8).'</a></div><div class="o"></div><ul>';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
}



$QC_i=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve_i',$QC_i);mysql_query('set names utf8');
$text.='</ul></div><div class="rv mg r4"><h4><a href="'.constant('LK').'i/topic-62-1.html">SEO论坛</a></h4>';
$Qq=mysql_query('SELECT tid,subject FROM '.constant('discuz_pre').'forum_thread WHERE fid=62 ORDER BY dateline DESC LIMIT 4',$QC_i);
$i=0;
while($Qa=mysql_fetch_array($Qq)){
$H=$Qa['subject'];
$i++;
$text.='<a href="'.constant('LK').constant('MENU_BBS').'/tip-'.$Qa['tid'].'-1.html" class="ai"><img src="'.constant('LTP_8').'f/z90x60_'.$i.'.gif" width="90" height="60" alt="'.$H.'"/><p>'.SUB($H,17).'</p></a><div class="o mh"></div>';
}

$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');
$text.='<div class="o"></div></div><div class="f rv mg r5"><h4><a href="'.constant('LK').'tech/manage_1.html">网站运营</a></h4><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE c=5 OR c=7 OR c=8 OR c=9 '.$id_out.' ORDER BY t DESC LIMIT 9');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
}
$text.='</ul></div><div class="f rv mg r6"><h4><a href="'.constant('LK').'tech/trend_1.html">科技趋势</a></h4>';
$i=0;$Qq=mysql_query('SELECT i,d,h,t FROM f2013 WHERE c=4 '.$id_out.' ORDER BY t DESC LIMIT 7');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
if($i==0){$H=$Qa['h'];$D=$Qa['d'];$text.='<h3><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.SUB($H,15).'</a></h3><a href="'.constant('LK').'tech/'.$t.$I.'.html" class="ai"><img src="'.constant('LTP_8').'f/techf90x60_5.gif" width="90" height="60" alt="'.$H.'"/><p>'.SUB($D,28).'…</p></a><div class="o"></div><ul>';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
}
$text.='</ul></div><div class="f rfa mg"><h4><a href="'.constant('LK').'tech/good_1.html">热门推荐</a></h4><div class="a">';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE c=6 '.$id_out.' ORDER BY t DESC LIMIT 12');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a>';
}
$text.='</div><div class="o"></div></div>';
file_put_contents($file,$text);}
?>