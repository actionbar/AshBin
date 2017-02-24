<?php
/* 
grant select on v3.* to wla1Ako@localhost identified by 'vgt1295EN';
grant insert on v3.f2013 to wla1Ako@localhost; */
$connect=mysql_connect('localhost','wla1Ako','vgt1295EN');mysql_select_db('v3',$connect);mysql_query('set names utf8');
if(!isset($_POST['vgetid'])||'WuLIu30NVsm2'!=$_POST['vgetid']){echo 'V-Get! ID is wrong!';exit;}

$USER=$_POST['user'];$A=$_POST['a'];$B=$_POST['b'];$C=$_POST['c'];$D=$_POST['d'];$K=$_POST['k'];
$F=$_POST['f'];$editorClass=$_POST['editorclass'];$H=$_POST['h'];$T=$_POST['t'];

//由于是php模拟post，所以已经在e.v-get.com进行了 urlencode
//对$F前端已经转码为 \"了，而 <> 是mysql 大于小于，所以如果用 "insert ... '$F'"遇到大小于有的php会自动替换成&nbsp; 而通过再传递Post，会把 \" 替换成\\\" ，所以前台一律不对f /d 修改引号
//前台和 e.v-get.com都已替换了 '为 &#39;
//这里不需要 $D

//传递的值产生：width=\\\"500\\\"
$F=str_replace('=\\\\\\"','=\\"',$F);$F=str_replace('\\\\\\"','\\"',$F);
$D=str_replace('=\\\\\\"','=\\"',$D);$D=str_replace('\\\\\\"','\\"',$D);
$Qs='INSERT INTO v3.f2013 (a,b,c,h,k,d,f,m,n,t,top) VALUES ('.$A.','.$B.','.$C.',"'.$H.'","'.$K.'","'.$D.'","'.$F.'","","<a href=\"http://wuliu.v-get.com/\">商务物流网</a>","'.$T.'",0)';
mysql_query($Qs) or die (mysql_error());
echo 'v';
?>