<?php
$Qc=mysql_connect("localhost","Idvw03nvUs","eoEf20vdfDOe0");mysql_select_db("vv",$Qc);mysql_query("set names utf8");
$S=$_GET['f'];$U=$_GET['v'];
$G=$_GET['g'];
if($G==1){
$Qq=mysql_query('SELECT i,n,g,b FROM iu WHERE u='.$U.' AND s='.$S.' LIMIT 1');
if($Qa=mysql_fetch_array($Qq)){

echo 'var IU=[',$Qa['g'],',',($Qa['n']+1),',',$Qa['b'],'];';
mysql_query('UPDATE iu SET n=n+1 WHERE i='.$Qa['i']);
}
else {mysql_query('INSERT INTO iu (s,u,n) VALUES ('.$S.','.$U.',1)');echo 'var IU=[0,1,0];';}
}
else if($G==0){
$Qq=mysql_query('SELECT i FROM iu WHERE u='.$U.' AND s='.$S.' LIMIT 1');
if($Qa=mysql_fetch_array($Qq)){
mysql_query('UPDATE iu SET g=g+1 WHERE i='.$Qa['i']);
}
else {mysql_query('INSERT INTO iu (s,u,g) VALUES ('.$S.','.$U.',1)');}
}

?>