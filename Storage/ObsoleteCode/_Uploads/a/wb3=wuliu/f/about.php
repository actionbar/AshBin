<?php
$Qc=mysql_connect("localhost","wla1Ako","vgt1295EN");mysql_select_db("v3",$Qc);mysql_query("set names utf8");
$lk=$_GET['l'];$LK=explode('.',$lk);$M=$LK[0];
$Qq=mysql_query('SELECT h,k,a,b,r,q,lw,x,y,z,t FROM ff WHERE m="'.$M.'" LIMIT 1');$Qr=mysql_num_rows($Qq);if($Qr==0){header('Location: http://wuliu.v-get.com/');exit();}
$Qa=mysql_fetch_array($Qq);
$H=$Qa['h'];$K=$Qa['k'];$Z=$Qa['z'];$LW=strlen($Qa['lw'])>0?$Qa['lw']:($M.'.wuliu.v-get.com');
echo '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>关于',$H,'_',$Z,'_',$K,'_商务物流网_V-Get!</title><meta name="keywords" content="',$K,'" /><meta name="description" content="',$H,'主要经营',$Z,$Qa['a'],'"/>';?>
<link href="http://www.v-get.com/www.v-getimg.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://www.v-get.com/www.v-getimg.com/i0/i.css" type="text/css" rel="stylesheet" />
<link href="http://www.v-get.com/www.v-getimg.com/i0/s3/f/i.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="http://www.v-get.com/www.v-getimg.com/i0/i.js"></script>
</head>
<body>

<div class="ww">

<div class="w">
<div class="u po">
<div class="p il fo"><a href="#"><img height="70" width="70" <?php echo 'src="http://www.v-get.com/www.v-getimg.com/i1/s3/70/',$M,'.gif" alt="',$H,'"';?>/></a></div>
<div class="p ir"><?php echo '<h1>',$H,'</h1><p>China ',ucfirst($M),' Logistics Operations & Services Co., Ltd.</p>';?></div>
<div class="fo pr"><a href="http://wuliu.v-get.com/">商务物流</a><?php echo '<a href="http://',$M,'.wuliu.v-get.com/" onclick="sf(\'http://',$M,'.wuliu.v-get.com/\',\'',$H,'\');return false" rel="sidebar" title="',$H,'" class="uprac">加入收藏</a><a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html" class="uprar">联系我们</a>';?></div>
<div class="o"></div>
</div>
<div id="n" class="a"><?php echo '<a href="http://',$M,'.wuliu.v-get.com/">首页</a><i></i><a href="http://',$M,'.wuliu.v-get.com/logistics/about.html" class="no">公司介绍</a><i></i><a href="http://',$M,'.wuliu.v-get.com/logistics/services.html">服务项目</a><i></i><a href="http://',$M,'.wuliu.v-get.com/logistics/honor.html">企业荣誉</a><i></i><a href="http://',$M,'.wuliu.v-get.com/logistics/certificate.html">诚信认证</a><i></i><a href="http://',$M,'.wuliu.v-get.com/logistics/exhibition.html">视觉展厅</a><i></i><a href="http://',$M,'.wuliu.v-get.com/logistics/news.html">新闻公告</a><i></i><a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">联系我们</a>';?><i></i></div>
<div class="o mh"></div><div class="v"><div class="p l"><div class="o mh"></div>
<div class="m cc"><div>您现在的位置：<?php echo '<a href="http://',$M,'.wuliu.v-get.com/">',$H,'</a>';?> &gt; 公司简介</div></div>
<div class="mf">
<div class="ct1">
<?php 
$Qqc=mysql_query('SELECT * FROM fc WHERE m="'.$M.'" LIMIT 1');
while($Qac=mysql_fetch_array($Qqc)){
$cH=$Qac['h'];
$cB=$Qac['b'];$cA=$Qac['a'];$cA*=25;$cAa=$cA-24;$cC=$Qac['c'];$cC*=15;$cCa=$cC-14;
echo '<table><tr><th colspan="4">',$cH,'</th></tr><tr><td class="fq">经营物流性质：</td><td>',$Qa['y'],'</td><td class="fq">主营物流业务：</td><td>',$Z,'</td></tr><tr><td class="fq">注册资金：</td><td>人民币  ',$Qac['e'],' 万元 <span class="f0">[已认证]</span></td><td class="fq">工商登记号：</td><td>',$Qac['j'],' <span class="f0">[已认证]</span></td></tr><tr><td class="fq">法人代表：</td><td>',$Qa['x'],' <span class="f0">[已认证]</span></td><td class="fq">注册日期：</td><td>',$Qa['t'],' <span class="f0">[已认证]</span></td></tr><tr><td class="fq">注册地址：</td><td>',$Qac['l'],' <span class="f0">[已认证]</span></td><td class="fq">物流公司类型：</td><td>',$Qac['w'],' <span class="f0">[已认证]</span></td></tr><tr><td class="fq">执照期限：</td><td>',$Qac['t'],' <span class="f0">[已认证]</span></td><td class="fq">发证机关：</td><td>',$Qac['u'],' <span class="f0">[已认证]</span></td></tr><tr><th colspan="4">',$cB,'物流公司发展动态</th></tr><tr><td class="fq">年营业额：</td><td>',$Qac['v'],'</td><td class="fq">持有物流品牌：</td><td>',$cB,'</td></tr><tr><td class="fq">员工人数：</td><td>',$cAa,' - ',$cA,' 人 <span class="f0">[已认证]</span></td><td class="fq">配送车辆：</td><td>',$cCa,' - ',$cC,' 辆 <span class="f0">[已认证]</span></td></tr><tr><td class="fq">财务结算方式：</td><td>',$Qac['r'],'</td><td class="fq"></td><td></td></tr><tr><th colspan="4">',$cB,'物流公司详细信息</th></tr><tr><td class="fq">服务项目：</td><td>',$Qac['s'],'</td><td class="fq">经营区域：</td><td>',$Qac['p'],'</td></tr><tr><td class="fq">物流相关服务：</td><td>',$Qac['q'],'</td><td class="fq">是否配货上门：</td><td>',$Qac['g'],'</td></tr><tr><td class="fq">优势物流服务：</td><td>',$Qac['o'],'</td><td class="fq">目标客户群体：</td><td>',$Qac['k'],'</td></tr></table>';
}
echo '</div><div class="cfi p"><img src="http://www.v-get.com/www.v-getimg.com/i1/s3/f/300x200/',$M,'.jpg" width="300" height="200" alt="',$cH,'" /></div>',$Qa['b'];?>
</div>
</div>
<div class="q r">
<div class="r1"><h2><?php echo $H;?></h2>
<div class="rt po mg"><a href="#"><img src="http://www.v-get.com/www.v-getimg.com/i0/s3/f/rta.gif" width="100" height="22" alt="在线咨询<?php echo $H;?>"/></a></div>
<ul>
<?php 
echo '<li>企业名称：',$H,'</li><li>法人代表：<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">',$Qa['x'],'</a> 　<span q="',$Qa['q'],'"></span></li><li>物流性质：',$Qa['y'],'</li><li>经营范围：',$Z,'</li><li>注册时间：',$Qa['t'],'</li>';
?>
</ul>
<ul>
<li><a href="http://<?php echo $M;?>.wuliu.v-get.com/logistics/certificate.html" class="ig">企业<i class="iv">Ｖ</i>认证</a></li>
<li>会员等级：暂时无等级</li>
<li>信誉指数：暂时无记录</li>
<li>用户投诉：0 起</li>
<li>满意程度：100%</li>
</ul>
<div class="fo"><?php echo '<a href="http://',$M,'.wuliu.v-get.com/" onclick="sf(\'http://',$M,'.wuliu.v-get.com/\',\'',$H,'\');return false" rel="sidebar" title="',$H,'" class="ig">收藏本站</a>';?></div>
</div>
<div class="mh"></div><div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"><span class="bds_more">分享到：</span><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><a class="bds_mshare"></a><a class="shareCount"></a></div><script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=609302" ></script><script type="text/javascript" id="bdshell_js"></script><script type="text/javascript">$("bdshell_js").src ="http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion="+Math.ceil(new Date()/3600000)</script><div class="o mh"></div>
<div class="r2 mg">
<ul>
<?php echo '<li class="r2t"><a href="http://',$M,'.wuliu.v-get.com/logistics/certificate.html"><span>企业认证</span> &nbsp;V-Get! Authenticate</a></li><li><a href="http://',$M,'.wuliu.v-get.com/logistics/services.html"><span>公司业务</span> &nbsp;Our Services</a></li><li><a href="http://',$M,'.wuliu.v-get.com/logistics/faq.html"><span>常见问题</span> &nbsp;Frequently Questions</a></li><li><a href="#"><span>最新公告</span> &nbsp;Bulletin Board System</a></li>';?>
</ul>
</div>

