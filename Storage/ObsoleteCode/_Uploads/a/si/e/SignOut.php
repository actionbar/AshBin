<?php
include('../c/vc_sql.php');
session_start();
$ss=isset($_GET['ss'])?$_GET['ss']:false; // 0 表示 desstroy  其他的就是 unset
if(!$ss||$ss=='0'){session_destroy();}else {session_unset($_SESSION[$ss]);}
if(empty($_GET['lk'])){header('Location: http://localhost/i.v-get.com/index.php');}
else {header('Location:'.$_GET['lk']);}
?>