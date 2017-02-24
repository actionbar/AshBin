var bdsug={};
var G_SE=[
	[
		{
			classname:'ico ico_sg',
			action:'http://www.sogou.com/sogou',
			params:'<input type="hidden" name="pid" value="sogou-site-3147da8ab4a0437c">',
			kname:'query',
			title:'搜狗搜索'
		},
		{
			classname:'ico ico_bd',
			action:'http://www.baidu.com/s',
			params:'',
			kname:'wd',
			title:'百度搜索'},
		{
			classname:'ico ico_gg',
			action:'http://www.google.com/search',
			params:'',
			kname:'q',title:'谷歌搜索'
		}
	],
	[
		{
			classname:'ico ico_kk',
			action:'http://search.xunlei.com/search.php',
			params:'',
			kname:'keyword',title:'迅雷视频'
		},
		{
			classname:'ico ico_sg',
			action:'http://v.sogou.com/v',
			params:'',
			kname:'query',
			title:'搜狗视频'
		},
		{
			classname:'ico ico_bd',
			action:'http://video.baidu.com/v',
			params:'',
			kname:'word',
			title:'百度视频'
		}
	],
	[
		{
			classname:'ico ico_sg',
			action:'http://news.sogou.com/news',
			params:'',
			kname:'query',
			title:'搜狗新闻'
		},
		{
			classname:'ico ico_bd',
			action:'http://news.baidu.com/ns',
			params:'',
			kname:'word',
			title:'百度新闻'
		},
		{
			classname:'ico ico_gg',
			action:'http://www.google.com/nwshp',
			params:'',
			kname:'q',
			title:'谷歌新闻'
		}
	],
	[
		{
			classname:'ico ico_sg',
			action:'http://mp3.sogou.com/music.so',
			params:'',
			kname:'query',
			title:'搜狗音乐'
		},
		{
			classname:'ico ico_bd',
			action:'http://mp3.baidu.com/m',
			params:'',
			kname:'word',
			title:'百度音乐'
		},
		{
			classname:'ico ico_gg',
			action:'http://www.google.cn/music/search',
			params:'',
			kname:'q',
			title:'谷歌音乐'
		}
	],
	[
		{
			classname:'ico ico_sg',
			action:'http://pic.sogou.com/pics',
			params:'',
			kname:'query',
			title:'搜狗图片'
		},
		{
			classname:'ico ico_bd',
			action:'http://image.baidu.com/i',
			params:'<input type="hidden" name="tn" value="baiduimage"><input type="hidden" name="ct" value="201326592"><input type="hidden" name="cl" value="2"><input type="hidden" name="lm" value="-1">',
			kname:'word',
			title:'百度图片'
		},
		{
			classname:'ico ico_gg',
			action:'http://www.google.com/imghp',
			params:'',
			kname:'q',
			title:'谷歌图片'
		}
	],
	[
		{
			classname:'ico ico_sg',
			action:'http://map.sogou.com/',
			params:'',
			kname:'lq',
			title:'搜狗地图'
		},
		{
			classname:'ico ico_bd',
			action:'http://map.baidu.com/m',
			params:'',
			kname:'word',
			title:'百度地图'
		},
		{
			classname:'ico ico_gg',
			action:'http://ditu.google.cn/maps',
			params:'',
			kname:'q',
			title:'谷歌地图'
		}
	],
	[
		{
			classname:'ico ico_sg',
			action:'http://zhishi.sogou.com/zhishi',
			params:'',
			kname:'query',
			title:'搜狗知识'
		},
		{
			classname:'ico ico_bd',
			action:'http://zhidao.baidu.com/q',
			params:'<input type="hidden" name="ct" value="17"><input type="hidden" name="tn" value="ikaslist"><input type="hidden" name="fr" value="search">',
			kname:'word',
			title:'百度知道'
		}
	]
];

