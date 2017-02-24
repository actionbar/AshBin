<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
require('weibo_global.php');
// session 只准用 [a-zA-Z0-9-]做参数，_不允许，可以用-，但是session 关闭浏览器就消失，所以用cookie，而不用session




function bookMarks(){
//随机书名号，更有利于让人觉得不是机器发的。
$WBtitleMarks=array(array('【','】'),array('《','》'),array('★','★'),array('Ｖ','Ｖ'),array('■','■'),array('☆','☆'),array('◇','◇'),array('◆','◆'),array('㊣','㊣'),array('▼','▼'),array('','→→'),array('⊙','⊙'),array('¤','¤'),array('┗','┛'),array('╰','╮'),array('↘','↙'),array('▂','▂'),array('◤','◥ '),array('●','●'),array('○','○'),array('〖','〗'),array('◣','◥'),array('◤','◢'),array('◣','◢'));

return $WBtitleMarks[array_rand($WBtitleMarks)];
}


function WeiBo_E_f(){
$bookMark=bookMarks();$ml=$bookMark[0];$mr=$bookMark[1];
$QC=mysql_connect('localhost','root','root');mysql_select_db('ve',$QC);
$Qs='SELECT i,t,h,d,f FROM f2013 ORDER BY rand() LIMIT 1;';$Qq=mysql_query($Qs);$Qa=mysql_fetch_array($Qq);

$F=$Qa['f'];$r='';
// 图片地址
preg_match_all('/http\:\/\/tp\.v\-get\.com\/i\/8\/\d+\/\w+\.[pnggifj]+/',$F,$imgs);
$imgs=$imgs[0];$imgx=count($imgs);
if($imgx>0){$imgx--;$randimg=rand(0,$imgx);$r='&img='.urlencode($imgs[$randimg]);}


$T=$Qa['t'];$T=strtotime($T);$T=date('Ymd/His',$T);
$L='http://www.luexu.com/tech/'.$T.$Qa['i'].'.html';

$D=$ml.$Qa['h'].$mr.' '.$Qa['d'].' '.$L;
$D=decode_ascii($D,ENT_QUOTES);
$D=urlencode($D);
$r.='&f='.$D;

return $r;
}


function WeiBo_E_f_sem(){
$bookMark=bookMarks();$ml=$bookMark[0];$mr=$bookMark[1];
$QC=mysql_connect('localhost','root','root');mysql_select_db('ve',$QC);
$Qs='SELECT i,t,h,d,f FROM f2013 WHERE (a=8 OR a=7 OR a=4 OR a=3 OR b=3 OR b=4 OR b=5 OR b=6 OR b=8 OR c=1 OR c=2 OR c=3 OR c=4 OR c=5 OR c=8) ORDER BY rand() LIMIT 1;';$Qq=mysql_query($Qs);$Qa=mysql_fetch_array($Qq);

$F=$Qa['f'];$r='';
// 图片地址
preg_match_all('/http\:\/\/tp\.v\-get\.com\/i\/8\/\d+\/\w+\.[pnggifj]+/',$F,$imgs);
$imgs=$imgs[0];$imgx=count($imgs);
if($imgx>0){$imgx--;$randimg=rand(0,$imgx);$r='&img='.urlencode($imgs[$randimg]);}


$T=$Qa['t'];$T=strtotime($T);$T=date('Ymd/His',$T);
$L='http://e.v-get.com/tech/'.$T.$Qa['i'].'.html';

$D=$ml.$Qa['h'].$mr.' '.$Qa['d'].' '.$L;
$D=decode_ascii($D,ENT_QUOTES);
$D=urlencode($D);
$r.='&f='.$D;

return $r;
}


function WeiBo_E_i_sem(){
$bookMark=bookMarks();$ml=$bookMark[0];$mr=$bookMark[1];
$QC=mysql_connect('localhost','root','root');mysql_select_db('ve_i',$QC);
/* ttachment	帖子附件(2=图片附件) */
$Qsi='SELECT tid,subject,message,author FROM dc_forum_post WHERE (fid=2 OR fid=61 OR fid=76 OR fid=63 OR fid=62 OR fid=47 OR fid=107 OR (fid=92 OR fid=50 OR fid=115 OR fid=98 OR fid=108 OR fid=96 OR fid=97) OR fid=103) AND first=1 AND invisible=0 AND attachment=2 ORDER BY rand()  LIMIT 1;';
$Qqi=mysql_query($Qsi);
$Qai=mysql_fetch_array($Qqi);

$I=$Qai['tid'];
$H=$Qai['subject'];
$F=$Qai['message'];
$M=$Qai['author'];
preg_match_all('/\[attach\]\d+/',$F,$imgs);
$imgs=$imgs[0];
//第一章图片
$imgx=$imgs[0];
$imgid=str_replace('[attach]','',$imgx);


$Qsimg='SELECT tableid FROM dc_forum_attachment WHERE aid='.$imgid.' LIMIT 1;';
$Qqimg=mysql_query($Qsimg);
$Qaimg=mysql_fetch_array($Qqimg);
$tableid=$Qaimg['tableid'];




$Qsimg='SELECT attachment FROM dc_forum_attachment_'.$tableid.' WHERE aid='.$imgid.' LIMIT 1;';
$Qqimg=mysql_query($Qsimg);
$Qaimg=mysql_fetch_array($Qqimg);
$img=$Qaimg['attachment'];

// 图片地址
$img='http://tp.v-get.com/i/8discuz/forum/'.$Qaimg['attachment'];

$L='http://e.v-get.com/i/tip-'.$I.'-1.html';
$D='#E.V-Get.com# '.$ml.$H.$mr.' by 博主 '.$M.'（http://e.v-get.com/i/'.urlencode($M).'） 阅读原文：'.$L;
$D=decode_ascii($D,ENT_QUOTES);
$D=urlencode($D);

$r='&img='.urlencode($img).'&f='.$D;;

return $r;
}













