<?php
$Qc=mysql_connect('localhost','root','qwdw114');mysql_select_db('vwuliu',$Qc);mysql_query('set names utf8');
$lk=$_GET['l'];$LK=explode('.',$lk);$E=$LK[0];
$Qq=mysql_query('SELECT h,he,k,m,f,r,q,lt,x,y,z,t,adt FROM co WHERE e="'.$E.'" LIMIT 1');$Qr=mysql_num_rows($Qq);
if($Qr==0){header('Location: http://wuliu.v-get.com/');exit();}
$Qa=mysql_fetch_array($Qq);
$H=$Qa['h'];$K=$Qa['k'];$Z=$Qa['z'];$LT=$Qa['lt'];$TA=$Qa['adt'];$now=time();$ad=($TA>$now)?false:true;
echo '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>服务项目_',$Z,'_',$H,'_',$K,'_商务物流网_V-Get!</title><meta name="keywords" content="',$K,'" /><meta name="description" content="',$Qa['m'],'"/>';?>
<link href="http://localhost/tu.v-get.com/i.css" type="text/css" rel="stylesheet" /><link href="http://localhost/tu.v-get.com/3/co/i.css" type="text/css" rel="stylesheet"/><script type="text/javascript" src="http://localhost/tu.v-get.com/i.js"></script>
</head>
<body>

<div class="ww">
<div id="t"><div class="w po"><a href="http://localhost/wuliu.v-get.com/">商务物流网</a><i>-</i><?php echo $LT;?><span><a href="#" rel="sidebar">收藏</a></span></div></div>
<div class="o w">
<div class="u">
<div class="p il fo"><a href="http://<?php echo $lk,'"><img height="70" width="70" src="http://localhost/tp.v-get.com/j/3/co/70/',$E,'.gif" alt="',$H;?>"/></a></div>
<div class="p ir"><?php echo '<h1>',$H,'</h1><p>',$Qa['he'],'</p>';?></div>
<div class="q g"><div class="s"><form action="javascript:void(0)"><div class="p"><input type="radio" name="st" checked="checked"/><label>物流</label><input type="radio"  name="st"/><label>费用</label></div><div class="q"><input type="text" placeholder="请输入用" class="sk" name="sk"/><input class="ss" type="submit" value=""/></div></form></div></div>


<div class="o"></div>
</div>
<div id="n"><div class="a na"><?php echo '<a href="http://localhost/',$E,'.wuliu.v-get.com/">首页</a><i></i><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/about.html">关于我们</a><i></i><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/services.html" class="no">服务项目</a><i></i><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/honor.html">企业荣誉</a><i></i><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/certificate.html">诚信认证</a><i></i><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/exhibition.html">视觉展厅</a><i></i><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/news.html">新闻公告</a><i></i><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/faq.html">常见问题</a><i></i><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/contact.html">联系我们</a><i></i>';?></div></div><div class="o mh"></div><div class="v"><div class="q r"><div class="o mh"></div>
<div class="m cc"><div>您现在的位置：<?php echo '<a href="http://',$E,'.wuliu.v-get.com/">',$H,'</a>';?> &gt; 服务项目</div></div>
<?php 
echo '<div class="a ca">';
$Qqi=mysql_query('SELECT * FROM coi WHERE e="'.$E.'" AND x=1');
while($Qai=mysql_fetch_array($Qqi)){
$iP=$Qai['p'];$iH=$Qai['h'];
echo '<a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/exhibition.html?i=1&show=',$iP,'"><img src="http://localhost/tp.v-get.com/j/3/co/205x110/',$E,'_',$Qai['p'],'.jpg" width="205" height="110" alt="',$iH,'"/><br><strong>',$iH,'</strong><br>',$Qai['d'],'</a>';
}

echo '</div><div class="o"></div>';?>
<div class="mf"><?php echo $Qa['f'];?></div>
</div>

<div class="p l">
<div class="ff l1"><h2><?php echo '<a href="http://localhost/',$E,'.wuliu.v-get.com/">',$H,'</a>';?></h2>

<ul>
<?php 
echo '<li>企业名称：',$H,'</li><li>法人代表：<a href="http://',$E,'.wuliu.v-get.com/logistics/contact.html">',$Qa['x'],'</a> 　<span q="',$Qa['q'],'"></span></li><li>物流性质：',$Qa['y'],'</li><li>经营范围：',$Z,'</li><li>注册时间：',$Qa['t'],'</li>';
?>
</ul>
<div class="l1c"><a href="#">企业工商认证</a></div>
<h6>行业资质：</h6>
<p>海运货运代理 空运货运代理 陆运公司 报关行 理货公司 航空公司 港务局（码头） 散杂租船代理 船代公司 快递公司 仓储公司 场站 集装箱船公司 散杂货船东 其他物流供应商</p>
<div class="fo"><?php echo '<a href="http://',$E,'.wuliu.v-get.com/" rel="sidebar" class="ig">收藏本站</a>';?></div>
</div>
<div class="l2">
<ul>
<?php echo '<li class="r2t"><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/certificate.html"><span>企业认证</span> &nbsp; Authenticate</a></li><li><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/services.html"><span>公司业务</span> &nbsp; Our Services</a></li><li><a href="http://localhost/',$E,'.wuliu.v-get.com/logistics/faq.html"><span>常见问题</span> &nbsp; F.A.Q</a></li><li><a href="#"><span>最新公告</span> &nbsp; BBS &amp; News</a></li>';?>
</ul>
</div>

<div class="ff l3">
<h4>联系我们</h4>
<ul>
<?php echo '<li>公　司：',$H,'</li>',$Qa['r'],'<li>即时通：<span q="',$Qa['q'],'"></span></li><li>网　址：<a href="http://',$E,'.wuliu.v-get.com/">',$E,'.wuliu.v-get.com</a></li>';?>
</ul>
</div>
<?php echo $ad?'<div class="a200x200"></div>':'';?>

</div>
<div class="o mh"></div>

</div>
<div class="b">
<p class="bn"><?php echo '<a href="http://',$E,'.wuliu.v-get.com/logistics/about.html">关于我们</a>|<a href="http://',$E,'.wuliu.v-get.com/logistics/contact.html">联系我们</a>|<a href="#">人才招聘</a>|<a href="http://',$E,'.wuliu.v-get.com/logistics/contact.html">合作加盟</a>|<a href="http://wuliu.v-get.com/">广告服务</a>|<a href="#">合作伙伴</a>|<a href="#">微公益</a>|<a href="http://',$E,'.wuliu.v-get.com/logistics/contact.html">投诉建议</a>|<a href="http://',$E,'.wuliu.v-get.com/logistics/">网站地图</a>|<a href="#">法律声明</a>';?></p><p><a href="http://wuliu.v-get.com/">商务物流网</a> 授权企业站</p><p>Copyright &copy; 2012-2013<a href="http://www.v-get.com/">V-Get.com</a>All Right Reserved.</p><div class="ba a"><a href="http://s.v-get.com/l?l=www.saic.gov.cn/"></a><a href="http://s.v-get.com/l?l=www.cnnic.cn"></a><a href="http://s.v-get.com/l?l=www.cyberpolice.cn"></a><a href="http://s.v-get.com/l?l=www.szfw.org"></a></div></div>
</div>
</div>
<script type="text/javascript">

J("http://localhost/tu.v-get.com/3/co/i.js");
</script>
</body>
</html>