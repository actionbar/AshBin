<?php
$L=$_POST['v']; //网站链接
$c=curl_init();
curl_setopt($c,CURLOPT_URL,$L);
curl_setopt($c,CURLOPT_HEADER,1);  //输出header信息
curl_setopt($c,CURLOPT_RETURNTRANSFER,1);  //不显示网页内容
curl_setopt($c,CURLOPT_ENCODING,''); //允许执行gzip
$s=curl_exec($c); 

if(!curl_errno($c))
{$h=curl_getinfo($c);
    $l=$h['header_size'];  //header字符串体积
    $x=substr($s,0,$l); //获得header字符串，不输出网站内容
    //$split  =array("\r\n","\n","\r");  //需要格式化header字符串
    //$x=str_replace($split,'<br>',$x); //使用<br>换行符格式化输出到网页上
    echo $x,'|';
	curl_setopt($c,CURLOPT_ENCODING,'identity'); //不允许执行gzip
    $s=curl_exec($c); 
	 $l=$h['header_size'];  //header字符串体积
    $x=substr($s,0,$l); //获得header字符串，不输出网站内容
	echo $x;
}



?>