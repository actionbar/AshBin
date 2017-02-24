<?php
class c_mail{
	public $SendTo;  // 发送的邮件
	public $SendToUser;  // 发送达的用户名
	public $Subject;  // 主题
	public $MessageHTML; // 邮件 html格式
	public $MessagePlain;  // 无法显示html格式的时候，显示这个

	//public $Mailer;
	public $Host;
	public $From;
	public $AddReplyTo;
	public $AddCC;
	public $AddBCC;
	public $FromName;
	public $SMTPUsername;
	public $SMTPPass;
	public $SMTPSecure;
	public $Port;


	
	function Send(){
		// 不要用 extensions/phpmailer/PHPMailerAutoload.php，直接删掉这个文件，因为这里面有 __autoload() ，修改class.phpmailer.php中
        /* 
         public function __construct($exceptions = false)
    {

        $this->exceptions = ($exceptions == true);
    
        require 'class.smtp.php';
         
    }
        */
	require_once '../_e/phpmailer/class.phpmailer.php';
    require_once '../_e/phpmailer/class.smtp.php';
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = $this->Host;
	$mail->Username = $this->SMTPUsername;
	$mail->Password = $this->SMTPPass;

	
	//$mail->setLanguage('zh_cn', 'protected/extensions/phpmailer/language/');

	
	$mail->From = $this->From;
	$mail->FromName = $this->FromName;
	$mail->addAddress($this->SendTo, $this->SendToUser);
	// $mail->addAddress($this->$sendTo, 'Josh Adams');  // Name is optional
	//$mail->addReplyTo($this->$AddReplyTo);
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set mail format to HTML

	$mail->CharSet = 'UTF-8';
	$mail->Subject = $this->Subject;
	$mail->Body = $this->MessageHTML;
	$mail->AltBody = $this->MessagePlain;
    
	return $mail->Send();
	}
}