<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>
<div class="l w-710 o-v p-b10 resoult_list">
	<div class="p-10 bor-ccc cre_search">
	<form name="createform" method="post" action="index.php?doc-create">
	<dl class="ul_l_s">
		<dd class="create">本站尚未收录词条“<a href="index.php?doc-create" ><strong><?php echo $title?></strong></a>”，欢迎您来创建。
		<input name="title" type="hidden" value="<?php echo $title?>"/>
		<input name="create" type="submit" value="创建词条" class="btn_inp v-m"/><br />
		<?php if($search_tip_switch=='1' ) { ?>另外，您可以参考互动百科的搜索结果：
		<a href="http://www.baike.com/wiki/<?php echo $title?>" target="_blank"><?php echo $title?></a>
		<?php } ?>
		</dd>
	</dl>
	</form>
	</div> 

	<?php if(!empty($list)) { ?>
	<p class="resoult_total bold">以下是本站搜索结果</p>
	<?php foreach((array)$list as $key=>$doc) {?>
	<dl class="col-dl">
	<dt class="h2"><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>"><?php echo $doc['title']?></a></dt>
	<dd><p><span class="bold">摘要:&nbsp;&nbsp;</span><?php echo $doc['summary']?><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" class="block">[阅读全文]</a></p></dd>
	</dl>
	<?php }?>
	<dl class="col-dl">
		<dd><a href="index.php?search-fulltext-title-<?php echo urlencode($title)?>--all-0--time-desc-1-1">查看更多搜索结果</a></dd>
	</dl>
	<?php } ?>
</div>

<div class="r w-230">
	<!--
	<div class="ad">
		<a href="#" target="_blank"><img src="style/default/ad-230.jpg"/></a>
	</div>
	-->
	<div class="columns ad">
	<p class="a-c m-t10 col-p" >
	更多详情，尽在<a href="http://www.baike.com/wiki/<?php echo urlencode($searchtext)?>" target="_blank">互动百科</a><br/>
	更多详情，尽在<a href="http://www.google.com.hk/search?hl=zh-CN&newwindow=1&q=<?php echo urlencode($searchtext)?>&aq=f" target="_blank">谷歌搜索</a>
	</p>
	</div>
</div>
<div class="c-b"></div>
<?php include $this->gettpl('footer');?>