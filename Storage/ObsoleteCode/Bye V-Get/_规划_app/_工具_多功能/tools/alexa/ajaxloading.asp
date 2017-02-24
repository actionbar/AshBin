<%
on error resume next
'if not ChkPost() then
'Response.Write "document.getElementById(""RankToday"").innerHTML = '<a href=""http://www.alixixi.com"">www.alixixi.com</a>';"
'Response.Write "document.getElementById(""RankwkAvg"").innerHTML = '<a href=""http://www.alixixi.com"">www.alixixi.com</a>';"
'Response.Write "document.getElementById(""RankmosAvg"").innerHTML = '<a href=""http://www.alixixi.com"">www.alixixi.com</a>';"
'Response.Write "document.getElementById(""AllRank"").innerHTML = '<a href=""http://www.alixixi.com"">www.alixixi.com</a>';"
'Response.Write "document.getElementById(""RankmosChange"").innerHTML = '<a href=""http://www.alixixi.com"">www.alixixi.com</a>';"
'response.end
'end if
Dim domain,dayrank,dimg,Url,Url1,strPage,StrPage1
Dim xmldom,SD,SITE
dim fcss,arrcss,aa,fimg1,fimg2,fimg3,arrRank
Dim AlexaCom,st1,st2
Dim viewsmos

domain = request.QueryString("url")
dayrank = request.QueryString("dayrank")
if instr(dayrank,"-")>0 then
dimg = "<img src=""skin/up_arrow.gif"" align=absmiddle width=18 height=16 />"
else
dimg = "<img src=""skin/down_arrow.gif"" align=absmiddle width=18 height=16 />"
end if
dayrank = replace(dayrank,"+","")
dayrank = replace(dayrank,"-","")
if domain = "" then domain = "baidu.com"
domain = lcase(replace(domain,"www.",""))
'获取CSS文件样式
fcss = GetPage("http://client.alexa.com/common/css/scramble.css")
fcss = replace(replace(fcss,chr(10),"")," {display: none}","")
arrcss = split(fcss,".")

'获取排名页面信息
AlexaCom = GetPage("http://www.alexa.com/data/details/traffic_details?url="&domain&"")
AlexaCom = FixStr(AlexaCom,"Percent of global Internet users who visit this site","<div id=""where_all"" class=""textoff"">",0)

'循环过滤CSS干扰代码和注释信息
AlexaCom = replace(AlexaCom,"<!--Did you know? Alexa offers this data programmatically.  Visit http://aws.amazon.com/awis for more information about the Alexa Web Information Service.-->","")
AlexaCom = replace(AlexaCom,"<tr><th>Yesterday</th><th>1 wk. Avg.</th><th>3 mos. Avg.</th><th>3 mos. Change</th></tr>","")
AlexaCom = replace(AlexaCom,"</td><td>","|")

