<?php
include('../c/vc_sql.php');
session_start();
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('vv',$QC);mysql_query('set names utf8');

$lk=$_GET['lk'];
$VC=$_GET['code'];

if(!isset($_SESSION['svc'])||$_SESSION['svc']!=$VC){
//header('Location: http://localhost/i.v-get.com/e/SignUp.html');
echo '验证码过期，或者验证码错误，如果您是多浏览器用户，请用同一浏览器激活。或者将 http://localhost/i.v-get.com/e/SignUpVerify?code=',$VC,'&lk=',urlencode($lk),' 复制到您所注册的浏览器打开。';exit;
}

$A=$_SESSION['sa'];$B=$_SESSION['sb'];$C=isset($_SESSION['sc'])?$_SESSION['sc']:0;$D=$_SESSION['sd'];

//$bc=preg_match('/^1\d{10}$/',$C);

$Qq=mysql_query('SELECT a FROM lg WHERE a="'.$A.'" OR b="'.$B.'" LIMIT 1');
if(mysql_fetch_array($Qq)){
echo '数据库已经存在';
//header('Location: http://localhost/i.v-get.com/m/logup.html'); 
exit;}
else{
//数据经过两次md5加密
//$D=md5($D);

if(!mysql_query('INSERT INTO lg (a,b,c,d) VALUES ("'.$A.'","'.$B.'",'.$C.',"'.$D.'")'))
{
echo '数据库问题，没有注册成功。'.mysql_error();
exit;
}
else {echo '恭喜你，注册成功了，屌丝。';}
}
mysql_close($QC);

session_destroy(); //注册表示是的确新用户，不会保存其他有用session，所以一旦注册，就把注册session完全删除掉
exit;




?>