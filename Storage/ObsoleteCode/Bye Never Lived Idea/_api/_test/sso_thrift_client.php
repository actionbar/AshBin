<?php
include __DIR__ . '/../c_tf.php';

//use Thrift\Protocol\TBinaryProtocol;
use Thrift\Protocol\TJSONProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

try{

    $socket = new THttpClient('api.luexu.com', 8080, '/1/sso/?p=compact');
    $transport = new TBufferedTransport($socket, 1024, 1024);
    //$protocol = new \Thrift\Protocol\TBinaryProtocol($transport);
    //$protocol = new TJSONProtocol($transport);
    $protocol = new \Thrift\Protocol\TCompactProtocol($transport);


    $SsoHandle = new \Ctrl\TfSsoSign();
    $transport->open();
    try {
        $SsoHandle->isAccountValid('15000777963', 2);
        // 客户端通过 $sign_act_handle 来调用
    } catch (\Tf\Sso\Err $err) {
        echo 'Error Code: ', $err->id , '; Error Message: ', $err->msg;
    }

    $transport->close();

} catch(TException $tx){
    print 'TException: -------' . $tx->getMessage() . "\n";
}