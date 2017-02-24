<?php
require('../_/global.php');
$LOCAL_B=330782;$LOCAL_E='yiwu';$LOCAL_G='义乌';$LOCAL_H='义乌市';
$LOCAL='localhost/';

$Qsc='SELECT e,g,h FROM ct WHERE b="'.$LOCAL_B.'" AND i MOD 10>0 ORDER BY i';
$Qqc=mysql_query($Qsc,$QC);
while($Qac=mysql_fetch_array($Qqc)){
$cE=$Qac['e'];$cE=(int)$cE;$cG=$Qac['g'];
if('1'==$cG){$LOCAL_aC[$cE]=array('',$Qac['h']);}
else{array_push($LOCAL_aC[$cE],$Qac['h']);}
}

//$LOCAL_aC[0]=array('','稠城街道','稠江街道','顺序未知');
echo '<hr>';
$local_ac='';foreach($LOCAL_aC as $localac=>$localaca){$local_ac.=",'".$localac."'=>array(";
$localactem='';
foreach($localaca as $localack){$localactem.=",'".$localack."'";}
$localactem=substr($localactem,1);
$local_ac.=$localactem.")";}
$local_ac=substr($local_ac,1);$local_ac='$aC=array('.$local_ac.');';
//echo $local_ac;



/* 本地执行，虽然每个托运/货代的都不同 但是可能性固定，所以每个存为数组，再输出*/

$aclast=array('<a href="http://yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html">托运价格</a>','<a href="http://yiwu.wuliu.v-get.com/keyun/">客车托运</a>','<a href="http://wuliu.v-get.com/news/2013-01-01/193.html">限货区域</a>','<a href="http://yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html">托运价格</a>','<a href="http://yiwu.wuliu.v-get.com/keyun/">客车托运</a>','<a href="http://wuliu.v-get.com/news/2013-01-01/193.html">限货区域</a>','<a href="http://yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html">托运价格</a>','<a href="http://yiwu.wuliu.v-get.com/keyun/">客车托运</a>','<a href="http://wuliu.v-get.com/news/2013-01-01/193.html">限货区域</a>','<a href="http://yiwu.wuliu.v-get.com/price/yiwu-tuoyun.html">托运价格</a>','<a href="http://yiwu.wuliu.v-get.com/keyun/">客车托运</a>','<a href="http://wuliu.v-get.com/news/2013-01-01/193.html">限货区域</a>');


$Local_sa=array(1=>'tuoyun',2=>'cangku',3=>'banjia',4=>'huoche',5=>'keyun',6=>'train',7=>'join',8=>'shebei',9=>'huodai',10=>'news');

$Qsct='SELECT i,e,g,h FROM ct WHERE b='.$LOCAL_B.' AND (i MOD 100>0 OR i>99999999) ORDER BY i';
$Qqct=mysql_query($Qsct,$QC);
$cti=0;
$cte='';//用于区分上一个ctE
while($Qact=mysql_fetch_array($Qqct)){
$ctE=$Qact['e'];$ctE=(int)$ctE;
$ctG=$Qact['g'];
if('0'==$ctG){
$LOCAL_c3t[$ctE]=$Qact['h'].'</li><li>';
if($cti>0){$clast=13-$cti;
for($clasti=0;$clasti<$clast;$clasti++){$LOCAL_c3t[$cte].=$aclast[$clasti];}
$cti=0;
}
$cte=$ctE;
}
/* 这里 s?sk=参数  用js调取 $k('sk') */
else{$LOCAL_c3t[$ctE].='<a href="http://yiwu.wuliu.v-get.com/'.$Local_sa[$ctE].'/s?sc='.$ctG.'">'.$Qact['h'].'</a>';}
$cti++;
}

/* 这里是最后一个 $ctE */
$clast=13-$cti;
for($clasti=0;$clasti<$clast;$clasti++){$LOCAL_c3t[$ctE].=$aclast[$clasti];}

$local_c3t='';foreach($LOCAL_c3t as $localc3t=>$asqk){$local_c3t.=",".$localc3t."=>'".$asqk."'";}
$local_c3t=substr($local_c3t,1);$local_c3t='$c3t=array('.$local_c3t.');';
echo $local_c3t;
/* 本地执行 */
?>

<?php
/* 这里是用于首页 */
$jsk='';$A=-1;

