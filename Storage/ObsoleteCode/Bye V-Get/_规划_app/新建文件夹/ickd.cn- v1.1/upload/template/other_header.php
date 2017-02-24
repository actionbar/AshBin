<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?=$pagetitle?> - <?=$_config['info']['sitename']?></title>
<link href="img/other.css" rel="stylesheet" type="text/css" />
<?php
	if(function_exists('morehead')){
		morehead();
	}
?>
</head>
<body>
<div id="header">
  <div id="logo"><a href="<?=$_config['info']['siteurl']?>/" title="返回<?=$_config['info']['sitename']?>首页" target="_self"><?=$_config['info']['sitename']?></a></div>
  <div id="banner" style="float:right;padding:4px 0 3px 0"><script type="text/javascript"><!--
google_ad_client = "ca-pub-3195725015930868";
/* Little Banner */
google_ad_slot = "1387697775";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
</div>
<div id="main">
<div class="nav"><span style="float:right">下次可直接用<span style="color:#e0a40d; font-weight:bold;">i</span><span style="color:#276edd;font-weight:bold;">CKD.cn</span>查快递啦！ </span>您当前位置：<a href="<?=$_config['info']['siteurl']?>/"><?=$_config['info']['sitename']?></a>&raquo;<?=$pagetitle?></div>