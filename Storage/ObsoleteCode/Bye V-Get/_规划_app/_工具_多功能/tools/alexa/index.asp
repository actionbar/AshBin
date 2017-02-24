<%
'******************************
'程序：Alexa排名查询系统V2008[阿里西西alixixi.com原创]最新版,解决ALEXA官方数据混淆代码问题!
'说明：index.asp,取得官方XML站点信息
'	   ajaxloading.asp,XMLHTTP采集官方页面信息,去除混淆代码,格式化排名结果以JS方式返回index.asp
'作者：阿里西西
'QQ群：17701495
'日期：2007/11/10
'主页：www.alixixi.com
'演示：http://alexa.alixixi.com
'声明：作者保留对本程序的所有版权，注释信息不会影响程序执行效率,尊重原创力量,修改时请保留此信息.
'******************************
Dim domain,Url,Url1,strPage,StrPage1
Dim xmldom,SD,SITE,dimg
domain = request.QueryString("url")
if domain = "" then domain = "baidu.com"
If Not iswww(domain) Then
response.write "<script>alert('您输入的网址无效，请重新输入！')</script>"
domain = "baidu.com"
End if
host = "tools.kqiqi.com/alexa"
if left(domain,7)="http://" then
	domain=right(domain,len(domain)-7)
end if
if instr(domain,"/")<>0 then
	domain=left(domain,instr(domain,"/")-1)
end if
on error resume Next
Function iswww(strng)
    iswww = false
    Dim regEx, Match
    Set regEx = New RegExp
    regEx.Pattern = "^\w+((-\w+)|(\.\w+))*[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$" 
    regEx.IgnoreCase = True
    Set Match = regEx.Execute(strng)
    if match.count then iswww= true
End Function

Function GetPage(Path)
        t = GetBody(Path)
        GetPage=BytesToBstr(t,"UTF-8")
End function

Function GetPage2(Path)
        t = GetBody(Path)
        GetPage2=BytesToBstr(t,"GB2312")
End function

Function GetBody(url) 
        on error resume next
        Set Retrieval = CreateObject("Microsoft.XMLHTTP") 
        With Retrieval 
        .Open "Get", url, False, "", "" 
        .Send 
        GetBody = .ResponseBody
        End With 
        Set Retrieval = Nothing 
End Function

function fget(str)
select case trim(str)
	case ""
	fget = "--"
	case else
	fget = str
end select
end function
Function BytesToBstr(body,Cset)
        dim objstream
        set objstream = Server.CreateObject("adodb.stream")
        objstream.Type = 1
        objstream.Mode =3
        objstream.Open
        objstream.Write body
        objstream.Position = 0
        objstream.Type = 2
        objstream.Charset = Cset
        BytesToBstr = objstream.ReadText 
        objstream.Close
        set objstream = nothing
End Function

Function FixStr(ByVal str, ByVal start, ByVal last, ByVal n)
Dim strTemp
On Error Resume Next
If InStr(str, start) > 0 Then
Select Case n
Case 0
strTemp = Right(str, Len(str) - InStr(str, start) - Len(start) + 1)
strTemp = Left(strTemp, InStr(strTemp, last) - 1)
Case Else
strTemp = Right(str, Len(str) - InStr(str, start) + 1)
strTemp = Left(strTemp, InStr(strTemp, last) + Len(last) - 1)
End Select
Else
strTemp = ""
End If
FixStr = strTemp
End Function
Function Comma(str) 
If Not(IsNumeric(str)) Or str = 0 Then 
Result = 0 
ElseIf Len(Fix(str)) < 4 Then 
Result = str 
Else 
Pos = Instr(1,str,".") 
If Pos > 0 Then 
Dec = Mid(str,Pos) 
End if 
Res = StrReverse(Fix(str)) 
LoopCount = 1 
While LoopCount <= Len(Res) 



TempResult = TempResult + Mid(Res,LoopCount,3) 
LoopCount = LoopCount + 3 
If LoopCount <= Len(Res) Then 
TempResult = TempResult + "," 
End If 
Wend 
Result = StrReverse(TempResult) + Dec 
End If 
Comma = Result 
End Function 

