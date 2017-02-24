function sF(o){var k=$r(o.sk.value,'襄樊','襄阳'),c=$v(o.sc);k=$r(k,/义乌|到|托运|公司|物流/g,'');k=$r(k,'货代','货运代理');if(c>0||L(k)>0){if(L(k)>3){k=$r(k,/[省市县区镇州]/,'')}$3.location.href='http://localhost/yiwu.wuliu.v-get.com/'+o.sa.value+'/?sc='+c+'&sk='+k}}
function cF(s){var b=$('c^B');for(I=0;I<L(b);I++){E(b[I],'mouseover',function(){this.style.backgroundPosition="-100px -75px"});E(b[I],'mouseout',function(){if($('cz'+$g(this,'b')).style.display!="block"){this.style.backgroundPosition="-75px -75px"}});E(b[I],'click',function(){var x=$g(this,'b'),o=$('cz'+x);if(o.style.display!="block"){A("http://"+s+"wuliu.v-get.com/d.php",x,o);D(o,1)}else{D(o)}})}}function cB(c,o){function v(o,t){o.style.visibility=t?'visible':'hidden'};for(I in o){if(C(o[I])=='cv'){E(o[I],'mouseover',function(){v($('^B',this)[0],1);v($('^I',this)[0],1);v($('^I',this)[1],1);this.style.backgroundColor=c});E(o[I],'mouseout',function(){v($('^B',this)[0]);v($('^I',this)[0]);v($('^I',this)[1]);this.style.backgroundColor=''})}}}
H($('av'),'<img src="http://p8.npccchina.com/960x45/1.gif" />');
H($('dc'),'');
var MK=[{"l":'http://yiwu.wuliu.v-get.com/tuoyun/?sc=2&sk=',"p":"http://p8.npccchina.com/250x220/d0.jpg","k":'浙江最大货运市场——江东货运市场'},{"l":'http://yiwu.wuliu.v-get.com/tuoyun/?sc=2&sk=%E7%A6%8F%E5%BB%BA',"p":"http://p8.npccchina.com/250x220/d1.jpg","k":'义乌泰达托运，泉州、福州'},{"l":'http://yiwu.wuliu.v-get.com/banjia/',"p":"http://p8.npccchina.com/250x220/d2.jpg","k":'义乌捷锐搬家，钢琴搬运'},{"l":'http://yiwu.wuliu.v-get.com/banjia/',"p":"http://p8.npccchina.com/250x220/d3.jpg","k":'义乌四喜搬家，用心服务'},{"l":'http://yiwu.wuliu.v-get.com/tuoyun/?sc=2&sk=%E5%B9%BF%E4%B8%9C',"p":"http://p8.npccchina.com/250x220/d4.jpg","k":'义乌托运到广东，一路顺风'}];
H($('dk'),'<a href="'+MK[0].l+'">'+MK[0].k+'</a>');
for(I=0;I<5;I++){
	var a=$('do^A'),k=MK[I],r=k.l;
	a[I].href=r;
	E(a[I],$8,function(){for(I=0;I<5;I++)if(a[I]==this)MD(I)});
	$('dc').innerHTML+='<li><a href="'+r+'"><img src="'+k.p+'" /></a></li>';
	}
M('d',218,5,5000,MD);