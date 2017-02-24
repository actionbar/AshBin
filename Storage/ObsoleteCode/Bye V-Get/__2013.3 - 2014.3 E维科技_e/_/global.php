<?php
/* $T=$Qa['t'];$T=strtotime($T);$t=date('Ymd/His',$T);$td=date("D, d M Y H:i:s",$T); */
$ROOT=$_SERVER['DOCUMENT_ROOT'];  //设置require 网站根目录

// E维科技，网络科技很有趣

/* 用于定义local/还是远程，必须要在引用公用_global/global.php 之前调用 */
require '_GO_LOCAL.php';

/*引用绝对global ,注意这个地址是和 http://localhost/e.v-get.com/ 相对，还是 http://localhost/www.v-get.com/e/相对 */

require($ROOT.'_global/_global.php');
require $ROOT.'_global/global.php';

// 对文档读取和写入类
$FILE=new file();
// obj2str 类
$OBJ2STR=new obj2str();

define('SITENAME','E维科技');

/* 本地也设置了这个用户，和相同的密码 */
/*这里用于本地调用很多数据的时候用到 */
$QC=mysql_connect('localhost','root','qwdw114');



//论坛的目录
define('MENU_BBS','i');
define('database','ve');
//论坛和文章的帐号和密码不一样，下面是文章的
define('db_user','Atc23ODw0d');
define('db_pass','E2Y0u3lVpg0x');
define('discuz_pre','dc_');
define('tech_f','f2013');

define('Upload_database','$QC=mysql_connect(\'localhost\',\'Atc23ODw0d\',\'E2Y0u3lVpg0x\');mysql_select_db(\'ve\',$QC);mysql_query(\'set names utf8\');');

define('DB_VE_F20XX','$QC=mysql_connect(\'localhost\',\'Atc23ODw0d\',\'E2Y0u3lVpg0x\');mysql_select_db(\'ve\',$QC);mysql_query(\'set names utf8\');');
define('DB_VE_W3C','$QC=mysql_connect(\'localhost\',\'i0oRvne8l2j1Vm\',\'w3GeTxOgI0oq\');mysql_select_db(\'ve\',$QC);mysql_query(\'set names utf8\');');


//w3c i0oRvne8l2j1Vm@localhost identified by 'w3GeTxOgI0oq';
define('DB_w3c','$QC=mysql_connect(\'localhost\',\'i0oRvne8l2j1Vm\',\'w3GeTxOgI0oq\');mysql_select_db(\'ve\',$QC);mysql_query(\'set names utf8\');');
$w3cba=array(1=>array('_tag','标签'),4=>array('_sev','系统值'),6=>array('','函数'),9=>array('_open','源码'));

define('w3cba','$w3cba='.GO_ARR2STR($w3cba,2).';');




/* 英文用于调用图片  in_array() 区分大小写，所以$kITsite里面 小写=>名称*/
$ITCelebrity=array('拉里·佩奇'=>'larrypage','李彦宏'=>'lihongyan','李开复'=>'likaifu','马化腾'=>'mahuateng','马云'=>'mayun','马克·扎克伯格'=>'markzuckerberg','张朝阳'=>'zhangchaoyang','潘石屹'=>'panshiyi','比尔·盖茨'=>'billgates','丁磊'=>'dinglei','周鸿祎'=>'zhouhongyi','盖瑞·亥尔波特'=>'garyhalber','史玉柱'=>'shiyuzhu','刘强东'=>'liuqiangdong','姚劲波'=>'yaojinbo');
$ITSite=array('谷歌搜索'=>'google','360搜索'=>'360','百度搜索'=>'baidu','新浪网'=>'sina','搜狐网'=>'sohu','腾讯网'=>'qq','58同城'=>'58','淘宝网'=>'taobao','facebook'=>'facebook','京东商城'=>'jd','人人网'=>'renren','12306'=>'12306','优酷视频'=>'youku','土豆网'=>'tudou','新浪微博'=>'weibo','乐视网'=>'letv','聚美优品'=>'jumei','Hao123'=>'hao123');

/* 是否优秀： 默认0， （背景：fg0 fg1,不用逻辑运算，增加速度） 1推荐（一次阅读、时事推荐/） 2 热帖 3 爆料（可能是谣言）4纯图片 5原创 6付费采用  7精华（） 8 优秀（查询类，常用） 9置顶 */

$Garr=array(1=>'推荐阅读',/* 2=>'热帖', */3=>'时事爆料',/* 4=>'图片',5=>'原创',6=>'付费采用',7=>'精华', */8=>'优秀查询',9=>'置顶必读');

