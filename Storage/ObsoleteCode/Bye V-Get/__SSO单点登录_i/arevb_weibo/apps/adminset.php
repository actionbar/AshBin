<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

if ($logger_uid < 1 || $_DSESSION['is_admin'] != 1) 
{
	include(APP_DIR.'login.php');
	return;
}

if (!empty($_POST['submit_post']))
{
	unset($data);
	$data['webname'] = isset($_POST['webname']) ? trim(strip_tags($_POST['webname'])) : "";
	$data['weburl'] = isset($_POST['weburl']) ? trim($_POST['weburl']) : "";
	$data['weburl'] == 'http://' && ($data['weburl'] = '');
	if (!empty($data['weburl']) && substr($data['weburl'], 0, 7) != 'http://') 
	{
		$data['weburl'] = 'http://'.$data['weburl'];
	}
	$data['webdesc'] = isset($_POST['webdesc']) ? trim(strip_tags($_POST['webdesc'])) : "";
	$data['wapopen'] = isset($_POST['wapopen']) ? intval($_POST['wapopen']) : 0;
	$data['wapopen'] != 1 && ($data['wapopen'] = 0);
	$data['wapregister'] = isset($_POST['wapregister']) ? intval($_POST['wapregister']) : 0;
	$data['wapregister'] != 1 && ($data['wapregister'] = 0);

	$toupdate = false;
	$sql = "REPLACE INTO ".DBPREFIX."settings VALUES";
	$moresql = "";
	foreach ($data as $key => $val)
	{
		if ($val == '')
		{
			continue;
		}
		$moresql .= empty($moresql) ? "" : ",";
		$moresql .= "('{$key}', '".addslashes(stripslashes($val))."')";
	}
	unset($data, $key, $val);
	if ($moresql)
	{
		$db->query($sql.$moresql);
		if ($db->affected_rows())
		{
			$data = $db->fetch_all("SELECT * FROM ".DBPREFIX."settings");
			if ($data)
			{
				$tdata = array();
				foreach ($data as $val)
				{
					$tdata[$val['variable']] = $val['value'];
				}
				file_put_contents(DATA_DIR.'cache/cache_settings.php', "<?php\nreturn ".var_export($tdata, true).";\n?>");
			}
			$error_message = "恭喜您，设置网站信息成功";
		}
		else
		{
			$error_message = "设置网站信息失败，请稍候重试设置";
		}
	}
	else
	{
		$error_message = "恭喜您，设置网站信息成功";
	}
	$url_forward = miniurl("setting/web");
	include(template("message"));
	return;
}

$data = $db->fetch_all("SELECT * FROM ".DBPREFIX."settings");
if ($data)
{
	$settings = array();
	foreach ($data as $val)
	{
		$settings[$val['variable']] = $val['value'];
	}
}
unset($data);

include(template("adminset"));
?>