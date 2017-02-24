<? if(!defined('IN_IVB')) exit('Access Denied'); include template('header', ''); ?>
<div class="left">
<div class="post" id="posttopmenu">欢迎来到<?=$cache_settings['webname']?></div>
<? if($hot_blogs) { if(is_array($hot_blogs)) { foreach($hot_blogs as $hot_blog) { ?><div class="post" id="post_<?=$hot_blog['nid']?>">
<a href="<? echo miniurl($hot_blog['uid']); ?>"><img src="<?=$siteurl?>avatar.php?uid=<?=$hot_blog['uid']?>&size=middle" /></a>
<div class="detail">
<p>
<a href="<? echo miniurl($hot_blog['uid']); ?>"><?=$hot_blog['username']?></a>: <?=$hot_blog['note']['message']?>
<? if($hot_blog['note']['link']) { ?>
<p>分享链接：<a href="<?=$hot_blog['note']['link']['url']?>"><?=$hot_blog['note']['link']['title']?></a></p>
<? } if($hot_blog['note']['file']) { ?>
<p>分享文件：<a href="<?=$hot_blog['note']['file']['url']?>"><?=$hot_blog['note']['file']['title']?></a></p>
<? } if($hot_blog['note']['img']) { ?>
<p><img src="<? echo imgurl($hot_blog['note']['img']['url']); ?>" rel="<?=$hot_blog['note']['img']['title']?>" /></p>
<? } if(!empty($hot_blog['note']['refer'])) { $hot_blog_refer = $hot_blog['note']['refer']; ?><div class="upax"></div>
<div class="ugb">
<div class="ugb2">
<div class="ugb3">
<div class="ugb4">
转发自 <?=$hot_blog_refer['message']?>
<? if(!empty($hot_blog_refer['link'])) { ?>
<p>分享链接：<a href="<?=$hot_blog_refer['link']['url']?>"><?=$hot_blog_refer['link']['title']?></a></p>
<? } if(!empty($hot_blog_refer['file'])) { ?>
<p>分享文件：<a href="<?=$hot_blog_refer['file']['url']?>"><?=$hot_blog_refer['file']['title']?></a>
<? } if(!empty($hot_blog_refer['img'])) { ?>
<p><img style="float:none" src="<? echo imgurl($hot_blog_refer['img']['url']); ?>" rel="<?=$hot_blog_refer['img']['title']?>" /></p>
<? } ?>
</div>
</div>
</div>
</div>
<? } ?>
</p>
<div class="attrs">
<div class="lf">
<cite><? echo sgmdate($hot_blog['dateline']); ?></cite> 来自<?=$sourcefrom[$hot_blog['from']]?>
</div>
<div class="rt">
<? if($logger_uid == $hot_blog['uid']) { ?>转发[<?=$hot_blog['refers']?>]<? } else { ?><a href="<? if($logger_uid < 1) { echo miniurl('login'); } else { ?>javascript:;<? } ?>" class="refer_a" r="<?=$hot_blog['nid']?>">转发[<?=$hot_blog['refers']?>]</a><? } ?><span>|</span><a href="<? echo miniurl('note/'.$hot_blog['nid'].'/comment'); ?>">评论[<?=$hot_blog['comments']?>]</a><? if($logger_uid == $hot_blog['uid']) { ?><span>|</span><a href="javascript:;" class="delete_a" r="<?=$hot_blog['nid']?>">删除</a><? } ?>
</div>
</div>
</div>
</div><? } } } else { } ?>
</div>
<div class="right">
<? if($logger_uid > 0) { ?>
<div class="ugb">
<div class="ugb2">
<div class="ugb3">
<div class="ugb4">
<div class="userinfo">
<div class="user_head">
<img src="<?=$siteurl?>avatar.php?uid=<?=$logger_uid?>&size=middle" style="float:left" /><div style="float:left; margin:0 0 0 15px;"><p style="font-size:14px;line-height:33px;"><?=$logger_user?></p><p style="color:#999">上次登录:<? echo sgmdate($_DSESSION['lastvisit']); ?></p></div>
</div>
<div class="user_atten">
<ul>
<li>
<div class="num">
<a href="<? echo miniurl($logger_uid.'/follows'); ?>"><?=$_DSESSION['follows']?></a>
</div>
<a href="<? echo miniurl($logger_uid.'/follows'); ?>">关注</a>
</li>
<li>
<div class="num">
<a href="<? echo miniurl($logger_uid.'/fans'); ?>"><?=$_DSESSION['fans']?></a>
</div>
<a href="<? echo miniurl($logger_uid.'/fans'); ?>">粉丝</a>
</li>
<li style="border:none">
<div class="num">
<a href="<? echo miniurl($logger_uid.'/notes'); ?>"><?=$_DSESSION['notes']?></a>
</div>
<a href="<? echo miniurl($logger_uid.'/notes'); ?>">微博</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<? } else { ?>
<h3>还没有用户名？</h3>
<div class="ugb">
<div class="ugb2">
<div class="ugb3">
<div class="ugb4">
<form method="post" action="<? echo miniurl('login'); ?>">
<table class="formtable" cellpadding="3" cellspacing="3">
<tr>
<td colspan="2">赶紧去注册一个！</td>
</tr>
<tr>
<td width="50"></td>
<td><input type="button" value="注 册" class="btn" onclick="location.href='<? echo miniurl('register'); ?>';" /></td>
</tr>
</table>
</form>
</div>
</div>
</div>
</div>
<h3 style="margin:15px 0 0">我有用户名</h3>
<div class="ugb">
<div class="ugb2">
<div class="ugb3">
<div class="ugb4">
<form method="post" action="<? echo miniurl('login'); ?>">
<table class="formtable" cellpadding="3" cellspacing="3">
<tr>
<td colspan="2">现在就登录！</td>
</tr>
<tr>
<td width="50">登录名:</td>
<td><input type="text" value="" name="username" class="inp" size="21" /></td>
</tr>
<tr>
<td width="50">密码:</td>
<td><input type="password" value="" name="password" class="inp" size="21" /></td>
</tr>
<tr>
<td width="50"></td>
<td><input type="submit" class="btn" value="登录" /><input type="hidden" name="submit_post" value="1" /></td>
</tr>
</table>
</form>
</div>
</div>
</div>
</div>
<? } if(!empty($hot_peos)) { ?>
<h3 style="margin:15px 0 0">看看谁最活跃？</h3>
<div class="actives"><? if(is_array($hot_peos)) { foreach($hot_peos as $hot_peo) { ?><dl class="ob">	
<dt>
<a href="<? echo miniurl($hot_peo['uid']); ?>"><img src="<?=$siteurl?>avatar.php?uid=<?=$hot_peo['uid']?>&size=middle" /></a>
</dt>
<dd>
<a href="<? echo miniurl($hot_peo['uid']); ?>"><?=$hot_peo['username']?></a>
</dd>
</dl><? } } ?></div>
<div style="clear:both"></div>
<div class="more">
<a href="<? echo miniurl('search/peoples') ?>">更多>></a>
</div>
<? } if(!empty($hot_tags)) { ?>
<h3 style="margin:15px 0 0">什么话题最热门？</h3>
<ul class="hottags"><? if(is_array($hot_tags)) { foreach($hot_tags as $hot_tag) { ?><li>
<a href="<? echo miniurl('search/tag?keyword='.$hot_tag['tagname']); ?>"><?=$hot_tag['tagname']?></a> (<?=$hot_tag['total']?>)
</li><? } } ?></ul>
<div class="more">
<a href="<? echo miniurl('search/tags') ?>">更多>></a>
</div>
<? } ?>
</div>
<? include template('footer', ''); ?>
