<?php



$i=$_POST['i'];/*商品id*/
$n=$_POST['n'];/*商品名称*/
$p=$_POST['p'];/*商品价格*/
$j=$_POST['j'];/*商品积分*/
$b=$_POST['b'];/*商品返利*/
$m=$_POST['m'];/*商品数量*/

echo $n;


echo '<table cellspacing="0" border="1" bordercolordark="#ffffff" bordercolorlight="#000000"><tr><th>商品编码</th><th>名称</th><th>价格</th><th>积分</th><th>返利</th><th>数量</th><th>取消</th></tr>



</table>';



if(isset($_SESSION['i']))
{echo '您好，<a href="http://localhost:8080/v-get.com/shop/my.php">'.$_SESSION['u'].'</a>！<a href="http://localhost:8080/v-get.com/shop/lo.php">[退出]</a>';}
else {echo '<a href="http://localhost:8080/v-get.com/shop/log.php">登录|注册</a>';}




?>