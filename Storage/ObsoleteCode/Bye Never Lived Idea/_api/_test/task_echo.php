<?php

echo '内存使用：', memory_get_usage(), ' byte （未执行PHP代码）', PHP_EOL, '<br>', PHP_EOL;


header("Content-Type: text/html;charset=utf-8");

$dir_root = __DIR__ . '/..';


include $dir_root . '/C/AutoLoad/AutoLoad.php';
include $dir_root . '/C/AutoLoad/FileDefinitionThrift.php';


$AutoLoad = new \C\AutoLoad\AutoLoad();
$FileDefinitionThrift = new \C\AutoLoad\FileDefinitionThrift();
//公用类 C/
$AutoLoad->registerNamespace('C', $dir_root);
$AutoLoad->registerNamespace('Ctrl', $dir_root);
$AutoLoad->registerNamespace('Mdl', $dir_root);
// Thrift 库的位置 C/Thrift
$AutoLoad->registerNamespace('Thrift', $dir_root . '/C');
// Thrift 生成文件位置
$AutoLoad->registerDefinitionClass('Tf', $dir_root, $FileDefinitionThrift);
$AutoLoad->register();


include $dir_root . '/Ctrl/TfTask.php';


$TaskCtrl = new \Ctrl\TfTask();

try{


    /*$BiddingSt = new \Tf\Task\BiddingSt();
    $BiddingSt->transaction = 0;
    $BiddingSt->sorts = 0;
    $BiddingSt->unit_price = 100;
    $BiddingSt->shares = 1;
    $BiddingSt->bond = 10000;
    $BiddingSt->winners = 0;
    $BiddingSt->bidders = 0;
    $BiddingSt->title = '标题';
    $BiddingSt->keywords = '关键词';
    $BiddingSt->description = '简介';
    $BiddingSt->text = '正文';

    $BiddingSt->deadline = 9849494;

    $BiddingSt->lon = 0;
    $BiddingSt->lat = 0;
    $BiddingSt->privacy = 0;
    echo $TaskCtrl->postBidding($BiddingSt);*/


    /*  $BiddingSt = new \Tf\Task\BiddingSt();
        $BiddingSt->id = 1;
        $BiddingSt->text = '+++++++正文++++++++++';
        $TaskCtrl->supplementBidding($BiddingSt);*/


    /* var_dump($TaskCtrl->bidding(1));*/


    /*$BiddingListPSt = new \Tf\Task\BiddingListPSt();
    $BiddingListPSt->biddee = null;
    $BiddingListPSt->transaction = 0;
    var_dump($TaskCtrl->biddingList($BiddingListPSt));*/


    /*    $BidSt = new \Tf\Task\BidSt();
        $BidSt->bidding_id = 1;
        $BidSt->bidder = '大傻逼';
        $BidSt->quotation = 1000;
        $BidSt->bid_security = 100;
        $BidSt->delivery_time = 131;
        $BidSt->text = '竞标详细';
        $BidSt->lon = 1231;
        $BidSt->lat = 1312;
        $BidSt->privacy = 0;
        var_dump($TaskCtrl->postBid($BidSt));*/

    /*  $BidSt = new \Tf\Task\BidSt();
        $BidSt->text = '++++补充竞标++++++';
        $BidSt->bidding_id = 1;
        $TaskCtrl->supplementBid($BidSt);*/

    /*  $BidListPSt = new \Tf\Task\BidListPSt();
        $BidListPSt->bidding_id = 1;
        $BidListPSt->id_offset = 0;
        var_dump($TaskCtrl->bidList($BidListPSt));*/


} catch(\Tf\Sso\Err $Err){
    echo 'Error Code: ', $Err->id, '; Error Message: ', $Err->msg;
}


echo PHP_EOL, '<br> 内存使用：', memory_get_usage(), ' bytes （执行完PHP代码）', PHP_EOL, '<br>', PHP_EOL; // 406048
//unset($tmp);
// echo '', memory_get_usage(); // 313952