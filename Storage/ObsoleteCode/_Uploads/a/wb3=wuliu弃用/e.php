<?php
/*366px*105*/
$e=isset($_GET['e'])?$_GET['e']:'SF';  /*可以根据e,然后获取各个单号查询的地址;为了以后的单号查询，所以国际国内e是相同的*/
$e=strtoupper($e);
$q=NULL;
switch ($e)
{ /*(0=EMS;1=DHL;用$d表示，所以DHL必须是1;)2=SF;3=ARAMEX;4=STO;5=YTO;6=FEDEX;7=宅急送;8=韵达;9=UPS;10=中通;11=天天;12=;13=TNT;14=汇通;15=中铁;16=民航*/
   case 'EMS':$m='中国邮政EMS';$l='http://www.ems.com.cn/';$p='11185';$q='';break;
   case 'DHL':$m='敦豪DHL';$l='http://cn.dhl.com/';$p='800-810-8000';$q='';break;
   case 'SF':$m='顺丰SF';$l='http://www.sf-express.com/';$p='400-811-1111';$q='Q400811111';break;
   case 'AMX':$m='ARAMEX';$l='http://www.aramex.com/';$p='010-64667790';$q='';break;
   case 'STO':$m='申通STO';$l='http://www.sto.cn/';$p='400-889-5543';$q='';break;
   case 'YTO':$m='圆通YTO';$l='http://www.yto.net.cn/';$p='400-609-5554';$q='Q800095554';break;
   case 'FEX':$m='FedEx';$l='http://www.fedex.com/cn/';$p='800-988-1888';$q='';break;
   case 'ZJS':$m='宅急送ZJS';$l='http://www.zjs.com.cn/';$p='400-6789-000';$q='';break;
   case 'YD':$m='韵达YD';$l='http://www.yundaex.com/';$p='021-39207888';$q='Q4008216789';break;
   case 'UPS':$m='UPS';$l='http://www.ups.com/cn';$p='800-820-8388';$q='';break;
   case 'ZTO':$m='中通';$l='http://www.zto.cn/';$p='021-39777777';$q='';break;
   case 'TT':$m='海航天天';$l='http://www.ttkdex.com/';$p='4001-888-888';$q='';break;
   case 12:$m='';$x='';$l='';$p='';$q='';break;
   case 'TNT':$m='TNT';$l='http://www.tnt.com.cn/';$p='800-820-9868';$q='';break;
   case 'HT':$m='汇通';$l='http://www.htky365.com/';$p='021-62963636';$q='';break;
   case 'CRE':$m='中铁';$l='http://www.cre.cn/';$p='95572';$q='';break;
   case 'CAE':$m='民航';$l='http://www.cae.com.cn/';$p='400-817-4008';$q='';break;
   default:$m='顺丰SF';$l='http://www.sf-express.com/';$p='400-811-1111';$q='Q400811111';
	}
echo '<!DOCTYPE HTML><head><meta http-equiv="content-type" content="text/html; charset=utf-8" /></head><html><style type="text/css">
<!--
*{padding:0;margin:0}
body{font-size:14px;color: #333;font-family:tahoma,simsun}img {border-width:0;vertical-align:middle}
a{color:#333;text-decoration: none;margin-right:9px}
a:hover {color: #c00;text-decoration: underline;}
#ses{width:50px}.p{float:left}.o{clear:both}.q{float:right}
.n{width:190px;margin:0 5px}
p{height:24px;line-height:24px}
.p1{height:32px;line-height:32px}
input{height:22px}
.t img{width:16px;height:16px;margin-right:5px}
.b{width:55px;height:24px;margin:5px}
.ssss{border:#ccc 1px solid;border-radius:4px;background:#F6F6F6;padding:2px 8px;font-family:"宋体";font-size:12px}

-->
</style>
<script type="text/javascript" src="http://weigeti.com/p0/c.js"></script>

<body>
<div class="d1">
<form action="el.php" method="get" target="_blank" onsubmit="javascript:if(L(this.n.value)<=0)return false;">

<p><span class="p t"><a href="el.php?v=100-0-0-0&e='.$e.'" target="_blank"><img i="'.$l.'/favicon.ico" onerror="javascript:this.src=\'http://weigeti.com/p0/f1.ico\'" />'.$m.'</a>（'.$p.'）</span><span class="q"><a href="el.php?v=0-100-0-0&e='.$e.'" class="ssss" target="_blank">寄件</a><a href="el.php?v=0-0-100-0&e='.$e.'" class="ssss" target="_blank">邮费</a></span></p>
<p class="o p1"><select id="ses"><option>'.$e.'</option></select><input type="text" class="n" name="n" autocomplete="off"/><input type="submit" value="查单" class="b"/><span q="'.$q.'"></span></p>
<p><a href="e.php?e=SF">顺丰</a><a href="e.php?e=EMS">邮政</a><a href="e.php?e=STO">申通</a><a href="e.php?e=YTO">圆通</a><a href="e.php?e=YD">韵达</a><a href="e.php?e=ZJS">宅急送</a><a href="e.php?e=TT">天天</a><a href="e.php?e=HT">汇通</a><a href="e.html">&gt;&gt;</a></p>
<p><a href="e.php?e=DHL">DHL</a><a href="e.php?e=AMX">Aramex</a><a href="e.php?e=FEX">FedEx</a><a href="e.php?e=UPS">UPS</a><a href="e.php?e=TNT">TNT</a><a href="e.php?e=TT">天天</a><a href="e.php?e=HT">汇通</a></p>
<input type="hidden" name="v" value="0-0-0-100" /><input type="hidden" name="e" value="'.$e.'"  />
</form>
</div>
<script language="javascript" type="text/javascript">
Q();
</script></body></html>
';
?>
