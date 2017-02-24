<?php
require 'Textclass.php';
$servername  = 'localhost';
$dbusername  = 'root'; //root修改为数据库账户，
$dbpassword  = '111111'; //修改为数据库密码
$dbname  = 'digsky0_chengyu'; //您的数据库名称。
$db = mysql_connect($servername, $dbusername,$dbpassword);
mysql_query("set names'gbk'");
mysql_select_db($dbname,$db) or die ('不能连接数据库！');
require 'smarty/libs/Smarty.class.php';
$smarty = new Smarty;
$smarty->template_dir = "smarty/templates/templates"; //模板文件目录
$smarty->compile_dir = "smarty/templates/templates_c";
$smarty->config_dir = "smarty/templates/config";
$smarty->cache_dir = "smarty/templates/cache";
$smarty->caching = false;
?>