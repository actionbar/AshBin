<?php
$Qc=mysql_connect("localhost","root","qwdw114");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
//head跳转前面不能有任何包括 换行/空格/<>标签输出，php非echo 空格，换行没事
$lk=$_GET['l'];$LK=explode('.',$lk);$M=$LK[0];
$Qq=mysql_query('SELECT h,k,d,a,e,g,l,r,q,lk,lw,x,y,z,t,bg FROM ff WHERE m="'.$M.'" LIMIT 1');$Qr=mysql_num_rows($Qq);if($Qr==0){header('Location: http://wuliu.v-get.com/');exit();}
$Qa=mysql_fetch_array($Qq);
$H=$Qa['h'];$K=$Qa['k'];$Z=$Qa['z'];$LW=strlen($Qa['lw'])>0?$Qa['lw']:($M.'.wuliu.v-get.com');
echo '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>',$H,'专注于',$Z,'_',$K,'_商务物流网_V-Get!</title><meta name="keywords" content="',$K,'" /><meta name="description" content="',$Qa['d'],'"/>';?>
<link href="http://localhost/www.v-getimg.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://localhost/www.v-getimg.com/i0/i.css" type="text/css" rel="stylesheet" />
<link href="http://localhost/www.v-getimg.com/i0/s3/f/i.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="http://localhost/www.v-getimg.com/i0/i.js"></script>
</head>
<body>

<div class="ww">
<div class="t"><strong>您好，<a href="#">V-Get!</a></strong><span><a href="http://www.v-get.com/"><img i="http://localhost/www.v-getimg.com/i0/g/ft1.gif"/></a>|<a href="#">代理分销</a>|<a href="http://localhost/www.v-get.com/e/web/">网站建设</a>|<a href="http://localhost/www.v-get.com/e/help/">帮助中心</a>|<a href="http://s.v-get.com/l?l=wpa.qq.com%2fmsgrd%3fv%3d3%26uin%3d921923988%26site%3dqq%26menu%3dyes">客户服务</a></span></div>
<div class="w">
<div class="u">
<div class="p il fo"><a href="#"><img height="70" width="70" <?php echo 'src="http://localhost/www.v-getimg.com/i1/s3/70/',$M,'.gif" alt="',$H,'"';?>/></a></div>
<div class="p ir"><?php echo '<h1>',$H,'</h1><p>China ',ucfirst($M),' Logistics Operations & Services Co., Ltd.</p>';?></div>
<div class="q g"><div class="s"><form action="javascript:void(0)"><div class="p"><input type="radio" name="st" checked="checked"/><label>物流</label><input type="radio"  name="st"/><label>费用</label></div><div class="q"><input type="text" placeholder="请输入用" class="sk" name="sk"/><input class="ss" type="submit" value=""/></div></form></div></div>


<div class="o"></div>
</div>
<div id="n"><div class="a na"><?php echo '<a href="http://localhost/',$M,'.wuliu.v-get.com/" class="no">首页</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/about.html">公司介绍</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/services.html">服务项目</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/honor.html">企业荣誉</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/certificate.html">诚信认证</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/exhibition.html">视觉展厅</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/news.html">新闻公告</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/contact.html">联系我们</a><i></i>';?></div><div class="o po"><div class="n"></div><div class="n"></div><div class="n"></div><div class="n"></div><div class="n"></div><div class="n"></div><div class="n"></div><div class="n"></div><div class="n"></div>
</div></div>

<div class="o mh"></div>
<div><img src="http://drmcmm.baidu.com/media/id=nHDYnjDvnjn3&gp=401&time=nHnvnj01n1bLPs.gif"/></div>





<div class="v"><div class="o mh"></div>



<div class="p r">
<div class="mc al"> 
<!-- 必须只能对lt使用relative，不能对#mc使用，否则出错 -->
<div id="mc"><ul><li><img src="http://localhost/www.v-get.com/i1/v8/mc1.jpg" alt="E维科技，卓越的网站开发能力_V-Get!"/></li><li><img src="http://localhost/www.v-get.com/i1/v8/mc3.jpg" alt="E维科技，互联网营销专家_V-Get!"/></li><li><img src="http://localhost/www.v-get.com/i1/v8/mc4.jpg" alt="E维科技，专注于互联网营销_V-Get!"/></li><li><img src="http://localhost/www.v-get.com/i1/v8/mc2.jpg" alt="E维科技，营销不是你想的那么简单_V-Get!"/></li><li><img src="http://localhost/www.v-get.com/i1/v8/mc5.jpg" alt="E维科技，不一样的优化推广_V-Get!"/></li></ul><div id="mco" class="a"><a class="mco">1</a><a>2</a><a>3</a><a>4</a><a>5</a></div>
</div>
</div>


