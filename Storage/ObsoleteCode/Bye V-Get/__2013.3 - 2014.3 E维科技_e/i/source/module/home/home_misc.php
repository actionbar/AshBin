<?php
if(!defined('IN_DISCUZ')) {exit('Access Denied');}

$ac = empty($_GET['ac']) ? '' : $_GET['ac'];
$acs = array('lostpasswd', 'swfupload', 'inputpwd', 'ajax', 'seccode', 'sendmail', 'emailcheck');
if(empty($ac) || !in_array($ac, $acs)) {showmessage('enter_the_space', 'home.php?mod=space');}

$theurl = 'home.php?mod=misc&ac='.$ac;
require_once libfile('misc/'.$ac, 'include');

?>