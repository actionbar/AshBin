<?php
$l='v-get.com';
$h= file_get_contents('http://whois.chinaz.com/'.$l);
echo $h;
?>