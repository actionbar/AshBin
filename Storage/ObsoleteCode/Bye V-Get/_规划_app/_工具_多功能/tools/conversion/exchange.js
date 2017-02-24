function trans()
{
var intInputValue,intOutputValue,tempValue;
intInputValue=document.transform.source_num.value;
tempValue=intInputValue/document.transform.target.options[document.transform.target.selectedIndex].value;
intOutputValue=tempValue*document.transform.source.options[document.transform.source.selectedIndex].value;
intOutputValue=Math.round(intOutputValue*100)/100;
document.transform.target_num.value=intOutputValue;
if(document.transform.target_num.value=="NaN"){
	document.transform.source_num.value=0;
}
setTimeout("trans()",100);
}
function date()
{
	var a = new Date();
	var y,m,d;
	y = a.getFullYear();
	m = a.getMonth();
	d = a.getDate();
	document.write(y);
	document.write('-');
	document.write(m+1);
	document.write('-');
	document.write(d);
}

document.write('<form method=post action=javascript:trans() name=transform>当前日期：');
date();
document.write('<br /><br /><select name=source>');
document.write('<option value=100 selected>人民币</option><option value=1564.01>英镑</option><option value=1111.73>欧元</option><option value=826.41>美元</option><option value=730.05>瑞士法郎</option><option value=694.26>加拿大元</option><option value=624.14>澳大利亚元</option><option value=596.83>新西兰元</option><option value=505.68>新加坡元</option><option value=149.64>丹麦克朗</option><option value=136.2>挪威克朗</option><option value=121.58>瑞典克朗</option><option value=106.35>港币</option><option value=103.22>澳门元</option><option value=21.14>泰国铢</option><option value=14.75>菲律宾比索</option><option value=8.0999>日元</option>');
document.write('</select><input type=text name=source_num size=16 value=100 /><br /><br />兑换为：<br /><br /><select name=target>');
document.write('<option value=100 selected>人民币</option><option value=1564.01>英镑</option><option value=1111.73>欧元</option><option value=826.41>美元</option><option value=730.05>瑞士法郎</option><option value=694.26>加拿大元</option><option value=624.14>澳大利亚元</option><option value=596.83>新西兰元</option><option value=505.68>新加坡元</option><option value=149.64>丹麦克朗</option><option value=136.2>挪威克朗</option><option value=121.58>瑞典克朗</option><option value=106.35>港币</option><option value=103.22>澳门元</option><option value=21.14>泰国铢</option><option value=14.75>菲律宾比索</option><option value=8.0999>日元</option>');
document.write('</select><input type=text name=target_num size=16 readonly value=0>');
document.write('</form>');
document.write('<span class=cs ><font color=red>本站提供的汇率兑换仅供参考，实际汇率请按当日公布为准</font></span><br>');
trans();
