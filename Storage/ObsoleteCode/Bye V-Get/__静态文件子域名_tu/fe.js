var fes=$("fes"),timerun=I,pre_replace=[["<","&lt;"],[">","&gt;"],["'","&#39;"],['"','&#34;']];
//这个以后会被类似discuz等用到，所以要用泛名称
function VGT_LK(l){
var d='(v-get.com|weigeti.com)$';
//防止 thunder://  ftp:// 这种情况 以及相对路径
if($s(l,0,4)!='http')return l;
l=$r(l,/^https?\:\/\//,'');
if(!l.match(/.+\..+/))return '#';
if(!$p(l,'/')[0].match(RegExp($r(d,'.','\.')))){l=encodeURIComponent(l);l='http://s.v-get.com/l?l='+l;}

l=($s(l,0,4)=='http')?l:($2+l);
return l
}

// FE 代表所有 编辑器的js 和 css 开头
//禁止使用下划线和数字命名css

//本地 就是  fe???o 开头命名，且一律用id，避免传递过多无用值，form不会传递id 即使是input的 id

/*  fevgt??  从服务器传来的值
	fevgtfl  文章字数
	fevgtfu  文章算多少篇
	fevgtuc  用户类别
	fes   编辑器form
	fecls  文章类别 div id=feocls
    fehtml == html格式的，就是右边
    fefo  ==localf  
	fefquot   是否替换单引号
################ submit提交之后，只能把fe??o变为空，不能把fe??，否则即使放在提交后面也提交空#############
######但是不是所有的都需要设置fe??o ，必要设置的h d k f，其他的就再点击这些值，如果都为空，那么其他的也设置为空 #####
	fef  == f 文章部分
	fefa  == f上面 加粗/标题等 id=fefa
	fet == 时间  2013-08-30 13:20:40
	fett == 时间的数字 1367910225
	feto == 停止/修改时间按钮 id
	feg == 评级
	fego == g外面div
	fem ==作者 
	femo == m外面div
	fecode == id pre 代码的div
	feimgsql ==img 修改u=1的 数据库代码
	fesubmit  === 提交按钮 id
	feknote == 说明
	fekwds == 关键词列表
	fefrt ==div id 默认f的右侧
	*/

	
	
	
function FEt(e,s){
// 有e就是【常规时间+数字化时间】， 否则就是【单纯数字化】时间
s=s?s:$("fes");var d=new Date(),t=s.fet,n;


if(e){function z(x){return (x>9)?x:('0'+x)}

t.value=d.getFullYear()+'-'+z(d.getMonth()+1)+'-'+z(d.getDate())+' '+z(d.getHours())+':'+z(d.getMinutes())+':'+z(d.getSeconds());}

n=new Date(t.value);s.fett.value=$i(n.getTime()/1000);

}	

//对ho/do 进行特殊字符替换、字数统计、右侧显示，不能包含 \n \r
function FEhd(o){
E(o,'input',function(){H($('^i',this.parentNode)[0],L8(this.value));});
E(o,'blur',function(){
o.value=$r(o.value,/(^[\s　]*)|([\s　]*$)/g,"");
F([['—','#8212'],['\'','#39'],['\"','#34'],['<','lt'],['>','gt'],['\\\\','#92']],function(r){o.value=$r(o.value,RegExp(r[0],'g'),'&'+r[1]+';')});
H($('^i',this.parentNode)[0],L8(this.value));});
}


function FEk(a,o){o=o?o:$("feko");
F(a,function(r){
o.value=$r(o.value,/(^,)|(,$)/,'');
o.value=$r(o.value,/,{2,}/,',');
o.value=$r(o.value,RegExp('^'+$S(r),'gi'),r);
o.value=$r(o.value,RegExp($S(r)+'$','gi'),r);
o.value=$r(o.value,RegExp(','+$S(r)+',','gi'),','+r+',');
});
o.value=$r(o.value,/\+/g,'%2B');
}

function FEko(a,o){o=o?o:$("feko");
E(o,'input',function(){var x=this;
//必须要match一下，不然输入中文无法输入
F([['"',''],["'",''],['，',',']],function(r){if(x.value.match(r[0]))x.value=$r(x.value,RegExp(r[0],'g'),r[1])});

H($('^i',x.parentNode)[0],L8(x.value));});
E(o,'blur',function(){FEk(a,o);});


}

// 编辑时替换
function FEe(o,s){var a="<"+s+">",b="</"+s+">",v=[],r=0,x=['.','+','-','(',')','*','$','^','[',']','?','{','}','|']; 
   if($4.selection){if(L(range.text>0))range.text=a+range.text+b;}
   if($4.getSelection){var start=o.selectionStart,end=o.selectionEnd,vs=o.value.substr(0,start),vc=o.value.substring(start,end),ve=o.value.substring(end, L(o.value));
   if(s=="pre"){
  D($("^div.fecode")[0],I);
  E($("pre_add"),$7,function(){var c=$("fecode").value,k=$("pre_codes").value;

// -= += == != ++ --
k=k.replace(/(\$[a-zA-Z\'\"\d]+)\s*([\.\&\%\=\+\*\-\!\/]+)\s*([\$\'\"a-zA-Z\d])/g,"$1 $2 $3");
k=k.replace(/([a-zA-Z\'\"\d】]),([^\s])/g,"$1, $2");
// 防止有些  V-Get.com 等 ，链接 ?sk=love

  F(pre_replace,function(rp){if(L(rp)>0){k=k.replace(RegExp(rp[0],"g"),rp[1]);}});


  if(L(c)>0&&L(k)>0){
  o.value=vs+"<pre"+((c=="all")?"":(" "+c.replace(/;/g,'"')))+">\n"+k+"\n</pre>"+ve; D($("^div.fecode")[0]);}
  else {if(confirm("没有选定代码类型或者输入代码，确定关闭？")){D($("^div.fecode")[0]);} else return;}});}
   else{
      if(end-start>0){ 
     if(s!='replace'){	  
	  if(b!=$s(ve,0,L(b))){
	  if(s=="strong"||s=="em"){o.value=vs+a+vc+b+ve;}
	   else if(s=="a"){var link=prompt("网址：");o.value=vs+'<a href="'+$L(link)+'">'+vc+'</a>'+ve;}
	   else if(s=="an"){var link=prompt("网址：");
	   o.value=vs+'<a href="'+$L(link)+'" '+((ec_innersite>0)?'class="fa"':' style="color:#000"')+'>'+vc+'</a>'+ve;
	   }
      else {v=vs.match(/<[\w]+>$/);if(L(v)>0){r=L(v[0]);}o.value =vs.replace(/(.+)<[\w]+>$/,"$1")+a+vc.replace(/^<[\w]+>(.+)<\/[\w]+>$/,"$1")+b+ve.replace(/^<\/[\w]+>(.+)/,"$1");}
	  o.selectionStart=start+L(s)+2-r;o.selectionEnd=end+L(s)+2-r;
	  }
	  else {
	  o.value=vs.replace(RegExp('(.?)<'+s+'>([^<>]?)$'),"$1$2")+vc+ve.replace(RegExp('^([^<>]?)<\/'+s+'>(.+)'),"$1$2");
	  o.selectionStart=start-L(s)-2;o.selectionEnd=end-L(s)-2;
	  }}
	  else {var rep2=prompt(vc+" 替换成：");
	  if(rep2!=null){
	    if(rep2==""&&confirm(vc+" 确认替换成空")){rep2="";}
	  F(x,function(rp){vc=vc.replace(RegExp('(\\'+rp+')',"g"),"\\$1");});o.value=o.value.replace(RegExp(vc,"g"),rep2);}
	  
	  }}
	  else if(s=="replace"){var rep=prompt("文章被替换的词汇：");
	  if(rep!=null&&L(rep)>0){rep2=prompt(rep+" 替换成："); if(rep2!=null){
	  if(rep2==""&&confirm(rep+" 确认替换成空")){rep2="";}
	  
	 F(x,function(rp){rep=rep.replace(RegExp('(\\'+rp+')',"g"),"\\$1");});o.value=o.value.replace(RegExp(rep,"g"),rep2);}
	  
	  }
	  } } 
	  }}
	
	
//替换编辑框
function FEf(r){
//r=传递来的值，默认是 $("feof").value
//p pre_arr  v=之前值

r=r?r:($("fefo").value);





var p,v='',k="#@&PRE#@&",y="#@&P#@&";

r=r.replace(/\n/g,y);

// .+ 不能匹配 \n\r  所以不能用  .+? 代替，替换占位一律不能用正则字符，可用  #@&  

//下面r已经替换过了，所以p不能再下面r下面
p=r.match(/<pre[^>]*>.+?<\/pre>/ig);

r=r.replace(/<pre[^>]*>.+?<\/pre>/ig,k);


//这个替换必须在前面，在后面会被替换</p><p>的




var pi,pp;
F($p(r,k),function(x,i){

if(i>0){
pi=p[i-1];
pp=pi.replace(/^(<pre[^>]*>).+<\/pre>$/,'$1');
pi=pi.replace(/^<pre[^>]*>(.+)<\/pre>$/,'$1');
F(pre_replace,function(rp){if(L(rp)>0){pi=pi.replace(RegExp(rp[0],"g"),rp[1]);}});
//将换行换回\n ，避免被下面换成</p><p>
pi=pi.replace(RegExp(y,'g'),'\n');
v+=pp+pi+'</pre>';}
v+=x;});

//重新定义一次
r=v;v='';p=r.match(/<pre[^>]*>.+?<\/pre>/ig);

r=r.replace(RegExp(y,'g'),"</p><p>");



//↓对 < > ""特殊符号的替换↓

//文章中不能包含body以外的标签
F(['html','title','head','meta','link','body'],function(t){r=r.replace(RegExp('<(\/?'+t+'[^>]*)>','ig'),'&lt;$1&gt;');});
//注意 h3 class="">
r=r.replace(/<([^a-z1-7\/"])/g,'&lt;$1');
r=r.replace(/([^a-z1-7\/"])>/g,'$1&gt;');

// 替换 & 等 
r=r.replace(/&(#\d+;)/g,"%@AND@%$1");
r=r.replace(/&([a-zA-Z]+;)/g,"%@AND@%$1");
r=r.replace(/&/g,"&amp;");
r=r.replace(/%@AND@%/g,"&");

// 替换所有不可能出现的部分
r=r.replace(/(<(\/?(html|script|body|title|meta|head|link)[^>]*)>)/gi,"&lt;$2&gt;");

// 默认消失的标签
r=r.replace(/<\/?tbody>/gi,"");
r=r.replace(/<br\/>/ig,'<br>');
r=r.replace(/<(\/?)b>/ig,'<$1strong>');
r=r.replace(/<(\/?)i>/ig,'<$1em>');

//↑对 < > ""特殊符号的替换↑
//不能用 $r ，因为这里需要包含 \n \r 
r=r.replace(/(<\/p>)([^<]+)/g,"$1<p>$2");
r=r.replace(/([^>]+)(<p(?!\w)[^>]*?>)/g,"$1</p>$2");
r=r.replace(/(<\/div>)([^<]+)/g,"$1<p>$2");
r=r.replace(/([^>]+)(<div[\s>])/g,"$1</p>$2");
r=r.replace(/(<\/blockquote>)(<blockquote)/g,"$1<p>&nbsp;</p>$2");
r=r.replace(/(<\/?blockquote>)<\/p>/g,"$1");
r=r.replace(/<p>(<\/?blockquote>)/g,"$1");
r=r.replace(/<p(?!\w)[^>]*?>(<blockquote[^>]*>)/g,"$1");
r=r.replace(/<p(?!\w)[^>]*?>(<\/blockquote>)/g,"$1");
r=r.replace(/(<\/blockquote>)<\/p>/g,"$1");
r=r.replace(/([^>]+)(<blockquote[^>]*>)/g,"$1</p>$2");
r=r.replace(/(<\/?blockquote>)([^<]+)/g,"$1<p>$2");
r=r.replace(/([^>]+)(<\/?blockquote[^>]*>)/g,"$1</p>$2");
r=r.replace(/(<pre[^>]*>)<\/?p>/g,"$1");
r=r.replace(/<p(?!\w)[^>]*?>(<pre[^>]*>)/g,"$1");
r=r.replace(/<p(?!\w)[^>]*?>(<\/pre>)/g,"$1");
r=r.replace(/(<\/pre>)<\/p>/g,"$1");
r=r.replace(/([^>]+)(<pre[^>]*>)/g,"$1</p>$2");
r=r.replace(/(<\/pre>)([^<]+)/g,"$1<p>$2");
r=r.replace(/(<h\d>)<\/?p>/g,"$1");
r=r.replace(/<\/?p>(<\/h\d>)/g,"$1");



r=r.replace(/<p(?!\w)[^>]*?>(<h\d>)/g,"$1");
r=r.replace(/(<\/h\d>)([^<]+)/g,"$1<p>$2");
r=r.replace(/(<\/h\d>)<\/p>/g,"$1");
r=r.replace(/([^>]+)(<h\d>)/g,"$1</p>$2");
r=r.replace(/<\/p><\/p>/g,"</p>");
// 避免 <p><p class="fo">

r=r.replace(/<p(?!\w)[^>]*?>(<p(?!\w)[^>]*?>)/g,"$1");
r=r.replace(/<\/p><p(?!\w)[^>]*?>[\s　]*$/g,"</p>");
r=r.replace(/[\(（]微博[）\)]/g,'');
r=r.replace(/<\/div><\/p>/g,"</div>");
r=r.replace(/<p(?!\w)[^>]*?>(<div[\s>])/g,"$1");
r=r.replace(/^<\/p>(<p(?!\w)[^>]*?>)/g,"$1");
r=r.replace(/([^>]+)[\s|　]+(<\/p>)/g,"$1$2");
r=r.replace(/(<p(?!\w)[^>]*?>)[　|\s]+([^<])/g,"$1$2");



r=r.replace(/(<(blockquote|pre|div)>)\s*(<(strong|i|span)>)/g,'$2<p>$4');
r=r.replace(/(<\/(blockquote|pre|div)>)<p>(<(blockquote|pre|div)>)/g,'$2$4');

r=r.replace(/<\/p>[　\s]+(<h\d)/g,"</p>$1");

r=r.replace(/<p(?!\w)[^>o]*?>[　\s]*<\/p>/g,"");
r=r.replace(/^([^<])/g,'<p>$1');
r=r.replace(/([^>])$/g,'$1</p>');
// gb2312数据库不支持单引号  '，必须转为 &#39;  文章内部，禁止任何程序
// gb2312 不支持 ——  不支持很多字符，所以即使很省空间，但是以后处理一些字符会特别费事。
r=r.replace(/\\/g,'&#92;');r=r.replace(/—/g,'&#8212;');r=r.replace(/\\/g,'&#92;');


if(!$("fefquot").checked&&/'/.test(r))r=r.replace(/'/g,'&#39;');


F($p(r,k),function(x,i){if(i>0){v+=p[i-1];}v+=x;});
return v;

}


function FEimg(o,t){
var s=[0,'1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],d=$p($p(t,' ')[0],'-'),m=$p($p(t,' ')[1],':');
//feimgkey 用于提示，唯一值是id=felo，命名为   $($("feimgkey").value).value+'1'   $g($("feimgkey"),"feimgmenu")  用于 目录

/*没有 唯一命名，就用  133/dhis_1.jpg  用年月做目录，便于以后备份 */
// 这里容易被黑客利用



o.src=FE_IUP+"site="+fes.fevgtsid.value+"&name="+($("feimgkey")?($($("feimgkey").value).value+"_&menu="+$g($("feimgkey"),"feimgmenu")):"")+"&ym="+$s(d[0],2)+s[$i(d[1])]+"&nm="+s[$i(d[2])]+s[$i(m[0])]+m[1]+m[2]+"_&datetime="+escape(t);


D(o,I);
}


function FEimgrt(x,o){

F($("fefatab^a"),function(a){C(a,"");D($("rightnote"));D($("rightinsert"));D($("fehtml"));});


C(o,"fefatabo");
(x==0)?D($("rightinsert"),I):D($("fehtml"),I);

if(timerun||!T($("imgftp").src)){timerun=O;FEimg($("imgftp"),$("fes").fet.value);}


}

//判断是不是完整结尾，并且字数在合理范围内，一般用于判断d ，n是L8()字数上限,m是 L8()字数下限
function FEend(d,m,n){

var r=O,v=d.value,e=$s(v,(L(v)-1)),g=m?(L8(v)>m?I:O):I,j=n?(L8(v)<n?I:O):I;
//s.fed.value的结尾必须以下面符号结尾，否则就要提示  > 结尾一般用于f的 </p>
if(g&&j)F(['.','!','！','。','?','？','…','”','"','>'],function(s){if(s==e)r=I;});
return r
}









(function (s,o){

s.comes.value=$5.href;



if(o){H(o,'<div style="float:left;width:13%;line-height:22px;font-size:12px;color:#000;height:666px;overflow:scroll"><p id="feknote"></p><p id="fekwds"></p><p>&nbsp;</p><p><strong><a href="http://e.v-get.com/tech/u/Editor_1.html" target="_blank">Chrome浏览器快捷键</a></strong></p><p>&#39;单引号 ==> &amp;#39;</p><p>&#34;双引号 ==> &amp;#34;</p><p>&lt;小于 ==> &amp;lt;</p><p>&gt;大于 ==> &amp;gt;</p><p>&amp;  ==> &amp;amp;</p><p>Ctrl+B  <strong>strong 重点加粗</strong></p><p>Ctrl+I  <em>em 斜体</em></p><p>Ctrl+Sft+X  <b>h3 小标题</b></p><p>Ctrl+Sft+Z  <b>h2 大标题</b></p><p>Ctrl+Sft+A  <span class="f2" style="text-decoration:underline">a链接</span></p></div><div style="float:right;width:40%" id="rightinsert"><iframe frameborder="0" marginheight="0"  marginwidth="0" id="imgftp" style="width:100%;height:700px;display:none"></iframe></div><div id="fehtml" style="float:right;width:40%;display:none"></div><div style="float:right;width:40%" id="rightnote"><iframe frameborder="0" marginheight="0" marginwidth="0" style="width:100%;height:700px"></iframe></div><div class="fecode"><p><span><select id="fecode"><option></option><option value="all">全代码</option><option value="class=;php;">PHP</option><option value="class=;pvb;">VB/ASP</option><option value="class=;paspx;">ASP.NET</option><option value="class=;pxml;">HTML/XML</option><option value="class=;pcss;">CSS</option><option value="class=;pjs;">JS</option><option value="class=;psql;">SQL/MySQL</option><option value="class=;pcpp;">C/C++/C#</option><option value="class=;pcsharp;">C#</option><option value="class=;pjava;">Java</option><option value="class=;pconf;">conf配置</option></select></span><button id="pre_add">确定</button></p><textarea id="pre_codes" placeholder="留空点击确定就是关闭"></textarea></div>');H(s,H(s)+'<div class="a" id="fefa"><a href="javascript:void(0)" fefa="strong" title="strong 加粗">加粗</a><a href="javascript:void(0)" fefa="h3" title="h3 小标题">标题</a><a href="javascript:void(0)" fefa="em" title="强调斜体">斜体</a><a href="javascript:void(0)" fefa="a" title="链接">链接</a><a href="javascript:void(0)" fefa="blockquote" title="“引用”">引用</a><a href="javascript:void(0)" fefa="pre" title="程序代码">代码</a><a href="javascript:void(0)" fefa="replace">替换</a></div><span id="fefatab"><a href="#">上传图片</a><a href="#" class="fefatabo">文章预览</a></span><span><a href="http://e.v-get.com/tool/urlencode_urldecode.html" target="_blank">特殊符号</a></span> 不替换单引号<input type="radio" id="fefquot"><div class="o"></div><textarea id="fefo" rows="30" placeholder="fef" style="width:98%"></textarea><input type="hidden" name="fef"/><input type="text" name="feimgsql" style="width:98%"><input type="hidden" name="fevgtfl" value="0"/><input type="hidden" name="fevgtfu" value="0"/>');

F($("fefa^a"),function(ha){E(ha,'click',function(){if(/* FE_EditorClass>0&& */L($g(this,"fefa"))>0){FEe($("fefo"),$g(this,"fefa"));H($("fehtml"),'<h1>'+$("feho").value+'</h1>'+$("fefo").value);}else{alert("初级编辑请勿随意使用此类，谢谢！");}});});
/* keypress获取 按键弹起的状态，才能获取按键值 */
E($("fefo"),'keypress',function(){ 
e=event||window.event;
var k=document.all?e.keyCode:k=e.which;
  if(e.ctrlKey){
 /*ctrl+b=2*/if(k==2){FEe($("fefo"),"strong");}
 /*ctrl+i=9*/if(k==9){FEe($("fefo"),"em");}
 if(e.shiftKey){
 /*ctrl+shift+a=1*/if(k==1){FEe($("fefo"),"a");}
 /*ctrl+shift+z=26*/if(k==26){FEe($("fefo"),"h2");}
 /*ctrl+shift+x=24*/if(k==24){FEe($("fefo"),"h3");}}
  }


});


//对于wuliu公司的上传，上传也是用时间命名，方便备份，/3c/
F($("fefatab^a"),function(a,i){E(a,$7,function(){
//保证FE_IUP大于5，不然就是本地自定义上传，比如物流的200x200+50x50
(FE_IUP&&L(FE_IUP)>5&&$i(s.fett.value)>0&&(!$("feimgkey")||($("feimgkey")&&T($($("feimgkey").value).value))))?FEimgrt(i,this):alert('请等待时间显示，如果是非时间命名，就需要【确保唯一性名称'+$("feimgkey").value+'】已经输入');


});



});

}


//这里是清理完fe??o 之后再清理其他内容，如果
F(['^input','^textarea'],function(t){
F($(t,s),function(slocal){
//可输入、text、不为时间的text
if((slocal.type=='text'||slocal.type=='textarea')&&slocal.readOnly==O&&$g(slocal,"id")!='feto'){
E(slocal,'mousedown',function(){if(L($("fefo").value)<1&&L($("feho").value)<1){

if(s.fen&&FE_S_N){s.fen.value=FE_S_N;}

//var sls=[];if(s.fevgtuc)sls=sls.concat(s.fevgtuc);if(s.feg)sls=sls.concat(s.feg);if(s.fem)sls=sls.concat(s.fem);if(s.fea)sls=sls.concat(s.fea);if(s.feb)sls=sls.concat(s.feb);if(s.fec)sls=sls.concat(s.fec);
F($('^select',s),function(select){select.value=$("^option",select)[0].value;});}});}
}

);
});
//这里是清理完fe??o 之后再清理其他内容


//这里是计时器，必须放在后面，不然feto无法使用
var t=s.fet,timeInterval=$o(function(){if(timerun){FEt(I);}},1000,I);
E($("feto"),'mousedown',function(){if(!this.checked){t.readOnly=O;t.style.border="1px solid #999";timerun=O;}else{t.readOnly=I;t.style.border='0';timerun=I;}});
E(t,'change',function(){s.fett.value=0;if(this.value.match(/^20\d{2}-[01]\d-[0-3]\d\s[012]\d:[0-5]\d:[0-5]\d$/))FEt();
//时间修改之后，就需要修改img上传时间
FEimg($("imgftp"),this.value);
});
//这里是计时器，必须放在后面，不然feto无法使用

//退出有内容就提示
$3.onbeforeunload = function() {if(L($("fefo").value)>30)return "确定离开页面吗？"; } 

})($("fes"),$("fefrt"));