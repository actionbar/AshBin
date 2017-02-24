<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('admin_header');?>
<style type="text/css">
dd{margin:0px;padding:0px;}
</style>
 <p class="map">内容管理：热门搜索</p>
<ul class="col-ul tips">
	<li class="bold">提示: 	</li>
	<li>热门搜索名称为必填，url为选填！前台按添加顺序显示。</li>
</ul>
<form action="index.php?admin_hotsearch"  method="POST">
<table  class="table">
<tr>
	<td style="width:280px;"><span>热门搜索名称</span></td>
	<td><span>热门搜索url</span></td>
</tr>
<tr>
	<td ><input name="hotname[0][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[0][name])) { ?><?php echo $hotsearch[0][name]?><?php } ?>"/></td>
	<td><input name="hotname[0][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[0][url])) { ?><?php echo $hotsearch[0][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[1][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[1][name])) { ?><?php echo $hotsearch[1][name]?><?php } ?>"/></td>
	<td><input name="hotname[1][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[1][url])) { ?><?php echo $hotsearch[1][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[2][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[2][name])) { ?><?php echo $hotsearch[2][name]?><?php } ?>"/></td>
	<td><input name="hotname[2][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[2][url])) { ?><?php echo $hotsearch[2][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[3][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[3][name])) { ?><?php echo $hotsearch[3][name]?><?php } ?>"/></td>
	<td><input name="hotname[3][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[3][url])) { ?><?php echo $hotsearch[3][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[4][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[4][name])) { ?><?php echo $hotsearch[4][name]?><?php } ?>"/></td>
	<td><input name="hotname[4][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[4][url])) { ?><?php echo $hotsearch[4][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[5][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[5][name])) { ?><?php echo $hotsearch[5][name]?><?php } ?>"/></td>
	<td><input name="hotname[5][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[5][url])) { ?><?php echo $hotsearch[5][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[6][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[6][name])) { ?><?php echo $hotsearch[6][name]?><?php } ?>"/></td>
	<td><input name="hotname[6][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[6][url])) { ?><?php echo $hotsearch[6][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[7][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[7][name])) { ?><?php echo $hotsearch[7][name]?><?php } ?>"/></td>
	<td><input name="hotname[7][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[7][url])) { ?><?php echo $hotsearch[7][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[8][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[8][name])) { ?><?php echo $hotsearch[8][name]?><?php } ?>"/></td>
	<td><input name="hotname[8][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[8][url])) { ?><?php echo $hotsearch[8][url]?><?php } ?>"/></td>
</tr>
<tr>
	<td ><input name="hotname[9][name]" class="inp_txt" type="text" size="22" maxlength="40" value="<?php if(!empty($hotsearch[9][name])) { ?><?php echo $hotsearch[9][name]?><?php } ?>"/></td>
	<td><input name="hotname[9][url]" class="inp_txt" type="text" size="30" value="<?php if(!empty($hotsearch[9][url])) { ?><?php echo $hotsearch[9][url]?><?php } ?>"/></td>
</tr>

<tr>
	<td colspan="2" >
		<input name="submit" class="inp_btn m-r10" type="submit" value="确定" />
		<input name="reset" class="inp_btn m-r10" type="reset" value="重置" />
	</td>
</tr>
</table>
</form>
<?php include $this->gettpl('admin_footer');?>