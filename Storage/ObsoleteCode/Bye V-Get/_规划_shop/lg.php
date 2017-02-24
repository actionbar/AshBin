<?php
$l=$_POST['v'];
if(isset($_SESSION['ma']))
{echo '您好，<a href="http://localhost:8080/v-get.com/shop/my.php">'.$_SESSION['ma'].'</a>！<a href="http://localhost:8080/v-get.com/shop/lo.php?l='.$l.'">[退出]</a>';}
else {echo '<a href="http://localhost:8080/v-get.com/shop/log.php">登录|注册</a>';}
?>