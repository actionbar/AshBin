<?php
$c=mysql_connect("localhost","root","qwdw114");mysql_select_db("v3",$c);mysql_query("set names utf8");
$I=$_POST['v'];
/*不用replace |太浪费服务器内存了，如果用字符代替，其实服务器要搜索两次，一次是原始搜索，一次是查找替换*/
$Qq=mysql_query('SELECT f FROM c WHERE i='.$I.' LIMIT 1');
$Qa=mysql_fetch_array($Qq);
echo $Qa['f'],'<p class="f1">联系我时，请说是在商务物流网(wuliu.v-get.com)上看到的，谢谢！</p>';
?>