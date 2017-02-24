<%@LANGUAGE="VBSCRIPT" CODEPAGE="936"%>
<%
'============================
   '过滤SQL非法字符
   'Num 0一般 1数字
   '============================
   Function CheckStr(Strer,Num)
        Dim Shield,w
	    If Strer = "" Or IsNull(Strer) Then Exit Function
	    Select Case Num
		  Case 0
			Strer = Trim(Strer)
			Strer = Replace(Strer,CHR(39),"&#39;")     '单引号
            Strer = Replace(Strer,CHR(34),"&quot;")    '双引号
            Strer = Replace(Strer,CHR(32),"&nbsp;")    '空格
            Strer = Replace(Strer,CHR(60),"&lt;")      '<
            Strer = Replace(Strer,CHR(62),"&gt;")      '>
            Strer = Replace(Strer,vbCrLf,"<br>")       
		  Case 1
	        If IsNumeric(Strer) = 0 Then
	          Response.Write "操作错误"
		      Response.End
	        End If
			Strer = Int(Strer)
		  Case 2'文本域提交
			Strer = Replace(Strer,CHR(39),"&#39;")     '单引号
            Strer = Replace(Strer,CHR(34),"&quot;")    '双引号
            Strer = Replace(Strer,CHR(32),"&nbsp;")    '空格
            Strer = Replace(Strer,CHR(60),"&lt;")      '<
            Strer = Replace(Strer,CHR(62),"&gt;")      '>
            Strer = Replace(Strer,vbCrLf,"<br>")       
		  Case 3'文本域显示
			Strer = Replace(Strer,"&#39;",CHR(39))     '单引号
            Strer = Replace(Strer,"&quot;",CHR(34))    '双引号
            Strer = Replace(Strer,"&nbsp;",CHR(32))    '空格
            Strer = Replace(Strer,"&lt;",CHR(60))      '<
            Strer = Replace(Strer,"&gt;",CHR(62))      '>
            Strer = Replace(Strer,"<br>",vbCrLf)
          
          Case 4'替换字符(<script><//script><iframe></iframe>)
             Strer = Replace(Strer,"script"," ")
	         Strer = Replace(Strer,"SCRIPT"," ")
             Strer = Replace(Strer,"iframe", " ")
	         Strer = Replace(Strer,"IFRAME", " ")

		End Select

	   ' Shield = Split(KM_Kill,"|")
	   ' For w=0 To Ubound(Shield)
		  'If Shield(w) <> "" Then
            'Strer=Replace(Strer,Split(Shield(w),"=")(0),Split(Shield(w),"=")(1))
		  'End If
		
	    'Next
	    CheckStr = Strer
   End Function
   %>
   
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>IP地址查询-客齐齐实用查询工具</title>
<meta name="keywords" content="ip,IP查询,IP地址查询">
<meta content="最ip,IP查询,IP地址查询!" name="description" />
<link href="../images/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {margin:0; padding:0;background: #FFF url('../images/top3.gif') repeat-x top; font-size:12px;color:#666}
.style1 {font-size: 14px}
-->
</style>
</HEAD>
<BODY>
<table width="960" height="75" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="264" rowspan="2" align="center"><a href="../index.html">
	<img src="../images/logo.gif" width="224" height="38" border="0" /></a></td>
    <td height="24" valign="top">
	<table width="321" height="24" border="0" align="right" cellpadding="0" cellspacing="0" background="../images/top2.gif">
       <tr>
          <td align="center" class="cwhite12"><a href="#" class="cwhite12">tools.kqiqi.com</a>　<a href="#" OnClick='this.style.behavior="url(#default#homepage)";this.setHomePage("http://tools.kqiqi.com");' class="cwhite12">设为首页</a> | <a href="#" onClick="window.external.AddFavorite('http://tools.kqiqi.com','客齐齐实用查询工具');" class="cwhite12">收藏本站</a></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table height="38" border="0" cellpadding="0" cellspacing="0" style="margin-left:5px">
      <tr align="center">
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../index.html" class="navfh2">首　页</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../admin/index.html" class="navfh2">站长工具</a></td>
          <td width="88" background="../images/nav2.gif" style="padding-top:5px"><a href="../query/index.html" class="navfh1">查询工具</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../calculation/index.html" class="navfh2">计算工具</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../password/index.html" class="navfh2">加密解密</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../conversion/index.html" class="navfh2">转换工具</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../color/index.html" class="navfh2">颜色工具</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../web/index.html" class="navfh2">网络辅助</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../picture/index.html" class="navfh2">图片工具</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../others/index.html" class="navfh2">其它工具</a></td>
        </tr>
    </table></td>
  </tr>
