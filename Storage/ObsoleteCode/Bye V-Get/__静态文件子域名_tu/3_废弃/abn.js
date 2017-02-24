(function(){
var iw='';
M($('ar1'),0,1,3000,I,4);M($('ar3'),0,1,3001,I,4);
H($('dc'),'');
var MK=[{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_0.jpg","k":'浙江最大货运市场——江东货运市场'},{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=%E7%A6%8F%E5%BB%BA',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_1.jpg","k":'义乌泰达托运，泉州、福州'},{"l":$2+'yiwu.wuliu.v-get.com/banjia/',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_2.jpg","k":'义乌捷锐搬家，钢琴搬运'},{"l":$2+'yiwu.wuliu.v-get.com/banjia/',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_3.jpg","k":'义乌四喜搬家，用心服务'},{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=%E5%B9%BF%E4%B8%9C',"p":$2+"localhost/www.v-getimg.com/i8/238x215/wuliu_yiwu_4.jpg","k":'义乌托运到广东，一路顺风'}];
H($('dk'),'<a href="'+MK[0].l+'">'+MK[0].k+'</a>');
function MD(h,n){var a=$('do^a'),l=L(a);if(n==0||n)$('d').scrollTop=n*h;else {n=$('d').scrollTop/h;if(n==l-1)n=0;else n++}H($('dk'),'<a href="'+MK[n].l+'">'+MK[n].k+'</a>');F(a,function(o){C(o,'')});C(a[n],'do')} ;
for(var i=0;i<5;i++){
	var a=$('do^a'),k=MK[i],r=k.l;
	a[i].href=r;E(a[i],$8,function(){for(i=0;i<5;i++)if(a[i]==this)MD(215,i)});
	$('dc').innerHTML+='<li><a href="'+r+'"><img src="'+k.p+'" /></a></li>'}
	M($('d'),0,1,5000,I,MD);
	//时间不能设定为一样，否则有问题
	M($('^div.dfl')[0],0,60,5001,I);
	
	

A('n','_self');


//for 文章
B($('^div.cf'),'#E4F0FF',O,'#FFFFFF');
})();
