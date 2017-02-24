<?php
$v=$_POST['v'];
// 如果返回空，就是PR0
function app_hash_url($v){
	$seed="Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE.";
	$r=0x01020345;$l=strlen($v);
	for($i=0;$i<$l;$i++){
		$r^=ord($seed{$i%87})^ord($v{$i});
		//$r=(($r>>23)&0x1FF)|($r<<9&0xFFFFFFFF);，预防64位系统和32位系统
	  $r=(($r>>23)&511)|($r<<9&4294967295);
	}
	return sprintf("8%x",$r);
}
$PR_CH=app_hash_url($v);
$L='http://toolbarqueries.google.com.hk/tbr?client=navclient-auto&features=Rank&q=info:'.$v.'&ch='.$PR_CH;
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$L);curl_exec($ch);
// 后面一个用于算外链，计算外链输出值
curl_setopt($ch,CURLOPT_URL,$v);curl_exec($ch);
curl_close($ch);
?>