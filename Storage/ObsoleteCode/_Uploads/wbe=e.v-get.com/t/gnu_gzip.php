<?php
$L=$_POST['v'];
$c=curl_init();
curl_setopt($c,CURLOPT_URL,$L);
curl_setopt($c,CURLOPT_HEADER,1);
curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
curl_setopt($c,CURLOPT_ENCODING,'');
$s=curl_exec($c); 
if(!curl_errno($c))
{$h=curl_getinfo($c);
    $l=$h['header_size'];
    $x=substr($s,0,$l);
    echo $x,'|';
	curl_setopt($c,CURLOPT_ENCODING,'identity');
    $s=curl_exec($c); 
	 $l=$h['header_size'];
    $x=substr($s,0,$l);
	echo $x;}
?>