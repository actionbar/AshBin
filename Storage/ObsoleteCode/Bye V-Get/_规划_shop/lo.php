<?php
$l=empty($_GET['l'])?'http://localhost:8080/shop.v-get.com/':$_GET['l'];
unset($_SESSION['ma']);
echo '<a href="'.$l.'">·µ»Ø</a>
<script language="javascript" type="text/javascript">window.location.href="'.$l.'";</script>
';
?>