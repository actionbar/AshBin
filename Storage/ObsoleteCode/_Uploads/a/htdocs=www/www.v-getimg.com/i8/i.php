<?php
$ad=array('200x200'=>array(0=>'http://www.v-get.com/',1=>'http://www.v-get.com/',2=>'http://www.v-get.com/'),'960x60'=>array(0=>'http://www.v-get.com/',1=>'http://www.v-get.com/',2=>'http://www.v-get.com/',3=>'http://e.v-get.com/'));
$A=$_GET['a'];
$aa=$ad[$A];
$all=array_rand($aa,1);
echo 'var AD=\'<a href="',$aa[$all],'"><img src="http://www.v-get.com/www.v-getimg.com/i8/',$A,'/',$all,'.gif"/></a>\';';
?>