<div class="r2">
<div class="p ff">
<?php echo '<div><a href="http://',$M,'.wuliu.v-get.com/logistics/services.html"><img src="http://localhost/www.v-getimg.com/i1/s3/f/l2l.jpg" width="225" height="100" alt="',$H,'服务指南"/></a></div><h2><a href="http://',$M,'.wuliu.v-get.com/logistics/services.html">我们的服务 &gt;&gt;</a></h2><p>',$Qa['e'],'...</p></div><div class="p ff r2c"><div><a href="http://',$M,'.wuliu.v-get.com/logistics/honor.html"><img src="http://localhost/www.v-getimg.com/i1/s3/f/l2c.jpg" width="225" height="100" alt="',$H,'荣誉认证"/></a></div><h2><a href="http://',$M,'.wuliu.v-get.com/logistics/honor.html">企业的荣誉 &gt;&gt;</a></h2><p>',$Qa['g'],'...</p></div><div class="q ff"><div><a href="http://',$M,'.wuliu.v-get.com/logistics/about.html"><img src="http://localhost/www.v-getimg.com/i1/s3/f/l2r.jpg" width="225" height="100" alt="',$H,'的承诺"/></a></div><h2><a href="http://',$M,'.wuliu.v-get.com/logistics/about.html">我们的承诺 &gt;&gt;</a></h2><p>',$Qa['l'],'...</p></div>';?>
</div>
<div class="o mh mb"></div>
<div class="r3 ff">
<div class="r3l p">
<div class="r3a a"><a href="http://localhost/<?php echo $M;?>.wuliu.v-get.com/logistics/contact.html" title="联系我们"></a><a href="#" title="在线留言"></a><div class="o"></div></div>
<div class="r3b">
<h4>公司简介</h4>
<p><?php echo $Qa['a'];?>...</p>
</div>

</div>
<div class="r3r p">
<h4>新闻公告</h4>
<ul>
<?php
$RTD='';$RTT='';
$Qqn=mysql_query('SELECT t,d,i,h,top FROM news WHERE m="'.$M.'" ORDER BY top DESC LIMIT 5');
while($Qan=mysql_fetch_array($Qqn)){
$nT=$Qan['t'];$nTt=strtotime($nT);$nT=date('Y-m-d',$nTt);$nTOP=$Qan['top'];
echo '<li><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/news.html?view=',$Qan['i'],'">',$Qan['h'],'</a><i class="pr">',$nT,'</i></li>';
if($nTOP==5){$RTT=date('Y年n月j日',$nTt);$RTD=$Qan['d'];}
}


?>
</ul>



</div>
<div class="o"></div>
</div>
<div class="o mh"></div>
<div class="c_b">
<h4><a href="http://localhost/<?php echo $M;?>.wuliu.v-get.com/logistics/services.html">服务项目</a></h4>
<?php 

echo '<div class="a ca">';
$Qqi=mysql_query('SELECT p,h,d FROM fi WHERE m="'.$M.'" AND x=1 LIMIT 6');
while($Qai=mysql_fetch_array($Qqi)){
$iP=$Qai['p'];$iH=$Qai['h'];
echo '<a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/exhibition.html?i=1&show=',$iP,'"><img src="http://localhost/www.v-getimg.com/i1/s3/f/205x110/',$M,'_',$iP,'.jpg" width="205" height="110" alt="',$iH,'"/><br>',$iH,'<br>',$Qai['d'],'</a>';
}

echo '</div><div class="o mh"></div><h4><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/exhibition.html">视觉展厅</a></h4><div class="a ca">';
$Qqi=mysql_query('SELECT p,h,d FROM fi WHERE m="'.$M.'" AND x=0 LIMIT 6');
while($Qai=mysql_fetch_array($Qqi)){
$iP=$Qai['p'];$iH=$Qai['h'];
echo '<a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/exhibition.html?i=0&show=',$iP,'"><img src="http://localhost/www.v-getimg.com/i1/s3/f/205x110/',$M,$iP,'.jpg" width="205" height="110" alt="',$iH,'"/><br>',$iH,'<br>',$Qai['d'],'</a>';
}

echo '</div><div class="o"></div>';?>

</div></div>
<div class="q l">
<div class="ff lt">
<h5>重要通知：</h5>
<?php
echo '<p>',$RTD,'</p><p class="fq">',$RTT,'</p>';

