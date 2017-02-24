<?php
$v=$_POST['v'];
function app_hash_url($v){
	$seed="Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE.";
	$result=0x01020345;
	for($i=0;$i<strlen($v);$i++){
		$result^=ord($seed{$i%87})^ord($v{$i});
		$result=(($result>>23)&0x1FF)|$result<<9;
	}
	return sprintf("8%x",$result);
}
$PR_CH=app_hash_url($v);
$L='http://toolbarqueries.google.com/tbr?client=navclient-auto&features=Rank&q=info:'.$v.'&ch='.$PR_CH;
echo file_get_contents($L),file_get_contents('http://'.$v);
?>