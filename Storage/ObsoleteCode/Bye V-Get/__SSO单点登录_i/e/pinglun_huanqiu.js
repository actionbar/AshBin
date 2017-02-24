	document.getElementById("commentJs").parentNode.style.width = $("#commentJs").parent().width()+"px";
var winLocalUrl = window.location.href;
winLocalUrl = winLocalUrl.split(".html")[0]+".html";//获取当前页面的.html网址
var frame_content_src = "http://comment.huanqiu.com/commentiframe.html"
if(document.domain!="c.huanqiu.com"){document.domain = 'huanqiu.com';}
if(document.getElementById("commentPopLogin")){
	//写入comment_poplogin.css样式;
	var comment_pop_css = '<link href="http://himg2.huanqiu.com/css/comment_poplogin.css" rel="stylesheet" type="text/css" media="all">';
	//写入iframe和锚点;
	var addCommentCon = '<a id="comment" name="comment"></a><iframe id="frame_content" width="100%" scrolling="no" height="185" frameborder="0" name="frame_content" src="'+frame_content_src+'" ></iframe>';
	//写入登录窗口;
	var loginConDom = '<div class="loginMain"><form action="" method="post" onsubmit="javascript:return false;"><strong>已有环球网账号或邮箱，可直接登录</strong><ul><li><label>账 号：</label><input id="username" class="text" type="text" name="username" value="用户名 / 邮箱登录"></li><li><label>密 码：</label><input id="password" class="text" type="password" name="password" value=""></li></ul><span><input name="submit" type="submit" value="登录" /><a href="http://passport.huanqiu.com/user.php?a=forget" target="_blank">找回密码</a><i class="zhedang"></i></span><b class="tishi">请登录后发言，并遵守<a href="http://passport.huanqiu.com/template/user/protocol.html" target="_blank">相关规定</a></b></form></div>';
	var rapidReg = '<div class="rapidReg"><i>还没有环球网账号？</i><span><a href="http://passport.huanqiu.com/user.php?a=register&winUrls='+window.parent.winLocalUrl+'">快速注册</a></span></div>';
	var loginCon = '<div class="login"><h3><b class="title">用户登录</b><b class="close">关闭</b><span class="quickLogin"><i>使用其他账号登录：</i><em class="sina"></em><em class="txWeibo"></em><em class="sohuWeibo"></em><em class="QQkongjian"></em><em class="renren"></em><em class="google"></em></span></h3>'+loginConDom+rapidReg+'</div>';
	//页面上有id为commentPopLogin的div时添加元素
	document.write(comment_pop_css);//添加登录窗口css样式
	document.write(addCommentCon);//添加iframe和锚点元素	
	document.getElementById("commentPopLogin").innerHTML = loginCon;//添加登录窗口;
	//按钮点击事件
	$("#username").focus(function(){
		if($(this).val()=="用户名 / 邮箱登录"){$(this).val("");}
		$(this).css("background","#fffbe8");
		$("#commentPopLogin .login .loginMain strong").text("已有环球网账号或邮箱，可直接登录");
		$("#commentPopLogin .login .loginMain strong").css("color","#888");	
	});
	$("#username").blur(function(){
		if($(this).val()==""){$(this).val("用户名 / 邮箱登录");}
		$(this).css("background","#fff");
	});
	$("#password").focus(function(){$(this).css("background","#fffbe8");$("#commentPopLogin .login .loginMain strong").text("已有环球网账号或邮箱，可直接登录");	$("#commentPopLogin .login .loginMain strong").css("color","#888");	});
	$("#password").blur(function(){$(this).css("background","#fff");});
	$("#commentPopLogin .login .loginMain input:last").click(function(){
		var userName = $("#username").val();
		var passWord = $("#password").val();
		$("#frame_content")[0].contentWindow.loginAjax(userName,passWord);
	});
	$("#commentPopLogin .rapidReg span a").click(function(){loginPopClose();});
	$("#commentPopLogin .login h3 b.close").click(function(){loginPopClose();});
	//登录弹出窗口快速登录响应；
	//点击快速登录
	$('#commentPopLogin .login h3 span.quickLogin em.sina').click(function(){sina();loginPopClose();});
	$('#commentPopLogin .login h3 span.quickLogin em.txWeibo').click(function(){qq();loginPopClose();});
	$('#commentPopLogin .login h3 span.quickLogin em.sohuWeibo').click(function(){sohu();loginPopClose();});
	$('#commentPopLogin .login h3 span.quickLogin em.QQkongjian').click(function(){zone();loginPopClose();});
	$('#commentPopLogin .login h3 span.quickLogin em.renren').click(function(){renren();loginPopClose();});
	$('#commentPopLogin .login h3 span.quickLogin em.google').click(function(){google();loginPopClose();});
	isAnchorFun();
}else{
var loadComment = function(){	
	if(document.readyState=="complete"){
		//写入iframe和锚点;
		var addCommentJsWarp = document.getElementById("commentJs").parentNode;
		var commentAnchor=document.createElement("a");
		commentAnchor.id = commentAnchor.name = "comment";
		var commentIframe = document.createElement("iframe");
			commentIframe.id = commentIframe.name = "frame_content";commentIframe.width = "100%";commentIframe.height = "185";commentIframe.scrolling = "no";commentIframe.frameBorder = "0";
		commentIframe.src = frame_content_src;
		addCommentJsWarp.appendChild(commentAnchor);
		addCommentJsWarp.appendChild(commentIframe);
		//登录弹窗css样式添加
		var comment_poplogin_css=document.createElement("link");
			comment_poplogin_css.href="http://himg2.huanqiu.com/css/comment_poplogin.css";comment_poplogin_css.rel="stylesheet";comment_poplogin_css.type="text/css";comment_poplogin_css.media="all";
		document.getElementsByTagName("head")[0].appendChild(comment_poplogin_css);		
		//登录弹出窗口html代码添加
		$("body").append('<div id="commentPopLogin"><div class="login"><h3><b class="title">用户登录</b><b class="close">关闭</b><span class="quickLogin"><i>使用其他账号登录：</i><em class="sina"></em><em class="txWeibo"></em><em class="sohuWeibo"></em><em class="QQkongjian"></em><em class="renren"></em><em class="google"></em></span></h3></div></div>');
		var loginCon = '<div class="loginMain"><form action="" method="post" onsubmit="javascript:return false;"><strong>已有环球网账号或邮箱，可直接登录</strong><ul><li><label>账 号：</label><input id="username" class="text" type="text" name="username" value="用户名 / 邮箱登录"></li><li><label>密 码：</label><input id="password" class="text" type="password" name="password" value=""></li></ul><span><input name="submit" type="submit" value="登录" /><a href="http://passport.huanqiu.com/user.php?a=forget" target="_blank">找回密码</a><i class="zhedang"></i></span><b class="tishi">请登录后发言，并遵守<a href="http://passport.huanqiu.com/template/user/protocol.html" target="_blank">相关规定</a></b></form></div>';
		var rapidReg = '<div class="rapidReg"><i>还没有环球网账号？</i><span><a href="http://passport.huanqiu.com/user.php?a=register&winUrls='+window.parent.winLocalUrl+'">快速注册</a></span></div>';
		$('#commentPopLogin .login').append(loginCon);
		$('#commentPopLogin .login').append(rapidReg);
		//按钮点击事件
		$("#username").focus(function(){
			if($(this).val()=="用户名 / 邮箱登录"){$(this).val("");}
			$(this).css("background","#fffbe8");
			$("#commentPopLogin .login .loginMain strong").text("已有环球网账号或邮箱，可直接登录");
			$("#commentPopLogin .login .loginMain strong").css("color","#888");	
		});
		$("#username").blur(function(){
			if($(this).val()==""){$(this).val("用户名 / 邮箱登录");}
			$(this).css("background","#fff");
		});
		$("#password").focus(function(){$(this).css("background","#fffbe8");$("#commentPopLogin .login .loginMain strong").text("已有环球网账号或邮箱，可直接登录");	$("#commentPopLogin .login .loginMain strong").css("color","#888");	});
		$("#password").blur(function(){$(this).css("background","#fff");});
		$("#commentPopLogin .login .loginMain input:last").click(function(){
			var userName = $("#username").val();
			var passWord = $("#password").val();
			$("#frame_content")[0].contentWindow.loginAjax(userName,passWord);
		});
		$("#commentPopLogin .rapidReg span a").click(function(){loginPopClose();});
		$("#commentPopLogin .login h3 b.close").click(function(){loginPopClose();});
		//登录弹出窗口快速登录响应；
		//点击快速登录
		$('#commentPopLogin .login h3 span.quickLogin em.sina').click(function(){window.parent.sina();loginPopClose();});
		$('#commentPopLogin .login h3 span.quickLogin em.txWeibo').click(function(){window.parent.qq();loginPopClose();});
		$('#commentPopLogin .login h3 span.quickLogin em.sohuWeibo').click(function(){window.parent.sohu();loginPopClose();});
		$('#commentPopLogin .login h3 span.quickLogin em.QQkongjian').click(function(){window.parent.zone();loginPopClose();});
		$('#commentPopLogin .login h3 span.quickLogin em.renren').click(function(){window.parent.renren();loginPopClose();});
		$('#commentPopLogin .login h3 span.quickLogin em.google').click(function(){window.parent.google();loginPopClose();});	
		isAnchorFun();		
	}else{
		var loadCommentT = setTimeout(loadComment,1);
	}
}
var loadCommentT = setTimeout(loadComment,1);
}
//登录弹出窗口函数设置;
function popLoginWin(){
	if($(document).scrollTop()==0){
		 $("html, body").animate({ scrollTop: 0 }, 120);
	}
	if($("#commentPopLogin .bgwarp").length<1){
		$("#commentPopLogin").prepend('<div class="bgwarp"></div>');
		$("#commentPopLogin .bgwarp").fadeTo(200,0.2);	
		setUpSizeposition(true);
		window.onresize=setUpSizeposition;
	}
}
var setUpSizeposition=function(winshow){			
	var popDiv = $("#commentPopLogin .login");
	popDiv.find("input").css("outline","none");
	var maxH = $(document).height()+"px";
	if($(window).width()<980){
		var maxW = "980px";
	}else{
		var maxW = $(window).width()+"px";
	}
	if(winshow==true){
		$("#commentPopLogin").css({"width":maxW,"height":maxH,"display":"block"});
	}else{		
		$("#commentPopLogin").css({"width":maxW,"height":maxH});
	}
	var winX = ($(window).width()- popDiv.width())/2 + "px";
	var winY = ($(window).height()- popDiv.height())/2 + $(document).scrollTop() + "px";
	$("#commentPopLogin .bgwarp").css({"width":maxW,"height":maxH});
	popDiv.css({"left":winX,"top":winY});
	document.getElementById("username").focus();
}

