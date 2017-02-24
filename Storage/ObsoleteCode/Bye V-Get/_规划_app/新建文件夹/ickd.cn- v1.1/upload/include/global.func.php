<?php
if(!defined('IN_TW')) {
	exit('Access Denied');
}
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$operation=strtoupper($operation);
	$ckey_length = 4;
	$key = md5($key ? $key : TW_AUTH_KEY);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);

	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);

	$result = '';
	$box = range(0, 255);

	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}

	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}

	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}

	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}

}
function cutstr($string, $length, $dot = ' ...') {
	if(strlen($string) <= $length) {
		return $string;
	}

	$pre = chr(1);
	$end = chr(1);
	$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array($pre.'&'.$end, $pre.'"'.$end, $pre.'<'.$end, $pre.'>'.$end), $string);

	$strcut = '';
	if(strtolower(CHARSET) == 'utf-8') {

		$n = $tn = $noc = 0;
		while($n < strlen($string)) {

			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t <= 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}

			if($noc >= $length) {
				break;
			}

		}
		if($noc > $length) {
			$n -= $tn;
		}

		$strcut = substr($string, 0, $n);

	} else {
		for($i = 0; $i < $length; $i++) {
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}

	$strcut = str_replace(array($pre.'&'.$end, $pre.'"'.$end, $pre.'<'.$end, $pre.'>'.$end), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);

	$pos = strrpos($strcut, chr(1));
	if($pos !== false) {
		$strcut = substr($strcut,0,$pos);
	}
	return $strcut.$dot;
}
function daddslashes($string, $force = 0) {
	!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	if(!MAGIC_QUOTES_GPC || $force) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = daddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
	}
	return $string;
}
function dexit($message = '') {
	echo $message;
	exit();
}
function dhtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1',
		//$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
		str_replace(array('&', '"', '<', '>',"'"), array('&amp;', '&quot;', '&lt;', '&gt;','&acute;'), $string));
	}
	return $string;
}
function fileext($filename) {
	return trim(substr(strrchr($filename, '.'), 1, 10));
}
function gbk_json_encode($mix){
	$wap=false;
	if(defined('TW_WAP') && TW_WAP){
		$wap=true;
	}
	function replaceChars($mix){
		if(is_array($mix)){
			foreach($mix as $key=>$val){
				$mix[$key]=replaceChars($val);
			}
		}else{
			$mix=str_replace('\\','\\\\',$mix);
			$mix=str_replace("\r\n",'',$mix);
			$mix=str_replace("\r",'',$mix);
			$mix=str_replace(array('"',"'",'/'),array('\"',"\\'",'\/'),$mix);
			$mix=$wap?$mix:urlencode($mix);
		}
		return $mix;
	}
	if($wap){
		$str='';
		if(!$mix['status'] && $mix['message']){
			$str.='查询失败，参考以下信息<br>'.$mix['message'];
		}elseif($mix['status']&& count($mix['data'])){
			$str.='查询成功';
			foreach($mix['data'] as $r){
				$str.='<br>--------------<br>'.$r['time'].'<br>';
				$str.=$r['context'];
			}
		}
		return $str;
	}else{
		return urldecode(json_encode(replaceChars($mix)));
	}
}

function convert_encoding($mix,$toEncodeing='gbk',$fromEncoding=''){
	if(is_array($mix)){
		foreach($mix as $key=>$val){
			if(is_object($val)){
				$val=get_object_vars($val);
			}
			$mix[$key]=convert_encoding($val,$toEncodeing,$fromEncoding);
		}
	}else{
		$mix=mb_convert_encoding($mix,$toEncodeing,$fromEncoding);
	}
	return $mix;
}

function getrobot() {
	if(!defined('IS_ROBOT')) {
		$kw_spiders = 'Bot|Crawl|Spider|slurp|sohu-search|lycos|robozilla';
		$kw_browsers = 'MSIE|Netscape|Opera|Konqueror|Mozilla';
		if(!strexists($_SERVER['HTTP_USER_AGENT'], 'http://') && preg_match("/($kw_browsers)/i", $_SERVER['HTTP_USER_AGENT'])) {
			define('IS_ROBOT', FALSE);
		} elseif(preg_match("/($kw_spiders)/i", $_SERVER['HTTP_USER_AGENT'])) {
			define('IS_ROBOT', TRUE);
		} else {
			define('IS_ROBOT', FALSE);
		}
	}
	return IS_ROBOT;
}
function isemail($email) {
	return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}
