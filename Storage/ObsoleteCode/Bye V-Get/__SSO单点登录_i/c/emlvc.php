<?php



include('eml.php');
include('emlsmtp.php'); 


$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true; 
$mail->Host ='smtp.qq.com';//必填，设置SMTP服务器 QQ邮箱是smtp.qq.com ，QQ邮箱默认未开启，请在邮箱里设置开通。网易的是 smtp.163.com 或 smtp.126.com

$mail->Username = 'www@v-get.com'; // 必填，开通SMTP服务的邮箱；也就是发件人Email。
$mail->Password ='Eml_Q5';

$mail->From = 'www@v-get.com'; 
$mail->FromName = "V-Get!系统反馈"; //发件人



if(!empty($_GET['e'])){
$N=$_GET['n'];
$mail->AddAddress($_GET['e'],$N);  //AddAddress(收件人邮箱，收件人名称)

	
	
	$mail->Subject ="V-Get！注册确认"; //邮件主题
    $r=rand(1000,9999);
	$_SESSION['eml'] = $r;
	
	$html = '<p>您的验证码是：<strong>'.$r.'</strong></p><p>尊敬的'.$N.'：</p><p>您好！感谢您申请注册V-Get! 会员。请在60秒内完成验证输入。</p>';
	
	$mail->MsgHTML($html); //推送的邮件内容
	
	$mail->IsHTML(true); 

	if(!$mail->Send()) {
		header("Content-Type: text/html; charset=utf-8");

		echo '<script>alert("提交失败了！");</script>';
	} else {
		header("Content-Type: text/html; charset=utf-8");
	    echo '<script>alert("提交成功！感谢你的反馈。");</script>';
	}
}
?>