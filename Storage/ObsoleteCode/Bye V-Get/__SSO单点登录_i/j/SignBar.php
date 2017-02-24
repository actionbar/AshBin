
<?php
header("Content-Type: text/html;charset=utf-8");
include('../c/vc_sql.php');	//验证码写入数据库
session_start();//session_start() 函数必须位于 <html> 标签之前：
$lk=isset($_GET['lk'])?$_GET['lk']:'http://localhost/i.v-get.com/';
if(!empty($_SESSION['sa'])){
$A=$_SESSION['sa'];
echo 'var $EU="',$A,'";K("EU","',$A,'",9);K("EO",$1,0);';
}
//signbar，不需要else输出，因为不执行js就表示会显示原来的html
else {echo 'K("EO",$1,9);';exit;
//echo '(function(){F($("^a.e"),function(o){H(o.parentNode,\'<form action="http://localhost/i.v-get.com/e/SignIn.html?lk='.$lk.'" method="post"><input type="hidden" value="1" name="sr"/><input type="text" name="sm"/><input type="password" name="sp"/><input type="submit" value="登录" /></form>\')})})();';
}
?>








