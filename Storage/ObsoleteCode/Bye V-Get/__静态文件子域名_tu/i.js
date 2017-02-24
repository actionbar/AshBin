/*
BUG解析
$r() 不能替换需要保留 换行符的字符串，一旦使用$r() 都会把换行符全部替换为空。
F()  不能做有 return  / break 的事



判断是否已经存在于数组了
function inArray(str,arr){var l=L(arr);
for(var i=0;i<l;i++){if(str==arr[i])return I;if(i==(l-1)&&str!=arr[i])return O
//这里不能用三元，因为不符合，不用返回的。否则不符合就返回了，一直不符合
}}



c.js==  英文大写单字母 + $开头两字符
独立js== 英文大写两字符 
l.js == length  包括 L8=utf8字节数    L1=一个汉字1字节，3个英文一个汉字节
伪装的js == $英文两个大写字符
  $ID=  身份证前六位

###################
i0目录下命名：  目录大写 +文件名小写 + _ + 参数
Dd1_i    i0/d/d1.js  参数i
#####################
a.js  独个页面所用   === 大写英文 +  数字（代表目录的数字的英文顺序） +小写英文/或空

页内分站
V分站缩写英文+分站id数字+命名
E维科技中  Vwd()  就是Vwd所有分站都会用的d()


$ 
V

同时设为首页现在没有浏览器支持了


C(o,s)  必须用$u(s)判断 s是否存在，因为s=0,s='' 都会出错
E(o,t,f)  html5工作组写的绑定，解决了ie attacheEvent this指向问题
H(o,s) 必须用$u(s)判断 s是否存在，因为s=0,s='' 都会出错






获取http://wuliu.v-get.com/d.php是不行的，只能获取 http://yiwu.wuliu.v-get.com/d.php或者../d.php

*/


//IU 是 IU函数，统计数据 


//false ==0  true==1这个是成立的
var O=false,I=true,$2='http://',$3=window,$4=document,$5=$3.location,$7="click",$8="mouseover",$9="mouseout";









/* ####################################Pure,Without other functions####################################*/




function $i(i){return parseInt(i)}

function $p(s,p){return s.split(p)}
//replace不能替换 换行，如果对html正则，就需要对 \n \r  转义。必须要这样才能更好的做html换行的 正则替换
//$r 会替换 换行， replace 不会替换
function $r(s,a,b){return s.replace(/[\r\n]/g,'').replace(a,b)}

//重右往左选取字符是，负数，如果单独一个$s(arr) 就是返回热荐关键词，随机输出一个
function $s(x,f,l){return T(f,3)?x.substr(f,l):x[$i(Math.random()*L(x))]}


function $x(s,x,f){return s.indexOf(x,f|0)}
function D(o,b){o.style.display=b?'block':'none'}
function L(s){return s?s.length:0}
/* ####################################Secondary,Only above##################################################*/
//$l('ABc')='abc'   $l('http://e.v-get.com/love.php',I) = v-get.com;
function $l(s,d){return d?$r(s,/(https?\:\/\/)?([\w\-]+\.)*([\w\-]+\.(?:[a-z]{2}|aero|arpa|asia|com|coop|edu|gov|idv|info|int|net|org|pro|tel|mil|museum|mobi|name|travel)(\.[a-z]{2})?)([\/].*)?$/i,'$3'):s.toLowerCase()}




//function N(s,b){var d=s!=null?I:O;if(!b)d=(d&&(L(s)>0||s>0||s))?I:O;return d}


//false ==0  true==1这个是成立的
//T(o,t) 大多数情况下比 N() 只少两个字符，但是更精确，所以放弃N()
//T(o)仅支持string  L(数字)==0  
// typeof(s)=='undefined'  可以等价于  s==null
//未定义的不能用 T,  函数内可以用 fun(s){if(T(s))}  fun()   这样是可以用的
// 而   T($LOVE)  这种是错误的，因为 $LOVE不存在，根本不存在，必须用  if(typeof($LOVE)!='undefined')


function T(s,t){return (t>0)?(($l(typeof(s))==['','undefined','boolean','number','string','object','function'][t])?I:O):((s!=null&&L(s)>0)?I:O)}
//替代 直接  x  ,这种 比直接用 if(x)好，如果 a=['abc']; if(a[1])可能会报错，避免使用不伦不类的if(x)， x只有是bolean的时候才这么用
//N(s)  s 不能为空 '' 0 null 等，数字可以  未定义
//N(s,1) s 可以为 0 '' ，不可以是未定义的就行
//L(s)>0  s不能是 数字、''、0、null等  用N(s)代替 
//if(s)  s 不能是 0 '' null   未定义  数字可以 ， 不能if(string)这样容易出错， 最适合boolean型，任何情况下都不能为 数字、''、0等  传递 id（最适用，任何情况下都不能为 数字、''、0等）    不能用于（class=''，html=''）

//用Length(300) 返回的是undefined，所以要注意
//这个对于 N(null) 返回的是true，  typeof(null)是object;不过，一般不会写null，所以这样更好

