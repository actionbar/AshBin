<?php 
$QC=mysql_connect('localhost','bk020vgt','VGTmm_258_v');mysql_select_db('v3',$QC);mysql_query('set names utf8');
$G=$_GET['i'];
$Qq=mysql_query('SELECT h,k,d,f FROM f WHERE g="'.$G.'" LIMIT 1');
$Qa=mysql_fetch_array($Qq);
if(!$Qa){header('HTTP/1.1 404 Not Found');header('Status: 404 Not Found');exit;}
$H=$Qa['h'];
?>
<!DOCTYPE HTML><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"/><title><?php echo $H;?>_商务物流网_V-Get!</title><meta name="keywords" content="<?php echo $Qa['k'];?>"/><meta name="description" content="<?php echo $Qa['d'];?>"/><link href="http://weigeti.com/p0/favicon.ico" type="image/ico" rel="shortcut icon" /><link rel="stylesheet" type="text/css" href="http://wuliu.v-get.com/help/c.css?i=2" /><style type="text/css">.l .lo<?php echo $G;?>{color:#f60}</style><script type="text/javascript" src="http://weigeti.com/p0/c.js"></script></head><body>
<div class="w u"><div class="i"><h1><a href="http://wuliu.v-get.com/"><?php echo $H;?>_商务物流网_V-Get!</a></h1></div></div>
<div id="n"><div class="w"><a href="http://wuliu.v-get.com/">首页</a></div></div>
<div id="m"><div class="w"><div class="p"><strong>物流查询工具</strong><a href="http://www.v-get.com/">V-Get!</a>&gt;<a href="http://wuliu.v-get.com/">商务物流网</a>&gt;<a href="http://yiwu.wuliu.v-get.com/">义乌物流公司</a>&gt; <?php echo $a;?>查询</div><div class="q"><script type="text/javascript">var cpro_id="u1158457";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div></div></div>
<div class="o w v">
<div class="p l"><h5>内贸物流</h5><ul><li><a href="http://wuliu.v-get.com/help/timezone_tools.html" class="lotimezone">时区区号</li><li><a href="http://wuliu.v-get.com/help/ports_tools.html" class="loports">世界港口</a></li><ul><li><a href="http://wuliu.v-get.com/help/chepai_chaxun.html" class="lochepai">车牌归属</a></li><li><a href="#">站点地图</a></li><li><a href="http://wuliu.v-get.com/help/privacy_center.html" class="loprivacy">隐私策略</a></li><li><a href="http://wuliu.v-get.com/help/agree_center.html" class="loagree">用户协议</a></li><li><a href="http://wuliu.v-get.com/help/law_center.html" class="lolaw">法律声明</a></li></ul></div>
<div class="q c" id="c">
<h5><?php echo $H;?></h5>
<div class="cc"><?php echo $Qa['f'];?></div>
</div></div>
<div class="o b">&copy; V-Get.com </div>
<div style="display:none"><script type="text/javascript">A('c')</script></div>
<script type="text/javascript">var cpro_id = "u1132441";</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>
</body></html>