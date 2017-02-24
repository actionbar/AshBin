<?php
if(!defined('IN_IVB')) {
	exit('Access Denied');
}

global $PHP_SELF;

$timestamp = time();
$errmsg = '';

$dberror = $this->error();
$dberrno = $this->errno();

if($dberrno == 1114) {

?>
<html>
<head>
<title>Max Onlines Reached</title>
</head>
<body bgcolor="#FFFFFF">
<table cellpadding="0" cellspacing="0" border="0" width="600" align="center" height="85%">
  <tr align="center" valign="middle">
    <td>
    <table cellpadding="10" cellspacing="0" border="0" width="80%" align="center" style="font-family: Verdana, Tahoma; color: #666666; font-size: 9px">
    <tr>
      <td valign="middle" align="center" bgcolor="#EBEBEB">
        <br /><b style="font-size: 10px">Forum onlines reached the upper limit</b>
        <br /><br /><br />Sorry, the number of online visitors has reached the upper limit.
        <br />Please wait for someone else going offline or visit us in idle hours.
        <br /><br />
      </td>
    </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
<?

	exit();

} else {

	if($message) {
		$errmsg = "<b>System info</b>: $message\n\n";
	}
	if(isset($GLOBALS['_DSESSION']['logger_user'])) {
		$errmsg .= "<b>User</b>: ".htmlspecialchars($GLOBALS['_DSESSION']['logger_user'])."\n";
	}
	$errmsg .= "<b>Time</b>: ".gmdate("Y-n-j g:ia", $timestamp + (isset($GLOBALS['_DSESSION']['timeoffset']) ? $GLOBALS['_DSESSION']['timeoffset'] * 3600 : 8*3600))."\n";
	$errmsg .= "<b>Script</b>: ".$PHP_SELF."\n\n";
	if($sql) {
		$errmsg .= "<b>SQL</b>: ".htmlspecialchars($sql)."\n";
	}
	$errmsg .= "<b>Error</b>:  $dberror\n";
	$errmsg .= "<b>Errno.</b>:  $dberrno";

	echo "</table></table></table></table></table>\n";
	echo "<p style=\"font-family: Verdana, Tahoma; font-size: 11px; background: #FFFFFF;\">";
	echo nl2br(str_replace('kd_', '[Table]', $errmsg));

	echo '</p>';
//	echo '<p style="font-family: Verdana, Tahoma; font-size: 12px; background: #FFFFFF;"><a href="http://faq.comsenz.com/?type=mysql&dberrno='.$dberrno.'&dberror='.rawurlencode($dberror).'" target="_blank">&#x5230; http://faq.comsenz.com &#x641c;&#x7d22;&#x6b64;&#x9519;&#x8bef;&#x7684;&#x89e3;&#x51b3;&#x65b9;&#x6848;</a></p>';

	exit();

}

?>