function sF(o){var k=$r(o.sk.value,/\s{2}/g,' ');if(L(k)>0){k=$r(k,'襄樊','襄阳');k=$r(k,'礼陵','醴陵');k=$r(k,'拖运','托运');o.sk.value=$r(k,/^\s+|\s+$/g,'');o.submit()}}
var iw='';
function sC(s,a,k){
function d(){D($('z'),1);D($('csc^div')[0],1)}
function f(o){if(L(k.value)>15)k.value='';k.value+=' '+H(o);D($('z'));D($('csc^div')[0]);}
function u(s){$('csc^tbody')[1].innerHTML='<tr>'+s+'</tr>';B($('csc^td'),'#DFEDFE','','#fff','');}
var sc='';
if(L(iw)==0&&(a==1||a==5)){
$('csc^div')[0].innerHTML+='<table class="csc"><thead><tr><th colspan="5">其他省市</th></tr></thead><tbody></tbody></table>';
$A($2+s+'wuliu.v-get.com/ad/pc.json','','z',function(h){
var h,n;iw=eval("("+h+")").w,r=function(){sc='',n=0;F(iw,function(v,i){sc+='<td p="'+v.i+'" i="'+i+'">'+v.s+v.a+'</td>';if(n<4)n++;else {sc+='</tr><tr>';n=0}});u(sc);$('csc^th')[1].innerHTML='其他省市';f2();}
r();d();
function f2(){
F($('^td',$('csc^table')[1]),function(o){E(o,'click',function(){var g=$g(this,'p'),m=H(this),l=$s(m,0,(L(m)-1));
if(L(g)==2){n=1;sc='<td>'+l+'</td>';
F(iw[$g(this,'i')].c,function(e,ei){sc+='<td>';for(var y in e){sc+=e[y]};sc+='</td>';if(n<4)n++;else {sc+='</tr><tr>';n=0}});
u(sc);
H($('^th',$('csc^table')[1])[0],l+'省<a href="javascript:void(0)" onclick="r()">[其他省份]</a>');
F($('^td',$('csc^table')[1]),function(j){E(j,'click',function(){f(this)})})}else f(this)})})
}
});
}else d();A('csc','_self');}
function cF(s){F($('c^b'),function(e){E(e,$8,function(){this.style.backgroundPosition="-100px -75px"});E(e,$9,function(){if($('cz'+$g(this,'b')).style.display!="block"){this.style.backgroundPosition="-75px -75px"}});E(e,$7,function(){var x=$g(this,'b'),o=$('cz'+x);if(o.style.display!="block"){$A($2+s+"wuliu.v-get.com/d.php",x,o,function(){A('c','_blank')});D(o,1)}else{D(o)}})})}
function cB(c,o){function v(o,t){o.style.visibility=t?'visible':'hidden'};F($('c^div'),function(o){if(C(o)=="cv"){E(o,$8,function(){var x=this;v($('^b',x)[0],1);v($('^i',x)[0],1);v($('^I',x)[1],1);x.style.backgroundColor=c});E(o,$9,function(){var x=this;v($('^b',x)[0]);v($('^I',x)[0]);v($('^I',x)[1]);x.style.backgroundColor=''})}})}H($('dc'),'');var MK=[{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=',"p":$2+"weigeti.com/p8/250x220/d0.jpg","k":'浙江最大货运市场——江东货运市场'},{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=%E7%A6%8F%E5%BB%BA',"p":$2+"weigeti.com/p8/250x220/d1.jpg","k":'义乌泰达托运，泉州、福州'},{"l":$2+'yiwu.wuliu.v-get.com/banjia/',"p":$2+"weigeti.com/p8/250x220/d2.jpg","k":'义乌捷锐搬家，钢琴搬运'},{"l":$2+'yiwu.wuliu.v-get.com/banjia/',"p":$2+"weigeti.com/p8/250x220/d3.jpg","k":'义乌四喜搬家，用心服务'},{"l":$2+'yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=%E5%B9%BF%E4%B8%9C',"p":$2+"weigeti.com/p8/250x220/d4.jpg","k":'义乌托运到广东，一路顺风'}];H($('dk'),'<a href="'+MK[0].l+'">'+MK[0].k+'</a>');function MD(h,n){var a=$('do^a'),l=L(a);if(n==0||n)$('d').scrollTop=n*h;else {n=$('d').scrollTop/h;if(n==l-1)n=0;else n++}H($('dk'),'<a href="'+MK[n].l+'">'+MK[n].k+'</a>');F(a,function(o){C(o,'')});C(a[n],'do')} ;for(I=0;I<5;I++){var a=$('do^A'),k=MK[I],r=k.l;a[I].href=r;E(a[I],$8,function(){for(I=0;I<5;I++)if(a[I]==this)MD(215,I)});$('dc').innerHTML+='<li><a href="'+r+'"><img src="'+k.p+'" /></a></li>'}M($('d'),0,1,5000,$1,MD);