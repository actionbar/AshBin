<?php
if (!defined("IN_IVB"))
	exit("Access Denied!");

if ($logger_uid < 1)
{
	include(APP_DIR.'login.php');
	return;
}
$action = isset($requests[0]) ? trim($requests[0]) : "";
include_once(INCLUDE_DIR . "pm.func.php");
if ($action == 'send') // 发送
{
	if (!empty($_POST['submit_post']))
	{
		$msgto = isset($_POST['msgto']) ? addslashes(stripslashes(trim($_POST['msgto']))) : "";
		$msgtoid = !empty($msgto) ? $db->result_first("SELECT uid FROM ".DBPREFIX."members WHERE username = '{$msgto}' LIMIT 1") : 0;
		$error_status = false;
		if ($msgtoid < 1)
		{
			$error_message = "您要发送的用户不存在，请重新输入";
		}
		elseif ($msgtoid == $logger_uid)
		{
			$error_message = "请不要给自己发信息";
		}
		else
		{
			$message = isset($_POST['message']) ? addslashes(stripslashes(trim($_POST['message']))) : "";
			if (empty($message))
			{
				$error_message = "请输入您要发送的短消息";
			}
			elseif (send_pm('', $message, array('uid' => $logger_uid, 'username' => $logger_user), array('uid' => $msgtoid, 'username' => $msgto)))
			{
				$error_status = true;
				$error_message = "发送消息成功";
			}
			else
			{
				$error_message = "发送消息失败，您可以稍候重试";
			}
		}
		$more_info = '>> '.($_DSESSION['newpm'] > 0 ? '<a href="'.miniurl('pms').'">新消息</a> ' : "").'<a href="'.miniurl('pms?filter=inbox').'">收件箱</a> <a href="'.miniurl('pms?filter=outbox').'">发件箱</a><br />';
		exit(json_encode(array('success'=>$error_status,'message'=>$error_message)));
	}
	else
	{
		$msgtoid = isset($_GET['uid']) ? intval($_GET['uid']) : 0;
		$msgto = '';
		if ($msgtoid > 0 && $msgtoid != $logger_uid)
		{
			$msgto = $db->result_first("SELECT username FROM ".DBPREFIX."members WHERE uid = {$msgtoid} LIMIT 1");
		}
	}
}
elseif ($action == 'del') // 删除
{
	if (!empty($_POST['submit_post'])) 
	{
		$pmid = isset($_POST['pmid']) ? intval($_POST['pmid']) : 0;
		if (del_pms($logger_uid, $pmid))
		{
			$error_status = true;
			$error_message = "删除消息成功啦";
		}
		else
		{
			$error_status = false;
			$error_message = "删除消息失败，您可以稍候重试";
		}
		exit(json_encode(array('success' => $error_status, 'message' => $error_message)));
	}
}
else // 查看message文件夹
{
	$filter = isset($_GET['filter']) ? trim($_GET['filter']) : '';
	if ($filter == 'inbox')
	{
		$pms = get_pms($logger_uid, 10, 'inbox', false);
		if ($_DSESSION['newpm'] > 0)
		{
			$new_pmids = array();
			if (!empty($pms['data']))
			{
				foreach ($pms['data'] as $val)
				{
					$val['new'] == 1 && ($new_pmids[] = $val['pmid']);
				}
			}
			$newpm_left = max(0, $_DSESSION['newpm'] - count($new_pmids));
			$db->query("UPDATE ".DBPREFIX."members SET newpm = '{$newpm_left}' WHERE uid = {$logger_uid} LIMIT 1");
			$_DSESSION['newpm'] = $newpm_left;
			!empty($new_pmids) && ($db->query("UPDATE ".DBPREFIX."pms SET `new` = 0 WHERE pmid IN ('".implode("','", $new_pmids)."')"));
		}
		$pageurl = miniurl('pms?filter=inbox');
	}
	elseif ($filter == 'outbox')
	{
		$pms = get_pms($logger_uid, 10, 'outbox', false);
		$pageurl = miniurl('pms?filter=outbox');
	}
	else
	{
		$pms = get_pms($logger_uid);
		if ($_DSESSION['newpm'] > 0)
		{
			$new_pmids = array();
			if (!empty($pms['data']))
			{
				foreach ($pms['data'] as $val)
				{
					$val['new'] == 1 && ($new_pmids[] = $val['pmid']);
				}
			}
			$newpm_left = max(0, $_DSESSION['newpm'] - count($new_pmids));
			$db->query("UPDATE ".DBPREFIX."members SET newpm = '{$newpm_left}' WHERE uid = {$logger_uid} LIMIT 1");
			$_DSESSION['newpm'] = $newpm_left;
			!empty($new_pmids) && ($db->query("UPDATE ".DBPREFIX."pms SET `new` = 0 WHERE pmid IN ('".implode("','", $new_pmids)."')"));
		}
		$pageurl = miniurl('pms');
	}
	if (!empty($pms)) 
	{
		$total = $pms['total'];
		$current = $pms['current'];
		$pages = $pms['pages'];
		$perpage = $pms['perpage'];
		$pms = $pms['data'];
		$pagehtml = multi_page($pages, total, $current, miniurl($pageurl));
	}
}

$usermenu = 'pms';
include(template("pms"));
?>