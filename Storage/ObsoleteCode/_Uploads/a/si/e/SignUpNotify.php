<?php
//email发送验证码
include('../c/vc_sql.php');	//验证码写入数据库
session_start();
include('../c/eml.php');
include('../c/emlsmtp.php'); 
header("Content-type: text/html; charset=utf-8"); 


$Cail = new PHPMailer();

$Cail->IsSMTP();
$Cail->SMTPAuth = true; 
$Cail->Host ='smtp.qq.com';//必填，设置SMTP服务器 QQ邮箱是smtp.qq.com ，QQ邮箱默认未开启，请在邮箱里设置开通。网易的是 smtp.163.com 或 smtp.126.com

$Cail->Username = 'i@v-get.com'; // 必填，开通SMTP服务的邮箱；也就是发件人Email。
$Cail->Password ='Eml_Q5';

$Cail->From = 'i@v-get.com'; 
$Cail->FromName = "帐号注册_V-Get!"; //发件人


if(isset($_POST['svc'])){
if($_SESSION['svc']!=$_POST['svc']){echo '验证码错误';exit;}

$A=$_POST['su'];$B=$_POST['se'];$B=strtolower($B);$D=$_POST['sp'];

//这是用邮箱注册验证，所以B必须存在

$la=strlen($A);
//b邮箱 必须有一个，如果没有，就放手机号，c在数据库验证
$lb=strlen($B);$ld=strlen($D);

if($la<4||$la>30||$lb<4||$lb>20||$ld<6||$ld>16){
echo '位数不对';
exit;
}

if(!preg_match('/^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z0-9]{2,4}$/',$B)){
echo '匹配不对';
exit;}
$QC=mysql_connect('localhost','LGoe2301Do','eoLo30DNekD02');mysql_select_db('vv',$QC);mysql_query('set names utf8');
$Qq=mysql_query('SELECT a FROM lg WHERE a="'.$A.'" OR b="'.$B.'" LIMIT 1');
if(mysql_fetch_array($Qq)){
echo '数据库已经存在';
exit;}



 $V='vGet'.rand(999,9999999);$V=md5($V); //为了防止别人刷链接，所以要把链接给弄复杂点
	//写入数据库session，用户通过邮箱如果点击，就完成验证，否则就无法验证
	$_SESSION['sa']=$A;$_SESSION['sb']=$B;$_SESSION['sd']=md5($D);$_SESSION['svc']=$V;

   $Cail->AddAddress($B,$A);  //AddAddress(收件人邮箱，收件人名称)
   $Cail->Subject ="账户注册_V-Get!"; //邮件主题
   
	$lk=urlencode($_GET['lk']);
	$html='<table style="background:#ffffff;" cellpadding="0" cellspacing="0" width="100%"><tr><td><table cellpadding="0" cellspacing="0" width="100%"><tr><td style="background:#ffffff;border-bottom:2px solid #dfdfdf;width:15px;">&nbsp;</td><td style="background:#ffffff;border-bottom:2px solid #ffffff;width:10px;">&nbsp;</td><td style="background:#ffffff;width:137px;"><img src="https://passport.baidu.com/getpass/img/logo.gif" ellpadding="0" cellspacing="0"></td><td style="background:#ffffff;border-bottom:2px solid #ffffff;width:10px;">&nbsp;</td><td style="background:#ffffff;border-bottom:2px solid #dfdfdf;">&nbsp;</td></tr></table></td></tr><tr><td><table cellpadding="0" cellspacing="0" width="100%"><tr><td style="width:25px;" width="25px;"></td><td align=""><div style="line-height:40px;height:40px;"></div><p style="margin:0px;padding:0px;"><strong style="font-size:14px;line-height:24px;color:#333333;font-family:arial,sans-serif;">亲爱的用户：</strong></p><p style="margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:"宋体",arial,sans-serif;">您好！</p><p style="margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:"宋体",arial,sans-serif;">您于'.date('Y年m月d日 h:i').'使用邮箱'.$B.'注册V-Get!帐号，点击以下链接，即可激活该帐号：</p><p style="margin:0px;padding:0px;"><a href="http://i.v-get.com/e/SignUpVerify?code='.$V.'&amp;lk='.$lk.'" style="line-height:24px;font-size:12px;font-family:arial,sans-serif;color:#0000cc" target="_blank">http://i.v-get.com/e/SignUpVerify?code='.$V.'&amp;lk='.$lk.'</a></p><p style="margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:arial,sans-serif;">(如果您无法点击此链接，请将它复制到浏览器地址栏后访问)</p><p style="margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:"宋体",arial,sans-serif;">1、为了保障您帐号的安全性，请在 48小时内完成激活，此链接将在您激活过一次后失效！</p><p style="margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:"宋体",arial,sans-serif;">2、请尽快完成激活，否则过期，即2013年 01月26日 02:34后百度将有权收回该帐号。</p><div style="line-height:80px;height:80px;"></div><p style="margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:"宋体",arial,sans-serif;">V-Get!帐号团队</p><p style="margin:0px;padding:0px;line-height:24px;font-size:12px;color:#333333;font-family:"宋体",arial,sans-serif;">'.date('Y年m月d日').'</p></td></tr></table></td></tr><tr><td><table style="border-top:1px solid #dfdfdf" cellpadding="0" cellspacing="0" width="100%"><tr><td style="width:25px;" width="25px;"></td><td align=""><div style="line-height:40px;height:40px;"></div><p style="margin:0px;padding:0px;line-height:24px;font-size:12px;color:#979797;font-family:"宋体",arial,sans-serif;">若您没有注册过V-Get!帐号，请忽略此邮件，此帐号将不会被激活，由此给您带来的不便请谅解。</p></td></tr></table></td></tr></table>';

	$Cail->MsgHTML($html); //推送的邮件内容
	
	$Cail->IsHTML(true); 

	if(!$Cail->Send()) {header("Content-Type: text/html; charset=utf-8");echo '验证邮件已发送到',$B,'，您需要点击邮件中的确认链接来完成注册！';} 
	else {header("Content-Type: text/html; charset=utf-8");echo '验证邮件已发送到',$B,'，您需要点击邮件中的确认链接来完成注册！';}

}
else {
header("location:http://i.v-get.com/e/SignUp"); 

}

?>