<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>浏览量统计表</title>
<link href="http://localhost/www.v-get.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<link href="http://localhost/www.v-get.com/i0/c.css" type="text/css" rel="stylesheet" />
<link href="http://localhost/www.v-get.com/i0/vi/r/views.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://localhost/www.v-get.com/i0/c.js"></script>
</head>
<body>

<div class="ww">
<div class="i"></div>
<div class="w v">
<div id="c">
<?php

//isset($_GET['s']) 

$Qc=mysql_connect("localhost","root","qwdw114");mysql_select_db("vv",$Qc);mysql_query("set names utf8");

$P=empty($_GET['p'])?0:$_GET['p'];
$s='';$S=0;
if(!empty($_GET['f'])){$S=$_GET['f'];$s='WHERE s='.$S;}

$o='n';$oo='';
if(!empty($_GET['o'])){$oo=$_GET['o'];if($oo=='good'){$o='g';}if($oo=='nogood'){$o='b';}}
echo '<style>#c th a.views',$oo,'{background:none;padding:0;color:#333;cursor:default}</style>';
$Qq=mysql_query('SELECT v,h,n,g,b FROM iu '.$s.' ORDER BY '.$o.' DESC LIMIT '.$P.',100');
echo '<table class="fo"><tr><th>排名</th><th>名称</th><th><a href="http://localhost/i.v-get.com/report/views?f=',$S,'" class="views">浏览量</a></th><th><a href="http://localhost/i.v-get.com/report/views?o=good&f=',$S,'" class="viewsgood">好评</a></th><th><a href="http://localhost/i.v-get.com/report/views?o=nogood&f=',$S,'" class="viewsnogood">差评</a></th></tr>';
//$P通过获取到才能有，所以不必担心超过，
while($Qa=mysql_fetch_array($Qq)){++$P;
echo '<tr><td>',$P,'</td><td><a href="http://',$Qa['h'],'</a></td><td>',$Qa['n'],'</td><td>',$Qa['g'],'</td><td>',$Qa['b'],'</td></tr>';

}
echo '<tr><td colspan="5"><a href="http://localhost/i.v-get.com/report/views?p=',$P,'&o=',$oo,'&f=',$S,'">更多排名','</a></td></tr></table>';

?></div><div class="b">
<p><a href="#">商务客服</a><a href="#">意见反馈</a><a href="#">企业认证及合作</a><a href="#">开放平台</a><a href="#">招贤纳才</a><a href="#">商务网导航</a><a href="#">不良信息举报</a></p>
<p>客服电话：400 000 0000（个人） 400 888 8888（企业） (按当地市话标准计费)</p>
<p style="position:relative"><i></i>浙江商务营销网络技术有限公司 <a href="#">浙网文[2011]0398-130号</a><a href="http://www.miibeian.gov.cn" rel="nofollow">备ICP证12013909号</a><span class="h4r">Copyright &copy; 2012-2013 V-Get!</span></p>
</div></div></div></body></html>