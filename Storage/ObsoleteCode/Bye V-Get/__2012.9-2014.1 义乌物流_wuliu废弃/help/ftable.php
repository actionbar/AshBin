<?php 
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('v2',$QC);mysql_query('set names utf8');
$G=$_GET['i'];
$Qq=mysql_query('SELECT h,k,d,f FROM f WHERE g="'.$G.'" LIMIT 1');
$Qa=mysql_fetch_array($Qq);
if(!$Qa){header('HTTP/1.1 404 Not Found');header('Status: 404 Not Found');exit;}
$H=$Qa['h'];
?>
<!DOCTYPE HTML><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"/><title><?php echo $H;?>_商务物流网_V-Get!</title><meta name="keywords" content="<?php echo $Qa['k'];?>"/><meta name="description" content="<?php echo $Qa['d'];?>"/><link href="http://weigeti.com/p0/favicon.ico" type="image/ico" rel="shortcut icon" /><link rel="stylesheet" type="text/css" href="c.css" /><style type="text/css">._r{border-top:#ddd 1px solid;border-left:#ddd 1px solid;font-size:14px;background:#eee}th,td{border-color:#ddd}</style><script type="text/javascript" src="http://localhost/www.v-get.com/p0/c.js"></script></head><body><div class="w u"><div class="i"><h1><a href="http://wuliu.v-get.com/"><?php echo $H;?>_商务物流网_V-Get!</a></h1></div></div>
<div id="n"><div class="w"><a href="http://wuliu.v-get.com/">首页</a></div></div>
<div id="m"><div class="w"><div class="p"><strong>物流数据表</strong><a href="http://www.v-get.com/">V-Get!</a>&gt;<a href="http://wuliu.v-get.com/">商务物流网</a>&gt;<a href="http://yiwu.wuliu.v-get.com/">义乌物流公司</a>&gt; <?php echo $a;?>查询</div><div class="q"><script type="text/javascript">var cpro_id="u1158457";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div></div></div>
<div class="o w v" id="c"><?php echo $Qa['f'];?></div>
<div class="o b">&copy; V-Get.com </div><div style="display:none"><script type="text/javascript">$A('c','_blank');</script></div></body></html>