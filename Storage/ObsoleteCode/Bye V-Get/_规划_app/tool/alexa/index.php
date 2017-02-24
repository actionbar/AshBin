<?php
define('IN_SEO','IN_SEO');
$url = trim($_POST["domain"]?$_POST["domain"]:$_GET["domain"]);
$url = $url?$url:'seoued.net';
$string = file_get_contents("http://data.alexa.com/data/+wQ411en8000lA?cli=10&dat=s&ver=7.0&url=$url");
header("content-Type: text/html; charset=GB2312");
$pat4 = "/POPULARITY URL=\"(.+)\" TEXT=\"(.+)\"\/>/Ui";
preg_match_all($pat4, $string, $array);	
$wordpm2 = $array[2][0]?$array[2][0]:'none';

$string = iconv("UTF-8","GB2312",$string);
$pat1   = "/ HOST=\"(.+)\"/i";
preg_match_all($pat1, $string, $array);
$selurl = $array[1][0]?$array[1][0]:'没有记录';

$pat5 = "/LINKSIN NUM=\"(.+)\"/i";
preg_match($pat5, $string, $array);
$weblink = $array[1]?$array[1]:'0';

$pat6 = "/DATE=\"(.+)\" DAY=\"(.+)\" MONTH=\"(.+)\" YEAR=\"(.+)\"/i";
preg_match_all($pat6, $string, $array);
$sldate = $array[1][0]?$array[1][0]:'没有记录';

$pat7 = "/CAT ID=\"(.+)\" TITLE=\"(.+)\" CID=\"(.+)\"/i";
preg_match_all($pat7, $string, $array);
if($array[1][0]){
   $a  = array_reverse(explode('/',$array[1][0]));
   $aa = $a[1].'/'.$a[0];
}
$ml = $aa?$aa:'该站未被亚马逊分类目录收录';

$pat8 = "/SPEED TEXT=\"(.+)\" PCT=\"(.+)\"/i";
preg_match_all($pat8, $string, $array);
$speedtext = $array[1][0]?$array[1][0]:'没有记录';
$speedpct  = $array[2][0]?$array[2][0]:'没有记录';

$pat9 = "/LANG LEX=\"(.+)\"/i";
preg_match_all($pat9, $string, $array);
$country = $array[1][0]?$array[1][0]:'不详';

$pat10 = "/OWNER NAME=\"(.+)\"/i";
preg_match_all($pat10, $string, $array);
$owner = $array[1][0]?$array[1][0]:'不详';

$pat11= "/EMAIL ADDR=\"(.+)\"/i";
preg_match_all($pat11, $string, $array);
$email = $array[1][0]?$array[1][0]:'不详';

$pat12 = "/NUMBER=\"(.+)\"/i";
preg_match_all($pat12, $string, $array);
$phone = $array[1][0]?$array[1][0]:'不详';

$pat13 = "/ADDR STREET=\"(.+)\" CITY/i";	
preg_match_all($pat13, $string, $array);
$addr = $array[1][0]?$array[1][0]:'不详';

$pat14 = "/DESC=\"(.+)\"/i";
preg_match_all($pat14, $string, $array);
$site = $array[1][0]?$array[1][0]:"该站点还没有向ALEXA提交任何介绍信息。<a href=http://www.alexa.com/data/details/contact_info?url=".$selurl." target=_blank><font color=#ff0000>&nbsp;>>>现在提交信息<<<&nbsp;</font></a>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta name="Robots" content="All"  />
<meta name="Keywords" content="alexa,排名,查询" />
<meta name="Description" content="专业提供中文ALEXA世界排名查询服务。" />
<base onmouseover="window.status='中文ALEXA世界排名查询服务由中电数据中心免费提供';return true">
<title><?php echo $selurl?>的Alexa网站排名、流量、访问量、页面浏览量查询|中文ALEXA排名查询服务由中电数据中心免费提供</title>
<link rel="stylesheet" href="images/Style.css" type="text/css" media="all" />
<script src="ajax.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript">
function killErrors() {
return true;
}
window.onerror = killErrors;
var Sys_LoadStart=new Date();
window.onload=function ajaxs(){
	 var domain = document.getElementById('domain').value;
	 talktoServer('ajaxs.php?action=rangs&domain='+domain,'changestext',"html");   
     talktoServer('ajaxs.php?action=sonvisits&domain='+domain,'changestext2',"html");
     talktoServer('ajaxs.php?action=visits&domain='+domain,'changestext3',"html");   
}
</SCRIPT>
</head>
<body>
<!--头部代码开始-->
<div class="colspan">
<div class="title"><a href="">中文Alexa网站排名流量访问量查询系统PoweredBy中电数据中心</a> | 推荐：<a href="http://www.seoued.net">石家庄seo</a> <a href="http://idc.l-sky.cn">悠然主机</a> <a href="http://www.yanbaicai.com" target="_blank">言白菜主机</a> <a href="http://www.28sem.com" target="_blank">青装营销策划</a> <a title="把查询地址加到收藏夹，以方便以后查询！" onClick="window.external.addFavorite('','网站ALEXA排名查询')">加入收藏夹</a></div>
<div class="data">
<form name="form1" action="" method="POST"> 
<table width="780" cellspacing="0">
	<tr>
		<td>
