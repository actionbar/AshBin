<?php
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('v3',$QC);mysql_query('set names utf8');
//i  m=wuliu/m  p=ip  u=uv   t=time 
//如果有获取到 v，表明是由ajax来的，那么就直接insert
//这里数据库里m已经设为非空
$M=$_POST['v'];
$T=date('Y-m-d H:i:s');
$P=$_SERVER['REMOTE_ADDR'];
mysql_query('insert into iu (m,p,t) values('.$M.',"'.$P.'","'.$T.'")');
$Qy=mysql_query('select count(*) from iu where m='.$M);
$Qz=mysql_fetch_array($Qy);
echo $Qz[0];
?>