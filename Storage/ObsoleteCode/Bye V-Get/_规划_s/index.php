<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商务导航，从V-Get!开始！</title>
<meta name="keywords" content="网站建设,网站制作,免费建站,企业建站,SEO,SMO,搜索引擎优化,百度关键词优化"/><meta name="description" content="网站建设专家－E维科技为您提供高质量、按需定制的企业网站制作与SEO优化营销方案,与时俱进的企业建站产品,SMO与SEO相结合的企业网站推广,品牌营销策划,百度谷歌SEO搜索引擎关键词排名优化,是您放心之选。"/>
<link href="http://localhost/www.v-get.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
<style type="text/css">*{margin:0;padding:0}</style>
</head>
<frameset rows="40,*">
    
<?php
$S1=$_GET['s1'];$S2=$_GET['s2'];$K=$_GET['k'];
$S=array(6=>'http://www.baidu.com/s?wd=',7=>'http://www.google.com.hk/cse?cx=001674900350770916229:ulx91e-hzym&start=0&q=d#gsc.tab=0&gsc.page=1&gsc.q=',8=>'http://search.yahoo.com/search?p=',9=>'http://fanyi.baidu.com/#auto2auto|',10=>'http://map.baidu.com/?newmap=1&s=s%26wd%3D',11=>'http://search.china.alibaba.com/selloffer/offer_search.htm?n=y&keywords=',12=>'http://china.ecvv.com/search/SearchBusinessService.aspx?sType=4&key=',13=>'http://www.duojiaochong.com/Home/Search?keywords=',14=>'http://www.haodingdan.com/search_factory.html?q=',15=>'http://cn.hisupplier.com/search/product_search.htm?queryText=',21=>'http://www.alibaba.com/trade/search?fsb=y&IndexArea=product_en&CatId=&SearchText=',22=>'http://www.ecvv.com/product/Search.html?kw=',23=>'http://www.kompass.com/MarketingViewWeb/appmanager/kim/CHN_Portal?mktInfo_BasicSearchPortlet_1isMainSearch=true&_nfpb=true&_windowLabel=mktInfo_BasicSearchPortlet_1&mktInfo_BasicSearchPortlet_1_actionOverride=%252Fflows%252FmarketingInformation%252FbasicSearch%252FlaunchSearch&_pageLabel=common_homePage&mktInfo_BasicSearchPortlet_1%7BactionForm.userLanguage%7D=en&mktInfo_BasicSearchPortlet_1wlw-select_key%3A%7BactionForm.geoSearch%7DOldValue=true&mktInfo_BasicSearchPortlet_1wlw-select_key%3A%7BactionForm.geoSearch%7D=MKT_WW&mktInfo_BasicSearchPortlet_1wlw-select_key%3A%7BactionForm.typeSearch%7DOldValue=true&mktInfo_BasicSearchPortlet_1wlw-select_key%3A%7BactionForm.typeSearch%7D=PS#.UPa4TPKP5SN&mktInfo_BasicSearchPortlet_1%7BactionForm.userParameterSearch%7D=',24=>'http://www.traderscity.com/board/googit.php?cx=partner-pub-1051207324975532%3A9154957290&cof=FORID%3A10&ie=UTF-8&sa=Search&q=',25=>'http://www.hisupplier.com/search?type=products&keyword=');

if($S[$S1]&&$S[$S2]){
echo '<frame src="http://localhost/www.v-get.com/i0/v4/s.html?s1=',$S1,'&s2=',$S2,'&k=',$K,'" scrolling="no" noresize="noresize" frameborder="0">';

//到谷歌那里申请cx码，我的s.v-get.com是：001674900350770916229:ulx91e-hzym
$k1=$K;$k2=$K;
if($S1==11){$k1=iconv("UTF-8","gbk",$K);}
if($S2==11){$k2=iconv("UTF-8","gbk",$K);}
$k1=urlencode($k1);$k2=urlencode($k2);
$s1=$S[$S1].$k1;
$s2=$S[$S2].$k2;


	if($s1==$s2){
	echo '<frame src="',$s1,'"  frameborder="0">';
	}
	else{
	echo '<frameset cols="50%,50%"><frame src="',$s1,'"><frame src="',$s2,'"></frameset>';}
	}
	
else {header("Location: http://localhost/s.v-get.com/");exit;}
?>
<noframes>
<body>
这里用html 纯 手机浏览链接，方便手机的同时，方便SEO
</body>
</noframes>
 </frameset>
</html>