<?php
if (!defined("IN_IVB"))
{
	exit("Access Denied");
}
class myException extends Exception 
{
	/**
	 * 记录日志
	 * 
	 * @param string $file 错误日志文件名
	 * @param string $msg  错误内容
	 */
	public function log($message, $file = 'errors')
	{
		global $timestamp;
		$file = DATA_DIR . 'logs/' . $file . '.log';
		$message = date("Y-m-d H:i:s", $timestamp) ."\t". $message.chr(0)."\n";
		error_log($message, 3, $file);
	}
	
	/**
	 * 输出异常信息
	 *
	 * @param string $file 显示异常信息的视图模板
	 * @param array $message 异常信息数组，格式: array('msg' => 异常说明, 'link' => 返回链接地址);
	 */
	public function output($message)
	{
		global $boardurl;
$contents =<<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>程序出现异常</title>
</head>
<body bgcolor="#fff">
<table cellpadding="0" cellspacing="0" border="0" width="600" align="center" height="85%">
	<tr align="center" valign="middle">
		<td>
			<table cellpadding="10" cellspacing="0" border="0" width="80%" align="center" style="font-family: Verdana, Tahoma; color: #666666; font-size: 9px">
				<tr>
					<td valign="middle" align="center" bgcolor="#EBEBEB">
					<br /><b style="font-size: 10px">##error_message##</b>
					<br /><br /><br />不好意思，我们的系统出了点问题.
					<br />请您稍等后<a href="##link##">重刷页面</a>或回到<a href="{$boardurl}">首页</a>.
					<br /><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
EOD;
		if (!isset($message['msg'])) $message['msg'] = '程序出现异常';
		if (!isset($message['link'])) $message['link'] = $boardurl;
		
		$contents = str_replace('##error_message##', $message['msg'], $contents);
		$contents = str_replace('##link##', $message['link'], $contents);

		echo $contents;
		exit;
	}
}
?>