function loginIsDisabled(condition){
	if(condition==true){
		$("#commentPopLogin .login .loginMain span i.zhedang").css("display","block");//将按钮禁用
	}else if(condition==false){
		$("#commentPopLogin .login .loginMain span i.zhedang").css("display","none");//将按钮可用
	}
}
//登录弹出窗口登录报错执行函数
function loginPopError(err){
	//错误提示为0和-2时为用户名或者密码为空;-1为用户名和密码不匹配，-3为当用户连续输入错误5次后在15分钟内禁止操作登录；
	if(err==0 || err==-2){
		$("#commentPopLogin .login .loginMain strong").text("用户名/邮箱或密码不能为空");
		$("#commentPopLogin .login .loginMain strong").css("color","red");
	}else if(err==-1){
		$("#commentPopLogin .login .loginMain strong").text("用户名/邮箱或密码不正确");
		$("#commentPopLogin .login .loginMain strong").css("color","red");
	}else if(err==-3){
		$("#commentPopLogin .login .loginMain strong").text("输入不正确，请15分钟后再登录");
		$("#commentPopLogin .login .loginMain strong").css("color","red");
	}else if(err=="timeout"){
		$("#commentPopLogin .login .loginMain strong").text("登录超时，请再次尝试登录");
		$("#commentPopLogin .login .loginMain strong").css("color","red");
	}else if(err=="sessionTimeout"){
		$("#commentPopLogin .login .loginMain strong").text("您长时间没有操作，请重新登录");
		$("#commentPopLogin .login .loginMain strong").css("color","red");
	}else if(err=="loadingStart"){
		var thisTxtCon = '<img src="http://himg2.huanqiu.com/images/comment_v4/before.gif" /> 正在为您努力加载，请稍后...'
		$("#commentPopLogin .login .loginMain strong").html(thisTxtCon);
		$("#commentPopLogin .login .loginMain strong").css("color","#888");	
	}
}
//登录弹出窗口设置关闭函数;
function loginPopClose(){
	$("#commentPopLogin .bgwarp").fadeTo(200,0,function(){
		$("#commentPopLogin .bgwarp").remove();
		$("#commentPopLogin").hide();	
		$("#username").val("用户名 / 邮箱登录");
		$("#password").val("");
		$("#commentPopLogin .login .loginMain strong").text("已有环球网账号或邮箱，可直接登录");
		$("#commentPopLogin .login .loginMain strong").css("color","#888");	
		window.onresize = null;
	});	
}