// typeof() 最好的办法是 s!=null ,因为 undefined=null
//对函数内参数判断，  '',0,O,
//要考虑跨越，比如 f(a,b,O,d)  跨域c
//f(a,b){}这里用 b==null判断，无论f(1,'')  f(1,0) f(1,false)都不满足==null，只有null，或者f(1)才满足
//所以要跳过，就用 V0代替就行
//T(判断对象，是否可以为 空 '',)
// s如果是Object/function，  L(s)>0 是false  s>0也是false 这样只能用 if(s)，不能用typeof


/* 1.类型分析：
js中的数据类型有undefined,boolean,number,string,object等5种，前4种为原始类型，第5种为引用类型。
alert(typeof a);    //显示"undefined"
var a1;                  alert(typeof a1); //显示"undefined"
var a2=true;           alert(typeof a2); //显示"boolean"
var a3=1;              alert(typeof a3); //显示"number"
var aa='';     typeof='string';
var a4="Hello";        alert(typeof a4); //显示"string"
var a5=new Object();   alert(typeof a5); //显示"object"
var a6=null;           alert(typeof a6); //显示"object"
var a7=NaN;            alert(typeof a7); //显示"number"
var a8=undefined;      alert(typeof a8); //显示"undefined" */
//undefined=null NaN不等于任何，NaN也不等于NaN    Length(0)=空，数字没有Length
function $g(o,a,v){return T(v)?o.setAttribute(a,v):o.getAttribute(a)}










function IE(b){
//浏览器 一个字母 + 版本 ，   ie= i  chrome=c firefox=f opera=o safari=s
//没有b就是整数版本，比如 i9 i8 i6  c24  有b，就是具体版本 i9.0 i8.0 i6.0 c24.0.1312.57
var w=$l(navigator.userAgent),s,r;(s=w.match(/msie ([\d.]+)/))?r='i'+s[1]:(s=w.match(/firefox\/([\d.]+)/))?r='f'+s[1]:(s=w.match(/chrome\/([\d.]+)/))?r='c'+s[1]:(s=w.match(/opera.([\d.]+)/))?r='o'+s[1]:(s=w.match(/version\/([\d.]+).*safari/))?r='s'+s[1]:0;
return b?r:$p(r,'.')[0]
}


//使用 o.style.width只能对 <div style="width:100px">这种能用，而对于用css独立页写的，或者放在<style>里面的，都无法使用，所以必须要用下面的方法
//注意最后的弹出内容，currentStyle返回浏览器的默认值”auto”，而getComputedStyle则返回具体的值”**px”。 
//所以如果要获取宽度和高度，必须判断：c=$i($r(S(o,'height'),/(\d+)px/,'$1'));c=c>0?c:$i(o.offsetWidth);
//offsetWidth并不能完全兼容，所以如果要获取，最好是判断的方法！！！
function S(o,a){return o.currentStyle?o.currentStyle[a]:$4.defaultView.getComputedStyle(o,O)[a]}
function SP(o,x,y){var p="px";o.style.backgroundPositionX=x+p;o.style.backgroundPositionY=y+p;o.style.backgroundPosition=x+"px "+y+p}

/* $C(tagName,id=e/class=love,html,$4.body)  新建元素*/
function $C(e,g,h,p){var o=$4.createElement(T(e)?e:'div'),a;if(T(g)){a=$p(g,'=');$g(o,a[0],a[1]);}H(o,h);p=T(p,5)?p:$4.body;p.appendChild(o);}

function Z(h){if(IE()!='i6'){$C(O,'id=z',h);A();E($('^a.zo')[0],$7,function(){D($('z'))});}}
















//获取 location.search的 某个参数  v-get.com/s?l=1&k=我爱你   location.search  就是 ?l=1
//$k('k') ==>得到  我爱你   $k('k',I) ==>得到   %E6%88%91%E7%88%B1%E4%BD%A0
//$k('k','12');
//$k('k',O,'http://e.v-get.com/s?ie=utf8&sk=love');
//为了确保有时候对 没有问号的也进行这个操作，所以必须要对没有问号的情况进行判断
function $k(c,d,l){var r='';c+="=";if($x(l?l:$5.search,'?')<0)return O;F($p(l?($p(l,'?')[1]):($s($5.search,1)),'&'),function(i){if(c==$s(i,0,L(c)))r=$s(i,L(c));});return T(r)?(d?r:decodeURI(r)):O}
function $K(o,s){F($p(s,","),function(k){if(T(k)){H(o,$r(H(o),RegExp("(>[^<]{0,})("+k+")([^>]{0,}<)","ig"),"$1<span class=\"f0\">$2</span>$3"))}})}

// i=cd  $D(a外面的id,显示区的tagName,是否有class ，默认  id=?da  cda     class=?d 或者 id=?d   ?do 
function $D(i,r){var s=i+'a',a=$(s+'^a'),g,c;F(a,function(o,I){if(I>0)D(r[I]);E(o,$8,function(){g=this;F(a,function(v,j){c=C(v);D(r[j]);C(v,$r(c,RegExp('\s?'+s,'g'),''));if(v==g){D(r[j],1);C(v,$r(c+' ',/\s{2,}/g,' ')+s)}})})})}


