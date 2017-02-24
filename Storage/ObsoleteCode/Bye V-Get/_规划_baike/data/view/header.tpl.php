<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" id="html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $navtitle?><?php echo $setting['seo_title']?>商务百科网</title>
<?php echo $setting['seo_headers']?>
<meta name="keywords" content="<?php echo $setting['seo_keywords']?>" />
<meta name="description" content="<?php echo $setting['seo_description']?>" />
<?php if(!empty($docrewrite) && $docrewrite=='1') { ?><base href="<?php echo WIKI_URL?>/" /><?php } ?>
<link href="http://tu.v-get.com/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://tu.v-get.com/2/i.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="http://tu.v-get.com/2/jquery.js"></script>
<script type="text/javascript" src="http://tu.v-get.com/2/front.js"></script>
<script type="text/javascript" src="http://tu.v-get.com/2/jquery.dialog-0.8.min.js"></script>
<script type="text/javascript" src="http://tu.v-get.com/2/login.js"></script>
<script type="text/javascript">
$.dialog.setConfig('base', 'http://tu.v-get.com/2');
var g_isLogin, g_isUcenter=false, g_forward = '',g_api_url='', g_regulars = '', g_uname_minlength, g_uname_maxlength;
<?php if($user['groupid']=='1') { ?>
g_regulars = "<?php echo $header_regulars?>";
g_isLogin = false;
<?php } else { ?>
g_isLogin = true;
<?php } ?>
<?php if(isset($pp_api)) { ?>
g_api_url = '<?php echo $pp_api?>';
<?php } ?>
<?php if(!empty($isUcenter)) { ?>
g_isUcenter = true;
<?php } ?>
g_seo_prefix = "<?php echo $setting['seo_prefix']?>";
g_seo_suffix = "<?php echo $setting['seo_suffix']?>";
g_uname_minlength = "<?php echo $setting['name_min_length']?>"||3;
g_uname_maxlength = "<?php echo $setting['name_max_length']?>"||15;
<?php if($newpms[0]) { ?>
	var titlestate = 0, clock, flashingtime = 20;
	var oldtitle = "<?php echo $navtitle?> <?php echo $setting['site_name']?> <?php echo $setting['seo_title']?> - Powered by HDWiki!";
	function changeTitle(){if(titlestate%2==0){document.title='【新消息】'+oldtitle;}else{document.title='【　　　】'+oldtitle;}
		titlestate++;
		if(titlestate == flashingtime){clearInterval(clock);document.title = oldtitle;}
	}
	clock = setInterval("changeTitle()", 1000);

<?php } ?>
</script>
</head>
<body>
<?php if($unpubdoc) { ?>
<div class="edit_tips a-r" id="unpubdoc">
<span class="bold l">你上次编辑的词条“<label class="red"><?php echo $unpubdoc['title']?></label>”还未发布，赶快去处理吧！
	<input name="Button1" type="button" value="继续编辑" onclick="location.href='index.php?doc-edit-<?php echo $unpubdoc['did']?>'"/></span>
	<span class="close r" onclick='$("#unpubdoc").hide()'>×</span>
</div>
<?php } ?>

