<?php
/**********************************************************
根据 下面的接口可获得城市天气情况

http://www.weather.com.cn/data/sk/101010100.html  实时天气信息

http://www.weather.com.cn/data/cityinfo/101010100.html

http://m.weather.com.cn/data/101010100.html 六天预报


city		"北京"    //城市名称
city_en	"beijing"//应为名称
date_y		"2011年10月18日"//当前日期
date		"辛卯年"//阴历年
week		"星期二"//星期几
fchh		"18"//不详
cityid		"101010100"//城市编码
//这里的温度 在下午更新后是这样的, 具体的更新点儿有待补上（下午好像是18点左右，白天的自己研究去吧 哈哈）
//当那个更新点未到达之前是这样的："temp1":"19℃~12℃", 也就是今天的最高温和最低温,也就是每天都会有个最高温和最低温,就看是那个点更新的数据了….
temp1		"10℃~19℃"//当前日期是18日那这第一个的温度为19日凌晨到19日中午是的温度，下面以此类推
temp2		"12℃~20℃"
temp3		"11℃~21℃"
temp4		"11℃~19℃"
temp5		"13℃~18℃"
temp6		"10℃~17℃"
tempF1		"50℉~66.2℉"//华氏温度 同上
tempF2		"53.6℉~68℉"
tempF3		"51.8℉~69.8℉"
tempF4		"51.8℉~66.2℉"
tempF5		"55.4℉~64.4℉"
tempF6		"50℉~62.6℉"
weather1		"晴转阴"//同温度一样也是19日凌晨也可以说成是18日23:59:59秒//下面类推
weather2		"阴转多云"
weather3		"多云转晴"
weather4		"晴转多云"
weather5		"阴"
weather6		"多云"
img1		"0"//对应的显示图片编号
img2		"2"
img3		"2"
img4		"1"
img5		"1"
img6		"0"
img7		"0"
img8		"1"
img9		"2"
img10		"99"//这个就不对了不知道为啥
img11		"1"
img12		"99"
img_single		"2"
img_title1		"晴"//18日夜间
img_title2		"阴"//19日白天
img_title3		"阴"//19日夜间
img_title4		"多云"//20日白天
img_title5		"多云"//20日夜间 一次类推
img_title6		"晴"
img_title7		"晴"
img_title8		"多云"
img_title9		"阴"
img_title10		"阴"
img_title11		"多云"
img_title12		"多云"
img_title_single		"阴"
wind1		"微风"//一天的风力
wind2		"微风"
wind3		"微风"
wind4		"微风"
wind5		"微风"
wind6		"微风"
fx1		"微风"//这2个就不知道了有待研究
fx2		"微风"
fl1		"小于3级"//风力
fl2		"小于3级"
fl3		"小于3级"
fl4		"小于3级"
fl5		"小于3级"
fl6		"小于3级"
//这里的这些生活指数也是和上面的更新点有关系 18点左右更新的就是明天的生活指数了哈哈
index		"舒适"//舒适度指数
index_d		"建议着薄型套装或牛仔衫裤等春秋过渡装。年老体弱者宜着套装、夹克衫等。	//对应的描述	
index48		"暖"///这2个不清楚了
index48_d		"较凉爽，建议着长袖衬衫加单裤等春秋过渡装。年老体弱者宜着针织长袖衬衫、马甲和长裤。"
index_uv		"最弱"//紫外线指数
index48_uv		"弱"
index_xc		"适宜"//洗车指数
index_tr		"很适宜"//旅游指数
index_co		"舒适"//舒适度指数
st1		"20"
st2		"11"
st3		"20"
st4		"11"
st5		"20"
st6		"11"
index_cl		"较适宜"//晨练指数
index_ls		"不太适宜"//晾晒指数
index_ag		"不易发"//    息斯敏过敏气象指数 


实时天气
city		"北京"//城市
cityid		"101010100"//城市编码
temp		"17"//当前温度
WD		"东风"//风向
WS		"2级"//风力
SD		"70%"//相对湿度
WSE			"2"//风力
time		"14:20"//更新时间
isRadar	"1"//是否有雷达图 
Radar	"JC_RADAR_AZ9010_JB"//雷达图地址 http://www.weather.com.cn/html/radar/JC_RADAR_AZ9010_JB.shtml

***********************************************************/
require_once("QQWry.class.php");
require_once("Client.class.php");
error_reporting(0);
function get_real_ip(){
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
		for ($i = 0; $i < count($ips); $i++) {
			if (!eregi ("^(10|172\.(16|17|18|19|20|21|22|23|24|25|26|27|28|29|30|31)|192\.168)\.", $ips[$i])) {
				$ip = $ips[$i];
				break;
			}
		}
	}
	
	$ip = $_SERVER['REMOTE_ADDR'];
	return $ip;
}

