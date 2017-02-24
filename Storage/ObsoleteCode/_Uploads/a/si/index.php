<?php
include('c/vc_sql.php');
session_start();
echo 'Your session is: ',$_SESSION['svc'];
$S=isset($_GET['s'])?$_GET['s']:'no';
$_SESSION['love']=$S;
echo '<hr>',session_id();
?>
<img src="http://i.v-get.com/m/svc.php"/>
