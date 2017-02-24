<?php header("content-Type: text/html; charset=utf-8");$weburl=$_SERVER['SERVER_NAME'];$weblink="http://".$weburl."/";if(count($_GET)>0){$urlip=array_keys($_GET);$urlip=str_replace("_",".",$urlip[0]);}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TITLE><?=$urlip;?><?=$_POST['ip'];?>IP地址查询-电脑IP地址查询-网站IP地址查询-精确IP地址查询-<?=$weburl;?></TITLE>
<META NAME="Generator" CONTENT="ip,代理IP查询,IP地址查询">
<META NAME="Author" CONTENT="IP查询,ip.1tt.net">
<META NAME="Keywords" CONTENT="电脑IP地址查询,网站IP地址查询,IP地址查询,代理IP查询，域名ip地址,域名whois,<?=$weburl;?>">
<META NAME="Description" CONTENT="电脑IP地址查询主要能够查询本地电脑的ip,网站IP地址,域名ip地址,ip所在省区,域名whois信息,代理IP查询并提供IP地址查询php源码下载尽在<?=$weburl;?>">
<style type="text/css">
body {font-size:14px;line-height:150%;background-image: url(bg_body.jpg);background-repeat:repeat-x;}
a{ text-decoration:none; color:#990000}
.detect_table {border: 1px solid #C3E1EE;border-collapse: collapse;margin-top: 5px;width: 650px;}
</style>
<SCRIPT LANGUAGE="JavaScript">function checkIP(){var ipArray,ip,j;ip = document.ipform.ip.value;if(/[A-Za-z_-]/.test(ip)){if(!/^([\w-]+\.)+((com)|(net)|(org)|(gov\.cn)|(info)|(cc)|(com\.cn)|(com\.hk)|(net\.cn)|(org\.cn)|(com\.ru)|(net\.ru)|(org\.ru)|(name)|(biz)|(hk)|(vn)|(com\.sg)|(pk)|(ph)|(ac)|(bz)|(de)|(net\.au)|(my)|(tv)|(us)|(jp)|(kr)|(sg)|(mn)|(cd)|(ue)|(sh)|(lc)|(hn)|(me)|(la)|(cc)|(tk)|(com\.tw)|(cm)|(cn))$/.test(ip)){alert("不是正确的域名,请检查域名格式或看是否有空格");	document.ipform.ip.focus();return false;}}else{ipArray = ip.split(".");j = ipArray.length;if(j!=4){alert("不是正确的IP");document.ipform.ip.focus();return false;}for(var i=0;i<4;i++){if(ipArray[i].length==0 || ipArray[i]>255){alert("不是正确的IP");document.ipform.ip.focus();return false;}}}}
google_ad_client = "ca-pub-2006512290696014";google_ad_slot = "6662313368";google_ad_width = 468;google_ad_height = 60;
</script>
</head>
<body>
<?php
$ip=$_POST['ip']?$_POST['ip']:$urlip;if(!$ip)$ip=get_real_ip();
$ip=preg_match('/((\w|-)+\.)+[a-z]{2,4}/i',$ip)?gethostbyname($ip) : $ip;
$ipdata=ipdata($ip,'all');
?>
<div align="center" style="margin-top:100px">
  <p>&nbsp;</p>
  <p><a href="http://ref.so/pv18" title="<?=$weburl;?>IP查询介绍" target="_blank">IP查询</a></p>
</div>
 <div class="c" align="center">
	<div>
<FORM METHOD=POST ACTION="" name="ipform" onsubmit="return checkIP();">
<p>IP地址或域名：
<input type="text" name="ip" size="27" maxlength="100" title="<?=$weburl;?>提醒您在此输入ip或域名" id="url" value="<?php if(!$_POST['ip']){echo $urlip;}else{echo $_POST['ip'];}?>"> 
<input type="submit" value="查 询" id="sub"><INPUT TYPE="hidden" name="action" value="2"></p>
</FORM>
<p>
  <?php
	if(is_ip($ip)){
		$ipaddress=$ipdata->country;
		if($ipdata->region==$ipdata->city){$ipaddress.=$ipdata->city;}else{$ipaddress.=$ipdata->region.$ipdata->city;}
		$ipaddress.=$ipdata->isp;
		echo "您查询的IP:&nbsp;[<a href='".$weblink.$ip."'><font color=#FF0000>".$ip."</font></a>]IP详细地址:&nbsp;[<font color=#FF0000>".$ipaddress."</font>]<br/>"; 
	}else{echo "囧，你输入的IP,居然不能查询到!不是输入错误？";}
	$ipdaili=$_SERVER['REMOTE_ADDR'];
	if(!in_array($ipdaili,array('127.0.0.1',$ip,$_SERVER['SERVER_ADDR'],get_real_ip()))){
		echo "您的代理IP是[<a href='".$weblink.$ipdaili."'><font color=#FF0000>".$ipdaili."</font></a>]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;来自".ipdata($ipdaili)."";
	}
$whiosip=$_POST['ip']?$_POST['ip']:$urlip;
if($whiosip){preg_match('/((\w|-)+\.)+[a-z]{2,4}/i',$whiosip) ? $whois=str_replace("www.","",$whiosip):"";}
if($whois){echo "<br /><br /><a href='http://72e.hbwanghai.com/domain/who_single.aspx?DomainName=".$whois."' target='_blank'>点击查看域名 ".$whois." 的WhoIs信息</a>";}
?>
</p>
</div>
</div>
<div align="center" style=" margin-top:150px">
<table class="detect_table" id="ip_all">
<tbody><tr><th>IP</th><th>国家/地区</th><th>省份</th><th>城市</th><th>县</th><th>运营商</th></tr>
<tr><td align="center"><span class="sip"><?=$ip;?></span></td><td align="center"><?=$ipdata->country.$ipdata->area?></td><td align="center"><?=$ipdata->region?></td><td align="center"><?=$ipdata->city?></td><td align="center"><?=$ipdata->county?></td><td align="center"><?=$ipdata->isp?></td></tr></tbody></table><br>
<?=base64_decode("PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iaHR0cDovL3BhZ2VhZDIuZ29vZ2xlc3luZGljYXRpb24uY29tL3BhZ2VhZC9zaG93X2Fkcy5qcyI+PC9zY3JpcHQ+");?>
<p>Copyright &copy; <a href="http://72e.hbwanghai.com" target="_blank">联动天下</a> All Rights Reserved <a href="<?=$weblink;?>"><?=$weburl;?></a> <a href="http://www.ctdisk.com/u/349707/437278" target="_blank">源码下载</a></p><p>本站为非赢利站点，如有好的建议和意见请发email.给我们留言谢谢!
<br>
如果您觉得本站对您的朋友有帮助，别忘了告诉他（她）们哟 ^_^</p>
</div><div style="display:none"><script language="javascript" type="text/javascript" src="http://js.users.51.la/3729735.js"></script></div></body>
</html>
<?php
function get_real_ip(){
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
	{$ip = getenv('HTTP_CLIENT_IP');}
	elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
	{$ip = getenv('HTTP_X_FORWARDED_FOR');}
	elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
	{$ip = getenv('REMOTE_ADDR');}
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
	{$ip = $_SERVER['REMOTE_ADDR'];}
	return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : false;
}
function is_ip($str) {
    $ip = explode(".", $str);if (count($ip)<4 || count($ip)>4) return 0;
    foreach($ip as $ip_addr) {if ( !is_numeric($ip_addr) ) return 0;if ( $ip_addr<0 || $ip_addr>255 ) return 0;
    }return 1;
}
function ipdata($ip,$name="0")
{
	$url="http://ip.taobao.com/service/getIpInfo.php?ip=";
	$data=json_decode(file_get_contents($url.$ip)); $ipdata=$data->data;
	if($name=="all")   {return $ipdata;}
	else if($name=="0"){return $ipdata->country.$ipdata->region.$ipdata->city.$ipdata->isp;}
	else if($name=="1"){return $ipdata->country;}
	else if($name=="2"){return $ipdata->area;}
	else if($name=="3"){return $ipdata->region;}
	else if($name=="4"){return $ipdata->city;}
	else if($name=="5"){return $ipdata->county;}
	else if($name=="6"){return $ipdata->isp;}
}
?>