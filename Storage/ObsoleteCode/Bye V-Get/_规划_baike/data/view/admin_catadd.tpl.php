<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('admin_header');?>
<script type="text/javascript">
	function checkCatname(){
		if($("input[name='catname[]'][value!='']").length>0)
			return true;
		return false;
	}
	function doSubmit(){
		if(!checkCatname()){
			$.dialog.box('immageshow', '注意', '请填写要加入的分类名称!');
			return false;
		}
	}

	function addInput(){
		$('#catblock').append("<dd><input name=\"catname[]\" class=\"inp_txt\" type=\"text\" size=\"22\" maxlength=\"40\" />&nbsp;&nbsp;<a href=\"javascript:void(0)\" onclick=\"javascript:delInput(this)\">删除</a></dd>");
	}

	function delInput(obj){
		var j = $('#catblock');
		j[0].removeChild(obj.parentNode);
	}
</script>
<p class="map">内容管理：分类管理</p>
<p class="sec_nav">分类管理： <a href="index.php?admin_category-list"> <span>管理分类</span></a> <a href="index.php?admin_category-add" class="on"><span>添加分类</span></a> <a href="index.php?admin_category-merge"  ><span>合并分类</span></a> </p>
<h3 class="col-h3">添加分类</h3>
<form action="index.php?admin_category-add" onsubmit="return doSubmit();" method="POST">
	<table class="table">
		<tr>
			<td style="width:120px;"><span>上级分类</span></td>
			<td><select name='pcid'>
					<?php if(is_array($tcat)) { ?>
					<option value="<?php echo $tcat['cid']?>" selected="selected"><?php echo $tcat['name']?></option>
					<?php } else { ?>
					<option value="0">作为一级分类</option>
					<?php echo $cats?>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><span>分类名称</span></td>
			<td><dl id="catblock" >
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;</dd>
					<dd><input name="catname[]" class="inp_txt" type="text" size="22" maxlength="40" value=""/>&nbsp;&nbsp;[<a href="javascript:void(0)" onclick="javascript:addInput()">添加</a>]</dd>
				</dl></td>
		</tr>
		<tr style="display:none">
			<td style="width:100px;" align="center">分类图片万维网</td>
			<td><input id="catico" name="catico" class="inp_txt" type="text" size="22" maxlength="40" value=""/></td>
		</tr>
		<tr style="display:none">
			<td style="width:100px;" align="center">分类简介</td>
			<td><textarea id="catintro" name="catintro" class="inp_txt" cols="23" rows="8"></textarea></td>
		</tr>
		<tr><td></td>
			<td colspan="2" align="left">
				<input name="submit" class="inp_btn m-r10" type="submit" value="确定" /><input name="reset" class="inp_btn m-r10" type=reset value="重置" />
			</td>
		</tr>
	</table>
</form>
<?php include $this->gettpl('admin_footer');?>