</table>
<script language="javascript" src="../js/others_top.js"></script>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" class="mainbg1">
  <tr valign="top">
    <td width="20">　</td>
    <td width="190">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="2" height="10">

</td>
</tr>
      <tr>
        <td width="75%">
		<img src="../images/t9.gif" width="32" height="32" align="absmiddle" />　<span class="navfh1">工具列表</span></td>
        <td width="25%">　</td>
      </tr>
    </table>
     <table width="100%"  border="0" cellpadding="0" cellspacing="0" background="../images/t12.gif" class="mar5">
        <tr>
          <td height="10"> </td>
        </tr>
      </table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="mar5">
      <tr>
        <td>　
 <div id="menu">
 <div class="box">
    <a href="http://cy.kqiqi.com" target="_blank">成语查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>

  <div class="box">
    <a href="../query/Wnl.html">万年历
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
    <div class="box">
    <a href="../ip">IP查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/shengxiao.html">生肖查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/bazi.html">生辰八字查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/mark.html">标志大全
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/xingzuo.html">星座对照表
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/ems.html">各类快递查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
<div class="box">
    <a href="../query/nannv.html">生男生女查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
<div class="box">
    <a href="../query/dianhua.html">常用电话号码
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
<div class="box">
    <a href="../query/chepai.html">车牌号码查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
<div class="box">
    <a href="../query/weizhang.html">全国车辆交通违章查询表
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
<div class="box">
    <a href="../query/worldtime.html">世界时间查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/funv.html">妇女安全期查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/yuansu.html">元素周期表
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/health.html">健康查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/zipcode.html">邮编和电话区号
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
  <div class="box">
    <a href="../query/id.html">身份证号所在地
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
    <div class="box">
    <a href="../tel">(手机/电话)归属地
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
    <div class="box">
    <a href="../query/train.html">列车时刻查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
    <div class="box">
    <a href="../query/sudu.html">上网连接速度测试
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>
   <div class="box">
    <a href="../query/keywords.html">关键字密度查询
      <span class="left"></span>
      <span class="right"></span>
    </a>
  </div>

</div>
       </td>
      </tr>
    </table>

      <table width="100%" height="17"  border="0" cellpadding="0" cellspacing="0" background="t2.gif" class="mar5">
        <tr>
          <td> </td>
        </tr>
      </table>
     
    </td>
    <td width="27">　</td>
    <td width="700">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
      <td height="10" colspan="2">
      </td>
      </tr>
        <tr>
         <td width="40"><img src="../images/ip.gif" width="32" height="32"> </td>
          <td><span class="navfh1">IP查询</span></td>
        </tr>
      </table>
      <hr size="1" style="color:#E3E8E9" />
      <table width="100%"  border="0" cellpadding="3" cellspacing="1">
              <tr>
          <td>
          <SCRIPT LANGUAGE="JavaScript">
