<?php 
require('c.php');
$l=$_GET['l'];
$A=$_GET['a'];
/*a=$1&l=$2&b=$3&c=$4&g=$5&r=$6&e=$7&q=$8 */
$b=$_GET['b'];$c=$_GET['c'];$g=$_GET['g'];$q=$_GET['q'];$e=$_GET['e'];$r=$_GET['r'];
$SQL='SELECT * FROM c WHERE a='.$A;

if($b!='0'){$SQL.=' AND b='.$b;}
if($c!='0'){$SQL.=' AND c='.$c;}
if($g!='0'){$SQL.=' AND g='.$g;}
if($q!='0'){$SQL.=' AND q='.$q;}
if($e!='0'){$SQL.=' AND e='.$e;}
if($r!='0'){$SQL.=' AND r='.$r;}
/*因为类似一个只能有一个，不存在0，所以必须用判断*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" href="../il.css" />
<link rel="shortcut icon" href="http://localhost:8080/v-get.com/i/shop.ico"  />
<link rel="stylesheet" type="text/css" href="http://localhost:8080/v-get.com/shop/il.css" />
<title>空调-家用电器</title>
</head>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/i.js"></script>
<script type="text/javascript" src="http://localhost:8080/v-get.com/i/hao/i.js"></script>
<body>
<div class="t"><div class="tc"><a href="http://localhost:8080/shop.v-get.com/" class="th">V-Get! 首页</a><a href="" class="th">收藏V-Get!商城</a><span class="q" id="e"><a href="http://localhost:8080/v-get.com/shop/log.php">登录|注册</a></span></div></div>
<div class="w">
<?php include('http://localhost:8080/v-get.com/shop/c.htm');?>

<div class="v">
<?php include($l.'.html');?>

<div class="q r">
<div class="rt">
热卖区
</div>
<div class="r2">
<!--采用js修改地址的方式修改-->
<h1>空调 - 家用电器</h1>
<dl class="r2t"><dt class="p">品牌：</dt><dd id="cb"><div><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">不限</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-1-0-0-0-0-0.html">格力</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-2-0-0-0-0-0.html">美的</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-3-0-0-0-0-0.html">志高</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-4-0-0-0-0-0.html">奥克斯</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-5-0-0-0-0-0.html">海尔</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-6-0-0-0-0-0.html">海信</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-7-0-0-0-0-0.html">科龙</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-8-0-0-0-0-0.html">格兰仕</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-9-0-0-0-0-0.html">大金</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-10-0-0-0-0-0.html">三菱电器</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-11-0-0-0-0-0.html">长虹</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-12-0-0-0-0-0.html">TCL</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-13-0-0-0-0-0.html">日立</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-14-0-0-0-0-0.html">小天鹅</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-15-0-0-0-0-0.html">新科</a></div><div><a href="http://localhost:8080/shop.v-get.com/products/2312-16-0-0-0-0-0.html">松下</a></div></dd></dl>
<dl><dt class="p">价格：</dt><dd id="cr"><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">不限</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">1-1999</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">2000-2999</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">3000-3999</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">4000-4999</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">5000-6999</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">7000以上</a></dd></dl>
<dl><dt class="p">空调类别：</dt><dd id="cc"><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">不限</a><a href="">壁挂式</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">立柜式</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">中央空调</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">移动空调</a></dd></dl>
<dl><dt class="p">空调功能：</dt><dd id="cg"><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">不限</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">变频冷暖</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">定速冷暖</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">变频单冷</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">定速单冷</a></dd></dl>

<dl><dt class="p">制冷面积：</dt><dd id="cq"><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">不限</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">1P(8-14㎡)</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">1.5P(12-23㎡)</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">2P(21-34㎡)</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">2.5P(27-42㎡)</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">3P(32-50㎡)</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">5P(46-70㎡)</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">5P以上</a></dd></dl>
<dl><dt class="p">能效等级：</dt><dd id="ce"><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">不限</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">一级能效</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">二级能效</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">三级能效</a><a href="http://localhost:8080/shop.v-get.com/products/2312-0-0-0-0-0-0.html">四级能效</a></dd></dl>
</div>

<div class="o ct"><span class="p">排序：<a href="" class="cto">最新</a><a href="">销量</a><a href="">价格</a><a href="">评论数</a></span><span class="q"><a href="">上一页</a><a href="">下一页</a></span></div>
<div id="c" class="o">
<ul>
<?php 
$t2=mysql_query($SQL);
while($tr2=mysql_fetch_array($t2)){
	$h=$tr2['h'];$i=$tr2['i'];
	echo '<li>
<p><a href="http://localhost:8080/shop.v-get.com/product/2312'.$i.'.html" target="_blank"><img src="http://localhost:8080/v-get.com/i/shop/i160/'.$i.'.jpg" alt="'.$h.'" /></a></p>
<p><a href="#" target="_blank">'.$h.'</a></p>
<p class="f9">￥'.$tr2['p'].'</p>
<p><a href="http://club.360buy.com/review/530670-1-1.html" target="_blank">已有661人评价</a>(89%好评)</p><p><a href="#" target="_blank">购买</a><input value="关注" type="button" /><input type="button" value="对比"/></p></li>';
	
	}
?>

</ul>
</div>
</div>


</div>
<!--for v-->
<div class="o w4">
fdfdfs
</div>
<div class="b">
<p><a href="">关于我们</a>|<a href="">联系我们</a>|<a href="">人才招聘</a></p>
<p>Copyright&copy; 微商城 2004-2012 | <a href="">京ICP证041189号音像制品经营许可证 </a><a>京音网8号京公网安备110101000001号</a></p>
<div class="bb"><a href=""><img src="108_40_zZOKnl.gif" /></a><a href=""><img src="108_40_OaNIwt.jpg" /></a><a href=""><img src="112_40_WvArIl.png" /></a></div>
</div>



</div>

</div>
<script type="text/javascript" language="javascript">X();
function r(){
var b=$("cb^A"),c=$("cc^A"),g=$("cg^A"),r=$("cr^A"),e=$("ce^A"),q=$("cq^A");
<?php echo 'C(b['.$b.'],"r2o");C(c['.$c.'],"r2o");C(r['.$r.'],"r2o");C(g['.$g.'],"r2o");C(q['.$q.'],"r2o");C(e['.$e.'],"r2o");
for(I=0;I<L(b);I++){b[I].href="http://localhost:8080/shop.v-get.com/products/2312-"+I+"-'.$c.'-'.$g.'-'.$r.'-'.$e.'-'.$q.'.html"}
for(I=0;I<L(c);I++){c[I].href="http://localhost:8080/shop.v-get.com/products/2312-'.$b.'-"+I+"-'.$g.'-'.$r.'-'.$e.'-'.$q.'.html"}
for(I=0;I<L(g);I++){g[I].href="http://localhost:8080/shop.v-get.com/products/2312-'.$b.'-'.$c.'-"+I+"-'.$r.'-'.$e.'-'.$q.'.html"}
for(I=0;I<L(r);I++){r[I].href="http://localhost:8080/shop.v-get.com/products/2312-'.$b.'-'.$c.'-'.$g.'-"+I+"-'.$e.'-'.$q.'.html"}
for(I=0;I<L(e);I++){e[I].href="http://localhost:8080/shop.v-get.com/products/2312-'.$b.'-'.$c.'-'.$g.'-'.$r.'-"+I+"-'.$q.'.html"}
for(I=0;I<L(q);I++){q[I].href="http://localhost:8080/shop.v-get.com/products/2312-'.$b.'-'.$c.'-'.$g.'-'.$r.'-'.$e.'-"+I+".html"}
';
?>

}
r();
var img=$('c^IMG');
for(I=0;I<L(img);I++){
E(img[I],'mouseover',function(){this.style.borderColor="#f90"});
E(img[I],'mouseout',function(){this.style.borderColor="#fff"});
}

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
