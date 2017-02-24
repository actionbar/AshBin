
<?php
$r=$_SERVER['HTTP_REFERER'];
$R=parse_url($r);
$d=$R['host'];
$D=substr($d,-9);
//if($D=='v-get.com'&&isset($_GET['f'])&&isset($_GET['v']))
if($D=='localhost'&&isset($_GET['f'])&&isset($_GET['g'])&&isset($_GET['lk'])){

$Qc=mysql_connect("localhost","root","qwdw114");mysql_select_db("vv",$Qc);mysql_query("set names utf8");
//注意get最多255字符，所以字符要省着用，lk==>l
$S=$_GET['f'];$V=$_GET['g'];$lk=$_GET['lk'];
// i= id+site(两位)
//$V表示参数，以后 pengcheng.co.wuliu.v-get.com  这种类型的，pengcheng就是参数，所以要用varchar
$Qq=mysql_query('SELECT i,n,g,b FROM iu WHERE s='.$S.' AND v="'.$V.'" LIMIT 1');
//采用名称，如果存在就update，否则就insert，为了防止别人刷，弄成假的，所以要判断ip
//之后有了h，就可以新建一个浏览量排序/好评/差评 排名的独立页面数据

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
