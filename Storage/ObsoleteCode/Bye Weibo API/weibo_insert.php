<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$GMQG=get_magic_quotes_gpc()?TRUE:FALSE;
/* 数据库 daily.weibo
i
a   【0 适合所有；1网络营销SEO；2网页技术；3程序猿段子】
f  微博 
p  图片网址
 */
if(isset($_POST['a'])&&isset($_POST['f'])&&isset($_POST['img'])){
$QC=mysql_connect('localhost','root','root');mysql_select_db('daily',$QC);mysql_query('set names utf8');
$A=$_POST['a'];
$F=$_POST['f'];
$P=$_POST['img'];
$Qs='INSERT INTO weibo (a,f,p) VALUES ('.$A.',"'.$F.'","'.$P.'")';
$Qq=mysql_query($Qs);
}
?>
<script type="text/javascript" src="http://tu.luexu.com/i.js"></script>
<script type="text/javascript" src="http://tu.luexu.com/i.css"></script>
<div style="padding:0 9px">
<p style="color:#F00;font:400 12px/22px Arial">好段子存入数据库，留以后自动发布</p>
<form method="post" id="s" enctype="multipart/form-data">
<textarea style="width:100%;height:90px" name="f" id="f" alt="由于发布会自动添加图标，保存19个字符的图标"></textarea>
<br><span id="fcount">125</span> 字
<br>
<p>图片网址：<input type="text" autocomplete="off" name="img" id="img" style="height:22px;width:350px" onblur="C($('changecolor'),'');" onfocus="C($('changecolor'),'changecolor');"/>
</p>
<select name="a">
   <option value="-1">-类别-</option>
   <option value="0">全适合</option>
   <option value="6">笑话</option>
   <option value="1">SEO+SEM</option>
   <option value="2">网页技术</option>
   <option value="3">程序猿段子</option>
   <option value="4">商务管理</option>
   <option value="5">成人段子</option>
   
</select>
<input type="button" id="fesubmit" value="写入">
</form>
</div>
<script>
var count=$i(H($("fcount")));



E($("img"),'blur',function(){
if(!(/^https?\:\/\//i.test(this.value))){this.value=''}
});

E($("f"),'input',function(){
this.value=$r(this.value,'','');
var h=this.value,l=L(h);
l+=L($r(h,/[\x00-\xff]/g,''));
l=Math.ceil(l/2);
l=count-l;
H($("fcount"),l);
$("fcount").style.color=(l<0)?'#F00':'#000';
});

E($("fesubmit"),$7,function(){
if($i(L(H('fcount')))<0||$i($("s").a.value)<0){alert('字数或类别');return false}
else{$("s").submit();}


});
</script>