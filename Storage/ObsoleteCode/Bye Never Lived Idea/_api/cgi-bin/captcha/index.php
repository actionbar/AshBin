<?php
include __DIR__ . '/../../c_tf.php';


$CSess = new \C\Cache\Sess();
$captcha = $CSess->genCaptcha(4);


$CCgiCaptcha = new \C\Cgi\Captcha();

if(!empty($_GET['f'])){
    $CCgiCaptcha::$width = $_GET['w'];
    $CCgiCaptcha::$height = $_GET['h'];
    $CCgiCaptcha::$fontSize = $_GET['f'];
}

$CCgiCaptcha::$fontDir = \Conf\Server::DOCUMENT_ROOT . '/e/fonts';
$CCgiCaptcha->output($captcha);
$captcha = $CCgiCaptcha::$captchaCode;