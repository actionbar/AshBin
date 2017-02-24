var O=false,I=true,$2='http://',$3=window,$4=document,$7="click",$8="mouseover",$9="mouseout";
function $g(o,v){return o.getAttribute(v)}
function N(s,b){var d=s!=null?I:O;if(!b)d=(d&&(L(s)>0||s>0||s))?I:O;return d}
function $l(s){return s.toLowerCase()}
function T(s,t){return (t>0)?(($l(typeof(s))==['','undefined','boolean','number','string','object','function'][t])?I:O):((s!=null&&L(s)>0)?I:O)}
function $i(i){return parseInt(i)}
function $o(f,t,i){return i?setInterval(f,t):((T(t,3))?setTimeout(f,t):(t?clearInterval(f):clearTimeout(f)))}
function $p(s,p){return s.split(p)}
function $r(s,a,b){return s.replace(/[\r\n]/g,'').replace(a,b)}
function $s(x,f,l){return x.substr(f,l)}
function S(o,a){return o.currentStyle?o.currentStyle[a]:$4.defaultView.getComputedStyle(o,O)[a]}

function $x(s,x,f){return s.indexOf(x,f|0)}
function D(o,b){o.style.display=b?'block':'none'}
function L(s){return s.length}
function $k(c,d){var r='';c+="=";F($p($s(location.search,1),'&'),function(i){if(c==$s(i,0,L(c)))r=$s(i,L(c));});return T(r)?(d?r:decodeURI(r)):O}


function $D(i,r){var s=i+'a',a=$(s+'^a'),g,c;F(a,function(o,I){if(I>0)D(r[I]);E(o,$8,function(){g=this;F(a,function(v,j){c=C(v);D(r[j]);C(v,$r(c,' '+s,''));if(v==g){D(r[j],1);C(v,c+' '+s)}})})})}

function SP(o,x,y){o.style.backgroundPositionX=x;o.style.backgroundPositionY=y;o.style.backgroundPosition=x+" "+y}
function C(o,s){if(T(s,4))o.className=s;else return o.className}
function F(a,f,y,z){for(var i=y||0;i<(z||L(a));i++)f(a[i],i)}
function E(o,t,f){if($4.addEventListener)o.addEventListener(t,f,O);else o.attachEvent('on'+t,function(){return f.call(o,$3.event)})}
function H(o,s){if(!T(s,1))o.innerHTML=s;else return o.innerHTML}
function $(i,o){var s=$p(i,'^'),a=s[0],g=function(x){return $4.getElementById(x)},r=T(a)?g(a):O;if(T(s[1])){var c=$p(s[1],'.'),d=c[0],e=c[1],v=[];o=o?o:$4;o=r?r:o;r=o.getElementsByTagName(d);if(T(e)){F(r,function(o){F($p(C(o),' '),function(c){if(c==e){v=v.concat(o);return}})});r=v}}return r}
function B(a,b,c,d,e){
var i,g=$('eb');
if(a){
function f(o,u,v,w){if($s(u,0,1)=='#')o.style.backgroundColor=u;else if($x(w))C(o,$r(C(o),w,u));else C(o,C(o)+' '+u);if(T(v))o.style.color=v}
F(a,function(o){
if($l(o.tagName)=="input"){
if(T(o.placeholder)){
E(o,$7,function(){i=this;if(!T(i.value)){i.setAttribute('h',i.placeholder);i.placeholder="";f(i,b,c,d)}});
E(o,$9,function(){i=this;if(!T(i.value)){if(T($g(i,'h')))i.placeholder=$g(i,'h');f(i,d,e,b)}});
E(o,$8,function(){f(this,b,c,d)});
}}
else {E(o,$9,function(){f(this,d,e,b)});E(o,$8,function(){f(this,b,c,d)});}})
}
else {if(g)D(g,1);else{g=$4.createElement("div");g.setAttribute("id",'eb');$4.body.appendChild(g);}


}

}

function A(o,t,y,z){var k='_blank',h,g,l;F($((T(o)?o:'')+"^a"),function(i){h=i.href;g=i.target;l='s.v-get.com/l?l=';if($s(h,-1)=="#"){h="javascript:void(0)";i.href=h}if(($s(h,0,7)==$2&&$p(h,"#")[0]!=$4.URL)&&(!T(g)||g==k)){i.target=(T(t)?t:k);if($x(h,l)>0){h=$r(h,/%\w{2}/g,function(a){return String.fromCharCode($i('0x'+$s(a,1)))});i.href=$r(h,l,'')}}},y,z)}

 
function K(k,v,d){var x=$4.cookie,c,e,t=new Date();if(!T(v,1)){t.setDate(t.getDate()+d);$4.cookie=k+"="+escape(v)+";expires="+t.toGMTString()}else{if(T(x)){c=$x(x,k+"=");if(c!=-1){c=c+L(k)+1;e=$x(x,";",c);if(e==-1)e=L(x);return unescape(x.substring(c,e))}}return ""}


}

