<?php
//以下代码实现从客户端获取IP，操作系统，浏览器的信息
class clientGetObj //类
{
	function getBrowse() //取浏览器版本函数
	{
		global $_SERVER;

		if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0"))
		return "Internet Explorer 8.0";
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0"))
		return "Internet Explorer 7.0";
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0"))
		return "Internet Explorer 6.0";
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Firefox/3"))
		return "Firefox 3";
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Firefox/2"))
		return "Firefox 2";
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Chrome"))
		return "Google Chrome";
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Safari"))
		return "Safari";
		else if(strpos($_SERVER["HTTP_USER_AGENT"],"Opera"))
		return "Opera";
		else return "未知";

	}
	function getIP () //取IP函数
	{
		global $_SERVER;
		if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		} else if (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		} else if (getenv('REMOTE_ADDR')) {
			$ip = getenv('REMOTE_ADDR');
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	function getOS () //取操作系统类型函数
	{
		global $_SERVER;
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$os = false;
		if (eregi('win', $agent) && strpos($agent, '95')){
			$os = 'Windows 95';
		}
		else if (eregi('win 9x', $agent) && strpos($agent, '4.90')){
			$os = 'Windows ME';
		}
		else if (eregi('win', $agent) && ereg('98', $agent)){
			$os = 'Windows 98';
		}
		else if (eregi('win', $agent) && eregi('nt 5.1', $agent)){
			$os = 'Windows XP';
		}
		else if (eregi('win', $agent) && eregi('nt 5', $agent)){
			$os = 'Windows 2000';
		}
		else if (eregi('win', $agent) && eregi('nt', $agent)){
			$os = 'Windows NT';
		}
		else if (eregi('win', $agent) && ereg('32', $agent)){
			$os = 'Windows 32';
		}
		else if (eregi('linux', $agent)){
			$os = 'Linux';
		}
		else if (eregi('unix', $agent)){
			$os = 'Unix';
		}
		else if (eregi('sun', $agent) && eregi('os', $agent)){
			$os = 'SunOS';
		}
		else if (eregi('ibm', $agent) && eregi('os', $agent)){
			$os = 'IBM OS/2';
		}
		else if (eregi('Mac', $agent) && eregi('PC', $agent)){
			$os = 'Macintosh';
		}
		else if (eregi('PowerPC', $agent)){
			$os = 'PowerPC';
		}
		else if (eregi('AIX', $agent)){
			$os = 'AIX';
		}
		else if (eregi('HPUX', $agent)){
			$os = 'HPUX';
		}
		else if (eregi('NetBSD', $agent)){
			$os = 'NetBSD';
		}
		else if (eregi('BSD', $agent)){
			$os = 'BSD';
		}
		else if (ereg('OSF1', $agent)){
			$os = 'OSF1';
		}
		else if (ereg('IRIX', $agent)){
			$os = 'IRIX';
		}
		else if (eregi('FreeBSD', $agent)){
			$os = 'FreeBSD';
		}
		else if (eregi('teleport', $agent)){
			$os = 'teleport';
		}
		else if (eregi('flashget', $agent)){
			$os = 'flashget';
		}
		else if (eregi('webzip', $agent)){
			$os = 'webzip';
		}
		else if (eregi('offline', $agent)){
			$os = 'offline';
		}
		else {
			$os = 'Unknown';
		}
		return $os;
	}
}