<ul id="login" class="w bor_b-ccc"> 
<?php if(!empty($channellist[1])) { ?>
<?php foreach((array)$channellist[1] as $channel) {?>
<li class="l bor_no"><a href="<?php echo $channel['url']?>" target="_blank"><?php echo $channel['name']?></a></li>
<?php } ?>
<?php } ?>
<?php if($user['groupid']=='1') { ?>
<li name="login"><a href="index.php?user-login">登录</a></li>
<li name="register" class="bor_no"><a href="index.php?user-register" >注册</a></li>
<?php } else { ?>
	<li class="bor_no pad10">欢迎你，<a href="index.php?user-space-<?php echo $user['uid']?>"><?php echo $user['username']?></a></li>
	<?php if($user['password']!='') { ?>
	<li><a href="
	<?php if($newpms[3]) { ?>
		index.php?pms-box-inbox-system
	<?php } else { ?>
		index.php?pms
	<?php } ?>
	" id="header-pms">
	<?php if($newpms[0]) { ?>
	<span class="h_msg">（<?php echo $newpms[0]?>）</span>
	<?php } else { ?>
	<img alt="私信" src="http://tu.v-get.com/2/noshine.gif"/>
	<?php } ?></a></li>
	<li><a href="index.php?user-profile">个人管理</a></li>
	<?php if($adminlogin ) { ?><li><a href="index.php?admin_main">系统设置</a></li><?php } ?>
	<li class="bor_no"><a href="index.php?user-logout<?php echo $referer?>" >退出</a></li>
	<?php } else { ?>
	<li><a href="index.php?user-login">待激活</a></li>
	<li class="bor_no"><a href="index.php?user-logout<?php echo $referer?>" >退出</a></li>
	<?php } ?>
<?php } ?>
<li class="bor_no help"><a href="index.php?doc-innerlink-<?php echo urlencode('帮助')?>">帮助</a></li>
</ul>
<div class="bg_book">
	<a href="http://baike.v-get.com/" id="logo"><img alt="商务百科网" width="<?php echo $setting['logowidth']?>" src="http://tu.v-get.com/2/logo.gif"/></a>
	<?php if(!empty($isimage) ) { ?>
	<form name="searchform" method="post" action="index.php?pic-search">
	<p id="search">
	<input name="searchtext" type="text" class="btn_txt"  maxlength="80" size="42"  value="<?php if(isset($searchtext)) { ?><?php echo $searchtext?><?php } ?>"/>
	<input name="searchfull" type="submit" value="图片搜索" class="btn_inp img_sea_inp" />
	</p>
	</form>
	<?php } else { ?>
	<form name="searchform" method="post" action="index.php?search-kw">
	<p id="search">
	<?php if($cloudsearchhead) { ?>
	<input name="searchtext" class="btn_txt" maxlength="80" size="42" value="<?php if(isset($searchtext)) { ?><?php echo $searchtext?><?php } ?>" type="text"/>
	<input name="search" value="搜 索" tabindex="1" class="btn_inp sea_doc"  type="submit"/>
	<?php } else { ?>
	<input name="searchtext" class="btn_txt" maxlength="80" size="42" value="<?php if(isset($searchtext)) { ?><?php echo $searchtext?><?php } ?>" type="text"/>
	<input name="default" value="进入词条" tabindex="2" class="btn_inp enter_doc" onclick="document.searchform.action='index.php?search-default';document.searchform.submit();" type="button"/>
	<input name="full" value="1" tabindex="1" type="hidden"/>
	<input name="search" value="百科搜索" tabindex="1" class="btn_inp sea_doc" type="submit"/>
	<a href="index.php?search-fulltext" class="sea_advanced link_black">高级搜索</a>
	<?php } ?>
	
	<label>热门搜索：
		<?php foreach((array)$hotsearch as $hotname) {?>
			<?php if($hotname['name']) { ?>
				<a href="<?php if($hotname['url']) { ?><?php echo $hotname['url']?><?php } else { ?>index.php?doc-innerlink-<?php echo urlencode($hotname['name'])?><?php } ?>" target="_blank"><?php echo $hotname['name']?></a>
			<?php } ?>
		<?php } ?>
	</label>
	</p>
	</form>
	<?php } ?>
<div id="nav" class="w bor_b-ccc"><ul><li><a href="http://localhost/www.v-get.com/baike">首页</a></li><li><a href="http://localhost/www.v-get.com/baike/index.php?category">百科分类</a></li><li><a href="http://localhost/www.v-get.com/baike/index.php?list">排行榜</a></li><li><a href="http://localhost/www.v-get.com/baike/index.php?pic-piclist-2">图片百科</a></li><li><a href="http://localhost/www.v-get.com/baike/index.php?gift">礼品商店</a></li></ul><label><a href="index.php?doc-create">创建词条</a><a href="index.php?doc-sandbox">编辑实验</a></label></div>
</div>
<div class="ad"><script type="text/javascript">var cpro_id="u1293136";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>