function $A(l,v,o,f){var a=null,s,h;try{a=new XMLHttpRequest()}catch(e){try{a=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){a=new ActiveXObject("Microsoft.XMLHTTP")}}a.onreadystatechange=function(){s=a.readyState;if(s==4||s=="complete"){h=a.responseText;if(o)H(o,h);if(f)f(h)}};a.open("POST",l,true);a.setRequestHeader("Content-Type","application/x-www-form-urlencoded");a.send("v="+v)}



function M(o,p,v,t,e,f){ 
var s=I,g=p%2,a=$('^li',o)[0],pt='Top',pr='Right',pb='Bottom',pl='Left',pw='Width',ph='Height',pd='border',ps='scroll',d=ps+[pt,pl][g],k,y;o[d]=0;
function x(x){if(x)o[d]-=e?1:v;else o[d]+=e?1:v}


 E(o,$8,function(){if(e)return s=O;else{$o(y);k=$o(x,t,1)}});
 E(o,$9,function(){if(e)return s=I;else{$o(k);y=$o(function(){x(I)},t,1)}});
 if(e){
 



var c,cf,w,u=$('^ul',o)[0],k=H(u),b,r,q=0,z=(p>0&&p<3)?I:O,l=function(m){if(z)return m<1?I:O;else return m>=w/2?I:O /*这里的w/2不能换成j*/},h=function(h){return $i($r(S(a,h),/(\d+)px/,'I'))};

if(g>0){c=h($l(pw))+h(pd+pl+pw)+h(pd+pt+pw);c=c>0?c:$i(a.offsetWidth);F($('^li',o),function(o){q+=c});u.style.width=q*2+"px";}
else{c=h($l(ph))+h(pd+pb+pw)+h(pd+pt+pw);c=c>0?c:$i(a.offsetHeight);F($('^li',o),function(o){q+=c});u.style.height=q*2+"px";}

H(u,k+k); 
w=o[ps+[ph,pw][g]],j=z?w:0;o[d]=j/2;
 cf=(T(f,3)?f:1)*c;
 b=function(){if(s){if(T(f,6))f(c);x(z)};y=$o(r,v,I)};
 r=function(){if(o[d]%cf>0){x(z);if(l(o[d]))o[d]=j}else{$o(y);$o(b,t)}};$o(b,t)}}
 function J(l,f,o){var s=$4.createElement("script");s.type="text/javascript";
        if(s.readyState){s.onreadystatechange=function(){if(s.readyState=="loaded"||s.readyState=="complete"){s.onreadystatechange=null;f()}}}
        else {
           s.onload=function(){f()}
        }
         s.src=l;(o||$("^head")[0]).appendChild(s);
      }
	  
	

