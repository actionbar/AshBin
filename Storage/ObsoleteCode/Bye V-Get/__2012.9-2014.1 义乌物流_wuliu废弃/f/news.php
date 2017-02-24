<?php
$Qc=mysql_connect("localhost","root","qwdw114");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
$lk=$_GET['l'];$LK=explode('.',$lk);$M=$LK[0];
$bl=false;$nH='';$nD='';
if(isset($_GET['view'])){
$nI=$_GET['view'];

$Qqn=mysql_query('SELECT * FROM news WHERE i='.$nI.' LIMIT 1');
$Qqr=mysql_num_rows($Qqn);if($Qqr==0){
header('Location: http://localhost/'.$M.'.wuliu.v-get.com/logistics/news.html');
exit();}
$Qan=mysql_fetch_array($Qqn);
$bl=true;

$nH=$Qan['h'];
$nD=$Qan['d'];
}




$Qq=mysql_query('SELECT h,k,d,r,q,lw,x,y,z,t FROM ff WHERE m="'.$M.'" LIMIT 1');
$Qr=mysql_num_rows($Qq);if($Qr==0){header('Location: http://wuliu.v-get.com/');exit();}
$Qa=mysql_fetch_array($Qq);
$H=$Qa['h'];$K=$Qa['k'];$Z=$Qa['z'];$LW=strlen($Qa['lw'])>0?$Qa['lw']:($M.'.wuliu.v-get.com');





echo '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>',$nH,' ',$H,'新闻公告_',$Z,$K,'_商务物流网_V-Get!</title><meta name="keywords" content="',$K,'" /><meta name="description" content="',$nD,$Qa['d'],$Z,'就选',$H,'"/>';?>
<link href="http://localhost/www.v-getimg.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://localhost/www.v-getimg.com/i0/i.css" type="text/css" rel="stylesheet" />
<link href="http://localhost/www.v-getimg.com/i0/s3/f/i.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="http://localhost/www.v-getimg.com/i0/i.js"></script>
</head>
<body>

<div class="ww">

<div class="w">
<div class="u po">
<div class="p il fo"><a href="#"><img height="70" width="70" <?php echo 'src="http://localhost/www.v-getimg.com/i1/s3/70/',$M,'.gif" alt="',$H,'"';?>/></a></div>
<div class="p ir"><?php echo '<h1>',$H,'</h1><p>China ',ucfirst($M),' Logistics Operations & Services Co., Ltd.</p>';?></div>
<div class="fo pr"><a href="http://wuliu.v-get.com/">商务物流</a><?php echo '<a href="http://',$M,'.wuliu.v-get.com/" onclick="sf(\'http://',$M,'.wuliu.v-get.com/\',\'',$H,'\');return false" rel="sidebar" title="',$H,'" class="uprac">加入收藏</a><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/contact.html" class="uprar">联系我们</a>';?></div>
<div class="o"></div>
</div>
<div id="n" class="a"><?php echo '<a href="http://localhost/',$M,'.wuliu.v-get.com/">首页</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/about.html">公司介绍</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/services.html">服务项目</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/honor.html">企业荣誉</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/certificate.html">诚信认证</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/exhibition.html">视觉展厅</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/news.html" class="no">新闻公告</a><i></i><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/contact.html">联系我们</a>';?><i></i></div><div class="o mh"></div><div class="v"><div class="p l"><div class="o mh"></div>
<div class="m cc"><div>您现在的位置：<?php echo '<a href="http://',$M,'.wuliu.v-get.com/">',$H,'</a>';?> &gt; 新闻公告</div></div>
<div class="mf">
<?php 

if($bl){
echo '<h1>',$nH,'</h1><p>',$Qan['t'],'</p>',$Qan['f'];

}
else {
$Qqn=mysql_query('SELECT * FROM news WHERE m="'.$M.'" ORDER BY t DESC LIMIT 0,10');
echo '<ul class="news">';
while($Qan=mysql_fetch_array($Qqn)){
$nT=$Qan['t'];$nT=explode(' ',$nT);$nT=$nT[0];
echo '<li><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/news.html?view=',$Qan['i'],'">',$Qan['h'],'</a><i class="pr">',$nT,'</i></li>';

}
echo '</ul>';


}
?>

