<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<?php
 if($hu == 'js'){
 	$uu = 'JS加密/解密 - ';
 }elseif($hu == 'utf'){
 	$uu = 'UTF-8编码转换工具 - ';
 }elseif($hu == 'unicode'){
 	$uu = 'Unicode编码转换工具 - ';
 }elseif($hu == 'sharelink'){
 	$uu = '友情链接 - ';
 }elseif($hu == 'meta'){
 	$uu = 'META信息检测 - ';
 }elseif($hu == 'mds'){
 	$uu = 'MD5加密工具 - ';
 }elseif($hu == 'ids'){
 	$uu = '身份证号码值查询 - ';
 }elseif($hu == 'htmlubb'){
 	$uu = 'HTML/UBB代码转换工具 - ';
 }elseif($hu == 'htmljs'){
 	$uu = 'HTML/JS互转 - ';
 }elseif($hu == 'eseach'){
 	$uu = '搜索蜘蛛、机器人模拟工具 - ';
 }elseif($hu == 'density'){
 	$uu = '关键词密度检测 - ';
 }elseif($hu == 'countryym'){
 	$uu = '国家域名查看 - ';
 }elseif($hu == 'yb'){
 	$uu = '邮编区号查询 - ';
 }elseif($hu == 'whois'){
 	$uu = '域名Whois查询工具 - ';
 }elseif($hu == 'webs'){
 	$uu = '死链接检测/全站PR查询 - ';
 }elseif($hu == 'ssyqsl'){
 	$uu = '搜索引擎收录查询 - ';
 }elseif($hu == 'ssyqfl'){
 	$uu = '搜索引擎反向链接 - ';
 }elseif($hu == 'shouji'){
 	$uu = '查询手机号码归属地 - ';
 }elseif($hu == 'seo'){
 	$uu = 'SEO综合查询 - ';
 }elseif($hu == 'pr'){
 	$uu = 'PR值查询 - ';
 }elseif($hu == 'keys'){
 	$uu = '关键词排名查询 - ';
 }elseif($hu == 'ip'){
 	$uu = 'IP查询 - ';
 }elseif($hu == 'google'){
 	$uu = 'Google收录查询 - ';
 }elseif($hu == 'friends'){
 	$uu = '友情链接查询工具 - ';
 }elseif($hu == 'friendlink'){
 	$uu = '友情链接IP查询工具 - ';
 }elseif($hu == 'dels'){
 	$uu = '域名删除查询 - ';
 }elseif($hu == 'baidu'){
 	$uu = '百度收录查询 - ';
 }elseif($hu == 'outpr'){
 	$uu = 'PR输出值查询 - ';
 }elseif($hu == 'yuan'){
 	$uu = '查看网页源代码 - ';
 }elseif($hu == 'unix'){
 	$uu = 'Unix时间戳(Unix timestamp)转换工具 - ';
 }
?>
<title><?php echo $uu;?>站长查询工具（seo） - 苹果不撕皮儿博客</title>
<link href="http://www.seoued.net/tool/images/toolsite.css" rel="stylesheet" type="text/css" />
<script src="http://www.seoued.net/tool/images/globals.js" type="text/javascript"></script>
<script src="http://www.seoued.net/tool/images/home.js" type="text/javascript"></script>
<script type="text/javascript">
function $(ID) {
	return document.getElementById(ID);
}
	var xmlHttp;
	function creatXMLHttpRequest() {
		if(window.ActiveXObject) {
			xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
		} else if(window.XMLHttpRequest) {
			xmlHttp = new XMLHttpRequest();
		}
	}

	function startRequest() {
		var queryString;
		var domain = document.getElementById('domain').value;
		queryString = "domain=" + domain;
		creatXMLHttpRequest();
		xmlHttp.open("POST","?action=do","true");
		xmlHttp.onreadystatechange = handleStateChange;
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
		xmlHttp.send(queryString);
	}

	function handleStateChange() {
		if(xmlHttp.readyState == 1) {
			document.getElementById('result').style.cssText = "";
			document.getElementById('result').innerText = "Loading...";
		}
		if(xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200) {
				document.getElementById('result').style.cssText = "";
				var allcon =  xmlHttp.responseText;
				document.getElementById('result').innerHTML = allcon;
			}
		}
	}

function copyToClipboard(txt) {   
     if(window.clipboardData) {   
         window.clipboardData.clearData();   
         window.clipboardData.setData("Text", txt);   
     } else if(navigator.userAgent.indexOf("Opera") != -1) {   
          window.location = txt;   
     } else if (window.netscape) {   
          try {   
               netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");   
          } catch (e) {   
               alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");   
          }
          var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);   
          if (!clip)
               return;
          var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);   
          if (!trans)   
               return;   
          trans.addDataFlavor('text/unicode');   
          var str = new Object();   
          var len = new Object();   
          var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);   
          var copytext = txt;   
          str.data = copytext;   
          trans.setTransferData("text/unicode",str,copytext.length*2);   
          var clipid = Components.interfaces.nsIClipboard;   
          if (!clip)   
               return false;   
          clip.setData(trans,null,clipid.kGlobalClipboard);
     }   
}
function killErrors() {
return true;
}
window.onerror = killErrors;

