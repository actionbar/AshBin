<?php
/*
	More & Original PHP Framwork
	Copyright (c) 2007 - 2008 IsMole Inc.
	常用函数
	$Id: Global.function.php 149 2008-05-15 06:38:32Z aming $
*/


/**
 * 文本转HTML
 *
 * @param string $txt;
 * return string;
 */
function Text2Html($txt){
	$txt = str_replace("  ","　",$txt);
	$txt = str_replace("<","&lt;",$txt);
	$txt = str_replace(">","&gt;",$txt);
	$txt = preg_replace("/[\r\n]{1,}/isU","<br/>\r\n",$txt);
	return $txt;
}

/**
 * 获得IP
 */
function GetIP(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"])) { $cip = $_SERVER["HTTP_CLIENT_IP"]; }
	else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) { $cip = $_SERVER["HTTP_X_FORWARDED_FOR"]; }
	else if(!empty($_SERVER["REMOTE_ADDR"])) { $cip = $_SERVER["REMOTE_ADDR"]; }
	else $cip = "";
	preg_match("/[\d\.]{7,15}/", $cip, $cips);
	$cip = $cips[0] ? $cips[0] : 'unknown';
	unset($cips);
	return $cip;
}

/**
 * 获取IP所在地
 *
 * @param string $ip;
 * return string;
 */
function convertIp($ip) {
	$return = '';
	if(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip)) {
		$iparray = explode('.', $ip);
		if($iparray[0] == 10 || $iparray[0] == 127 || ($iparray[0] == 192 && $iparray[1] == 168) || ($iparray[0] == 172 && ($iparray[1] >= 16 && $iparray[1] <= 31))) {
			$return = '- LAN';
		} elseif ($iparray[0] > 255 || $iparray[1] > 255 || $iparray[2] > 255 || $iparray[3] > 255) {
			$return = '- Invalid IP Address';
		} else {
			$ipfile = MOOPHP_ROOT.'/plugins/ipdata/wry.dat';
			if(!@file_exists($ipfile)) {
				$return = convertIpFull($ip, $ipfile);
			}
		}
	}
	return $return;
}

function convertIpFull($ip, $ipdatafile) {

	if(!$fd = @fopen($ipdatafile)) {
		return '- Invalid IP data file';
	}

	$ip = explode('.', $ip);
	$ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];

	if(!($DataBegin = fread($fd, 4)) || !($DataEnd = fread($fd, 4)) ) return;
	@$ipbegin = implode('', unpack('L', $DataBegin));
	if($ipbegin < 0) $ipbegin += pow(2, 32);
	@$ipend = implode('', unpack('L', $DataEnd));
	if($ipend < 0) $ipend += pow(2, 32);
	$ipAllNum = ($ipend - $ipbegin) / 7 + 1;

	$BeginNum = $ip2num = $ip1num = 0;
	$ipAddr1 = $ipAddr2 = '';
	$EndNum = $ipAllNum;

	while($ip1num > $ipNum || $ip2num < $ipNum) {
		$Middle= intval(($EndNum + $BeginNum) / 2);

		fseek($fd, $ipbegin + 7 * $Middle);
		$ipData1 = fread($fd, 4);
		if(strlen($ipData1) < 4) {
			fclose($fd);
			return '- System Error';
		}
		$ip1num = implode('', unpack('L', $ipData1));
		if($ip1num < 0) $ip1num += pow(2, 32);

		if($ip1num > $ipNum) {
			$EndNum = $Middle;
			continue;
		}

		$DataSeek = fread($fd, 3);
		if(strlen($DataSeek) < 3) {
			fclose($fd);
			return '- System Error';
		}
		$DataSeek = implode('', unpack('L', $DataSeek.chr(0)));
		fseek($fd, $DataSeek);
		$ipData2 = fread($fd, 4);
		if(strlen($ipData2) < 4) {
			fclose($fd);
			return '- System Error';
		}
		$ip2num = implode('', unpack('L', $ipData2));
		if($ip2num < 0) $ip2num += pow(2, 32);

		if($ip2num < $ipNum) {
			if($Middle == $BeginNum) {
				fclose($fd);
				return '- Unknown';
			}
			$BeginNum = $Middle;
		}
	}

	$ipFlag = fread($fd, 1);
	if($ipFlag == chr(1)) {
		$ipSeek = fread($fd, 3);
		if(strlen($ipSeek) < 3) {
			fclose($fd);
			return '- System Error';
		}
		$ipSeek = implode('', unpack('L', $ipSeek.chr(0)));
		fseek($fd, $ipSeek);
		$ipFlag = fread($fd, 1);
	}

	if($ipFlag == chr(2)) {
		$AddrSeek = fread($fd, 3);
		if(strlen($AddrSeek) < 3) {
			fclose($fd);
			return '- System Error';
		}
		$ipFlag = fread($fd, 1);
		if($ipFlag == chr(2)) {
			$AddrSeek2 = fread($fd, 3);
			if(strlen($AddrSeek2) < 3) {
				fclose($fd);
				return '- System Error';
			}
			$AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
			fseek($fd, $AddrSeek2);
		} else {
			fseek($fd, -1, SEEK_CUR);
		}

		while(($char = fread($fd, 1)) != chr(0))
		$ipAddr2 .= $char;

		$AddrSeek = implode('', unpack('L', $AddrSeek.chr(0)));
		fseek($fd, $AddrSeek);

		while(($char = fread($fd, 1)) != chr(0))
		$ipAddr1 .= $char;
	} else {
		fseek($fd, -1, SEEK_CUR);
		while(($char = fread($fd, 1)) != chr(0))
		$ipAddr1 .= $char;

		$ipFlag = fread($fd, 1);
		if($ipFlag == chr(2)) {
			$AddrSeek2 = fread($fd, 3);
			if(strlen($AddrSeek2) < 3) {
				fclose($fd);
				return '- System Error';
			}
			$AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0)));
			fseek($fd, $AddrSeek2);
		} else {
			fseek($fd, -1, SEEK_CUR);
		}
		while(($char = fread($fd, 1)) != chr(0))
		$ipAddr2 .= $char;
	}
	fclose($fd);

	if(preg_match('/http/i', $ipAddr2)) {
		$ipAddr2 = '';
	}
	$ipaddr = "$ipAddr1 $ipAddr2";
	$ipaddr = preg_replace('/CZ88\.NET/is', '', $ipaddr);
	$ipaddr = preg_replace('/^\s*/is', '', $ipaddr);
	$ipaddr = preg_replace('/\s*$/is', '', $ipaddr);
	if(preg_match('/http/i', $ipaddr) || $ipaddr == '') {
		$ipaddr = '- Unknown';
	}

	return '- '.$ipaddr;

}

