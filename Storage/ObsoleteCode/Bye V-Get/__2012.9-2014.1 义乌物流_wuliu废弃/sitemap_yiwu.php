<?php
require('c.php');
/* &要用&amp 转义  要对中文进行 urlencode转码！！！  http://www.sitemaps.org/protocol.html 
在义乌物流发生重大改变的时候，才更新修改一次*/
$boo=1;  //boo=1  xml格式，  boo=0 html格式  

$k1=array('北京','上海','松江','普陀','宝山','闵行','浦东','嘉定','黄浦','闸北','南汇','天津','重庆','杭州','宁波','余姚','慈溪','奉化','温州','瑞安','乐清','嘉兴','海宁','平湖','桐乡','湖州','绍兴','诸暨','上虞','嵊州','金华','兰溪','东阳','永康','衢州','江山','舟山','台州','温岭','临海','丽水','龙泉','江苏','南京','无锡','江阴','宜兴','徐州','新沂','邳州','常州','溧阳','金坛','苏州','常熟','张家港','昆山','吴江','太仓','南通','启东','如皋','通州','海门','连云港','淮安','盐城','东台','大丰','扬州','仪征','高邮','江都','镇江','丹阳','扬中','句容','泰州','兴化','靖江','泰兴','姜堰','宿迁','黑龙江','哈尔滨','阿城','双城','尚志','五常','齐齐哈尔','讷河','鸡西','虎林','密山','鹤岗','双鸭山','大庆','伊春','铁力','佳木斯','同江','富锦','七台河','牡丹江','海林','宁安','穆棱','黑河','北安','五大连池','绥化','安达','肇东','海伦','吉林','长春','九台','榆树','德惠','吉林','蛟河','桦甸','舒兰','磐石','四平','公主岭','双辽','辽源','通化','梅河口','集安','白山','临江','松原','白城','洮南','大安','延吉','图们','敦化','珲春','龙井','和龙','辽宁','沈阳','新民','大连','瓦房店','普兰店','庄河','鞍山','海城','抚顺','本溪','丹东','东港','凤城','锦州','凌海','北宁','营口','盖州','大石桥','阜新','辽阳','灯塔','盘锦','铁岭','调兵山','开原','朝阳','北票','凌源','葫芦岛','兴城','内蒙古','呼和浩特','包头','乌海','赤峰','通辽','霍林郭勒','鄂尔多斯','呼伦贝尔','满洲里','牙克石','扎兰屯','额尔古纳','根河','巴彦淖尔','临河','乌兰察布','集宁','丰镇','乌兰浩特','阿尔山','二连浩特','锡林浩特','新疆','乌鲁木齐','克拉玛依','吐鲁番','哈密','昌吉','阜康','米泉','博乐','库尔勒','阿克苏','阿图什','喀什','和田','伊宁','奎屯','塔城','乌苏','阿勒泰','青海','西宁','西藏','拉萨','甘肃','兰州','嘉峪关','金昌','白银','天水','武威','张掖','平凉','酒泉','玉门','敦煌','庆阳','西峰','定西','陇南','临夏','合作','宁夏','银川','灵武','石嘴山','吴忠','青铜峡','固原','中卫','陕西','西安','铜川','宝鸡','咸阳','渭南','韩城','华阴','延安','汉中','榆林','安康','商洛','山西','太原','古交','大同','阳泉','长治','潞城','晋城','高平','朔州','晋中','介休','运城','永济','河津','忻州','原平','临汾','侯马','霍州','吕梁','孝义','汾阳','河北','石家庄','辛集','藁城','晋州','新乐','鹿泉','唐山','遵化','迁安','秦皇岛','邯郸','武安','邢台','南宫','沙河','保定','涿州','定州','安国','高碑店','承德','沧州','泊头','任丘','黄骅','河间','廊坊','霸州','三河','衡水','冀州','深州','山东','济南','章丘','青岛','胶州','即墨','平度','胶南','莱西','淄博','枣庄','滕州','东营','烟台','龙口','莱阳','莱州','蓬莱','招远','栖霞','海阳','潍坊','青州','诸城','寿光','安丘','高密','昌邑','济宁','曲阜','兖州','邹城','泰安','新泰','肥城','威海','文登','荣成','乳山','日照','莱芜','临沂','德州','乐陵','禹城','聊城','临清','滨州','菏泽','安徽','合肥','芜湖','蚌埠','淮南','马鞍山','淮北','铜陵','安庆','桐城','黄山','滁州','天长','明光','阜阳','界首','宿州','巢湖','六安','毫州','池州','宣城','宁国','河南','郑州','巩义','荥阳','新密','新郑','登封','开封','洛阳','偃师','平顶山','汝州','安阳','林州','鹤壁','新乡','卫辉','辉县','焦作','济源','沁阳','孟州','濮阳','许昌','禹州','长葛','漯河','三门峡','义马','灵宝','南阳','邓州','商丘','永城','信阳','周口','项城','驻马店','湖北','武汉','黄石','大冶','十堰','丹江口','宜昌','宜都','当阳','枝江','襄樊','老河口','枣阳','宜城','鄂州','荆门','钟祥','孝感','应城','安陆','汉川','荆州','石首','洪湖','松滋','黄冈','麻城','武穴','咸宁','赤壁','随州','广水','恩施','利川','仙桃','潜江','天门','四川','成都','都江堰','彭州','邛崃','崇州','自贡','攀枝花','泸州','德阳','广汉','什邡','绵竹','绵阳','江油','广元','遂宁','内江','乐山','峨眉山','南充','阆中','眉山','宜宾','广安','华蓥','达州','万源','雅安','巴中','资阳','简阳','西昌','云南','昆明','安宁','曲靖','宣威','玉溪','保山','昭通','丽江','思茅','临沧','楚雄','个旧','开远','大理','瑞丽','贵州','贵阳','清镇','六盘水','遵义','赤水','仁怀','安顺','铜仁','兴义','毕节','凯里','都匀','福泉','湖南','长沙','浏阳','株洲','醴陵','湘潭','湘乡','韶山','衡阳','耒阳','常宁','邵阳','武冈','岳阳','汨罗','临湘','常德','津市','张家界','益阳','沅江','郴州','资兴','永州','怀化','洪江','娄底','冷水江','涟源','吉首','江西','南昌','乐平','萍乡','九江','瑞昌','新余','鹰潭','贵溪','赣州','瑞金','南康','吉安','井冈山','宜春','丰城','樟树','高安','抚州','上饶','德兴','福建','福州','福清','长乐','厦门','莆田','三明','永安','泉州','石狮','晋江','南安','漳州','龙海','南平','邵武','武夷山','建瓯','建阳','龙岩','漳平','宁德','福安','福鼎','广东','广州','增城','从化','韶关','乐昌','南雄','深圳','珠海','汕头','澄海','佛山','江门','台山','开平','鹤山','恩平','湛江','廉江','雷州','吴川','茂名','高州','化州','信宜','肇庆','高要','四会','惠州','梅州','兴宁','汕尾','陆丰','河源','阳江','阳春','清远','英德','连州','东莞','中山','潮州','揭阳','普宁','云浮','罗定','广西','南宁','柳州','桂林','梧州','岑溪','北海','防城港','东兴','钦州','贵港','桂平','玉林','北流','百色','贺州','河池','宜州','来宾','合山','崇左','凭祥','海南','海口','琼山','三亚');

