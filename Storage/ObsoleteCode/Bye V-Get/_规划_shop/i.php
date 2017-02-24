<?php 
require('c.php');
$l=$_GET['l'];
$i=$_GET['i'];
/*肯定用同一个页面，因为，查询商品用编码，编码网址才能固定*/
$t=mysql_query('SELECT * FROM c WHERE i='.$i);
$tr=mysql_fetch_array($t);
$h=$tr['h'];
$w=$tr['w'];/*重量g*/
if($w>1000){$w/=1000;$W=$w.'kg';}
else {$W=$w.'g';}
$A=$tr['a'];/*通过页面获取*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" href="i.css" />
<link rel="shortcut icon" href="http://localhost:8080/v-get.com/i/shop.ico"  />
<link rel="stylesheet" type="text/css" href="http://localhost:8080/v-get.com/shop/i.css" />
<title><?php echo $h;?></title>
</head>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/i.js"></script>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/hao/i.js"></script>
<body>
<div class="t"><div class="tc"><a href="http://localhost:8080/shop.v-get.com/" class="th">V-Get! 首页</a><a href="" class="th">收藏V-Get!商城</a><span class="q" id="e"><a href="http://localhost:8080/v-get.com/shop/log.php">登录|注册</a></span></div></div>
<div class="w">
<?php include('http://localhost:8080/v-get.com/shop/c.htm');?>

<div class="o v">

<?php include('p/'.$l.'.html');?>

<div class="q r">
<?php
echo '<h1>'.$h.'<span class="f9">'.$tr['d'].'</span></h1>';
?>
<div class="rv">
<div class="p ri">
<div id="c"><img src="http://localhost:8080/v-get.com/i/shop/i2/<?php echo $i;?>_0.jpg" /></div>
<div>
<div class="p rii ril"></div>
<div id="ci" class="p">
<ul><li><img src="http://localhost:8080/v-get.com/i/shop/i1/<?php echo $i;?>_0.jpg" /></li><li><img src="http://localhost:8080/v-get.com/i/shop/i1/<?php echo $i;?>_1.jpg" /></li><li><img src="http://localhost:8080/v-get.com/i/shop/i1/<?php echo $i;?>_2.jpg" /></li><li><img src="http://localhost:8080/v-get.com/i/shop/i1/<?php echo $i;?>_3.jpg" /></li><li><img src="http://localhost:8080/v-get.com/i/shop/i1/<?php echo $i;?>_4.jpg" /></li></ul>
</div>
<div class="p rii rir"></div>
</div>


</div>
<div class="p rg">
<div class="rgt">
<ul>
<li>商品编码：<?php echo $A.$i;?></li>
<li>微&nbsp;商&nbsp;价：<b class="f9">￥<?php echo $tr['p'];?></b></li>
<li>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;达：上海 有货</li>
<li>商品评分：<span class="rgi"><span></span><a href="">(点击查看评价)</a></span></li>
<li>优惠促销：<span class="f9">返还VG金￥<?php echo $tr['o'];?></span></li>
</ul>
</div>
<div class="rgb">
<form action="http://localhost:8080/v-get.com/shop/o.php" method="post">
<?php echo $tr['l'];?>
<p><input type="hidden" value="3323" name="i" /><input type="hidden" value="海信（Hisense）LED39K200 39英寸 窄边节能LED电视（黑色）" name="n" /><input type="hidden" value="2999.00" name="p" /><input type="hidden" name="j" value="0" /><input type="hidden" name="b" value="0" />我要购买：<a href="javascript:void(0)" class="rga" onclick="var k=$i($('rk').value);if(k>1)$('rk').value=k-1;">-</a><input type="text" value="1" name="m" id="rk"/><a href="javascript:void(0)" class="rga" onclick="var k=$i($('rk').value);$('rk').value=k+1;">+</a></p>
<p class="rgbb"><input type="submit" value="加入V购车" class="rs rs1"/><a href="">收藏</a><span class="f3">(已有0人收藏)</span></p>
</form>
</div>
</div>

</div>


<div class="o c">
<div class="ct">
<h2 id="ct"><a href="javascript:void(0)" class="cto">商品介绍</a><a href="javascript:void(0)">规格参数</a><a href="javascript:void(0)">售后清单</a></h2>
<ul>
<li>商品名称：<?php echo $h;?></li>
<li>商品毛重：<?php echo $W;?>&nbsp;&nbsp;</li>
<li>上架时间：<?php echo $tr['t'];?></li>
</ul>
</div>
<div class="cb">
<?php echo $tr['f'];?>
<!---->
</div>

</div>




</div>
</div>
<!--for v-->
<div class="o w4">
fdfdfs
</div>
<div class="o b">
<p><a href="">关于我们</a>|<a href="">联系我们</a>|<a href="">人才招聘</a></p>
<p>Copyright&copy; 微商城 2004-2012 | <a href="">京ICP证041189号音像制品经营许可证 </a><a>京音网8号京公网安备110101000001号</a></p>
<div class="bb"><a href=""><img src="108_40_zZOKnl.gif" /></a><a href=""><img src="108_40_OaNIwt.jpg" /></a><a href=""><img src="112_40_WvArIl.png" /></a></div>
</div>



</div>

</div>
<script type="text/javascript" language="javascript">X();
E($('nl'),'mouseover',function(){D($('d'),1)});
E($('nl'),'mouseout',function(){D($('d'))});
var li=$('ci^LI');
for(I=0;I<L(li);I++)
{E(li[I],'mouseover',function(){C(this,'rio');for(I=0;I<L(li);I++){if(li[I].className=='rio')$('c^IMG')[0].src=$('c^IMG')[0].src.replace(/_\d+\.jpg/,'_'+I+'.jpg')}});
E(li[I],'mouseout',function(){C(this,'')});
}

var ca=$('ct^A'),lca=L(ca);for(I=1;I<lca;I++){D($('c'+I))}
for(I=0;I<lca;I++){E(ca[I],'click',function(){for(I=0;I<lca;I++){C(ca[I],'');D($('c'+I));if(ca[I]==this){C(this,'cto');D($('c'+I),1)}}});
	
	}


/*function Add(f){
	var b=1,k='v_od13',json=CG(k)||'',i=f.i.value,m=f.m.value;
	if(L(json)>0){ 
     var js=json.substr(1).split(';');json='';
	for(I=0;I<L(js);I++){
		
		var arr=js[I].split(','),a0=arr[0],a5=$i(arr[5]);
    	if(a0==i){b=0;if($3.confirm('您已选购本商品'+a5+'件，确认再购买'+m+'件？'))a5+=$i(m);for(x=1;x<L(arr)-1;x++)a0+=','+arr[x];json+=';'+a0+','+a5;}
		else json+=';'+js[I];
     }
	}
	
	if(b)json+=';'+i+','+f.n.value+','+f.p.value+','+f.j.value+','+f.b.value+','+m;
	CS(k,json,9);
	if($3.confirm('去购物车结算？'))$3.open('http://localhost:8080/v-get.com/shop/o.html');
	}
*/
A('http://localhost:8080/v-get.com/shop/lg.php','','e');

</script>
</body>
</html>
