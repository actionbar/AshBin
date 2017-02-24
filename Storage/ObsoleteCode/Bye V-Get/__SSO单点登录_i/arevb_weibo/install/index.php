<?php
error_reporting(0);
$PHP_SELF = htmlspecialchars($_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);
$BASESCRIPT = basename($PHP_SELF);
list($BASEFILENAME) = explode('.', $BASESCRIPT);
$boardurl = htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].substr($PHP_SELF, 0, strrpos($PHP_SELF, '/')).'/');
$pos = strpos($boardurl, 'install');
if ($pos !== false)
{
	$siteurl = substr($boardurl, 0, $pos);
}
else
{
	$siteurl = $boardurl;
}
$siteurl = rtrim($siteurl, '/').'/';
if (file_exists(dirname(dirname(__FILE__)).'/'."config.inc.php"))
{
	header("Location: {$siteurl}");
	exit();
}

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

$timestamp = time();

function random($length, $numeric = 0) {
	PHP_VERSION < '4.2.0' ? mt_srand((double)microtime() * 1000000) : mt_srand();
	$seed = base_convert(md5(print_r($_SERVER, 1).microtime()), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed[mt_rand(0, $max)];
	}
	return $hash;
}

if ($_POST)
{
	$dbhost = isset($_POST['dbhost']) ? trim($_POST['dbhost']) : "localhost";
	$dbname = isset($_POST['dbname']) ? trim($_POST['dbname']) : "arevb";
	$dbprefix = isset($_POST['dbprefix']) ? trim($_POST['dbprefix']) : "iv_";
	$dbuser = isset($_POST['dbuser']) ? trim($_POST['dbuser']) : "";
	$dbpw = isset($_POST['dbpw']) ? trim($_POST['dbpw']) : "";
	$pconnect = 0;
	$dbcharset = "utf8";
	$ori_dbpre = "iv_";

	$webname = isset($_POST['webname']) ? trim($_POST['webname']) : "";
	$weburl = isset($_POST['weburl']) ? trim($_POST['weburl']) : "";
	$webdesc = isset($_POST['webdesc']) ? trim($_POST['webdesc']) : "";
	$wapopen = isset($_POST['wapopen']) ? intval($_POST['wapopen']) : 0;

	// 管理员
	$adminname = isset($_POST['adminname']) ? trim($_POST['adminname']) : "";
	$adminpass = isset($_POST['adminpass']) ? trim($_POST['adminpass']) : "";
	$adminrpass = isset($_POST['adminrpass']) ? trim($_POST['adminrpass']) : "";
	$adminemail = isset($_POST['adminemail']) ? trim($_POST['adminemail']) : "";

	// 数据库
	$link = @mysql_connect($dbhost, $dbuser, $dbpw, 1);
	if (!$link)
	{
		$error_message = "连接数据库失败，请检查用户名密码是否正确";
	}
	elseif (!mysql_select_db($dbname, $link))
	{
		$error_message = "数据库 {$dbname} 连接失败，请检查此数据库是否存在";
	}
	else
	{
		mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary", $link);
		$sqlfile = file_get_contents(dirname(__FILE__)."/arevb.sql");
		$sqlfile = str_replace("\r\n", "\n", $sqlfile);
		$sql = str_replace("\r", "\n", str_replace('`'.$ori_dbpre, '`'.$dbprefix, $sqlfile));
		$ret = array();
		$num = 0;
		foreach (explode(";\n", trim($sql)) as $query)
		{
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			foreach ($queries as $query)
			{
				$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
			}
			$num++;
		}
		unset($sql, $sqlfile);
		foreach ($ret as $query)
		{
			$query = trim($query);
			if ($query)
			{
				mysql_query($query, $link);
			}
		}
	}

	if (!$error_message)
	{
		$sql = "INSERT INTO {$dbprefix}settings VALUES('webname', '{$webname}'), ('weburl', '{$weburl}'), ('webdesc', '{$webdesc}'), ('wapopen', '{$wapopen}')";
		mysql_query($sql, $link);

		if (empty($adminname) || $adminname != addslashes($adminname)) 
		{
			$error_message = "管理员用户名不合法";
		}
		elseif (empty($adminpass) || $adminpass != $adminrpass)
		{
			$error_message = "管理员密码输入不合法";
		}
		elseif (strlen($adminemail) < 7 || !preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $adminemail))
		{
			$error_message = "管理员Email地址不合法";
		}
		elseif (mysql_query("INSERT INTO {$dbprefix}members(uid, is_admin, username, password, regip, regdate, lastvisit, lastactivity, email) VALUES(1, 1, '{$adminname}', '".md5($adminpass)."', '{$onlineip}', '{$timestamp}', '{$timestamp}', '{$timestamp}', '{$adminemail}')"))
		{
			$error_message = true;
		}
		else
		{
			$error_message = "管理员信息输入失败，请重新输入";
		}
	}

	if ($error_message === true) 
	{
		$config = "<?php\nif (!defined(\"IN_IVB\"))\n\texit(\"Access Denied!\");\n\n\$dbhost = '{$dbhost}';\n\$dbuser = '{$dbuser}';\n\$dbpw = '{$dbpw}';\n\$dbname = '{$dbname}';\n\$pconnect = 0;\n\ndefine('DBPREFIX', '{$dbprefix}');\n\n\$dbcharset = 'utf8';\n\n\$cookiepre = 'IVB_';\n\$cookiedomain = '';\n\$cookiepath = '/';\n\n\$authkey = '".random(64)."';\n?>";

		file_put_contents(dirname(dirname(__FILE__)).'/'."config.inc.php", $config);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎安装Are!微博客系统</title>
<script type="text/javascript" src="<?=$siteurl?>public/js/jquery.js"></script>
<style type="text/css">
@import url(<?=$siteurl?>public/css/site.css);
</style>
</head>
<body>
	<div id="site">
		<div id="pagebody">
			<?php
			if ($error_message === true) 
			{
			?>
			<table class="formtable" cellspacing="2" cellpadding="0">
				<caption>
					<h2>安装成功</h2>
					<p>前去首页 <a href="<?=$siteurl?>">>>></a></p>
				</caption>
			</table>
			<?php
			}
			elseif ($error_message)
			{
			?>
			<table class="formtable" cellspacing="2" cellpadding="0">
				<caption>
					<h2>出错啦！</h2>
					<p><?=$error_message?></p>
					<p><input type="button" onclick="javascript:history.go(-1);" class="btn" value="返回" /></p>
				</caption>
			</table>
			<?php
			}
			else
			{
			?>
			<table class="formtable" cellspacing="2" cellpadding="0">
				<caption>
					<h2>安装说明</h2>
					<p>本系统为开源微博客系统，请不要用于商业用途。其中一些函数源自其它开源系统，请遵守这些开源系统的要求</p>
					<p>由于本系统是在PHP5, Apache2.2, MySQL5环境下开发的，在低于这些版本的环境中未做充足的测试，如出现安装或运行问题，请联系我(<a href="mailto:shibin.wei@gmail.com">shibin.wei@gmail.com</a>)。另外系统需要开启<cite style="color:#2e8efd;font-style:normal;">重定向</cite>模块(在apache中为mod_rewrite模块)，同时需要PHP支持mb_string，gd2等库</p>
					<p>如果您对开源系统感兴趣，欢迎与我联系，共同开发<cite style="color:#2e8efd;font-weight:bold;font-style:normal;">自由微博客开源系统</cite></p>
				</caption>
			</table>
			<form id="postform" method="post" action="<?=$boardurl?>">
			<table class="formtable" cellspacing="2" cellpadding="0">
				<caption>
					<h2>数据库信息</h2>
					<p>暂时只支持MySQL数据库</p>
				</caption>
			</table>
			<div class="upax"></div>
			<div class="ugb">
				<div class="ugb2">
					<div class="ugb3">
						<div class="ugb4">
							<table class="formtable" cellspacing="6">
								<tr>
									<td width="15%" align="right">数据库地址:</td>
									<td>
										<input type="text" class="inp" size="40" name="dbhost" value="localhost" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">数据库名称:</td>
									<td>
										<input type="text" class="inp" size="40" name="dbname" value="arevb" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">数据表前缀:</td>
									<td>
										<input type="text" class="inp" size="40" name="dbprefix" value="iv_" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">数据库用户名:</td>
									<td>
										<input type="text" class="inp" size="40" name="dbuser" value="root" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">数据库密码:</td>
									<td>
										<input type="password" class="inp" size="40" name="dbpw" value="" />
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<table class="formtable" cellspacing="2" cellpadding="0">
				<caption>
					<h2>网站信息</h2>
					<p>简单设置网站的一些信息</p>
				</caption>
			</table>
			<div class="upax"></div>
			<div class="ugb">
				<div class="ugb2">
					<div class="ugb3">
						<div class="ugb4">
							<table class="formtable" cellspacing="6">
								<tr>
									<td width="15%" align="right">网站名称:</td>
									<td>
										<input type="text" class="inp" size="40" name="webname" value="" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">网站URL:</td>
									<td>
										<input type="text" class="inp" size="40" name="weburl" value="<?=$siteurl?>" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">网站简介:</td>
									<td>
										<textarea name="webdesc" style="width:300px; height:80px"></textarea>
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">开启wap:</td>
									<td>
										<input type="radio" value="0" name="wapopen" /> 关闭
										<input type="radio" value="1" name="wapopen" /> 开启
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<table class="formtable" cellspacing="2" cellpadding="0">
				<caption>
					<h2>管理员信息</h2>
					<p>简单设置管理员的一些信息，此管理员将作为网站第一位用户</p>
				</caption>
			</table>
			<div class="upax"></div>
			<div class="ugb">
				<div class="ugb2">
					<div class="ugb3">
						<div class="ugb4">
							<table class="formtable" cellspacing="6">
								<tr>
									<td width="15%" align="right">用户名:</td>
									<td>
										<input type="text" class="inp" size="40" name="adminname" value="" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">密码:</td>
									<td>
										<input type="password" class="inp" size="40" name="adminpass" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">确认密码:</td>
									<td>
										<input type="password" class="inp" size="40" name="adminrpass" />
									</td>
								</tr>
								<tr>
									<td width="15%" align="right">Email:</td>
									<td>
										<input type="text" class="inp" size="40" name="adminemail" />
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			<table class="formtable" cellspacing="2" cellpadding="0">
				<caption>
					<h2>确认信息</h2>
					<p>确认信息并提交</p>
				</caption>
			</table>
			<div class="upax"></div>
			<div class="ugb">
				<div class="ugb2">
					<div class="ugb3">
						<div class="ugb4">
							<table class="formtable" cellspacing="6">
								<tr>
									<td width="15%" align="right"></td>
									<td>
										<input type="submit" class="btn" value="提交保存" />
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
			</form>
			<?php
			}
			?>
		</div>
	</div>
</body>
</html>