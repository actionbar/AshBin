<?php
header("Access-Control-Allow-Origin: *");

/*
 * 这里是服务端，需要用客户端调用，否则会一直报错
 * */

include __DIR__ . '/../../c_tf.php';
include __DIR__ . '/../../Ctrl/TfTask.php';



use Thrift\Transport\TPhpStream;

$TPhpStream = new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W);


if(empty($_GET['p']) || 'compact' == $_GET['p']){
    $protocol_input = new Thrift\Protocol\TCompactProtocol($TBufferedTransport);
}
else if('json' == $_GET['p']){
    $protocol_input = new \Thrift\Protocol\TJSONProtocol($TBufferedTransport);
}
else if('bin' == $_GET['p']){
    $protocol_input = new Thrift\Protocol\TBinaryProtocol($TBufferedTransport, true, true);
}



$protocol_input = new \Thrift\Protocol\TJSONProtocol($TBufferedTransport);
$protocol_output = $protocol_input;

$TaskCtrl = new \Ctrl\TfTask();
$TestProcessor = new \Tf\Task\SignActProcessor($TaskCtrl);

$TBufferedTransport->open();
$TestProcessor->process($protocol_input, $protocol_output);
$TBufferedTransport->close();

header('Content-Type', 'application/x-thrift');
if ('cli' == PHP_SAPI) {
    ini_set("display_errors", "stderr");
    echo "\r\n";
}