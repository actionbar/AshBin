<?php

// 不要用 extensions/phpmailer/PHPMailerAutoload.php，直接删掉这个文件，因为这里面有 __autoload() ，修改class.phpmailer.php中
/*
 public function __construct($exceptions = false)
{

$this->exceptions = ($exceptions == true);

require 'class.smtp.php';

}
*/


require_once YSX_CORE_CLASS_DIR . '/_e/phpmailer/class.phpmailer.php';
require_once YSX_CORE_CLASS_DIR . '/_e/phpmailer/class.smtp.php';


class CMail {
    public $sendTo; // 发送的邮件
    public $sendToUser; // 发送达的用户名
    public $subject; // 主题
    public $msgHtml; // 邮件 html格式
    public $msgPlain; // 无法显示html格式的时候，显示这个

    //public $Mailer;
    public $host;
    public $from;
    public $AddReplyTo;
    public $addCC;
    public $addBCC;
    public $fromName;
    public $smtpUsername;
    public $smtpPass;
    public $smtpSecure;
    public $port;
    public $smtpAuth = true;
    public $smtpDebug = 0;
    public $charSet = 'UTF-8';


    function send() {
        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth = $this->smtpAuth;
        $mail->Host = $this->host;
        $mail->Username = $this->smtpUsername;
        $mail->Password = $this->smtpPass;


        //$mail->setLanguage('zh_cn', 'protected/extensions/phpmailer/language/');


        $mail->From = $this->from;
        $mail->FromName = $this->fromName;
        $mail->addAddress($this->sendTo, $this->sendToUser);
        //$mail->addReplyTo($this->$AddReplyTo);
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = $this->smtpDebug;
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true); // Set mail format to HTML

        $mail->CharSet = $this->charSet;
        $mail->Subject = $this->subject;
        $mail->Body = $this->msgHtml;
        $mail->AltBody = $this->msgPlain;

        return $mail->Send();
    }
}