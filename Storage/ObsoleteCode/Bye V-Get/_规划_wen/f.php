<?php
$R=mysql_connect("localhost","root","qwdw114");mysql_select_db("v10",$R);mysql_query("set names utf8");
$I=$_GET['i'];//$I=(int)$I; 采用伪静态的，所以不需要再判断整数，伪静态已经判断了
$rq=mysql_query('SELECT * FROM f WHERE i='.$I,$R);
$r=mysql_fetch_array($rq);
$S=$r['s'];$A=$r['a'];$B=$r['b'];$C=$r['c'];$H=$r['h'];$F=$r['f'];$L=$r['l'];$K=$r['k'];$T=$r['t'];$N=$r['n'];$M=$r['m'];$NL=$r['nl'];
?>
<!DOCTYPE HTML>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php echo '<title>'.$H.'_V-Get!百科</title><meta name="keywords" content="'.$K.'" /><meta name="description" content="'.$F.'" />';?><link href="http://localhost/www.v-get.com/p0/favicon.ico" type="image/ico" rel="shortcut icon" />
<link rel="stylesheet" type="text/css" href="http://localhost/www.v-get.com/wen/f.css" />
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
echo '<a href="http://'.$L.'"><img src="http://localhost/p2.v-get.com/3i/'.$M.'.gif" alt="'.$N.'" onerror="javascript:this.src=\'http://localhost/p2.v-get.com/3i/0.gif\'"/></a>';
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
<ul>
<?php
$rq2=mysql_query('SELECT * FROM f WHERE s='.$S.' AND a='.$A.' AND b='.$B.' ORDER BY i DESC LIMIT 0,10',$R);
while($r2=mysql_fetch_array($rq2)){
$t2=$r2['t'];$T2=date('Y-m-d',strtotime($t2));
echo '<li><a href="http://wen.v-get.com/view/'.$r2['i'].'.html">'.$r2['h'].'</a><span>'.$T2.'</span></li>';
}
mysql_close($R);
?>
</ul>
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
<?php
$R3=mysql_connect("localhost","root","qwdw114");mysql_select_db('v'.$S,$R3);mysql_query("set names utf8");
$rq3=mysql_query('SELECT * FROM c WHERE a='.$A.' AND b='.$B.' ORDER BY o DESC LIMIT 0,5',$R3);
while($r3=mysql_fetch_array($rq3)){
echo '<li><a href="http://wuliu.v-get.com/'.$r3['i'].'">'.$r3['h'].'</a></li>';
}
?>
</ul>
</div>
</div>
<div class="lw l5">
<div class="lt"><span>百科知识</span></div><div class="lb">
<ul>
<?php
$R4=mysql_connect("localhost","root","qwdw114");mysql_select_db("v2",$R4);mysql_query("set names utf8");
$rq4=mysql_query('SELECT * FROM f WHERE s='.$S.' AND a='.$A.' AND b='.$B.' ORDER BY i DESC LIMIT 0,5',$R4);
while($r4=mysql_fetch_array($rq4)){
$t4=$r4['t'];$T4=date('Y-m-d',strtotime($t4));
echo '<li><a href="http://baike.v-get.com/view/'.$r4['i'].'.html">'.$r4['h'].'</a><span>'.$T4.'</span></li>';
}
?>
</ul></div>
</div>
</div>
<div class="q r"></div>
<div class="o"></div>
</div>
<div class="b">
<p><a href="#">反馈建议</a>|<a href="#">投诉举报</a>|<a href="#">指正错误</a></p>
<p>CopyRight &copy; 2012 <a target="_blank" href="http://www.v-get.com/">V-Get.com</a>All Right Reserved</p></div>
</div>
</body>
</html>