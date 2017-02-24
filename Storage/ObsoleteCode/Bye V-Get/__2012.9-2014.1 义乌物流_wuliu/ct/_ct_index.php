<?php
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">&#30830;&#23450;&#26356;&#26032;&#25152;&#26377;&#30340;&#29289;&#27969;&#20998;&#31449;&#65311;</a>';
exit;
}
require '../_/global.php';
require '_.php';
foreach($cts as $ct=>$ctb){
$ct_id=$ctb[0];  // 330782 城市身份证开头
$ct_short=$ctb[1];
$ct_full=$ctb[2];
$ct_arr=$ctb[3];
$aa='';$aA='';
$cioption='';
foreach($ct_arr as $ctarr=>$ctarrk){
$aa.=",'".$ctarr."'=>'".$ctarrk[2]."'";
$aA.=",'".$ctarr."'=>".$ctarrk[0]."";
$cioption.='<option value="'.$ctarr.'">'.$ctarrk[1].'</option>';
}
$aa=substr($aa,1);
$aA=substr($aA,1);
$ct_arr='$aa=array('.$aa.');$aA=array('.$aA.');';

$file=constant('uploadFile').'ct/'.$ct.'.wuliu.v-get.com.html';
$fp=fopen($file,'w+');
if(is_writable($file)==false) {die("文件没有找到");exit;}
else{

/*××××××××××××××××××××××× 定义 ct 的 c ××××××××××××××××××××××× */
$text='<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>'.$ct_short.'物流查询_商务物流网_V-Get!</title><meta name="keywords" content="'.$ct_short.'物流,'.$ct_short.'物流网,'.$ct_short.'托运部,'.$ct_short.'货代,'.$ct_short.'仓库出租" /><meta name="description" content="商务物流网'.$ct_short.'物流查询致力于提供'.$ct_short.'托运部查询,'.$ct_short.'仓库出租,'.$ct_short.'搬厂搬家公司,'.$ct_short.'货车出租,'.$ct_short.'长途客运,'.$ct_short.'国际物流公司,船公司,报关行等货运物流信息查询服务。" /><link href="'.constant('V0').'i.css" type="text/css" rel="stylesheet" /><link href="'.constant('V0_wuliu').'i.css" type="text/css" rel="stylesheet"/><style type="text/css">';
$index_css=file_get_contents('_ct_index.css');
$index_css=GO_INDEXCSS($index_css);
$text.=$index_css;

$text.='</style>';
$text.='</head><body><div id="t"><div class="po"><a href="'.constant('VWULIU').'">商务物流网</a><i>-</i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/">义乌市</a><span><a href="'.constant('VWULIU').'i/">论坛</a></span></div></div><div class="o w"><div class="u"><div class="p i"></div><div class="q g"></div><div class="o"></div></div><div id="n"><div id="na"><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/" class="no">首页</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/">托运</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/huodai/">货代</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/cangku/">仓库</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/banjia/">搬家</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/huoche/">货车</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/keyun/">客运</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/join/">联运</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/shebei/">设备</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/news/">资讯</a><i></i><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/idol/">名人</a></div></div><div class="o mh"></div><div class="wv"><div class="p wvl"><img src="http://tp.v-get.com/j/3/v145x43.gif" alt="物流认证"></div><div class="q wvr f"><p><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=北京市">北京</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=广东省">广东</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=浙江省">浙江</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=江苏省">江苏</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=山东省">山东</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=河南省">河南</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=四川省">四川</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=福建省">福建</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=安徽省">安徽</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=河北省">河北</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=辽宁省">辽宁</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=吉林省">吉林</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=黑龙江省">黑龙江</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=江西省">江西</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=贵州省">贵州</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=新疆">新疆</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=西藏">西藏</a></p><p><a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=上海市">上海</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=天津市">天津</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=重庆市">重庆</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=山西省">山西</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=陕西省">陕西</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=湖北省">湖北</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=云南省">云南</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=广西省">广西</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=湖南省">湖南</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=海南省">海南</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=青海省">青海</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=甘肃省">甘肃</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=内蒙古">内蒙古</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=宁夏">宁夏</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=香港">香港</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=台湾省">台湾</a>|<a href="http://'.constant('localhost').$ct.'.wuliu.v-get.com/tuoyun/s?sk=澳门">澳门</a></p></div></div><div class="o mh"></div><div class="v">
<div class="o mg cis"><form action="http://yiwu.wuliu.v-get.com/tuoyun/s" id="cs"><label>义乌市</label><a href="#">[选择]</a><select id="sa">';

$text.=$cioption;
$text.='</select><input type="hidden" name="ie" value="utf-8"><input class="cisk" type="text" placehold="" name="sk"><input type="submit" class="ciss" value="搜索"><span class="pr"><a href="http://yiwukb.wuliu.v-get.com/">凯邦货运</a><a href="http://wuliu.v-get.com/i/">物流论坛</a><a href="http://yiwusx.wuliu.v-get.com/">三鑫物流</a><a href="http://wuliu.v-get.com/i/topic-2-1.html">提交物流公司</a></span></form></div><div id="ci">';
for($i=1;$i<10;$i++){
$text.='<div class="ci">';
$Qq=mysql_query('SELECT i,p,m,h FROM c WHERE b='.$ct_id.' AND a= '.$i.' ORDER BY o DESC LIMIT 4');
while($Qa=mysql_fetch_array($Qq)){
$M=empty($Qa['m'])?$Qa['i']:$Qa['m'];$P=empty($Qa['p'])?0:$Qa['p'];
$text.='<div class="f"><a class="ai" href="http://wuliu.v-get.com/'.$M.'"><img width="50" height="50" alt="'.$Qa['h'].'" src="'.constant('LTP_3').'yiwu/50/'.$P.'.gif"><h3>'.$M.'<i v="2"></i></h3><p>'.$Qa['h'].'</p></a><div class="o"></div></div>';}
//最新加入的、最新修改的
$Qq=mysql_query('SELECT i,p,m,h FROM c WHERE b='.$ct_id.' AND a= '.$i.' ORDER BY t DESC LIMIT 4');
while($Qa=mysql_fetch_array($Qq)){
$M=empty($Qa['m'])?$Qa['i']:$Qa['m'];$P=empty($Qa['p'])?0:$Qa['p'];
$text.='<div class="f"><a class="ai" href="http://wuliu.v-get.com/'.$M.'"><img width="50" height="50" alt="'.$Qa['h'].'" src="'.constant('LTP_3').'yiwu/50/'.$P.'.gif"><h3>'.$M.'<i v="2"></i></h3><p>'.$Qa['h'].'</p></a><div class="o"></div></div>';}


$text.='</div>';
}
$text.='</div></div>'.constant('BOTTOM').'</div><div class="pn"><script type="text/javascript" src="'.constant('LTU').'i.js"></script><script type="text/javascript">J(\''.constant('LTU_3').'i.js\');E($("sa"),"change",function(){var d=$("ci^div.ci"),i=this.selectedIndex;F(d,function(o){D(o)});D(d[i],I);$("sa").options[i].selected=I;$("cs").action="http://'.constant('localhost').$ct.'.wuliu.v-get.com/"+this.value+"/s"});'.$TONGJI_CT[$ct].'</script></div></body></html>';

file_put_contents($file,$text);}
}
?>