请输入要查询的网址: HTTP://WWW. <input type="text" style="border:1px solid #999900;padding:3px;font-weight:bold;font-size:15px" id="domain" name="domain" size="28" id="url" value="<?php echo $selurl?>" onKeyDown="if(event.keyCode==13)document.form1.submit();" class="input_form"><script>document.alexasearch.domain.focus()</script><input type="submit" value="查 询" name="submit" class="submit_button" id="sub" style="margin-top:9px;padding-top:2px;width:100px;height:27px">&nbsp;&nbsp;
</td>
	</tr>	
</table>
</form>
</div>
</div>
<!--False-->
<div id="text_ad">欢迎您使用由 中电数据中心 免费提供的中文版ALEXA查询服务！</div>
<!--头部代码结束-->
<div class="colspan"> 
	<div class="title">网站 <b><font color="#FFFF00">www.<?php echo $selurl?></font></b> 在 Alexa 上全球综合排名第 <b><font color="#FFFF00"><?php echo $wordpm2?></font></b> 位</div> 
	<div class="data">
		<table width="780" cellspacing="0" class="DoubleColorTable">
	<tr>
		<td colspan="7">只提供ALEXA排名查询服务，请勿咨询如何提高ALEXA排名和ALEXA排名作弊，不赞同和鼓励任何作弊行为。</td>
	</tr>
	<tr>
		<td width="210" height="155" rowspan="7"><div id="view_pic"><a href="http://www.chinaccnet.com" target="_blank"><Img Src="images/No_Pic.gif" border="0" width="202" height="147"></a></div></td>
		<td width="66">站点名称:</td>
		<td width="100" align="left" title="<?php echo $selurl?>"><?php echo $selurl?></td>
		<td width="66">网站站长:</td>
		<td width="100" align="left" title="<?php echo $owner?>"><?php echo $owner?></td>
		<td width="66">电子信箱:</td>
		<td width="174" align="left" title="<?php echo $email?>"><?php echo $email?></td>
	</tr>
	<tr>
		<td width="66">综合排名:</td>
		<td width="100" align="left"><span id="Rank"><?php echo $wordpm2?></span></td>
		<td width="66">下期排名:</td>
		<td width="100" align="left"><span id="NextRank"><?php echo $wordpm2?></span></td>
		<td width="66">收录日期:</td>
		<td width="174" align="left"><?php echo $sldate?></td>
	</tr>
	<tr>
		<td width="66">所属国家:</td>
		<td width="100" align="left"><?php echo $country?></td>
		<td width="66">编码方式:</td>
		<td width="100" align="left">不详</td>
		<td width="66">访问速度:</td>
		<td width="174" align="left" title="页面平均载入时间<?php echo $speedtext?>Ms,比62%的网站访问速度快。结论：速度正常。"><?php echo $speedtext?> Ms      /      <?php echo $speedpct?>分</td>
	</tr>
	<tr>
		<td width="66">成人内容:</td>
		<td width="100" align="left">NO</td>
		<td width="66">反向链接:</td>
		<td width="100" align="left" title="点击数字查看详细反向链接站点"><a href="http://www.alexa.com/data/ds/linksin?q=link:<?php echo $selurl?>" target="_blank"><?php echo $weblink?></a> 个</td>
		<td width="66">联系电话:</td>
		<td width="174" align="left" title="<?php echo $phone?>"><?php echo $phone?></td>
	</tr>
	<tr>
		<td width="66">详细地址:</td>
		<td width="500" colspan="5" align="left" title="<?php echo $addr?>"><?php echo $addr?></td>
	</tr>
	<tr>
		<td width="66">网站简介:</td>
		<td width="500" colspan="5" align="left" title="<?php echo $site?>。">
		<font color="D4D4D4"><?php echo $site?></font></td>
	</tr>
	<tr>
		<td width="66" style="color:#ff0000;">站长推荐:</td>
		<td width="260" colspan="3" align="left"><a href="http://www.seoued.net" target="_blank"><font style="color:#ff0000;font-weight:bold;">石家庄seo</font></a>  <a href="http://idc.l-sky.cn" target="_blank"><font style="color:#ff0000;font-weight:bold;">悠然主机</font></a> <a href="http://www.yanbaicai.com" target="_blank"><font style="color:#ff0000;font-weight:bold;">言白菜主机</font></a></td>
		<td width="66">所属目录:</td>
		<td width="174" align="left" title="<?php echo $ml?>"><?php echo $ml?></td>
	</tr>
	<tr>
		<td><a href="http://www.alexa.com/edit/index/seoued.net" target="_blank">修改信息</a> | <a href="http://www.alexa.com/data/details/editor?type=rl&url=seoued.net" target="_blank">提交链接</a></td> 
		<td colspan="6"><div><a href="whois/index.php?domain=<?php echo $selurl?>" target="_blank" style="cursor:hand"><font color="#ff0000">Whois信息查询</font></a> | <a href="http://tool.chinaccnet.com/ip/?ip=<?php echo $selurl?>" target="_blank">服务器IP查询</a></div></td>
	</tr>