function $S(k,c){
var b='',d=' ',v=k.value,z=9,r=[/^\s+|\s+$/g,/\s{2,}/g,/[，。、￥……×～（）『』【】；：‘“”’《》？！—\ |\~\`\!\@\#\$\%\^\&\*\(\)\-\_\+\=\\\[\]\{\}\;\:\"\'\,\<\.\>\/\?]/g],t=[b,d,d];
var e=[RegExp('[^'+r[2]+'\s]','g'),/^[\w\.\-]+\@([\w\-]+\.)+([a-z\d]{2,4})+$/,/^\d{11}$/];
if(c){
F(e,function(a,i){if(a.test($l(v)))z=i});return z}
else {F(r,function(a,i){v=$r(v,a,t[i])});k.value=v}
}


 
 

(function () {
  var i=0,e=!!($3.attachEvent&&!$3.opera),w=/webkit\/(\d+)/i.test(navigator.userAgent)&&(RegExp.$1<525),a=[];
  var run=function(){for(i;i<L(a);i++)a[i]()},d=$4,t;
  d.ready=function (f) {
    if(!e&&!w&&d.addEventListener)return d.addEventListener('DOMContentLoaded',f,O);
    if(a.push(f)>1)return;
    if(e)(function (){try {d.documentElement.doScroll('left');run()}catch(err){setTimeout(arguments.callee,0)}})();
    else if(w)var t=setInterval(function(){if(/^(loaded|complete)$/.test(d.readyState))clearInterval(t);run()},0);
  };
})();





(function(){
$4.ready(function(){
	F($('^*'),function(o){
	var q=$g(o,'q'),x=$g(o,'o'),v=$g(o,'v'),i=$g(o,'i'),a=$g(o,'a'),l='"><img src="'+$2;
	if(T(q)){
	var q=$p(q,'^'),s='',h='height="',w='" width="';
		   for(var j in q){
			   s+='<a target="_blank" href="';
		       var c=$s(q[j],1); 
	           switch($s(q[j],0,1)){case 'K':s+=c+l+'weigeti.com/i0/qk.png" '+h+'21'+w+'21';break;case 'M':s+='msnim:chat?contact='+c+l+'weigeti.com/i0/qm.png" '+h+'21'+w+'21';break;case 'E':s+='mailto:'+c+l+'weigeti.com/i0/qe.gif" '+h+'21'+w+'21';break;case 'D':s+=$2+'j.map.baidu.com/'+c+l+'weigeti.com/i0/qd.gif" '+h+'21'+w+'21';break;case 'W':s+=$2+''+c+l+'weigeti.com/i0/qw.gif" '+h+'21'+w+'21';break;case 'Q':s+=$2+'wpa.qq.com/msgrd?v=3&uin='+c+'&site=v-get&menu=yes'+l+'wpa.qq.com/pa?p=1:'+c+':45" '+h+'21'+w+'21';break;case 'A':s+=$2+'www.taobao.com/webww/ww.php?ver=3&touid='+c+'&siteid=cntaobao&status=2&charset=utf-8'+l+'amos.alicdn.com/realonline.aw?v=2&uid=gotwu&site=cntaobao&s=2&charset=utf-8" '+h+'16'+w+'16';break;case 'S':s+='skype:'+c+'?call" on-click="return skypeCheck();'+l+'mystatus.skype.com/smallicon/'+c+'" '+h+'16'+w+'16';break;}
				s+='" /></a>';
             }H(o,s)
	}
    if($i(v)>0&&$l(o.tagName)=='a'){o.style.background="url(http://weigeti.com/i0/p.gif) 0 -"+(128+v*25)+"px no-repeat";o.href="#";o.style.width="16px";o.style.height="16px"}
	
	if($i(x)>49)(function(){var i=3,e,y;for(i;i>-1;i--){e=Math.pow(6,i)*50;y=x/e;if(y>=1){o.style.width=$i(y)*16+"px";o.style.height="16px";o.style.background="url(http://weigeti.com/i0/o.gif) 0 -"+i*16+"px repeat-x";return O}x=x%e}})();
	if(T(i))o.src=i;
	if(T(a)){H(o,'<a href="#"><img src="http://weigeti.com/i8/'+a+'/'+$i(Math.random()*3)+'.gif"/></a>')}
	
	})
(function $e(){
l=$4.URL;
function f(u){
F($("^a.e"),function(o){
H(o.parentNode,'<a href="#" class="fh" style="font-size:12px" title="'+u+'">'+u+'</a><a href="http://localhost/i.v-get.com/e/SignOut.html?lk='+l+'" style="font-size:12px" onclick="javascript:K(\'EU\',0,0);$3.location.href=this.href;return false">退出</a>');
})
}
if(T(K('EU'))){f(K('EU'),l);}
if(!K('EO')){
var d=new Date();
J("http://localhost/i.v-get.com/j/SignBar?r="+d.getTime(),function(){
if(N($EU)){f($EU,l);K('EU',$EU,31);}});
}



})();


F($("^a.e"),function(o){E(o,$7,function(){
var x,y,o=$('e');


function d(){
    B();D(o,1);
     o.style.left=($4.documentElement.clientWidth-o.clientWidth)/2+$4.documentElement.scrollLeft+"px"; 
	 o.style.top=($4.documentElement.clientHeight-o.clientHeight)/2+$4.documentElement.scrollTop-50+"px";                             
	 }                                

if(o)d();
else{

o=$4.createElement("div");
o.setAttribute("id",'e');
H(o,'<div class="et"><span class="p">登录</span><span class="q"></span></div><form action="http://localhost/i.v-get.com/e/SignIn?lk=http://localhost/wuliu.v-get.com/506" method="post"><div><label>帐号</label><input type="text" placeholder="用户名/邮箱/手机号码" name="su" class="es"/></div><div><label>密码</label><input type="password" name="sp" class="es"/></div><div class="er"><input type="checkbox" checked="checked" name="sr"/>记住我的登录状态</div><div class="eb"><input type="submit" value="登录"/><a href="#">忘记密码？</a></div><div class="er">还没有V-Get!帐号？<a href="#">立即注册</a></div></form>');
$4.body.appendChild(o); 
d();

$("e^div")[0].onmousedown=function(e){if(!e)e=$3.event;x=e.clientX-$i(o.style.left);y=e.clientY-$i(o.style.top);$4.onmousemove=function(ev){if(ev==null)ev=$3.event;o.style.left=(ev.clientX-x)+"px";o.style.top=(ev.clientY-y)+"px"}};$4.onmouseup=function(){$4.onmousemove=null}
E($("e^span.q")[0],$7,function(){D(o);D($('eb'))});

$('e^form')[0].onsubmit=function(){

K('EO',0,0);
}

} 


})});





});
})();