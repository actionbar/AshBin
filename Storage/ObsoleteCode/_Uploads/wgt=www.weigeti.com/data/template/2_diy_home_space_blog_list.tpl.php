<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_blog_list');?>
<?php $_G[home_tpl_spacemenus][] = "<a href=\"home.php?mod=space&amp;uid=$space[uid]&amp;do=blog&amp;view=me\">TA 的所有日志</a>";
$friendsname = array(1 => '仅好友可见',2 => '指定好友可见',3 => '仅自己可见',4 => '凭密码可见');?><?php include template('common/header'); ?><div id="pt" class="bm cl">
<div class="z">
<a href="./" class="nvhm" title="首页"><?php echo $_G['setting']['bbname'];?></a> <em>&rsaquo;</em>
<?php if($diymode) { ?><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>"><?php echo $space['username'];?></a> <em>&rsaquo;</em><?php } ?>
<a href="home.php?mod=space&amp;do=blog">日志</a>
</div>
</div>
<style id="diy_style" type="text/css"></style>
<div class="wp">
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
<div id="ct" class="ct2 ct2_sp wp cl">
<?php if($diymode) { include template('home/space_menu'); ?><div class="bm">
<div class="bm_c cl">
<?php } ?>
<div class="sd">
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->
</div>
<div class="mn">
<!--[diy=diycontenttop]--><div id="diycontenttop" class="area"></div><!--[/diy]-->
<?php if($_G['uid'] && empty($diymode)) { ?>
<ul class="tb tb_w cl">
<li<?php echo $actives['we'];?>><a href="home.php?mod=space&amp;do=blog&amp;view=we">好友的日志</a></li>
<li<?php echo $actives['me'];?>><a href="home.php?mod=space&amp;do=blog&amp;view=me">我的日志</a></li>
<li<?php echo $actives['all'];?>><a href="home.php?mod=space&amp;do=blog&amp;view=all">随便看看</a></li>
<?php if(helper_access::check_module('blog')) { ?>
<li class="o"><a href="home.php?mod=spacecp&amp;ac=blog">发表新日志</a></li>
<?php } ?>
</ul>
<?php } ?>
<div class="<?php if(empty($diymode)) { ?>bm <?php } ?>bml">
<div class="bm_c">

<div class="tbmu bw0 cl">
<?php if(helper_access::check_module('blog') && $space['self'] && $diymode) { ?>
<a href="home.php?mod=spacecp&amp;ac=blog" class="y pn pnc"><strong>发表新日志</strong></a>
<?php } if($_GET['view'] == 'all') { ?>
<a href="home.php?mod=space&amp;do=blog&amp;view=all" <?php if(!$_GET['catid']) { ?><?php echo $orderactives['dateline'];?><?php } ?>>最新发表的日志</a><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=blog&amp;view=all&amp;order=hot" <?php echo $orderactives['hot'];?>>推荐阅读的日志</a>
<?php if($category) { if(is_array($category)) foreach($category as $value) { ?><span class="pipe">|</span>
<a href="home.php?mod=space&amp;do=blog&amp;catid=<?php echo $value['catid'];?>&amp;view=all&amp;order=<?php echo $_GET['order'];?>"<?php if($_GET['catid']==$value['catid']) { ?> class="a"<?php } ?>><?php echo $value['catname'];?></a>
<?php } } } if($userlist) { ?>
按好友筛选
<select name="fuidsel" onchange="fuidgoto(this.value);" class="ps">
<option value="">全部好友</option><?php if(is_array($userlist)) foreach($userlist as $value) { ?><option value="<?php echo $value['fuid'];?>"<?php echo $fuid_actives[$value['fuid']];?>><?php echo $value['fusername'];?></option>
<?php } ?>
</select>
<?php } if($_GET['view'] == 'me' && $classarr) { if(is_array($classarr)) foreach($classarr as $classid => $classname) { ?><a href="home.php?mod=space&amp;uid=<?php echo $space['uid'];?>&amp;do=blog&amp;classid=<?php echo $classid;?>&amp;view=me" id="classid<?php echo $classid;?>" onmouseover="showMenu(this.id);"<?php if($_GET['classid']==$classid) { ?> class="a"<?php } ?>><?php echo $classname;?></a><span class="pipe">|</span>
<?php if($space['self']) { ?>
<div id="classid<?php echo $classid;?>_menu" class="p_pop" style="display: none; zoom: 1;">
<a href="home.php?mod=spacecp&amp;ac=class&amp;op=edit&amp;classid=<?php echo $classid;?>" id="c_edit_<?php echo $classid;?>" onclick="showWindow(this.id, this.href, 'get', 0);">编辑</a>
<a href="home.php?mod=spacecp&amp;ac=class&amp;op=delete&amp;classid=<?php echo $classid;?>" id="c_delete_<?php echo $classid;?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
</div>
<?php } } } ?>
</div>

<?php if($searchkey) { ?>
<p class="tbmu">以下是搜索日志 <span style="color: red; font-weight: 700;"><?php echo $searchkey;?></span> 结果列表</p>
<?php } if($count) { ?>
<div class="xld xlda mld"><?php if(is_array($list)) foreach($list as $k => $value) { ?><dl class="cl">
<dd class="m">
<div class="avt"><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" c="1"><?php echo avatar($value[uid],small);?></a></div>
</dd>

<dt class="xs2 xw0">
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>" class="xi2"><?php echo $value['username'];?></a>: <?php $stickflag = isset($value['stickflag']) ? 0 : 1;?><?php if(!$stickflag) { ?><span class="xi1">置顶</span> &middot; <?php } ?>
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>&amp;do=blog&amp;id=<?php echo $value['blogid'];?>" class="xi2"<?php if($value['magiccolor']) { ?> style="color: <?php echo $_G['colorarray'][$value['magiccolor']];?>"<?php } ?> target="_blank"><?php echo $value['subject'];?></a>
<?php if($value['status'] == 1) { ?> <span class="xi1">(待审核)</span><?php } ?>
</dt>
<dd class="xs2 c" id="blog_article_<?php echo $value['blogid'];?>">
<?php if($value['pic']) { ?><div class="atc"><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>&amp;do=blog&amp;id=<?php echo $value['blogid'];?>" target="_blank"><img src="<?php echo $value['pic'];?>" alt="<?php echo $value['subject'];?>" class="tn" /></a></div><?php } ?>
<?php echo $value['message'];?>
</dd>
<dd>
<?php if($value['friend']) { ?>
<span class="y xg1"><a href="<?php echo $theurl;?>&friend=<?php echo $value['friend'];?>" class="xg1"><?php echo $friendsname[$value['friend']];?></a></span>
<?php } ?>
<span class="xg1"><?php echo $value['dateline'];?></span> &nbsp; 
<?php if($value['viewnum']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>&amp;do=blog&amp;id=<?php echo $value['blogid'];?>" target="_blank"><?php echo '阅读'; ?>(<?php echo $value['viewnum'];?>)</a> &nbsp; <?php } ?>
<a href="home.php?mod=space&amp;uid=<?php echo $value['uid'];?>&amp;do=blog&amp;id=<?php echo $value['blogid'];?>#comment" target="_blank"><?php echo '评论'; if($value['replynum']) { ?>(<span id="replynum_<?php echo $value['blogid'];?>"><?php echo $value['replynum'];?></span>)<?php } ?></a>
<?php if($value['hot']) { ?> &nbsp; <span class="hot">热度 <em><?php echo $value['hot'];?></em> </span><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['space_blog_list_status'][$k])) echo $_G['setting']['pluginhooks']['space_blog_list_status'][$k];?>
<?php if($_GET['view']=='me' && $space['self']) { ?>
<span class="pipe">|</span><a href="home.php?mod=spacecp&amp;ac=blog&amp;blogid=<?php echo $value['blogid'];?>&amp;op=edit">编辑</a> &nbsp; 
<a href="home.php?mod=spacecp&amp;ac=blog&amp;blogid=<?php echo $value['blogid'];?>&amp;op=delete&amp;handlekey=delbloghk_<?php echo $value['blogid'];?>" id="blog_delete_<?php echo $value['blogid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<?php if(empty($value['status'])) { ?>
 &nbsp; <a href="home.php?mod=spacecp&amp;ac=blog&amp;blogid=<?php echo $value['blogid'];?>&amp;op=stick&amp;stickflag=<?php echo $stickflag;?>&amp;handlekey=stickbloghk_<?php echo $value['blogid'];?>" id="blog_stick_<?php echo $value['blogid'];?>" onclick="showWindow(this.id, this.href, 'get', 0);"><?php if($stickflag) { ?>置顶<?php } else { ?>取消置顶<?php } ?></a>
<?php } } ?>
</dd>
</dl>
<?php } if($pricount) { ?>
<p class="mtm">本页有 <?php echo $pricount;?> 篇日志因作者的隐私设置或未通过审核而隐藏</p>
<?php } ?>
</div>
<?php if($multi) { ?><div class="pgs cl mtm"><?php echo $multi;?></div><?php } } else { ?>
<div class="emp">还没有相关的日志</div>
<?php } ?>
<!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]-->

</div>
</div>
</div>
<?php if($diymode) { ?>
</div>
</div>
<?php } ?>
</div>

<div class="wp mtn">
<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>

<script type="text/javascript">
function fuidgoto(fuid) {
var parameter = fuid != '' ? '&fuid='+fuid : '';
window.location.href = 'home.php?mod=space&do=blog&view=we'+parameter;
}
</script><?php include template('common/footer'); ?>