function C(o,s){if(T(s,4))o.className=s;else return o.className}
//不要随便用 公用I，如果一个使用 F里面再次使用 F，那么I就有问题了，所以还是用var 
function F(a,f,y,z){if(a)for(var i=y||0;i<(z||L(a));i++)f(a[i],i)}  //使用时，用F(a,function(o,I){})
function E(o,t,f){if($4.addEventListener)o.addEventListener(t,f,O);else o.attachEvent('on'+t,function(){return f.call(o,$3.event)})}
//要注意 ，s 作为InnerHTML为了图方便，会用number 
function H(o,s){if(!T(s,1))o.innerHTML=s;else return o.innerHTML}




/* $(i,o)如果是$(ID^tagName)或$(^tagName)这里是数组，要注意;Name="c"和ID="C"如果命名一样的，$("C")会取前面一个，name在前，这个就取的是name那个元素，而不是id那个元素了，要注意 
object/function 只能用 if(!o)判断，可以不用 N()
$p('^love','^')[1] == 'love'  $p('^love','^')[0] == ''  

*/
function $(i,o){var s=$p(i,'^'),a=s[0],g=function(x){return $4.getElementById(x)},r=T(a)?g(a):O;
if(L(a)==0||g(a))if(T(s[1])){var c=$p(s[1],'.'),d=c[0],e=c[1],v=[];o=o?o:$4;o=r?r:o;r=o.getElementsByTagName(d);if(T(e)){F(r,function(o){F($p(C(o),' '),function(c){if(c==e){v=v.concat(o);return}})});r=v}}return r}


/* ####################################Thirdary, Both above##################################################*/

//$o(f,1,I) =setInterval(f,1)     $o(f,I) =clearInterval(f)   $o(f,1)=setTimeout(f)   $o(f)=clearTimeout(f)  
function $o(f,t,i){return i?setInterval(f,t):((T(t,3))?setTimeout(f,t):(t?clearInterval(f):clearTimeout(f)))}


//id 下的元素背景、颜色选填 B(id,over触发背景(如果是 #开头，就是表示颜色，否则就是 class,),over触发颜色(选),out正常背景(选)(如果是 #开头，就是表示颜色，否则就是 class,),out正常颜色(选)); 不用if，不然造成很多字符浪费，不如直接写
// B可以用在对 form里面的 input 提示搜索词，以后可能会常用，利用js random提示关键词

//不能写 F($("c^ol"),function(o){if(C(o)=="vc")B($("^li",o),"#666","#fff","#f7f7f7","#369")});，这种外面有 for的，如果遇到B外面有for，必须使用eval，这个bug暂时无法解决，不过可以通过一下eval执行
/* var vc='',vi=0;F($("^ol"),function(o){if(C(o)=="vc")vi++});
for(I=0;I<vi;I++){vc+='B($("^li",$("^ol")[I]),"#666","#fff","#f7f7f7","#666");';}if(L(vc)>9)eval(vc); */
//B();  没有东西，就表示全屏蒙版背景

