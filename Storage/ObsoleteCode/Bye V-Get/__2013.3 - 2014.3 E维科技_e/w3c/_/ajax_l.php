<?php
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve',$QC);mysql_query('set names "UTF-8"');
$L=$_POST['v'];
$Qs='SELECT * FROM w3c WHERE l="'.$L.'"';
$Qq=mysql_query($Qs);
$Qa=mysql_fetch_array($Qq);
$Qr=mysql_num_rows($Qq);if($Qr==0){echo 'v';}

?>