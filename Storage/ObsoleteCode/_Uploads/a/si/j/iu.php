<?php
$r=$_SERVER['HTTP_REFERER'];$R=parse_url($r);$d=$R['host'];$D=substr($d,-9);
if($D=='v-get.com'&&isset($_GET['f'])&&isset($_GET['g'])&&isset($_GET['lk'])){
$Qc=mysql_connect("localhost","Idvw03nvUs","eoEf20vdfDOe0");mysql_select_db("vv",$Qc);mysql_query("set names utf8");
$S=$_GET['f'];$V=$_GET['g'];$lk=$_GET['lk'];
$Qq=mysql_query('SELECT i,n,g,b FROM iu WHERE s='.$S.' AND v="'.$V.'" LIMIT 1');
$h=$lk;
if($Qa=mysql_fetch_array($Qq)){
echo 'var $IU=[',$Qa['g'],',',($Qa['n']+1),',',$Qa['b'],'];';
$I=$Qa['i'];
mysql_query("UPDATE iu SET h='$h' , n=n+1 WHERE i=$I");
}
else {mysql_query("INSERT INTO iu (s,v,h,n) VALUES ($S,'$V','$h',1)");echo 'var $IU=[0,1,0];';}

exit;}
else {echo 'var $IU=[9,4839,0];';exit;}
?>
