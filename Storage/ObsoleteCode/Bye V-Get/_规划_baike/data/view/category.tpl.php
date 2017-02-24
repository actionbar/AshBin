<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>
<div class="hd_map"> <a href="<?php echo WIKI_URL?>"><?php echo $setting['site_name']?></a>&gt;&gt;<a href="index.php?category"> 百科分类 </a>
<?php foreach((array)$category['navigation'] as $key=>$navigation) {?>&gt;&gt; 
<?php if($key<count($category['navigation'])-1) { ?><a href="index.php?category-view-<?php echo $navigation['cid']?>"> <?php echo $navigation['name']?> </a><?php } else { ?> <?php echo $navigation['name']?> <?php } ?>
<?php }?>
</div>
<div class="r w-710 o-v columns p-b10 cate_show">
	<h2 class="col-h2 h3 a-r"><strong class="l h2">"<?php echo $category['name']?>" 分类下的词条</strong>该分类下有<?php echo $count?>个词条<a href="index.php?doc-create-<?php echo $category['cid']?>" target="_blank" class="m-l8">创建该分类下的词条</a></h2>
	<?php if(count($list)>0) { ?>
	<?php foreach((array)$list as $key=>$doc) {?>
	<dl class="col-dl">
		<dt class="h2"><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" ><?php echo $doc['title']?></a></dt>
		<dd class="gray ">词条创建者:<a href="index.php?user-space-<?php echo $doc['authorid']?>" ><?php echo $doc['author']?></a>创建时间:<?php echo $doc['time']?></dd>
		<dd><span class="bold">标签:</span><?php foreach((array)$doc['tag'] as $key=>$tag) {?> <a href="index.php?search-tag-<?php echo $tag?>" ><?php echo $tag?></a> <?php }?></dd>
		<dd>
		<p><span class="bold">摘要:</span><?php echo $doc['summary']?><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>">[阅读全文:]</a></p>
		</dd>
		<dd class="gray ">编辑:<?php echo $doc['edits']?>次| 浏览:<?php echo $doc['views']?>次</dd>
	</dl>
	<?php }?>
	<?php } ?>
	<div id="fenye" class="m-t10"><?php echo $departstr?></div>
</div>
<div class="l w-230">
	<div class="columns category p-b10">
	<h2 class="col-h2"><?php echo $category['name']?></h2>
	<?php foreach((array)$subcategory as $key=>$parent) {?>
	<dl class="i6-ff">
		<dt><a href="index.php?category-view-<?php echo $parent['parent']['cid']?>" ><?php echo $parent['parent']['name']?></a></dt>
		<?php foreach((array)$parent['child'] as $value=>$child) {?>
		<dd><a href="index.php?category-view-<?php echo $child['cid']?>" ><?php echo $child['name']?></a></dd>
		<?php }?>
	</dl>
	<?php }?>
	</div>
</div>
<div class="c-b"></div>
<?php include $this->gettpl('footer');?>