<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>
<style type="text/css">
<!--
.a-img1 img {
max-width:140px;
max-height:140px;
width: expression(this.width > 136 && this.width/this.height >= 1 ? 136 : true);
height: expression(this.height > 136 && this.width/this.height < 1 ? 136 : true);
}
.on{background:url(style/default/col_h2_on_bg.gif) repeat-x left top;}
-->
</style>
<div class="l w-230 tpbk_sideba">
<div class="columns  m-t10">
<h2 class="col-h2 <?php if($type==2) { ?>on<?php } ?>"><a href="index.php?pic-piclist-2">最新图片</a></h2>
</div>
<div class="columns  m-t10">
<h2 class="col-h2 <?php if($type==3) { ?>on<?php } ?>"><a href="index.php?pic-piclist-3">点击排行</a></h2>
</div>
<div class="columns  m-t10">
<h2 class="col-h2 <?php if($type==1) { ?>on<?php } ?>"><a href="index.php?pic-piclist">精选图片</a></h2>
</div>
<div id="block_left"></div>
</div>
<div class="r w-710">
<ul class="gray list j-zhong tpbk_img_list">


<?php if($piclist) { ?>
	<?php foreach((array)$piclist as $key=>$data) {?>
	<li>
	<label>
	<a href="index.php?pic-view-<?php echo $data['id']?>-<?php echo $data['did']?>" target="_blank" class="a-img1"><img src="<?php echo $data['attachment']?>" alt="<?php echo $data['description']?>" name="图片百科" /></a>
	</label>
	<a href="wiki/<?php echo rawurlencode($data['rawtitle']);?>" target="_blank" title="<?php echo $data['description']?>" class="a-c"><?php echo $data['subdescription']?></a>
	<p class="a-c m-lr8"><?php echo $data['sizeinfo']?></p>
	</li>
	<?php }?>
<?php } else { ?>
no pictures
<?php } ?>

</ul>
<div class="c-b"></div>
 <div id="fenye" class="m-t10 m-r8 a-r"> 
 <?php echo $departstr?>
</div>
</div>
<?php include $this->gettpl('footer');?>
