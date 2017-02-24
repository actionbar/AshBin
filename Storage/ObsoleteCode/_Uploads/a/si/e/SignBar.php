
<?php
header("Content-Type: text/html;charset=utf-8");
include('../c/vc_sql.php');session_start();
$lk=isset($_GET['lk'])?$_GET['lk']:'http://www.v-get.com/';
if(!empty($_SESSION['sa'])){
$A=$_SESSION['sa'];
echo 'var $EU="',$A,'";K("EU","',$A,'",9);K("EO",$1,0);';
}

else {echo 'K("EO",$1,9);';exit;}
?>








