<?php
//pri  mid  snr
require('user130527.php');
//帐号密码需要填写，密码是E维科技内部密码，和网站无关，user必须是网站注册帐号
//这里通过tp.v-get.com  的 编辑帐号分配来分配
//验证统一通过数据库来，每一篇文章+1

if(isset($_GET['user'])){
$USER=$_GET['user'];

if(array_key_exists($USER,$Usercheck)){
$Auser=$Usercheck[$USER];
//v_newtask用户确定更新 ec_s_rank.php，editor_task.php每天更新一次，而ec_s_rank.php根据这个v_newtask值更新。v_newtask是时间的数字化值
echo 'var et_refresh=1368209580,et_editorclass=',$Auser[1],',et_cus=',$Auser[2],';';}
else{echo 'var et_refresh=0,et_editorclass=0,et_cid=0;';}
}
?>