<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require('weibo_global.php');

//对表单传递的字符需要不需要进行addslashes()需要先看看php.ini有没有开启magic_quotes_gpc，如果已经开启了，就不需要使用，PHP会自动addslashes()。【' " \ \0 】
// 如果用于插入数据库，就需要对"转义，如果是重新post出去，就不能，就需要用stripslashes() 对默认转义反解
$GMQG=get_magic_quotes_gpc()?TRUE:FALSE;

if(isset($_POST['f'])&&isset($_POST['wb'])){
$F=$_POST['f'];
// 删除由 默认addslashes() 函数添加的反斜杠，如默认对 " 转成 \" ,这里不需要插入数据库，所以不需要转义
$F=$GMQG?stripslashes($F):$F;$F=urlencode($F);
$wb=$_POST['wb'];
$img=empty($_POST['img'])?'':'&img='.urlencode($_POST['img']);


//file是个数组，不能使用urlencode，需要使用http_build_query

foreach($wb as $wbs=>$wbk){
if(!empty($wbk)){
// $'love'  ===  $love;
$wbka=explode(':',$wbk);
$wbsite=$wbka[1];
$wbvar='url_token_'.$wbka[0].'_'.$wbsite.$wbka[2];
//echo $$wbvar;
$wbvar=$$wbvar;
$wbvar.=$img.'&f='.$F;
//echo $wbvar;
WeiBo($wbsite,$wbvar);
}
}



}	
	
?>
<script type="text/javascript" src="/tu/i.js"></script>
<script type="text/javascript" src="/tu/i.css"></script>
<div style="padding:0 9px">
<p style="color:#F80;font:400 12px/22px Arial">新闻性，及时发布</p>
<form method="post" id="s" enctype="multipart/form-data">
<textarea style="width:100%;height:90px" name="f" id="f" alt="由于发布会自动添加图标，保存19个字符的图标"></textarea>
<br><span id="fcount">125</span> 字
<br>
<p>图片网址：<input type="text" autocomplete="off" name="img" id="img" style="height:22px;width:350px" onblur="C($('changecolor'),'');" onfocus="C($('changecolor'),'changecolor');"/>
<input type="file" name="file" class="input_file" style="width:70px">
</p>
<select name="wb[]" id="wbsina"><option value="">-新浪-</option><option value="e:sina:0000">IT官人</option><option value="e:sina:00000">@-Vince-Well-</option><option value="e:sina:00000">@微博账号</option></select>
<select name="wb[]" id="wbqq"><option value="">-QQ-</option><option value="e:qq:0000">@微博账号</option><option value="e:qq:0000">-Vince-Well-</option><option value="e:qq:00000">@微博账号</option></select>
<input type="button" id="fesubmit" value="发布">
</form>
</div>
<script>
var count=$i(H($("fcount")));
E($("wbsina"),'change',function(){
var t=this.options[this.selectedIndex].text;
F($("wbqq^option"),function(o){o.selected=O;
if(t==H(o)){o.selected="selected";}
});
});


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
if($i(L(H('fcount')))<0){alert('字数');return false}
else{$("s").submit();}


});
</script>