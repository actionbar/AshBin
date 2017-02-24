<?php
$Qc=mysql_connect('localhost','root','xxxxx');mysql_select_db('v7',$Qc);mysql_query('set names utf8');
$time=time();
$T=date('Y-m-d H:i:s',$time);$YR=date('Y',$time);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title>E维科技初级编辑</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://localhost/www.v-get.com/tu/i.js"></script>
<script type="text/javascript" src="http://localhost/www.v-get.com/tu/l.js"></script>
</head>
<style>*{margin:0;padding:0}#s p{line-height:32px;height:32px}
.centerp{color:#333}
#rightext{font-size:12px}
#rightext h2{border-bottom:1px solid #DDD;font:700 14px "微软雅黑"}
#rightext h3{font:700 12px "Arial";}.fo{text-align:center}
#rightext img{max-width:500px}
#rightext p{line-height:22px}
.fq{text-algin:right;}
#fimg{margin:0 9px}
#fimg a{display:inline-block;width:50px;height:28px;text-align:center;background:#FFF;color:#000;text-decoration:none}
#fimg a.fimgo{background:#999;color:#FFF;}
</style><body>
<div style="float:left;width:46%">
<form method="post" id="s">
<p><label>站点s：</label><select name="database"><option></option><option value="2">百科</option><option value="3">物流</option><option value="8">E维科技</option></select><label>表</label><input type="text" name="table" maxlength="9" style="width:50px" /><label>一类a：</label><input type="text" value="0" style="width:20px" name="a" maxlength="1"/><label>城市b：</label><input type="text" value="330782" style="width:50px" size="6" maxlength="6" name="b"/><label>分类c：</label><input type="text" value="0" style="width:20px" name="c" maxlength="1"/><label>评级g：</label><input type="text" style="width:20px" name="g" value="0"/></p>
<p><label>标题h：</label><input type="text" style="width:400px" name="h"/> &lt;75&gt; <span style="color:#080"></span></p>
<p><label>关词k：</label><input type="text" style="width:200px" name="k"/> &lt;60&gt; <span style="color:#080"></span>逗号隔开<label> t：</label><input type="text" style="width:130px" name="t" value="<?php echo $T;?>"/></p>
<p style="height:60px"><label>简介d：</label><textarea name="d" style="width:500px;height:60px"></textarea> &lt;255&gt; <span style="color:#080"></span></p>
<p><label>来源n：</label><input type="text" style="width:250px" name="n" value='<a href="http://www.v-get.com/">商务网</a>'/> &lt;255&gt; <span style="color:#080">64</span><label>编辑m：</label><input type="text" style="width:50px" name="m" value=''/> &lt;16&gt; <span style="color:#080">0</span> <span style="color:#F00">仅英文</span> </p>
<p><input type="submit" style="width:40px;height:22px" value="发布"/><span id="fimg"><a href="#" class="fimgo">图片</a><a href="#">文章</a></span></p>
<textarea name="f" cols="83" rows="36"></textarea>

</form>
</div>
<div style="float:left;width:13%;line-height:22px;font-size:12px;color:#00c" id="note">
<p class="centerp">Ctrl+b  <strong>strong</strong></p><p class="centerp">Ctrl+i  <em>em</em></p><p class="centerp">Ctrl+Sft+z  <b>h3</b></p><p class="centerp">Ctrl+Sft+x  <b>h2</b></p>
<div id="c2" style="display:none"><p>百科比较学术，注重被引用，所以案例都是新闻！！！</p><p>1. 名词解释</p><p>2. 法律原本</p><p>3. 产品如notepad++ 的名词官网</p></div>
<div id="c3" style="display:none"><p>百科比较学术，注重被引用，所以案例都是新闻！！！</p><p>1. 名词解释</p><p>2. 法律原本</p><p>3. 产品如notepad++ 的名词官网</p></div>
<div id="c8" style="display:none">
<strong>a 第一类</strong><br>1 主机域名新闻host<br>2 网站web<br>3 云办公新闻office<br>4 网络营销新闻sem<br>5 视觉新闻vi<br>6 软件新闻soft<br>7 程序猿故事programmer<br>8 联盟网赚union<br>9 公告notice<br>
<strong>b 第二类</strong><br>1 计算机 pc<br>2 社交论坛social<br>3 电商站shop<br>4 网游娱乐game<br>5 音乐影视mv<br>6 移动互联网smart<br>7 综合门户 home<br>8 垂直网站 vertical<br>9 搜索引擎seo<br>
<strong>c 第三类</strong><br>1 业界资讯 news<br>2 创业人物pioneer<br>3 网络维权ensure<br>4 未来趋势trend<br>5 站长经验master<br>6 好站推荐good<br>7 病毒安全safe<br>8 运营管理 manage<br>9 技术资源 program<br><strong style="color:#F00">评级</strong><br>文章：【1推荐 3爆料 8优秀 9置顶】
</div>
</div>
<div style="float:right;width:40%" id="rightinsert">
<div><input type="text" style="width:100%"  id="surl"/><br><input type="text" style="width:100%" value='<a href="http://s.v-get.com/l?l="></a>' readonly="readonly" id="surl2"/></div>
<iframe id="imgftp" style="width:100%;height:700px;display:none"></iframe>
<?php
if(isset($_POST['database'])&&isset($_POST['table'])&&isset($_POST['a'])&&isset($_POST['b'])&&isset($_POST['c'])&&isset($_POST['h'])&&isset($_POST['k'])&&isset($_POST['d'])&&isset($_POST['t'])&&isset($_POST['f'])&&isset($_POST['g'])){
echo '<textarea id="right" style="width:100%;height:600px">';
$DB='v'.$_POST['database'];$TB=$_POST['table'];$A=$_POST['a'];$B=$_POST['b'];$C=$_POST['c'];$h=$_POST['h'];
$k=$_POST['k'];$d=$_POST['d'];$n=$_POST['n'];$T=$_POST['t'];
$f=$_POST['f'];
$f=str_replace('"','\"',$f);
$f=str_replace("'","\'",$f);
$H=$h;$K=$k;$D=$d;$N=$n;
$F=$f;
if($DB=='v2'){
if(strlen($M)>0){$Qs="INSERT INTO $DB.$TB (a,b,c,h,k,d,n,t,f) VALUES ($A,$B,$C,'$H','$K','$D','$N','$T','$F');";}
else {$Qs="INSERT INTO $DB.$TB (a,b,c,h,k,d,n,t,f) VALUES ($A,$B,$C,'$H','$K','$D','$N','$T','$F');";}
}
else {
$g=$_POST['g'];$m=$_POST['m'];$M=$m;$G=$g;
if(strlen($M)>0){$Qs="INSERT INTO $DB.$TB (a,b,c,h,k,d,m,n,t,f,g) VALUES ($A,$B,$C,'$H','$K','$D','$M','$N','$T','$F',$G);";}
else {$Qs="INSERT INTO $DB.$TB (a,b,c,h,k,d,n,t,f,g) VALUES ($A,$B,$C,'$H','$K','$D','$N','$T','$F',$G);";}
}

$Flen=mb_strlen($F,'utf-8');

$Fhalf=floor($Flen/2);
$F4p1=floor($Fhalf/2);
$F4p1=($F4p1>100)?100:$F4p1;
$Flike=mb_substr($F,$Fhalf,$F4p1,'utf-8');


$Qqcheck=mysql_query("SELECT i FROM $DB.$TB WHERE t='$T' OR h='$H' OR d='$D' OR f LIKE '%$Flike%'");
$Qrcheck=mysql_num_rows($Qqcheck);
if($Qrcheck>0){
$Qacheck=mysql_fetch_array($Qqcheck);
echo 'id=',$Qacheck['i'],'#######################################重复提交！############################             ',$Qs;

}
else{
mysql_query($Qs,$Qc) or die ('错误'.mysql_error());

$Qqid=mysql_query("SELECT * FROM $DB.$TB WHERE t='$T' AND h='$H' LIMIT 1") or die ('错误'.mysql_error());
$Qaid=mysql_fetch_array($Qqid);
$textI=$Qaid['i'];$textA=$Qaid['a'];$textB=$Qaid['b'];$textC=$Qaid['c'];$textH=$Qaid['h'];$textK=$Qaid['k'];$textD=$Qaid['d'];$textN=$Qaid['n'];$textT=$Qaid['t'];$textF=$Qaid['f'];
if($DB=='v2'){
$QsText="INSERT INTO $DB.$TB (i,a,b,c,h,k,d,n,t,f) VALUES ($textI,$textA,$textB,$textC,'$textH','$textK','$textD','$textN','$textT','$textF');";
}
else {
$textG=$Qaid['g'];$textM=$Qaid['m'];
$QsText="INSERT INTO $DB.$TB (i,a,b,c,h,k,d,m,n,t,f,g) VALUES ($textI,$textA,$textB,$textC,'$textH','$textK','$textD','$textM','$textN','$textT','$textF',$textG);";
}


echo $QsText;


}
echo '</textarea>';
$htmlT=strtotime($textT);$htmlT=date('Y-m-d',$htmlT);
echo $htmlT,'/',$textI,'.html';

}

?>




</div>

<div id="rightext" style="float:right;width:40%;display:none"></div>

<script>


var s=$('s'),database=s.database,tables=[],h=s.h,k=s.k,d=s.d,m=s.m,n=s.n,f=s.f,st=s.t;
tables[2]='c';tables[3]='f2013';tables[8]='f2013';
var o_sa=s.a.value,o_sb=s.b.value,o_sc=s.c.value;
comes=['','','<a href="http://baike.v-get.com/">商务百科</a>','<a href="http://wuliu.v-get.com/">商务物流网</a>','','','','','<a href="http://e.v-get.com/">E维科技</a>'];
function v(s){return L8(s.value)}




function imgsrc(){
/* 	普通img  i="http://.....jpg"   百科img  目录是一个字母的site  
   13年[1-9abc]月[1-9a-v]日[1-9a-p]时45分03秒
i="1312a0305_1.jpg"   ==>新闻的目录是site3/年。。 
新闻img i="3/13baa0305_1.jpg" 
*/

/* 将str "2005-12-15 09:41:30"; 变成 js date */
var str=[0,'1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

var stv=st.value,date=stv.split(' ')[0],adate=date.split('-'),year=adate[0].substr(2),month=parseInt(adate[1]),day=parseInt(adate[2]),time=stv.split(' ')[1],atime=time.split(':'),hour=parseInt(atime[0]),minute=atime[1],second=atime[2];

var dt=year+str[month]+str[day]+str[hour]+minute+second;

//var dt=$r($r(st.value,/[-:\s]+/g,''),/^20(\d{12})$/,'$1');

$("imgftp").src="___upload.php?imgfile="+database.value+"&imgtime="+dt+"_";
D($("imgftp"),I);
}

E(database,'change',function(){s.table.value=tables[this.value];
F($('note^div'),function(o){D(o)});
imgsrc();
if($('c'+this.value)){D($('c'+this.value),I);}
n.value=comes[this.value];
});

E(st,'input',function(){imgsrc();});

E(h,'input',function(){$('^span',this.parentNode)[0].innerHTML=L8(this.value)});

E(k,'input',function(){if(this.value.match("，")){this.value=$r(this.value,/，/g,",");}$('^span',this.parentNode)[0].innerHTML=L8(this.value)});
E(d,'input',function(){$('^span',this.parentNode)[0].innerHTML=L8(this.value)});
E(m,'input',function(){$('^span',this.parentNode)[1].innerHTML=L8(this.value)});
E(n,'input',function(){$('^span',this.parentNode)[0].innerHTML=L8(this.value)});


function fimga(i,o){F($("fimg^a"),function(a2){C(a2,"");D($("rightinsert"));D($("rightext"));});C(o,"fimgo");(i==0)?D($("rightinsert"),I):D($("rightext"),I);}

F($("fimg^a"),function(a,i){
E(a,$7,function(){fimga(i,this);});
});

function editor(o,s)
{
var a="<"+s+">",b="</"+s+">";
   if(document.selection){if(L(range.text>0))range.text=a+range.text+b;}
   if(document.getSelection){var start=o.selectionStart,end=o.selectionEnd,vs=o.value.substr(0,start),vc=o.value.substring(start,end),ve=o.value.substring(end, o.value.length);
      if(end-start>0){
	  if(s=="strong"){o.value=vs+a+vc+b+ve;}
      else {o.value =$r(vs,/(.+)<p>$/,"$1")+a+$r(vc,/^<p>(.+)<\/p>$/,"$1")+b+$r(ve,/^<\/p>(.+)/,"$1");}
   }
	  }
} 

/* keypress获取 按键弹起的状态，才能获取按键值 */
E(f,'keypress',function(){ 
e=event||window.event;
var k=document.all?e.keyCode:k=e.which;
  if(e.ctrlKey){
 /*ctrl+b=2*/if(k==2){editor(f,"strong");}
 /*ctrl+i=9*/if(k==9){editor(f,"em");}
 if(e.shiftKey){
 /*ctrl+shift+z=26*/if(k==26){editor(f,"h3");}
 /*ctrl+shift+x=24*/if(k==24){editor(f,"h2");}}
  }


});


function Fformat(){f.value=$r(f.value,/([^>]+)[\s|　]+(<\/p>)/g,"$1$2");
f.value=$r(f.value,/(<p>)[　|\s]+([^<])/g,"$1$2");}
var valueF='';

E(f,'blur',function(){
if(this.value!=valueF){
if(!this.value.match("</p><p>")||confirm("文中已经包含</p><p>，是否再次替换？")){
this.value=this.value.replace(/[\s|\n|　]?\n[　|\n|\s]?/g,"</p><p>");
this.value="<p>"+this.value+"</p>";
this.value=this.value.replace(/<\/p><\/p>/g,"</p>");
this.value=this.value.replace(/<p><p>/g,"<p>");
this.value=this.value.replace(/<\/p><p>\s?$/g,"</p>");
this.value=this.value.replace(/^<p>\s?</g,"<");
this.value=this.value.replace(/<\/p><p><\/p><p>/g,"</p><p>");
this.value=this.value.replace(/\(微博\)/g,'');
this.value=this.value.replace(/<\/div><\/p>/g,"</div>");
this.value=this.value.replace(/<p><div>/g,"<div>");
}


Fformat();
var righttext=$r(this.value,/<img([^>]+)i="([^"]+)"/g,'<img$1i="$2" src="http://localhost/www.v-get.com/tp/i/$2"');
H($("rightext"),righttext);
fimga(1,$("fimg^a")[1]);
valueF=this.value;
}
});
s.onsubmit=function(){
if(v(database)<1){alert('数据库字段');return false}
if(v(h)<1||v(h)>75){alert('标题');return false}
if(v(k)<1||v(k)>60){alert('关键词');return false}
if(v(d)<1||v(d)>255){alert('简介');return false}
if(v(n)<1||v(n)>255){alert('来源');return false}


Fformat();

if(v(f)<100){alert('文章');return false}
if(s.a.value==o_sa&&s.b.value==o_sb&&s.c.value==o_sc){if(!confirm("确认a b c 类不变？")){return false}}
if(v(database)>0&&v(h)>0&&v(h)<=75&&v(k)>0&&v(k)<=60&&v(d)>0&&v(d)<=255&&v(n)>0&&v(n)<=255&&v(f)>=100) {this.submit();}
else {alert('有错误@@');}

}





E($('surl'),'input',function(){
var v=this.value,url=v.replace('http://','');
url=url.replace('/','%2f');url=url.replace('?','%3f');url=url.replace('&','%26');url=url.replace('+','%2b');
url=url.replace(' ','+');url=url.replace('=','%3d');url=url.replace('#','%23');
$('surl2').value='<a href="http://s.v-get.com/l?l='+url+'">'+v+'</a>';
});

</script>


</body></html>