function array2sql($tbl,$arr,$method='INSERT',$arr_con=array()){
		$method=strtolower(trim($method));
		if(!in_array($method,array('insert','update','replace')))
		{
			exit('array2sql参数错误');
		}
		if($method==='insert'||$method==='replace')
		{
			$sql="$method INTO $tbl ";
			$key=$value='(';
			$kcon='`';
			$vcon="'";
			foreach($arr as $k=>$v){
//				$v=str_replace('</br>','',$v);
//				$v=str_replace(array("'",'"','\\','</'),array('&acute;','&quot;','\\\\','&lt;/'),$v);
				$v=daddslashes($v);
				$key.=$kcon.$k.'`';
				$value.=$vcon.$v."'";
				$kcon=',`';
				$vcon=",'";
			}
			$key.=')';
			$value.=')';
			$sql .="$key VALUES $value";
			return $sql;
		}
		elseif($method==='update')
		{
		   $sql="UPDATE {$tbl} SET ";
		   $con='';
		   foreach($arr as $key=>$value)
		   {
			   $sql.=$con."$key='$value'";
			   $con=',';
		   }
		   if($arr_con)
		   {
			   $con='';
			   $sql.=" WHERE ";
			   foreach($arr_con as $key=>$value)
			   {
				   $sql.=$con."$key='$value'";
				   $con=' AND ';
			   }
		   }
		   return $sql;
		}

	}
