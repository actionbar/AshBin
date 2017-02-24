<? if(!defined('IN_IVB')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? if(!empty($userheader)) { ?><?=$userheader?> - <? } ?><?=$cache_settings['webname']?> -<? if(!empty($cache_settings['webdesc'])) { ?> <?=$cache_settings['webdesc']?> -<? } ?> powered by arevb!</title>
<meta content="arevb! miniblog - arevb! microblog" name="description">
<script src="<?=$siteurl?>public/js/jquery.js" type="text/javascript"></script>
<style type="text/css">
@import url(<?=$siteurl?>public/css/site.css);
</style>
</head>

<body>
<div id="site">
<div id="logo">
<a href="<?=$boardurl?>"><img src="<?=$siteurl?>public/images/about_logo.png" border="0" /></a>
<ul>
<? if($logger_uid > 0) { ?>
<li>您好，<a href="<? echo miniurl($logger_uid); ?>"><?=$logger_user?></a><? if($_DSESSION['newpm'] > 0) { ?>。您有<a href="<? echo miniurl('pms'); ?>"><?=$_DSESSION['newpm']?>条</a>新消息<? } ?></li>
<li><a href="<? echo miniurl('setting'); ?>">设置</a></li>
<li><a href="<? echo miniurl('logout'); ?>">退出</a></li>
<? } else { ?>
<li><a href="<? echo miniurl('login'); ?>">登录</a></li>
<li><a href="<? echo miniurl('register'); ?>">注册</a></li>
<li><a href="<? echo miniurl(); ?>">网站首页</a></li>
<? } ?>
</ul>
</div>
<div id="menu">
<div class="nav">
<? if($logger_uid > 0) { ?>				
<a href="<? echo miniurl(); ?>"<? if($menuon == 'myhome') { ?> class="on"<? } ?>>我的首页</a>
<a href="<? echo miniurl('home'); ?>"<? if($menuon == 'home') { ?> class="on"<? } ?>>网站首页</a>
<a href="<? echo miniurl('travel'); ?>"<? if($menuon == 'travel') { ?> class="on"<? } ?>>随便看看</a>
<a href="<? echo miniurl('setting'); ?>"<? if($menuon == 'setting') { ?> class="on"<? } ?>>我的设置</a>
<? } else { ?>
<a href="<? echo miniurl('home'); ?>"<? if($menuon == 'home') { ?> class="on"<? } ?>>首页</a>
<a href="<? echo miniurl('login'); ?>"<? if($menuon == 'login') { ?> class="on"<? } ?>>登录</a>
<a href="<? echo miniurl('register'); ?>"<? if($menuon == 'register') { ?> class="on"<? } ?>>注册</a>
<a href="<? echo miniurl('travel'); ?>"<? if($menuon == 'travel') { ?> class="on"<? } ?>>随便看看</a>
<? } ?>
</div>
<div class="search">
<form action="<? echo miniurl('search'); ?>" method="post">
<input type="hidden" value="<? if(!empty($search_filter)) { ?><?=$search_filter?><? } else { ?>tags<? } ?>" name="filter" id="search_filter" />
<div class="searchinput">
<input type="text" name="keyword" value="<?=$keyword?>" />
</div>
<div class="searchselect">
<a id="search_select_menu" href="javascript:;" onfocus="this.blur();"><? if($search_filter == 'people') { ?>会员<? } else { ?>话题<? } ?></a>
<div id="search_select_menus" style="display:none;">
<a onfocus="this.blur();" href="javascript:;" rel="tags">话题</a>
<a onfocus="this.blur();" href="javascript:;" rel="people">会员</a>
</div>
</div>
<div class="searchbtn">
<input type="submit" value="查找" />
</div>
</form>
</div>
</div>
<div style="clear:both"></div>
<div id="pagebody">