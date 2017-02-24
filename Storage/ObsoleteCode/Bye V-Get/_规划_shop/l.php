<?php
//session_start();

require('c.php');
$A=$_POST['k'];
$p=$_POST['w'];
$P=md5($p);
echo $A.'<br/>'.$P;
$s=mysql_query('SELECT b,n,c,d,f,o,q FROM m where a="'.$A.'" AND p="'.$P.'"');
$q=mysql_fetch_array($s);
if($q){$_SESSION['ma']=$A;$_SESSION['mb']=$q['b'];$_SESSION['mc']=$q['c'];$_SESSION['mn']=$q['n'];$_SESSION['md']=$q['d'];$_SESSION['mf']=$q['f'];$_SESSION['mo']=$q['o'];$_SESSION['mq']=$q['q'];setcookie(session_name(),session_id(),time()+604800,'/');/*设置session周期为7天；一天为86400*/echo '<script language="javascript" type="text/javascript">window.open("http://localhost:8080/shop.v-get.com/")</script>';}
else {die( '登录失败');}

/*
unset($_SESSION['views']);unset() 函数用于释放指定的 session 变量：
session_destroy()；将重置 session，您将失去所有已存储的 session 数据。

*/
?>
