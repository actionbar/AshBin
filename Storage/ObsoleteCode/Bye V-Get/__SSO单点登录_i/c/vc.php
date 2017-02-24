<?php
include('vc_sql.php');		//包含session_set_save_handler定义的文件

session_start();
$_SESSION['vc'] = "456";$_SESSION['vc3'] = "123";
echo $_SESSION['vc'];
//session_destroy();
//session_destroy();删除该用户的session数据记录
//session_unset($_SESSION['vc']);  
/* 
下面是调取
include('vc_sql.php');		//包含session_set_save_handler定义的文件

session_start();
echo "UserName:".$_SESSION['username']."<BR>";
echo "PassWord:".$_SESSION['password']."<BR>";
*/
?>

