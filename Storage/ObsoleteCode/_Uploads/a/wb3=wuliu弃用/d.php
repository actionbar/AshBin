<?php
 $Qc=mysql_connect("localhost","wla1Ako","vgt1295EN");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
$I=$_POST['v'];
$Qq=mysql_query('SELECT f FROM c WHERE i='.$I.' LIMIT 1');
$Qa=mysql_fetch_array($Qq);
echo $Qa['f'],'<p class="f1">联系我时，请说是在商务物流网(wuliu.v-get.com)上看到的，谢谢！</p>';
?>