/* 没有sa就是首页 */
$bSA=isset($_GET['sa'])?true:false;
if($bSA){
$jsk='';  //用于前端替换查询的js数组
$SK='';
$Qw='b='.$LOCAL_B;
$SA=$_GET['sa'];
$SC=empty($_GET['sc'])?0:(int)$_GET['sc'];
$sp=empty($_GET['sp'])?1:$_GET['sp'];$Qp=($sp-1)*10;
$lsk='';//lsk链接尾部的 ?sk= ，带问号
if($SC>0){$Qw.=' AND c='.$SC;$lsk.='&sc='.$SC;}  
$bSAnews=($SA=='news')?true:false;



/* sa=news就是新闻，否则就是其他 */
if($bSAnews){
$QC=mysql_connect('localhost','CF30q9pDo0e','ox9dEe5dw3o');mysql_select_db('vwuliu',$QC);mysql_query('set names utf8');
$a='物流新闻';
$A=10;
$Qs='SELECT * FROM cf2013 WHERE '.$Qw.' ORDER BY t DESC LIMIT '.$Qp.',7';
if(!empty($_GET['sk'])){
$SK=$_GET['sk'];
$encode=mb_detect_encoding($SK,array('EUC-CN','UTF-8'));
if($encode!='UTF-8'){$SK=iconv($encode,'UTF-8',$SK);}
$SK=preg_replace('/[[:punct:]]/','',$SK);
$Qw.=' AND f LIKE "%'.$SK.'%"';
$Qs="(SELECT * FROM cf2013 WHERE h LIKE '%$SK%') UNION (SELECT * FROM cf2013 WHERE $Qw) LIMIT $Qp,10";
$jsk=$SK;$lsk='&sk='.$SK.$lsk;
}
$Qsz='SELECT count(*) FROM cf2013 WHERE '.$Qw;
}



else{
$QC=mysql_connect('localhost','Co3Mq2pDo0m','O0xdE8Mdw3o');mysql_select_db('vwuliu',$QC);mysql_query('set names utf8');
$aa=array('tuoyun'=>'托运部','cangku'=>'仓库厂房出租','banjia'=>'搬家搬厂公司','huoche'=>'货车出租','keyun'=>'客运长途汽车专线','train'=>'联运货场','join'=>'联运货场','shebei'=>'物流设备','huodai'=>'货代公司');
$aA=array('tuoyun'=>1,'cangku'=>2,'banjia'=>3,'huoche'=>4,'keyun'=>5,'train'=>6,'join'=>7,'shebei'=>8,'huodai'=>9);
$a=$aa[$SA];$A=$aA[$SA];
$Qw.=' AND a='.$A;
$Qs='SELECT * FROM c WHERE '.$Qw.' LIMIT '.$Qp.',10';

if(!empty($_GET['sk'])){
$SK=$_GET['sk'];
$encode=mb_detect_encoding($SK,array('EUC-CN','UTF-8'));
if($encode!='UTF-8'){$SK=iconv($encode,'UTF-8',$SK);}

//preg_replace不支持中文，所以要尾部加/u ,才能支持utf-8
/*
　　if (strlen($foo) < 5) { echo “Foo is too short”$$ }
　　(与下面的技巧做比较)
　　if (!isset($foo{5})) { echo “Foo is too short”$$ }
　　调用isset()恰巧比strlen()快，因为与后者不同的是，isset()作为一种语言结构，意味着它的执行不需要函数查找和字母小写化。也就是说，实际上在检验字符串长度的顶层代码中你没有花太多开销。
*/
//echo $1,$2;  比 echo $1.$2;快

//echo strlen($SK),'<br>';
//如果字符长度>6=7-45<46，也就是2个汉字，才进行拆词，2个汉字可能谁最长搜索的，因为链接多是两个汉字
//isset(string{n}) 比 strlen (string)>n 要快
if(isset($SK{7})&&!isset($SK{46})){
//$SK=mb_substr($SK,0,15,'utf-8');  //截取15个字符以内
//http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%3Ciframe%20src=%22http://baidu.com%22%3E%3C/iframe%3E
//这样搜索会出现问题，所以要对搜索进行替换
//为了防止js替换出现问题，需要对js也进行修改
//[[:punct:]]去除符号

$SK=preg_replace('/[[:punct:]]/','',$SK);
/* 这里用于第一个替换查询 */
$jsk=$SK;
$SK=str_replace('0579','',$SK);
//类似百度，采用正则替换多个空格；；前端后端一起修改
//$qk=str_replace('襄樊','襄阳',$SK);
//把他们替换成空格，两个词分割开来，这样就比较准确了
//采用分开制度， yiwu.wuliu.v-get.comtuoyun.php
$qk=preg_replace('/义乌市?[到|发|至]?/u',' ',$SK);
//strstr比 str_replace快，str_replace比preg_replace快4倍，所以能不用正则就不用，用str_replace数组一样的
//strstr('iifflodanfdn','ff'); 返回fflodanfdn，第一次找到ff的时候到尾部，这种替换最适合用于查找替换
$qk=str_replace('物流',' ',$qk);$qk=str_replace('公司',' ',$qk);
$prv=array('/(河北省?)/u','/(山西省?)/u','/(辽宁省?)/u','/(吉林省?)/u','/(黑龙江省?)/u','/(江苏省?)/u','/(浙江省?)/u','/(安徽省?)/u','/(福建省?)/u','/(江西省?)/u','/(山东省?)/u','/(河南省?)/u','/(湖北省?)/u','/(湖南省?)/u','/(广东省?)/u','/(海南省?)/u','/(四川省?)/u','/(贵州省?)/u','/(云南省?)/u','/(陕西省?)/u','/(甘肃省?)/u','/(青海省?)/u');
$qk=preg_replace($prv,' $1 ',$qk);
$qk=str_replace('的',' ',$qk);$qk=str_replace('在',' ',$qk);$qk=str_replace('几区',' ',$qk);

$qk=str_replace('直达',' ',$qk);$qk=str_replace('专线',' ',$qk);
//$qk=preg_replace('/市([^场]*)$/u',' $1',$qk);
$qk=preg_replace('/[托运|货运][部|站|处]?/u',' ',$qk);

//暂时搜索量比较小，网站布局尚未稳定，以后稳定了，就用 yiwu.wuliu.v-get.comtuoyun.php代替
$qk=str_replace('货代','货运代理',$qk);
//采用替换法，已经替换掉了多个空格
$qk=preg_replace('/^\s+|(?<=(\s))\1+|\s+$/','',$qk);
$aqk=explode(' ',$qk);
$Qlkc='';$Qlke='';
//在执行for循环之前确定最大循环数，不要每循环一次都计算最大值，最好运用foreach代替。PS：像count、strlen这样的操作其实是O(1)的，因此不会带来太多消耗，当然避免每次循环都计算是比较好的策略。最好用foreach代替for，这个效率更高，如果考虑到foreach($array as $var)每次拷贝的消耗，可以使用foreach($array as &$var)这样的引用。
foreach ($aqk as &$QK){$jsk.=','.$QK;$Qlke.='(d LIKE "%'.$QK.'%" OR h LIKE "%'.$QK.'%") AND ';$Qlkc.='OR h LIKE "%'.$QK.'%" OR d LIKE "%'.$QK.'%" ';}
$Qlke.=$Qw;$Qlkc=substr($Qlkc,3);
//echo '<br>$Qlke=',$Qlke.'<br>';
//把全国改掉，另立一个字段，这样对于其他也好
$Qw.=' AND ('.$Qlkc.')';
$Qlk='('.$Qlkc.')';
//union 是代替or最好的办法，筛选掉重复记录；union all 不筛选，出现重复就显示两次
//不采用order by,那么就按照union顺序排序
//不要用and union，因为很多没有过滤的词，会查不到
$Qs="(SELECT * FROM c WHERE $Qlke) UNION (SELECT * FROM c WHERE $Qw) LIMIT $Qp,10";
/* 是面向用户的，所以很多地区必须要用全国  有k按照关键词次数排序 select 语句 as 新字段名   ==这样可以利用已有字段通过方式创建一个临时字段*/
}
else {$jsk=$SK;$Qs="SELECT * FROM c WHERE (h LIKE '%".$SK."%' OR d LIKE '%".$SK."%') AND $Qw LIMIT $Qp,10";$Qw.=" AND (h LIKE '%".$SK."%' OR d LIKE '%".$SK."%')";}
$lsk='&sk='.$SK.$lsk;
//echo $Qw,'<br>';


}

$Qsz='SELECT COUNT(*) FROM c WHERE '.$Qw;
}

/* 从本地获取 */
$aC=$LOCAL_aC;
/* 从本地获取 */
$c=$aC[$A][$SC];
unset($aC);
if(isset($lsk{2})){$lsk='s?'.substr($lsk,1);}

echo '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>义乌',$c,$SK,$a,'查询_商务物流网_V-Get!</title><meta name="keywords" content="',$c,' ',$SK,' 义乌',$a,' 义乌',$a,'查询 义乌物流,yiwu,tuoyun,yiwu tuoyun" /><meta name="description" content="商务物流网义乌物流部致力于提供义乌',$c,$SK,$a,'查询,';

}
else{echo '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>义乌商务物流网_V-Get!</title><meta name="keywords" content="义乌物流,义乌托运部,yiwu,tuoyun,yiwu tuoyun" /><meta name="description" content="商务物流网义乌物流部致力于提供';}
?>
义乌托运部查询,义乌仓库出租,义乌搬厂搬家公司,义乌货车出租,义乌长途客运,义乌国际物流公司,船公司,报关行等货运物流信息查询服务。" /><link href="http://localhost/tu.v-get.com/i.css" type="text/css" rel="stylesheet" /><link href="http://localhost/tu.v-get.com/3/i.css" type="text/css" rel="stylesheet"/><link href="http://localhost/tu.v-get.com/3/ct/i.css" type="text/css" rel="stylesheet" /><script type="text/javascript" src="http://localhost/tu.v-get.com/i.js"></script></head>
<body>
<div id="t" c="yiwu"><div class="w tc"><a href="http://wuliu.v-get.com/">商务物流网</a> <i>-</i> <a href="http://yiwu.wuliu.v-get.com/">义乌市</a> <i>-</i> <a href="http://wuliu.v-get.com/i/">论坛</a></div></div>
<div class="o w">
<div class="u"><div class="p i"></div><div class="q g"><div class="s"><form action="http://e.v-get.com/s" target="_blank"><div class="p"><input type="radio" name="ie" checked="checked"/><label>整站</label><input type="radio" name="ie" value="utf-8"/><label>有趣</label></div><div class="q"><input type="text" placeholder="请输入关键词" class="sk" name="sk"/><input class="ss" type="submit" value=""/></div></form></div></div><div class="o"></div></div>