Function lens(txt, length)
        Dim x, y, ii
        txt = Trim(txt)
        x = Len(txt)
        y = 0
        If x >= 1 Then
            For ii = 1 To x
                If Asc(Mid(txt, ii, 1)) < 0 Or Asc(Mid(txt, ii, 1)) > 255 Then
                    y = y + 2
                Else
                    y = y + 1
                End If
                If y >= length Then
                    txt = Left(Trim(txt), ii-3) & "..."
                    Exit For
                End If
            Next
            lens = txt
        Else
            lens = ""
        End If
End Function


Url = "http://data.alexa.com/data/?cli=10&dat=snba&ver=7.0&url="&Domain
strPage = GetPage(Url)
set xmldom=server.createobject("MSXML2.DOMDocument")   
xmldom.loadXML(strPage)
Set SD = xmldom.documentElement.selectSingleNode("SD")
Set SITE = xmldom.documentElement.selectSingleNode("DMOZ")
Dim ADDR
Dim CREATED
Dim PHONE
Dim OWNER
Dim EMAIL
Dim LANG
Dim LINKSIN
Dim SPEED
Dim POPULARITY
Dim RANK
Dim CHILD
Dim REACH
Set ADDR = SD.selectSingleNode("ADDR")
Set CREATED = SD.selectSingleNode("CREATED")
Set PHONE = SD.selectSingleNode("PHONE")
Set OWNER = SD.selectSingleNode("OWNER")
Set EMAIL = SD.selectSingleNode("EMAIL")
Set LANG = SD.selectSingleNode("LANG")
Set LINKSIN = SD.selectSingleNode("LINKSIN")
Set SPEED = SD.selectSingleNode("SPEED")
Set POPULARITY = SD.selectSingleNode("POPULARITY")
Set RANK = SD.selectSingleNode("RANK")
Set CHILD = SD.selectSingleNode("CHILD")
Set REACH = SD.selectSingleNode("REACH")

Dim SITEINFO
Dim CATS
Dim SiteTitle
Dim	SiteDesc
Dim Cat
Set SITEINFO = SITE.selectSingleNode("SITE")
Set CATS = SITEINFO.selectSingleNode("CATS").selectSingleNode("CAT")
SiteTitle = SITEINFO.attributes(1).value
SiteDesc = SITEINFO.attributes(2).value
Cat = CATS.attributes(1).value

Dim COUNTRY
Dim ZIP
Dim STATE
Dim CITY
Dim STREET
STREET = ADDR.attributes(0).value
CITY = ADDR.attributes(1).value
ZIP = ADDR.attributes(2).value
STATE = ADDR.attributes(3).value
COUNTRY = ADDR.attributes(4).value

Dim	xDate
Dim	xPhone
Dim	xOwner
Dim	xEmail
Dim	xLex
Dim	xCode
Dim	xLinksin
Dim	xSpeed
Dim	xPct
Dim	xPopularity
Dim	xRank
Dim	xChild
Dim	xReach		
xDate = CREATED.attributes(0).value
xPhone = PHONE.attributes(0).value
xOwner = OWNER.attributes(0).value
xEmail	 = EMAIL.attributes(0).value
xLex	 = LANG.attributes(0).value
xCode = LANG.attributes(1).value
xLinksin = LINKSIN.attributes(0).value
xSpeed	 = SPEED.attributes(0).value
xPct	 = SPEED.attributes(1).value
xPopularity = POPULARITY.attributes(1).value
xPopularity = Comma(xPopularity)
xRank = RANK.attributes(0).value
if instr(xRank,"-")>0 then
dimg = "<img src=""skin/up_arrow.gif"" align=absmiddle width=18 height=16 />"
else
dimg = "<img src=""skin/down_arrow.gif"" align=absmiddle width=18 height=16 />"
end if
xRank = replace(xRank,"+","")
xRank = replace(xRank,"-","")
xRank = Comma(xRank)

xChild = CHILD.attributes(0).value
xReach = REACH.attributes(0).value		

