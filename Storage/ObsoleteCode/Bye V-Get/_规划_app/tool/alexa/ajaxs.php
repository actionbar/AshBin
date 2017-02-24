<?php
header("Content-Type:text/html;charset=GB2312");
$domain = $_GET['domain'];
$action = $_GET['action'];
$alexa['pm'] = $alexa['qs'] = $alexa['bl']= $alexa['cbh'] = $alexa['fname'] = $alexa['fpercent'] = $alexa['zp'] =$alexa['cpm']= array();
if($action == 'rangs'){
	$content = file_get_contents('http://www.alexa.com/data/details/traffic_details/'.$domain);	
	$pat1    = "/<td class=\"avg \">(.+)<\/td>/";//排名
	if(preg_match_all($pat1, $content, $matches)){
		$a = explode('.',$matches[1][3]);	
		if($a[1]){
			$b = explode('.',$matches[1][2]);
			if($b[1]){		
			   array_push($alexa['pm'],'--','--',$matches[1][0],$matches[1][1]);
			}else{
			   array_push($alexa['pm'],'--',$matches[1][0],$matches[1][1],$matches[1][2]);
			}
		}else{
		   array_push($alexa['pm'],$matches[1][0],$matches[1][1],$matches[1][2],$matches[1][3]);
		}
	}
	$pat2 = "/(.+)<\/td><td class=\'arrow\'>/";	//排名变化趋势
	if(preg_match_all($pat2, $content, $matches2)){
		if($a[1]){		
			if($b[1]){		
			   array_push($alexa['qs'],'--','--',$matches2[1][0],$matches2[1][1]);
			}else{
			   array_push($alexa['qs'],'--',$matches2[1][0],$matches2[1][1],$matches2[1][2]);
			}
		}else{
		   for($j=0;$j<4;$j++){
			  array_push($alexa['qs'],$matches2[1][$j]);
		   }
		}	
	}
	for($i=0;$i<sizeof($alexa['qs']);$i++){
		if($alexa['qs'][$i]>0){
			$alexa['qs'][$i] = "<img src=images/Down_arrow.gif border=0><font color=#FF0000>".substr($alexa['qs'][$i],1)."</font>";
		}elseif($alexa['qs'][$i]<0){
			$alexa['qs'][$i] = "<img src=images/Up_arrow.gif border=0><font color=#329A02>".substr($alexa['qs'][$i],1)."</font>";
		}
	}
	echo $alexa['pm'][0].'|'.$alexa['qs'][0].'|'.$alexa['pm'][1].'|'.$alexa['qs'][1].'|'.$alexa['pm'][2].'|'.$alexa['qs'][2].'|'.$alexa['pm'][3].'|'.$alexa['qs'][3];exit;
}elseif($action == 'visits'){
	$content = file_get_contents('http://www.alexa.com/data/details/traffic_details/'.$domain);
	$content = iconv("UTF-8","GB2312",$content);
	$pat3 ="/<p class=\"tc1\" style=\"width:30%; text-align:right;\">(.+)<\/p>/";//中国页面浏览比例及网站访问比例
	if(preg_match_all($pat3, $content, $matches3)){
		for($k=0;$k<sizeof($matches3[0]);$k++){
			array_push($alexa['bl'],$matches3[0][$k]);
		}
	}
	$pat4 = "/alt=\"China Flag\"\/>(.+)<\/div>/s";//中文排名
	if(preg_match_all($pat4, $content, $matches4)){
		$a = explode(" ",$matches4[1][0]);
		$alexa['zp'] = array($a[0]);
	}
	$pat7 = "/<p class=\"tc1\" style=\"width:40%; text-align:right;\">(.+)<\/p>/Us";//国家排名
	if(preg_match_all($pat7, $content, $matches7)){
		for($j=0;$j<sizeof($matches7[0]);$j++){
		   array_push($alexa['cpm'],$matches7[0][$j]);
		}
	}
	$pat8 = "/<a href=\"\/topsites\/countries\/(.*)\">/Uis";//国家编号
	if(preg_match_all($pat8, $content, $matches8)){
		for($j=0;$j<sizeof($alexa['cpm']);$j++){
		   array_push($alexa['cbh'],$matches8[1][$j]);
		}
	}
?>			
		<table width="780" cellspacing="0">
			<tr>
				<td class="project_left" id="Number">国家/地区名称</td>
				<td class="project">国家/地区代码</td>
				<td class="project">国家/地区排名</td>
				<td class="project">网站访问比例</td>
				<td class="project">页面浏览比例</td>
			</tr>	
<?php
for($k=0;$k<sizeof($alexa['cpm']);$k++){
?>
	<tr>
		<td class="rank_left"><?php echo $a=$alexa['cbh'][$k]=='US'?'美国':($alexa['cbh'][$k]=='IN'?'印度':($alexa['cbh'][$k]=='CN'?'中国':($alexa['cbh'][$k]=='DE'?'德国':($alexa['cbh'][$k]=='GB'?'英国':($alexa['cbh'][$k]=='BR'?'巴西':($alexa['cbh'][$k]=='IR'?'伊朗':($alexa['cbh'][$k]=='JP'?'日本':($alexa['cbh'][$k]=='IT'?'意大利':($alexa['cbh'][$k]=='RU'?'俄罗斯':($alexa['cbh'][$k]=='ID'?'印度尼西亚':($alexa['cbh'][$k]=='CA'?'加拿大':($alexa['cbh'][$k]=='ES'?'西班牙':($alexa['cbh'][$k]=='FR'?'法国':($alexa['cbh'][$k]=='AU'?'澳大利亚':($alexa['cbh'][$k]=='PK'?'巴基斯坦':($alexa['cbh'][$k]=='TR'?'土耳其':($alexa['cbh'][$k]=='MX'?'墨西哥':($alexa['cbh'][$k]=='NL'?'荷兰':($alexa['cbh'][$k]=='ZA'?'南非':($alexa['cbh'][$k]=='SA'?'沙特阿拉伯':($alexa['cbh'][$k]=='PL'?'波兰':($alexa['cbh'][$k]=='BD'?'孟加拉国':($alexa['cbh'][$k]=='DZ'?'阿尔及利亚':($alexa['cbh'][$k]=='TH'?'泰国':($alexa['cbh'][$k]=='EG'?'埃及':($alexa['cbh'][$k]=='SE'?'瑞典':($alexa['cbh'][$k]=='UA'?'乌克兰':($alexa['cbh'][$k]=='GR'?'希腊':($alexa['cbh'][$k]=='HK'?'香港特区':($alexa['cbh'][$k]=='MO'?'澳门特区':'韩国'))))))))))))))))))))))))))))));
 ?>
</td>
		<td class="rank"><?php echo $alexa['cbh'][$k]?></td>
		<td class="rank"><?php echo $alexa['cpm'][$k]?></td>
		<td class="rank">--</td>
		<td class="rank">--</td>
	</tr>
<?php
}
?>
</table>
<?php
}elseif($action == 'sonvisits'){
	$content = file_get_contents('http://www.alexa.com/data/details/traffic_details/'.$domain);
	$content = iconv("UTF-8","GB2312",$content);
	$pat5 = "/<p class=\"tc1\" style=\"width:70%\">([\w.+(\-.*)\w.+\.]+[a-z])<\/p>/";	//被访问网址
	if(preg_match_all($pat5, $content, $matches5)){
		for($i=0;$i<sizeof($matches5[0]);$i++){
		  array_push($alexa['fname'],$matches5[0][$i]);
		}
	}
	$pat6 = "/<p class=\"tc1\" style=\"width:30%; text-align:right;\">(.+)<\/p>/Us";//近月页面访问比例
	if(preg_match_all($pat6, $content, $matches6)){
		for($j=0;$j<sizeof($alexa['fname'])+1;$j++){
		   array_push($alexa['fpercent'],$matches6[0][$j]);
		}
	}
?>
	<table width="780" cellspacing="0">
			<tr>
				<td class="project_left">被访问网址 [<?php if(sizeof($alexa['fname'])>0) {$a = sizeof($alexa['fname'])+1;}else{$a = 0;} echo $a;?> 个]</td>
				<td class="project">近月网站访问比例</td>
				<td class="project">近月页面访问比例</td>
				<td class="project">人均页面浏览量</td>
			</tr>
<?php
for ($f=0;$f<sizeof($alexa['fname']);$f++){
?>
	<tr>
		<td class="rank_left"><?php echo $alexa['fname'][$f]?></td>
		<td class="rank"><font color="#FF0000">--</font></td>
		<td class="rank" align="center"><font color="#FF0000"><?php echo $alexa['fpercent'][$f]?></font></td>
		<td class="rank"><font color="#FF0000">--</font></td>
	</tr>
<?php
}
if(sizeof($alexa['fname'])>0){
	$m = sizeof($alexa['fname']);
?>
<tr>
		<td class="rank_left">OTHER</td>
		<td class="rank"><font color="#FF0000">--</font></td>
		<td class="rank" align="center"><font color="#FF0000"><?php echo $alexa['fpercent'][$m]?></font></td>
		<td class="rank"><font color="#FF0000">--</font></td>
	</tr>
<?php
}
?>
</table>
<?php
}
?>