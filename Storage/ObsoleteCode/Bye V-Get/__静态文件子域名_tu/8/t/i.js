var fC=$('c'),pL='<p>',pR='</p>',pC=pR+pL,tG='</th><td style="text-align:left;padding:0 0 0 9px">',tH=function(w){return '<tr><th style="'+(T(w,3)?'width:'+w+'px;text-align:right;padding:0 9px 0 0':w)+'">'},sK=function(x){var k=$k('sk'),r=$r(k?k:'',/%\w{2}/g,function(a){return String.fromCharCode($i('0x'+$s(a,1)))});return r?r:x},fS=$('cs'),fK=fS.sk,hD=function(h,p,x){
//hD 用于 返回header头状态码的替换，一般这种返回必须用表格，
// h=返回的header  p 替换换行或|   x 一般用于设置th的宽度tH(k)，对于状态码都有第一个默认，所以必须保持这样
p='['+p+']';
h=h.replace(RegExp('^'+p+'+|'+p+'+$','g'),'').replace(RegExp(p,'g'),'</td></tr>'+x); //包含\n 不能用 $r()

var g=/([\-\:])/g,y=[['Date','获取时间','#'],['Server','系统/服务器','#'],['Content-Length','文件大小','#'],['Content-Type','文件类型','#'],['Content-Location','真实地址','#'],['Last-Modified','最后修改时间','#'],['Accept-Ranges','断点续传功能',''],['ETag','保存文件的唯一标识','#'],['X-Powered-By','扩展语言','#'],['Cache-control','网页缓存','#'],['Connection','是否持久连接','#'],['Vary','代理缓存','#']];
h=$r(h,/([\w\-]+):\s/ig,'$1'+tG);
F(y,function(r){
h=$r(h,RegExp($r(r[0],g,'\$1')+'<\/th>','gi'),'<a href="'+r[2]+'" target="_blank"">'+r[1]+'：'+r[0]+'</a></th>')
});
return $r(h,RegExp($r('<\/td><\/tr>'+x+'<\/td><\/tr>'+x,g,'\$1'),'ig'),'</td></tr>'+x)


};



function cK(k){fK.value=k}
//对数组random,用于设置默认值
function fR(a){return a[$i(Math.random()*L(a))]}
function dF(s){D(fC.parentNode.parentNode);D($("^div.mf")[0],1);H($("f^h4")[0],s)}

