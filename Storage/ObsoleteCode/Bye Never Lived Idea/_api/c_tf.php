<?php
include 'Conf/Server.php';
include \Conf\Server::DOCUMENT_ROOT .'/C/AutoLoad/AutoLoad.php';
include \Conf\Server::DOCUMENT_ROOT .'/C/AutoLoad/FileDefinitionThrift.php';


$AutoLoad = new \C\AutoLoad\AutoLoad();
$FileDefinitionThrift = new \C\AutoLoad\FileDefinitionThrift();


//公用类 C/
$AutoLoad->registerNamespace('C', \Conf\Server::DOCUMENT_ROOT);
$AutoLoad->registerNamespace('Conf', \Conf\Server::DOCUMENT_ROOT);
$AutoLoad->registerNamespace('Ctrl', \Conf\Server::DOCUMENT_ROOT);
$AutoLoad->registerNamespace('Mdl', \Conf\Server::DOCUMENT_ROOT);
// Thrift 库的位置 C/Thrift
$AutoLoad->registerNamespace('Thrift', \Conf\Server::DOCUMENT_ROOT . '/C');

// Thrift 生成文件位置
$AutoLoad->registerDefinitionClass('Tf', \Conf\Server::DOCUMENT_ROOT, $FileDefinitionThrift);

$AutoLoad->register();

