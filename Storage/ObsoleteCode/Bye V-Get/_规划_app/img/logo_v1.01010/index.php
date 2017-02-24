<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<link rel="shortcut icon" href="favicon.ico">
<TITLE>域名啦LOGO文字在线生成</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<META name="distribution" content="global">
<META name="revisit" content="1 day">
<META name="revisit-after" content="1 day">
<META name="resource-type" content="document">
<META name="audience" content="all">
<META name="robots" content="all">
<META name="robots" content="index,follow">
<META name="Author" content="www.yuming.la">
<META name="Keywords" content="free logo maker, online logos">
<META name="Description" content="Online Instant Logo Maker">
<SCRIPT LANGUAGE="JavaScript" src="fetch.js">
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="ajax.js">
</SCRIPT>
<script language="JavaScript" src="slider.js"></script>
<SCRIPT LANGUAGE="JavaScript" src="js/201a.js">
</SCRIPT>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'Preview','scrollbars=1,height=600,width=450');
	if (window.focus) {newwindow.focus()}
	return false;
}
// -->
</script>
<script language="javascript">
function makeit(iconb)
{
window.self.document.all.iconic.value=iconb;
}
function form_visible(pin){
var el = document.getElementById(pin);
if(el.style.display == 'inline'){
el.style.display = 'none';
}else{
el.style.display = 'inline';
}
}
</script>
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
</HEAD>
<BODY leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" bgcolor="#ffffff" onLoad="flip();">
<div id="colorpicker201" class="colorpicker201"></div>
<table border="0" width="1000" cellpadding="0" cellspacing="0" colspan="0" rowspan="0" class="first" align="center">
<TR height="85">
<td width="114">&nbsp;</td><TD valign="middle" width="772" align="center" background="images/header.png"><h1><font color="#FFFFFF">域名啦LOGO文字在线生成</font></h1></TD></td><td width="114">&nbsp;</td>
</TR>
<tr height="60">
<td width="114">&nbsp;</td><TD align="center" width="772" background="images/middle.png">
<?php include "top-ad.txt"; ?>
</TD><td width="114">&nbsp;</td>
</TR>
<tr height="150">
<td width="114">&nbsp;</td><TD align="center" width="772" background="images/middle.png">
<img id="logo_image" src="image.php?fsize=36&font=Curly.TTF&text=InstantLogoMaker&mirror=yes&color=CC0000&vcolor=CC0033&bgcolor=&alpha=yes&output=png&spacing=5&shadow=yes&transparent=no&icon=yes&iconic=radio&top_spacing=13&left_spacing=12&icon_size=48" alt="Right Click to Save Logo">
</TD><td width="114">&nbsp;</td>
</TR>
<tr height="400">
<td width="114">&nbsp;</td><TD align="center" width="772" background="images/middle.png">
<!-- Main Content Starts Here -->

<form onSubmit="javascript: return false;">
<table width="700" height="120" cellspacing="2" align="center" bgcolor="#FFFFFF">
<TD style="padding-left:12px;">
<Table>
<TR>
<TD width="100%" valign="top" colspan="2" align="center" style="padding-top:10px;">
Enter Logo Text
</TD>
</TR>
<TR height="80">
<TD width="85%" valign="top" align="center">
<input type="text" size="60" maxlength="45" id="per" class="search" colspan="2"><BR><BR>
</TD>
<TD align="center" width="15%" valign="top" style="padding-top:5px;">
<input type="image" src="images/submit.png" onClick="javascript:fetch();" value="Make Logo">
</TD>
</TR>
</table>
<table width="100%">
<TR height="30">
<TD width="15%" style="padding-left:4px;" align="center">Font:</TD><TD width="15%"><select id="font" style="width:100px;">
<?php
$handles = @opendir("fonts/");
while (false !== ($file = (readdir($handles)))) {
if ($file=='.' || $file=='..') { continue; }
$cur_directory[] = $file;
}
sort($cur_directory);
foreach ($cur_directory as $file) {
$sfile=str_replace(" ","+",$file);
$bfile=strtolower($file);
$bfile=ucfirst($file);
$bfile=str_replace("-"," ",$bfile);
$bfile=str_replace("_"," ",$bfile);
$bfile=explode(".",$bfile);
echo "<option value=\"$sfile\">$bfile[0]";
}
@closedir($handles);
?>
</select></TD>
<TD width="15%" style="padding-left:4px;" align="center">Size:</TD><TD width="15%">
<input type="hidden" name="fsize" id="fsize" type="Text" size="2" onchange="A_SLIDERS[0].f_setValue(this.value);" style="border:0px;">
<script language="JavaScript">
	var A_TPL1h = {
		'b_vertical' : false,
		'b_watch': true,
		'n_controlWidth': 120,
		'n_controlHeight': 16,
		'n_sliderWidth': 16,
		'n_sliderHeight': 15,
		'n_pathLeft' : 1,
		'n_pathTop' : 1,
		'n_pathLength' : 103,
		's_imgControl': 'images/sldr2h_bg.gif',
		's_imgSlider': 'images/sldr2h_sl.gif',
		'n_zIndex': 1
	}

	var A_INIT1h = {
		's_form' : 0,
		's_name': 'fsize',
		'n_minValue' : 15,
		'n_maxValue' : 60,
		'n_value' : 35,
		'n_step' : 1
	}
	new slider(A_INIT1h, A_TPL1h);
