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
<title>手机电话归属地查询-客齐齐实用查询工具</title>
<meta name="keywords" content="手机电话归属地查询">
<meta content="手机电话归属地查询!" name="description" />
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
         <td width="40"><img src="../images/phonetorf.gif" width="32" height="32"> </td>
          <td><span class="navfh1">手机电话归属地查询</span></td>
        </tr>
      </table>
      <hr size="1" style="color:#E3E8E9" />
      <table width="100%"  border="0" cellpadding="3" cellspacing="1">
              <tr>
          <td>
          
     <%
   Dim Conn,Rs,Sql,ConnData
   Dim ACCDB

   Sub DBConnBegin()
	 ACCDB = "Tel.mdb"
     On Error Resume Next
	 If IsObject(Conn) = False Then
       Set Conn = Server.CreateObject("ADODB.Connection")
       ConnData="Provider=Microsoft.Jet.OLEDB.4.0;Data Source="&Server.MapPath(ACCDB)
       Conn.Open ConnData
       If Err.Number <> 0 Then
          Err.Clear
          Set Conn = Nothing
          Response.Write "数据库连接出错"
          Response.End
       End If
     End If
   End Sub
   
   Sub DBConnEnd()
     If IsObject(Conn) = True Then Conn.Close
     Set Conn = Nothing
   End Sub

   Dim Tel,ZoneLetter
   Tel = Request("Tel")

   Response.write "<script Language=Javascript>" & vbCrLf
   Response.write "  var Isphone=/(^(0\d{2,3})?(-|\s)?(\d{7,8})(-(\d{2,4}))?$)|(^(\+86)?(\s+)?((13)|(15))(\d{9})$)/;" & vbCrLf
   Response.write "  var tel = """&Tel&""";" & vbCrLf
   Response.write "  if (tel==""""){ " & vbCrLf
   'Response.write "    document.write(""·请输入联系电话"");" & vbCrLf
   Response.write "    window.opener=null;" & vbCrLf
   Response.write "    //window.close();" & vbCrLf
   Response.write "    }else{" & vbCrLf
   Response.write "if (!Isphone.test(tel)) { " & vbCrLf
   'Response.write "    document.write(""·联系电话不正确"");" & vbCrLf
   Response.write "    window.opener=null;" & vbCrLf
   Response.write "    //window.close();" & vbCrLf
   Response.write "    }}" & vbCrLf
   Response.write "</script>" & vbCrLf


   Response.write "<table width='100%' align=center class=table>" & vbCrLf
   Response.write "<tr>" & vbCrLf
   Response.write "<td bgcolor=""#95e2ff"" colspan=2>" & vbCrLf
   Response.write "<p align=""center"">手机电话归属地查询" & vbCrLf
   Response.write "</td>" & vbCrLf
   Response.write "</tr>" & vbCrLf
   Response.write "<tr><td valign=top>" & vbCrLf
   Response.write "<table style='font-size:14px'>" & vbCrLf
   Response.write "<form name=form1 method=get action='Index.asp'>" & vbCrLf
   Response.write "<tr><td>电话号码：<input type=text name='Tel' value='"&Tel&"'> <input type=submit name=Submit value='查询' class=button1></td></tr>" & vbCrLf
   Response.write "</form>" & vbCrLf
   Response.write "</td></tr></table>" & vbCrLf
   Response.write "</td></tr><tr><td valign=top>" & vbCrLf
   Response.write "<table style='font-size:14px'>" & vbCrLf
   Response.write "<tr><td width=70>查询电话：</td><td width=200><strong>"&Tel&"</strong></td></tr>" & vbCrLf
   Response.write "<tr><td>电话属性：</td><td><strong>"&GetType(Tel)&"</strong></td></tr>" & vbCrLf
   Call DBConnBegin()
   Response.write "<tr><td valign=top>查询结果：</td><td><font color=red><strong>"&GetTel(GetType(Tel),Tel)&"</strong></font></td></tr>" & vbCrLf
   Call DBConnEnd()
     Response.write "<tr>" & vbCrLf
  Response.write "<td colspan=2>" & vbCrLf
            Response.write "<script type=""text/javascript"" src=""../js/wz.js""></script>" & vbCrLf
         Response.write "<script type=""text/javascript"" src=""../js/Copy.js""></script>" & vbCrLf
  Response.write "</td>" & vbCrLf
 Response.write " </tr>" & vbCrLf
   

   Response.write "</table>" & vbCrLf
   Response.write "</td></tr></table>" & vbCrLf

   
   Function GetType(Str)
	 If Str <> "" Then
	   If Left(Str,1) = "0" Then Str = Right(Str,Len(Str)-1)
	   If Left(Str,2) = "13" Or Left(Str,2) = "15" Then
	     GetType = "手机"
	   Else
	     GetType = "座机/小灵通"
	   End If
	 End If
   End Function
   
   Function GetTel(Str,Num)
	 If Str <> "" And Num <> "" Then
	   Select Case Str
	     Case "手机"
	       Num = Int(Left(Num,7))
	       Set Rs = Conn.ExeCute("Select [City],[Type] From [Mobile] Where [Num] = '"&Num&"'")
	       If Not Rs.Eof Then
	         GetTel = Rs(0)&"<br>"&Rs(1)
	       Else
	         GetTel = "数据不存在"
	       End If
	       Rs.Close
	       Set Rs = Nothing
		   
		 Case "座机/小灵通"
		   ZoneLetter = ""
		   If Left(Num,1) = "0" Then Num = Right(Num,Len(Num)-1)
		   If Len(Num) <= 8 Then
		     GetTel = "电话号码没带区号"
		   Else
		     If Instr(Num,"-") > 0 Then
			   ZoneLetter = Split(Num,"-")(0)
			 Else
			   Select Case Left(Num,2)
			     Case "10","20","21","22","23","24","25","26","27","28","29"
				   ZoneLetter = Left(Num,2)
			   End Select
			   Select Case Left(Num,3)
				 Case "984","983","982","949","948","947","946","944","942","941","940","924","922","908","900","868","867","866","865","864","863","862","861","849","848","846","845","844","843","842","841","840","829","828","827","826","824","823","822","821","808","807","806","805","804","801","488","483","426","386","323"
				   ZoneLetter = Left(Num,4)
			   End Select
			 End If
			 If ZoneLetter = "" Then ZoneLetter = Left(Num,3)
			 If IsNumeric(ZoneLetter) = False Then
			   GetTel = "数据不存在"
			 Else
               Set Rs = Conn.ExeCute("Select [Province],[City] From ZoneLetter Where ZoneLetter = "&Int(ZoneLetter)&"")
               If Not Rs.Eof Then
			     Do While Not Rs.Eof
				   If GetTel = "" Then
				     GetTel = Rs(0)&Rs(1)
				   Else
                     GetTel = GetTel &"　"& Rs(0)&Rs(1)
				   End If
				 Rs.MoveNext
				 Loop
               Else
                 GetTel = "数据不存在"
               End If
			   Rs.Close
			   Set Rs = Nothing
			 End If
		   End If
		 
	   End Select
	 End If
   End Function
%>


          
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
 
   
   
  
