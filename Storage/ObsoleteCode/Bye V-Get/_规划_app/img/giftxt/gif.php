<?php
/*
	author:sticker qq:21376498 落伍首发
*/
include 'head.php';
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id == '') header('location:index.php');
	
$gifdir = 'gif/';
include $gifdir.$id.'.gif.php';	
$cfg = $gif_config[$id];
?>
<script language="javascript">
<!--
function goindex()
{
	location.href = 'index.php';
}
function m()
{
	var txtlen = $('len').value;	
	var gid = $('gid').value;
	var txt = $('txt').value;
	if (txt == ''){
		alert('请输入文字！');		
		return;
	}
	if (txt.length > txtlen){
		alert('此gif最多输入'+txtlen+'字');
		return;
	}
	$('gif').innerHTML = '<span class="wait">正在制作gif...</span>';
	new Ajax('makegif.php?id='+gid+'&txt='+encodeURIComponent(txt), {method: 'get',onComplete:s}).request();	
	
}
function s(txt,xml)
{
	if (txt && txt.trim().length > 0) 
		$('gif').innerHTML = txt;
	else
		$('gif').innerHTML = '<font color="red">生成失败</font>';
}
function CopyValue(input)
{
	input.select();
	window.clipboardData.setData('text', input.value);
	alert('已经拷入剪贴板！');
}
//-->
</script>
请输入文字：
<INPUT type="text" class="box1" id="txt" onmouseover="this.className='box2'" onMouseOut="this.className='box1'" value="输入什么" />
&nbsp;<INPUT type="button" class="btn_2k3" value=" 生成Gif " onclick="m()" />
&nbsp;<INPUT type="button" class="btn_2k3" value=" 重新选择gif " onclick="goindex()" />
<input type="hidden" id="gid" value="<?php echo $id ?>" />
<input type="hidden" id="len" value="<?php echo $cfg['txtlen'] ?>" />
<br /><br />
<div id="gif">
	<img src="<?php echo $gifdir.$cfg['gif']?>" />
</div>
<?php include 'foot.php'?>