</script>
</TD>
<TD width="15%" style="padding-left:4px;" align="center">Alpha:</TD><TD width="15%"><select name="alpha" id="alpha" style="width:100px;"><option value="yes">Yes<option value="no">No</select></TD>
<TD width="10%">&nbsp;</TD>
</TR>
<TR height="40">
<TD width="15%" style="padding-left:4px;" align="center">Color 1:</TD><TD width="15%"><input type="text" id="clr" size="6" readonly="true" onFocus="showColorGrid2('clr','none');"> <input type="button" value=".."  onclick="showColorGrid2('clr','none');"></TD>
<TD width="15%" style="padding-left:4px;" align="center">Color 2:</TD><TD width="15%"><input type="text" id="clr1" size="6" readonly="true" onFocus="showColorGrid2('clr1','none');"> <input type="button" value=".."  onclick="showColorGrid2('clr1','none');"></TD>
<TD width="15%" style="padding-left:4px;" align="center">Background:</TD><TD width="15%"><input type="text" id="clr2" size="6" readonly="true" onFocus="showColorGrid2('clr2','none');"> <input type="button" value=".."  onclick="showColorGrid2('clr2','none');"></TD>
<TD width="10%">&nbsp;</TD>
</TR>
<TR height="40">
<TD width="15%" style="padding-left:4px;" align="center">Mirror:</TD><TD width="15%"><select id="mirror"  style="width:100px;"><option value="yes">Yes<option value="No">No</select></TD>
<TD width="15%" style="padding-left:4px;" align="center">Mirror Spacing:</TD><TD width="15%">

<input type="hidden" name="spacing" id="spacing" type="Text" size="2" onchange="A_SLIDERS[0].f_setValue(this.value);" readonly="readonly" style="border:0px;">
<script language="JavaScript">
	var A_TPL2h = {
		'b_vertical' : false,
		'b_watch': true,
		'n_controlWidth': 120,
		'n_controlHeight': 16,
		'n_sliderWidth': 16,
		'n_sliderHeight': 15,
		'n_pathLeft' : 1,
		'n_pathTop' : 1,
		'n_pathLength' : 103,
		's_imgControl': 'images/sldr2h_bg.gif',
		's_imgSlider': 'images/sldr2h_sl.gif',
		'n_zIndex': 1
	}

	var A_INIT2h = {
		's_form' : 0,
		's_name': 'spacing',
		'n_minValue' : 1,
		'n_maxValue' : 7,
		'n_value' : 5,
		'n_step' : 1
	}
	new slider(A_INIT2h, A_TPL2h);
</script>


<!-- <select id="spacing"  style="width:100px;"><option value="1">1<option value="2">2<option value="3">3<option value="4" selected>4<option value="5">5<option value="6">6<option value="7">7</select>
 -->