/**
*分页函数
*
*
*/
function multi($total, $perPage, $curPage, $pageUrl, $maxPages = 0, $page = 10, $autoGoTo = TRUE, $simple = FALSE) {
	$multiPage = '';
	$pageUrl .= strpos($pageUrl, '?') ? '&amp;' : '?';
	$realPages = 1;
	if($total > $perPage) {
		$offset = 2;

		$realPages = @ceil($total / $perPage);
		$pages = $maxPages && $maxPages < $realPages ? $maxPages : $realPages;

		if($page > $pages) {
			$from = 1;
			$to = $pages;
		} else {
			$from = $curPage - $offset;
			$to = $from + $page - 1;
			if($from < 1) {
				$to = $curPage + 1 - $from;
				$from = 1;
				if($to - $from < $page) {
					$to = $page;
				}
			} elseif ($to > $pages) {
				$from = $pages - $page + 1;
				$to = $pages;
			}
		}

		$multiPage = ($curPage - $offset > 1 && $pages > $page ? '<a href="'.$pageUrl.'page=1" class="first"'.$ajaxtarget.'>1 ...</a>' : '').
			($curPage > 1 && !$simple ? '<a href="'.$pageUrl.'page='.($curPage - 1).'" class="prev"'.$ajaxtarget.'>&lsaquo;&lsaquo;</a>' : '');
		for($i = $from; $i <= $to; $i++) {
			$multiPage .= $i == $curPage ? '<strong>'.$i.'</strong>' :
				'<a href="'.$pageUrl.'page='.$i.($ajaxtarget && $i == $pages && $autoGoTo ? '#' : '').'"'.$ajaxtarget.'>'.$i.'</a>';
		}

		$multiPage .= ($curPage < $pages && !$simple ? '<a href="'.$pageUrl.'page='.($curPage + 1).'" class="next"'.$ajaxtarget.'>&rsaquo;&rsaquo;</a>' : '').
			($to < $pages ? '<a href="'.$pageUrl.'page='.$pages.'" class="last"'.$ajaxtarget.'>... '.$realPages.'</a>' : '').
			(!$simple && $pages > $page && !$ajaxtarget ? '<kbd><input type="text" name="custompage" size="3" onkeydown="if(event.keyCode==13) {window.location=\''.$pageUrl.'page=\'+this.value; return false;}" /></kbd>' : '');

		$multiPage = $multiPage ? '<div class="pages">'.(!$simple ? '<em>&nbsp;'.$total.'&nbsp;</em>' : '').$multiPage.'</div>' : '';
	}
	$maxpage = $realPages;
	return $multiPage;
}

function dhtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
		str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
	}
	return $string;
}