$k2=array('国际物流中心','出租','集装箱','内陆口岸','稠城');
$k3=array('长途货运','搬厂','空调拆装','搬运钢琴','家电维修','家政');
$k4=array('厢式货车','小货车','江东','稠城','北苑');
$k5=array('杭州','宁波','上海','江苏','山东','福建','河北','安徽','河南','江西','广东','山西');
$k9=array('国际快递','空运','海运','报关','报检','CIQ','DHL','FedEx','UPS','TNT','EMS','进出口','拼箱','整箱','清关','退税','仓储','代理订舱','Aramex','商检','船公司','核销单','植检','报检','上海港','宁波港','出口退税','中东','欧洲','俄罗斯','邮政小包');







if($boo==1){
//$d=date("Y-m-d\TH:i:s");
$d='2012-10-07T08:41:02+08:00'; //避免多次提交相同的sitemap<那样会删除掉之前的索引的，所以changefreq定下来就可以固定了，添加新的再添加新的sitemap
echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
echo '<url><loc>http://yiwu.wuliu.v-get.com/</loc><priority>1</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/tuoyun/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/cangku/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/banjia/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/huoche/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/keyun/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/train/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/join/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/shebei/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url><url><loc>http://yiwu.wuliu.v-get.com/huodai/</loc><priority>0.9</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';


$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=1 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/tuoyun-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=2 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/cangku-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}


$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=3 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/banjia-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=4 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/huoche-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=5 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/keyun-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=6 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/train-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=7 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/join-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=8 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/shebei-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=9 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/huodai-'.$i.'/</loc><priority>0.6</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>weekly</changefreq></url>';}



