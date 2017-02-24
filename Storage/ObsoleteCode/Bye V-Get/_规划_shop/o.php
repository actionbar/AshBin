<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style type="text/css">
<!--
*{padding:0;margin:0}
body {background:#fff;font-size:12px;color: #333;font-family:"Tahoma","SimSun"}
.w,.tc{margin: 0px auto; overflow: hidden; width: 990px}
.t{background:url(i.png)}
img{ border:0}.q{float:right}
/*这个可以被很多利用*/
/*H头部css*/
.t{margin: 0px auto;LINE-HEIGHT: 26px;HEIGHT: 26px;border-bottom:#dadada 1px solid}
.t a{padding:0 3px}
.t{background:url(i.png)}
#a th{font-size:14px}
#a th a{font-size:12px;font-weight:400}
#a tr,.v1 th{height:28px;line-height:28px;}
#a input{ border:#fff 1px solid; background:0;height:20px}
#a .sa{width:500px}
.c{ border:1px #ccc solid; padding:0}
.c th{ background:#fff4d7}
.c th,.c td{width:80px; text-align:center; border:#ccc solid; border-width:0 1px 1px 0}
.c .n{width:300px}
.t img{}
.c input{width:30px; text-align:center}
.c img{height:50px;width:50px;}
.f2{font-weight:800;color:#F00}
.cb td{ text-align:right}
-->
</style>
<title>V-Get! 微商城-微网购首选，正品行货，价廉优品，让V时代的购物，无所不Get!</title>
</head>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/i.js"></script>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/hao/i.js"></script>
<body>
<div class="t"><div class="tc"><a href="" class="th">收藏V-Get!商城</a><span class="q" id="e"><a href="http://localhost:8080/v-get.com/shop/log.php">登录|注册</a></span></div></div>
<div class="w">
<form action="http://localhost:8080/v-get.com/shop/pay.php" method="post">
<?php
$pi=$_POST['i'];
$pn=$_POST['n'];
$pm=$_POST['m'];
$pp=$_POST['p'];
$pb=$_POST['b'];
$pj=$_POST['j'];
$pt=$p*$m;
if(isset($_SESSION['ma'])){
 echo '<table id="a">
<tr><th width="100">收货人信息</th><th><a href="http://没有js时修改收货人" onclick="javascipt:a(this);return false" id="b">[修改]</a></th></tr>
<tr><td class="q">收货人姓名：</td><td><input type="text" value="'.$_SESSION['mn'].'"/></td></tr>
<tr><td class="q">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</td><td><input type="text" value="'.$_SESSION['md'].'" class="sa"/></td></tr>
<tr><td class="q">手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机：</td><td><input type="text" value="'.$_SESSION['mc'].'"/></td></tr>
<tr><td class="q">固定电话：</td><td><input type="text" value="0'.$_SESSION['mf'].'"/></td></tr>
<tr><td class="q">Email：</td><td><input type="text" value="'.$_SESSION['mb'].'"/></td></tr>
<tr><td class="q">QQ：</td><td><input type="text" value="'.$_SESSION['mq'].'"/></td></tr>
<tr><td class="q">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编：</td><td><input type="text" value="'.$_SESSION['mo'].'"/></td></tr>
</table>	
	';
	}
else {
echo '尊敬的客户您好，您尚未登录V-Get! 如果您仅是临时购买，请仔细填写以下收货人的所有信息。我们将按以下临时信息发货，如果您已经注册微商城，请登录后购买。谢谢！';}


echo '
<table cellspacing="0"  class="c">
<tr><th>商品编号</th><th colspan="2">商品名称</th><th>微购价</th><th>返现</th><th>赠送积分</th><th>数量</th><th>删除商品</th></tr>
<tr><td><input type="hidden" value="'.$pi.'" name="pi[]"/>'.$pi.'</td><td><a href=""><img src="http://localhost:8080/v-get.com/shop/imgs/1_2.jpg" /></a></td><td class="n"><input type="hidden" value="'.$pn.'" /><a href="">'.$pn.'</a></td><td><input type="hidden" value="'.$pp.'" /><span class="f2">￥'.$pp.'</span></td><td>'.$pb.'</td><td>'.$pj.'</td><td><input type="text" value="'.$pm.'" /></td><td><a href="">删除</a></td>
</tr>
<tr class="cb"><th colspan="8"> 总价：<span class="f2">￥'.$pt.'</span>元</th></tr>
</table>
';
?>
</form>
</div>

<script language="javascript" type="text/javascript">

var i=$('a^INPUT');
for(I=0;I<L(i);I++){
	var o=i[I]; 
	o.readOnly=$1;
	E(o,'mouseover',function(){this.title="双击修改"});
	E(o,'dblclick',function(){H($('b'),'[确认]');this.readOnly=$0;this.style.borderColor='#cc0';});
	}
	
function a(o){var i=$('a^INPUT'),o;
	if(H(o)=='[修改]'){H(o,'[确认]');
	for(I=0;I<L(i);I++){o=i[I];o.readOnly=$0;o.style.borderColor='#cc0';}}
	else {H(o,'[修改]');
		for(I=0;I<L(i);I++){o=i[I];o.readOnly=$1;o.style.borderColor='#fff'}
		
		
		}
	}

A('http://localhost:8080/v-get.com/shop/lg.php','','e');
</script>

</body></html>