<div class="f rb">
<h4>联系我们</h4>
<ul>
<?php echo '<li>公　司：',$H,'</li>',$Qa['r'],'<li>即时通：<span q="',$Qa['q'],'"></span></li><li>网　址：<a href="http://',$LW,'">',$LW,'</a></li>';?>
</ul>

</div>

</div>
<div class="o mh"></div>
</div>
<div class="b">
<p class="bn"><?php echo '<a href="http://',$M,'.wuliu.v-get.com/logistics/about.html">关于我们</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">联系我们</a>|<a href="#">人才招聘</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">合作加盟</a>|<a href="http://wuliu.v-get.com/">广告服务</a>|<a href="#">合作伙伴</a>|<a href="#">微公益</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/contact.html">投诉建议</a>|<a href="http://',$M,'.wuliu.v-get.com/logistics/">网站地图</a>|<a href="#">法律声明</a>';?></p><p><a href="http://wuliu.v-get.com/">商务物流网</a> 授权企业站</p><p>Copyright &copy; 2012-2013<a href="http://www.v-get.com/">V-Get.com</a>All Right Reserved.</p><div class="ba a"><a href="http://s.v-get.com/l?l=www.saic.gov.cn/"></a><a href="http://s.v-get.com/l?l=www.cnnic.cn"></a><a href="http://s.v-get.com/l?l=www.cyberpolice.cn"></a><a href="http://s.v-get.com/l?l=www.szfw.org"></a></div></div>
</div>
</div><div class="pn"><script type="text/javascript">J("http://www.v-get.com/www.v-getimg.com/i0/s3/f/i.js");var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Feb8ef18175820a1277de885ecc85aaea' type='text/javascript'%3E%3C/script%3E"));</script></div>
</body>
</html>