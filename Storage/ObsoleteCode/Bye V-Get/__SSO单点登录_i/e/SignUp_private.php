<?php

$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('vv',$QC);mysql_query('set names utf8');

/*
lg： primary：a=会员汉字或者user昵称登录4-30 c=手机号码  b=邮箱   d=密码 6-16 (前端设置，后端不判断)

lgp：隐私问题，单独数据库，不准读取 a  n=名字6-21 i=身份证号18

*/
//前台判断长度，如果超长自然插入不了



$lk=$_GET['lk']; /*网页来源*/
 
$PN=$_POST['sn'];$PI=$_POST['si'];
$la=strlen($A);$lb=strlen($B);$bc=(($lb<4&&$lb>20)||strlen($C)!=11)?true:false;$ld=strlen($D);$lpn=strlen($PN);


if($la<4||$la>30||$bc||$ld<6||$ld>16||$lpn<6||$lpn>21||strlen($PI)!=18){
echo '位数不对';
//header('Location: http://localhost/i.v-get.com/m/logup.html'; 
exit;
}

if((!preg_match('/^[\w\.\-]+@[\w\.\-]+\.[a-z]{2,4}$/',$B)||!preg_match('/^1\d{10}$/',$C))||!preg_match('/^\d{17}[x\d]$/',$PI)){
echo '匹配不对';
//header('Location: http://localhost/i.v-get.com/m/logup.html');

exit;}
$Qq=mysql_query('SELECT a FROM lg WHERE a="'.$A.'" LIMIT 1');
$Qa=mysql_fetch_array($Qq);

if($Qa){
echo '数据库已经存在';
//header('Location: http://localhost/i.v-get.com/m/logup.html'); 
exit;}
$D=md5($D);
$in='INSERT INTO lg (a,b,c,d) VALUES ("'.$A.'","'.$B.'",'.$C.',"'.$D.'")';
echo $in,'<hr>';
if(!mysql_query($in))
{
echo '数据库问题',mysql_error();
exit;
}
if(!mysql_query('INSERT INTO lgp (a,n,i) VALUES ("'.$A.'","'.$PN.'","'.$PI.'")'))
{
mysql_query('DELETE FROM lg where a="'.$A.'"');

echo '数据库问题',mysql_error();
exit;
}
mysql_close($QC);
echo 'ok';
exit;




?>