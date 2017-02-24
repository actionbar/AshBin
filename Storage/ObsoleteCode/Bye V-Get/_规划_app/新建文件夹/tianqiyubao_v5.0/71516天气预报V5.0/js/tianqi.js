var tflag = 1;
if(tflag){
var cs_prov = getCookie('cs_prov');
var cs_city = getCookie('cs_city');
var ccity = getCookie('ccity');
loadJS("weather2.php?a=getZoneInfo&type=0&p="+cs_prov+"&c="+cs_city);
loadJS("weather2.php?a=getWeather&ccity="+ccity);
SetCookie('ccity','');
SetCookie('cs_city','');
SetCookie('cs_prov','');
	tflag=0;
}

function getZoneInfo(json){
	var str = '<select style="width:80px;" id="province" onchange="getcity(this.value)">';
	for(var key in json[1].value){
		if(cs_prov == ''){
			if(json[0].value==key)
				str += "<option value='"+key+"' selected>"+json[1].value[key]+"</option>";
			else
				str += "<option value='"+key+"'>"+json[1].value[key]+"</option>";
		}else{
			if(cs_prov==key)
				str += "<option value='"+key+"' selected>"+json[1].value[key]+"</option>";
			else
				str += "<option value='"+key+"'>"+json[1].value[key]+"</option>";
		}
	}
	str += '</select>';
	$('prv').innerHTML=str;
	str = '';
	str += '<select id="city" style="width:80px;" onchange="getzone(this.value)">';
	for(var key in json[2].value){
		if(cs_city==''){
			if(json[4].value==key)
				str += "<option value='"+key+"' selected>"+json[2].value[key]+"</option>";
			else
				str += "<option value='"+key+"'>"+json[2].value[key]+"</option>";
		}else{
			if(cs_city==key)
				str += "<option value='"+key+"' selected>"+json[2].value[key]+"</option>";		
			else
				str += "<option value='"+key+"'>"+json[2].value[key]+"</option>";
		}
	}
	str += '</select>';
	$('ct').innerHTML=str;
	str = '';
	str += '<select id="zone" style="width:80px;" onchange="set(0)">';
	for(var key in json[3].value){
		if(ccity==''){
			if(json[5].value==key)
				str += "<option value='"+key+"' selected>"+json[3].value[key]+"</option>";
			else
				str += "<option value='"+key+"'>"+json[3].value[key]+"</option>";
		}else{
			if(ccity==key)
				str += "<option value='"+key+"' selected>"+json[3].value[key]+"</option>";
			else
				str += "<option value='"+key+"'>"+json[3].value[key]+"</option>";
		}
	}
	str += '</select>';
	$('zn').innerHTML=str;
}
function set(id){
var p = $('province').value;
var city = $('city').value;
var zone = $('zone').value;
if(id==1){
SetCookie('dcity',zone);
SetCookie('s_city',city);
SetCookie('s_prov',p);
SetCookie('ccity','');
SetCookie('cs_city','');
SetCookie('cs_prov','');
alert("设置成功！");
}else{
SetCookie('ccity',zone);
SetCookie('cs_city',city);
SetCookie('cs_prov',p);
window.location.reload();
}
}
function getcity(p){
	loadJS("weather2.php?a=getZoneInfo&type=1&pid="+p+"&callback=getcityFun");
}