function WeiBo_E_w3c(){
$bookMark=bookMarks();$ml=$bookMark[0];$mr=$bookMark[1];
$QC=mysql_connect('localhost','root','root');mysql_select_db('ve',$QC);
$Qs='SELECT l,h,d FROM w3c ORDER BY rand() LIMIT 1;';
$Qq=mysql_query($Qs);
$Qa=mysql_fetch_array($Qq);
$L='http://e.v-get.com/w3c/'.$Qa['l'].'.html';
$D=$ml.$Qa['h'].$mr.' '.$Qa['d'].' '.$L;
$D=decode_ascii($D,ENT_QUOTES);
$D=urlencode($D);
return '&f='.$D;
}

function WeiBo_E_i(){
$bookMark=bookMarks();$ml=$bookMark[0];$mr=$bookMark[1];
$QC=mysql_connect('localhost','root','root');mysql_select_db('ve',$QC);
// 随机从9个图片里面随机一个，
$rand=rand(0,9);
$Qsimg='SELECT tid,attachment FROM dc_forum_attachment_'.$rand.' WHERE isimage=1 AND remote=1 ORDER BY rand()  LIMIT 1;';
$Qqimg=mysql_query($Qsimg);
$Qaimg=mysql_fetch_array($Qqimg);
$tid=$Qaimg['tid'];

// 图片地址
$img='http://tp.v-get.com/i/8discuz/forum/'.$Qaimg['attachment'];

$Qs='SELECT tid,subject,author FROM dc_forum_thread WHERE closed=0 AND tid='.$tid.' LIMIT 1;';
$Qq=mysql_query($Qs);
$Qa=mysql_fetch_array($Qq);
$L='http://e.v-get.com/i/tip-'.$Qa['tid'].'-1.html';
$D='#E.V-Get.com# '.$ml.$Qa['subject'].$mr.' by 博主 '.$Qa['author'].'（http://e.v-get.com/i/'.urlencode($Qa['author']).'） 阅读原文：'.$L;
$D=decode_ascii($D,ENT_QUOTES);
$D=urlencode($D);

$r='&img='.urlencode($img).'&f='.$D;

return $r;
}

function WeiBo_E_i_programmer(){
$bookMark=bookMarks();$ml=$bookMark[0];$mr=$bookMark[1];
$QC=mysql_connect('localhost','root','root');mysql_select_db('ve_i',$QC);
/* ttachment	帖子附件(2=图片附件) */
$Qsi='SELECT tid,subject,message,author FROM dc_forum_post WHERE fid=82 AND first=1 AND invisible=0 AND attachment=2 ORDER BY rand()  LIMIT 1;';
$Qqi=mysql_query($Qsi);
$Qai=mysql_fetch_array($Qqi);

$I=$Qai['tid'];
$H=$Qai['subject'];
$F=$Qai['message'];
$M=$Qai['author'];
preg_match_all('/\[attach\]\d+/',$F,$imgs);
$imgs=$imgs[0];
//第一章图片
$imgx=$imgs[0];
$imgid=str_replace('[attach]','',$imgx);


$Qsimg='SELECT tableid FROM dc_forum_attachment WHERE aid='.$imgid.' LIMIT 1;';
$Qqimg=mysql_query($Qsimg);
$Qaimg=mysql_fetch_array($Qqimg);
$tableid=$Qaimg['tableid'];




$Qsimg='SELECT attachment FROM dc_forum_attachment_'.$tableid.' WHERE aid='.$imgid.' LIMIT 1;';
$Qqimg=mysql_query($Qsimg);
$Qaimg=mysql_fetch_array($Qqimg);
$img=$Qaimg['attachment'];

// 图片地址
$img='http://tp.v-get.com/i/8discuz/forum/'.$Qaimg['attachment'];

$L='http://e.v-get.com/i/tip-'.$I.'-1.html';
$D='#E.V-Get.com# '.$ml.$H.$mr.' by 博主 '.$M.'（http://e.v-get.com/i/'.urlencode($M).'） 阅读原文：'.$L;
$D=decode_ascii($D,ENT_QUOTES);
$D=urlencode($D);

$r='&img='.urlencode($img).'&f='.$D;;

return $r;
}
function WeiBo_E(){
// 采用random()
$r=rand(0,9);
if($r<1){return WeiBo_E_w3c();}
else {return WeiBo_E_f();}
}

