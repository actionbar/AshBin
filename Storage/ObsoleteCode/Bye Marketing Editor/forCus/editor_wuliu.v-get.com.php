<?php
$connect=mysql_connect('localhost','wla1Ako','vgt1295EN');mysql_select_db('v3',$connect);mysql_query('set names utf8');
if(!isset($_POST['vgetid'])||'WuLIu30NVsm2'!=$_POST['vgetid']){echo 'V-Get! ID is wrong!';exit;}
$A=$_POST['a'];$B=$_POST['b'];$C=$_POST['c'];$D=$_POST['d'];$K=$_POST['k'];
$F=$_POST['f'];$editorClass=$_POST['editorclass'];$H=$_POST['h'];$T=$_POST['t'];
$F=str_replace('=\\\\\\"','=\\"',$F);$F=str_replace('\\\\\\"','\\"',$F);
$D=str_replace('=\\\\\\"','=\\"',$D);$D=str_replace('\\\\\\"','\\"',$D);
$Qs='INSERT INTO v3.f2013 (a,b,c,h,k,d,f,m,n,t,top) VALUES ('.$A.','.$B.','.$C.',"'.$H.'","'.$K.'","'.$D.'","'.$F.'","","<a href=\"http://wuliu.v-get.com/\">商务物流网</a>","'.$T.'",0)';
mysql_query($Qs) or die (mysql_error());
echo 'v';
?>