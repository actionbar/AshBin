<?php
include('../c/vc_sql.php');	//验证码写入数据库
session_start();//session_start() 函数必须位于 <html> 标签之前：
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('vv',$QC);mysql_query('set names utf8');

$lk=$_GET['lk']; /*网页来源*/
$d='';
if(!empty($_POST['su'])){$d='a="'.$_POST['su'].'"';}
else if(!empty($_POST['se'])){$d='b="'.$_POST['se'].'"';}
else if(!empty($_POST['sm'])){$d='c='.$_POST['sm'];}

if($d!=''){
$D=$_POST['sp'];$D=md5($D);

$Qq=mysql_query('SELECT a FROM lg WHERE d="'.$D.'" AND '.$d.' LIMIT 1');
$Qa=mysql_fetch_array($Qq);
mysql_close($QC);
if($Qa){
echo '找到了，正确';
if($_POST['sr']){$_SESSION['sl']=$Qa['a'];}
//header('Location: http://localhost/i.v-get.com/m/logup.html'); 
exit;}
}
else{
echo 'SELECT a FROM lg WHERE d="',$D,' AND ',$d,' LIMIT 1';
echo '<hr>';
echo '用户名或者密码不对，使用手机号码登录可以提高登录速度';
}
exit;

?>