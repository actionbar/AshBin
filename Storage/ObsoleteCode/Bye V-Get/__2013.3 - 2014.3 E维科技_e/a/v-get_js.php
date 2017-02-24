<?php
if(empty($_GET['vp'])||'e.v-get.com'!=$_GET['vp']){exit;}
?>
<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>E维科技JS详解_V-Get!</title><style type="text/css"></style></head><body>
<div class="w">
<p>var O=false,I=true,$2='http://',$3=window,$4=document,$5=$3.location,$7="click",$8="mouseover",$9="mouseout";</p>
<p>$i(i){return parseInt(i)}</p>
<p>$p(s,p){return s.split(p)}</p>
<p>$r(s=字符串,a=被替换,b替换成)  这里对\r\n已经进行替换了，所以对于需要包含\r\n的替换不能用这个 </p>
<p>$s(x,f,l){return x.substr(f,l)}</p>
<p>$x(s,x,f){return s.indexOf(x,f|0)}</p>
D(o)  o.style.display=none;
D(o,I) o.style.display:block
L(s)  s.length
$l(s)  s.toLowerCase()
$l(s,I) 返回域名， e.v-get.com => v-get.com
T(s)     s!=null&&L(s)>0  返回true  
T(s,t)   t= 1='undefined',2='boolean',3='number',4='string',5='object',6='function' 判断s的属性是不是t
$g(o,a) o.getAttribute(a)
$g(o,a,v) o.setAttribute(a,v)
//浏览器 一个字母 + 版本 ，   ie= i  chrome=c firefox=f opera=o safari=s
IE()  整数版本，比如 i9 i8 i6  c24
IE(I) 具体版本 i9.0 i8.0 i6.0 c24.0.1312.57
S(o,a)  获取o.css样式  S($('love'),'height')  S(o,'margin')
SP(o,x=背景x位置，整数,y=背景y位置，整数)   o.style.backgroundPositionX=x;o.style.backgroundPositionY=y
$C(e=新建元素，默认'div',g=属性，如'id=newidv'或者'class=newdiv',h=H(新建的元素o,h),p=新建的位置，默认$4.body)   $C('','','html')  新建一个&lt;div&gt;html&lt;/div&gt;   $C('span','class=love','I love you',$('^body')[0]))  在$('^body')[0]) 下，建一个&lt;span class="love"&gt;I love you&lt;/span&gt;
Z(h)  对聊天弹出框的，以后用于再修改
//获取 location.search的 某个参数  v-get.com/s?l=1&k=我爱你   location.search  就是 ?l=1
$k('k') ==>得到  我爱你   
$k('k',I) ==>得到   %E6%88%91%E7%88%B1%E4%BD%A0;
// 可以获取一个链接的参数
$k('sk',O,'http://e.v-get.com/s?ie=utf8&sk=love');  得到 love
$k('sk',I,'http://e.v-get.com/s?ie=utf8&sk=我爱你');  得到 %E6%88%91%E7%88%B1%E4%BD%A0
$K(o,s=kewords，用,隔开)  $K($('c'),'义乌市,南京市'); 将$('c')中的 义乌市 南京市替换成红色
$D();
C(o) o.className
C(o,s) o.className=s
F(a=数组,f=function(a数组的分值 k,顺序 i),y 其实i，默认0,z 获取a的长度 默认全部) 
H(o,s) o.innerHTML=s

$(idname)   获取idname的元素， $('love')  = document.getElementById('love');
$(idname,o = object)  获取o.$(idname)  $('love',$('ok')) = $('ok').$('love')
$('^tagname')  获取tagname  <strong>返回数组</strong> $('^a') 返回所有的&lt;a href=""&gt; 元素
$('idname^tagName')    $('love^a') 获取所有$('love')下的a标签数组
$('^tagName',o)  $('^a',$('love'))   获取所有$('love')下的a标签数组
$('love^tagName',$('ok')) 获取$('ok')下的 $('love') 下的所有a标签数组
$('^tagName.className') 获取className的 标签 $('^span.right') 获取所有&lt;span class="right someothercalssname"&gt; 包含right class的span标签，这个class只需要包含，不一定等于。如&lt;span class="right test test2"&gt;  这样可以可以
$L(l) v-get跳转链接 ，外链返回http://s.v-get.com/l?l=
B();
A(o = $('o^a')数组,t =默认'_blank' '_self' 等，也可以是iframe的name，如果为'_'，一般是让当前_blank不需要再替换 ,y =起始a数序，默认0,z a长度，默认全部)  不会对当前href为当前域名的操作
A()  将所有a 没有target的的替换成target="_blank"
A('n','_self',3) 将$('n^a')[3]到底的a的target="_self"
A('lt','_') 将 所有$('n^a')的target="_blank",并且设置_blank="_"
A('lt','_');A(); 这样是将所有非$('lt^a')的a替换，但是不替换$('lt^a')里面
K(k)  getCookie(k)
K(k,v) setCookie(k,v,9)  默认9天
K(k,v,d) setCookie(k,v,cookies时效，天数)
//Ajax post
$A(l=ajax链接,v=参数，第一个参数是v,o=o.html为ajax返回值,f=function(ajax页面返回html))  v='v='  
$A('http://e.v-get.com/ajax.php','100&b=300',$('ajaxhtml')) 
  post v=100&b=300到ajax链接，之后将返回的页面放到$('ajaxhtml')
$A('ajax.php',100,O,function(h){H($('ajaxhtml'),h)})，这个o=false，不过用后面的函数执行了，所以这个和上面的性质一样
$m(o,g=1 获取o宽度||g=0 获取o高度) 获取o 包含border的高度或宽度，返回整型， $S(o,'width') 是返回不含边框的，带'px'结尾的值，而不是整型
MD() 匹配M(o,p,v,t,e,f) 里面的f
M(o=ul外面div的object（o的属性必须是overflow:hidden）,p=方向(0上,1右,2下,3左),v=几微秒移动1px || 每微秒移动距离,t=间隔微秒,e=是否是自动,f=function || 每次转动上移数量)  设置滚动
N(t默认60,z默认6,d=$('da^')，默认d=n也就是$('na^'),f)   目录下滑，右边对齐参数 t*i+z 
$M(); 
</div><div style="display:none"></div>
</body></html>