</table>
	</div> 
</div> 
<div id="text_ad2">欢迎您使用由 中电数据中心 免费提供的中文版ALEXA查询服务！</div> 
<div class="colspan">  
	<div class="title">站点 <strong><?php echo $selurl?></strong> 的 Alexa 排名查询结果  | <a href="http://www.alexa.com/data/details/traffic_details/chinaccnet.com" target="_blank">Alexa官方数据</a></div> 
  <div class="data"  id="changestext">
  		<table width="780" cellspacing="0">
			<tr>
				<td width="12%" class="project_left">当日排名</td>
				<td width="12%" class="project">排名变化趋势</td>
				<td width="12%" class="project">一周平均排名</td>
				<td width="12%" class="project">排名变化趋势</td>
				<td width="12%" class="project">一月平均排名</td>
				<td width="12%" class="project">排名变化趋势</td>
				<td width="12%" class="project">三月平均排名</td>
				<td width="12%" class="project">排名变化趋势</td>
			</tr>
<?php if($url=='chinaccnet.com'){
?>
			<tr height="40">
				<td class="rank_left" id="ranks1">--</td>
				<td class="rank" id="ranks2">--</td>
				<td class="rank" id="ranks3">52,701</td>
				<td class="rank" id="ranks4"><img src=images/Up_arrow.gif border=0><font color=#FF0000>29,873 </font></td>
				<td class="rank" id="ranks5">72,450</td>
				<td class="rank" id="ranks6"><img src=images/Down_arrow.gif border=0><font color=#FF0000>4,699 </font></td>
				<td class="rank" id="ranks7"><?php echo $wordpm2?></td>
				<td class="rank" id="ranks8"><img src=images/Down_arrow.gif border=0><font color=#FF0000>23,130 </font></td>
			</tr>
<?php }else{
?>
  			<tr height="40">
				<td class="rank_left" id="ranks1"><img src="images/Load.gif" /></td>
				<td class="rank" id="ranks2"><img src="images/Load.gif" /></td>
				<td class="rank" id="ranks3"><img src="images/Load.gif" /></td>
				<td class="rank" id="ranks4"><img src="images/Load.gif" /></td>
				<td class="rank" id="ranks5"><img src="images/Load.gif" /></td>
				<td class="rank" id="ranks6"><img src="images/Load.gif" /></td>
				<td class="rank" id="ranks7"><?php echo $wordpm2?></td>
				<td class="rank" id="ranks8"><img src="images/Load.gif" /></td>
			</tr>
<?php }
?>
		</table>
	</div>
 </div>
 <div id="pic_ad">欢迎您使用由 中电数据中心 免费提供的中文版ALEXA查询服务！</div> 
 <div class="colspan"> 
	<div class="title">网站日平均Alexa排名走势图 <font color="#FF0099" onmousemove="this.color='#FF0000';" onmouseout="this.color='#FF0099';" >[点击时间段查看相应时段曲线]</font></div> 
	<div class="data">
		<table width="780" cellspacing="0">
			<tr>
				<td class="project_left"><a OnClick="document.all.rank1.style.display='';document.all.rank2.style.display='none';document.all.rank3.style.display='none';document.all.rank4.style.display='none';document.all.rank5.style.display='none';" style="cursor:hand">六个月平均排名曲线</a></td>
				<td class="project"><a OnClick="document.all.rank1.style.display='none';document.all.rank2.style.display='';document.all.rank3.style.display='none';document.all.rank4.style.display='none';document.all.rank5.style.display='none';"style="cursor:hand">三个月平均排名曲线</a></td>
				<td class="project"><a OnClick="document.all.rank1.style.display='none';document.all.rank2.style.display='none';document.all.rank3.style.display='';document.all.rank4.style.display='none';document.all.rank5.style.display='none';"style="cursor:hand">一个月平均排名曲线</a></td>
				<td class="project"><a OnClick="document.all.rank1.style.display='none';document.all.rank2.style.display='none';document.all.rank3.style.display='none';document.all.rank4.style.display='';document.all.rank5.style.display='none';"style="cursor:hand">半个月平均排名曲线</a></td>
				<td class="project"><a OnClick="document.all.rank1.style.display='none';document.all.rank2.style.display='none';document.all.rank3.style.display='none';document.all.rank4.style.display='none';document.all.rank5.style.display='';"style="cursor:hand">一星期平均排名曲线</a></td>
			</tr>
			<tr>
				<td colspan="5" class="rank_left">
