<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4);

/* 这里是i f i2 ig 的右边更新 */
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.php?</a>';
exit;
}

require '../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');
/* 这里是tech文章右侧，服务器不需要有，所以本地 */
$file=$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$id_out='';
$TOP=array(1,3,8,9);
$text='<div class="f mg"><h4><a href="'.constant('LK').'tech/top'.$TOP[array_rand($TOP)].'_1.html">每日推荐</a></h4>';

$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE g>0 '.$id_out.' ORDER BY t DESC LIMIT 9');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$H=$Qa['h'];
if($i==0){$text.='<div class="ai a"><a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/techf110x90_1.gif" width="110" height="90" alt="'.$Qa['h'].'" /><br>'.SUB($H,8).'</a>';$i++;}
else if($i==1){$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/techf110x90_2.gif" width="110" height="90" alt="'.$Qa['h'].'"/><br>'.SUB($H,8).'</a></div><div class="o"></div><ul>';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$H.'</a></li>';}
}

$text.='</ul></div><div class="f mg"><h4><a href="'.constant('LK').'tech/ensure_1.html">网络维权</a></h4>';
$i=0;$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE c=3 '.$id_out.' ORDER BY t DESC LIMIT 9');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$H=$Qa['h'];
if($i==0){$text.='<div class="ai a"><a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/techf110x90_3.gif" width="110" height="90" alt="'.$Qa['h'].'" /><br>'.SUB($H,8).'</a>';$i++;}
else if($i==1){$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html"><img src="'.constant('LTP_8').'f/techf110x90_4.gif" width="110" height="90" alt="'.$Qa['h'].'"/><br>'.SUB($H,8).'</a></div><div class="o"></div><ul>';$i++;}
else {$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';}
}
$text.='</ul></div><div class="rv mg r4"><h4><a href="'.constant('LK').'tech/game_1.html">大家爱看</a></h4>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE a=5 OR b=4 '.$id_out.' ORDER BY t DESC LIMIT 4');
$i=0;
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$H=$Qa['h'];
$i++;
$text.='<a href="'.constant('LK').'tech/'.$t.$I.'.html" class="ai"><img src="'.constant('LTP_8').'f/techf90x60_'.$i.'.gif" width="90" height="60" alt="'.$H.'"/><p>'.SUB($H,17).'</p></a><div class="o mh"></div>';
}

$text.='<div class="o"></div></div><div class="f rv mg r5"><h4><a href="'.constant('LK').'tech/safe_1.html">安全运营</a></h4><ul>';
$Qq=mysql_query('SELECT i,h,t FROM f2013 WHERE c=7 OR c=8 '.$id_out.' ORDER BY t DESC LIMIT 9');
while($Qa=mysql_fetch_array($Qq)){
$I=$Qa['i'];$id_out.=' AND i!='.$I;$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
$text.='<li><a href="'.constant('LK').'tech/'.$t.$I.'.html">'.$Qa['h'].'</a></li>';
}
$text.='</ul></div><div class="f rv mg r6"><h4><a href="'.constant('LK').'tech/smart_1.html">社交移动</a></h4>';
$i=0;$Qq=mysql_query('SELECT i,d,h,t FROM f2013 WHERE b=2 OR b=6 '.$id_out.' ORDER BY t DESC LIMIT 7');
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
$text.='</div><div class="o"></div></div>'.constant('AD300x250fixed');
file_put_contents($file,$text);}
?>