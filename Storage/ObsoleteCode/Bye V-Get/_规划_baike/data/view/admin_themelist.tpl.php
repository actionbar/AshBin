<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('admin_header');?>
<script language="javascript">
function download(appid){
	if(confirm('下载并安装将自动进行，确定吗？')){
		window.location.href="index.php?admin_theme-install-"+appid;
	}
}
function add(pathname){
	if(confirm('确认添加此模版?')==false){
		return false;
	}else{
		window.location='index.php?admin_theme-add-'+pathname.replace(/\./g,'*');
	}
}
</script>

<p class="map">插件/模板：在线安装</p>
<p class="sec_nav">模板：
    <a href="index.php?admin_theme"><span>设置默认风格</span></a>
    <a href="index.php?admin_theme-create" ><span>创建风格</span></a>
    <a href="index.php?admin_theme-list" class="on"><span>在线安装</span></a>
    <a href="index.php?admin_theme-edit" ><span>模板编辑</span></a>
</p>
    
<h3 class="col-h3">在线安装</h3>
<p class="col-p bold"><span class="m-l8">已有模板：</span>
    <?php foreach((array)$toaddlist as $style) {?>
        <a href="#" onclick="return add('<?php echo $style['ename']?>')"><?php echo $style['zname']?>(<?php echo $style['ename']?>)</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php } ?>
</p>

<div class="mar-t12 navcontainer">
  <ul class="navlist">
    <li><a href="index.php?admin_theme-list-time" <?php if($orderby=='time') { ?> id="current"<?php } ?>>按时间</a></li>
    <li><a href="index.php?admin_theme-list-install" <?php if($orderby=='install') { ?> id="current"<?php } ?>>按安装量</a></li>
    <li><a href="index.php?admin_theme-list-downloads" <?php if($orderby=='downloads') { ?> id="current"<?php } ?>>按下载量</a></li>
    
	<li><a href="http://kaiyuan.hudong.com/template.php" target="_blank">更多模板</a></li>
  </ul>
</div>
<!--此处模板只提供10个排序的模板，其他的点击更多，到主站模板下载，并根据不同版本的后台，自动筛选模板-->
 <div class="model">	
<?php foreach((array)$stylelist as $i=>$style) {?>
    <div class="model-cell"> 
        <dl>
            <dt><a href="<?php echo $style['name']?>" target="_blank"><img src="<?php echo $style['image']?>" class="plugin_img"/></a></dt>
            <dd class="link_orange bold"><a href="<?php echo $style['homepage']?>" target="_blank"><?php echo $style['name']?></a> version: <?php echo $style['version']?>  BY <a href="<?php echo $style['homepage']?>" target="_blank"> <?php echo $style['copyright']?></a></dd>
            <dd>标签:
            <?php foreach((array)$style['tag'] as $tag) {?>
            <a href="<?php echo $tag_url?><?php echo urlencode(string::hiconv($tag,'utf-8','gbk'))?>" target="_blank"><?php echo $tag?></a>
            <?php }?></dd>
            <dd>适用版本:<?php echo $style['suit']?></dd>
            <dd>安装次数:<?php echo $style['install']?><a href="<?php echo $style['install_list']?>" target="_blank">查看安装列表</a></dd>
          <dd>描述:<?php echo $style['description']?></dd>
            <dd></dd>
        </dl>
        <a class="install" href="javascript:download('<?php echo $style['appid']?>')"><b class="block">下载</b>(<?php echo $style['downloads']?>)</a>
        <b class="angle_t_l"></b>
        <b class="angle_t_r"></b>
        <b class="angle_b_l"></b>
        <b class="angle_b_r"></b>
    </div>

<?php } ?>
</div>
<table cellpadding="0" cellspacing="0" width="750px">
<tr>
	<td id="pagebar"><p class="fenye a-r"> <?php echo $departstr?> </p></td>
</tr>
</table>

<dl class="col-dl">
<dt>提示信息：
</dt>
<dd>本网站提供下载的风格，为 HDwiki 产品的爱好者开发并提供免费下载。风格的版权归属风格作者，互动百科公司不对因安装风格产生的任何后果负责。</dd>
</dl>


<?php include $this->gettpl('admin_footer');?>