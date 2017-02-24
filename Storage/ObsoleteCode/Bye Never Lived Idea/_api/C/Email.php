<?php

namespace C;

/*
 * 这里是引入 PhpMailer
 * 不要用 extensions/phpmailer/PHPMailerAutoload.php，直接删掉这个文件，因为这里面有 __autoload() ，直接引入
*/


class Email{
    public static $dirEmail = '/C';
    public static $charSet = 'UTF-8';
    public $subject; // 主题
    public $msgHtml; // 邮件 html格式
    public $msgPlain; // 无法显示html格式的时候，显示这个


    public $addReplyTo;


    public $smtpAuth = true;
    public $smtpDebug = 0;
    private $mailer;
    private $sendTo; // 发送达的用户名
    private $sendToName; // recipient's Email
    private $sendToCC;
    private $sendToBCC;
    private $from;
    private $fromName;

    public function setAddressee($send_to, $send_to_name = '', $cc = '', $bcc = ''){
        $this->sendTo = $send_to;
        $this->sendToName = empty($send_to_name) ? $send_to : $send_to_name;
        // cc / bcc
    }

    public function setFrom($from, $from_name){
        $this->from = $from;
        $this->fromName = empty($from_name) ? $from : $from_name;
    }

    public function setSMTP($host, $user, $pwd, $auth = true){
        if(!class_exists('PhpMailer')){
            require self::$dirEmail . '/phpmailer/class.phpmailer.php';
            require self::$dirEmail . '/phpmailer/class.smtp.php';
        }
        $this->mailer = new \PhpMailer();
        $this->mailer->IsSMTP();
        $this->mailer->Host = $host;
        $this->mailer->SMTPAuth = $auth;

        $this->mailer->Username = $user;
        $this->mailer->Password = $pwd;
    }

    public function send(){
        $this->mailer->From = $this->from;
        $this->mailer->FromName = $this->fromName;
        $this->mailer->addAddress($this->sendTo, $this->sendToName);
        $this->mailer->isHTML(true);
        $this->mailer->CharSet = self::$charSet;
        $this->mailer->Subject = $this->subject;
        $this->mailer->Body = $this->msgHtml;
        $this->mailer->AltBody = $this->msgPlain;
        $this->mailer->Send();
    }

} 