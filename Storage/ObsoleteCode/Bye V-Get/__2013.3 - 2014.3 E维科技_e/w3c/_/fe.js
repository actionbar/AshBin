var s=$('fes');


FEhd($("feho"));
FEhd($("fedo"));
FEhd($("fego"));
FEhd($("feko"));
FEko();





var abx=[fes.fea,$("fexo")],abxb;
F(abx,function(lo){

 E(lo,'change',function(){abxb=(T(fes.fea.value)&&T($("fexo").value))?I:O;
if(abxb){
//x要被用于链接，所以不能使用特殊符号和汉字，  . / \  += () 等都不能，只能用[\w-$]  utf-8  可以使用 - 和数字，PHP 需要用到 $
$("fexo").value=$r($("fexo").value,/[^\w$-]/g,'');
$("felo").value=fes.fea.options[fes.fea.selectedIndex].text+'_'+$("fexo").value;
function f(h){H($('^i',$("felo").parentNode)[1],h);if('v'!=h){alert('已经存在这个函数');}}

$A('ajax_l.php',$("felo").value,O,f);
timerun=I;
}

}); 

});


var valueF='';
E($("fefo"),'blur',function(){
if(this.value!=valueF&&L(this.value)>30){



H($("fehtml"),'<h1>'+$("feho").value+'</h1>'+FEf(this.value));

s.feimgsql.value='';
//判断是否包含图片
F($("fehtml^img"),function(p){
s.feimgsql.value+=' OR p="'+$p($s(p.src,p.src.lastIndexOf('/')+1),'.')[0]+'"';
});

FEimgrt(1,$("fefatab^a")[1]);
$("fefo").value=$("fefo").value.replace(/(<a[^>]+href=")([^"]+)"/,function(a,b,c){return b+VGT_LK(c)+'"'})
valueF=$("fefo").value;

}
});


E($("fesubmit"),'click',function(){



if(s.fett.value<9||s.fett.value=='NaN'){alert('请查看时间是否正确');return false}
$("feko").value=$r($("feko").value,/\'\"\-\+\*\?\#\@/g,'');
$("feho").value=$r($("feho").value,/\'/g,'&#39;');
//RSS中 xml中防止出现< 否则会当成新标签，而 &lt; 在 xml中将显示 &lt; 而不是 <如果想显示包含 < &等大量js代码的，需要在外面加<![CDATA[ ... ]]>
$("feho").value=$r($("feho").value,/</g,'&lt;');
$("feho").value=$r($("feho").value,/>/g,'&gt;');
$("fedo").value=$r($("fedo").value,/</g,'&lt;');
$("fedo").value=$r($("fedo").value,/>/g,'&gt;');
$("feho").value=$r($("feho").value,/\"/g,'&#34;');
$("feho").value=$("feho").value.replace(/—/g,'&#8212;');
$("fefo").value=$("fefo").value.replace(/\'/g,'&#39;');
$("fefo").value=$("fefo").value.replace(/—/g,'&#8212;')
$("fedo").value=$r($("fedo").value,/\'/g,'&#39;');
$("fedo").value=$("fedo").value.replace(/—/g,'&#8212;');
$("fexo").value=$r($("fexo").value,/[^\w-]/g,'');
$("felo").value=$r($("felo").value,/[^\w-]/g,'');
$("fefo").value=FEf();


//每个图片150个字
if(L8($("feko").value)<1||L8($("feko").value)>60){alert('“文章关键词”字数');return false}

if(!FEend($("fedo"),180,255)){alert('请确定简介字数、句子完整、关键词包含量');return false}

if(L8($("feho").value)<1||L8($("feho").value)>75){alert('请查看标题字数');return false}
if(L8($("fexo").value)<1||L8($("fexo").value)>30){alert('请查看函数名字数');return false}
if(L8($("fego").value)<1||L8($("fego").value)>33){alert('请查看g字数');return false}


if("v"!=H($('^i',$("felo").parentNode)[1])&&$("felo").value!=s.update.value){alert('l已经存在，或者ajax问题');return O}
s.fef.value=$("fefo").value;
s.fed.value=$("fedo").value;
s.fek.value=$("feko").value;
s.feh.value=$("feho").value;

s.feg.value=$("fego").value;
s.fex.value=$("fexo").value;
s.fel.value=$("felo").value;
//传递一个到 e.v-get.com的数据库，暂时用yimuyitiantang的网址，因为DNS更快不能使用ajax，跨域
if(L(s.feimgsql.value)>4){s.feimgsql.value=$s(s.feimgsql.value,4)};
s.submit();
timerun=I;
$("felo").value='';$("fexo").value='';$("fego").value='';$("feho").value='';$("fefo").value='';$("fedo").value='';$("feko").value='';s.feimgsql.value='';
D($("rightnote"),I);D($("rightinsert"));D($("fehtml"));


});


