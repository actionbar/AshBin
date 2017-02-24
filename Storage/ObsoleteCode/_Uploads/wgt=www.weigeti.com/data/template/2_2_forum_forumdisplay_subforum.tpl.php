<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="fl bm">
<div class="bm<?php if($_G['forum']['forumcolumns']) { ?> flg<?php } ?>">
<div class="bm_h cl">
<h2 class="xs2">子版块</h2>
</div>

<div id="subforum_<?php echo $_G['forum']['fid'];?>" class="bm_c" style="<?php echo $collapse['subforum'];?>">
<table cellspacing="0" cellpadding="0" class="fl_tb">
<tr><?php $i = 1;?><?php if(is_array($sublist)) foreach($sublist as $sub) { $forumurl = !empty($sub['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$sub['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$sub['fid'];?><?php if($_G['forum']['forumcolumns']) { if($sub['orderid'] && ($sub['orderid'] % $_G['forum']['forumcolumns'] == 0)) { ?>
</tr>
<?php if($_G['forum']['orderid'] < $_G['forum']['forumcolumns']) { ?>
<tr class="fl_row">
<?php } } ?>
<td class="fl_g" width="<?php echo $_G['forum']['forumcolwidth'];?>">
<div class="fl_icn_g"<?php if(!empty($sub['extra']['iconwidth']) && !empty($sub['icon'])) { ?> style="width: <?php echo $sub['extra']['iconwidth'];?>px;"<?php } ?>>
<?php if($sub['icon']) { ?>
<?php echo $sub['icon'];?>
<?php } else { ?>
<a href="<?php echo $forumurl;?>"<?php if($sub['redirect']) { ?> target="_blank"<?php } ?>><img src="<?php echo $_G['style']['styleimgdir'];?>/0<?php echo $i;?>.png" alt="<?php echo $sub['name'];?>" /></a><?php $i >= 9 ? $i = 1 : $i++;?><?php } ?>
</div>
<dl<?php if(!empty($sub['extra']['iconwidth']) && !empty($sub['icon'])) { ?> style="margin-left: <?php echo $sub['extra']['iconwidth'];?>px;"<?php } ?>>
<dt><a href="<?php echo $forumurl;?>" class="xs2"<?php if(!empty($sub['redirect'])) { ?> target="_blank"<?php } ?> style="<?php if(!empty($sub['extra']['namecolor'])) { ?>color: <?php echo $sub['extra']['namecolor'];?>;<?php } ?>"><?php echo $sub['name'];?></a></dt>
<?php if(empty($sub['redirect'])) { ?><dd class="xg1"><em><span class="t">主题:</span><?php echo dnumber($sub['threads']); ?></em><em><span class="t">帖数:</span><?php echo dnumber($sub['posts']); ?></em></dd><?php } ?>
<dd class="xg1">
<?php if(!$sub['redirect']) { ?><em<?php if($sub['todayposts']) { ?> class="xi1"<?php } ?>><span class="t">今日:</span><?php if($sub['todayposts']) { ?><?php echo $sub['todayposts'];?><?php } else { ?>0<?php } ?></em><?php } if($sub['permission'] == 1) { ?>
私密版块
<?php } else { ?>
<em class="l">
<?php if(!$sub['redirect']) { ?><span class="t"><?php echo '最新'; ?>:</span><?php } if($sub['redirect']) { ?><a href="<?php echo $forumurl;?>" class="xi2">链接到外部地址</a><?php } elseif(is_array($sub['lastpost'])) { ?><a href="forum.php?mod=redirect&amp;tid=<?php echo $sub['lastpost']['tid'];?>&amp;goto=lastpost#lastpost"><?php echo $sub['lastpost']['dateline'];?></a><?php } else { ?>从未<?php } ?>
</em>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_subforum_extra'][$sub[fid]])) echo $_G['setting']['pluginhooks']['forumdisplay_subforum_extra'][$sub[fid]];?>
</dd>
</dl>
</td>
<?php } else { ?>
<td class="fl_icn" <?php if(!empty($sub['extra']['iconwidth']) && !empty($sub['icon'])) { ?> style="width: <?php echo $sub['extra']['iconwidth'];?>px;"<?php } ?>>
<?php if($sub['icon']) { ?>
<?php echo $sub['icon'];?>
<?php } else { ?>
<a href="<?php echo $forumurl;?>"<?php if($sub['redirect']) { ?> target="_blank"<?php } ?>><img src="<?php echo $_G['style']['styleimgdir'];?>/0<?php echo $i;?>.png" alt="<?php echo $sub['name'];?>" /></a><?php $i >= 9 ? $i = 1 : $i++;?><?php } ?>
</td>
<td>
<h2><a href="<?php echo $forumurl;?>" <?php if(!empty($sub['redirect'])) { ?>target="_blank"<?php } ?> style="<?php if(!empty($sub['extra']['namecolor'])) { ?>color: <?php echo $sub['extra']['namecolor'];?>;<?php } ?>"><?php echo $sub['name'];?></a><?php if($sub['todayposts'] && !$sub['redirect']) { ?><em class="xw0 xi1" title="今日"> (<?php echo $sub['todayposts'];?>)</em><?php } ?></h2>
<?php if($sub['description']) { ?><p class="xg2"><?php echo $sub['description'];?></p><?php } if($sub['subforums']) { ?><p>子版块: <?php echo $sub['subforums'];?></p><?php } if($sub['moderators']) { ?><p>版主: <?php echo $sub['moderators'];?></p><?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['forumdisplay_subforum_extra'][$sub[fid]])) echo $_G['setting']['pluginhooks']['forumdisplay_subforum_extra'][$sub[fid]];?>
</td>
<td class="fl_i">
<?php if(empty($sub['redirect'])) { ?><span class="xi2"><?php echo dnumber($sub['threads']); ?></span><span class="xg1"> / <?php echo dnumber($sub['posts']); ?></span><?php } ?>
</td>
<td class="fl_by">
<div>
<?php if($sub['permission'] == 1) { ?>
私密版块
<?php } else { if($sub['redirect']) { ?>
<a href="<?php echo $forumurl;?>" class="xi2">链接到外部地址</a>
<?php } elseif(is_array($sub['lastpost'])) { ?>
<a href="forum.php?mod=redirect&amp;tid=<?php echo $sub['lastpost']['tid'];?>&amp;goto=lastpost#lastpost" class="xi2"><?php echo cutstr($sub['lastpost']['subject'], 30); ?></a> <cite><?php echo $sub['lastpost']['dateline'];?> <?php if($sub['lastpost']['author']) { ?><?php echo $sub['lastpost']['author'];?><?php } else { ?><?php echo $_G['setting']['anonymoustext'];?><?php } ?></cite>
<?php } else { ?>
从未
<?php } } ?>
</div>
</td>
</tr>
<tr class="fl_row">
<?php } } ?>
<?php echo $_G['forum']['endrows'];?>
</tr>
</table>
</div>
</div>
</div>