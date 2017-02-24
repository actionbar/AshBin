<?php
$l=$_POST['v'];
$u= 'http://panda.www.net.cn/cgi-bin/check_muitl.cgi?domain='.$l;
echo file_get_contents($u);
?>