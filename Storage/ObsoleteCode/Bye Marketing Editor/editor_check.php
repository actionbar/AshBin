<?php
require('editor_user.php');
$USER=$_GET['user'];$PASS=$_GET['pass'];$CID=$_GET['cid'];
//返回 v 成功验证， g没有验证
//同一个编辑一个时间内一个站点，就算是同时做高级编辑，帐号也要换一个
//验证统一通过数据库来，每一篇文章+1
//在客户端，用代码可以查询用户名，获取写作的文章数

$Auser=$check[$USER];
$Apass=$Auser[0];$Aweb=$Auser[1];
if($Apass!=$PASS||$Aweb!=$CID){echo '密码或者ID错误！';exit;}
else {echo 'v';}

?>