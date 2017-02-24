<?php
require('c.php');
$vc=$_POST['i'];
$A=$_POST['a'];
$B=$_POST['b'];
$p=$_POST['p'];
$S=$_POST['s'];
$P=md5($p);
$c=strtolower($vc);
$vs=$_SESSION['validcode'];
$s=strtolower($vs);
/*在注册页已经判断了用户名 和 邮箱的唯一性*/
if($c==$s){
$sql='INSERT INTO m (a,b,p,s) VALUES ("'.$A.'","'.$B.'","'.$P.'",'.$S.')';
$t=mysql_query($sql);
if(!$t){die('注册错误，请返回重新注册！<script language="javascript" type="text/javascript">document.location.href="http://localhost:8080/v-get.com/shop/log.php"</script>');}
mysql_close($_c);
	
	
	
	
	}
else {echo '验证码输入错误，请重新输入<p><label>推荐人：</label><input type="text" name="rv"/><a href="">推荐人奖励措施</a></p>';}

?>
