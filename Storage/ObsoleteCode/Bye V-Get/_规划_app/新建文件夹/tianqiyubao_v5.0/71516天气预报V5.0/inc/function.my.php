<?php
function alert($message = '', $url = '-1')
{
    $str  = '<script language="javascript">';
    if ('' != $message) {
    	$str .= 'alert('.$message.');';
    }

    if ($url != '-1') {
    	$str .= 'location.href="'.$url.'";';
    }
    else {
        $str .= 'history.go(-1);';
    }

    $str .= '</script>';
    echo $str;
    exit;
}

function getWeatherImage($type)
{
    $type = trim($type);
    $images = array('阵雨'=>'3.png', '大到暴雨'=>'23.png', '雷阵雨'=>'4.png',  '雷阵雨伴有冰雹'=>'5.png', '多云'=>'1.png', '暴雨'=>'10.png',  '雾'=>'18.png', '中雨'=>'8.png', '中到大雨'=>'22.png', '大雨'=>'9.png',  '大暴雨'=>'11.png', '阴'=>'2.png', '小雨'=>'7.png','晴'=>'0.png',
                    '扬沙'=>'30.png', '小到中雨'=>'21.png','雨夹雪'=>'6.png','小雪'=>'14.png','阵雪'=>'13.png','中雪'=>'15.png','小到中雪'=>'26.png','冻雨'=>'19.png','中到大雪'=>'27.png','大雪'=>'16.png','大到暴雪'=>'28.png','特大暴雨'=>'12.png', '暴雪'=>'17.png','沙尘暴'=>'20.png','暴雨到大暴雨'=>'24.png','大暴雨到特大暴雨'=>'25.png','浮尘'=>'29.png','强沙尘暴'=>'31.png');
    $chartype = CHARSET == 'gbk'?iconv('utf-8','gbk',$type):$type;
    if(array_key_exists($chartype,$images))
    	return '<img align=\'absmiddle\' src=\'images/tianqibig/'.$images[$chartype].'\' style=\'border:0;\'/>';
    else
    	return $type;
}

function getTodayLivingImage($type)
{
    $type = trim($type);
    //$images = array('晨练'=>'3/01.gif', '穿衣'=>'3/02.gif', '交通'=>'3/03.gif', '空气污染扩散条件'=>'3/04.gif', '路况'=>'3/05.gif', '洗车'=>'3/06.gif', '雨伞'=>'3/07.gif', '紫外线'=>'3/08.gif', '舒适度'=>'3/09.gif','感冒'=>'3/10.gif', '晾晒'=>'3/11.gif', '旅游'=>'3/12.gif', '化妆'=>'3/13.gif', '钓鱼'=>'3/14.gif', '约会'=>'3/15.gif', '划船'=>'3/16.gif', '逛街'=>'3/17.gif', '美发'=>'3/18.gif', '夜生活'=>'3/19.gif', '运动'=>'3/20.gif');
    $images = array('晨练'=>'3/01.gif', '穿衣'=>'3/02.gif', '交通'=>'3/03.gif', '空气污染扩散条件'=>'3/04.gif', '路况'=>'3/05.gif', '洗车'=>'3/06.gif', '雨伞'=>'3/07.gif', '紫外线'=>'3/08.gif');
    return $images[$type];
}


function array_utf8_to_gbk(&$array)
{
	if(!is_array($array)){
		$array = iconv('utf-8', 'gbk//IGNORE', $array);
		return $array;
	}
    foreach ($array as &$arr)
    {
        if (is_array($arr)) {
        	$arr = array_utf8_to_gbk($arr);
        }
        else {
            $arr = iconv('utf-8', 'gbk//IGNORE', $arr);
        }
    }
    return $array;
}

function array_gbk_to_utf8(&$array)
{
    if(CHARSET == 'utf8')return $array;
    if(is_array($array))
    foreach ($array as &$arr)
    {
        if (is_array($arr)) {
        	$arr = array_gbk_to_utf8($arr);
        }
        else {
            $arr = iconv('gbk', 'utf-8', $arr);
        }
    }
    return $array;
}

function array_map_trim(&$array)
{
    foreach ($array as &$arr) {
        if (is_array($arr)) {
        	$arr = array_map_trim($arr);
        }
        else {
            $arr = trim($arr);
        }
    }
    return $array;
}
//fsockopen
function get_contents_by_socket($url)
{
	$params = parse_url($url);
	$host = isset($params['host']) ? $params['host'] : '';
	$path = isset($params['path']) ? $params['path'] : '';
	$query = isset($params['query']) ? $params['query'] : '';
	$fp = @fsockopen($host, 80, $errno, $errstr, 15);
	if (!$fp){
		return false;
	}else{
		$get_info = false;
		$result = '';
		$out = "GET /" . $path . '?' . $query . " HTTP/1.0\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Connection: Close\r\n\r\n";
		@fwrite($fp, $out);
		$http_200 = preg_match('/HTTP.*200/', @fgets($fp, 1024));
		if (!$http_200){
			return false;
		}
		while (!@feof($fp)){
			if ($get_info){
				$result .= @fread($fp, 1024);
			}else{
				if (@fgets($fp, 1024) == "\r\n"){
					$get_info = true;
				}
			}
		}
		@fclose($fp);
		return $result;
	}
}
//远程获取
function getContent($url)
{
	if(function_exists('file_get_contents')){
		if(!get_cfg_var('allow_url_fopen')){
			return false;
		}
		$context = stream_context_create(array('http' => array('timeout' =>15)));
		$data = @file_get_contents($url, false, $context);
	}elseif(function_exists('curl_init')){
		if(!isset($ch)){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url );
			curl_setopt($ch, CURLOPT_TIMEOUT,15);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0' );
		}
		$data = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($http_code != '200'){
			return false;
		}
	}elseif(function_exists('fsockopen')){
		$data = get_contents_by_socket($url);
	}else{
		return false;
	}
	return $data;
}