<?php
	require './include/common.inc.php';
	$pagetitle='友情链接';
function morehead(){
	echo <<<HEADHTML
<style type="text/css">
<!--
p {
	text-indent: 2em;
}
#main{
	height:300px;
}
#links ul{
	list-style:none;
}
#links ul li{
	float:left;
	padding-right:10px;
}
#links ul li a{
	color:#000;
}
-->
</style>
<base target="_blank" />
HEADHTML;
	}
	require TW_ROOT.'./template/other_header.php';
?>
  <div id="t">
	<h1>友情链接-爱查快递</h1>
  </div>
  <div id="links">
	<ul>
	<li> <a href="http://www.kuaidiwo.cn/">快递窝</a></li>
	<li><a href="http://www.333ku.com/">333ku导航</a></li>
	<li><a href="http://ems.ickd.cn/">EMS快递查询</a></li>
	<li><a href="http://www.9lou.org/">9楼快递查询</a></li>
	<li><a href="http://sto.ickd.cn/">申通快递查询</a></li>
	</ul>
</div>
  <div style="clear:both; "></div>
<div style="border-top: 1px dotted #CCC; margin-top: 20px; padding: 5px;">
<p>爱查快递主要提供快递单号查询和网点查询，同时搜集整理快递行业相关咨讯。真诚欢迎其他相关网站与我们交换链接。如果有意，请通过以下方式与我们联系（E-mail将在工作时间5小时内回复），或是<a href="message.php" target="_self">留言</a>给我们。<br>
  <br>
</p>
<h2>联系方式</h2>
  <p>E-mail：i@ickd.cn</p>
  <p>QQ：1158225800
</p>
</div>
<?php
	require TW_ROOT.'./template/other_footer.php';
?>