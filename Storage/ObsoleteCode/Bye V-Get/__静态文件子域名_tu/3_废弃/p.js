

(function(){
M($('ar1'),0,1,3000,I,4);M($('ar3'),0,1,3001,I,4);

(function(){
var s=$('cs'),k=$('^input.sk')[0],cd=$('^div.csd')[0];
function w(o){if(T(H(o))){$S(k);if(L(k.value)>15)k.value='';k.value+=' '+H(o)};D($('csc^div')[0]);D($('eb'))}
E($('^a.pr',cd)[0],$7,w);

function f(){

function d(){B();D(cd,1)}

function g(q){
var u='';F($ID,function(x){u+='<a p="'+x[1]+'" title="义乌市到'+x[0]+'托运价格">'+x[0]+(x[3]?x[3]:'')+'</a>';});
H($('csa'),u+'<div class="o"></div>');




F($('csa^a'),function(a){

E(a,$7,function(){
var i=$g(a,'p');
s.sto.value=i;
k.value=$r(H(a),/[ａ-ｚ]/,'');
if(i%10000==0){

F($ID,function(x){
if(x[1]==i){var r='',x2=x[2];if(T(x2)){F(x2,function(y){r+='<a href="javascript:void(0)" p="'+y[1]+'" title="义乌市到'+y[0]+'托运价格">'+y[0]+'</a>'});H($('csa'),r+'<div class="o"></div>');F($('csa^a'),function(b){E(b,$7,function(){s.sto.value=$g(b,'p');w(this)})});}else w();
}

});}})


});



}


d();


if($l(typeof($ID))=='object'){g($ID)}
else {J("http://localhost/www.v-getimg.com/i0/id.js",function(){g($ID);});}






}
E($('cscr'),$7,f);E(k,$7,f);
})();


F($('^a.h2r'),function(e,i){
E(e,$8,function(){this.style.backgroundPosition="0 -955px"});
E(e,$9,function(){if($('^div.cz')[i].style.display!="block"){this.style.backgroundPosition="0 -930px"}});
E(e,$7,function(){var z=this,x=$g(z,'b'),o=$('^div.cz')[i];
if(o.style.display!="block"){

$A($2+"localhost/"+$('scity').value+".wuliu.v-get.com/j/ajax_wuliu",x,o,function(){A('c','_blank')});D(o,1)


}else{D(o);z.style.backgroundPosition="0 -930px"}})}); 
function v(o,t){o.style.visibility=t?'visible':'hidden'};
//price
F($('price^table'),function(o){E(o,$8,function(){var x=this;F($('^a',x),function(a){v(a,1)});x.style.backgroundColor="#F1F6FD"});E(o,$9,function(){var x=this;v($('^a',x)[1]);v($('^a',x)[2]);v($('^a.h2r',x)[0]);x.style.backgroundColor=''})});



H($('dc'),'');
var MK=[{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_0.jpg","k":'浙江最大货运市场——江东货运市场'},{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=%E7%A6%8F%E5%BB%BA',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_1.jpg","k":'义乌泰达托运，泉州、福州'},{"l":$2+'yiwu.wuliu.v-get.com/banjia/',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_2.jpg","k":'义乌捷锐搬家，钢琴搬运'},{"l":$2+'yiwu.wuliu.v-get.com/banjia/',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_3.jpg","k":'义乌四喜搬家，用心服务'},{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=%E5%B9%BF%E4%B8%9C',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_4.jpg","k":'义乌托运到广东，一路顺风'}];
H($('dk'),'<a href="'+MK[0].l+'">'+MK[0].k+'</a>');
function MD(h,n){var a=$('do^a'),l=L(a);if(n==0||n)$('d').scrollTop=n*h;else {n=$('d').scrollTop/h;if(n==l-1)n=0;else n++}H($('dk'),'<a href="'+MK[n].l+'">'+MK[n].k+'</a>');F(a,function(o){C(o,'')});C(a[n],'do')} ;
for(var i=0;i<5;i++){
	var a=$('do^a'),m=MK[i],r=m.l;
	a[i].href=r;E(a[i],$8,function(){for(i=0;i<5;i++)if(a[i]==this)MD(215,i)});
	$('dc').innerHTML+='<li><a href="'+r+'"><img src="'+m.p+'" /></a></li>'}
	M($('d'),0,1,5000,I,MD);
	//时间不能设定为一样，否则有问题
	M($('^div.dfl')[0],0,60,5001,I);
	
	

A('n','_self',3);





})();

