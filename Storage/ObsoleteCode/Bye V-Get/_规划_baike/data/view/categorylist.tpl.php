<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>
<div id="category" class="l w-710 o-v bor-c_dl category">
	<div class="hd_map">
	<a href="<?php echo WIKI_URL?>"><?php echo $setting['site_name']?></a> &gt;&gt;百科分类
	</div>
	<?php if(!empty($subcategory)) { ?>
	<?php foreach((array)$subcategory as $category) {?>
	<dl class="i6-ff m-t10 p-b10">
	  <dt><a href="index.php?category-view-<?php echo $category['parent']['cid']?>" ><?php echo $category['parent']['name']?></a></dt>
	  <?php if(!empty($category['child'])) { ?>
	  <?php foreach((array)$category['child'] as $child) {?><dd><a href="index.php?category-view-<?php echo $child['cid']?>"><?php echo $child['name']?></a></dd><?php } ?>
	 <?php } ?>
	</dl>
	<?php } ?>
	<?php } ?>
</div>
<div class="r w-230">
    <div id="block_right"><?php $data= $GLOBALS['blockdata'][13];$bid="13"?><div  class="columns i6-ff p-b8 rmbq <?php echo $data['config']['style']?>" bid="<?php echo $bid?>">
	<h2 class="col-h2">热门标签</h2>
	<ul class="col-ul list-s">
	<?php foreach((array)$data['hottag'] as $tag) {?>
		<?php if($tag['tagcolor']=='red') { ?>
			<li><a href="index.php?search-tag-<?php echo urlencode($tag['tagname'])?>" class="red"><?php echo $tag['tagname']?></a></li>
		<?php } else { ?>
			<li><a href="index.php?search-tag-<?php echo urlencode($tag['tagname'])?>" ><?php echo $tag['tagname']?></a></li>
	    <?php } ?>
    <?php } ?>
	</ul>
</div><?php $data= $GLOBALS['blockdata'][14];$bid="14"?><div class=" columns i6-ff p-b10 azmsx<?php echo $data['config']['style']?>" bid="<?php echo $bid?>">
	<h2 class="col-h2">按字母顺序浏览</h2>
	<ul class="col-ul list-s">
		<li><a href="index.php?list-letter-A">A</a></li>
		<li><a href="index.php?list-letter-B">B</a></li>
		<li><a href="index.php?list-letter-C">C</a></li>
		<li><a href="index.php?list-letter-D">D</a></li>
		<li><a href="index.php?list-letter-E">E</a></li>
		<li><a href="index.php?list-letter-F">F</a></li>
		<li><a href="index.php?list-letter-G">G</a></li>
		<li><a href="index.php?list-letter-H">H</a></li>
		<li><a href="index.php?list-letter-I">I</a></li>
		<li><a href="index.php?list-letter-J">J</a></li>
		<li><a href="index.php?list-letter-K">K</a></li>
		<li><a href="index.php?list-letter-L">L</a></li>
		<li><a href="index.php?list-letter-M">M</a></li>
		<li><a href="index.php?list-letter-N">N</a></li>
		<li><a href="index.php?list-letter-O">O</a></li>
		<li><a href="index.php?list-letter-P">P</a></li>
		<li><a href="index.php?list-letter-Q">Q</a></li>
		<li><a href="index.php?list-letter-R">R</a></li>
		<li><a href="index.php?list-letter-S">S</a></li>
		<li><a href="index.php?list-letter-T">T</a></li>
		<li><a href="index.php?list-letter-U">U</a></li>
		<li><a href="index.php?list-letter-V">V</a></li>
		<li><a href="index.php?list-letter-W">W</a></li>
		<li><a href="index.php?list-letter-X">X</a></li>
		<li><a href="index.php?list-letter-Y">Y</a></li>
		<li><a href="index.php?list-letter-Z">Z</a></li>
		<li><a href="index.php?list-letter-0">0</a></li>
		<li><a href="index.php?list-letter-1">1</a></li>
		<li><a href="index.php?list-letter-2">2</a></li>
		<li><a href="index.php?list-letter-3">3</a></li>
		<li><a href="index.php?list-letter-4">4</a></li>
		<li><a href="index.php?list-letter-5">5</a></li>
		<li><a href="index.php?list-letter-6">6</a></li>
		<li><a href="index.php?list-letter-7">7</a></li>
		<li><a href="index.php?list-letter-8">8</a></li>
		<li><a href="index.php?list-letter-9">9</a></li>
		<li><a href="index.php?list-letter-*" style="width:auto">其他</a></li>
	</ul>
</div></div>
	<!--ad start -->
	<div class="ad" id="advlist_7">
	<?php if(isset($advlist[7]) && isset($setting['advmode']) && '1'==$setting['advmode']) { ?>
	<?php echo $advlist[7][code]?>
	<?php } ?>
	</div>
	<!--ad end -->	
</div>
<?php include $this->gettpl('footer');?>