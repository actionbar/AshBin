<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>

<div class="hd_map">
	<a href="<?php echo WIKI_URL?>"><?php echo $setting['site_name']?></a> &gt;&gt;<?php echo $spaceuser['username']?>
	<?php if($type==1 ) { ?>编辑的词条
	<?php } elseif($type==2) { ?>收藏的词条
	<?php } else { ?>创建的词条<?php } ?> 
</div>

<div class="r w-710 o-v p-b10 columns qh gr">
	<h2 class="col-h2 h3 a-r">
		<a href="index.php?user-space-<?php echo $spaceuser['uid']?>-0" class="l font14 <?php if(!$type) { ?>on<?php } ?>">创建的词条</a>
		<a href="index.php?user-space-<?php echo $spaceuser['uid']?>-1" class="l font14 <?php if($type==1) { ?>on<?php } ?>">编辑的词条</a>
		<a href="index.php?user-space-<?php echo $spaceuser['uid']?>-2" class="l font14 <?php if($type==2) { ?>on<?php } ?>">收藏的词条</a>
	</h2>

	<?php if($doclist) { ?>
	<?php foreach((array)$doclist as $doc) {?>
	<dl class="col-dl">
		<dt class="h2"><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" ><?php echo $doc['title']?></a></dt>
		<dd class="gray">词条创建者:<a href="index.php?user-space-<?php echo $doc['authorid']?>"><?php echo $doc['author']?></a> 创建时间:<label><?php echo $doc['time']?></label></dd>
		<dd><span class="bold">标签:</span>
		<?php if($doc['tag']) { ?>
			<?php foreach((array)$doc['tag'] as $tag) {?>
			<a href="index.php?search-tag-<?php echo $tag?>" ><?php echo $tag?></a>
			<?php } ?>
		<?php } ?>
		</dd>
		<dd><p><span class="bold">摘要:</span><?php echo $doc['summary']?><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" >[阅读全文]</a></p></dd>
		<dd class="gray">编辑:<label><?php echo $doc['edits']?>次</label>|浏览:<label><?php echo $doc['views']?>次</label>
		<?php if((2 == $type && $uid == $doc['fuid'])) { ?><a href="index.php?user-removefavorite-<?php echo $doc['fid']?>" >[删除此条收藏]</a><?php } ?></dd>
	</dl>
	<?php } ?>
	<?php } else { ?>
	<span class="m-t10 m-l8 block"><?php if($type==1) { ?>暂无编辑过词条!<?php } elseif($type==2) { ?>暂无收藏词条！<?php } else { ?>暂无创建过词条!<?php } ?></span>
	<?php } ?>
 	<div id="fenye" class="m-t10 a-r"><?php echo $departstr?></div>
</div>

<div class="l w-230">
	<div class="columns gr_info p-b10">
		<h2 class="col-h2"><?php echo $spaceuser['username']?></h2>	
		<dl class="col-dl">
		<dd><a href="index.php?user-space-<?php echo $spaceuser['uid']?>" class="a-img2"><img src="<?php if($spaceuser['image']) { ?><?php echo $spaceuser['image']?><?php } else { ?>style/default/user.jpg<?php } ?>"/></a></dd>
		<dd class="h2"><font color="<?php echo $spaceuser['color']?>"><?php echo $spaceuser['grouptitle']?></font>
		<?php for($i=0; $i<$spaceuser['editorstar'][3]; $i++) {?><img src="style/default/star_level3.gif"/><?php } ?><?php for($i=0; $i<$spaceuser['editorstar'][2]; $i++) {?><img src="style/default/star_level2.gif"/><?php } ?><?php for($i=0; $i<$spaceuser['editorstar'][1]; $i++) {?><img src="style/default/star_level1.gif"/><?php } ?>
		</dd>
		<dd><span class="m-r8"><a onclick="return Message.box('<?php echo $spaceuser['username']?>')" href="#" class="send-ms"><img src="style/default/message.jpg"/>发短消息</span></a><img alt="金币" src="style/default/jb.gif" class="sign"/><b class="h3"><?php echo $spaceuser['credit1']?></b></dd>	
		<dd>用户经验:<span class="gray"><?php echo $spaceuser['credit2']?></span></dd>	
		<dd>人气指数:<span class="gray"><?php echo $spaceuser['views']?></span></dd>
		<dd>创建词条:<span class="gray"><?php echo $spaceuser['creates']?></span></dd>
		<dd>编辑词条:<span class="gray"><?php echo $spaceuser['edits']?></span></dd>
		<dd>注册时间:<span class="gray"><?php echo $spaceuser['regtime']?></span></dd>
		<dd>个人介绍:<?php echo $spaceuser['signature']?></dd>
		</dl>
	</div>
</div>

<?php include $this->gettpl('footer');?>