<div id="n"><div id="na"><a href="http://localhost/yiwu.wuliu.v-get.com/">首页</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/news/">资讯</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/tuoyun/">托运</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/cangku/">仓库</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/banjia/">搬家</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/huoche/">货车</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/keyun/">客运</a><i></i><a href="#">保留</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/join/">联运</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/shebei/">设备</a><i></i><a href="http://localhost/yiwu.wuliu.v-get.com/huodai/">货代</a></div><div class="o po"><div class="n"></div><div class="n n7"><div class="nl"><h3><a href="#">技术专题</a></h3><ul><li><a href="http://e.v-get.com/tech/programmer_1.html">程序猿故事</a></li><li><a href="http://e.v-get.com/tech/host_1.html">主机域名资讯</a></li><li><a href="http://e.v-get.com/tech/web_1.html">网站建设运营</a></li><li><a href="http://e.v-get.com/tech/soho_1.html">SOHO资讯</a></li><li><a href="http://e.v-get.com/tech/sem_1.html">网络营销技术</a></li><li><a href="http://e.v-get.com/tech/vi_1.html">视觉PS设计</a></li><li><a href="http://e.v-get.com/tech/soft_1.html">软件编程资讯</a></li><li><a href="http://e.v-get.com/tech/union_1.html">联盟网赚交流</a></li><li><a href="http://e.v-get.com/open/">开源下载</a></li></ul></div><div class="nl"><h3><a href="#">网站分类</a></h3><ul><li><a href="http://e.v-get.com/tech/pc_1.html">计算机</a></li><li><a href="http://e.v-get.com/tech/social_1.html">社交论坛</a></li><li><a href="http://e.v-get.com/tech/shop_1.html">电商网站</a></li><li><a href="http://e.v-get.com/tech/game_1.html">网游娱乐</a></li><li><a href="http://e.v-get.com/tech/mv_1.html">音乐影视</a></li><li><a href="http://e.v-get.com/tech/smart_1.html">移动互联网</a></li><li><a href="http://e.v-get.com/tech/home_1.html">综合门户</a></li><li><a href="http://e.v-get.com/tech/vertical_1.html">垂直网站</a></li><li><a href="http://e.v-get.com/tech/u/SEO_1.html">搜索引擎</a></li></ul></div><div class="nr"><h3><a href="#">站长之家</a></h3><ul><li><a href="http://e.v-get.com/tech/news_1.html">业界资讯</a></li><li><a href="http://e.v-get.com/tech/pioneer_1.html">创业人物访谈</a></li><li><a href="http://e.v-get.com/tech/ensure_1.html">网络维权315</a></li><li><a href="http://e.v-get.com/tech/trend_1.html">互联网趋势</a></li><li><a href="http://e.v-get.com/tech/master_1.html">站长经验交流</a></li><li><a href="http://e.v-get.com/tech/good_1.html">网站软件推荐</a></li><li><a href="http://e.v-get.com/tech/safe_1.html">病毒安全防护</a></li><li><a href="http://e.v-get.com/tech/manage_1.html">网络运营管理</a></li><li><a href="http://e.v-get.com/tech/program_1.html">网络技术资源</a></li></ul></div><div class="o"></div></div><div class="n n2"><div class="nl"><h3><a href="#">企业展示站</a></h3><ul><li><a href="http://e.v-get.com/web/service_b1.html">B1 企业超值网站</a></li><li><a href="http://e.v-get.com/web/service_b2.html">B2 企业标准网站</a></li><li><a href="http://e.v-get.com/web/service_b3.html">B3 企业专业网站</a></li><li><a href="http://e.v-get.com/web/service_b5.html">B5 企业高级定制</a></li></ul><h3><a href="#">商城建站</a></h3><ul><li><a href="#">S1 第三方结算商城</a></li><li><a href="#">S2 标准商城建设</a></li><li><a href="#">S3 外贸商城建设</a></li></ul><h3><a href="#">优惠建站产品</a></h3><ul><li><a href="http://e.v-get.com/web/service_a1.html">A1 免费建站</a></li><li><a href="http://e.v-get.com/web/service_a2.html">A2 速成美站</a></li><li><a href="http://e.v-get.com/web/service_a3.html">A3 公司建站</a></li></ul></div><div class="nr"><dl><dt><img src="http://tp.v-get.com/j/8//inw1.jpg" alt="企业网站建设" width="80" height="76"/></dt><dd><h4><a href="#">展示型网站建设？</a></h4><p>用于展示企业形象和文化相关的企业建站服务</p><p class="fq"><a href="#">查询详情&gt;&gt;</a></p></dd></dl><div class="o mh"></div><dl><dt><img src="http://tp.v-get.com/j/8//inw2.jpg" alt="商城网站建设" width="80" height="76"/></dt><dd><h4><a href="#">商城网站设计？</a></h4><p>网上购物平台产品营销与销售的建站产品</p><p class="fq"><a href="#">查询详情&gt;&gt;</a></p></dd></dl><div class="o mh"></div><dl><dt><img src="http://tp.v-get.com/j/8//inw3.jpg" alt="免费建站" width="80" height="76"/></dt><dd><h4><a href="#">免费建站？</a></h4><p>一般免费建站是指靠放置广告盈利的网站建设</p><p class="fq"><a href="#">查询详情&gt;&gt;</a></p></dd></dl></div><div class="o"></div></div><div class="n n1"><div class="nl"><h3><a href="#">域名服务</a></h3><ul><li><a href="http://e.v-get.com/host/domain.html">域名注册查询</a></li><li><a href="http://e.v-get.com/host/icp_beian.html">工信部域名备案</a></li><li><a href="http://e.v-get.com/host/domain.html">域名隐私保护</a></li><li><a href="http://e.v-get.com/host/domain.html">二手域名转让</a></li></ul><h3><a href="#">主机服务</a></h3><ul><li><a href="http://e.v-get.com/host/cloud.html">标准云主机</a></li><li><a href="http://e.v-get.com/host/vps.html">VPS主机</a></li><li><a href="http://e.v-get.com/host/virtual.html">FTP虚拟主机</a></li><li><a href="http://e.v-get.com/host/server.html">服务器托管</a></li><li><a href="http://e.v-get.com/host/free.html">免费主机</a></li></ul></div><div class="nr"><h3><a href="#">域名空间选购</a></h3><ul><li><a href="http://e.v-get.com/host/domain.html">怎么注册到好的域名？</a></li><li><a href="http://e.v-get.com/host/icp_beian.html">网站备案是怎么一回事？</a></li><li><a href="http://e.v-get.com/host/domain.html">二级域名是什么？</a></li><li><a href="http://e.v-get.com/host/domain.html">什么样的主机才适合我？</a></li><li><a href="http://e.v-get.com/host/domain.html">香港虚拟主机不用备案吗？</a></li><li><a href="http://e.v-get.com/host/domain.html">FTP服务器租用和托管的区别？</a></li></ul><dl><dt><img src="http://tp.v-get.com/j/8//inh1.jpg" alt="域名是什么" width="80" height="76"/></dt><dd><h4><a href="#">域名是什么？</a></h4><p>域名空间两者不可分离，域名是网络地址。</p><p class="fq"><a href="#">查询详情&gt;&gt;</a></p></dd></dl></div><div class="o"></div></div><div class="n n4"><div class="nl"><h3><a href="#">广告合作商</a></h3><ul><li><a href="http://e.v-get.com/sem/">百度推广代理</a></li><li><a href="http://e.v-get.com/sem/">谷歌Adword</a></li><li><a href="http://e.v-get.com/sem/">网站联盟广告</a></li></ul><h3><a href="#">搜索引擎优化</a></h3><ul><li><a href="http://e.v-get.com/sem/">SEO标准套餐</a></li><li><a href="http://e.v-get.com/sem/">SEO高级套餐</a></li><li><a href="http://e.v-get.com/sem/">外链平台</a></li><li><a href="http://e.v-get.com/sem/">软文软推</a></li></ul></div><div class="nr"><h3><a href="#">搜索引擎优化</a></h3><ul><li><a href="http://e.v-get.com/host/domain.html">搜索引擎优化方法有哪些？</a></li><li><a href="http://e.v-get.com/host/domain.html">怎么影响搜索引擎优化排名？</a></li><li><a href="http://e.v-get.com/host/domain.html">什么是网络营销？</a></li><li><a href="http://e.v-get.com/host/domain.html">网络营销策划对企业的帮助</a></li></ul><dl><dt><img src="http://tp.v-get.com/j/8//ins1.jpg" alt="网络营销方案" width="80" height="76"/></dt><dd><h4><a href="#">网络营销方案</a></h4><p>网络营销的特点是：成本低、效率高、效果好</p><p class="fq"><a href="#">查询详情&gt;&gt;</a></p></dd></dl></div><div class="o"></div></div><div class="n n3"><div class="nl"><h3><a href="http://e.v-get.com/soho/kefu.html">客服外包</a></h3><ul><li><a href="http://e.v-get.com/soho/kefu_sales.html">无底薪客服外包</a></li><li><a href="http://e.v-get.com/soho/kefu_online.html">淘宝客服外包</a></li><li><a href="http://e.v-get.com/soho/kefu_call.html">电话呼入客服外包</a></li><li><a href="http://e.v-get.com/soho/kefu_callcenter.html">呼叫中心 Call Center</a></li><li><a href="http://e.v-get.com/soho/kefu_partime.html">兼职客服外包</a></li><li><a href="http://e.v-get.com/soho/kefu_telesales.html">电话销售客服外包</a></li></ul></div><div class="nr"><dl><dt><img src="http://tp.v-get.com/j/8//ino1.jpg" alt="E维云办公" width="80" height="76"/></dt><dd><h4><a href="#">E维云办公？</a></h4><p>家居办公增强了创业者SOHO一族公司形象</p><p class="fq"><a href="#">查询详情&gt;&gt;</a></p></dd></dl></div><div class="o"></div></div><div class="n n5"><div class="nl"><h3><a href="#">摄影工作室</a></h3><ul><li><a href="http://e.v-get.com/sem/">婚庆摄影套餐</a></li><li><a href="http://e.v-get.com/sem/">艺术照摄影</a></li><li><a href="http://e.v-get.com/sem/">证件照摄影</a></li></ul><h3><a href="#">图片专业设计</a></h3><ul><li><a href="http://e.v-get.com/vi/">企业视觉设计</a></li><li><a href="http://e.v-get.com/sem/">网店图片PS套餐</a></li><li><a href="http://e.v-get.com/sem/">单张图片PS</a></li><li><a href="http://e.v-get.com/sem/">照片修复</a></li></ul></div><div class="nr"><h3><a href="#">域名空间选购</a></h3><ul><li><a href="http://e.v-get.com/host/domain.html">二级域名是什么？</a></li><li><a href="http://e.v-get.com/host/domain.html">什么样的主机才适合我？</a></li><li><a href="http://e.v-get.com/host/domain.html">香港虚拟主机不用备案吗？</a></li><li><a href="http://e.v-get.com/host/domain.html">FTP服务器租用和托管的区别？</a></li></ul><dl><dt><img src="http://tp.v-get.com/j/8//inv1.jpg" alt="企业视觉设计" width="80" height="76"/></dt><dd><h4><a href="#">企业视觉设计</a></h4><p>VI设计有利于员工归属感和对外企业形象宣传</p><p class="fq"><a href="#">查询详情&gt;&gt;</a></p></dd></dl></div><div class="o"></div></div><div class="n n6"></div><div class="n"></div><div class="n"></div><div class="n n8"><div class="nl"><h3><a href="#">网站优化工具</a></h3><ul><li><a href="http://e.v-get.com/tool/domain_name.html">域名注册查询</a></li><li><a href="http://e.v-get.com/tool/http_status.html">HTTP状态码查询</a></li><li><a href="http://e.v-get.com/tool/alexa_rank.html">网站Alexa排名</a></li><li><a href="http://e.v-get.com/tool/keyword_bd.html">百度关键词排名</a></li><li><a href="http://e.v-get.com/tool/domain_whois.html">域名Whois查询</a></li><li><a href="http://e.v-get.com/tool/google_pr.html">PR值查询</a></li><li><a href="http://e.v-get.com/tool/icp_beian.html">ICP备案查询</a></li><li><a href="http://e.v-get.com/tool/ascii_code.html">ASCII编码转换</a></li></ul></div><div class="nr"><dl><dt><a href="http://e.v-get.com/tool/alexa_rank.html"><img src="http://tp.v-get.com/j/8//int1.jpg" alt="Alexa排名查询" width="80" height="76"/></a></dt><dd><h4><a href="http://e.v-get.com/tool/alexa_rank.html">网站Alexa排名</a></h4><p>是目前用来评价某一网站访问量的一个指标</p><p class="fq"><a href="#">查询详情&gt;&gt;</a></p></dd></dl><div class="o mh"></div><dl><dt><a href="http://e.v-get.com/tool/keyword_bd.html"><img src="http://tp.v-get.com/j/8//int2.jpg" alt="百度关键词排名" width="80" height="76"/></a></dt><dd><h4><a href="http://e.v-get.com/tool/keyword_bd.html">百度关键词排名</a></h4><p>查看网站在中国最大的搜索引擎的关键词排名</p><p class="fq"><a href="http://e.v-get.com/tool/keyword_bd.html">查询详情&gt;&gt;</a></p></dd></dl></div><div class="o"></div></div></div></div>
<div class="o mh"></div>
<div class="wv"><div class="p wvl"><img src="http://www.v-get.com/www.v-getimg.com/i0/v145x43.gif" alt="物流认证"></div>
<div class="q wvr f fh"><p><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=北京市" target="_blank" _blank="_blank">北京</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广东省" target="_blank" _blank="_blank">广东</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=浙江省" target="_blank" _blank="_blank">浙江</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=江苏省" target="_blank" _blank="_blank">江苏</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=山东省" target="_blank" _blank="_blank">山东</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=河南省" target="_blank" _blank="_blank">河南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=四川省" target="_blank" _blank="_blank">四川</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=福建省" target="_blank" _blank="_blank">福建</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=安徽省" target="_blank" _blank="_blank">安徽</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=河北省" target="_blank" _blank="_blank">河北</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=辽宁省" target="_blank" _blank="_blank">辽宁</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=吉林省" target="_blank" _blank="_blank">吉林</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=黑龙江省" target="_blank" _blank="_blank">黑龙江</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=江西省" target="_blank" _blank="_blank">江西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=贵州省" target="_blank" _blank="_blank">贵州</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=新疆" target="_blank" _blank="_blank">新疆</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=西藏" target="_blank" _blank="_blank">西藏</a></p><p><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=上海市" target="_blank" _blank="_blank">上海</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=天津市" target="_blank" _blank="_blank">天津</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=重庆市" target="_blank" _blank="_blank">重庆</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=山西省" target="_blank" _blank="_blank">山西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=陕西省" target="_blank" _blank="_blank">陕西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=湖北省" target="_blank" _blank="_blank">湖北</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=云南省" target="_blank" _blank="_blank">云南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广西省" target="_blank" _blank="_blank">广西</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=湖南省" target="_blank" _blank="_blank">湖南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=海南省" target="_blank" _blank="_blank">海南</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=青海省" target="_blank" _blank="_blank">青海</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=甘肃省" target="_blank" _blank="_blank">甘肃</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=内蒙古" target="_blank" _blank="_blank">内蒙古</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=宁夏" target="_blank" _blank="_blank">宁夏</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=香港" target="_blank" _blank="_blank">香港</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=台湾省" target="_blank" _blank="_blank">台湾</a>|<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=澳门" target="_blank" _blank="_blank">澳门</a></p></div></div><div class="o mh"></div><div class="v">


