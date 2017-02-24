

(function(){

J('http://localhost/tp.v-get.com/j/8/n.js');A('na','_self');A('d','_self');

var s=$("^form",$("^div.s")[0])[0];
s.ie[1].checked=O;s.ie[0].checked=I;
s.onsubmit=function(){
var c=s.ie[0].checked;
//不能取消英文就不使用  ie=utf-8了，这样在服务器端，还需要判断
if(c||c=='checked'){
//s.cx.value=""; //谷歌自定搜索id，可获得站内搜索广告收入
//谷歌自定义广告禁止直接用链接的
$3.open('http://www.baidu.com/baidu?tn=bds&cl=3&ct=2097152&si=e.v-get.com&word='+s.sk.value);
return O
}

};





//Z('<a class="zo" href="#" title="关闭"></a><div class="zz zt"><div class="z0 z1">销售热线</div><p class="z6">187-021-59790</p><p class="zd">工作日9:00-18:00</p><a class="zs" href="http://s.v-get.com/l?l=wpa.qq.com%2fmsgrd%3fv%3d3%26uin%3d921923988%26site%3dqq%26menu%3dyes" title="售前咨询">售前在线咨询</a></div><div class="zz zb"><div class="z0 z2">售后服务</div><p class="z6">408-600-8800</p><p class="zd">7*24小时</p><a class="zs" href="http://s.v-get.com/l?l=wpa.qq.com%2fmsgrd%3fv%3d3%26uin%3d921923988%26site%3dqq%26menu%3dyes" title="备案指南">备案指南</a><a class="zs" href="http://s.v-get.com/l?l=wpa.qq.com%2fmsgrd%3fv%3d3%26uin%3d921923988%26site%3dqq%26menu%3dyes" title="帮助中心">帮助中心</a></div>');

//F($('f^div.f'),function(f,i){var o=$('^div.mf',f)[0],g;D(o);E($("^a.pr",f)[0],$7,function(){g=this;if("展开∨"==H(g)){H(g,"关闭∧");D(o,1)}else{H(g,"展开∨");D(o)}})});


})();

function F0(){Fi('r3');
var z=$('cs'),k,s;z.onsubmit=function(){k=z.sk.value;if(T(k)&&(!k.match(/[^a-z0-9-]+/)&&'-'!=$s(k,0,1))){s='';F($('^input',z),function(a){if(a.checked||a.checked=='checked')s+='_'+a.value});z.sx.value=$s(s,1);z.submit()}else {alert('请仅输入英文、数字、减号')} return O};}

function F2(){$D("cd",$("^div.cd"))}

var Ftool_th=function(w){return '<tr><th style="'+(T(w,3)?'width:'+w+'px;text-align:right;padding:0 9px 0 0':w)+'">'},Ftool_sk=function(x){var k=$k('sk'),r=$r(k?k:"",/%\w{2}/g,function(a){return String.fromCharCode($i('0x'+$s(a,1)))});return r?r:x},Ftool_td=function(h,p,x){
//hD 用于 返回header头状态码的替换，一般这种返回必须用表格，
// h=返回的header  p 替换换行或|   x 一般用于设置th的宽度tH(k)，对于状态码都有第一个默认，所以必须保持这样
p='['+p+']';
h=h.replace(RegExp('^'+p+'+|'+p+'+$','g'),"").replace(RegExp(p,'g'),'</td></tr>'+x); //包含\n 不能用 $r()

var g=/([\-\:])/g,y=[['Date','获取时间','#'],['Server','系统/服务器','#'],['Content-Length','文件大小','#'],['Content-Type','文件类型','#'],['Content-Location','真实地址','#'],['Last-Modified','最后修改时间','#'],['Accept-Ranges','断点续传功能',""],['ETag','保存文件的唯一标识','#'],['X-Powered-By','扩展语言','#'],['Cache-control','网页缓存','#'],['Connection','是否持久连接','#'],['Vary','代理缓存','#']];
h=$r(h,/([\w\-]+):\s/ig,'$1'+'</th><td style="text-align:left;padding:0 0 0 9px">');
F(y,function(r){
h=$r(h,RegExp($r(r[0],g,'\$1')+'<\/th>','gi'),'<a href="'+r[2]+'" target="_blank"">'+r[1]+'：'+r[0]+'</a></th>')
});
return $r(h,RegExp($r('<\/td><\/tr>'+x+'<\/td><\/tr>'+x,g,'\$1'),'ig'),'</td></tr>'+x)


};



function Vwd(){$D("cd",$("^div.cd"));M($('m0'),3,1,5000,2);M($('m1'),3,1,5000,2);}