var G_ML =[
{mail:"163",name:"@163.com",action:"http://reg.163.com/CheckUser.jsp",params:{url:"http://entry.mail.163.com/coremail/fcg/ntesdoor2?lightweight=1&verifycookie=1&language=-1&style=15",username:"#{u}",password:"#{p}"}},
{mail:"126",name:"@126.com",action:"https://reg.163.com/logins.jsp",params:{domain:"126.com",username:"#{u}@126.com",password:"#{p}",url:"http://entry.mail.126.com/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26language%3D0%26style%3D-1"}},
{mail:"sina",name:"@sina.com",action:"http://mail.sina.com.cn/cgi-bin/login.cgi",params:{u:"#{u}@sina.com",psw:"#{p}"}},
{mail:"yahoocomcn",name:"@yahoo.com.cn",action:"https://edit.bjs.yahoo.com/config/login",params:{login:"#{u}@yahoo.com.cn",passwd:"#{p}",domainss:"yahoo",".intl":"cn",".src":"ym"}},
{mail:"yahoocn",name:"@yahoo.cn",action:"https://edit.bjs.yahoo.com/config/login",params:{login:"#{u}@yahoo.cn",passwd:"#{p}",domainss:"yahoocn",".intl":"cn",".done":"http://mail.cn.yahoo.com/inset.html"}},
{mail:"sohu",name:"@sohu.com",action:"http://passport.sohu.com/login.jsp",params:{loginid:"#{u}@sohu.com",passwd:"#{p}",fl:"1",vr:"1|1",appid:"1000",ru:"http://login.mail.sohu.com/servlet/LoginServlet",ct:"1173080990",sg:"5082635c77272088ae7241ccdf7cf062"}},
{mail:"yeah",name:"@yeah.net",action:"https://reg.163.com/logins.jsp",params:{domain:"yeah.net",username:"#{u}@yeah.net",password:"#{p}",url:"http://entry.mail.yeah.net/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26style%3D-1"}},
{mail:"tom",name:"@tom.com",action:"http://login.mail.tom.com/cgi/login",params:{user:"#{u}",pass:"#{p}"}},
{mail:"21cn",name:"@21cn.com",action:"http://passport.21cn.com/maillogin.jsp",params:{UserName:"#{u}@21cn.com",passwd:"#{p}",domainname:"21cn.com"}},
{mail:"139",name:"@139.com",action:"https://mail.10086.cn/Login/Login.ashx",params:{UserName:"#{u}",Password:"#{p}",clientid:"5015"}},
{mail:"renren",name:"人人网",action:"http://passport.renren.com/PLogin.do",params:{email:"#{u}",password:"#{p}",origURL:"http://www.renren.com/Home.do",domain:"renren.com"}},
{mail:"qq",name:"@qq.com",action:"http://mail.qq.com"},
{mail:"gmail",name:"@gmail.com",action:"http://mail.google.com"},
{mail:"hotmail",name:"@hotmail.com",action:"http://www.hotmail.com"},
{mail:"weibo",name:"新浪微博",action:"http://www.weibo.com"},
{mail:"alipay",name:"支付宝",action:"https://auth.alipay.com/login/index.htm?goto="},
{mail:"qzone",name:"QQ空间",action:"http://qzone.qq.com/"},
{mail:"webqq",name:"webqq",action:"http://web.qq.com/"},
{mail:"kaixin",name:"开心网",action:"http://www.kaixin001.com/"}
];
var g_current_searchtab = 0;
var g_curre_se=0;
var G_USE_KANKAN_SEARCH=false;
function $g(id){
	return document.getElementById(id);
}
var Search ={
	init : function (){
		Search.choose_se(0,0);
	},
	
	choose_se : function(tab, num){
		try {
			try{MYNAV.hidehotword();}catch(e){}
			$g('b_curr_se').className=G_SE[tab][num].classname;
			$g('curr_se').title=G_SE[tab][num].title;
			$g('zonghe_search').action=G_SE[tab][num].action;
			$g("keyword").name=G_SE[tab][num].kname;
			$g('ParamsGroup').innerHTML = G_SE[tab][num].params;
			$g('lab_list_'+tab).style.display='none';
			
			g_current_searchtab = tab;
			g_curre_se=num;
			if(g_current_searchtab == 0){
				stopSearchTextTimer();
				G_USE_KANKAN_SEARCH=false;
				xlEvent.setSugKeyword($g("keyword"));
			}else if(g_current_searchtab == 1){
				xlEvent.stopSugKeyword();
				if($g("keyword").value==''||!G_USE_KANKAN_SEARCH){
					setSearchInputContent($g("keyword"));
					G_USE_KANKAN_SEARCH=true;
				}
			}else{
				xlEvent.stopSugKeyword();
				stopSearchTextTimer();
				G_USE_KANKAN_SEARCH=false;
				$g('keyword').value='';
			}
		} catch(e) {}
	},
	
	switch_se:function(tab,num){
		for(var i=G_SE[tab].length;i--;i>=0){
			$g("se_"+tab+"_"+i).className=(num==i)?'on':'';
		}
	},
	
	search_check : function(){
		var a=$g("keyword").value;
		a=UtilTool.strip_tags(a.Trim());	
		a=a.replace(/(\/)|(\\)|(\")|(\')/g,"");
		if(escape(a)=="\u641c\u7d22\u8d85\u8fc710\u4e07\u90e8\u5f71\u89c6\u5185\u5bb9"||a==""){
			$g("keyword").value="";
			$g("keyword").focus();
			try {
				UtilTool.send_stat_msg();
				if( g_current_searchtab == 1 && g_curre_se==0){
					window.open('http://www.xunlei.com/');
				} else {
					var tmp = G_SE[g_current_searchtab][g_curre_se].action;
					tmp = tmp.substring(0, tmp.lastIndexOf('/'));
					window.open(tmp);
				}
			} catch (e) {}
			return false;
		}
		//百度知道和搜狗新闻特殊处理
		if((g_current_searchtab == 6 && g_curre_se==1)||(g_current_searchtab == 2 && g_curre_se==0)){
			var isIE=!!window.ActiveXObject;
			if(isIE){
				document.charset='gbk';
			}
			$g("gbk_search").action=G_SE[g_current_searchtab][g_curre_se].action;
			$g("gbk_search_content").innerHTML='<input type="hidden" name="'+G_SE[g_current_searchtab][g_curre_se].kname+'" value="'+$g("keyword").value+'" >'+G_SE[g_current_searchtab][g_curre_se].params;
			$g("gbk_search").submit();
			if(isIE){
				document.charset='UTF-8';
			}
			try{$g('search_now').blur();}catch(e){}
			UtilTool.send_stat_msg();
			return false;
		}
		
		try{$g('search_now').blur();}catch(e){}
		
		UtilTool.send_stat_msg();
		return true;
	},
	
	show_se : function(id, total){
		for (var i = 0; i < total; ++i) {
			if (i == id) {
				$g('lab_list_'+i).style.display='block';
				Search.switch_se(id,0);
			} else {
				$g('lab_list_'+i).style.display='none';
			}
		}
		
	},
	hide_lab_list : function(e){
		e = e ? e : (window.event ? window.event : null);
		var e = e.target ? e.target : e.srcElement;
		if(e.id!='curr_se'&&/^se_\d+_\d+$/.test(e.id) == false){
			for (var i = 0; i < 7; i++) {
				$g('lab_list_'+i).style.display='none';
			}
		}
		if(/^sug_res_\d+$/.test(e.id))	return;
		try{MYNAV.hidehotword();}catch(e){}
	},
	
	switchSearchTab : function(id, total) {
		try {
			for (var i = 0; i < total; i++) {
				if (i != id) {
					$g('search_'+i).className = '';
				} else {
					$g('search_'+i).className = 'on';
					Search.choose_se(id,0);
				}
			}
		}
		catch (e) {}
	},
	stopstimer : function(name){
		try{
			 var box=document.getElementById(name);
			 //if(box.value=='搜索超过10万部影视内容'||searchTextTimer!=null){box.value=''};
			 stopSearchTextTimer();
			 G_USE_KANKAN_SEARCH=false;
			 xlEvent.stopSugKeyword();
			 box.value='';
		}catch(e){}
	}
};

var Mail={
	dis:11,
	init:function(){
		var name='';
		var type=0;
		var len=G_ML.length;
		var uinfo=UtilTool.getCookie('xl_mail_info');
		if(uinfo){
			var teminfo= new Array();
			teminfo=uinfo.split("#@#");
			if(teminfo.length==2){
				name=teminfo[0];
				if(parseInt(teminfo[1])<len){type=parseInt(teminfo[1]);}
			}
		}
		$g("mail_input").value=(name=='')?'请输入邮箱账号':name;
		$g("xl_u").value=name;
		Mail.drawMailList();
		this.switchMail(type,len);
		this.setMail(type);
	},
	drawMailList:function(){
		var len=G_ML.length;
		var dis = Mail.dis;
		var html='<li class="tit">请选择邮箱</li>';
		for(var i=0;i<dis;i++){
			html += '<li id="mail_list_'+i+'" onmouseover="Mail.switchMail('+i+','+len+');" onclick="Mail.setMail('+i+');">'+G_ML[i].name+'</li>';
		}
		html += '<li class="tit">以下弹出登录</li>';
		for(var i=dis;i<len;i++){
			html += '<li id="mail_list_'+i+'" onmouseover="Mail.switchMail('+i+','+len+');" onclick="Mail.setMail('+i+');">'+G_ML[i].name+'</li>';
		}
		$g("mail_list").innerHTML = html;
	},
	showBox:function(){
		$g("mail_box").style.display='';
		var elem = $g("xl_u");
		if(elem.value.Trim() == ''){
			elem.focus();
		}else{
			$g("xl_p").focus();
		}
		UtilTool.EventUtil.addHandler(document.body,"mousedown",Mail.checkClick4Box);
	},
	hideBox:function(){
		$g("xl_p").value='';
		$g("mail_box").style.display='none';
		UtilTool.EventUtil.removeHandler(document.body,"mousedown",Mail.checkClick4Box);
	},
	showList:function(){
		$g("mail_list").style.display='';
		UtilTool.EventUtil.addHandler(document.body,"mousedown",Mail.checkClick4List);
	},
	hideList:function(){
		$g("mail_list").style.display='none';
		UtilTool.EventUtil.removeHandler(document.body,"mousedown",Mail.checkClick4List);
	},
	switchMail:function(id,ct){
		while(ct--){
			$g("mail_list_"+ct).className=(id==ct)?'on':'';
		}
	},
	setMail:function(id){
		if(id>=Mail.dis){
			window.open(G_ML[id].action);
			Mail.hideList();
			return false;
		}
		var elem=$g("xl_t");
		elem.value=G_ML[id].name;
		elem.setAttribute('mtype',id);
		Mail.hideList();
	},
	formatParams:function(params,u,p){
		var html='';
		if(typeof(params)== 'object'){
			for(var pa in params){
				html+='<input type="hidden" name="'+pa+'" value="'+params[pa].replace("#{u}",u).replace("#{p}",p)+'"> ';
			}
		}
		return html;
	},
	sureSub:function(){
		$g("mail_form").submit();
		return;
	},
	cancelSub:function(){
		Mail.hideList();
		Mail.hideBox();
		return false;
	},
	checkSubmit:function(){
		setTimeout(function(){UtilTool.send_mail_click()},0);
		var u=$g('xl_u').value.Trim();
		if(!u){
			alert('用户名不能为空！');
			$g('xl_u').focus();
			return false;
		}
		var p=$g('xl_p').value.Trim();
		if(!p){
			alert('密码不能为空！');
			$g('xl_p').focus();
			return false;
		}
		var t=$g('xl_t').getAttribute('mtype');;
		if(t<0 || t>=G_ML.length){
			alert('请选择邮箱！');
			return false;
		}
		t=parseInt(t);
		$g("mail_form").action=G_ML[t].action;
		var html=Mail.formatParams(G_ML[t].params,u,p);
		$g("mail_content").innerHTML=html;
		Mail.remAccount(u,t);
		setTimeout(function(){Mail.hideList();Mail.hideBox();},3000);
		return true;
	},
	remAccount:function(name,type){
		$g("mail_input").value=name;
		UtilTool.setCookie('xl_mail_info',name+'#@#'+type,8760);
	},
	
	checkClick4Box:function(el){
		thisObj = el.target?el.target:event.srcElement;
		do{
			if(thisObj.id == "mail_box") return;
			if(thisObj.tagName == "BODY"){
				Mail.hideBox();
				return;
			};
			thisObj = thisObj.parentNode;
		}while(thisObj.parentNode);
	},
	checkClick4List:function(el){
		thisObj = el.target?el.target:event.srcElement;
		do{
			if(thisObj.id == "mail_list") return;
			if(thisObj.tagName == "BODY"){
				Mail.hideList();
				return;
			};
			thisObj = thisObj.parentNode;
		}while(thisObj.parentNode);
	}
};

String.prototype.Trim=function(){
	var p=/(^\s*)|(\s*$)/g;
	return this.replace(p,'');
}

var UtilTool={
	getCookie:function(name){
		var value=(document.cookie.match(new RegExp('(^' + name + '| ' + name + ')=([^;]*)')) == null)?'':RegExp.$2;
		if(value!=''){
			return unescape(value);
		}
		return '';
	},
	setCookie:function(name,value,hours){
		var expire = "; path=/";
		if(hours != null) {
			expire = new Date((new Date()).getTime() + hours * 3600000);
			expire = "; expires=" + expire.toGMTString() + "; path=/";
		}
		document.cookie = name + "=" + escape(value)+';domain=123.xunlei.com;'+expire;
	},
	deleteDomEle:function(id){
		try{
			var d = document.getElementById(id);
			var p = d.parentNode;
			if (p){
				p.removeChild(d);
			}
		}catch(e){}
	},
	loadJSData:function(url,tcharset,callback){
		var script = document.createElement('script'); 		
		script.type = 'text/javascript';
		script.charset = tcharset;
		//加随机参数防止使用cache 
		//url+='&rd='+(new Date()).getTime();
		if(callback){
			script.onload = script.onreadystatechange = function(){ 
				if(script.readyState && script.readyState != 'loaded' && script.readyState != 'complete') 
					return;				
				script.onreadystatechange = script.onload = null;				
				callback();
			}; 
		}
		script.src = url; 
		document.getElementsByTagName('head')[0].appendChild(script);
	},
	EventUtil:{addHandler:function(element,type,handler){
					if (element.addEventListener){
						element.addEventListener(type,handler,false);
					} else if (element.attachEvent){
						element.attachEvent("on"+type,handler);
					} else {
						element["on"+type]=handler;
					}
			      },
		  removeHandler:function(element, type, handler){
					if (element.removeEventListener){
						element.removeEventListener(type,handler,false);
					} else if (element.detachEvent){
						element.detachEvent("on"+type,handler);
					} else {
						element["on"+type]=null;
					}
				}
	},
	formatstring:function(str){
		if(str==''||str.length==0) return '';
		if(typeof(str)!='string')return '';
		var res=this.strip_tags(str.Trim());
		res=res.replace(/[\/\\"']/g,"");
		return res;
	},
	strip_tags : function(a){
		if(arguments.length<3)a=a.replace(/<\/?(?!\!)[^>]*>/gi,"");
		else{
			var b=arguments[1],c=eval("["+arguments[2]+"]");
			b=b?"</?(?!("+c.join("|")+"))\u0008[^>]*>":"</?("+c.join("|")+")\u0008[^>]*>";
			a=a.replace(RegExp(b,"gi"),"")
		}
		return a;
	},
	send_stat_msg : function() {
		var search = G_SE[g_current_searchtab][g_curre_se];
		var tmp = escape(search.action) + '?' + search.kname + '=' + escape($g("keyword").value);
		url = "http://kkpgv2.xunlei.com/?u=outlink&u1=" + escape(window.location.href) + "&u2=" + tmp + "&u3=" + getCookie('KANKANWEBUID') + "&u4=-1";
		url += "&u5=" + g_current_searchtab + "&u6=" + g_curre_se;
		var img = new Image();
		img.src = url;
	},
	send_mail_click:function(u){
		try{
			url = "http://kkpgv2.xunlei.com/?u=outlink&u1=" + escape(window.location.href) + "&u2=&u3=" + getCookie('KANKANWEBUID') + "&u4=-3&u5=0";
			var img = new Image();
			img.src = url;
		}catch(e){}
	},
	addFavorite : function(){
		var url = 'http://123.xunlei.com';
		var title = '迅雷网址导航';
		try{
			window.external.AddFavorite(url,title);
			return true;
		}catch(e){
			try{
				window.external.AddFavorite(url,title);
				return true;
			}catch(e){
				alert("你的浏览器不支持此功能，请手动添加到收藏夹！");
				return false;
			}
		}
	},
	setHomePage : function(obj){
		try{
			var url='http://123.xunlei.com';
			obj.style.behavior='url(#default#homepage)';obj.setHomePage(url);
		}catch(e){
			alert("你的浏览器不支持此功能，请手动添加到收藏夹！");
		}
		return ;
	},
	switchRankTab:function(pre,cur,cont){
		try{
			while(cont--){
				if(cur==cont){
					$g(pre+'_list_'+cont).style.display='none';
					$g(pre+'_panle_'+cont).style.display='';
				}else{
					$g(pre+'_list_'+cont).style.display='';
					$g(pre+'_panle_'+cont).style.display='none';
				}
			}
		}catch(e){}
	},
	switchClass:function(pre,cur,count,class1,class2){
		try{
			while(count--){
				$g(pre+'_'+count).className=(cur==count)?class1:class2;
			}
		}catch(e){}
	}
};

var xlEvent={
	searchTextTimer:null,
	scrollObj:null,
	jock_arr_len:0,
	sn:0,
	scrollTimer1:null,
	scrollTimer2:null,
	timerID:null,
	timerRunning:false,
	initSugWord:function(){
		if(g_current_searchtab == 0){
			xlEvent.setSugKeyword($g("keyword"));
		}
	},
	setSugKeyword:function(obj){
		var searchTextTime = 0;
		var len = XL_SUG_ARR.length;
		if(obj&&!this.searchTextTimer){
			obj.value = XL_SUG_ARR[0];
			this.searchTextTimer = setInterval(function(){
				obj.value = XL_SUG_ARR[searchTextTime];
				setTimeout(function(){obj.blur()},500);
				searchTextTime++;
				if(searchTextTime>=len) searchTextTime = 0;
			},5000);
		}
	},
	stopSugKeyword:function (){
		clearInterval(this.searchTextTimer);
		this.searchTextTimer = null;
	},
	stopclock:function(){
		if(this.timerRunning){
			clearTimeout(timerID)
		}
		this.timerRunning=false
	},
	startclock:function(){
		this.stopclock();
		this.showtime()
	},
	showtime:function(){
		var d=new Date();
		var s=d.getSeconds();
		if(s==0 || !this.timerRunning){
			var h=d.getHours();
			var m=d.getMinutes();
			$g("time_show_h").innerHTML=((h>9)?h:'0'+h);
			$g("time_show_m").innerHTML=((m>9)?m:'0'+m);
		}
		//$g("time_show_s").innerHTML=((s>9)?s:'0'+s);
		this.timerID=setTimeout("xlEvent.showtime()",1000);
		this.timerRunning=true
	}
};

var NONGLI={};
NONGLI.LunarDaysOfMonth = new Array(
	0xd4a8, 0xd4a0, 0xda50, 0x5aa8, 0x56a0, 0xaad8, 0x25d0, 0x92d0, 0xc958, 0xa950, 
	0xb4a0, 0xb550, 0xb550, 0x55a8, 0x4ba0, 0xa5b0, 0x52b8, 0x52b0, 0xa930, 0x74a8,
	0x6aa0, 0xad50, 0x4da8, 0x4b60, 0x9570, 0xa4e0, 0xd260, 0xe930, 0xd530, 0x5aa0,
	0x6b50, 0x96d0, 0x4ae8, 0x4ad0, 0xa4d0, 0xd258, 0xd250, 0xd520, 0xdaa0, 0xb5a0,
	0x56d0, 0x4ad8, 0x49b0, 0xa4b8, 0xa4b0, 0xaa50, 0xb528, 0x6d20, 0xada0, 0x55b0 
);
NONGLI.LunarLeapYear = new Array(
	0x40, 0x02, 0x07, 0x00, 0x50, 0x04, 0x09, 0x00, 0x60, 0x04, 0x00, 0x20, 0x60,
	0x05, 0x00, 0x30, 0xb0, 0x06, 0x00, 0x50, 0x02, 0x07, 0x00, 0x50, 0x03 
);

NONGLI.GetLeapMonth=function(iLunarYear){
	var Leap = NONGLI.LunarLeapYear[(iLunarYear - 2001) >> 1];
	return (((iLunarYear - 2001) & 1) == 0) ? (Leap >> 4) : (Leap & 0x0f);
}

NONGLI.LunarMonthDays=function(iLunarYear, iLunarMonth){
	var High;
	var Low;
	var Bit;

	High = 0;
	Low = 29;
	Bit = 16 - iLunarMonth;
	if ((iLunarMonth > NONGLI.GetLeapMonth(iLunarYear)) && (NONGLI.GetLeapMonth(iLunarYear) > 0)) Bit--;
	if ((NONGLI.LunarDaysOfMonth[iLunarYear - 2001] & (1 << Bit)) > 0) Low++;
	if (iLunarMonth == NONGLI.GetLeapMonth(iLunarYear))
	{
	High = ((NONGLI.LunarDaysOfMonth[iLunarYear - 2001] & (1 << (Bit-1))) > 0) ? 30 : 29;
	}

	return Low + (High << 16);
}

NONGLI.LunarYearDays=function(iLunarYear){
	var Days;
	var tmp;

	Days = 0;
	for (var i=1; i <= 12; i++)
	{
	tmp = NONGLI.LunarMonthDays(iLunarYear, i);
	Days = Days + ((tmp >> 16) & 0xffff); //取高位
	Days = Days + (tmp & 0xffff); //取低位
	}

	return Days;
}

NONGLI.FormatLunarYear=function(iLunarYear){
	var szText1 = new String("甲乙丙丁戊己庚辛壬癸");
	var szText2 = new String("子丑寅卯辰巳午未申酉戌亥");
	var strYear;

	strYear = szText1.substr((iLunarYear - 4) % 10, 1);
	strYear = strYear + szText2.substr((iLunarYear - 4) % 12, 1);

	return strYear + "年";
}

NONGLI.FormatLunarMonth=function(iLunarMonth){
	var szText = new String("正二三四五六七八九十");
	var strMonth;

	if (iLunarMonth <= 10)
	{
	strMonth = szText.substr(iLunarMonth - 1, 1);
	}
	else if (iLunarMonth == 11) strMonth = "十一";
	else strMonth = "十二";

	return strMonth + "月";
}

NONGLI.FormatLunarDay=function(iLunarDay){
var szText1 = new String("初十廿三");
	var szText2 = new String("一二三四五六七八九十");
	var strDay;
	if((iLunarDay != 20)&&(iLunarDay != 30)){
		strDay = szText1.substr((iLunarDay - 1) / 10, 1) + szText2.substr((iLunarDay - 1) % 10, 1);
	}else if(iLunarDay != 20){
		strDay = szText1.substr(iLunarDay / 10, 1) + "十";
	}else{
		strDay = "二十";
	}
	return strDay;
}

NONGLI.GetLunarDateString=function(SolarDate){
	var tmp;
	var iLunarYear;
	var iLunarMonth;
	var iLunarDay;
	var Leap = false;
	var MinMilli = 1000 * 60;
	var HrMilli = MinMilli * 60;
	var DyMilli = HrMilli * 24;
	var iSpanDays = Math.round(SolarDate.getTime()/DyMilli)-11323;
	if (iSpanDays < 23){
		iYear = 2000;
		iLunarMonth = 12;
		iLunarDay = iSpanDays + 7;
	}else{
		iSpanDays = iSpanDays - 23;
		iLunarYear = 2001;
		iLunarMonth = 1;
		iLunarDay = 1;
		tmp = NONGLI.LunarYearDays(iLunarYear);
		while (iSpanDays >= tmp)
		{
		iSpanDays -= tmp;
		iLunarYear++;
		tmp = NONGLI.LunarYearDays(iLunarYear);
		}
		tmp =NONGLI.LunarMonthDays(iLunarYear, iLunarMonth) & 0xffff;
		while (iSpanDays >= tmp){
			iSpanDays -= tmp;
			if(iLunarMonth ==NONGLI.GetLeapMonth(iLunarYear)){
				tmp = NONGLI.LunarMonthDays(iLunarYear, iLunarMonth) >> 16;
				if (iSpanDays < tmp)
				{
				Leap = (tmp > 0) ? true : false;
				break;
				}
				iSpanDays = iSpanDays - tmp;
			}
			iLunarMonth++;
			tmp = NONGLI.LunarMonthDays(iLunarYear,iLunarMonth) & 0xffff;
		}
		iLunarDay += iSpanDays;
	}
	return NONGLI.FormatLunarMonth(iLunarMonth) + NONGLI.FormatLunarDay(iLunarDay);
}
var MYNAV={
	hide_rencent_view:false,
	recordClick:function(obj){
		if(typeof(obj.href)=='undefined'||typeof(obj.title)=='undefined') return '';
		var href=obj.href;
		var title=obj.title.Trim();
		try{
			var save_data=[];
			var linkviewed=UtilTool.getCookie('linkviewed');
			if(linkviewed==''){
				save_data.push(href+'@@'+title);
			}else{
				var data=linkviewed.split('^^');
				for(var i=0;i<data.length;i++){
					var link=data[i].split('@@');
					if(link[0]==href&&link[1]==title) continue;
					save_data.push(data[i]);
				}
				save_data.push(href+'@@'+title);
				var save_len=save_data.length;
				if(save_len>10){
					for(var jjjj=0;jjjj<(save_len-10);jjjj++){
						save_data.shift();
					}
				}
			}
			UtilTool.setCookie('linkviewed',save_data.join('^^'),30*24);
			MYNAV.drawClickList(save_data);
		}catch(e){}
	},
	drawClickList:function(data){
		try{
			if(MYNAV.hide_rencent_view) return false;
			var obj = $g('often_clicked');
			var tmp_html='';
			var len = data.length;
			for(var i=len-1;i>=0;i--){
				var link=data[i].split('@@');
				if(link[0] && link[1]){
					tmp_html += '<span id="view_list_'+i+'" onmouseover="javascript:this.className=\'hover\';" onmouseout="javascript:this.className=\'\';" ><a id="click_list_'+i+
						'" href="'+link[0]+'" title="'+link[1]+'">'+link[1]+'</a><a href="javascript:void(0)" onclick="MYNAV.delOneClick('+i+');return false;" title="删除" class="close">删除</a></span>';
				}else{
					continue;
				}
			}
			if(tmp_html=='') return false;
			var html='<span class="none">最近常用：</span>'+tmp_html+'<a href="javascript:void(0);" onclick="MYNAV.closeRecentView();return false;" title="关闭" class="close_div">关闭</a>';
			obj.innerHTML=html;
			obj.style.display='block';
		}catch(e){}
		
	},
	initClicked:function(){
		try{
			MYNAV.hide_rencent_view = (UtilTool.getCookie('hide_recent_view') == 1) ? true : false;
			var linkviewed=UtilTool.getCookie('linkviewed');
			if(linkviewed=='')return false;
			var data=linkviewed.split('^^');
			MYNAV.drawClickList(data);
		}catch(e){}
	},
	delOneClick:function(id){
		try{
			var obj = $g('click_list_'+id);
			if(typeof(obj.href)=='undefined'||typeof(obj.title)=='undefined') return '';
			var href=obj.href.Trim();
			var title=obj.title.Trim();
			var linkviewed=UtilTool.getCookie('linkviewed');
			var data=linkviewed.split('^^');
			var save_data=[];
			for(var i=0;i<data.length;i++){
				var link=data[i].split('@@');
				if(link[0].Trim()==href&&link[1].Trim()==title) continue;
				save_data.push(data[i]);
			}
			if(save_data.length>0){
				UtilTool.setCookie('linkviewed',save_data.join('^^'),30*24);
				$g('view_list_'+id).style.display="none";
			}else{
				//MYNAV.delAllClick();
				UtilTool.setCookie('linkviewed','',30*24);
				//$g('view_list_'+id).style.display="none";
				$g("often_clicked").style.display="none";
			}
		}catch(e){}
	},
	delAllClick:function(){
		try{
			try{
				if(window.confirm("您确定要删除最近常用网址吗？")){
					UtilTool.setCookie('linkviewed','',30*24);
					//$g("often_clicked").innerHTML='<span class="none">最近常用：</span><a href="javascript:void(0);" onclick="MYNAV.closeRecentView();return false;" title="关闭" class="close_div">关闭</a>';
					$g("often_clicked").style.display="none";
				}
			}catch(e){}
			MYNAV.hideSetPanel();
			return;	
		}catch(e){}
		
	},
	closeRecentView:function(){
		try{
			if(window.confirm("关闭后，下次可以从页面右上角的“设置”中开启")){
				$g('often_clicked').style.display="none";
				UtilTool.setCookie('hide_recent_view',1,8670);
			}
			return;
		}catch(e){}
		
	},
	showSetPanel:function(){
		if($g("set_show_switch").innerHTML=='设置'){
			$g("set_panel").style.display='';
			$g("recent_view_show").checked = "checked";
			$g("set_show_switch").innerHTML='收起';
		}else{
			$g("set_panel").style.display='none';
			$g("set_show_switch").innerHTML='设置';
		}
		return true;
	},
	hideSetPanel:function(){
		$g("set_panel").style.display='none';
		$g("set_show_switch").innerHTML='设置';
		return true;
	},
	saveSet:function(){
		try{
			var hide = $g("recent_view_hide").checked;
			if(hide){
				UtilTool.setCookie('hide_recent_view',1,8670);
				try{
					$g('often_clicked').style.display="none";
				}catch(e){}
			}else{
				UtilTool.setCookie('hide_recent_view',0,8670);
				MYNAV.initClicked();
			}
			$g("set_panel").style.display='none';
			$g("set_show_switch").innerHTML='设置';
			return true;	
		}catch(e){}
	},
	showNongli:function(){
		var d=new Date();
		var nongli=NONGLI.GetLunarDateString(d);

		var year=d.getFullYear();
		var weekday=d.getDay();
		var weeks=[];
		weeks[0]='周日';
		weeks[1]='周一';
		weeks[2]='周二';
		weeks[3]='周三';
		weeks[4]='周四';
		weeks[5]='周五';
		weeks[6]='周六';
		var month=(d.getMonth())+1;	
		var day=d.getDate();	
		var yangli=year+'年'+month+'月'+day+'日';
		try{
			$g('show_date_div').innerHTML='<a href="http://wannianli.duapp.com/index.html?bd_user=3474266034&bd_sig=f5f6619bfdf50bc62e1d199" target="_blank">'+yangli+' '+weeks[weekday]+' <span>('+nongli+')</span></a>';
		}catch(e){}
	}
};
//MM_obj={}
function MM_over(mmObj) {
	hostobj[mmObj].show=true;
	clearTimeout(hostobj[mmObj].settime);
	hostobj[mmObj].settime=setTimeout('if(hostobj['+mmObj+'].show==true)hostobj['+mmObj+'].className = "active"',500);
}
function MM_out(mmObj) {
	hostobj[mmObj].show=false;
	clearTimeout(hostobj[mmObj].settimehide);
	hostobj[mmObj].settimehide=setTimeout('if(hostobj['+mmObj+'].show==false)hostobj['+mmObj+'].className = "";',500);
}
var MYNOTICE={
	showNotice:function(){
		if(UtilTool.getCookie("ienoclose")=="" && (UtilTool.getCookie("notictimes")=="" || parseInt(UtilTool.getCookie("notictimes"))<3)){
			
			if(Math.random()>0.5){
				$g('set_notice').style.left="560px";
				$g('notic_me1').innerHTML="休息一下，";
				$g('notic_me2').innerHTML="海量小游戏等你来玩！";
			}
			$g('set_notice').style.display="";
			var times=0;
			if(UtilTool.getCookie("notictimes")==""){
				times=1;
			}else{
				times=parseInt(UtilTool.getCookie("notictimes"));
				times++;
			}

			UtilTool.setCookie("notictimes",times,365*24);
		}
	},
	hideNotice:function(){
		$g('set_notice').style.display="none";
		UtilTool.setCookie("ienoclose",1);
	}
}