//添加评论参与数量
function commentNumb(numb){
	if(numb){
		var thisText = '<a href="#comment">'+numb+'</a>';
		$("#msgNumTop").removeClass("noMsg").addClass("msgNum");
		$("#msgNumTop").html(thisText);
		$("#msgNumBottom").removeClass("noMsg").addClass("msgNum");
		$("#msgNumBottom").html(thisText);
	}else{
		var thisText = '<a href="#comment">我有话说</a>';
		$("#msgNumTop").removeClass("msgNum").addClass("noMsg");
		$("#msgNumTop").html(thisText);
		$("#msgNumBottom").removeClass("msgNum").addClass("noMsg");
		$("#msgNumBottom").html(thisText);
	}
	$("#msgNumTop").css("display","inline-block");
	$("#msgNumBottom").css("display","inline-block");
}
//快速登录函数
function zone() {
	var A=window.open("http://passport.huanqiu.com/open.php?a=qq&from=comment&url="+document.location.href,"TencentLogin","width=600,height=450,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
function qq() {
	var A=window.open("http://passport.huanqiu.com/open.php?a=qqt&from=comment&url="+document.location.href,"TencentLogin","width=600,height=450,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
	
function renren() {
	var A=window.open("http://passport.huanqiu.com/open.php?a=rr&from=comment&url="+document.location.href,"TencentLogin","width=600,height=450,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
function sina() {
	var A=window.open("http://passport.huanqiu.com/open.php?a=sina&from=comment&url="+document.location.href,"TencentLogin","width=600,height=450,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
function sohu() {
	var A=window.open("http://passport.huanqiu.com/open.php?a=sohu&from=comment&url="+document.location.href,"TencentLogin","width=600,height=450,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
	
function google() {
	var A=window.open("http://passport.huanqiu.com/open.php?a=google&from=comment&url="+document.location.href,"TencentLogin","width=600,height=450,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
}
//第三方登录成功后关闭open页面引用该函数改变登录状态
function otherLogin(){
	document.getElementById('frame_content').contentWindow.loginAjaxSucceed();
	cookie_select();
}
//跳转到锚点函数
function jumpAnchor(){document.location.hash="comment"}
//获取Cookie值函数
function getCookie(c_name){
	if(document.cookie.length>0){
	   c_start=document.cookie.indexOf(c_name + "=")
	   if(c_start!=-1){ 
		 c_start=c_start + c_name.length+1 
		 c_end=document.cookie.indexOf(";",c_start)
		 if(c_end==-1) c_end=document.cookie.length
		 return decodeURI(document.cookie.substring(c_start,c_end))
	   }
	}
	return "";
}
function isAnchorFun(){
	var searchAnchor = new RegExp("#comment");
	var isAnchor = searchAnchor.test(window.location.href);
	function getJumpAnchor(){
		if(jumpAnchorNumbs<2){
			jumpAnchor();
			var jumpAnchorT = setTimeout(getJumpAnchor,1200);
		}else{
			clearTimeout(jumpAnchorT);
		}
		jumpAnchorNumbs+=1;
	}
	if(isAnchor){
		var jumpAnchorNumbs = 0;
		getJumpAnchor();
	}
}