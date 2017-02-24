<?php
$QC=mysql_connect('localhost','Idvw03nvUs','eoEf20vdfDOe0');mysql_select_db('v3',$QC);mysql_query('set names utf8');
$M=$_POST['v'];
$T=date('Y-m-d H:i:s');
$P=$_SERVER['REMOTE_ADDR'];
mysql_query('insert into iu (m,p,t) values('.$M.',"'.$P.'","'.$T.'")');
$Qy=mysql_query('select count(*) from iu where m='.$M);
$Qz=mysql_fetch_array($Qy);
echo $Qz[0];
?>