var s=$('fes');


/*editor */
//每天更新一次任务检索，后台editor_task，从里面获得 v_newtask值，每更新一次任务，v_newtask就变一次
var globalDate = new Date(),newTask=globalDate.getMonth()+''+globalDate.getDate()+''+globalDate.getHours()+$i(globalDate.getMinutes()/9);
//修改文件第一个名字，就可以更改关键词
var url=this.location.href,pos=url.lastIndexOf("/");if(pos==-1){pos=url.lastIndexOf("\\")}
var UaP=$p($s(url,pos+1),'.'),v_user=UaP[L(UaP)-3],v_pass=UaP[L(UaP)-2],task="http://tp.v-get.com/editor/task.php?user="+v_user+"&t="+newTask;
J(task,function(){
if(!T(FE_UserCus,5)){alert("用户名和密码错误！请联系E维科技找寻帐号和密码");return;}
//et_cid 客户网站id，用于获取上传图片文件/关键词提示
//et_class 该客户网站的任务等级 
//et_duties 客户网站该任务等级的，任务量
var et_cid=9999999,et_class=0,et_duties=0;
//js中 json没有length,只能用var i in json
//alert(FE_UserCus["9999999"][0].v);
for(var etc in FE_UserCus){var etca=FE_UserCus[etc][0];
for(var etci in etca){var etcii=$i(etca[etci]);if(etcii>0){et_cid=$i($s(etc,1));et_class=$i($s(etci,1));et_duties=etcii;}};
}
//alert(et_cid+"："+et_class+"："+et_duties);
J(FE_Tasks+'i='+et_cid,function(){
H($("fecls"),FE_S_Classes);H($("feknote"),FE_CUS_NOTE);


function inArray(str,arr){var l=L(arr);
for(var i=0;i<l;i++){if(str==arr[i])return I;if(i==(l-1)&&str!=arr[i])return O/*这里不能用三元，因为不符合，不用返回的。否则不符合就返回了，一直不符合*/}}

var arr_FE_CUS_Keywords=[];


F($p($r(FE_CUS_Keywords,'，',','),','),function(karr){if(L(karr)>0&&!inArray(karr,arr_FE_CUS_Keywords)){arr_FE_CUS_Keywords.push(karr);}});





F(arr_FE_CUS_Keywords,function(k){k=H($("fekwds"))+'<a href="http://news.baidu.com/ns?word='+encodeURI('"'+k+'"')+'" target="_blank">'+k+'</a>';H($("fekwds"),k);});

H($("toptitle"),'<form action="'+FE_UserCountUrl+'" method="post" target="_blank" onsubmit="if(this.guser.value==\'_\'||this.guser.value==\'editor\'){this.action=\'http://e.v-get.com/tech/\';confirm(\'非注册用户不可查看发布量和任务量\');}"><input type="hidden" name="guser" value="'+v_user+'"><input type="hidden" name="gpass" value="'+v_pass+'"><input class="topss" type="submit" title="查看任务量和已发布记录" style="" value="E维科技，一切只为网络营销！ —— 最佳浏览环境在谷歌Chrome浏览器下使用。"><input type="submit" value="" class="topss"><input type="submit" value="" class="topss"></form>');

if(L(FE_S_PreCode)>0){H($("fecode").parentNode,FE_S_PreCode);}




s.action=FE_UP;s.fevgtsid.value=et_cid;s.fevgtusr.value=v_user;s.fevgtpass.value=v_pass;
s.fen.value=FE_S_N;s.fen.readOnly=(FE_EditorClass<5)?I:O;
H($("femo"),ec_mold);H($("fego"),FE_S_G);
//$("rightnote^iframe")[0].src+="http://e.v-get.com/issue/editor.html?u="+v_user+"&e="+FE_EditorClass;
var o_sa=s.fea.value,o_sb=s.feb.value,o_sc=s.fec.value,st=s.fet;



//s.cusweb.value=function(){var surl=$p($r(s.action,$2,''),'/')[0]; return surl}();

/*把图片那个PHP放到tp.v-get.com 下，或者对本地有PHP环境的，可以放本地*/



E(s.fevgtuc,'change',function(){
if($i(this.value)>FE_EditorClass){this.value=0;alert("您暂时没有权限发布比您等级高的文章！");}
});


FEko(arr_FE_CUS_Keywords);

FEhd($("feho"));
FEhd($("fedo"));











	
	



var valueF='';
E($("fefo"),'blur',function(){
if(this.value!=valueF&&L(this.value)>30){

if(L($("fedo").value)<2){$("fedo").value=$s($r(this.value,/<[^>]+>/g,''),0,85);}
if(L($("feko").value)<2){$("feko").value='';
/*要防止关键词对 .html  替换成 关键词 HTML 了 同理 asp等*/
F(arr_FE_CUS_Keywords,function(x){
/* 这里n 加括号，是为下面替换用的，而不是为了test */
var n='([^a-zA-Z\/\%\.\<\>"\'\?\&\%=\_\-])',m=RegExp(n+$r(x,/([\+\-\$])/g,'\\$1')+n,"i").test($("fefo").value);
if(m&&L8($("feko").value+x)<60){$("feko").value+=","+x;FEk(arr_FE_CUS_Keywords);

$("fefo").value=$("fefo").value.replace(RegExp(n+$r(x,/([\+\-\$])/g,'\\$1')+n,'ig'),'$1'+x+'$2');
}});


}

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

E($("fefo"),'change',function(){if(!FEend($("fedo"),180,255))$("feko").value=''});

E($("fesubmit"),'click',function(){
var FE_CUS_Keywords_match=I;
F(arr_FE_CUS_Keywords,function(x){var m=$("fefo").value.match(RegExp($S(x),"i"));if(m){FE_CUS_Keywords_match=O;}});
if(s.fett.value<9||s.fett.value=='NaN'){alert('请查看时间是否正确');return false}
if(FE_CUS_Keywords_match){alert('请输入“文章关键词”的文章');return false}
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
s.fen.value=$r(s.fen.value,/\'/g,'&#39;');
$("fefo").value=FEf();
//每个图片150个字
if(L8($("feko").value)<1||L8($("feko").value)>60){alert('“文章关键词”字数');return false}

if(!FEend($("fedo"),180,255)){alert('请确定简介字数、句子完整、关键词包含量');return false}

if(L8(s.fevgtusr.value)<1&&L8(s.fevgtpass.value)<1){alert('请输入E维科技用户名和密码');return false}
if(L8($("feho").value)<1||L8($("feho").value)>75){alert('请查看标题字数');return false}
var sflv=$("fefo").value.replace(/<a\s[^>]+>/,""),sflvimg=L($p(sflv,"<img "))-1;sflvimg=(sflvimg>3)?3:sflvimg;


s.fevgtfl.value=L(sflv.replace(/<\/?[^>]{1,9}>/,""))+(200*sflvimg);
if(s.fevgtfl.value<(FE_CUS_WordCount+33)){alert('文章字数小于'+FE_CUS_WordCount+'字');return false}

if(L8($("feho").value)>0&&L8($("feho").value)<=75&&s.fevgtfl.value>FE_CUS_WordCount&&L($("feho").value)>0){s.fevgtfu.value=Math.floor(s.fevgtfl.value/FE_CUS_WordCount);s.fevgtfu.value=(s.fevgtfu.value>3)?3:s.fevgtfu.value;timerun=I;
s.fef.value=$("fefo").value;
s.fed.value=$("fedo").value;
s.fek.value=$("feko").value;
s.feh.value=$("feho").value;
//传递一个到 e.v-get.com的数据库，暂时用xxxxx的网址，因为DNS更快不能使用ajax，跨域
if(L(s.feimgsql.value)>4){s.feimgsql.value=$s(s.feimgsql.value,4)};
s.submit();$("feho").value='';$("fefo").value='';$("fedo").value='';$("feko").value='';s.feimgsql.value='';
D($("rightnote"),I);D($("rightinsert"));D($("fehtml"));
$("^input.topss")[0].value="E维科技，一切只为网络营销！ —— 时段发布量：";
var topss1=$("^input.topss")[1].value;topss1=(topss1=="")?0:$i(topss1);
$("^input.topss")[1].value=topss1+1;
$("^input.topss")[2].value="  ——  发布成功：“"+s.feh.value+"”";
}
else {alert('有错误');}

});

});
});