/* V-Get 跳转链接 */
function $L(l){var d='(v-get.com|weigeti.com)$';
l=$r(l,/^https?\:\/\//,'');
//防止 thunder://  ftp:// 这种情况
if(l.match(/^\w+\:\/\/.+$/))return l;
if(!l.match(/.+\..+/))return '#';
if(!$p(l,'/')[0].match(RegExp($r(d,'.','\.')))){l=encodeURIComponent(l);l='http://s.v-get.com/l?l='+l;}

l=($s(l,0,4)=='http')?l:($2+l);
return l}


/* B(a触发模块,b触发背景颜色#开头，或者触发className,c触发颜色,d离开背景色#开头，或者离开className,e鼠标离开颜色); */
function B(a,b,c,d,e){

var i,g=$('eb');d=d?d:'#FFF';
if(a){
function f(o,u,v,w){
if($s(u,0,1)=='#')o.style.backgroundColor=u;
else if($x(C(o),w))C(o,$r(C(o),w,u));
else C(o,C(o)+' '+u);
if(v)o.style.color=v}
F(a,function(o){
//getElementsByTagName 不区分大小写，但是 tagName一律是大写  
//o.tagName.toUpperCase()=="INPUT"
if($l(o.tagName)=="input"){
if(T(o.placeholder)){
E(o,$7,function(){i=this;if(!T(i.value)){$g(i,'h',i.placeholder);i.placeholder="";f(i,b,c,d)}});
E(o,$8,function(){f(this,b,c,d)});
E(o,$9,function(){i=this;if(!T(i.value)){if(T($g(i,'h')))i.placeholder=$g(i,'h');f(i,d,e,b)}});

}}
else {E(o,$8,function(){f(this,b,c,d)});E(o,$9,function(){f(this,d,e,b)});}})
}
else {

//如果id=i存在，那么就直接D($(i),1)，否则新建一个

if(g)D(g,1);else{
/* IE6/7中不能通过setAttribute设置元素的style属性，也不能通过getAttribute获取元素的style属性值。它获取的是一个style对象[object]。
 以下部分使整个页面至灰不可点击 不能够合并，必须var=g... ;然后g.style.cssText
 g.style.cssText="background:#000000;width:100%;height:100%;position:fixed;top:0;left:0;z-index:500;opacity:0.3;filter:Alpha(opacity=30);";    
  $4.body.style.overflow ="hidden";   取消滚动条，使超过的部分无法显示 */
g=$4.createElement("div");
 $g(g,"id",'eb');//定义该div的id
 $4.body.appendChild(g);}


}

}
/* //对所有 http://s.v-get.com/l?l= 进行js化，无法使用js的才跳转302
//A(o,t,x,y) A('id','_blank')  A('','_blank',2,5) 所有A,从第二个到第5个A才变成 '_blank' 
每个这个函数的a,都会生成   <a href="" _target="_target">
如果 已经 A();  然后又对d 使用  A(d,'_self');  这时候再使用 A($(d)) ==== A($(d),'_blank')就无效了，
A(id,'_');  这是设置不可修改的_blank ，或者已经被修改成_self后，再修改回_blank的a
必须使用  A($(d),'_');
1.  A($(d),'_'); 在 A($(d),'_self') 前;  
    t='_' 成立 所以  i.target=k;  _blank='_'
    执行 A($(d),'_self')  因为 _blank =='_' 所以不执行
2. 在后  i.target='_self'; _blank='_self'; 
    t='_' 成立，执行  i.target=k; _blank='_';
*/
function A(o,t,y,z){var k='_blank',h,g,l,j="javascript:";
F($((T(o)?o:'')+"^a"),function(i){
h=i.href;g=i.target;l='s.v-get.com/l?l=';
//这里不能用if(L(h)<4)，因为即使是 #都会带网址
// 
if($s(h,-1)=="#")i.href=j+"void(0)";
else if(j!=$s(h,0,11)&&$p(h,"#")[0]!=$4.URL&&$g(i,k)!='_'&&(!T(g)||g==k||t=='_')){i.target=(L(t)>1)?t:k;$g(i,k,t);/* L(t)>0 && t!='_'  综合就是 L(t)>1，有时候iframe会是两位命名的*/
if($x(h,l)>0){h=$r(h,/%\w{2}/g,function(a){return String.fromCharCode($i('0x'+$s(a,1)))});i.href=$r(h,l,'')}
if(L(i.title)<1)i.title=(!T(H(i))||/</.test(H(i)))?i.href:H(i);



}
},y,z)
}



//setCookie(c_name,value,d)==清空cookie就直接day=0 day只能是0-31就行  getCookie(c_name)  这里 v可以为0
//网吧换用户会清空cookie，所以cookie用天最好。这
//setDate是天，这里以天为单位
//K(k,v,t) 有就是 设置cookie(参数，值，实效时间)

 
function K(k,v,d){var x=$4.cookie,c,e,t=new Date();if(v){t.setDate(t.getDate()+d?d:9);$4.cookie=k+"="+escape(v)+";expires="+t.toGMTString()}else{if(T(x)){c=$x(x,k+"=");if(c!=-1){c=c+L(k)+1;e=$x(x,";",c);if(e==-1)e=L(x);return unescape(x.substring(c,e))}}return ""}
}
//A(l,v,o,f)   ajax会出现跨域问题，此时a.status=0;返回0.这时必须把  l在本网站下，比如 yiwu.wuliu.v-get.com    function 不能用 N(f)判断，function/object直接用 if(h)
function $A(l,v,o,f){var a=null,s,h;try{a=new XMLHttpRequest()}catch(e){try{a=new ActiveXObject("Msxml2.XMLHTTP")}catch(e){a=new ActiveXObject("Microsoft.XMLHTTP")}}a.onreadystatechange=function(){s=a.readyState;if(s==4||s=="complete"){h=a.responseText;if(o)H(o,h);if(f)f(h)}};a.open("POST",l,true);a.setRequestHeader("Content-Type","application/x-www-form-urlencoded");a.send("v="+v)}










//返回某个元素o的高度0/宽度1，包含边框的宽高  返回整数，而 $S()返回含 px的
//对于M() 这里的o，就是 ul下的第一个li

function $m(o,g){
//g=1 宽度  g=0 高度 height+top+bottom

var c,d='border',w='Width',z=g?w:'Height',x=g?'Left':'Top',y=g?'Right':'Bottom';

function h(e){return $i($r(S(o,e),'px',''))}
//h('width')+h('borderTopWidth')+h('borderBottomWidth');
c=h($l(z))+h(d+x+w)+h(d+y+w);
return c>0?c:$i(g?o.offsetWidth:o.offsetHeight)
}


/* 

 对MD重写，采用 alt获取
function MD(){var a=$('do^a');var l=L(a);##设置固定高度218px,使用此，一定要给li设置：white-space:nowrap;overflow:hidden否则无法循环。这里n可以不放进来，放进来是触发onmouseover###  if(n==0||n)$('d').scrollTop=n*218;else {n=$('d').scrollTop/218;if(n==l-1)n=0;else n++}
###注意，!0是true，所以要用n!=0取消掉0的情况###H($('dk'),'<a href="'+MK[n].l+'">'+MK[n].k+'</a>');for(I=0;I<l;I++)C(a[I],'');C(a[n],'do')}
M('d',0,5,215,5000,MD);
切记:内部o 一定要设置属性——overflow:hidden;否则不能显示if($("M0T").offsetHeight<=h)return;如果M0T的高度小于窗口高度，就不执行以下对属性id.scrollTop进行代替操作，使用var d='scrollTop';id[d]就行了
C=current; D=duplicate相当于再有一个<ul id=M0D>，但是这里注意，M0D不能出现在文章中 */
// M(id或者string，方向=上右下左，速度，循环时间/鼠标每次滚动li数，自动转动与否？I/O  ，函数)

//M(o=ul外面div的object,p=方向(0,1,2,3),v=几微秒移动1px || 每微秒移动距离,t=间隔微秒,e=是否是自动,f=function || 每次转动上移数量);



function M(o,p,v,t,e,f){
var s=I,g=p%2,a=$('^li',o)[0],ps='scroll',d=ps+['Top','Left'][g],k,y,n=e?1:v;
function x(x){x?(o[d]-=n):(o[d]+=n)}
//{e,o,n,p,v,h,t,f,d,} 
//if(e) {k,y} 
//if(!e){k,y,s,b,r}
o[d]=0;
 E(o,$8,function(){if(e)return s=O;else{$o(y);k=$o(x,t,1)}});
 E(o,$9,function(){if(e)return s=I;else{$o(k);y=$o(function(){x(I)},t,1)}});
 if(e){
 //一定要设定好ul的高度和宽度还有ul的overflow:hidden;  ul如果横向滚动，因为li是 float的，所以如果要设置宽度，外面要加个div;；或者把clear:both不要放在ul上面不能设置width，
 // <div class="o"><ul><li>...</div>这种 Li float设置 ul宽度是无法设置的，只能
 // <div class="o"></div><div><ul..</div>  
//或者  <div class="o"><div><ul><..</div></div>
//对 
// 所有结构必须是  <div><ul><li>  
//这是因为ul在float:left超宽之后只会下移一行，不会横向，所以必须对ul宽度是实际宽度才行。
//在css出必须要把ul宽度设置好，float时候，宽度是实际宽度 *2
//这样只能对ul外面的div 实行 scroll，
//在scrollTop的时候，不需要对ul设置高度和宽度，只需要对div设就行了，

//float:left的时候ul没必要设定宽度，不过在img有border<或者有Margin padding，一定要计算好尺寸，
//在li 没有float的时候，ul最好设定宽度
//li 和 div 必须设置 height 和 width；特别是float的时候，li得width是必须的
//
// o 必须放在 div上面，因为ul宽度/高度是实际的，不存在scoll,只有div才存在scroll



var c=$m(a,g),l,w,u=$('^ul',o)[0],k=H(u),b,r,q=0,z=(p>0&&p<3)?I:O,h;
F($('^li',o),function(o){q+=c});
h=q*2+"px";
g?(u.style.width=h):(u.style.height=h);


H(u,k+k); //必须要放在这里，不能放在上面！！
w=o[ps+['Height','Width'][g]],j=z?w:0;o[d]=j/2;
//while(c%v!=0){v++}  //必须要这样，不然如果v不能被c整除，就会出现滑动次数过多
 //if(p%2==1) o.scrollLeft上ok  右 no 下 no  左ok
 //f如果是有的话，那么滑动的a ， <div id="mco"><a class="mco">1</a><a>2</a></div>
 l=(T(f,3)?f:1)*c;
 b=function(){if(s){if(T(f,6))f(c);x(z)};y=$o(r,v,I)};
 r=function(){if(o[d]%l>0){x(z);if(z?(o[d]<1?I:O):(o[d]>=w/2?I:O))o[d]=j}else{$o(y);$o(b,t)}};

 $o(b,t)}
 
 }


 /* 目录的下滑 */
 function N(t,z,d,f){
//左边通过计算完全可以对齐，不需要人工误差，而右边对齐跟弹出框宽度有关，所以需要人工参数
//t*i+z
d=d?d:'n';
var q=d+'a^',p='px',n=$('^div.'+d),o=$(q+'a'),x=L(o),c=$(q+'a')[0],g=$i($r(S(c,'marginLeft'),p,'')),e=IE(),v=(e=='i6'||e=='i7')?I:O,u=(v||e=='i9')?I:O;
//n的数量必须和a的数量一致！！否则后面的程序不可执行
if(v||x!=(L(n)))return;f=T(f,6)?f:function(a,b){if(C(a)!='no'){var h=$i($r(S(a,'height'),p,''));
if(b){a.style.background="url("+$2+"localhost/tu.v-get.com/f.png) 0 -411px repeat-x";a.style.border="1px solid #94c9ed";a.style.borderBottomWidth="0";a.style.borderTopLeftRadius="3px";a.style.borderTopRightRadius="3px";a.style.width=($i($r(S(a,'width'),p,''))-2)+p;a.style.lineHeight=(u?(h-2):(h-6))+p;}
else{
/* 这句话必须要放在取消边宽度前面 */
a.style.width=$m(a,1)+p;
a.style.background="none";
a.style.border="none";a.style.lineHeight=(u?h:(h-4))+p}}};
/* 获取从开始到当前宽度 k(n,是否是左边）*/
function k(i){var m=$m($(q+'i')[0],1),r=i==0?0:-m,g=$i($r(S($(q+'a')[0],'marginLeft'),p,''));F($(q+'a'),function(a,k){r+=k<i?($m(a,1)+m):0});return i<Math.ceil(x/2)?(r+(i==0?0:(g*2*i+g*2))+g-1):((t?t:60)*i+(z?z:6))}
//这里m必须在内部var，不然出错
F(o,function(a,i){var m=n[i];
E(a,$8,function(){
/* 0 1 2 3 4
由于顺序从0开始，正好是   <i>的宽度 + a的宽度 + a的margin的宽度 +  最后一个a的也就是当前a的左margin宽度
 */
m.style.left=k(i)+p;
f(a,I);if(L(H(m))>0)D(m,I);});
E(a,$9,function(){f(a);D(m)});
E(m,$8,function(){f(a,I);D(m,I)});
E(m,$9,function(){f(a);D(m)});
});

}
 
function $M(o,r,v,d,u){
/*o=id；a=id 里面的a ,
r这个就就是字符距离中间的半径默认250*250 界面r=96界面
v转动速度，值越小越快，默认144
d字体到屏幕放大指数，值越大，字体越小
728*728    r=280 v=62(反比)  d=874 u=582
450*450  ==r=120,v=180(反比) ,d=300,u-250;
250*250  450*0.8=250 ==r=96  v=324(反比) d=240 u=200
*/
r=r?r:96;v=Math.PI/(v?v:324);d=d?d:300;u=u?u:200;

var z=[],s=O,lasta=1,g=1,q=I,c=0,l=0,a=$('^a',o);


function f(a,b,c){sa=Math.sin(a*v);ca=Math.cos(a*v);sb=Math.sin(b*v);cb=Math.cos(b*v);sc=Math.sin(c*v);cc=Math.cos(c*v)}


F(a,function(a){var i={};i.offsetWidth=a.offsetWidth;i.offsetHeight=a.offsetHeight;z.push(i)});

	
	f(0,0,0);
	
	var max=L(z),i=0,w=[],fr=$4.createDocumentFragment();
	
	F(a,function(a){w.push(a)});

	
	w.sort(function (){return Math.random()<0.5?1:-1});
	F(w,function(a){fr.appendChild(a)});

	
	o.appendChild(fr);

	F(z,function(b,i){var p=q?Math.acos(-1+(2*(i+1)-1)/max):(Math.random()*(Math.PI)),e=q?(Math.sqrt(max*Math.PI)*p):(Math.random()*(2*Math.PI));
b.cx=r*Math.cos(e)*Math.sin(p);b.cy=r*Math.sin(e)*Math.sin(p);b.cz=r*Math.cos(p);
		
		a[i].style.left=b.cx+o.offsetWidth/2-b.offsetWidth/2+'px';
		a[i].style.top=b.cy+o.offsetHeight/2-b.offsetHeight/2+'px';
		
		});
		
	E(o,$8,function(){s=I});E(o,$9,function(){s=O});

	
	o.onmousemove=function (e){e=$3.event||e;c=e.clientX-(o.offsetLeft+o.offsetWidth/2);l=e.clientY-(o.offsetTop+o.offsetHeight/2);c/=5;l/=5};
	$o(p,30,I);
	


function p()
{
	var m, b;
	
	if(s){m=(-Math.min(Math.max(-l,-u),u)/r)*9;b=(Math.min(Math.max(-c,-u),u)/r)*9}else{m=lasta*0.98;b=g*0.98}lasta=m;g=b;
	
	if(Math.abs(m)<=0.01 && Math.abs(b)<=0.01){return}
	
	f(m,b,0);
	
	F(z,function(a){var j=a.cx,k=a.cy*sa+a.cz*ca,l=j*cb+k*sb,m=a.cy*ca+a.cz*(-sa),n=l*cc+m*(-sc),o=l*sc+m*cc,p=j*(-sb)+k*cb;a.cx=n;a.cy=o;a.cz=p;per=d/(d+p);a.x=(n*per)-(2);a.y=o*per;a.scale=per;a.alpha=per;a.alpha=(a.alpha-0.6)*(10/6)});
	
	
	
	
		
F(z,function(g,i){var j=a[i];j.style.left=g.cx+(o.offsetWidth-g.offsetWidth)/2+'px';j.style.top=g.cy+(o.offsetHeight-g.offsetHeight)/2+'px';j.style.fontSize=Math.ceil(12*g.scale/2)+8+'px';j.style.filter="alpha(opacity="+100*g.alpha+")";j.style.opacity=g.alpha});	
	
	
	
	w=[];
	F(a,function(a){w.push(a)});
	w.sort(function (a,b){if(a.cz>b.cz)return -1;else if(a.cz<b.cz)return 1;else return 0});
	
	F(w,function(a,i){a.style.zIndex=i});
	
}






}




/* 
function $C(e,g,h,p){var o=$4.createElement(T(e)?e:'div'),a;if(T(g)){a=$p(g,'=');$g(o,a[0],a[1]);}H(o,h);p=T(p)?p:$4.body;p.appendChild(o);} */





 function J(l,f,o){
 /* 'div class=love',f 如果是函数，就是f(s),如果不是就是 H(s,h),o 
 J(O,function(s){s.className="a";s.id="b"})
 创建 div class="a" id="b"
 J('http://e.v-get.com/a.js',function(s){})
 J('span',function(s){});
 如果 function $x(s,x,f){return s.indexOf(x,f|0)}
b=$x(l,'.')  
 */
 
 var s=$4.createElement("script");
     s.type="text/javascript";
        //IE浏览器
        if(s.readyState){s.onreadystatechange=function(){if(s.readyState=="loaded"||s.readyState=="complete"){s.onreadystatechange=null;if(f)f(s)}}}
        else {
       //非IE
           s.onload=function(){if(f)f(s)}
        }
         s.src=l;
		 
		 
		 (o?o:$("^head")[0]).appendChild(s);
      }
	  
	

//$S(input) 去除“非逗号”标点符号   $S(input,I) 匹配类型
function $S(k,c){


//替换 php.ini  Zend Studio C++ 等含有 . + 空格的，必须要先对替换的词进行$()操作
// \s空格  \+ \-
F(['s','+','.','-','?','(',')','{','}','[',']','$','^','*','!','=','\\'],function(r){k=$r(k,RegExp('\\'+r,'g'),'\\'+r);});

return $r(k,/\\\\/g,'\\');




//有c，表示判断是否是 e

//var b='',d=' ',v=k.value,z=9,r=[/^\s+|\s+$/g,/\s{2,}/g,/[，。、￥……×～（）『』【】；：‘“”’《》？！—\ |\~\`\!\@\#\$\%\^\&\*\(\)\-\_\+\=\\\[\]\{\}\;\:\"\',\<\.\>\/\?]/g],t=[b,d,d];
/*r=[去除首尾空格，去除两个以上空格，去除中英文标点符号]*/
//只做常用匹配
//e--> 0=用户名（只要非标点就行）  1=邮箱 2=手机号   9=没有匹配，错误匹配  
//var e=[RegExp('[^'+r[2]+'\s]','g'),/^[\w\.\-]+\@([\w\-]+\.)+([a-z\d]{2,4})+$/,/^\d{11}$/];

//if(c){
//$l()转为小写了
//F(e,function(a,i){if(a.test($l(v)))z=i});return z}else {F(r,function(a,i){v=$r(v,a,t[i])});k.value=v}
}

	
 /*$E(灰色背景id，整个弹出层，可移动区域，关闭按钮)
 登录框类型的，背景灰色弹出框
 
 */
 
 
//$4.ready并不是js函数，所以需要自定义，下面就是自定义$4.ready的函数。$4.ready(function(){}); 比$3.onload要快，因为onload要加载图片之后再执行

(function () {
/*  RegExp.$1是RegExp的一个属性,指的是与正则表达式匹配的第一个 子匹配(以括号为标志)字符串，以此类推，RegExp.$2，RegExp.$3，..RegExp.$99总共可以有99个匹配
给你看了例子就知道了
var r= /^(\d{4})-(\d{1,2})-(\d{1,2})$/; //正则表达式 匹配出生日期(简单匹配)     
r.exec('1985-10-15');
s1=RegExp.$1;
s2=RegExp.$2;
s3=RegExp.$3;
alert(s1+" "+s2+" "+s3)//结果为1985 10 15 */
  var i=0,e=!!($3.attachEvent&&!$3.opera),w=/webkit\/(\d+)/i.test(navigator.userAgent)&&(RegExp.$1<525),a=[];
  var r=function(){F(a,function(i){i()})},t;
  $4.ready=function (f) {
    if(!e&&!w&&$4.addEventListener)return $4.addEventListener('DOMContentLoaded',f,O);
    if(a.push(f)>1)return;
    if(e)(function (){try {$4.documentElement.doScroll('left');r()}catch(err){$o(arguments.callee,0)}})();
    else if(w)t=$o(function(){if(/^(loaded|complete)$/.test($4.readyState))$o(t,I);r()},0,I);
  };
})();


function $o(f,t,i){return i?setInterval(f,t):((T(t,3))?setTimeout(f,t):(t?clearInterval(f):clearTimeout(f)))}



/*****************************************Q()*************************************/
 //Q() 自定义attribute==q  v o   (h input 的 placeholer，此仅对Input征用，其他可以使用) （c pre的code，仅对pre征用 c=j:js/a:asp/p:php/v:jsp/h:html/）都被征用 q(Q123456^Mabchina@hotmail.com^Aaliwangwang K=客户页 M=MSN E=Email D=地图 W=网址 Q=QQ A=阿里 S=Skype) 图片默认尺寸21×21，设置一下，否则没有加载到图片，影响布局   a= ad 广告 a
 /* 添加收藏夹 af="1" 需要a.href 和 a.title*/
function Q(){	
	F($('^*'),function(o){
	var q=$g(o,'q'),x=$g(o,'o'),v=$g(o,'v'),l='><img src="'+$2;
	if(T(q)){
	var q=$p(q,'^'),s='',h='height="',w='" width="';/* 千万记住下面 width="21 后半符号不用写！！！ */
		   for(var j in q){
			   s+='<a target="_blank" href="';
		       var c=$s(q[j],1); 
	           switch($s(q[j],0,1)){case 'K':s+=$2+c+'" title="在线客服"'+l+'localhost/tu.v-get.com/g/qk.gif" '+h+'21'+w+'21';break;case 'J':s+=$2+c+'" title="查看价格"'+l+'localhost/tu.v-get.com/g/qj.gif" '+h+'21'+w+'21';break;case 'W':s+=$2+c+'" title="网址链接"'+l+'localhost/tu.v-get.com/g/qw.gif" '+h+'21'+w+'21';break;
			   case 'E':s+='mailto:'+c+'" title="发送邮件"'+l+'localhost/tu.v-get.com/g/qe.gif" '+h+'21'+w+'21';break;case 'D':s+=$2+c+'" title="查看地图"'+l+'localhost/tu.v-get.com/g/qd.gif" '+h+'21'+w+'21';break;case 'Q':s+=$2+'wpa.qq.com/msgrd?v=3&uin='+c+'&site=v-get&menu=yes'+'" title="QQ联系"'+l+'wpa.qq.com/pa?p=1:'+c+':45" '+h+'21'+w+'21';break;case 'A':s+=$2+'www.taobao.com/webww/ww.php?ver=3&touid='+c+'&siteid=cntaobao&status=2&charset=utf-8'+'" title="阿里旺旺"'+l+'amos.alicdn.com/realonline.aw?v=2&uid='+c+'&site=cntaobao&s=2&charset=utf-8" '+h+'16'+w+'16';break;case 'S':s+='skype:'+c+'?call" on-click="return skypeCheck();'+'"'+l+'mystatus.skype.com/smallicon/'+c+'" '+h+'16'+w+'16';break;}
				s+='" /></a>';
             }H(o,s)
	}
	if('sidebar'==o.rel){E(o,$7,function(){var l=o.href,t=o.title;o.href='#';if($4.all)$3.external.addFavorite(l,t);else if($3.sidebar)$3.sidebar.addPanel(t,l,'');else {alert('请在链接页，使用CTRL+D加入收藏，或点击浏览器☆状，使其变成★即可收藏');o.href=(l==$5.href)?'#':l}})}
    if($i(v)>0){o.style.background="url("+$2+"localhost/www.v-get.com/tu/g.gif) 0 -"+(128+v*25)+"px no-repeat";o.href="#";o.style.width="16px";o.style.height="16px"}
	
	if($i(x)>49)(function(){var i=3,e,y;for(i;i>-1;i--){e=Math.pow(6,i)*50;y=x/e;if(y>=1){o.style.width=$i(y)*16+"px";o.style.height="16px";o.style.background="url("+$2+"localhost/www.v-get.com/tu/h.gif) 0 -"+i*16+"px repeat-x";return O}x=x%e}})();

	if(C(o).match(/a\d+x\d+/)&&L($r(H(o),/\s/g,''))<1){
	/* 这里每次重新一次AD，在i8/i.js自己生成AD */
	AD=$r(C(o),/^(.+\s)?a(\d+x\d+)(\s.+)?$/,'$2');
	/* 这个H(o,AD)不能注释掉，否则出现问题 */
	H(o,AD);
	J($2+'localhost/www.v-get.com/tp/j/i.php?a='+AD+'&i='+Math.random(),function(){H(o,AD)});	
	}
	
	});
}
/*****************************************Q()*************************************/	


/*#############################下面是自执行#########################*/


/* 不能采用js 带参数，不然每次都要重新获取，就更慢了 */

//如果页内有iframe，使用alert会弹出两次，但是是在两个frame里面，所以不用担心，但是这个函数不可以用iframe



//不要使用 base target="_blank"	 这样的会对 href="#" 都改变的，内页使用A('','_self');就能改变了，因为无论这个位置在哪里，A();都不会改变已经是self的target
//暂时如果把A()；放到登录弹出框后面，会出错，暂时不知道原因
//这个js必须放在尾部第一个！！！
Q();
A();