$asa=array('',array('host','主机域名'),array('web','网站建设'),array('soho','SOHO托管'),array('sem','网络营销'),array('vi','视觉设计'),array('soft','应用软件'),array('programmer','程序猿笑话'),array('union','网赚联盟'),array('notice','E维公告'));
$asb=array('',array('pc','计算机'),array('social','社交论坛'),array('shop','电子商务'),array('game','游戏娱乐'),array('mv','音乐视频'),array('smart','移动互联网'),array('home','生活信息'),array('vertical','垂直网站'),array('se','搜索引擎'));
$asc=array('',array('news','业内资讯'),array('pioneer','创业访谈'),array('ensure','网络维权'),array('trend','趋势传言'),array('master','站长经验'),array('good','优秀推荐'),array('safe','安全防护'),array('manage','运营管理'),array('program','技术资源'));
define('TECHF','$asa=array(\'\',array(\'host\',\'主机域名\'),array(\'web\',\'网站建设\'),array(\'soho\',\'SOHO托管\'),array(\'sem\',\'网络营销\'),array(\'vi\',\'视觉设计\'),array(\'soft\',\'应用软件\'),array(\'programmer\',\'程序猿笑话\'),array(\'union\',\'网赚联盟\'),array(\'notice\',\'E维公告\'));$asb=array(\'\',array(\'pc\',\'计算机\'),array(\'social\',\'社交论坛\'),array(\'shop\',\'电子商务\'),array(\'game\',\'游戏娱乐\'),array(\'mv\',\'音乐视频\'),array(\'smart\',\'移动互联网\'),array(\'home\',\'生活信息\'),array(\'vertical\',\'垂直网站\'),array(\'se\',\'搜索引擎\'));$asc=array(\'\',array(\'news\',\'业内资讯\'),array(\'pioneer\',\'创业访谈\'),array(\'ensure\',\'网络维权\'),array(\'trend\',\'趋势传言\'),array(\'master\',\'站长经验\'),array(\'good\',\'优秀推荐\'),array(\'safe\',\'安全防护\'),array(\'manage\',\'运营管理\'),array(\'program\',\'技术资源\'));');
$TECH_I_sitemap=array('host'=>array('a=1','主机域名','主机域名资讯包括域名注册,域名交易,虚拟主机,Linux系统配置,服务器配置,DNS,免费虚拟主机,VPS主机,FTP服务器,云主机电信服务器租用和托管。'),'web'=>array('a=2','网站建设','网站建设教程适用于为您提供网站美工,Web前端开发,PHP教程,MySQL教程,ASP.Net等网站设计教程,为您提供最佳的免费网站建设方案。及时更新最新网站运营资讯,全方位获取网站技术资源。'),'soho'=>array('a=3','SOHO托管',''),'sem'=>array('a=4','网络营销','优秀的网络营销案例如同企业营销的灯塔，企业网络营销方案可以借鉴前者的技巧。E维站长论坛旨沟通企业与网络营销师，提供在线网络营销课程，促进企业制定网络营销策略迎战商场。'),'vi'=>array('a=5','视觉设计',''),'soft'=>array('a=6','应用软件',''),'programmer'=>array('a=7','程序猿笑话','程序员经常熬夜加班、没有女朋友、矮挫穷的代表，常被戏称程序猿或者苦逼IT男。程序猿笑话都是程序员对拥有很高的智商，却毫无建树或者没有女朋友窘境的自嘲，程序猿是屌丝的代名词。'),'union'=>array('a=8','网赚联盟',''),'notice'=>array('a=9','E维公告',''),'pc'=>array('b=1','电脑硬件',''),'social'=>array('b=2','社交论坛',''),'shop'=>array('b=3','电子商务',''),'game'=>array('b=4','游戏娱乐',''),'mv'=>array('b=5','音乐视频',''),'smart'=>array('b=6','网络技术',''),'home'=>array('b=7','生活信息',''),'vertical'=>array('b=8','垂直网站',''),'se'=>array('b=9','搜索引擎',''),'news'=>array('c=1','业内资讯',''),'pioneer'=>array('c=2','创业访谈',''),'ensure'=>array('c=3','网络维权',''),'trend'=>array('c=4','趋势传言',''),'master'=>array('c=5','站长经验',''),'good'=>array('c=6','优秀推荐',''),'safe'=>array('c=7','安全防护',''),'manage'=>array('c=8','运营管理',''),'program'=>array('c=9','技术资源',''));
$TECH_I_TOP_sitemap=array('top1'=>array('g=1','推荐','描述'),'top3'=>array('g=3','推荐','描述'),'top8'=>array('g=8','推荐','描述'),'top9'=>array('g=9','推荐','描述'));
$i_asq='';foreach($TECH_I_sitemap as $asqa=>$asqk){$i_asq.=",'".$asqa."'=>array('".$asqk[0]."','".$asqk[1]."','".$asqk[2]."')";}
$i_asq=substr($i_asq,1);$i_asq='$asq=array('.$i_asq.');';
define('TECH_I',$i_asq);
define('TECH_I_page_article','20'); //每页标题数量
$DiscuzEditorID=array(1,2);
$DiscuzEditor='';$DiscuzEditorOut='';
foreach($DiscuzEditorID as $i=>$id){
$DiscuzEditor.=' OR authorid='.$id;$DiscuzEditorOut.=' AND authorid!='.$id;
}
define('DiscuzEditor',$DiscuzEditor);
$DiscuzEditorOut=''; //开始没有其他用户发帖，所以只能用这个
define('DiscuzEditorOut',$DiscuzEditorOut);