<?php
if($bSA){
//有sa就显示静态首页，这样每个城市只有一个文件，而且压力也小
?>

<div class="p l"><div class="f d mb"><div id="d"><ul id="dc"><li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&amp;sk="><img width="228" height="205" src="http://www.v-get.com/www.v-getimg.com/i8/238x215/wuliu_yiwu_0.jpg" alt="下面1"></a></li><li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&amp;sk="><img width="228" height="205" src="http://www.v-get.com/www.v-getimg.com/i8/238x215/wuliu_yiwu_1.jpg" alt="下面2"></a></li><li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&amp;sk="><img src="http://www.v-get.com/www.v-getimg.com/i8/238x215/wuliu_yiwu_2.jpg" alt="下面3"></a></li><li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&amp;sk="><img width="228" height="205" src="http://www.v-get.com/www.v-getimg.com/i8/238x215/wuliu_yiwu_3.jpg" alt="下面4"></a></li><li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&amp;sk="><img width="228" height="205" src="http://www.v-get.com/www.v-getimg.com/i8/238x215/wuliu_yiwu_4.jpg" alt="下面5"></a></li></ul></div><div id="dk"></div><div class="db"></div><div class="df"><div class="p ph dfl"><ul><li><a href="http://wuliu.v-get.com/">义乌商务物流网</a></li><li><a href="http://wuliu.baike.v-get.com/">商务物流百科大全</a></li></ul></div><div id="do" class="q a"><a href="#" class="do">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a></div><div class="o"></div></div></div>


<div class="f mb l2">
<ul><li><a href="http://wuliu.v-get.com/news/2013-01-01/3.html">义乌市制定全国首个国际货代地方标准</a> </li>
<li>[<a href="http://yiwu.wuliu.v-get.com/tool/yiwu-tuoyun-price.html" class="f1">托运价格</a>]&nbsp;<a href="http://yiwu.wuliu.v-get.com/tool/yiwu-tuoyun-price.html#gd">义乌到广州托运多少钱？</a></li>
</ul>
</div>

<div class="f mb l3">
<h4>物流直达</h4>
<ul>
<li><a href="#">国际区号</a>┆<a href="#">各国港口</a>┆<a href="#">托运价格</a></li><li><a href="#">火车运价</a>┆<a href="#">铁路货场</a>┆<a href="#">保价费率</a></li><li><a href="#">车牌查询</a>┆<a href="http://wuliu.v-get.com/143">惠芳物流</a>┆<a href="http://wuliu.v-get.com/151">松盛运输</a></li><li><a href="http://wuliu.v-get.com/318">发发家政</a>┆<a href="http://wuliu.v-get.com/489">义乌搬家</a>┆<a href="http://wuliu.v-get.com/428">物流中心</a></li><li><a href="http://wuliu.v-get.com/495">金茂大厦</a>┆<a href="http://wuliu.v-get.com/507">海关大楼</a>┆<a href="http://kaibang.wuliu.v-get.com/">凯邦进仓</a></li><li><a href="http://wuliu.v-get.com/444">殴递快递</a>┆<a href="http://wuliu.v-get.com/438">汇川快递</a>┆<a href="http://wuliu.v-get.com/439">龙邦快递</a></li><li><a href="http://wuliu.v-get.com/466">恒风货代</a>┆<a href="http://wuliu.v-get.com/477">海平物流</a>┆<a href="http://wuliu.v-get.com/280">德翔国际</a></li><li><a href="http://wuliu.v-get.com/481">东方海运</a>┆<a href="http://wuliu.v-get.com/497">海德国际</a>┆<a href="http://wuliu.v-get.com/704">永达货运</a></li>
</ul>
</div>

<div class="f mb l4">
<h4>网点城市</h4>
<ul class="l3c">
<li>华东地区--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=江苏">江</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=浙江">浙</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=安徽">皖</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=福建">闽</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=江西">赣</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=山东">鲁</a></li>
<li><a href="http://sh.wuliu.v-get.com/">上海</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=杭州">杭州</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=金华">金华</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=温州">温州</a>┆<a href="http://kaibang.wuliu.v-get.com/">宁波</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=济南">济南</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=青岛">青岛</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=菏泽">菏泽</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=保定">保定</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=南昌">南昌</a></li>
<li>北方地区--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=河北">冀</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=山西">晋</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=内蒙古">蒙</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=辽宁">辽</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=吉林">吉</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=黑龙江">黑</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=北京">北京</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=天津">天津</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=太原">太原</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=呼和浩特">呼市</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=石家庄">石家庄</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=沈阳">沈阳</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=长春">长春</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=包头">包头</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=大同">大同</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=二连">二连</a></li>
<li>华南地区--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广东">粤</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=湖北">鄂</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=湖南">湘</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=河南">豫</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广西">桂</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=海南">琼</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广州">广州</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=深圳">深圳</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=韶关">韶关</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=武汉">武汉</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=襄阳">襄阳</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=长沙">长沙</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=南昌">南昌</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=南宁">南宁</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=海口">海口</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=柳州">柳州</a></li>
<li>西部--<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=四川">川</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=贵州">贵</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=云南">滇</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=西藏">藏</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=陕西">陕</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=甘肃">甘</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=宁夏">宁</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=青海">青</a><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=新疆">疆</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=重庆">重庆</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=西安">西安</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=成都">成都</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=昆明">昆明</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=拉萨">拉萨</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=兰州">兰州</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=天水">天水</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=银川">银川</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=西宁">西宁</a>┆<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=乌鲁木齐">乌市</a></li>
</ul>
</div>


<div class="f mb l5">
<h4>新闻报道</h4>
<div class="v_t">
<dl><dt><a href="http://baike.v-get.com/view/214.html"><img i="http://www.v-get.com/www.v-getimg.com/i8/70x70/482.gif" alt="物流企业如何开发客户？"/></a></dt>
  <dd><h3><a href="http://baike.v-get.com/view/214.html">物流企业如何开发客户？</a></h3><p>物流业竞争日趋激烈，怎么才能“锁定目标、全力出击”,扩大物流市场份额<a href="http://baike.v-get.com/view/214.html">[详细]</a></p></dd>
</dl>
</div>
<ul>
  <li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=0&sk=外贸进仓"><span class="f1">外贸进仓</span></a>：<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=外贸进仓">义乌到宁波外贸进仓便宜到家</a> </li>
  <li><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=%E4%BF%9D%E9%99%A9"><span class="f3">物流保险</span></a>：<a href="http://baike.v-get.com/view/19.html">国际货代投责任险获全额赔偿</a></li>
  <li><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=货运代理">货运代理</a>：<a href="http://baike.v-get.com/view/192.html">CIF合同货物运输风险承担案</a></li>
  <li><a href="http://yiwu.wuliu.v-get.com/keyun/"><span class="f6">长途客运</span></a>：<a href="http://baike.v-get.com/view/13.html">江东客运站：儿童可“邮寄”</a></li>
  <li><a href="http://kaibang.wuliu.v-get.com/"><span class="f2">凯邦物流</span></a>：<a href="http://www.ywwuliu.com/">凯邦外贸进仓货运代理公司</a></li>
  </ul>
 </div>
<div class="f l6">
<h4>搜索排行榜</h4>
<ul class="l3c">
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B9%BF%E8%A5%BF%E7%9C%81+%E7%8E%89%E6%9E%97%E5%B8%82+%E6%A1%82%E6%9E%97%E5%B8%82">义乌→广西、玉林、桂林龚大姐物流</a></li>
<li><a href="http://kaibang.wuliu.v-get.com/">义乌→上海、宁波外贸进仓</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E7%A6%8F%E5%B7%9E%E5%B8%82+%E6%BC%B3%E5%B7%9E%E5%B8%82+%E8%8E%86%E7%94%B0%E5%B8%82">义乌→福州、漳州、莆田、龙岩托运</a></li>

<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%8D%97%E9%98%B3%E5%B8%82+%E4%BF%A1%E9%98%B3%E5%B8%82">义乌→南阳、信阳</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%8D%97%E6%98%8C%E5%B8%82">义乌→南昌专线</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B1%B1%E4%B8%9C%E7%9C%81+%E8%8F%8F%E6%B3%BD%E5%B8%82+%E8%81%8A%E5%9F%8E%E5%B8%82">义乌→菏泽、聊城</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E9%81%B5%E4%B9%89%E5%B8%82">义乌→江西遵义</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%AE%89%E5%BE%BD%E7%9C%81+%E9%98%9C%E9%98%B3%E5%B8%82">义乌→阜阳、界首</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B1%B1%E4%B8%9C%E7%9C%81+%E9%82%AF%E9%83%B8%E5%B8%82">义乌→邯郸物流</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E8%8A%9C%E6%B9%96%E5%B8%82+%E9%93%9C%E9%99%B5%E5%B8%82+%E9%A9%AC%E9%9E%8D%E5%B1%B1%E5%B8%82">义乌→芜湖、铜陵、马鞍山、池州市</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E4%BA%91%E5%8D%97%E7%9C%81+%E7%91%9E%E4%B8%BD%E5%B8%82+%E5%A4%A7%E7%90%86%E5%B8%82">义乌→瑞丽、大理</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E6%88%90%E9%83%BD%E5%B8%82">义乌→成都特快</a></li>
<li><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E9%93%B6%E5%B7%9D%E5%B8%82+%E5%8C%85%E5%A4%B4%E5%B8%82">义乌→包头、银川</a>，<a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%B9%BF%E5%B7%9E%E5%B8%82">义乌→广州物流</a></li>
</ul>
</div>

</div>

<div class="p c">
<div class="cs">

<form action="http://localhost/yiwu.wuliu.v-get.com/<?php echo $SA.'/s" id="cs"><div class="p" id="csc"><input value="'.$SK;?>" type="text" class="sk"  placeholder="请直接输入所到城市，多区域用空格隔开" name="sk" maxlength="15"/><input type="button" class="cscr" id="cscr"/><div><h5><span>物流搜索</span><a href="#" class="pr">关闭</a></h5><table><tr><th colspan="5">搜索排行</th></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=国际快递">国际快递</a></td><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=俄罗斯">俄罗斯专线</a></td><td colspan="3"><a href="http://yiwu.wuliu.v-get.com/keyun/">义乌 “宾王客运中心” 长途客车行李托运</a></td></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=合肥">安徽合肥</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=无锡">江苏无锡</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=福州">福建福州</a></td></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=广州">广东广州</a></td><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sk=%E5%A4%96%E8%B4%B8%E8%BF%9B%E4%BB%93">外贸进仓</a></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=邮政小包 国际快递">邮政小包</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/cangku/s?sc=1">国际物流中心临时仓库</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/huodai/s?sk=DHL ARAMEX TNT UPS">DHL ARAMEX TNT UPS</a></td></tr><tr><td><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=五爱">五爱停车场</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=2&sk=江东货运市场">江东货运市场物流托运</a></td><td colspan="2"><a href="http://yiwu.wuliu.v-get.com/tuoyun/s?sc=1&sk=江北下朱">江北下朱货运市场托运部</a></td></tr></table></div></div>
<div class="p sc"></div>
<div class="q"><input type="submit" value="" class="ss" /></div>
</form>
</div>
<div class="c3 a f">
<ul><li class="c3t">
<?php
$c3t=$LOCAL_c3t;
echo $c3t[$A];
unset($LOCAL_ACT);

?>
</li>
</ul>
</div>
<?php

/*--------------------------------------------------------------*/
	 $Qq=mysql_query($Qs);
$Qz=mysql_fetch_array(mysql_query($Qsz));
	 $Qt=$Qz[0];$Qpz=ceil($Qt/10);
	 
echo '<div class="f cc"><div class="cct">|&nbsp;&nbsp;义乌',$a,'<span>约',$Qt,'个</span></div><div id="c">';
	 
if($bSAnews){

while($Qa=mysql_fetch_array($Qq)){
$T=$Qa['t'];$tm=strtotime($T);$t=date('Ymd/His',$tm);
echo '<div class="cf"><h2><a href="http://wuliu.v-get.com/news/',$t,'192.html" target="_blank" _blank="_blank">',$Qa['h'],'</a></h2><p>',$Qa['d'],'</p><div class="a cfk"><a href="javascript:void(0)">义乌物流</a><div class="o"></div></div><p class="cfb">',$T,'　<span>来源：',$Qa['n'],'</span></p></div>';
}

}



else{
     while($Qa=mysql_fetch_array($Qq)){
	 $I=$Qa['i'];$M=$Qa['m']; $bM=!empty($M);$E=$Qa['e'];$bE=!empty($E);
	 $h=$Qa['h'];$v=$Qa['v'];$TX=$Qa['p'];
     
	 echo '<div class="cv"><h2><a href="http://localhost/wuliu.v-get.com/',$bM?$M:$I,'" class="h2c">',$h,'</a>';
		 if($bE){echo '<a href="http://localhost/',$E,'.wuliu.v-get.com/">[官网]</a>';}
		 echo '<a v="',$v,'"></a><a o="',$Qa['o'],'"></a><a href="#" class="h2r pr" b="',$I,'"></a></h2><div class="o p cl"><a href="http://localhost/wuliu.v-get.com/',$bM?$M:$I,'"><img width="50" height="50" src="http://localhost/tp.v-get.com/j/3/yiwu/50/',$TX,'.gif" alt="',$h,'"></a></div><div class="p cr"><p>',$Qa['d'],'</p></div><div class="o cb"><div class="p">wuliu.v-get.com/',$bM?$M:$I,'&nbsp; ',$Qa['t'],'</div><div q="';
	  if($bE){echo 'W',$E,'.wuliu.v-get.com^';}
	 echo 'Dlocalhost/wuliu.v-get.com/',$bM?$M:$I,'#ditu" class="q"></div></div>
	 <div class="o cz"><p class="f1">正在为您查找',$h,'的详细信息，请稍等...</p></div><div class="o"></div></div>';
	 }
}
echo '</div>';
/*--------------------------------------------------------------*/
mysql_close();
if($Qpz>1){
$Qpp=$sp-1;$Qpn=$sp+1;
$Qpq=($Qpp==1)?'':'-'.$Qpp;
switch ($sp)
{ case 1:echo '<div id="p"><a class="po">首页</a><a class="po">前一页&lt;</a>第<span class="pc">1</span>页<a href="http://localhost/yiwu.wuliu.v-get.com/',$SA,'-2/',$lsk,'" target="_self">&gt;下一页</a><a href="http://localhost/yiwu.wuliu.v-get.com/',$SA,'-',$Qpz,'/',$lsk,'" target="_self">共',$Qpz,'页</a></div>';break;
 case $Qpz:echo '<div id="p"><a href="http://localhost/yiwu.wuliu.v-get.com/',$SA,'/',$lsk,'" target="_self">首页</a><a href="http://localhost/yiwu.wuliu.v-get.com/',$SA,$Qpq,'/',$lsk,'" target="_self">前一页&lt;</a>第<span class="pc">',$sp,'</span>页<a class="po">&gt;下一页</a><a class="po">第',$sp,'页</a></div>';break;
  default:echo '<div id="p"><a href="http://localhost/yiwu.wuliu.v-get.com/',$SA,'/',$lsk,'" target="_self">首页</a><a href="http://localhost/yiwu.wuliu.v-get.com/',$SA,$Qpq,'/',$lsk,'" target="_self">前一页&lt;</a>第<span class="pc">'.$sp.'</span>页<a href="http://localhost/yiwu.wuliu.v-get.com/',$SA,'-',$Qpn,'/',$lsk,'" target="_self">&gt;下一页</a><a href="http://localhost/yiwu.wuliu.v-get.com/',$SA,'-',$Qpz,'/',$lsk,'" target="_self">第',$Qpz,'页</a></div>';break;
}
}
echo '</div>';
?>

</div>

<div class="q f r fh">


<div class="rw rt mg">
<h4>|<a href="#">物流服务</a></h4><ul class="fo"><li><a href="#">我是企业：我要发布物流信息</a></li><li><a href="#">我是个人：我要申请个人认证</a></ul>
  

<div class="ar1 f">
<div id="ar1" class="fh"><ul><li><a href="http://wuliu.v-get.com/price/jinhua12306.html">义乌西站铁路货运场查询表</a></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车托运到临沂多少钱</a></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费多少</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li><li><a href="http://wuliu.v-get.com/price/jinhua12306.html">义乌西站铁路货运场查询表</a></li><li><a href="http://wen.v-get.com/view/1.html">义乌火车托运到临沂多少钱</a></li><li><a href="http://wen.v-get.com/view/2.html">义乌托运到哈尔滨运费多少</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li><li><a href="http://wen.v-get.com/view/4.html">义乌到四川托运50kg多少钱</a></li><li><a href="http://wen.v-get.com/view/5.html">义乌到西安物流货运哪个好</a></li></ul></div>
</div>
</div>

<div class="r2 rw"><h4>|<a href="http://yiwu.wuliu.v-get.com/news/">义乌物流</a></h4><ul></ul>
</div>
<div class="r3 rw mg">
<h4>|<a href="http://i.v-get.com/report/views?f=3">企业展台</a></h4>
<div class="v_t"><dl><dt><a href="http://wuliu.v-get.com/news/2013-01-01/85.html"><img i="http://www.v-get.com/www.v-getimg.com/i8/70x70/281.gif" alt="中国邮政速递"></a></dt><dd><h3><a href="hhttp://wuliu.v-get.com/news/2013-01-01/85.html">国际品牌 邮政速递</a></h3><p>物流“领导”品牌EMS<br>何敌UPS/DHL/TNT<br>国际物流品牌？<a href="http://wuliu.v-get.com/news/2013-01-01/85.html">[详细]</a></p></dd></dl>
</div>
<div id="ar3" class="ph">
<ul>
<li>
<a href="http://wuliu.v-get.com/1">义乌龚大姐托运→广西专线</a></li><li><a href="http://kaibang.wuliu.v-get.com/">义乌凯邦物流→上海、宁波</a></li><li><a href="http://wuliu.v-get.com/199">义乌鸿航托运→芜湖、合肥</a></li><li><a href="http://wuliu.v-get.com/207">义乌粤发物流→广州、香港</a></li><li><a href="http://wuliu.v-get.com/220">义乌北津二托→北京、天津</a></li><li><a href="http://wuliu.v-get.com/28">义乌唐雅泰托运→唐山周边</a></li><li><a href="http://wuliu.v-get.com/28">义乌郑州托运→郑州、开封</a></li><li><a href="http://wuliu.v-get.com/233">义乌晋都托运→运城、临汾</a></li><li><a href="http://wuliu.v-get.com/179">义乌润东托运→济宁、日照</a></li><li><a href="http://wuliu.v-get.com/145">义乌义襄托运→襄阳、十堰</a></li><li><a href="http://wuliu.v-get.com/9">义乌洪发托运→贵阳、凯里</a></li><li><a href="http://wuliu.v-get.com/23">义乌惠民托运→成都、宜宾</a></li><li><a href="http://wuliu.v-get.com/212">义乌大绿谷物流→无锡专线</a>
</li>
</ul>
</div>
</div>



<div class="r4 rw mg">
<h4>|<a href="http://wuliu.baike.v-get.com/">物流百科</a></h4>
<ul><li><a href="http://baike.v-get.com/view/353.html">民营物流快递企业该如何在“</a></li><li><a href="http://baike.v-get.com/view/352.html">江西农民童木根成就年营业额</a></li><li><a href="http://baike.v-get.com/view/351.html">密码箱不翼而飞，申乐物流赔</a></li><li><a href="http://baike.v-get.com/view/350.html">冷链物流应该协作发展</a></li><li><a href="http://baike.v-get.com/view/348.html">中国物流与采购联合会 (Chin</a></li><li><a href="http://baike.v-get.com/view/347.html">中国物流学会 (China Societ</a></li><li><a href="http://baike.v-get.com/view/346.html">物流公司送错地点又损坏货物</a></li><li><a href="http://baike.v-get.com/view/345.html">韩国长锦商船公司 Sinokor M</a></li><li><a href="http://baike.v-get.com/view/344.html">全球主要海运港口航线路线图</a></li><li><a href="http://baike.v-get.com/view/351.html">密码箱不翼而飞，申乐物流赔</a></li></ul>
</div>


<div class="r5">
<form><fieldset><legend>公告栏</legend></fieldset></form>
<div class="r5c"><p>为了更好确保物流信息准确，商务<br>物流网暂停收录未认证用户的物流<br>信息。<a href="#">查看详情&gt;&gt;</a></p>
<p><a href="#">物流企业认证说明</a></p><p><a href="#">物流企业举报处理中心</a></p><p><a href="#">物流帮助</a></p><p><a href="#">广告与合作咨询</a></p><p>欢迎为商务物流网提出宝贵建议。</p><p><a href="#">宝贵建议</a><br><a href="#">专业人士帮助</a></p>
</div>
</div>

</div>
<?php
}
else {
?>
<div style="height:250px;line-height:250px;text-align:center;font:bold 22px 微软雅黑">非常抱歉，网站正在内测中……</div>
<?php
}
?>
</div>
<div class="o"></div>
<div class="b">
<div class="bt">|<a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">营销中心</a>|<a href="#">站点地图</a>|<a href="#">隐私策略</a>|<a href="#">用户协议</a>|<a href="#">法律声明</a>|</div>
<p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a> <a  href="http://www.miibeian.gov.cn/" rel="nofollow">ICP12013909</a> All Right Reserved</p></div>
</div>
<div class="pn">
<script type="text/javascript">
/* 这个替换关键词de co()必须要放在3/i.js，因为3/ct/i.js有对$("c")进行处理的事，如果再替换就会无法执行 */
J('http://localhost/tu.v-get.com/3/i.js',function(){<?php echo ' co("',$jsk,'",',$A,')';?>});
J('http://localhost/tu.v-get.com/3/ct/i.js');

/* //
//J('http://localhost/www.v-get.com/i8/a.js'); */
</script>
</div>
</body>
</html>