<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('admin_header');?>
<script>
	function changetheme(name){
		name = name.substring(name.indexOf('(')+1,name.indexOf(')'));
		window.location='index.php?admin_theme-edit-'+name;
	}
	function pop(url){
		window.open(url,"","toolbar=no,scrollbars=no,menubar=no,status=no,resizable=yes");
	}
</script>
<p class="map">插件/模板：模板</p>
<p class="sec_nav">模板：
<a href="index.php?admin_theme"><span>设置默认风格</span></a>
<a href="index.php?admin_theme-create"><span>创建风格</span></a>
<a href="index.php?admin_theme-list"><span>在线安装</span></a>
<a href="index.php?admin_theme-edit" class="on"><span>模板编辑</span></a>
</p>
<h3 class="col-h3">模板编辑</h3>
<table class="table m_edit">
<colgroup>
	<col style="width:300px;"></col>
	<col style="width:160px;"></col>
	<col></col>	
</colgroup>
<tr>
<td colspan="3" class="bold"><form method="post">	选择要编辑的主题：<select name="theme" onchange="changetheme($(this).val())">
    <?php foreach((array)$themelist as $theme) {?>
    	<option
		<?php if($currtheme==$theme['path']) { ?>
			selected="selected"
		<?php } ?>>
	<?php echo $theme['name']?>(<?php echo $theme['path']?>)</option>
    <?php } ?>
	</select><a href="index.php?admin_theme-baseedit-<?php echo $currtheme?>" id="baseedit" class="m-lr10">初级编辑</a>
</form>
	
	</td>
</tr>
	<tr class="bold">
		<td>模板</td>
		<td>可视化编辑</td>
		<td>源码编辑</td>
	</tr>
	<?php foreach((array)$viewlist as $view_key=>$view_list) {?>
	<tr>
		<td><?php echo $stylelang[$view_key]?>(<?php echo $view_key?>.htm)</td>
		<td><span>
		<?php if($view_list) { ?>
			<a href="javascript:void(0)" onclick="pop('index.php?admin_theme-preview-<?php echo $currtheme?>-<?php echo $view_key?>')"><img src="style/default/admin/ksh.gif" /></a>
		<?php } ?>
		</td>
		<td><span><a href="index.php?admin_theme-codeedit-<?php echo $currtheme?>-<?php echo $view_key?>-htm"><img src="style/default/admin/yuanma.jpg"/></a></span></td>
	</tr>
	<?php }?>
	<?php foreach((array)$stylelist as $style_key=>$style_list) {?>
	<tr>
		<td><?php echo $stylelang[$style_key]?>(<?php echo $style_key?>.<?php echo $style_list?>)</td>
		<td><span>
		</td>
		<td><span><a href="index.php?admin_theme-codeedit-<?php echo $currtheme?>-<?php echo $style_key?>-<?php echo $style_list?>"><img src="style/default/admin/yuanma.jpg"/></a></span></td>
	</tr>
	<?php }?>
</table>
<?php include $this->gettpl('admin_footer');?>