Public Function RemoveHtml(byval strContent)
	Dim objReg ,strTmp
	If strContent="" OR ISNull(strContent) Then Exit Function
		
	Set objReg=new RegExp
	objReg.IgnoreCase =True
	objReg.Global=True
	objReg.Pattern="<(.[^>]*)>"
	strTmp=objReg.Replace(strContent, "")
	Set objReg=Nothing
	RemoveHtml=strTmp
	strTmp=""
End Function

Dim SitePic
Dim pm6,pm3,pm1,pday15,pday7
Dim tmp1
Dim t_arr
Dim t_day,t_wk1,t_m3,t_m3_change

pm6 = "http://traffic.alexa.com/graph?w=700&h=280&r=6m&y=t&u="&Domain
pm3 = "http://traffic.alexa.com/graph?w=700&h=280&r=3m&y=t&u="&Domain
pm1 = "http://traffic.alexa.com/graph?w=700&h=280&r=1m&y=t&u="&Domain
pday15 = "http://traffic.alexa.com/graph?w=700&h=280&r=15.0m&y=t&u="&Domain
pday7 = "http://traffic.alexa.com/graph?w=700&h=280&r=7.0m&y=t&u="&Domain

set tnames = request.cookies("dnames")
if isnull(tnames) or len(trim(tnames))=0 then
	tnames = domain&"|"
else
	if instr(tnames,domain)>0 then
		names = replace(tnames,domain&"|","")
	else
		tnames = domain&"|"&tnames
	end if
end If

ttnames = split(tnames,"|")
tmpncontent = ""

if ubound(ttnames)>5 then
	for tat=0 to 4
		tmpncontent = tmpncontent&ttnames(tat)&"|"
	next
else
	tmpncontent=tnames
end If

response.cookies("dnames") = trim(tmpncontent)
response.cookies("dnames").expires = now()+1

%>

