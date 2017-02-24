<?php
$QC=mysql_connect('localhost','CF30q9pDo0e','ox9dEe5dw3o');mysql_select_db('vwuliu',$QC);mysql_query('set names utf8');$I=$_GET['i'];$Qq=mysql_query('SELECT t FROM cf2013 WHERE i='.$I,$QC);$Qa=mysql_fetch_array($Qq);$Qr=mysql_num_rows($Qq);if($Qr==0){header('HTTP/1.1 404 Not Found');header("status: 404 Not Found");include '../a/404.php';exit();}
$T=$Qa['t'];$t=strtotime($T);$t=date('Ymd/His',$t);
Header('HTTP/1.1 301 Moved Permanently');Header('Location: http://wuliu.v-get.com/news/'.$t.$I.'.html');
?>