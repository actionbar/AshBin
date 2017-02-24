<?php
require('user.php');
if(isset($_GET['user'])){
$USER=$_GET['user'];
//帐号密码需要填写，密码是E维科技内部密码，和网站无关，user必须是网站注册帐号
//这里通过tp.v-get.com  的 编辑帐号分配来分配
//验证统一通过数据库来，每一篇文章+1
if(array_key_exists($USER,$Usercheck)){
$Auser=$Usercheck[$USER];
//为了防止上传图片被黑客利用，所以这里要放入用户名+验证码（非密码）
//v_newtask用户确定更新 ec_s_rank.php，editor_task.php每天更新一次，而ec_s_rank.php根据这个v_newtask值更新。v_newtask是时间的数字化值
//FE_UP 是编辑器提交，避免被黑客利用，叫做 link.php
//FEIUP是上传图片的，避免被黑客利用，所以这里伪装名称url_301 
echo 'var FE_UserCountUrl="#",FE_UP="http://tp.v-get.com/editor/link.php",FE_IUP="http://tp.v-get.com/editor/url_301.php?user=',$USER,'&check=',$Auser[3],'&",FE_Tasks="http://tp.v-get.com/editor/cus_demand.php?t=1368209580&",FE_EditorClass=',$Auser[1],',FE_UserCus=',$Auser[2],';';}
}
?>