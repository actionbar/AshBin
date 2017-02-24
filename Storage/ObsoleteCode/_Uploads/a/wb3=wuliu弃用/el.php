<?php
$e=$_GET['e'];
$v=$_GET['v'];
$v=str_replace('-','%,',$v);
$n=isset($_GET['n'])?$_GET['n']:'';
switch ($e)
{ /*(0=EMS;1=DHL;用$d表示，所以DHL必须是1;)2=SF;3=ARAMEX;4=STO;5=YTO;6=FEDEX;7=宅急送;8=韵达;9=UPS;10=中通;11=天天;12=;13=TNT;14=汇通;15=中铁;16=民航*/
   case 'EMS':$m='中国邮政EMS';$l='http://www.ems.com.cn/';$s=$l;$p='http://www.ems.com.cn/serviceguide/zifeichaxun/zi_fei_cha_xun.html';$c='http://www.ems.com.cn/';break;
   case 'DHL':$m='敦豪DHL';$l='http://cn.dhl.com/';$s='https://webshipping2.dhl.com/wsi/WSIServlet?moduleKey=Login&countryCode=CN';$p=$l;$c='http://www.cn.dhl.com/content/cn/zh/express/tracking.shtml?brand=DHL&AWB='.$n;break;
   case 'SF':$m='顺丰SF';$l='http://www.sf-express.com/';$s='http://www.sf-express.com/cn/sc/delivery_step/order_onweb.html';$p='http://www.sf-express.com/cn/sc/delivery_step/enquiry/rate_enquiry.html';$c='http://kf.sf-express.com/css/myquery/queryBill.action';break;
   case 'AMX':$m='ARAMEX';$l='http://www.aramex.com/';$s='http://www.aramex.com/express/service_request_interm.aspx';$p='http://www.aramex.com/express/rate_and_time.aspx';$c='http://www.aramex.com/express/track_results_multiple.aspx?ShipmentNumber='.$n;break;
   case 'STO':$m='申通STO';$l='http://www.sto.cn/';$s=$l;$p=$l;$c='http://query2.sto-express.cn/result.aspx?action=chk&wen='.$n;break;
   case 'YTO':$m='圆通YTO';$l='http://www.yto.net.cn/';$s=$l;$p=$l;$c='http://jingang.yto56.com.cn/expws/expquery/waybillService.action?waybillNo='.$n;break;
   case 'FEX':$m='FedEx';$l='http://www.fedex.com/cn/';$s=$l;$p=$l;$c='http://www.fedex.com/Tracking?clienttype=dotcomreg&ascend_header=1&cntry_code=cn&language=sim&mi=n&tracknumbers='.$n;break;
   case 'ZJS':$m='宅急送ZJS';$l='http://www.zjs.com.cn/';$s=$l;$p='http://www.zjs.com.cn/WS_Business/WS_Business_price_internal.aspx?id=6';$c='http://www.zjs.com.cn/WS_Business/WS_Business_GoodsTrack.aspx?id=6';break;
   case 'YD':$m='韵达';$l='http://www.yundaex.com/';$s=$l;$p=$l;$c='http://www.yundaex.com/';break;
   case 'UPS':$m='UPS';$l='http://www.ups.com/cn';$s=$l;$p='http://www.ups.com/content/cn/zh/freight/index.html';$c='http://wwwapps.ups.com/WebTracking/track?loc=zh_CN&track.x=%E8%BF%BD%E8%B8%AA&trackNums='.$n;break;
   case 'ZTO':$m='中通';$l='http://www.zto.cn/';$s=$l;$p=$l;$c=$l;break;
   case 'TT':$m='海航天天';$l='http://www.ttkdex.com/';$s=$l;$p='http://www.ttkdex.com/guide/charging.html';$c=$l;break;
   case 'TNT':$m='TNT';$l='http://www.tnt.com.cn/';$s=$l;$p=$l;$c=$l;break;
   case 'HT':$m='汇通';$l='http://www.htky365.com/';$s=$l;$p='http://www.htky365.com/service/cost.html';$c=$l;break;
   case 'CRE':$m='中铁';$l='http://www.cre.cn/';$s='http://www.cre.cn/jsp/zxdc/zxdc1.jsp';$p='http://www.cre.cn/jsp/ywzx/mm.jsp?ColumnID=49';$c=$l;break;
   case 'CAE':$m='民航';$l='http://www.cae.com.cn/';$s=$l;$p=$l;$c='http://www.cae.com.cn/MailSC.aspx?page=1&m=20090225091211060966';break;
   default:$m='中国邮政EMS';$l='http://www.ems.com.cn/';$s=$l;$p='http://www.ems.com.cn/serviceguide/zifeichaxun/zi_fei_cha_xun.html';$c='http://www.ems.com.cn/';
	}

	
echo '<html><head><title>'.$m.'官网/网上寄件/运费查询</title><meta http-equiv="Content-Type" content="text/html;charset=utf-8" /><link rel="shortcut icon" href="'.$l.'/favicon.ico" />
</head><frameset cols="'.$v.'%" border="0"><frame src="'.$l.'"  /><frame src="'.$s.'"  /><frame src="'.$p.'"  /><frame src="'.$c.'"  />
<noframes><body><a href="http://'.$l.'">'.$m.'官网</a><a href="http://'.$l.'">'.$m.'网上寄件</a><a href="http://'.$l.'">'.$m.'运费查询</a></body></noframes></frameset></html>';


?>