/* 一定要判断本地，否则PHP程序出错，经常会把远程目录出现localhost/网址*/
if(constant('GO_LOCAL')==''||constant('GO_LOCAL')=='localhost'){
define('uploadFile','/Webpages/www.v-get.com/e/');
define('uploadFile4TP','/Webpages/_Uploads/wbtp=tp.v-get.com/');
define('indexJS','');
define('LK','http://localhost/e.v-get.com/');
define('LTU','http://localhost/www.v-get.com/tu/');
define('LTU_8','http://localhost/www.v-get.com/tu/8/');
define('L_TP','http://localhost/www.v-get.com/tp/');
define('LTP','http://localhost/www.v-get.com/tp/j/');
define('LTP_8','http://localhost/www.v-get.com/tp/j/8/');
define('LI8','http://localhost/www.v-get.com/tp/i/8/');
/* e目录 */
define('TONGJI','');
define('Tongji2','');
define('ADxuanfu','');
/* 有的只显示一边，有的显示两边 */
define('ADxuanfu_issue_left_ad','');
define('ADxuanfu_issue_right_ad','');
define('ADxuanfu_issue_2_ad','');
define('A250x250a','');
define('A250x250b','');define('A250x250c','');define('A250x250d','');
define('A728x90a','');define('A728x90b','');define('A728x90c','');define('A728x90d','');

define('A960x90','');
/* 可以把abcd都设置一样，这里只是表示一个页面内最多包括了4个这个尺寸的广告 */
define('A960x60a','');
define('A960x60b','');
define('A960x60c','');
define('A960x60d','');
define('A960x90bottom','');
define('A160x600a','160x600');
define('A270x106b','270x106');

}
else {

/* 主页独特js */
define('uploadFile','/Webpages/_Uploads/wbe=e.v-get.com/');
define('uploadFile4TP','/Webpages/_Uploads/wbtp=tp.v-get.com/');
define('indexJS','');
define('LK','http://e.v-get.com/');
define('LTU','http://tu.v-get.com/');
define('LTU_8','http://tu.v-get.com/8/');
define('L_TP','http://tp.v-get.com/');
define('LTP','http://tp.v-get.com/j/');
define('LTP_8','http://tp.v-get.com/j/8/');
define('LI8','http://tp.v-get.com/i/8/');
/* 统计代码 ，如果单纯主页有统计，那么就在主页独特代码上写*/

define('TONGJI','var _bdhmProtocol=(("https:"== document.location.protocol)?" https://":" http://");document.write(unescape("%3Cscript src=\'"+_bdhmProtocol+"hm.baidu.com/h.js%3F2cdfc5c1af66f6603163203248653a5e\' type=\'text/javascript\'%3E%3C/script%3E"));');


/* 必备悬浮框 （首页\自营产品不含悬浮框）*/
//define('ADxuanfu','<script type="text/javascript">var cpro_id="u1132441";</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>');
define('ADxuanfu','');
/* issue下只有悬浮广告 有的只显示一边，有的显示两边 */
define('ADxuanfu_issue_left_ad','<script type="text/javascript">var cpro_id="u1132441";</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>');
define('ADxuanfu_issue_right_ad','');
define('ADxuanfu_issue_2_ad','<script type="text/javascript">var cpro_id="u1344600"</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>');

define('A250x250a','<script type="text/javascript">var cpro_id="u1150348";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A250x250b','<script type="text/javascript">var cpro_id="u1150348";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A250x250c','<script type="text/javascript">var cpro_id="u1150348";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A250x250d','<img src="http://tp.v-get.com/j/250x250/0.gif"/>');
define('A728x90a','<script type="text/javascript">var cpro_id="u1163355";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');

define('A728x90b','<script type="text/javascript">var cpro_id="u1163355";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A728x90c','<script type="text/javascript">var cpro_id="u1163355";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A728x90d','<img src="http://tp.v-get.com/j/728x90/0.gif"/>');
/* 可以把abcd都设置一样，这里只是表示一个页面内最多包括了4个这个尺寸的广告 */
define('A960x60e','<a href="'.constant('LK').constant('MENU_BBS').'/"><img src="http://tp.v-get.com/j/8/960x50.png" alt="E维站长论坛，网络营销SEO论坛" width="960" height="50"></a>');
define('A960x60a','<script type="text/javascript">var cpro_id="u1248199";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A960x60c','');
define('A960x60d','<script type="text/javascript">var cpro_id="u1248199";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A960x90bottom','<script type="text/javascript">var cpro_id="u1346844";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A160x600a','<script type="text/javascript">var cpro_id = "u1344167";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
define('A270x106b','<script type="text/javascript">var cpro_id="u1344235"</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');
}


Function YMD(){return date('ymd');}


define('CSSJS','<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link href="'.constant('LTU').'i.css" rel="stylesheet" type="text/css" /><link href="'.constant('LTU_8').'i.css" rel="stylesheet" type="text/css" />');





define('BOTTOM','<div class="o mh"></div></div><div class="b"><p class="bn"><a href="http://e.v-get.com/z/about.html">关于我们</a>|<a href="http://e.v-get.com/i/">站长论坛</a>|<a href="#">合作分销</a>|<a href="#">人才招聘</a>|<a href="http://e.v-get.com/z/link.html">友情链接</a>|<a href|<a href="#">合作加盟</a>|<a href="#">广告服务</a>|<a href="#">合作伙伴</a>|<a href="http://e.v-get.com/i/topic-56-1.html">投诉建议</a>|<a href="http://e.v-get.com/z/">网站地图</a>|<a href="http://m.e.v-get.com/">手机浏览</a></p><p><a href="http://e.v-get.com/">'.constant('SITENAME_E').'</a> 版权所有</p><p>Copyright &copy; 2008-2013<a href="http://www.v-get.com/">V-Get.com</a>All Rights Reserved.</p></div></div><script type="text/javascript" src="'.constant('LTU').'i.js"></script>');

Function JI0($f=''){if(strlen($f)>0){Return 'J("'.constant('LTU_8').'i.js",function(){'.$f.'});';}else {Return 'J("'.constant('LTU_8').'i.js");';}}

define ('TOP','<div class="t"><strong>V-Get! <a href="http://e.v-get.com/z/">网站地图</a><a href="http://e.v-get.com/w3c/">W3C</a><a href="http://e.v-get.com/w3cschool/">W3CSchool</a></strong><span><a href="http://e.v-get.com/js/"><img src="http://tu.v-get.com/g/ft1.gif" alt="微推荐"/></a>|<a href="http://e.v-get.com/i/">站长论坛</a>|<a href="http://e.v-get.com/services/">代理分销</a>|<a href="http://e.v-get.com/open/">网站开源</a>|<a href="http://m.e.v-get.com/">手机版</a></span></div>');

function TUN($n){
$x='</head><body>'.constant('TOP').'<div class="w"><div class="u"><div class="p i"></div><div class="q g"><div class="s"><form action="'.constant('LK').'s" target="_blank"><div class="p"><input type="radio" name="ie" checked="checked"/><label>百度</label><input type="radio" name="ie" value="utf-8"/><label>有趣</label></div><div class="q"><input type="text" placeholder="请输入关键词" class="sk" name="sk"/><input class="ss" type="submit" value=""/></div></form></div></div><div class="o"></div></div><div id="n"><div id="na">';

$y='<a href="'.constant('LK').'">首页</a><i></i><a href="'.constant('LK').'tech/">站长之家</a><i></i><a href="'.constant('LK').'web/">网站建设</a><i></i><a href="'.constant('LK').'host/">主机域名</a><i></i><a href="'.constant('LK').'sem/">网络营销</a><i></i><a href="'.constant('LK').'soho/">SOHO托管</a><i></i><a href="'.constant('LK').'vi/">网站美工</a><i></i><a href="'.constant('LK').'w3c/">编程手册</a><i></i><a href="'.constant('LK').'tool/">站长工具</a>';
if(isset($n{0})){$y=str_replace('/'.$n.'/">','/'.$n.'/" class="no">',$y);}
$x.=$y.'</div></div>';
return $x;
}

function SUB($s,$l){
//$s = '91abcd行驶里程';
// 将字符串分解为单元
$reg=array('/的/u');
$s=preg_replace($reg,'',$s);
preg_match_all("/./us", $s, $match);
$count= count($match[0]); // 返回单元个数

$pa = '/[\x{4e00}-\x{9fa5}]/siu';
  preg_match_all($pa, $s, $r);
 
  $hanzicount = count($r[0]);//获取汉字个数

$n=$count-$hanzicount;//英文个数
if($l<20&&$n>8){$n/=2.5;$n=(int)$n;}
else {$n=0;}
return mb_substr($s,0,$l+$n,'utf8');

}
?>