/**
* 分页函数
*
* @param mixed $num 记录总条数
* @param mixed $perpage 每页记录条数
* @param mixed $curpage 当前页
* @param mixed $mpurl
* @param mixed $maxpages
* @param mixed $page
* @param mixed $autogoto
* @param mixed $simple
*/
function multi($num, $perpage, $curpage, $mpurl, $maxpages = 0, $page = 10, $autogoto = TRUE, $simple = FALSE) {
	$maxpage=10;
	$ajaxtarget = !empty($_GET['ajaxtarget']) ? " ajaxtarget=\"".dhtmlspecialchars($_GET['ajaxtarget'])."\" " : '';

	if(defined('IN_ADMINCP')) {
		$shownum = $showkbd = TRUE;
		$lang['prev'] = '&lsaquo;&lsaquo;';
		$lang['next'] = '&rsaquo;&rsaquo;';
	} else {
		$shownum = $showkbd = FALSE;
		$lang['prev'] = '&lsaquo;&lsaquo; Prev';
		$lang['next'] = 'Next &rsaquo;&rsaquo;';
	}

	$multipage = '';
	if(strpos($mpurl,'@page@')===false) $mpurl .= strpos($mpurl, '?') ? '&amp;' : '?';
	$realpages = 1;
	if($num > $perpage) {
		$offset = 2;

		$realpages = @ceil($num / $perpage);
		$pages = $maxpages && $maxpages < $realpages ? $maxpages : $realpages;

		if($page > $pages) {
			$from = 1;
			$to = $pages;
		} else {
			$from = $curpage - $offset;
			$to = $from + $page - 1;
			if($from < 1) {
				$to = $curpage + 1 - $from;
				$from = 1;
				if($to - $from < $page) {
					$to = $page;
				}
			} elseif($to > $pages) {
				$from = $pages - $page + 1;
				$to = $pages;
			}
		}
		if(strpos($mpurl,'@page@')!==false){
				$multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="'.str_replace('@page@',1,$mpurl).'" class="first"'.$ajaxtarget.'>1 ...</a>' : '').
				($curpage > 1 && !$simple ? '<a href="'.str_replace('@page@',$curpage - 1,$mpurl).'" class="prev"'.$ajaxtarget.'>'.$lang['prev'].'</a>' : '');
			for($i = $from; $i <= $to; $i++) {
				$multipage .= $i == $curpage ? '<strong>'.$i.'</strong>' :
					'<a href="'.str_replace('@page@',$i,$mpurl).($ajaxtarget && $i == $pages && $autogoto ? '#' : '').'"'.$ajaxtarget.'>'.$i.'</a>';
			}

			$multipage .= ($to < $pages ? '<a href="'.str_replace('@page@',$pages,$mpurl).'" class="last"'.$ajaxtarget.'>... '.$realpages.'</a>' : '').
				($curpage < $pages && !$simple ? '<a href="'.str_replace('@page@',$curpage + 1,$mpurl).'" class="next"'.$ajaxtarget.'>'.$lang['next'].'</a>' : '').
				($showkbd && !$simple && $pages > $page && !$ajaxtarget ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\''.$mpurl.'page=\'+this.value; return false;}" /></kbd>' : '');

			$multipage = $multipage ? '<div class="pages">'.($shownum && !$simple ? '<em>&nbsp;'.$num.'&nbsp;</em>' : '').$multipage.'</div>' : '';
		}else{
			$multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="'.$mpurl.'page=1" class="first"'.$ajaxtarget.'>1 ...</a>' : '').
				($curpage > 1 && !$simple ? '<a href="'.$mpurl.'page='.($curpage - 1).'" class="prev"'.$ajaxtarget.'>'.$lang['prev'].'</a>' : '');
			for($i = $from; $i <= $to; $i++) {
				$multipage .= $i == $curpage ? '<strong>'.$i.'</strong>' :
					'<a href="'.$mpurl.'page='.$i.($ajaxtarget && $i == $pages && $autogoto ? '#' : '').'"'.$ajaxtarget.'>'.$i.'</a>';
			}

			$multipage .= ($to < $pages ? '<a href="'.$mpurl.'page='.$pages.'" class="last"'.$ajaxtarget.'>... '.$realpages.'</a>' : '').
				($curpage < $pages && !$simple ? '<a href="'.$mpurl.'page='.($curpage + 1).'" class="next"'.$ajaxtarget.'>'.$lang['next'].'</a>' : '').
				($showkbd && !$simple && $pages > $page && !$ajaxtarget ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\''.$mpurl.'page=\'+this.value; return false;}" /></kbd>' : '');

			$multipage = $multipage ? '<div class="pages">'.($shownum && !$simple ? '<em>&nbsp;'.$num.'&nbsp;</em>' : '').$multipage.'</div>' : '';
		}
	}
	
	$maxpage = $realpages;
	return $multipage;
}
function tbr2nl($str){
	if(is_array($str))
	{
		foreach($str as $key=>$val){
			$str[$key]=tbr2nl($str);
		}
	}else{
		$str= preg_replace('/<br[^\d\w]*?\/>/i',"\r\n",$str);
	}
	return $str;
}
function tnl2br($str){
	if(is_array($str))
	{
		foreach($str as $key=>$val){
			$str[$key]=tnl2br($str);
		}
	}else{
		$str=str_replace("\r\n","</p>\r\n<p>",$str);
	}
	return $str;
}
function thtmlspecialchars($string){
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = thtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
		str_replace(array('&', '"', '<', '>',"'","\r\n","\n"), array('&amp;', '&quot;', '&lt;', '&gt;','&#39;','',''), $string));
	}
	return $string;
}
function output($filename=''){
	if(defined('TW_HTMLIZE')){
		$content = ob_get_contents();
		ob_end_clean();
		$GLOBALS['gzipcompress'] ? ob_start('ob_gzhandler') : ob_start();
		$filename=trim($filename,'/');
		if($filename){
			$fp=@fopen(TW_ROOT.'./'.$filename,'w');
			@flock($fp,LOCK_EX);
			@fwrite($fp,$content);
			@flock($fp,LOCK_UN);
			@fclose($fp);
			echo '生成',$filename,'成功';
		}else{
			echo $content;
		}
	}
	ob_end_flush();
}
/**
* 检查一个字符串是否存在
*
* @param mixed $haystack
* @param mixed $needle
* @return TRUE if Exists OR False if NoExists
*/
function strexists($haystack, $needle) {
	return !(strpos($haystack, $needle) === FALSE);
}
function ttrim($str,$charlist=''){
	return trim($str,"$charlist \t\n\r\0\x0B");
}
/**
* 去除数组元素中的HTML标签
*
* @param string $value
* @param mixed $key
* @param mixed $allowable_tags
*/
function array_strip_tags(&$value,$key,$allowable_tags =''){
	$value=trim(strip_tags($value,$allowable_tags));
	$value=str_replace("\r\n",'',$value);
	if(strpos($value,"\r")!==false){
		 $value=str_replace("\r",'',$value);
	}
	if(strpos($value,"\n")!==false){
		$value=str_replace("\n",'',$value);
	}
}
function fatal_error_handler($buffer,$mode){
	if(strpos($buffer,'Fatal error')!==false){
		$error=array(
			'status'=>0,
			'message'=>'服务器内部错误'
		);
		if(strpos($buffer,'Maximum execution time')!==false){
			$error['message']='对不起，查询超时。';
		}
		$buffer=gbk_json_encode($error);
	}
	if(function_exists('ob_gzhandler')){
		return ob_gzhandler($buffer,$mode);
	}else{
		return $buffer;
	}
}
function parse_query_str($str){
	if(strpos($str,'?')!==false){
		$str=substr($str,strpos($str,'?')+1);
	}
	$array=explode('&',$str);
	$reArray=array();
	foreach($array as $query){
		$n=strpos($query,'=');
		if($n!==false){
			$key=substr($query,0,$n);
			$value=substr($query,$n+1);
			$reArray[$key]=$value;   
		}else{
			$reArray[$query]='ERROR DATA';
		}
	}
	return $reArray;
}
function onlineip(){
		if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
	} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$onlineip = getenv('REMOTE_ADDR');
	} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$onlineip = $_SERVER['REMOTE_ADDR'];
	}

	preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
	$onlineip = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';
	unset($onlineipmatches);
	return $onlineip;
}
/**
* 显示404错误页面
* 
*/
function error404(){
	@header("HTTP/1.0 404 Not Found");
	@header("Status: 404 Not Found");
	require TW_ROOT.'./404.html';
	exit;
}
?>