</div>
</div>

<div class="q r">
<div class="r1"><h2><?php echo $H;?></h2>
<div class="rt po mg"><a href="#"><img src="http://localhost/www.v-getimg.com/i0/s3/f/rta.gif" width="100" height="22" alt="在线咨询<?php echo $H;?>"/></a></div>
<ul>
<?php 
echo '<li>企业名称：',$H,'</li><li>法人代表：<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">',$Qa['x'],'</a> 　<span q="',$Qa['q'],'"></span></li><li>物流性质：',$Qa['y'],'</li><li>经营范围：',$Z,'</li><li>注册时间：',$Qa['t'],'</li>';
?>
</ul>
<ul>
<li><a href="http://localhost/<?php echo $M;?>.wuliu.v-get.com/logistics/certificate.html" class="ig">企业<i class="iv">Ｖ</i>认证</a></li>
<li>会员等级：暂时无等级</li>
<li>信誉指数：暂时无记录</li>
<li>用户投诉：0 起</li>
<li>满意程度：100%</li>
</ul>
<div class="fo"><?php echo '<a href="http://',$M,'.wuliu.v-get.com/" onclick="sf(\'http://',$M,'.wuliu.v-get.com/\',\'',$H,'\');return false" rel="sidebar" title="',$H,'" class="ig">收藏本站</a>';?></div>
</div>

<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"><span class="bds_more">分享到：</span><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><a class="bds_mshare"></a><a class="shareCount"></a></div><script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=609302" ></script><script type="text/javascript" id="bdshell_js"></script><script type="text/javascript">$("bdshell_js").src ="http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion="+Math.ceil(new Date()/3600000)</script>
<!-- Baidu Button END -->

<div class="o mh"></div>
<div class="r2 mg">
<ul>
<?php echo '<li class="r2t"><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/certificate.html"><span>企业认证</span> &nbsp;V-Get! Authenticate</a></li><li><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/services.html"><span>公司业务</span> &nbsp;Our Services</a></li><li><a href="http://localhost/',$M,'.wuliu.v-get.com/logistics/faq.html"><span>常见问题</span> &nbsp;Frequently Questions</a></li><li><a href="#"><span>最新公告</span> &nbsp;Bulletin Board System</a></li>';?>
</ul>
</div>

<div class="f rb">
<h4>联系我们</h4>
<ul>
<?php echo '<li>公　司：',$H,'</li>',$Qa['r'],'<li>即时通：<span q="',$Qa['q'],'"></span></li><li>网　址：<a href="http://',$LW,'">',$LW,'</a></li>';?>
</ul>

</div>

</div><div class="o mh"></div></div>
<div class="b">
<p class="bn"><?php echo '<a href="http://',$M,'.wuliu.v-get.com/logistics/about.html">关于我们</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">联系我们</a>|<a href="#">人才招聘</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">合作加盟</a>|<a href="http://wuliu.v-get.com/">广告服务</a>|<a href="#">合作伙伴</a>|<a href="#">微公益</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">投诉建议</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/">网站地图</a>|<a href="#">法律声明</a>';?></p><p><a href="http://wuliu.v-get.com/">商务物流网</a> 授权企业站</p><p>Copyright &copy; 2012-2013<a href="http://www.v-get.com/">V-Get.com</a>All Right Reserved.</p><div class="ba a"><a href="http://s.v-get.com/l?l=www.saic.gov.cn/"></a><a href="http://s.v-get.com/l?l=www.cnnic.cn"></a><a href="http://s.v-get.com/l?l=www.cyberpolice.cn"></a><a href="http://s.v-get.com/l?l=www.szfw.org"></a></div></div>
</div>
</div>
<script type="text/javascript">

J("http://localhost/www.v-getimg.com/i0/s3/f/i.js");
</script>
</body>
</html>