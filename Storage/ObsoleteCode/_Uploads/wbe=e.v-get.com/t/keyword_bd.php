<?php
//$v=$_POST['v'];
//不带http://
$L='yiwu.wuliu.v-get.com';
$K='托运部';


function s($K,$L,$page=1){
static $px=0;
$rsState=false;
$enKeyword=urlencode($K);
$firstRow=($page-1) * 10;
if($page>10){die('10页之内没有该网站排名..end');}
$contents=file_get_contents('http://www.baidu.com/s?wd='.$enKeyword.'&&pn='.$firstRow);
preg_match_all('/<table[^>]*?class="result"[^>]*>[\s\S]*?<\/table>/i',$contents,$rs);

foreach($rs[0] as $k=>$v){$px++;
if(strstr($v,$L)){$rsState=true;preg_match_all('/<h3[\s\S]*?(<a[\s\S]*?<\/a>)/',$v,$rs_t);echo '当前 "' . $L . '" 在百度关键字 "' . $K . '" 中的排名为：' . $px;echo '<br>';echo '第' . $page . '页;第' . ++$k . "个<a target='_blank' href='http://www.baidu.com/s?wd=$enKeyword&&pn=$firstRow'>进入百度</a>"; 
echo '<br>';echo $rs_t[1][0];break;}}
unset($contents);
if($rsState===false){s($K, $L,++$page);}
}
s($K,$L);

die();




?>