function WeiBo_E_SEM(){
// 采用random()
$r=rand(0,3);
return WeiBo_E_f_sem();
}








// 3个小时一个cookies 
$hour3='h3';
// 年月日时，S=app key 可以绑定多个用户，而access_token每个微博用户只能一个
if(!isset($_COOKIE[$hour3])){


//##### access_token 7-30天需要重新调用一次，所以需要重新定制，所有开发都放到E.V-Get.com一个里面，不同帐号通过获取不同的token执行



// access_token 有周期，只能7-30天，所以要不停获取新的，token_【我的网站e/wuliu】_【qq/sina/】【微博id，不是网站应用id】
// @微博账号
WeiBo('sina',$url_token_e_sina0000.WeiBo_E());

// @程序猿笑话
//WeiBo('sina',$url_token_e_sina0000.WeiBo_E_SEM());


// 微博昵称
WeiBo('sina',$url_token_e_sina0000.WeiBo_E_i_programmer());


// access_token openid， QQ微博暂时无法调用tp.v-get.com里面的图片，只可以调用tu.v-get.com /e.v-get.com 图片 SEO_
//QQ号
WeiBo('qq',$url_token_e_qq0000.WeiBo_E());




// QQ号
//WeiBo('qq',$url_token_e_qq0000.WeiBo_E_SEM());

// QQ号
//WeiBo('qq',$url_token_e_qq0000.WeiBo_E_i_programmer());

// 3个小时，在时钟位置+3
$His=date('His');
$His+=30000;
setcookie($hour3,$His,time()+10800);
}
?>
<script type="text/javascript" src="http://www.luexu.com/tu/i.js"></script>
<script language="javascript">

// 秒转时间
function formatSeconds(value) {
var theTime = Number(value);
        var theTime1 = 0;
        var theTime2 = 0;
        //alert(theTime);
        if(theTime > 60) {
        	theTime1 = Number(theTime/60);
        	theTime = Number(theTime%60);
        	//alert(theTime1+"-"+theTime);
        	if(theTime1 > 60) {
        		theTime2 = Number(theTime1/60);
        		theTime1 = Number(theTime%60);
        	}
        }
        var result = ""+theTime+"秒";
        if(theTime1 > 0) {
        	result = ""+parseInt(theTime1)+"分"+result;
        }
        if(theTime2 > 0) {
        	result = ""+parseInt(theTime2)+"时"+result;
        }
        return result;
}


function z(x){return (x>9)?x:('0'+x)}

var dt=new Date(),dh=dt.getHours(),dm=dt.getMinutes(),ds=dt.getSeconds(),to=K("<?php echo $hour3;?>"),toh=$i($s(to,0,((L(to)==6)?2:1))),tom=$i($s(to,2,2)),tos=$i($s(to,4));
// dh = [0,23]
toh=(toh<24)?toh:(toh-24);
toh=(toh<dh)?(toh+24):toh;
var retime=(tos-ds)+60*(tom-dm)+3600*(toh-dh);
// to 时间仅是 时分秒，并非时间秒，必须要换算一下
$4.write('<strong style="color:#C00">'+toh+':'+tom+':'+tos+'</strong>：自动执行时间（日时分秒）<br><strong style="color:#C00">'+dh+':'+dm+':'+ds+'</strong>：当前时间（日时分秒）<br>'+retime+'='+formatSeconds(retime)+' （剩余更新时间）');
if(retime>0){$o(function(){$5.reload()},retime*1000);}
</script>
<div style="clear:both"></div>
<div>
<div style="float:left;width:38%;height:600px;border-right:2px dashed #CCC">
<iframe src="weibo_insert.php" marginheight="0" marginheight="0" marginwidth="0" scrolling="no" style="width:100%;height:100%" frameborder="0"></iframe>
</div>
<div style="float:left;width:38%;height:600px;border-right:2px dashed #CCC">
<iframe src="weibo_fabu.php" marginheight="0" marginwidth="0" scrolling="no" style="width:98%;height:100%" frameborder="0"></iframe>
</div>
<div style="float:right;width:20%;height:600px">
<iframe marginheight="0" marginwidth="0" scrolling="no" style="width:250px;height:600px" frameborder="0"  src="http://widget.weibo.com/list/list.php?language=zh_cn&width=250&height=500&listid=3627146142773166&appkey=3657814714&uname=E%E7%BB%B4%E7%A7%91%E6%8A%80&uid=3551642801&listname=E%E7%BB%B4%E7%A7%91%E6%8A%80&color=d2d2d2,ffffff,333333,0088FF,ffffff,f3f3f3&showcreate=1&isborder=1&info=0&sidebar=1&footbar=1&skin=0&dpc=1"></iframe>
</div>
</div>
</body></html>