function get_city($ip){
	$city = false;
	$QQWry=new QQWry();
	$ifErr=$QQWry->QQWry($ip);
	if(!$ifErr){
		$address = iconv('gbk','utf8',$QQWry->Country);
		$address = str_replace(array('省','市','县','工业','北京','区','大学','武汉','西安','安交','海交','新疆','大连','广西','移动','联通','电信'),array(' ',' ',' ',' 工业','北京 ',' ',' ','武汉 ','西安 ','安 交','海 交','新疆 ','大连 ','广西 ','','',''),$address);
		$address = explode(" ",$address);
		$citys = array_filter($address);
		$city = array_pop($citys);
		$postfix   = array("省", "市", "县");

		$city = str_replace($postfix,"",$city);
	}
	return $city;
}

function get_city_code(){
	$code = false;
	$ip = get_real_ip();
	if(!$ip){
		$code = "101010100";
	}else{
		$city = get_city($ip);
		if($city){
			$code_city = file("city_code.txt");
			foreach($code_city as $value)
			{
				if(strpos($value,$city)){
					$codes=split("=",$value);
					$code = $codes[0];
					break;
				}
			}
		}
	}
	return $code ;

}

function _url($Data){
	$ch = curl_init();
	$timeout = 10;
	curl_setopt ($ch, CURLOPT_URL, "$Data");
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_USERAGENT, "Baiduspider+(+http://www.baidu.com/search/spider.htm)");
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$contents = curl_exec($ch);
	curl_close($ch);
	if($contents === true)
	{
		return "查询超时";
	}
	return $contents;
}





function loadPNG($imgname)
{
    $im = @imagecreatefromgif($imgname); /* Attempt to open */
    if(!$im) { /* See if it failed */
        $im  = imagecreatetruecolor(150, 30); /* Create a blank image */
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);
        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
        /* Output an errmsg */
        imagestring($im, 1, 5, 5, "Error loading $imgname", $tc);
    }
    return $im;
}

function to_entities($string){
    $len = strlen($string);
    $buf = "";
    for($i = 0; $i < $len; $i++){
        if (ord($string[$i]) <= 127){
            $buf .= $string[$i];
        } else if (ord ($string[$i]) <192){
            //unexpected 2nd, 3rd or 4th byte
            $buf .= "&#xfffd";
        } else if (ord ($string[$i]) <224){
            //first byte of 2-byte seq
            $buf .= sprintf("&#%d;",
                ((ord($string[$i + 0]) & 31) << 6) +
                (ord($string[$i + 1]) & 63)
            );
            $i += 1;
        } else if (ord ($string[$i]) <240){
            //first byte of 3-byte seq
            $buf .= sprintf("&#%d;",
                ((ord($string[$i + 0]) & 15) << 12) +
                ((ord($string[$i + 1]) & 63) << 6) +
                (ord($string[$i + 2]) & 63)
            );
            $i += 2;
        } else {
            //first byte of 4-byte seq
            $buf .= sprintf("&#%d;",
                ((ord($string[$i + 0]) & 7) << 18) +
                ((ord($string[$i + 1]) & 63) << 12) +
                ((ord($string[$i + 2]) & 63) << 6) +
                (ord($string[$i + 3]) & 63)
            );
            $i += 3;
        }
    }
    return $buf;
}

/*******输出图片*****************/
header("Content-type: image/png;");


$code = get_city_code();
$url = "http://www.weather.com.cn/data/sk/$code.html";
$tianqi = _url($url);

if($tianqi) $tianqi = json_decode($tianqi);

//以下代码实现将获取的信息显示到浏览器中
$code = new clientGetObj;
$ip = get_real_ip();//$code->getIP();//IP地址：
$op = $code->getOS();//操作系统：
$browser = $code->getBrowse();

$ip =$ip?$ip:"未知IP";
//var_dump($tianqi);
// Create the image
//echo $text = $tianqi->weatherinfo->city."当前气温".$tianqi->weatherinfo->temp."℃";

$im = loadPNG("tq_bg.png");

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
//imagefilledrectangle($im, 0, 0, 399, 29, $white);

// The text to draw
$text = $tianqi->weatherinfo->city."当前气温".$tianqi->weatherinfo->temp."℃";

$text = to_entities($text);
//$text=iconv("gbk","utf-8",$text); 
// Replace path by your own font path
$font = './yh.ttf';
//$text = mb_convert_encoding($text, "UTF-8", "gbk");

// Add some shadow to the text
//imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

// Add the text
imagettftext($im, 11, 0, 10, 15, $black, dirname(__FILE__).'/yh.ttf', $text);

imagettftext($im, 8, 0, 120, 30, $black, "./arial.ttf", $ip);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);