function alexa_rank(){var k=sK('');cK(k);
function f(h){var a=[],b=['国家','国内排名','世界排名','排名变化','反链数量'],t='</tr>',s='<tr>',z=s;a[0]=$r($r(h,/.+COUNTRY[^>]+NAME="([^"]+)".+/g,'$1'),'China','中国');a[1]=$r(h,/.+COUNTRY[^>]+RANK="(\d+)".+/,'$1');a[2]=$r(h,/.+POPULARITY[^>]+TEXT="(\d+)".+/,'<strong class="f0">$1</strong>');a[3]=$r(h,/.+RANK[^>]+DELTA="([-+]?\d+)".+/,'$1');a[4]=$r(h,/.+LINKSIN[^>]+NUM="(\d+)".+/,'$1');F(a,function(x,i){z+='<th>'+b[i]+'</th>';s+='<td>'+x+'</td>'});H(fC,'<table>'+z+t+s+t+'</table><div style="margin:20px 0"><img src="http://traffic.alexa.com/graph?w=660&h=250&r=6m&y=t&u='+k+'" width="660" height="250"/></div>')}if(T(k)&&(k.match(/\./))){$A('http://localhost/www.v-get.com/e/t/alexa_rank.php',k,0,f)}else H(fC,pL+'请输入域名，如v-get.com'+pR)
}
function code_md5(){J('http://localhost/www.v-get.com/tu/8/t/code_md5.js',function(){var k=sK('V-Get.com');cK(k);
function f(k){H(fC,pL+''+str2binl(k)+pC+''+MD5(k,8)+pC+'MD5加密(小写)：'+hex_md5(k,0)+pC+'MD5加密(大写)：'+hex_md5(k,1)+''+pR)}
f(k);E(fK,'input',function(){f(fK.value)});
})}

function code_ascii(){


//function notASCII(code) {return code.match(/[^\x00-\xff]/);}
//alert(isASCII('我')?'YES':'NO');
//function notGB2312(c){return c.match(/[^\u2121H-\u777EH]/);}
//alert(isGB2312('艹')?'YES':'NO');
//charCodeAt() 方法可返回指定位置的字符的 Unicode 编码。这个返回值是 0 - 65535 之间的整数。
//function isUTF8(s){var c = s.charCodeAt(0); return c >65535?true:false;}
//alert(isGB2312('艹')?'YES':'NO');








var t='" style="width:98%;font-size:12px;margin:5px 0;resize:vertical" rows="5"',y='" style="height:26px;line-height:26px;padding:0 5px;cursor:pointer;margin:0 4px" onclick="javascript:',f=function(i){return 'var t='+i+',a=$(\'js_ascii\'),x=\'\';F($p($(\'js_symbol\').value,\'\'),function(j){x+=(t>0||j.match(/[^\[\\x00-\\xff\\u4E00-\\u9FA5\\uFE30-\\uFFA0]/))?(\'&#\'+j.charCodeAt(0)+\';\'):j;});if(t>1)x=$r(x,/&#(\\d+);/g,\'$1 \');a.value=x;D(a,I);D($(\'js_chara\'));"'};

H($('cs').parentNode,'<form class="fo"><textarea id="js_symbol'+t+'></textarea><div><input type="button" value="GBK外符号转网页编码'+y+f(0)+'/><input type="button" value="转网页编码'+y+f(1)+'/><input type="button" name="js_s" value="转ASCII码'+y+f(2)+'/><input type="button" name="js_s" value="网页编码转字符'+y+'var o=$(\'js_chara\');H(o,$(\'js_symbol\').value);D(o,I);D($(\'js_ascii\'))" /></div><textarea id="js_ascii'+t+'></textarea><div id="js_chara" style="line-height:25px;width:98%;display:none;border:#ccc 1px solid;min-height:55px;font-size:12px"></div></form>');

//dF('网页ASCII编码')


}
function domain_name(){var h='',t='<style type="text/css">#c li{line-height:28px;height:28px}.c1 li{float:left;width:67px}.c1 li input{margin:0 3px}#cf6 li{position:relative;border-bottom:#ddd 1px dashed}#cf6 .yn{line-height:12px;width:20px}#cf6 img{margin:0 6px 0 0}#cf6 .h4r{right:0}</style>',q=function(k){return (T(k)&&(!k.match(/[^a-z0-9-]+/)&&'-'!=$s(k,0,1)))?I:O};

function y(s){var g=$p(s,'_'),h='';if(T(g[0])){F(g,function(d){h+='<li><span><img src="http://localhost/www.v-get.com/tu/g/loading16x16.gif"/></span><span>.'+d+'</span><span></span><span class="h4r">如果不可以就查询whois</span></li>';})}return h}

function x(k){F($("cf6^li"),function(i){o=$("^span",i);var a=o[0],b=H(o[1]),c=o[2],d=o[3],n,j="yn yn",m,l;function f(h){n=$i($p(h,'|')[2]);if(n==210){j+=0;m='<span style="color:#093">（可以注册）</span>';l='<a href="#">立刻注册</a>'}else {if(n==211){j+=1;m='&nbsp;（已被注册）';l='<a href="#">查看Whois</a>'}else {j+=2;m='&nbsp;（查询故障）';l='<a href="#">访问网址</a>'}}H(a,"");C(a,j);H(c,m);H(d,l)}$A('http://localhost/www.v-get.com/e/t/domain_name.php',k+b,0,f);})}


fS.onsubmit=function(){var s='',k=fK.value;F($('^input',fC),function(a){if(a.checked||a.checked=='checked')s+='_'+a.value});
if(q(k)){H($("cf6"),y($s(s,1)));x(k);}else alert('请输入英文、数字、减号\n\n或在“站长工具”查看详细说明');return O};
H(fC,t+'<div class="c1"><ul><li><input type="checkbox" checked="checked" value="com"/>.com</li><li><input type="checkbox" checked="checked" value="cn"/>.cn</li><li><input type="checkbox" checked="checked" value="com.cn"/>.com.cn</li><li><input type="checkbox" checked="checked" value="biz"/>.biz</li><li><input type="checkbox" checked="checked" value="net"/>.net</li><li><input type="checkbox" value="net.cn"/>.net.cn</li><li><input type="checkbox" checked="checked" value="co"/>.co</li><li><input type="checkbox" checked="checked" value="org"/>.org</li><li><input type="checkbox" value="org.cn"/>.org.cn</li><li><input type="checkbox" value="name"/>.name</li><li><input type="checkbox" value="info"/>.info</li><li><input type="checkbox" value="gov.cn"/>.gov.cn</li><li><input type="checkbox" value="tv"/>.tv</li><li><input type="checkbox" value="cc"/>.cc</li></ul></div><div class="o mb"></div><div><ul id="cf6">'+y($k('sx')?$k('sx'):'')+'</ul></div>');
if(q(sK(''))){x(sK(''))};if(!$3._c)$3._c=$4.createStyleSheet();_c.cssText=t;

}
function gnu_gzip(){var k=sK(''),x=tH(250),e,m,u,q='',l=/Content\-Length\:\s(\d+)/,w,z;cK(k);
function f(h){
e=$p(h,'|')[1];
h=$p(h,'|')[0];
w=$i(e.match(l)[1]);
z=$i(h.match(l)[1]);
m=h.match(/Content\-Encoding\:\s(\w+)/);
u=[['压缩类型',m?m[1]:'<a href="http://e.v-get.com/tech/20130805/162744678.html">未压缩，建议采用gzip压缩设置</a>'],['压缩后文件大小',z+' 字节'],['未压缩文件大小',w+' 字节'],['压缩率',100-z/w*100+' %']];
F(u,function(v){q+=x+v[0]+tG+v[1]+'</td></tr>'});
H(fC,'<table style="margin:0 0 50px 0"><tr><td colspan="2">网址 '+k+' 压缩检测报告</td></tr>'+q+'</table><table><th colspan="2">详细报告</th>'+x+'<a href="http://e.v-get.com/tool/http_status.html?sk='+k+'">状态码</a>'+tG+hD(h,'\n\r',x)+'</td></tr></table>')}if(T(k)&&(k.match(/\./)))$A('http://localhost/www.v-get.com/e/t/gnu_gzip.php',k,0,f);else H(fC,pL+'请输入域名，如e.v-get.com'+pR)

}

function google_pr(){var k=sK(''),y,r,j;if($2==$s(k,0,7))k=$r(k,$2,'');cK(k);
function f(h){r=$r(h,/^Rank_1:1:(\d).+/,'$1');r=L(r)==1?r:'0'; 
function l(p){return L(h.match(RegExp('<a[^>]+href="http:\/\/'+p+'[^>]+>','g')))}
//　　PR输出值=(1 - 0.85) + 0.85 * (PR值 /外链数) 
j=l('')-l($p(k,'/')[0]);
H(fC,'PR：'+r+'；外链：'+j+'；PR输出值：'+(l('')>0?(0.15+0.85*(r/(j?j:1))):0));
}
if(T(k)&&(k.match(/\./)))$A('http://localhost/www.v-get.com/e/t/google_pr.php',k,0,f);else H(fC,pL+'请输入域名，如e.v-get.com'+pR)
}


function http_status(){var k=sK(''),x=tH(230);cK(k);
if(T(k)&&(k.match(/\./))){
if($2!=$s(k,0,7))k=$2+k;
var g=pL+'网址 '+k+' 状态码：'+pC,a; 
function f(h){a=$s(h,9,3);

F($('f^strong'),function(o){if(a==H(o))g+=H(o.parentNode)});
H(fC,g+'<table>'+x+'<a href="http://e.v-get.com/tool/http_status.html?sk='+k+'">状态码</a>'+tG+hD(h,'\|',x)+'</td></tr></table>')
}
$A('http://localhost/www.v-get.com/e/t/http_status.php',k,0,f);
}
else H(fC,pL+'请输入完整的网址，如http://e.v-get.com/tool/'+pR)
}

function icp_beian(){var k=$l(sK(''),I),o,t=['','主办单位','性质','备案号','网站名称','网站首页','审核时间'];cK(k);if(T(k)){
/* 获取域名的js  */


$A('http://localhost/www.v-get.com/e/t/icp_beian.php',k,0,function(h){$C('div','id=icp_beian',h);o=$("icp_beian");D(o);h='<table><tr><th colspan="2" style="font:bold 14px 微软雅黑">域名：'+k+'</th></tr>';
F($('^td',$('^tr',$('icp_beian^table.result')[0])[2]),function(d,i){
if(i>0&i<7)h+=tH(70)+t[i]+tG+H(d)+'</td></tr>';
});
h=$r(h,/<\/?(a|span)[^>]+>/g,'');
h+='</table>';

H(fC,h);});

}}




function ico_maker(){D($('cs'));H(fC,'<embed src="http://localhost/tp.v-get.com/j/8/tool/ico_maker.swf" quality="high" pluginspage="http://www.adobe.com/go/getflashplayer" play="false" loop="false" scale="exactfit" wmode="window" devicefont="false" bgcolor="#ffffff" name="iconMaker" menu="false" allowfullscreen="false" allowscriptaccess="sameDomain" salign="" type="application/x-shockwave-flash" align="middle" width="600" height="350">');}
function id_card(){
var k=sK(fR(['11000019991111','110000199911110259'])),h=pL+'1、 请输入18位身份证号码用于验证；'+pC+'2、 如果需要生成身份证号码，请输入6位地区码+8位生日。'+pC+'　　如查询 31010419850225 将生成地区(上海徐汇)+生日(1985-02-25)的身份证号码'+pR;cK(k);
H(fC,h);
J('http://localhost/www.v-get.com/tu/8/t/id_card.js',function(){
if(L(k)==18){H(fC,pL+''+(checkPID(k)?'<b class="f1">身份证号码正确</b>':'<b class="f0">身份证号码错误</b>')+''+pR+h)}
if(L(k)==14){H(fC,'<p class="f3">生成的身份证号码是：'+checkPID($s(k,0,6),$s(k,6),I)+''+pR+h)}
});}
function ip_address(){var k=sK('');cK(k);function f(h){if(T(h))H(fC,'<p class="f6">获得IP地址：'+h+''+pR);else H(fC,'<p class="f0">未检测到IP'+pR)}
if(T(k)&&(k.match(/\./))){$A('http://localhost/www.v-get.com/e/t/ip_address.php',k,0,f)}else H(fC,pL+'请输入完整的网址，如http://e.v-get.com/'+pR)}
function urlencode_urldecode(){var k=sK(''),x=$k('sk'),a=encodeURIComponent(k),b=decodeURIComponent(x),r=[['UTF-8 编码',a],['UTF-8 解码',b],['跳转链接',$L(k)]],t='<table>';cK(k);
if(x!=fK.value){fK.value=x}
if(T(k)){
h=k;
F(r,function(e){t+=tH(110)+e[0]+tG+e[1]+'</td><tr>';});
H(fC,t+'</table>');}
}