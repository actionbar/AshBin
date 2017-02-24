<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('admin_header');?>
<script type="text/javascript">
function doSubmit(){
	if(isNaN($('#search_time').val())==true){
		alert('搜索间隔时间必须为数字');
		$('#search_time').focus();
		return false;
	}
}
</script>
<p class="map">全局：内容设置</p>
<p class="sec_nav">内容设置： <a href="index.php?admin_setting-index"> <span>首页设置</span></a> <a href="index.php?admin_setting-listdisplay" ><span>列表设置</span></a> <a href="index.php?admin_setting-watermark" ><span>图片设置</span></a> <a href="index.php?admin_setting-docset"><span>词条设置</span></a> <a href="index.php?admin_setting-search" class="on"><span>搜索设置</span></a> <a href="index.php?admin_setting-attachment" ><span>附件设置</span></a></p>
<h3 class="col-h3">搜索设置</h3>
<form method="POST" action="index.php?admin_setting-search" onsubmit="return doSubmit();">
<table class="table">
	<tr>
		<td width="500px"><span>参数名称</span></td>
		<td><span>参数值</span></td>
	</tr>
	<!--
	<tr>
		<td><span>云搜索</span>是否开启云搜索</td>
		<td>
			<label><input type="radio"  name="setting[cloud_search]" value="1" <?php if($basecfginfo['cloud_search']=='1' || '' === $basecfginfo['cloud_search']  ) { ?>checked<?php } ?>/>是</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio"  name="setting[cloud_search]" value="0" <?php if($basecfginfo['cloud_search']=='0') { ?>checked<?php } ?>/>否</label>
		</td>
	</tr>
	-->
	<tr>
		
		<td><span>搜索提示开关</span>搜索词条不存在时是否显示提示“可以参考互动百科来创建某某词条”</td>
		<td>
			<label><input type="radio"  name="setting[search_tip_switch]" value="1" <?php if($basecfginfo['search_tip_switch']=='1') { ?>checked<?php } ?>/>是</label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio"  name="setting[search_tip_switch]" value="0" <?php if($basecfginfo['search_tip_switch']=='0') { ?>checked<?php } ?>/>否</label>
		</td>
	</tr>
	<tr>
		
		<td><span>搜索间隔时间(秒)</span>设置前台搜索词条的间隔时间（一个用户两次搜索的最短时间限制），单位是“秒”。</td>
		<td>
		<input type="input" class="inp_txt" name="setting[search_time]" id="search_time"  <?php if(isset($basecfginfo['search_time'])) { ?>value="<?php echo $basecfginfo['search_time']?>"<?php } else { ?>value="30"<?php } ?>/>
			</td>
	</tr>
	<tr>
		<td colspan="2">
			<input class="inp_btn" name="searchsubmit" type="submit" value="保 存" />&nbsp;&nbsp;
		</td>
	</tr>
</table>
</from>
<?php include $this->gettpl('admin_footer');?>