<?php
$R=mysql_connect('localhost','iwen903xian','shangye_663_p');mysql_select_db('v10',$R);mysql_query('set names utf8');
$I=$_GET['i'];//$I=(int)$I; 采用伪静态的，所以不需要再判断整数，伪静态已经判断了
$rq=mysql_query('SELECT * FROM f WHERE i='.$I,$R);
$r=mysql_fetch_array($rq);
$S=$r['s'];$A=$r['a'];$B=$r['b'];$C=$r['c'];$H=$r['h'];$F=$r['f'];$L=$r['l'];$K=$r['k'];$T=$r['t'];$N=$r['n'];$M=$r['m'];$NL=$r['nl'];
?>
<!DOCTYPE HTML>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php echo '<title>'.$H.'_V-Get!百科</title><meta name="keywords" content="'.$K.'" /><meta name="description" content="'.$F.'" />';?><link href="http://weigeti.com/p0/favicon.ico" type="image/ico" rel="shortcut icon" />
<link rel="stylesheet" type="text/css" href="http://wen.v-get.com/f.css" />
</head>
<body>
<div class="t"></div>
<div class="w">
<div id="av"></div>
<div class="v">
<div class="p l">
<div id="c" class="lw">
<div class="ct">
<h1><span><?php echo $H;?></span></h1>
</div>
<!--回答者用QQ问答方式，专门的托运部，链接为其公司链接 ，没有回答者的，就用默认网址-->
<div class="cb">
<p class="cm">提问者：商务物流网友 | 浏览次数：7217次<span><?php echo $T;?></span></p>
<p><?php echo $F;?></p>
<p><?php echo '参考资料：<a href="http://'.$L.'">http://'.$L.'</a>';?></p>
<div class="c">
<div class="p cl">
<?php
echo '<a href="http://'.$L.'"><img i="http://weigeti.com/p2/3i/'.$M.'.gif" alt="'.$N.'" onerror="javascript:this.src=\'http://weigeti.com/p2/3i/0.gif\'"/></a>';
?></div>
<div class="p cr">
<p>回答者：<?php echo '<a href="http://'.$NL.'">'.$N.'</a>';?>|<a href="">更多回答</a>|<a href="">相似问题</a></p>
<p>搜索问题：<?php echo $K;?></p>
</div>
<div class="o"></div>
</div>
</div>
</div>
<div class="lw l2">
<div class="lt"><span>相关问题</span></div>
<div class="lb">
<ul><li><a href="http://wen.v-get.com/view/7.html">从义乌到嘉兴托运多少钱一吨</a><span>2012-04-08</span></li><li><a href="http://wen.v-get.com/view/6.html">从义乌到临沂货运不到20公斤托运要多少钱</a><span>2012-07-16</span></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运多少钱？哪个好点</a><span>2012-01-15</span></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运一百斤的货要多少钱</a><span>2012-05-08</span></li><li><a href="http://wen.v-get.com/view/3.html">义乌中铁快运到新疆托运多少钱一公斤</a><span>2012-04-08</span></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费是多少</a><span>2012-08-13</span></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车站托运25公斤玩具到临沂要多少钱</a><span>2012-10-01</span></li></ul>
<p>更多搜索：<?php echo $K;?></p>
</div>
</div>
<div class="lw l3">
<!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
	    <span class="bds_more">分享到：</span>
        <a class="bds_qzone"></a>
        <a class="bds_tsina"></a>
        <a class="bds_tqq"></a>
        <a class="bds_renren"></a>
		<a class="bds_tieba"></a>
		<a class="bds_douban"></a>
		<a class="bds_msn"></a>
        <span class="bds_more"></span>
		<a class="shareCount"></a>
    </div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;mini=1&amp;uid=609302" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<!-- Baidu Button END --></div>
<div id="la" class="lw l4">
<div class="lt"><span>推广链接</span></div>
<div class="lb">
<ul>
<li><a href="http://wuliu.v-get.com/1">义乌龚大姐江东货运公司</a></li><li><a href="http://wuliu.v-get.com/332">义乌通达运输公司</a></li><li><a href="http://wuliu.v-get.com/802">义乌老方托运部</a></li><li><a href="http://wuliu.v-get.com/65">义乌昌盛专线物流</a></li><li><a href="http://wuliu.v-get.com/803">义乌欣宇快运公司</a></li>
</ul>
</div>
</div>
<div class="lw l5">
<div class="lt"><span>百科知识</span></div><div class="lb">
<ul><li><a href="http://baike.v-get.com/view/32.html">义乌雪峰路货运场</a><span>2012-08-30</span></li><li><a href="http://baike.v-get.com/view/29.html">义乌国际物流中心 (Yiwu logistics center)</a><span>2012-08-29</span></li><li><a href="http://baike.v-get.com/view/28.html">义乌江东货运市场</a><span>2012-08-29</span></li><li><a href="http://baike.v-get.com/view/8.html">托运仓库失火6人被围困 浙江义乌消防紧急疏散</a><span>2009-01-12</span></li><li><a href="http://baike.v-get.com/view/2.html">义乌网商流行“拼邮”</a><span>2012-08-07</span></li></ul></div>
</div>
</div>
<div class="q r"><script type="text/javascript">var cpro_id="u1143188"</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
<div class="o"></div>
</div>
<div class="b">
<p><a href="#">反馈建议</a>|<a href="#">投诉举报</a>|<a href="#">指正错误</a></p>
<p>CopyRight &copy; 2012 <a target="_blank" href="http://www.v-get.com/">V-Get.com</a>All Right Reserved</p></div>
</div>
<script src="http://weigeti.com/p0/c.js" type="text/javascript"></script><script type="text/javascript">Q();A('','_blank')</script>
</body>
</html>