<html>
<head>
<title>客齐齐alexa查询系统,alexa排名查询,alexa traffic rank,<%=SiteTitle%>，<%=domain%>的Alexa排名查询</title>
<META http-equiv="Content-Type" content="text/html; charset=gb2312">
<META http-equiv="Content-Language" content="gb2312">
<meta http-equiv="Keywords" content="客齐齐Alexa排名查询,Alexa作弊,Alexa排名,Alexa查询,Alexa信息,排名,流量,访问量,页面浏览量,搜索引擎,<%=SiteTitle%>的Alexa排名信息,<%=domain%>">
<meta name="description" content="客齐齐alexa查询,alexa排名,alexa排名查询,alexa世界排名查询,alexa 网站排名查询,alexa网站排名,全球alexa排名查询,alexa排名查询,网站alexa排名查询,alexa工具条,alexa中文排名查询,alexa traffic rank,alexa查询,alexa排名" />
<link href="skin/style.css" rel="stylesheet" type="text/css" />
<link href="../images/style.css" rel="stylesheet" type="text/css" />
<script language=JavaScript src="js/scroll.js"></script>
<style type="text/css">
<!--
body {margin:0; padding:0;background: #FFF url('../images/top3.gif') repeat-x top; font-size:12px;color:#666}
.style1 {font-size: 14px}
-->
</style>
</head>
<body>
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
          <td width="88" background="../images/nav2.gif" style="padding-top:5px"><a href="index.html" class="navfh1">站长工具</a></td>
          <td width="88" background="../images/nav1.gif" style="padding-top:5px"><a href="../query/index.html" class="navfh2">查询工具</a></td>
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

<DIV id=lovexin1 class="body" style='Z-INDEX: 10; LEFT: 6px; POSITION: absolute; TOP: 117px; width: 108;'><div style="background:#E8F5FE;height:18px;font-size:12px;font-weight:bold;" onClick='javascript:window.hide()'>最近查询记录</div>
<div><ul>	<%
		Set fso = CreateObject("Scripting.FileSystemObject")
	  Set f = fso.OpenTextFile( server.MapPath("cache.asp"), 1, True)
	  if f.AtEndOfStream=false then
	  	content = f.readline()
	  end if
	  f.close
	  if fso.fileexists(server.MapPath("cache.asp"))=true then
	  	fso.deletefile(server.MapPath("cache.asp"))
	  end if
	  Set f = fso.OpenTextFile( server.MapPath("cache.asp"), 8, True)
	  if isnull(content) or len(trim(content))=0 then
	  	content = domain&"|"
	  else
	  	if instr(content,domain)>0 then
	  		set content = replace(content,domain&"|","")
	  	else
	  		content = domain&"|"&content
	  	end if
	  end if
	  names = split(content,"|")
	  tmpcontent = ""
	  for tt=0 to ubound(names)-1
	  if tt<15 then
	  	tmpcontent = tmpcontent&names(tt)&"|"
	  end if
	  %>
	  <li><a href="Index.asp?url=<%=names(tt)%>" title="www.<%=names(tt)%>"><%=names(tt)%></a></li>
	  <%
		next
		f.write(trim(tmpcontent))
		f.close
		set f = nothing
	%>	
</ul></DIV>
</DIV>
<DIV id=lovexin2 class="body" style='Z-INDEX: 10; right: 2px; POSITION: absolute; TOP: 117px; width: 108;;overflow:hidden'><div style="background:#E8F5FE;height:18px;font-size:12px;font-weight:bold;" onClick='javascript:window.hide()'>您关注的站点</div>
<div>
<ul>
<%
		for ttt=0 to ubound(ttnames)-1
		%>
		<li><a href="index.asp?url=<%=ttnames(ttt)%>" title="www.<%=ttnames(ttt)%>"><%=ttnames(ttt)%></a></li>
		<%
		next
%>

</ul>
</div>
</DIV>

<div class="body" style="padding:5px;margin-top:8px;background-color:#E8F5FE;">
  <form action="" method="get" style="padding:0;margin:0;">
    Alexa排名查询的网址：http://
    <input name="url" type="text" style="width:300px" value="<%=domain%>">
    <input type="submit" value="查 询"> &nbsp;<a href="http://www.kqiqi.com/" style="color:red;" target="_blank">分类信息程序</a>
  </form>
</div>

<div class="th">网站 <%=domain%> 的Alexa排名综合信息</div>
<div class="body" style="padding-top:10px;height:190px;">
  <div style="float:left;width:230;text-align:center;">
    <!--site img-->
   <a href="http://www.kqiqi.com" target="_blank"><img src="skin/nopic.gif" border="0"></a>
	<div style="margin-top:8px;">
    <a href="http://thumbnails.alexa.com/update.php?url=<%=domain%>" target="_blank">更新缩略图</a> | <a href="http://www.alexa.com/data/details/contact_info?url=<%=domain%>" target="_blank">修改信息</a> | <a href="http://www.alexa.com/data/details/editor?type=rl&url=<%=domain%>" target="_blank">提交链接</a></div>
    <!--site img-->
  </div>
  <div style="float:right;width:520;text-align:left;">
    <div id="siteinfo">
      <table width="100%" cellpadding="1" cellspacing="1">
        <TR>
          <TD width="85" align="right" noWrap bgColor="#f3f8fc">站点名称:</TD>
          <TD width="178" title="<%=SiteTitle%>"><a href="http://<%=domain%>" target=_blank><%=SiteTitle%></a></TD>
          <TD width="79" align="right" nowrap bgColor="#f3f8fc">网站域名:</TD>
          <TD width="163" title="<%=domain%>"><strong><%=domain%></strong></TD>
        </TR>
        <TR>
          <TD align="right" nowrap bgColor="#f3f8fc" title="alexa综合排名">综合排名:</TD>
          <TD title="<%=xPopularity%>"><A title="查看Alexa官方信息" href="http://www.alexa.com/data/details/traffic_details?q=&url=<%=domain%>" target="_blank"><%=fget(xPopularity)%></A></TD>
          <TD align="right" nowrap bgColor="#f3f8fc" title="三个月的排名变化趋势">排名变化:</TD>
          <TD id="NextRank" title="三个月的排名变化趋势"><%=dimg&fget(xRank)%></TD>
        </TR>
        <TR>
          <TD align="right" nowrap bgColor="#f3f8fc">所属国家:</TD>
          <TD title="<%=COUNTRY%>"><%=fget(COUNTRY)%></TD>
          <TD align="right" nowrap bgColor="#f3f8fc">编码方式:</TD>
          <TD title="<%=xCode%>"><%=fget(xCode)%></TD>
        </TR>
        <TR>
          <TD align="right" nowrap bgColor="#f3f8fc">网站站长:</TD>
          <TD title="<%=xOwner%>"><%=fget(xOwner)%></TD>
          <TD align="right" nowrap bgColor="#f3f8fc">电子信箱:</TD>
          <TD title="<%=xEmail%>"><%=fget(xEmail)%></TD>
        </TR>
        <TR>
          <TD align="right" nowrap bgColor="#f3f8fc">访问速度:</TD>
          <TD nowrap title="<%=xSpeed%>Ms/<%=xPct%>分"><%=fget(xSpeed)%>Ms/<%=fget(xPct)%>分</TD>
          <TD align="right" nowrap bgColor="#f3f8fc">反向链接:</TD>
          <TD nowrap title="<%=xLinksin%>"><A href="http://www.alexa.com/data/ds/linksin?q=link:<%=domain%>/&url=<%=domain%>" target="_blank"><%=fget(xLinksin)%></A> 个</TD>
        </TR>
        <TR>
          <TD align="right" nowrap bgColor="#f3f8fc">收录日期:</TD>
          <TD nowrap title="<%=xDate%>"><%=fget(xDate)%></TD>
          <TD align="right" nowrap bgColor="#f3f8fc">联系电话:</TD>
          <TD title="<%=xPhone%>" noWrap><%=fget(xPhone)%></TD>
        </TR>
        <TR>
          <TD align="right" nowrap bgColor="#f3f8fc">详细地址:</TD>
          <TD title="<%=STREET%> <%=CITY%>" colSpan="3"><%=fget(lens(STREET&CITY,65))%></TD>
        </TR>
        <TR>
          <TD align="right" nowrap bgColor="#f3f8fc">网站简介:</TD>
          <TD title="<%=SiteDesc%>" colSpan="3"><%=fget(lens(SiteDesc,69))%></TD>
        </TR>
        <TR>
          <TD align="right" nowrap bgColor="#f3f8fc">所属目录:</TD>
          <TD title="<%=Cat%>" colSpan="3"><%=fget(Cat)%></TD>
        </TR>
      </table><font color=red>官方网址:<a href="http://www.kqiqi.com/" target="_blank">http://www.kqiqi.com/</a></font></a>
    </div>
  </div>
</div>
<div class="th">站点 <%=SiteTitle%> 的 Alexa 排名查询结果</div>
<div class="body1">
  <div class="x bg2">流量排名数据信息：Traffic Rank for <%=domain%></div>
  <div class="mainbar">
    <div class="title" style="width:150px">昨日排名</div>
    <div class="title" style="width:152px">一周平均</div>
    <div class="title" style="width:152px">三月平均</div>
    <div class="title" style="width:152px">三月变化趋势</div>
    <div class="title2" style="width:152px">综合排名变化</div>
  </div>
  <div class="mainbar2">
    <div id="RankToday" class="title" style="width:150px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="RankwkAvg" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="RankmosAvg" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="AllRank" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="RankmosChange" class="title2" style="width:150px"><%=dimg&fget(xRank)%></div>
  </div>


  <div class="x bg2">每百万人中访问数：Reach for <%=domain%></div>
  <div class="mainbar">
    <div class="title" style="width:150px">昨日数据</div>
    <div class="title" style="width:152px">一周平均</div>
    <div class="title" style="width:152px">三月平均</div>
    <div class="title" style="width:152px">三月变化趋势</div>
    <div class="title2" style="width:152px">综合排名变化</div>
  </div>
  <div class="mainbar2">
    <div id="ReachToday" class="title" style="width:150px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="ReachwkAvg" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="ReachmosAvg" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="ReachmosChange" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="ReachAllChange" class="title2" style="width:150px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
  </div>

  <div class="x bg2">每访问者浏览页数：Page Views per user for <%=domain%></div>
  <div class="mainbar">
    <div class="title" style="width:150px">昨日数据</div>
    <div class="title" style="width:152px">一周平均</div>
    <div class="title" style="width:152px">三月平均</div>
    <div class="title" style="width:152px">三月变化趋势</div>
    <div class="title2" style="width:152px">综合排名变化</div>
  </div>
  <div class="mainbar2">
    <div id="ViewsToday" class="title" style="width:150px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="ViewswkAvg" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="ViewsmosAvg" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="ViewsmosChange" class="title" style="width:152px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
    <div id="ViewsAllChange" class="title2" style="width:150px"><img src="skin/loading.gif" width="16" height="16" border="0"></div>
  </div>

</div>

<div class="th"> <%=SiteTitle%> 其它相关Alexa排名的信息统计</div>
<div class="body1">
  <div class="x bg2"> <%=SiteTitle%> 下属站点被访问比例</div>
  <div class="mainbar">
    <div class="title" style="width:374px">子域名</div>
    <div class="title2" style="width:374px">访问比例</div>
  </div>
  <span id="more"><img src="skin/loading.gif" width="16" height="16" border="0"></span>
</div>

<div class="th">网站日平均排名走势图 [点击时间段查看相应时段曲线]</div>
<div class="mainbar">
  <div class="title" style="width:150px"><a style="CURSOR: hand" onClick="document.all.rank1.style.display='';document.all.rank2.style.display='none';document.all.rank3.style.display='none';document.all.rank4.style.display='none';document.all.rank5.style.display='none';">六个月数据</a></div>
  <div class="title" style="width:152px"><a style="CURSOR: hand" onClick="document.all.rank1.style.display='none';document.all.rank2.style.display='';document.all.rank3.style.display='none';document.all.rank4.style.display='none';document.all.rank5.style.display='none';">三个月数据</a></div>
  <div class="title" style="width:152px"><a style="CURSOR: hand" onClick="document.all.rank1.style.display='none';document.all.rank2.style.display='none';document.all.rank3.style.display='';document.all.rank4.style.display='none';document.all.rank5.style.display='none';">一个月数据</a></div>
  <div class="title" style="width:152px"><a style="CURSOR: hand" onClick="document.all.rank1.style.display='none';document.all.rank2.style.display='none';document.all.rank3.style.display='none';document.all.rank4.style.display='';document.all.rank5.style.display='none';">半个月数据</a></div>
  <div class="title2" style="width:150px"><a style="CURSOR: hand" onClick="document.all.rank1.style.display='none';document.all.rank2.style.display='none';document.all.rank3.style.display='none';document.all.rank4.style.display='none';document.all.rank5.style.display='';">一星期数据</a></div>
</div>
<div class="mainbar2" style="padding:10 0 10 0;height:300px">
  <div id=rank1><img src="http://traffic.alexa.com/graph?w=750&h=280&r=6m&y=t&u=<%=domain%>"></div>
  <div id=rank2 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=3m&y=t&u=<%=domain%>"></div>
  <div id=rank3 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=1m&y=t&u=<%=domain%>"></div>
  <div id=rank4 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=15.0m&y=t&u=<%=domain%>"></div>
  <div id=rank5 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=7.0&y=t&u=<%=domain%>"></div>
</div>
<div class="th">日平均访问人数走势图 [点击时间段查看相应时段曲线]</div>
<div class="mainbar">
  <div class="title" style="width:150px"><a style="cursor: hand" onClick="document.all.reachs1.style.display='';document.all.reachs2.style.display='none';document.all.reachs3.style.display='none';document.all.reachs4.style.display='none';document.all.reachs5.style.display='none';">六个月数据</a></div>
  <div class="title" style="width:152px"><a style="cursor: hand" onClick="document.all.reachs1.style.display='none';document.all.reachs2.style.display='';document.all.reachs3.style.display='none';document.all.reachs4.style.display='none';document.all.reachs5.style.display='none';">三个月数据</a></div>
  <div class="title" style="width:152px"><a style="cursor: hand" onClick="document.all.reachs1.style.display='none';document.all.reachs2.style.display='none';document.all.reachs3.style.display='';document.all.reachs4.style.display='none';document.all.reachs5.style.display='none';">一个月数据</a></div>
  <div class="title" style="width:152px"><a style="cursor: hand" onClick="document.all.reachs1.style.display='none';document.all.reachs2.style.display='none';document.all.reachs3.style.display='none';document.all.reachs4.style.display='';document.all.reachs5.style.display='none';">半个月数据</a></div>
  <div class="title2" style="width:150px"><a style="cursor: hand" onClick="document.all.reachs1.style.display='none';document.all.reachs2.style.display='none';document.all.reachs3.style.display='none';document.all.reachs4.style.display='none';document.all.reachs5.style.display='';">一星期数据</a></div>
</div>
<div class="mainbar2" style="padding:10 0 10 0;height:300px">
  <div id=reachs1><img src="http://traffic.alexa.com/graph?w=750&h=280&r=6m&y=r&u=<%=domain%>"></div>
  <div id=reachs2 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=3m&y=r&u=<%=domain%>"></div>
  <div id=reachs3 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=1m&y=r&u=<%=domain%>"></div>
  <div id=reachs4 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=15.0m&y=r&u=<%=domain%>"></div>
  <div id=reachs5 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=7.0m&y=r&u=<%=domain%>"></div>
</div>
<div class="th">日页面浏览量走势图 [点击时间段查看相应时段曲线]</div>
<div class="mainbar">
  <div class="title" style="width:150px"><a style="cursor: hand" onClick="document.all.pageviews1.style.display='';document.all.pageviews2.style.display='none';document.all.pageviews3.style.display='none';document.all.pageviews4.style.display='none';document.all.pageviews5.style.display='none';">六个月数据</a></div>
  <div class="title" style="width:152px"><a style="cursor: hand" onClick="document.all.pageviews1.style.display='none';document.all.pageviews2.style.display='';document.all.pageviews3.style.display='none';document.all.pageviews4.style.display='none';document.all.pageviews5.style.display='none';">三个月数据</a></div>
  <div class="title" style="width:152px"><a style="cursor: hand" onClick="document.all.pageviews1.style.display='none';document.all.pageviews2.style.display='none';document.all.pageviews3.style.display='';document.all.pageviews4.style.display='none';document.all.pageviews5.style.display='none';">一个月数据</a></div>
  <div class="title" style="width:152px"><a style="cursor: hand" onClick="document.all.pageviews1.style.display='none';document.all.pageviews2.style.display='none';document.all.pageviews3.style.display='none';document.all.pageviews4.style.display='';document.all.pageviews5.style.display='none';">半个月数据</a></div>
  <div class="title2" style="width:150px"><a style="cursor: hand" onClick="document.all.pageviews1.style.display='none';document.all.pageviews2.style.display='none';document.all.pageviews3.style.display='none';document.all.pageviews4.style.display='none';document.all.pageviews5.style.display='';">一星期数据</a></div>
</div>
<div class="mainbar2" style="padding:10 0 10 0;height:300px">
  <div id=pageviews1><img src="http://traffic.alexa.com/graph?w=750&h=280&r=6m&y=p&u=<%=domain%>"></div>
  <div id=pageviews2 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=3m&y=p&u=<%=domain%>"></div>
  <div id=pageviews3 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=1m&y=p&u=<%=domain%>"></div>
  <div id=pageviews4 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=15.0m&y=p&u=<%=domain%>"></div>
  <div id=pageviews5 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=7.0m&y=p&u=<%=domain%>"></div>
</div>
<div style="margin-top:12px">
  <!--copyright-->
  <%timer2 = timer
thetime=cstr(int(((timer2-timer1)*10000 )+0.5)/10)
response.write "本页执行共用了"&thetime&"毫秒"
%>
  <br>
  Copyright&copy;2008 <a href="http://tools.kqiqi.com" target="_blank">tools.kqiqi.com</a> All Rights Reserved 版权所有·客齐齐alexa查询 <script language="javascript" src="../js/bottom.js"></script>
  <!--copyright-->
</div>
<script language="javascript" type="text/javascript" src="ajaxloading.asp?url=<%=domain%>&dayrank=<%=xRank%>"></script>
</body>
</html>