<div id="rank1"><img width="700px" height="280px" src="http://traffic.alexa.com/graph?w=700&h=280&r=6m&y=t&u=<?php echo $url?>" alt=" 如果看不到图片，请单击右键选择 [显示图片] "></div>
<div id="rank2" style="display:none"><img width="700px" height="280px" src="http://traffic.alexa.com/graph?w=700&h=280&r=3m&y=t&u=<?php echo $url?>" alt=" 如果看不到图片，请单击右键选择 [显示图片] "></div>
<div id="rank3" style="display:none"><img width="700px" height="280px" src="http://traffic.alexa.com/graph?w=700&h=280&r=1m&y=t&u=<?php echo $url?>" alt=" 如果看不到图片，请单击右键选择 [显示图片] "></div>
<div id="rank4" style="display:none"><img width="700px" height="280px" src="http://traffic.alexa.com/graph?w=700&h=280&r=15.0m&y=t&u=<?php echo $url?>" alt=" 如果看不到图片，请单击右键选择 [显示图片] "></div>
<div id="rank5" style="display:none"><img width="700px" height="280px" src="http://traffic.alexa.com/graph?w=700&h=280&r=7.0m&y=t&u=<?php echo $url?>" alt=" 如果看不到图片，请单击右键选择 [显示图片] "></div>
</td>
			</tr>
		</table>
	</div> 
</div>
<div id="pic_ad">欢迎您使用由 中电数据中心 免费提供的中文版ALEXA查询服务！</div>
<div class="colspan"> 
	<div class="title">Alexa 统计的 <strong><?php echo $selurl?></strong> 下属子站点 被访问比例 及 人均页面浏览量 列表</div> 
	<div class="data" id="changestext2"> 

	</div> 
</div>
<div class="colspan"> 
	<div class="title">Alexa 统计的 <strong><?php echo $selurl?></strong> 国家/地区排名、访问比例 列表</div> 
	<div class="data" id="changestext3">
	</div> 
</div>
<div class="colspan"> 
	<div class="title">中文Alexa查询系统使用说明及相关帮助</div> 
	<div class="data">
		<table width="780" cellspacing="0">
			<tr>
				<td class="rank_left">
中文Alexa网站排名数据来自Amazon.com官方，为方便国内站长查询自己网站排名数据，本站已经把所得数据精心整理显示，数据跟Alexa保持同步！欢迎大家使用！<br/> 
				</td>
			</tr>
		</table>
	</div> 
</div>
<div id="bottom">
	<div class="bottom_title"></div> 
		<table width="100%" cellspacing="0">
			<tr>
				<td width="100%" class="bottom_nav"><a href="" OnClick="this.style.behavior='url(#default#homepage)';this.setHomePage('')">设为首页</a> ┊ <a OnClick="javascript:window.external.addFavorite('','中文Alexa查询')" style="cursor: hand;">加入收藏</a> ┊ <a href="http://www.seoued.net/about">联系站长</a> ┊ <a href="http://download.alexa.com/?amzn_id=chinawebmas0b-20" target="_blank">工具条下载</a></td>
			</tr>
			<tr>
				<td height="20"></td>
			</tr>
			<tr>
				<td class="copyrights">页面执行时间:125 Ms<script language="JavaScript">var Sys_LoadEnd=new Date();var Sys_LoadTime=0;Sys_LoadTime=(Sys_LoadEnd - Sys_LoadStart);document.write('&nbsp;&nbsp;页面装载时间:'+Sys_LoadTime+' Ms&nbsp;&nbsp;');</script>
			<tr>
				<td height="30" id="alexa"></td>
			</tr>
				</td>
			</tr>
		</table>
</div></body></html>
<div style="display:none"><script src="http://s5.cnzz.com/stat.php?id=2805830&web_id=2805830" language="JavaScript"></script></div>