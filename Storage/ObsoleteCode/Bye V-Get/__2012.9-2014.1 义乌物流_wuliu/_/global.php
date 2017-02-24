<?php
/* $T=$Qa['t'];$T=strtotime($T);$t=date('Ymd/His',$T);$td=date("D, d M Y H:i:s",$T); */
$ROOT=$_SERVER['DOCUMENT_ROOT'];  //设置require 网站根目录



/* 用于定义local/还是远程，必须要在引用公用_global/global.php 之前调用 */
require '_GO_LOCAL.php';

/*引用绝对global ,注意这个地址是和 http://localhost/e.v-get.com/ 相对，还是 http://localhost/www.v-get.com/e/相对 */
require($ROOT.'_global/_global.php');
require $ROOT.'_global/global.php';

// 对文档读取和写入类
$FILE=new file();
// obj2str 类
$OBJ2STR=new obj2str();

define('database','vwuliu');
/*这里用于本地调用很多数据的时候用到 */
$QC=mysql_connect('localhost','root','qwdw114');
mysql_select_db(constant('database'),$QC);
mysql_query('set names utf8');

define('MENU_BBS','i');

//论坛和文章的帐号和密码不一样，下面是文章的
define('discuz_pre','dz_');
define('tech_f','f2013');

//discuz 的数据库
define('DB_Discuz','$QC=mysql_connect(\'localhost\',\'V3DIdwLdqo32\',\'Sf9n2Dom3Ko\');mysql_select_db(\''.constant('database').'\',$QC);mysql_query(\'set names utf8\');');

define('DB_News','$QC=mysql_connect(\'localhost\',\'CF30q9pDo0e\',\'ox9dEe5dw3o\');mysql_select_db(\''.constant('database').'\',$QC);mysql_query(\'set names utf8\');');
/* 物流 */
define('DB_C','$QC=mysql_connect(\'localhost\',\'Co3Mq2pDo0m\',\'O0xdE8Mdw3o\');mysql_select_db(\''.constant('database').'\',$QC);mysql_query(\'set names utf8\');');

/* 物流公司三级域名 */
define('DB_CO','$QC=mysql_connect(\'localhost\',\'GSco9cm30x1\',\'Bt49cE3ox02K\');mysql_select_db(\''.constant('database').'\',$QC);mysql_query(\'set names utf8\');');



define('T_AA','$aA=array(\'\',array(\'tuoyun\',\'托运\'),array(\'cangku\',\'仓库\'),array(\'banjia\',\'搬家\'),array(\'huoche\',\'货车\'),array(\'keyun\',\'客运\'),array(\'\',\'\'),array(\'join\',\'联运\'),array(\'shebei\',\'设备\'),array(\'huodai\',\'货代\'));');




define('BOTTOM','<div class="o mh"></div>'.constant('AD960x90pic').'<div class="b"><p class="bn"><a href="http://e.v-get.com/z/about.html">关于我们</a>|<a href="#">联系我们</a>|<a href="#">合作分销</a>|<a href="#">人才招聘</a>|<a href="http://e.v-get.com/z/link.html">友情链接</a>|<a href|<a href="#">合作加盟</a>|<a href="#">广告服务</a>|<a href="#">合作伙伴</a>|<a href="#">投诉建议</a>|<a href="http://e.v-get.com/z/">网站地图</a>|<a href="#">法律声明</a></p><p><a href="http://e.v-get.com/">E维科技</a> 版权所有</p><p>Copyright &copy; 2008-2013<a href="http://www.v-get.com/">V-Get.com</a>All Rights Reserved.</p></div>');



/*左悬浮*/
define('AD_xuanfu_both','<script type="text/javascript">var cpro_id="u1344600"</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>');
define('AD_xuanfu_left','<script type="text/javascript">var cpro_id="u1132441";</script><script src="http://cpro.baidustatic.com/cpro/ui/f.js" type="text/javascript"></script>');

/*物流网免费会员广告=三级域名  +  co301无头像广告*/

define('AD_200x200','<script type="text/javascript">var cpro_id="u1189528";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>');



if(constant('GO_LOCAL')==''||constant('GO_LOCAL')=='localhost'){
define('localhost','localhost/');



define('LTU','http://localhost/www.v-get.com/tu/');
define('LTU_3','http://localhost/www.v-get.com/tu/3/');
define('LTP','http://localhost/www.v-get.com/tp/j/');
define('LTP_3','http://localhost/www.v-get.com/tp/j/3/');
define('LK','http://localhost/wuliu.v-get.com/');
define('uploadFile','/Webpages/www.v-get.com/wuliu/');
define('TONGJI','');   /* 这里是wuliu页的统计 */
$TONGJI_CT=array('yiwu'=>'','sh'=>'');
}
else{
define('localhost','');

define('LTU','http://tu.v-get.com/');
define('LTU_3','http://tu.v-get.com/3/');
define('LTP','http://tp.v-get.com/j/');
define('LTP_3','http://tp.v-get.com/j/3/');
define('LK','http://wuliu.v-get.com/');
define('uploadFile','/Webpages/_Uploads/wb3=wuliu.v-get.com/');
define('TONGJI','$4.write(unescape("%3Cscript src=\'http://hm.baidu.com/h.js%3Fb84eba598197e236c39e3a6447f9eff6\' type=\'text/javascript\'%3E%3C/script%3E"));');/* 这里是wuliu页的统计 */
$TONGJI_CT=array('yiwu'=>'$4.write(unescape("%3Cscript src=\'http://hm.baidu.com/h.js%3Fe0a8998d85ee8ddd24d2c38e4f5c9032\' type=\'text/javascript\'%3E%3C/script%3E"));','sh'=>'$4.write(unescape("%3Cscript src=\'http://hm.baidu.com/h.js%3Fbe4278dfff73bf556fc464c5129ebed0\' type=\'text/javascript\'%3E%3C/script%3E"));');
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