function getzone(p){
	loadJS("weather2.php?a=getZoneInfo&type=2&cid="+p+"&pid="+$('province').value+"&callback=getzoneFun");
}
function getcityFun(json){
	var str='';
	for(var key in json[0].value){
		str += "<option value='"+key+"'>"+json[0].value[key]+"</option>";
	}
	str = '<select id="city" style="width:80px;" onchange="getzone(this.value)">'+str+'</select>';
	$('ct').innerHTML=str;
	str = '';
	str += '<select id="zone" style="width:80px;" onchange="set(0)">';
	for(var key in json[1].value){
		str += "<option value='"+key+"'>"+json[1].value[key]+"</option>";
	}
	str += '</select>';
	$('zn').innerHTML=str;
}
function getzoneFun(json){
	str = '';
	str += '<select id="zone" style="width:80px;" onchange="set(0)">';
	for(var key in json[0].value){
		str += "<option value='"+key+"'>"+json[0].value[key]+"</option>";
	}
	str += '</select>';
	$('zn').innerHTML=str;
	set(0);
}
function img_re(s){
var r=/tianqibig/g,r1=/20px/g,str='';
str = s.replace(r,'tianqibig');
str = str.replace(r1,'46px');
return str;
}
function wsplit(w){
var ww;
ww = w.split("~");
if(ww[0]>ww[1]){
ww[2]="#ff0000";
ww[3]="#4899be";
}else{
ww[2]="#4899be";
ww[3]="#ff0000";
}
return ww;
}
function getWeather(json){

var s=s1=s2=s3=s4=s5='', d = new Date();
var now='当前时间：';
now+= d.getHours() + ':';
var month = d.getMonth()+1;
var day=d.getDate();
var m = d.getMinutes();
if(m<10)m='0'+m;
now+= m;
var weekday=new Array(7);
 weekday[0]="<font color='red'>星期日</font>" ;
 weekday[1]="星期一";
 weekday[2]="星期二";
 weekday[3]="星期三";
 weekday[4]="星期四";
 weekday[5]="星期五";
 weekday[6]="<font color='green'>星期六</font>";
s += weekday[d.getDay()];
s1 += weekday[(d.getDay()+1)%7];
s2 += weekday[(d.getDay()+2)%7];
s3 += weekday[(d.getDay()+3)%7];
s4 += weekday[(d.getDay()+4)%7];
s5 += weekday[(d.getDay()+5)%7];
var str='';var rb='tianqibig';var r='/tianqibig/g';var img1,img3,img5,img7,img9,img11;
img1=img_re(json.weatherinfo.img1);
img3=img_re(json.weatherinfo.img3);
img5=img_re(json.weatherinfo.img5);
img7=img_re(json.weatherinfo.img7);
img9=img_re(json.weatherinfo.img9);
img11=img_re(json.weatherinfo.img11);
temp1 = wsplit(json.weatherinfo.temp1);
temp2 = wsplit(json.weatherinfo.temp2);
temp3 = wsplit(json.weatherinfo.temp3);
temp4 = wsplit(json.weatherinfo.temp4);
temp5 = wsplit(json.weatherinfo.temp5);
temp6 = wsplit(json.weatherinfo.temp6);
str+='<div class="tqshow1"><h3>明天('+s1+')</h3><ul><li class="tqpng">'+img3+'</li><li><font color="'+temp2[2]+'">'+temp2[0]+'</font>~<font color="'+temp2[3]+'">'+temp2[1]+'</font></li><li>'+json.weatherinfo.weather2+'</li><li style="height:18px;overflow:hidden">'+json.weatherinfo.wind2+'</li></ul></div>';
str+='<div class="tqshow1"><h3>后天('+s2+')</h3><ul><li class="tqpng">'+img5+'</li><li><font color="'+temp3[2]+'">'+temp3[0]+'</font>~<font color="'+temp3[3]+'">'+temp3[1]+'</font></li><li>'+json.weatherinfo.weather3+'</li><li style="height:18px;overflow:hidden">'+json.weatherinfo.wind3+'</li></ul></div>';
str+='<div class="tqshow1"><h3>'+s3+'</h3><ul><li class="tqpng">'+img7+'</li><li><font color="'+temp4[2]+'">'+temp4[0]+'</font>~<font color="'+temp4[3]+'">'+temp4[1]+'</font></li><li>'+json.weatherinfo.weather4+'</li><li style="height:18px;overflow:hidden">'+json.weatherinfo.wind4+'</li></ul></div>';
str+='<div class="tqshow1"><h3>'+s4+'</h3><ul><li class="tqpng">'+img9+'</li><li><font color="'+temp5[2]+'">'+temp5[0]+'</font>~<font color="'+temp5[3]+'">'+temp5[1]+'</font></li><li>'+json.weatherinfo.weather5+'</li><li style="height:18px;overflow:hidden">'+json.weatherinfo.wind5+'</li></ul></div>';
str+='<div class="tqshow1"><h3>'+s5+'</h3><ul><li class="tqpng">'+img11+'</li><li><font color="'+temp6[2]+'">'+temp6[0]+'</font>~<font color="'+temp6[3]+'">'+temp6[1]+'</font></li><li>'+json.weatherinfo.weather6+'</li><li style="height:18px;overflow:hidden">'+json.weatherinfo.wind6+'</li></ul></div>';
$('detail').innerHTML=str;
//var t_day = month+'月'+day+'日'+s;

var today='<h2>'+json.weatherinfo.city+'('+json.weatherinfo.city_en+')</h2><div class="jttq"><div class="tqshow"><ul><li class="tqpng">'+img1+'</li><li class="fon14 fB"><span id="t_temp"><font color="'+temp1[2]+'">'+temp1[0]+'</font>~<font color="'+temp1[3]+'">'+temp1[1]+'</font></span></li><li class="cDRed">'+json.weatherinfo.weather1+'</li><li style="height:18px;overflow:hidden">'+json.weatherinfo.wind1+'</li></ul><input type="hidden" value="'+json.weatherinfo.city+'" id="t_city"></div></div>';           
$('today').innerHTML=today; 
var index_uv = {"强":{"col":"red","cont":"紫外线辐射强，建议涂擦SPF20左右、PA++的防晒护肤品。避免在10点至14点暴露于日光下。"},"中等":{"col":"green","cont":"属中等强度紫外线辐射天气，外出时建议涂擦SPF高于15、PA+的防晒护肤品，戴帽子、太阳镜。"},"很强":{"col":"red","cont":"尽量不外出，必须外出时，要采取一定的防护措施"},"弱":{"col":"green","cont":"紫外线强度较弱，建议出门前涂擦SPF在12-15之间、PA+的防晒护肤品。"},"最弱":{"col":"green","cont":"可以不采取措施"},"暂缺":{"col":"green","cont":"数据暂缺"},"":{"col":"green","cont":"数据暂缺"}};
var index_xc = {"不宜":{"col":"red","cont":"不宜洗车，未来24小时内有雨，如果在此期间洗车，雨水和路上的泥水可能会再次弄脏您的爱车。"},"适宜":{"col":"green","cont":"适宜洗车，未来持续两天无雨天气较好，适合擦洗汽车，蓝天白云、风和日丽将伴您的车子连日洁净。"},"较适宜":{"col":"green","cont":"较适宜洗车，未来一天无雨，风力较小，擦洗一新的汽车至少能保持一天。"},"较不宜":{"col":"red","cont":"较不宜洗车，未来一天无雨，风力较大，如果执意擦洗汽车，要做好蒙上污垢的心理准备。"},"":{"col":"green","cont":"数据暂缺"}};
var index_tr = {"很适宜":{"col":"green","cont":"天气晴朗，风和日丽，温度适宜，是个好天气哦。这样的天气很适宜旅游，您可以尽情地享受大自然的风光。"},"一般":{"col":"green","cont":"天气晴朗，万里无云，温度适宜但风力大，可能对您的出行产生一定的影响，若外出请注意防风。"},"不适宜":{"col":"red","cont":"天气条件差，可能对您的出行产生一定的影响，若外出请注意防风。"},"很不适宜":{"col":"red","cont":"天气条件差，很不适宜外出。"},"适宜":{"col":"green","cont":"有阵雨，温度适宜，在细雨中游玩别有一番情调，可不要错过机会呦！但记得出门要携带雨具。"},"较适宜":{"col":"green","cont":"天气晴朗，万里无云。较热但风稍大，能缓解些炎热的感觉。较适宜旅游，您仍可陶醉于大自然美好风光中。"},"暂缺":{"col":"green","cont":"数据暂缺"},"较不宜":{"col":"red","cont":"预报有小雨，稍凉，风大，可能对您的出行产生一定的影响，不适宜旅游，若外出请注意防风保暖。"},"":{"col":"green","cont":"数据暂缺"}};
var index_co = {"较舒适":{"col":"green","cont":"白天天气晴好，您在这种天气条件下，会感觉早晚凉爽、舒适，午后偏热。"},"较不舒适":{"col":"red","cont":"在这样的天气条件下，应会感到比较不清爽和不舒适。"},"不舒适":{"col":"red","cont":"在这样的天气条件下，应会感到不清爽和不舒适。"},"很不舒适":{"col":"red","cont":"白天天气晴好，但烈日炎炎您会感到很热，很不舒适。 "},"舒适":{"col":"green","cont":"白天不太热也不太冷，风力不大，相信您在这样的天气条件下，应会感到比较清爽和舒适。"},"暂缺":{"col":"green","cont":"数据暂缺"},"":{"col":"green","cont":"数据暂缺"}};
var index_cl = {"适宜":{"col":"green","cont":"天气晴朗，空气清新，是您晨练的大好时机，建议不同年龄段的人们积极参加户外健身活动。"},"较适宜":{"col":"green","cont":"早晨气象条件较适宜晨练，但风力稍大，晨练时请注意选择避风的地点，避免迎风锻炼。"},"较不宜":{"col":"red","cont":"风力较大，较不宜晨练，建议年老体弱人群适当减少晨练时间，若坚持室外锻炼，请选择避风的地点。"},"不宜":{"col":"red","cont":"风力较大，较不宜晨练，建议年老体弱人群适当减少晨练时间，若坚持室外锻炼，请选择避风的地点。"},"很不宜":{"col":"red","cont":"风力较大，很不宜晨练。"},"暂缺":{"col":"green","cont":"数据暂缺"},"":{"col":"green","cont":"数据暂缺"}};
var index_ls = {"适宜":{"col":"green","cont":"万里无云，光照充足，适宜晾晒。赶紧把久未见阳光的衣物搬出来吸收一下太阳的味道吧！"},"不太适宜":{"col":"red","cont":"偶尔的降雨可能会淋湿晾晒的衣物，不太适宜晾晒。请随时注意天气变化。"},"不适宜":{"col":"red","cont":"降雨会淋湿晾晒的衣物，不适宜晾晒。请随时注意天气变化。"},"很不适宜":{"col":"red","cont":"大降雨会淋湿晾晒的衣物，很不适宜晾晒。请随时注意天气变化。"},"基本适宜":{"col":"green","cont":"天气晴朗，午后温暖的阳光仍能满足你驱潮消霉杀菌的晾晒需求。"},"暂缺":{"col":"green","cont":"数据暂缺"},"":{"col":"green","cont":"数据暂缺"}};
var index_d = {"舒适":"green","温凉":"green","炎热":"red","热":"red","寒冷":"red","冷":"red","暖":"red","凉":"green"};
if(json.weatherinfo.index_uv!==undefined){
var zhishu='';
zhishu+='<div class="zhzsbd"><ul><li>紫外线指数：<span style="color:'+index_uv[json.weatherinfo.index_uv]["col"]+'">'+json.weatherinfo.index_uv+'</span></li>';zhishu+='<li>穿衣指数：<span style="color:'+index_d[json.weatherinfo.index]+'">'+json.weatherinfo.index+'</span></li>';zhishu+='<li>洗车指数：<span style="color:'+index_xc[json.weatherinfo.index_xc]["col"]+'">'+json.weatherinfo.index_xc+'</span></li>';zhishu+='<li>旅游指数：<span style="color:'+index_tr[json.weatherinfo.index_tr]["col"]+'">'+json.weatherinfo.index_tr+'</span></li>';zhishu+='<li>舒适度：<span style="color:'+index_co[json.weatherinfo.index_co]["col"]+'">'+json.weatherinfo.index_co+'</span></li>';zhishu+='<li>晨练指数：<span style="color:'+index_cl[json.weatherinfo.index_cl]["col"]+'">'+json.weatherinfo.index_cl+'</span></li></ul></div>';zhishu+='<div class="lifezs"><ul><li><b>今日出行提示： <span class="cRed">'+json.weatherinfo.index+'</span></b>'+json.weatherinfo.index_d+'<span><a target="_blank" href="http://www.71516.cn/tianqi/" class="cBlue">【'+json.weatherinfo.city+'】一周天气详情 &raquo;</a></span></li></ul><idiv>';zhishu+='<div style="clear:both"></div>';$('zhishu').innerHTML=zhishu;}$('tj').src = 'http://js.users.51.la/3568862.js';};