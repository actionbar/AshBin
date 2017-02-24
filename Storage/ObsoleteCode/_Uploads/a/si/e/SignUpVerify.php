<?php
include('../c/vc_sql.php');	//验证码写入数据库
session_start();
$QC=mysql_connect('localhost','LGoe2301Do','eoLo30DNekD02');mysql_select_db('vv',$QC);mysql_query('set names utf8');

/*
lg： primary：a=会员汉字或者user昵称登录4-30 c=手机号码  b=邮箱   d=密码 6-16 (前端设置，后端不判断)

lgp：隐私问题，单独数据库，不准读取 a  n=名字6-21 i=身份证号18

*/
//前台判断长度，如果超长自然插入不了


//由于所有的session都是使用 svc所以，不必担心验证码用过一次会出现消失问题，
//比如注册时SignUp一个svc，到SignUpNotify又生成了一个svc，就不会再相同了
//之后定期清理session

$lk=$_GET['lk']; /*网页来源*/
$VC=$_GET['code'];

//利用数据库里面的session注册信息，只需要验证session vc就行了
//session    s开头的 都是 登录

if(!isset($_SESSION['svc'])||$_SESSION['svc']!=$VC){
//header('Location: http://localhost/i.v-get.com/e/SignUp.html');
echo '验证码过期，或者验证码错误';exit;
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