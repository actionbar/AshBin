


/*****************************************登录弹出框*************************************/	
(function $e(){
l=$4.URL;
function f(u){
F($("^a.e"),function(o){
H(o.parentNode,'<a href="#" class="fh" style="font-size:12px" title="'+u+'">'+u+'</a><a href="#SignOut.html?lk='+l+'" style="font-size:12px" onclick="javascript:K(\'EU\',0,0);$5.href=this.href;return false">退出</a>');
})
}
//如果有EU，登录
if(T(K('EU'))){f(K('EU'),l);}
//如果有EO，表示不会登录，没有EO才会尝试去登录
//这里通过弹出e的submit，清除K('EO');，避免多次记载SignBar.js




})();


F($("^a.e"),function(o){E(o,$7,function(){

/*****************************************core of login*************************************/	
var x,y,o=$('e');


function d(){
    B();D(o,1);
	var e=($4.documentElement&&$4.documentElement.scrollTop)?$4.documentElement:$4.body;
     //以下部分要将弹出层居中显示
     o.style.left=$i(($4.documentElement.clientWidth-o.clientWidth)/2+e.scrollLeft)+"px"; 
	 o.style.top=$i(($4.documentElement.clientHeight-o.clientHeight)/2+e.scrollTop-50)+"px";//此处出现问题，弹出层左右居中，但是高度却不居中，显示在上部分，导致一    
    }                                

if(o)d();
else{

$C(O,"id=e",'<div class="et"><span class="p">登录</span><span class="q"></span></div><form action="#SignIn?lk=" method="post"><div><label>帐号</label><input type="text" placeholder="用户名/邮箱/手机号码" name="su" class="es"/></div><div><label>密码</label><input type="password" name="sp" class="es"/></div><div class="er"><input type="checkbox" checked="checked" name="sr"/>记住我的登录状态</div><div class="eb"><input type="submit" value="登录"/><a href="#">忘记密码？</a></div><div class="er">还没有V-Get!帐号？<a href="#">立即注册</a></div></form>');
/* 这个必须这里写一下 */
o=$('e');
d();

//以下部分实现弹出层的拖拽效果
$("e^div")[0].onmousedown=function(e){if(!e)e=$3.event;x=e.clientX-$i(o.style.left);y=e.clientY-$i(o.style.top);$4.onmousemove=function(ev){if(ev==null)ev=$3.event;o.style.left=(ev.clientX-x)+"px";o.style.top=(ev.clientY-y)+"px"}};$4.onmouseup=function(){$4.onmousemove=null}
E($("e^span.q")[0],$7,function(){D(o);D($('eb'))});
//对 submit
$('e^form')[0].onsubmit=function(){
//一旦submit就把cookie EO清空，这样才可以使前端调取 SignBar.js
K('EO',0,0);
}

} 

/*****************************************core of login*************************************/	
})});


/*****************************************登录弹出框*************************************/	