for($i=0;$i<count($k1);$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/tuoyun/s?sc=0&amp;sk='.urlencode($k1[$i]).'</loc><priority>0.3</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>monthly</changefreq></url>';}

for($i=0;$i<count($k2);$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/cangku/s?sc=0&amp;sk='.urlencode($k2[$i]).'</loc><priority>0.3</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>monthly</changefreq></url>';}

for($i=0;$i<count($k3);$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/banjia/s?sc=0&amp;sk='.urlencode($k3[$i]).'</loc><priority>0.3</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>monthly</changefreq></url>';}

for($i=0;$i<count($k4);$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/huoche/s?sc=0&amp;sk='.urlencode($k4[$i]).'</loc><priority>0.3</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>monthly</changefreq></url>';}

for($i=0;$i<count($k9);$i++){echo '<url><loc>http://yiwu.wuliu.v-get.com/huodai/s?sc=0&amp;sk='.urlencode($k9[$i]).'</loc><priority>0.3</priority><lastmod>'.$d.'+08:00</lastmod><changefreq>monthly</changefreq></url>';}
echo '</urlset>';
}




else 
{
$ss='<ul style="line-height:18pt"><li><a href="http://yiwu.wuliu.v-get.com/">义乌市物流网</a></li><li><a href="http://yiwu.wuliu.v-get.com/tuoyun/">义乌市物流托运</a></li><li><a href="http://yiwu.wuliu.v-get.com/cangku/">义乌市仓库出租</a></li><li><a href="http://yiwu.wuliu.v-get.com/banjia/">义乌市搬家搬厂公司</a></li><li><a href="http://yiwu.wuliu.v-get.com/huoche/">义乌市货车出租</a></li><li><a href="http://yiwu.wuliu.v-get.com/keyun/">义乌市客运货车</a></li><li><a href="http://yiwu.wuliu.v-get.com/train/">义乌市物流培训</a></li><li><a href="http://yiwu.wuliu.v-get.com/join/">义乌市物流加盟</a></li><li><a href="http://yiwu.wuliu.v-get.com/shebei/">义乌市物流设备</a></li><li><a href="http://yiwu.wuliu.v-get.com/huodai/">义乌市国际货运代理公司</a></li></ul>';

$sss='';

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=1 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/tuoyun-'.$i.'/">义乌市托运部'.$i.'</a>|||';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=2 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/cangku-'.$i.'/">义乌市仓库出租'.$i.'</a>|||';}


$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=3 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/banjia-'.$i.'/">义乌市搬家搬厂公司'.$i.'</a>|||';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=4 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/huoche-'.$i.'/">义乌市货车出租'.$i.'</a>|||';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=5 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/keyun-'.$i.'/">义乌市客运托运公司'.$i.'</a>|||';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=6 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/train-'.$i.'/">义乌市物流培训'.$i.'</a>|||';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=7 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/join-'.$i.'/">义乌市物流合作'.$i.'</a>|||';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=8 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/shebei-'.$i.'/">义乌市物流工具公司'.$i.'</a>|||';}

$ry=mysql_query('SELECT COUNT(*) FROM c WHERE a=9 and b=154');
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/10);$Pz++;
for ($i=2;$i<$Pz;$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/huodai-'.$i.'/">义乌市国际物流'.$i.'</a>|||';}
for($i=0;$i<count($k1);$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=0&amp;sk='.urlencode($k1[$i]).'">义乌市到'.$k1[$i].'物流公司</a>|||';}
for($i=0;$i<count($k2);$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/cangku/s?sc=0&amp;sk='.urlencode($k2[$i]).'">义乌市'.$k2[$i].'临时仓库出租</a>|||';}
for($i=0;$i<count($k3);$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/banjia/s?sc=0&amp;sk='.urlencode($k3[$i]).'">义乌市'.$k3[$i].'搬家公司</a>|||';}
for($i=0;$i<count($k4);$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/huoche/s?sc=0&amp;sk='.urlencode($k4[$i]).'">义乌市'.$k4[$i].'货车出租</a>|||';}
for($i=0;$i<count($k9);$i++){$sss.='<a href="http://yiwu.wuliu.v-get.com/huodai/s?sc=0&amp;sk='.urlencode($k9[$i]).'">义乌'.$k9[$i].'物流公司</a>|||';}
$sssa=explode('|||',$sss);
$sssal=ceil(count($sssa)/91);




//叫做手机版！！！！
$ssx='';
for($I=0;$I<$sssal;$I++){
$IA=$I+1;
$ssx.='<a href="http://yiwu.wuliu.v-get.com/m/yiwu'.$IA.'.html">第'.$IA.'页</a>&nbsp;&nbsp;';
$sss_sub='';
//这里是 整取，会出现零头不够的现象报错，所以不要管就是了
for($J=0;$J<91;$J++){$IJ=($I*90)+$J;$sss_sub.='<li>'.$sssa[$IJ].'</li>';}
$content='<!DOCTYPE html><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head><body><ol style="line-height:18pt">'.$sss_sub.'</ol><p><a href="http://yiwu.wuliu.v-get.com/m/yiwu.html">首页</a>&nbsp;&nbsp;<a href="http://yiwu.wuliu.v-get.com/m/yiwu'.($IA+1).'.html">下一页</a></p></body></html>';
$of=fopen('_m/yiwu'.$IA.'.html','w+');
if($of){fwrite($of,$content);}
fclose($of);
 
}
$content='<!DOCTYPE html><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head><body>'.$ss.'<p>'.$ssx.'</p></body></html>';
$of=fopen('_m/yiwu.html','w+');
if($of){fwrite($of,$content);}
fclose($of);
/*
$content =$sss;//$content = file_get_contents("http://localhost/a.php");得到文件执行的结果
$of = fopen('dir.html','w');//创建并打开dir.txt/dir.html
if($of){
 fwrite($of,$content);//把执行文件的结果写入txt文件
}
fclose($of);
*/
}
?>