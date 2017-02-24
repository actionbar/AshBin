<?php
header("Access-Control-Allow-Origin: *");
include __DIR__ . '/../../c_tf.php';

use Thrift\Transport\TPhpStream;

$TPhpStream = new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W);
$TBufferedTransport = new \Thrift\Transport\TBufferedTransport($TPhpStream);

/*
 * 这里是服务端，需要用客户端调用，否则会一直报错
 * */

if(empty($_GET['p']) || 'compact' == $_GET['p']){
    $protocol_input = new Thrift\Protocol\TCompactProtocol($TBufferedTransport);
}
else if('json' == $_GET['p']){
    $protocol_input = new \Thrift\Protocol\TJSONProtocol($TBufferedTransport);
}
else if('bin' == $_GET['p']){
    $protocol_input = new Thrift\Protocol\TBinaryProtocol($TBufferedTransport, true, true);
}

$protocol_output = $protocol_input;

$Handler = new \Ctrl\TfSsoSign();
$Processor = new \Tf\Sso\SignProcessor($Handler);



$TBufferedTransport->open();
$Processor->process($protocol_input, $protocol_output);
$TBufferedTransport->close();

header('Content-Type', 'application/x-thrift');
if ('cli' == PHP_SAPI) {
    ini_set("display_errors", "stderr");
    echo "\r\n";
}