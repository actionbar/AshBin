<?php
$QC=mysql_connect('localhost','LGoe2301Do','eoLo30DNekD02');mysql_select_db('vv',$QC);mysql_query('set names utf8');

$d='';
if(!empty($_POST['su'])){$d='a="'.$_POST['su'].'"';}
else if(!empty($_POST['se'])){$d='b="'.$_POST['se'].'"';}
else if(!empty($_POST['sm'])){$d='c='.$_POST['sm'];}

if($d!=''){
$Qq=mysql_query('SELECT 1 FROM lg WHERE '.$d.' LIMIT 1');
$Qa=mysql_fetch_array($Qq);
mysql_close($QC);
if($Qa){echo '1';}
else {echo '0';}
}
?>