for aa = 0 to ubound(arrcss)
	AlexaCom = replace(AlexaCom,FixStr(AlexaCom,"<span class="""&trim(arrcss(aa))&""">","</span>",1),"")
	Response.Flush
next
Response.Flush
for aa = 0 to ubound(arrcss)
	AlexaCom = replace(AlexaCom,FixStr(AlexaCom,"<span class="""&trim(arrcss(aa))&""">","</span>",1),"")
	Response.Flush
next
Response.Flush
for aa = 0 to ubound(arrcss)
	AlexaCom = replace(AlexaCom,FixStr(AlexaCom,"<span class="""&trim(arrcss(aa))&""">","</span>",1),"")
	Response.Flush
next
Response.Flush

'提取流量排名信息并生成数组
fimg1 = FixStr(alexacom,"src=""http://client.alexa.com/common/images/",""">",0)
If fimg1 <> "" Then fimg1 = "<img src=skin/"&fimg1&" align=absmiddle width=18 height=16 />"

fimg3 = FixStr(alexacom,"The number of unique pages viewed per user per day for this site","</table>",0)
fimg3 = FixStr(fimg3,"src=""http://client.alexa.com/common/images/",""">",0)
If fimg3 <> "" Then fimg3 = "<img src=skin/"&fimg3&" align=absmiddle width=18 height=16 />"

fimg2 = FixStr(alexacom,"Alexa traffic rank based on a combined measure of page views and users","</table>",0)
fimg2 = FixStr(fimg2,"src=""http://client.alexa.com/common/images/",""">",0)
If fimg2 <> "" Then fimg2 = "<img src=skin/"&fimg2&" align=absmiddle width=18 height=16 />"

AlexaCom = replace(replace(RemoveHtml(RemoveSpan(alexacom)),",",""),"&nbsp;","")
AlexaCom = replace(AlexaCom,"	","")
AlexaCom = lcase(replace(AlexaCom,chr(10),""))
arrRank = split(AlexaCom,"|")


viewsmos = split(arrRank(9),"%")(0)
if instr(viewsmos,"*") then
viewsmos = split(viewsmos,"*")(0)
end if
'response.write arrRank(9)
'response.end

Dim d,dlist,DomainMore,spmore
DomainMore = Trim(Split(arrRank(9),""&domain&":")(1))
DomainMore = Trim(replace(DomainMore,"more...",""))
DomainMore = Split(DomainMore,"%")
For d=0 To UBound(DomainMore)-1
spmore = Split(DomainMore(d),"-")

dlist = dlist & "<div class='mainbar2'><div class='title' style='width:374px'>"&Trim(replace(DomainMore(d),"-"&spmore(UBound(spmore)),""))&"</div><div class='title2' style='width:374px'>"&Trim(spmore(UBound(spmore)))&"%</div></div>"
Next
dlist = Replace(dlist,"other websites","其它")


'response.write dlist
'response.End

		
'前台显示每百万人数中访问人数
Response.Write "document.getElementById(""RankToday"").innerHTML = """&FormatRank(split(arrRank(3),"(reach)")(1))&""";"&vbcrlf
Response.Write "document.getElementById(""RankwkAvg"").innerHTML = """&FormatRank(arrRank(4))&""";"&vbcrlf
Response.Write "document.getElementById(""RankmosAvg"").innerHTML = """&FormatRank(arrRank(5))&""";"&vbcrlf
Response.Write "document.getElementById(""AllRank"").innerHTML = """&fimg1&FormatRank(split(arrRank(6),"page")(0))&""";"&vbcrlf

'前台显示每访问者浏览页数
Response.Write "document.getElementById(""ReachToday"").innerHTML = """&FormatRank(arrRank(0))&""";"&vbcrlf
Response.Write "document.getElementById(""ReachwkAvg"").innerHTML = """&FormatRank(arrRank(1))&""";"&vbcrlf
Response.Write "document.getElementById(""ReachmosAvg"").innerHTML = """&FormatRank(arrRank(2))&""";"&vbcrlf
Response.Write "document.getElementById(""ReachmosChange"").innerHTML = """&fimg2&FormatRank2(split(arrRank(3),"traffic")(0))&""";"&vbcrlf
Response.Write "document.getElementById(""ReachAllChange"").innerHTML = ""--"";"

Response.Write "document.getElementById(""ViewsToday"").innerHTML = """&FormatRank(split(arrRank(6),"site")(1))&""";"&vbcrlf
Response.Write "document.getElementById(""ViewswkAvg"").innerHTML = """&FormatRank(arrRank(7))&""";"&vbcrlf
Response.Write "document.getElementById(""ViewsmosAvg"").innerHTML = """&FormatRank(arrRank(8))&""";"&vbcrlf
'Response.Write "document.getElementById(""ViewsmosChange"").innerHTML = """&fimg3&FormatRank2(viewsmos)&"%"";"&vbcrlf
Response.Write "document.getElementById(""ViewsmosChange"").innerHTML = ""--"";"&vbcrlf
Response.Write "document.getElementById(""ViewsAllChange"").innerHTML = ""--"";"&vbcrlf

Response.Write "document.getElementById(""more"").innerHTML = """&dlist&""";"&vbcrlf

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
Case 0  '左右都截取（都取前面）（去处关键字）
strTemp = Right(str, Len(str) - InStr(str, start) - Len(start) + 1)
strTemp = Left(strTemp, InStr(strTemp, last) - 1)
Case Else  '左右都截取（都取前面）（保留关键字）
strTemp = Right(str, Len(str) - InStr(str, start) + 1)
strTemp = Left(strTemp, InStr(strTemp, last) + Len(last) - 1)
End Select
Else
strTemp = ""
End If
FixStr = strTemp
End Function

Public function ChkPost()
	dim server_v1,server_v2
	ChkPost=false
	server_v1=Cstr(Request.ServerVariables("HTTP_REFERER"))
	server_v2=Cstr(Request.ServerVariables("SERVER_NAME"))
	if mid(server_v1,8,len(server_v2))<>server_v2 then
		ChkPost=false
	else
		ChkPost=true
	end if
End Function

Function RemoveSpan(byval strContent)
	Dim objReg ,strTmp
	If strContent="" OR ISNull(strContent) Then Exit Function
		
	Set objReg=new RegExp
	objReg.IgnoreCase =True
	objReg.Global=True
	objReg.Pattern="<span(.[^>]*)>|<\/span>"
	strTmp=objReg.Replace(strContent, "")
	Set objReg=Nothing
	RemoveSpan=strTmp
	strTmp=""
End Function

Function RemoveHtml(byval strContent)
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

Function FormatRank(str)
select case str
	case "n/a*"
	FormatRank = "数据未更新..."
	case ""
	FormatRank = "--"
	case "no change"
	FormatRank = "没有变化"
	case else
	if IsNumeric(str) then
	FormatRank = Comma(str)
	elseif instr(str,"%")>0 then
	str = FormatNumber(trim(str),8)*1000000
	FormatRank = Comma(str)
	else
	FormatRank = trim(str)
	end if
end select
End Function

Function FormatRank2(str)
if instr(str,"no change") then
str = ""
end if
select case str
	case "n/a*"
	FormatRank2 = "数据未更新..."
	case ""
	FormatRank2 = "--"
	case "no change"
	FormatRank2 = "没有变化"
	case else
	if IsNumeric(str) then
	FormatRank2 = Comma(str)
	else
	FormatRank2 = trim(str)
	end if
end select
End Function
%>