<!--
function checkIP()
{
	var ipArray,ip,j;
	ip = document.ipform.ip.value;
	
	if(/[A-Za-z_-]/.test(ip)){
		if(!/^([\w-]+\.)+((com)|(net)|(org)|(gov\.cn)|(info)|(cc)|(com\.cn)|(net\.cn)|(org\.cn)|(name)|(biz)|(tv)|(cn)|(mobi)|(name)|(sh)|(ac)|(io)|(tw)|(com\.tw)|(hk)|(com\.hk)|(ws)|(travel)|(us)|(tm)|(la)|(me\.uk)|(org\.uk)|(ltd\.uk)|(plc\.uk)|(in)|(eu)|(it)|(jp))$/.test(ip)){
			alert("不是正确的IP！");
			document.ipform.ip.focus();
			return false;
		}
	}
	else{
		ipArray = ip.split(".");
		j = ipArray.length
		if(j!=4)
		{
			alert("不是正确的IP！");
			document.ipform.ip.focus();
			return false;
		}

		for(var i=0;i<4;i++)
		{
			if(ipArray[i].length==0 || ipArray[i]>255)
			{
				alert("不是正确的IP！");
				document.ipform.ip.focus();
				return false;
			}
		}
	}
}
//-->
</SCRIPT>
<FORM METHOD=POST ACTION="index.asp" name="ipform" onsubmit="return checkIP();">
<table width="100%"  border="0"  align="center" cellpadding="4" cellspacing="1">
<tr>
<td bgcolor="#95e2ff">
<p align="center">IP地址查询
</td>
</tr>
  <tr>
    <td>请输入IP地址：
    <input name="ip" type="text" value="" size="31">
    <input type="submit" value="查询" class="button1">
    您的IP是：<%=request.ServerVariables("REMOTE_ADDR")%>
    </td>
  </tr>
  <tr>
<td bgcolor="#95e2ff">
<p align="center">查询结果
</td>
</tr>
<tr>
    <td>您要查询的IP来自：
  <font color="red">
<%
clientip=CheckStr(request("ip"),0)
If clientip ="" Then 
clientip = Request.ServerVariables("REMOTE_ADDR")
'else
'clientip = Request.ServerVariables("HTTP_X_FORWARDED_FOR")
end if


Function getIpvalue(clientIP)'得到客户端 的IP转换成长整型，返回值getIpvalue
On Error Resume Next
Dim strIp,array_Ip
strIp=0
array_Ip = Split(clientIP,".")
If UBound(array_Ip)<>3 Then
getIpvalue=0
Exit Function
End If
For i=0 To 3
strIp=strIp+(CInt(array_Ip(i))*(256^(3-i)))
Next
getIpvalue=strIp
If Err Then getIpvalue=0
End Function 

Set CONN=Server.CreateObject("ADODB.Connection")
CONN.Open "DRIVER={Microsoft Access Driver (*.mdb)};DBQ="&Server.Mappath("IP.mdb")
IpValue=getIpvalue(clientIP)
SQL = "SELECT * FROM [IP] WHERE StartIP<=" & IpValue & " AND EndIP>=" & IpValue
Set RsIp = CONN.Execute ( SQL )
If RsIp.bof and RsIp.eof then
UrlCity="未知"
Else
UrlCity=RsIp.Fields.Item("Country").Value
UrlCity1=RsIp.Fields.Item("local").Value

End If
Set Conn = Nothing
RsIp.close
Set RsIp=Nothing
response.write ""&UrlCity&""&UrlCity1&""
%>
</font>
</td>
  </tr>

</font>
</td>
  </tr>
  <tr>
<td bgcolor="#95e2ff">
</td>
</tr>
  <tr>
  <td>
            <script type="text/javascript" src="../js/wz.js"></script>
         <script type="text/javascript" src="../js/Copy.js"></script>
  </td>
  </tr>
 
</table>

</FORM>


          
          </td>
        </tr>
        </table>


      <br />
      </td>
    <td width="20">　</td>
  </tr>
</table>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" class="mainbg2">
  <tr>
    <td height="25"></td>
  </tr>
</table>

<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" class="mainbg2">
  <tr>
    <td><table width="920"  border="0" align="center" cellpadding="0" cellspacing="20" class="bottombg">
       <tr>
        <td align="center">
          Copyright &copy; <a href="http://tools.kqiqi.com/">客齐齐实用查询工具</a> All rights reserved - <a href="../map.html">网站地图</a> - <a href="../contact.html">联系我们</a> - <script language="javascript" src="../js/bottom.js"></script>
          </td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
 
   
   
  