</script>
</head>
<body>
<div class="wrap"> 
<div class="top-nav">
    <div class="top-menu">
    <a href="http://www.seoued.net/" target="_parent">石家庄seo</a> | 
    <a href="http://www.seoued.net/daohang/" target="_blank"><b>网址大全</b></a> |
    <a href="http://www.seoued.net/t/" target="_blank">微博客</a> | 
    <a href="http://www.seoued.net/tool/" target="_blank">站长工具</a> | 
    <a href="http://www.28sem.com/" target="_blank">28sem</a> |
	<a href="http://www.seoued.net/share" target="_blank">苹果推广</a> |
	<a href="http://www.yanbaicai.com" target="_blank">言白菜主机</a> | 
	<a href="http://idc.l-sky.cn" target="_blank"><font color="red">香港给力主机热销中.. </font></a>
    </div>
 </div>
  <div class="top">
    <div class="topbanner"></div>
    <div class="banneright">
<ul><li><a href="/" target="_blank"><font color="blue">中电云集服务器3600元/年</font></a></li>
<li><a href="/" target="_blank"><font color="red">中电云集1.3G美国空间199元</font></a></li>
<li><a href="/" target="_blank"><font color="blue">中电云集免备案香港空间上线</font></a></li>
</ul>
	</div>
  </div>
  <div class="menu"><a href="/">博客首页</a> <a href="/tool" class="select">站长工具</a> 
   <a onmouseover="mouseover(this, 3)" onmouseout="mouseout()" style="cursor:pointer;">网站信息查询</a> 
   <a onmouseover="mouseover(this, 4)" onmouseout="mouseout()" style="cursor:pointer;">SEO信息查询</a> 
   <a onmouseover="mouseover(this, 5)" onmouseout="mouseout()" style="cursor:pointer;">域名/IP类查询</a> 
   <a onmouseover="mouseover(this, 6)" onmouseout="mouseout()" style="cursor:pointer;">代码转换工具</a> 
   <a onmouseover="mouseover(this, 7)" onmouseout="mouseout()" style="cursor:pointer;">其他工具</a>
	<a href="http://www.seoued.net/t/" target="_blank">微博客</a>
<a href="http://www.seoued.net/daohang/" target="_blank"><font color="red">网址导航</font></a>
  </div>
  <!--sub menu-->
  <div id="menu3" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
    <ul>
    <li><a href="/tool/alexa" target="_blank">ALEXA排名查询</a></li>
    <li><a href="/tool/webs/webs.php" target="_blank">站内链接分析</a></li>
    <li><a href="/tool/density.php">关键词密度检测</a></li>
    <li><a href="/tool/meta.php">META信息检测</a></li>
    <li><a href="/tool/pr/outpr.php">PR输出值查询</a></li>
    <li><a href="/tool/yuan.php">查看网页源代码</a></li>
    </ul>
  </div>
  <div id="menu4" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
    <ul>
    <li><a href="http://www.seoued.net/tool/friends/friends.php">友情链接检测</a></li>
    <li><a href="http://www.seoued.net/tool/keys/keys.php">关键词排名查询</a></li>
    <li><a href="http://www.seoued.net/tool/baidu/baidu.php">百度近日收录</a></li>
    <li><a href="http://www.seoued.net/tool/google/google.php">Google收录</a></li>
    <li><a href="http://www.seoued.net/tool/ssyqsl/ssyqsl.php">网站收录查询</a></li>
    <li><a href="http://www.seoued.net/tool/ssyqfl/ssyqfl.php">反向链接查询</a></li>
    <li><a href="http://www.seoued.net/tool/pr/pr.php">PR查询</a></li>
    <li><a href="http://www.seoued.net/tool/esearch.php">机器人模拟</a></li>
    </ul>
  </div>
  <div id="menu5" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
    <ul>
    <li><a href="http://www.seoued.net/tool/dels/dels.php">域名删除时间</a></li>
    <li><a href="http://www.seoued.net/tool/ip/">IP查询</a></li>
    <li><a href="http://www.seoued.net/tool/whois/">WHOIS查询</a></li>
    <li><a href="http://www.seoued.net/tool/friendlink/friendlink.php">友情链接IP查询</a></li>
    </ul>
   </div>
   <div id="menu6" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
     <ul>
      <li><a href="http://www.seoued.net/tool/mds.php?mds=md5">MD5加密</a></li>
      <li><a href="http://www.seoued.net/tool/js.php">JS加密/解密</a></li>
      <li><a href="http://www.seoued.net/tool/htmljs.php">HTML/JS互转</a></li>
      <li><a href="http://www.seoued.net/tool/unicode.php">Unicode转换</a></li>
      <li><a href="http://www.seoued.net/tool/utf.php">Utf-8编码转换</a></li>
      <li><a href="http://www.seoued.net/tool/htmlubb.php">HTML/UBB互转</a></li>
      <li><a href="http://www.seoued.net/tool/unix.php">Unix时间戳转换</a></li>
     </ul>
   </div>
    <div id="menu7" class="menu-list" onmouseover="_mouseover()" onmouseout="_mouseout()">
     <ul>
      <li><a href="http://www.seoued.net/tool/ids.php">身份证号码查询</a></li>
      <li><a href="http://www.seoued.net/tool/shouji/index.php">手机号码归属地</a></li>
      <li><a href="http://www.seoued.net/tool/yb/yb.php">邮编区号查询</a></li>
      <li><a href="http://www.seoued.net/tool/countryym.php">国家域名查找</a></li>
     </ul>
   </div>
   