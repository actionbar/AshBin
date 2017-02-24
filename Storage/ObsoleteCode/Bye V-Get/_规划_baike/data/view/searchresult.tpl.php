<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>
<?php if(1==$cloudsearch) { ?>
<div class="l w-710 o-v p-b10 resoult_list">

	<?php if($synonym) { ?>
	<div class="p-10 bor-ccc cre_search">
	"<span><?php echo $synonym['srctitle']?></span>"是"<span class="red"><?php echo $synonym['desttitle']?></span>"的同义词。<a class="link_blue m-lr8" href="index.php?doc-innerlink-<?php echo $synonym['linktitle']?>">点击此处</a>查看全部详细内容！
	</div>
	<?php } else { ?>
	<?php if($docnoexit) { ?>
	<div class="p-10 bor-ccc cre_search">
	<form name="createform" method="post" action="index.php?doc-create">
		<dl class="ul_l_s">
			<dd class="create">本站尚未收录词条“<span style="color:red;"><strong><?php echo $title?></strong></span>”，欢迎您来创建。
				<input name="title" type="hidden" value="<?php echo $title?>"/>
				<input name="create" type="submit" value="创建词条" class="btn_inp v-m"/>
				<br />
				<?php if($search_tip_switch=='1' ) { ?>
				另外，您可以参考互动百科的搜索结果： <a href="http://www.baike.com/wiki/<?php echo $title?>" target="_blank"><?php echo $title?></a>
				<?php } ?>
			</dd>
		</dl>
	</form>
	</div>
	<?php } ?>
	<?php } ?>
	<div>
		<iframe id="frame_content"  name="frame_content" src='<?php echo $iframesrc?>' style="width:705px;height:1200px;" scrolling='no'   frameborder="0" ></iframe>
	</div>
</div>
<?php } else { ?>
<p class="azmsx w-950"><span class="col-h2 block bold">按字母顺序浏览:</span><a href="index.php?list-letter-A" >A</a> <a href="index.php?list-letter-B" >B</a> <a href="index.php?list-letter-C" >C</a> <a href="index.php?list-letter-D" >D</a> <a href="index.php?list-letter-E" >E</a> <a href="index.php?list-letter-F" >F</a> <a href="index.php?list-letter-G" >G</a> <a href="index.php?list-letter-H" >H</a> <a href="index.php?list-letter-I" >I</a> <a href="index.php?list-letter-J" >J</a> <a href="index.php?list-letter-K" >K</a> <a href="index.php?list-letter-L" >L</a> <a href="index.php?list-letter-M" >M</a> <a href="index.php?list-letter-N" >N</a> <a href="index.php?list-letter-O" >O</a> <a href="index.php?list-letter-P" >P</a> <a href="index.php?list-letter-Q" >Q</a> <a href="index.php?list-letter-R" >R</a> <a href="index.php?list-letter-S" >S</a> <a href="index.php?list-letter-T" >T</a> <a href="index.php?list-letter-U" >U</a> <a href="index.php?list-letter-V" >V</a> <a href="index.php?list-letter-W" >W</a> <a href="index.php?list-letter-X" >X</a> <a href="index.php?list-letter-Y" >Y</a> <a href="index.php?list-letter-Z" >Z</a> <a href="index.php?list-letter-0" >0</a> <a href="index.php?list-letter-1" >1</a> <a href="index.php?list-letter-2" >2</a> <a href="index.php?list-letter-3" >3</a> <a href="index.php?list-letter-4" >4</a> <a href="index.php?list-letter-5" >5</a> <a href="index.php?list-letter-6" >6</a> <a href="index.php?list-letter-7" >7</a> <a href="index.php?list-letter-8" >8</a> <a href="index.php?list-letter-9" >9</a> <a href="index.php?list-letter-*" >其他</a> </p>
<?php if(0==$cloudsearch) { ?>
<p class="a-r resoult_total"> 搜索“<span class="red"><?php echo $searchtext?></span>”找到相关内容<?php echo $count?>篇，用时<?php echo $runtime?>秒 </p>
<?php } ?>
<div class="l w-710 o-v p-b10 resoult_list">

		<?php if($synonym) { ?>
	<div class="p-10 bor-ccc cre_search">
	"<span><?php echo $synonym['srctitle']?></span>"是"<span class="red"><?php echo $synonym['desttitle']?></span>"的同义词。<a class="link_blue m-lr8" href="index.php?doc-innerlink-<?php echo $synonym['linktitle']?>">点击此处</a>查看全部详细内容！
	</div>
	<?php } else { ?>
	<?php if($docnoexit) { ?>
	<div class="p-10 bor-ccc cre_search">
	<form name="createform" method="post" action="index.php?doc-create">
		<dl class="ul_l_s">
			<dd class="create">本站尚未收录词条“<span style="color:red;"><strong><?php echo $title?></strong></span>”，欢迎您来创建。
				<input name="title" type="hidden" value="<?php echo $title?>"/>
				<input name="create" type="submit" value="创建词条" class="btn_inp v-m"/>
				<br />
				<?php if($search_tip_switch=='1' ) { ?>
				另外，您可以参考互动百科的搜索结果： <a href="http://www.baike.com/wiki/<?php echo $title?>" target="_blank"><?php echo $title?></a>
				<?php } ?>
			</dd>
		</dl>
	</form>
	</div>
	<?php } ?>
	<?php } ?>
	<?php if(empty($list)) { ?>
	<dl class="col-dl">
		对不起，没有找到匹配结果。
	</dl>
	<?php } else { ?>
	<div class="p-10 resoult_total h2 gray">
	<a href="index.php?search-kw-<?php echo $keyword?>" class="m-r8">词条</a>|
	<a href="index.php?search-tag-<?php echo $keyword?>" class="m-lr8" >搜标签</a>
	</div>
	<?php foreach((array)$list as $key=>$doc) {?>
	<dl class="col-dl">
		<dt class="h2"><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" target="_blank"><?php echo $doc['title']?></a></dt>
		<dd class="gray ">词条创建者:<a href="index.php?user-space-<?php echo $doc['authorid']?>" target="_blank"><?php echo $doc['author']?></a>创建时间:<?php echo $doc['time']?> </dd>
		<dd><span class="bold">标签:</span>
			<?php foreach((array)$doc['tag'] as $key=>$tag) {?>
			<a href="index.php?search-tag-<?php echo rawurlencode($tag);?>" target="_self"><?php echo $tag?></a>
			<?php }?>
		</dd>
		<dd>
			<p><span class="bold">摘要:</span><?php echo $doc['summary']?><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" >[阅读全文] </a></p>
		</dd>
		<dd class="gray ">编辑:<?php echo $doc['edits']?>次| 浏览:<?php echo $doc['views']?>次</dd>
	</dl>
	<?php }?>
	<div id="fenye" class="m-t10 a-r"><?php echo $departstr?></div>
	<?php } ?>
</div>
<?php } ?>
<div class="r w-230">
	<div class="columns ad p-b8">
		<p class="a-c m-t10 col-p" > 更多详情，尽在<a href="http://www.baike.com/wiki/<?php echo urlencode($searchtext)?>?hf=hdwiki_so_www" target="_blank">互动百科</a><br/>
			更多详情，尽在<a href="http://www.google.cn/search?hl=zh-CN&newwindow=1&q=<?php echo urlencode($searchtext)?>&aq=f" target="_blank">谷歌搜索</a> </p>
	</div>
</div>
<div class="c-b"></div>
<?php include $this->gettpl('footer');?> 