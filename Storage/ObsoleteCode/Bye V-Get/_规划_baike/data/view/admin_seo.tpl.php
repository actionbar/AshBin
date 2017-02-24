<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('admin_header');?>
<script type="text/javascript">
function docheck(){
	var seo_headers = $.trim($('#seo_headers').val());
	if(seo_headers != '' && seo_headers.indexOf('<')!=0){
		alert('“其它头部信息”格式不正确，需以“<”开头');
		$('#seo_headers').focus();
		return false;
	}
}
</script>
<p class="map">全局：基本设置</p>
<p class="sec_nav">基本设置：<a href="index.php?admin_channel"> <span>频道管理</span></a> <a href="index.php?admin_setting-cache"> <span>缓存设置</span></a> <a href="index.php?admin_setting-seo" class="on"><span>SEO设置</span></a> <a href="index.php?admin_setting-code" ><span>验证码</span></a> <a href="index.php?admin_setting-time" ><span>时间设置</span></a> <a href="index.php?admin_setting-cookie" ><span>COOKIE设置</span></a> <a href="index.php?admin_setting-credit" ><span>经验金币设置</span></a> <a href="index.php?admin_setting-logo" ><span>LOGO设置</span></a></p>
<h3 class="col-h3">SEO设置</h3>
<ul class="col-ul tips">
	<li class="bold">提示：</li>
	<li>.html 后缀最利于搜索引擎收录。</li>
	<li>对于Rewrite的设置站长需要先了解自己的服务器/虚拟主机环境是否有Rewrite支持。</li>
</ul>
<form method="POST" action="index.php?admin_setting-seo" onSubmit="return docheck();">
	<table class="table">
			<td width="150px;"><span>URL静态化</span></td>
			<td></td>
		</tr>
		<tr>
			<td >URL格式: 形如</td>
			<td>
				<select name="seo_prefix">
				<?php if($seoconfig['seo_type']==0) { ?>
					<option value="index.php?" <?php if($seoconfig['seo_prefix']=="index.php?") { ?>selected<?php } ?>>index.php?</option>
					<?php if($servertype=="APACHE") { ?><option value="?" <?php if($seoconfig['seo_prefix']=="?") { ?>selected<?php } ?>>?</option><?php } ?>
					<?php if($seoconfig['seo_prefix']=="") { ?>
					<option value="" selected>(空)</option>
					<?php } ?>
				<?php } else { ?>
					<option value="" selected>(空)</option>
				<?php } ?>
				</select>doc-view-1
				<select name="seo_suffix">
					<option value="" <?php if($seoconfig['seo_suffix']=="") { ?>selected<?php } ?>>(空)</option>
					<option value=".htm" <?php if($seoconfig['seo_suffix']==".htm") { ?>selected<?php } ?>>.htm</option>
					<option value=".html" <?php if($seoconfig['seo_suffix']==".html") { ?>selected<?php } ?>>.html </option>
					<option value=".shtml" <?php if($seoconfig['seo_suffix']==".shtml") { ?>selected<?php } ?>>.shtml </option>
					<option value=".tpl" <?php if($seoconfig['seo_suffix']==".tpl") { ?>selected<?php } ?>>.tpl </option>
					<option value=".asp" <?php if($seoconfig['seo_suffix']==".asp") { ?>selected<?php } ?>>.asp </option>
					<option value=".jsp" <?php if($seoconfig['seo_suffix']==".jsp") { ?>selected<?php } ?>>.jsp </option>
					<option value=".php" <?php if($seoconfig['seo_suffix']==".php") { ?>selected<?php } ?>>.php </option>
					<option value=".do" <?php if($seoconfig['seo_suffix']==".do") { ?>selected<?php } ?>>.do </option>
				</select>
			</td>
		</tr>
		<tr>
			<td ><span>Rewrite支持</span></td>
			<td></td>
		</tr>
		<tr>
			<td>Rewrite支持</td>
			<td><input type="radio" name="seo_type" value="1" <?php if($seoconfig['seo_type']==1) { ?>checked<?php } ?> />是&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="seo_type" value="0" <?php if($seoconfig['seo_type']==0) { ?>checked<?php } ?> />否&nbsp;&nbsp;&nbsp;&nbsp;<p /></td>
		</tr>
		<tr>
			<td>开启类型</td>
			<td><input type="radio" name="seo_type_doc" value="1" <?php if($seoconfig['seo_type_doc']==1) { ?>checked<?php } ?> />仅开启以 http://mydomain/wiki/词条名 的rewrite规则&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="seo_type_doc" value="0" <?php if($seoconfig['seo_type_doc']==0) { ?>checked<?php } ?> />开启所有规则<p /></td>
		</tr>
		<tr>
			<td>标题关键字:</td>
			<td><input type="text" class="inp_txt" name="seo_title" value="<?php echo $seoconfig['seo_title']?>" size="52"/></td>
		</tr>
		<tr>
			<td>Meta keywords:</td>
			<td><input type="text" class="inp_txt" name="seo_keywords" value="<?php echo $seoconfig['seo_keywords']?>" size="52"/></td>
		</tr>
		<tr>
			<td>Meta Description:</td>
			<td><input type="text" class="inp_txt" name="seo_description" value="<?php echo $seoconfig['seo_description']?>" size="52"/></td>
		</tr>
		<tr>
			<td>其它头部信息:</td>
			<td><textarea class="textarea" name="seo_headers" id="seo_headers" style="width:300px;" rows="8" cols="47"><?php echo $seoconfig['seo_headers']?></textarea></td>
		</tr>
		<tr>
			<td colspan="2"><input class="inp_btn" name="seosubmit" type="submit" value="保 存"/></td>
		</tr>
	</table>
</form>
<?php include $this->gettpl('admin_footer');?>