</TD>
<TD width="15%" style="padding-left:4px;" align="center">Output:</TD><TD width="15%"><select name="output" id="output" style="width:100px;"><option value="png">PNG<option value="gif">GIF</select></TD>
</TR>
<TR height="40">
<TD width="15%" style="padding-left:4px;" align="center">Shadow:</TD><TD width="15%"><select name="shadow" id="shadow" style="width:100px;"><option value="no">No<option value="yes">Yes</select></TD>
<TD width="15%" style="padding-left:4px;" align="center">Transparent:</TD><TD width="15%"><select name="transparent" id="transparent" style="width:100px;"><option value="no">No<option value="yes">Yes (PNG output only)</select></TD>
<TD width="15%" style="padding-left:4px;" align="center">Icon:</TD><TD width="15%"><select  name="icon" id="icon" style="width:100px;" onChange="form_visible('icon_show');return flip();"><option value="no">No<option value="yes">Yes</select></TD>
<TD width="10%">&nbsp;</TD>
</TR>
<tr>
<td colspan=7>
<span id="icon_show" style="display:none;">
<table width="600"><tr height="40"><td width="150">Icon Top Spacing:</td><td width="50">
<input type="hidden" name="top_spacing" id="top_spacing" type="Text" size="2" onchange="A_SLIDERS[0].f_setValue(this.value);" readonly="readonly" style="border:0px;">
<script language="JavaScript">
	var A_TPL3h = {
		'b_vertical' : false,
		'b_watch': true,
		'n_controlWidth': 120,
		'n_controlHeight': 16,
		'n_sliderWidth': 16,
		'n_sliderHeight': 15,
		'n_pathLeft' : 1,
		'n_pathTop' : 1,
		'n_pathLength' : 103,
		's_imgControl': 'images/sldr2h_bg.gif',
		's_imgSlider': 'images/sldr2h_sl.gif',
		'n_zIndex': 1
	}

	var A_INIT3h = {
		's_form' : 0,
		's_name': 'top_spacing',
		'n_minValue' : 0,
		'n_maxValue' : 50,
		'n_value' : 5,
		'n_step' : 1
	}
	new slider(A_INIT3h, A_TPL3h);
</script>
</td>
<td width="150">Icon Left Spacing:</td><td width="50">
<input type="hidden" name="left_spacing" id="left_spacing" type="Text" size="2" onchange="A_SLIDERS[0].f_setValue(this.value);" readonly="readonly" style="border:0px;">
<script language="JavaScript">
	var A_TPL4h = {
		'b_vertical' : false,
		'b_watch': true,
		'n_controlWidth': 120,
		'n_controlHeight': 16,
		'n_sliderWidth': 16,
		'n_sliderHeight': 15,
		'n_pathLeft' : 1,
		'n_pathTop' : 1,
		'n_pathLength' : 103,
		's_imgControl': 'images/sldr2h_bg.gif',
		's_imgSlider': 'images/sldr2h_sl.gif',
		'n_zIndex': 1
	}

	var A_INIT4h = {
		's_form' : 0,
		's_name': 'left_spacing',
		'n_minValue' : 0,
		'n_maxValue' : 100,
		'n_value' : 5,
		'n_step' : 2
	}
	new slider(A_INIT4h, A_TPL4h);
</script>
</td>
<td width=150>Icon Size:</td><td width=50><select name="icon_size" id="icon_size"><option value="48" selected>Small<option value="64">Medium<option value="72">Large</select></td>
</tr>
</table>
</span>
</td>
</tr>
<TR height="40">
<TD colspan="6" width="100%" style="padding-left:4px;" align="center"><span id="txt"></span><BR><span id="scat"></span></TD>
</TR>
</TR>
<TR height="40">
<TD colspan="7" align="center"><a href="popup.php" onClick="return popitup('popup.php')"><b>Preview Fonts</b></a>
</TD>
</TR>
</Table>
</TD>
</Table>
</form>
<BR>
<?php include "bottom-ad.txt"; ?>
<!-- Main Content Ends Here -->
</TD><td width="114">&nbsp;</td>
</TR>
<TR height="85">
<td width="114">&nbsp;</td><TD valign="middle" width="772" align="center" background="images/footer.png"><font color="#FFFFFF">&copy; 2011 <a href="http://www.yuming.la/">域名啦</a>. All Rights Reserved </font></TD></td><td width="114">&nbsp;</td>
</TR>
</table>
</BODY>
</HTML>