?>

</div>

<div class="ff l1"><h2><?php echo '<a href="http://localhost/',$M,'.wuliu.v-get.com/">',$H,'</a>';?></h2>

<ul>
<?php 
echo '<li>企业名称：',$H,'</li><li>法人代表：<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">',$Qa['x'],'</a> 　<span q="',$Qa['q'],'"></span></li><li>物流性质：',$Qa['y'],'</li><li>经营范围：',$Z,'</li><li>注册时间：',$Qa['t'],'</li>';
?>
</ul>
<div class="l1c"><a href="#">企业工商认证</a></div>
<h6>行业资质：</h6>
<p>海运货运代理 空运货运代理 陆运公司 报关行 理货公司 航空公司 港务局（码头） 散杂租船代理 船代公司 快递公司 仓储公司 场站 集装箱船公司 散杂货船东 其他物流供应商</p>
<div class="fo"><?php echo '<a href="http://',$M,'.wuliu.v-get.com/" onclick="sf(\'http://',$M,'.wuliu.v-get.com/\',\'',$H,'\');return false" rel="sidebar" title="',$H,'" class="ig">收藏本站</a>';?></div>
</div>
<div class="o mh"></div>
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="ff bdshare_t bds_tools get-codes-bdshare"><span class="bds_more"></span><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><a class="bds_mshare"></a><a class="shareCount"></a></div><script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=609302" ></script><script type="text/javascript" id="bdshell_js"></script><script type="text/javascript">$("bdshell_js").src ="http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion="+Math.ceil(new Date()/3600000)</script>
<!-- Baidu Button END -->

<div class="o mh"></div>
<div class="l2">
<ul>
<?php echo '<li class="r2t"><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/certificate.html"><span>企业认证</span> &nbsp; Authenticate</a></li><li><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/services.html"><span>公司业务</span> &nbsp; Our Services</a></li><li><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/faq.html"><span>常见问题</span> &nbsp; F.A.Q</a></li><li><a href="#"><span>最新公告</span> &nbsp; BBS &amp; News</a></li>';?>
</ul>
</div>

<div class="ff l3">
<h4>联系我们</h4>
<ul>
<?php echo '<li>公　司：',$H,'</li>',$Qa['r'],'<li>即时通：<span q="',$Qa['q'],'"></span></li><li>网　址：<a href="http://',$LW,'">',$LW,'</a></li>';?>
</ul>

</div>

</div>

<div class="o mh mg"></div><div class="vb"><div class="vbt po f"><?php echo '<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html" class="vba">友情链接</a><a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html" class="pr mr">申请换链 &#8482;</a>';?></div><div class="vbc"><a href="http://wuliu.v-get.com/">商务物流网</a><?php echo $Qa['lk'];?></div></div>
</div>


<div class="b">
<p class="bn"><?php echo '<a href="http://',$M,'.wuliu.v-get.com/logistics/about.html">关于我们</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">联系我们</a>|<a href="#">人才招聘</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">合作加盟</a>|<a href="http://wuliu.v-get.com/">广告服务</a>|<a href="#">合作伙伴</a>|<a href="#">微公益</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">投诉建议</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/">网站地图</a>|<a href="#">法律声明</a>';?></p><p><a href="http://wuliu.v-get.com/">商务物流网</a> 授权企业站</p><p>Copyright &copy; 2012-2013<a href="http://www.v-get.com/">V-Get.com</a>All Right Reserved.</p><div class="ba a"><a href="http://s.v-get.com/l?l=www.saic.gov.cn/"></a><a href="http://s.v-get.com/l?l=www.cnnic.cn"></a><a href="http://s.v-get.com/l?l=www.cyberpolice.cn"></a><a href="http://s.v-get.com/l?l=www.szfw.org"></a></div></div>
</div>
</div>
<script type="text/javascript">
J("http://localhost/www.v-getimg.com/i0/s3/f/i.js");
J("http://localhost/kaibang.wuliu.v-get.com/js.js");
function mc(h,n){var a=$('mco^a');if(n==0||n)$('mc').scrollLeft=n*h;else {n=$('mc').scrollLeft/h;if(n==L(a)-1)n=0;else n++}F(a,function(o){C(o,'')});C(a[n],'mco')};
M($('mc'),3,1,5500,I,mc);F($("mco^a"),function(o){E(o,$8,function(){F($("mco^a"),function(i,g){if(i==o)mc(728,g)})})});


</script>
</body>
</html>