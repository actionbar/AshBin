<?php
$Qc=mysql_connect("localhost","root","qwdw114");mysql_select_db("vv",$Qc);mysql_query("set names utf8");


//默认是10个，
if(isset($_GET['f'])){
//t=1 表示3个ajax数组， 没有t，就是10个li 带url数组
if(!isset($_GET['t'])){
$o='n';$P=isset($_GET['p'])?$_GET['p']:10;
if(!empty($_GET['o'])){$oo=$_GET['o'];if($oo=='good'){$o='g';}if($oo=='nogood'){$o='b';}}

$Qq=mysql_query('SELECT h FROM iu where s='.$_GET['f'].' ORDER BY '.$o.' DESC LIMIT 0,'.$P);
echo '$VIEWS=[';
while($Qa=mysql_fetch_array($Qq)){
echo '\'',$Qa['h'],'\',';
}
echo '];';

}
else{
$o='n';$P=isset($_GET['p'])?$_GET['p']:3;
if(!empty($_GET['o'])){$oo=$_GET['o'];if($oo=='good'){$o='g';}if($oo=='nogood'){$o='b';}}

$Qq=mysql_query('SELECT v FROM iu where s='.$_GET['f'].' ORDER BY '.$o.' DESC LIMIT 0,'.$P);
//采用ajax，js传递参数过去，然后ajax
echo '$VIEWS=[';
while($Qa=mysql_fetch_array($Qq)){
echo '"',$Qa['v'],'",';
}
echo '];';

}

}
else {echo '$VIEWS=[]';}
?>