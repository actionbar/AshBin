<?php 


function gz(){
$text=file_get_contents('/Webpages/_Uploads/wbe=e.v-get.com/z/sitemap_w3cschool.xml');
// 用下面sitemap()函数生成的由于内存占用太大会经常出问题，所以这里修正一下
$text=str_replace('>priority>','><priority>',$text);
$text=str_replace('5/priority>','5</priority>',$text);
$text=str_replace('>lastmod>','><lastmod>',$text);
$text=str_replace('0/lastmod>','0</lastmod>',$text);
$text=str_replace('>changefreq>','><changefreq>',$text);
$text=str_replace('y/changefreq>','y</changefreq>',$text);
$text=str_replace('>loc>','><loc>',$text);
$text=str_replace('html/loc>','html</loc>',$text);
$text=str_replace('htmlloc>','html</loc>',$text);
$text=str_replace('//loc>','/</loc>',$text);
$text=str_replace('>url>','><url>',$text);
$text=str_replace('>/url>','></url>',$text);
if(!preg_match('/<\?xml\sversion/i',$text)){
$text='<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'.$text.'</urlset>';}

file_put_contents('/Webpages/_Uploads/wbe=e.v-get.com/z/sitemap_w3cschool.xml',$text);
$file_gz='/Webpages/_Uploads/wbtp=tp.v-get.com/sitemap_e_w3cschool.xml.gz';
$file_all_gz=gzopen($file_gz,'w9');
gzwrite($file_all_gz,$text);
gzclose($file_all_gz);
}


function sitemap($filepath){

if (is_dir ( $filepath )) {

    $ch = opendir ( $filepath );
    if ($ch) {

        while ( ($filename = readdir ( $ch )) != false ) {
		
            $filetype = substr ( $filename, strripos ( $filename, "." ) + 1 );
			 $fname = substr ( $filename, 0,strripos ( $filename, "." ) );
		
            if ($filetype=='html'&&is_file ( $filepath . "/" . $filename )) {
			
			echo '<url><loc>http://e.v-get.com/w3cschool/'.($filepath=='.'?'':($filepath . "/")) . ($fname=='index'?'':$fname.'.html').'</loc></url>';
	
			
			}}}}
			
			}
			
			
			

function keepc($filepath){
if (is_dir ( $filepath )) {

    $ch = opendir ( $filepath );
    if ($ch) {

        while ( ($filename = readdir ( $ch )) != false ) {
		
            $filetype = substr ( $filename, strripos ( $filename, "." ) + 1 );
			 $fname = substr ( $filename, 0,strripos ( $filename, "." ) );
		
            if (($filetype=='html'||$filetype=='svg'||$filetype=='xml')&&is_file ( $filepath . "/" . $filename )) {
                $f = fopen ( $filepath . "/" . $filename, "r" );
				$text='';
                while (! feof ( $f )) { $text.= fgets ( $f );}
                fclose($f);
				//这个只能执行一次，多次执行就乱码了
			   $text=preg_replace('/[\r\n]/i','<vget v="nextline"></vget>',$text);
			
			
			$text=str_replace('index.html"','"',$text);
			$text=preg_replace('/\stitle="[^"]+"/i','',$text);
			$text=str_replace('Previous Page','上一页',$text);
			$text=str_replace('Next Page','下一页',$text);
			$text=str_replace('href="."','href="http://e.v-get.com/w3cschool/"',$text);
				$text=str_replace('href=""','href="http://e.v-get.com/w3cschool/"',$text);
				$text=str_replace('href="../"','href="http://e.v-get.com/w3cschool/"',$text);
				$text=str_replace('href="./"','href="http://e.v-get.com/w3cschool/"',$text);
				$text=str_replace('href="."','href="http://e.v-get.com/w3cschool/"',$text);
				$text=str_replace('.asp">','.html">',$text);
				$text=str_replace('car_sell.asp','',$text);
				$text=str_replace('<li><a href="browsers/index.html" title="浏览器信息">浏览器信息</a></li>','<li><a href="http://e.v-get.com/w3c/">W3CSchool 教程</a></li>',$text);
				$text=str_replace('<li><a href="careers/index.html" title="职业规划">职业规划</a></li>','',$text);
				$text=str_replace('<li><a href="../browsers/index.html" title="浏览器信息">浏览器信息</a></li>','<li><a href="http://e.v-get.com/w3c/">W3CSchool 教程</a></li>',$text);
				$text=str_replace('<li><a href="../careers/index.html" title="职业规划">职业规划</a></li>','',$text);
				
				$text=str_replace('<h2><a href="../about/about_helping.html" title="帮助 W3School" id="link_help">帮助 W3School</a></h2><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><div style=" margin-left:12px; margin-top:20px"><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"><!--<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_client = "pub-3381531532877742";<vget v="nextline"></vget><vget v="nextline"></vget>/* 120x90, navsecond */<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_slot = "9377013364";<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_width = 120;<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_height = 90;<vget v="nextline"></vget><vget v="nextline"></vget>//--><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"<vget v="nextline"></vget><vget v="nextline"></vget>src="http://pagead2.googlesyndication.com/pagead/show_ads.js"><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget></div><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget>','<h2><a href="http://e.v-get.com/w3c/" class="f13">W3CSchool 教程</a></h2><div class="a120x90"><script type="text/javascript">var cpro_id="u1210867";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>',$text);
				$text=str_replace('<h2><a href="about/about_helping.html" title="帮助 W3School" id="link_help">帮助 W3School</a></h2><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><div style=" margin-left:12px; margin-top:20px"><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"><!--<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_client = "pub-3381531532877742";<vget v="nextline"></vget><vget v="nextline"></vget>/* 120x90, navsecond */<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_slot = "9377013364";<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_width = 120;<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_height = 90;<vget v="nextline"></vget><vget v="nextline"></vget>//--><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"<vget v="nextline"></vget><vget v="nextline"></vget>src="http://pagead2.googlesyndication.com/pagead/show_ads.js"><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget></div><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget>','<h2><a href="http://e.v-get.com/w3c/" class="f13">W3CSchool 教程</a></h2><div class="a120x90"><script type="text/javascript">var cpro_id="u1210867";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>',$text);
				
				$text=str_replace('<h2><a href="about/about_helping.html" title="帮助 W3School" id="link_help">帮助 W3School</a></h2>','',$text);
				
				
				
				
				$text=str_replace('<div id="footer"><vget v="nextline"></vget><vget v="nextline"></vget><p>W3School提供的内容仅用于培训。我们不保证内容的正确性。通过使用本站内容随之而来的风险与本站无关。当使用本站时，代表您已接受了本站的使用条款和隐私条款。</p><vget v="nextline"></vget><vget v="nextline"></vget><p>版权所有，保留一切权利。未经书面许可，不得转载。W3School 简体中文版的所有内容仅供测试，对任何法律问题及风险不承担任何责任。<a href="http://www.w3school.com.cn/" target="_blank">E维科技</a>，技术支持。</p><vget v="nextline"></vget><vget v="nextline"></vget></div>','<div class="b"></div>',$text);
				$text=str_replace('<div id="footer"><vget v="nextline"></vget><vget v="nextline"></vget><p>W3School提供的内容仅用于培训。我们不保证内容的正确性。通过使用本站内容随之而来的风险与本站无关。当使用本站时，代表您已接受了本站的使用条款和隐私条款。</p><vget v="nextline"></vget><vget v="nextline"></vget><p>版权所有，保留一切权利。未经书面许可，不得转载。W3School 简体中文版的所有内容仅供测试，对任何法律问题及风险不承担任何责任。<a href="http://www.w3school.com.cn/" target="_blank">E维科技</a>，技术支持。</p></p><vget v="nextline"></vget><vget v="nextline"></vget></div>','<div class="b"></div>',$text);
				$text=str_replace('<div id="footer"><vget v="nextline"></vget><vget v="nextline"></vget><p>W3School提供的内容仅用于培训。我们不保证内容的正确性。通过使用本站内容随之而来的风险与本站无关。当使用本站时，代表您已接受了本站的使用条款和隐私条款。</p><vget v="nextline"></vget><vget v="nextline"></vget><p>版权所有，保留一切权利。未经书面许可，不得转载。W3School 简体中文版的所有内容仅供测试，对任何法律问题及风险不承担任何责任。上海赢科投资公司。</p><vget v="nextline"></vget><vget v="nextline"></vget></div>','<div class="b"></div>',$text);
				
				
				$text=str_replace('<vget v="nextline"></vget><vget v="nextline"></vget><!DOCTYPE html','<!DOCTYPE html',$text);
				
				
				$text=str_replace('<div id="ad_head"><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"><!--<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_client = "pub-3381531532877742";<vget v="nextline"></vget><vget v="nextline"></vget>/* 728x90, 创建于 08-12-1 */<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_slot = "7423315034";<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_width = 728;<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_height = 90;<vget v="nextline"></vget><vget v="nextline"></vget>//--><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"<vget v="nextline"></vget><vget v="nextline"></vget>src="http://pagead2.googlesyndication.com/pagead/show_ads.js"><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget></div>','<div class="q g"><script type="text/javascript">var cpro_id="u1163355"</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>',$text);
				
				$text=str_replace('<div class="q g"></div>','<div class="q g"><script type="text/javascript">var cpro_id="u1163355"</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>',$text);
				$text=str_replace('<div id="sidebar"><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><div id="searchui"><vget v="nextline"></vget><vget v="nextline"></vget><form method="get" id="searchform" action="http://www.google.cn/search"><vget v="nextline"></vget><vget v="nextline"></vget><p><label for="searched_content">Search:</label></p><vget v="nextline"></vget><vget v="nextline"></vget><p><input type="hidden" name="sitesearch" value="www.w3school.com.cn" /></p><vget v="nextline"></vget><vget v="nextline"></vget><p><vget v="nextline"></vget><vget v="nextline"></vget><input type="text" name="as_q" class="box"  id="searched_content" title="在此输入搜索内容。" /><vget v="nextline"></vget><vget v="nextline"></vget><input type="submit" value="Go" class="button" title="搜索！" /><vget v="nextline"></vget><vget v="nextline"></vget></p><vget v="nextline"></vget><vget v="nextline"></vget></form><vget v="nextline"></vget><vget v="nextline"></vget></div><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><div id="tools"></div><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><div id="ad"><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"><!--<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_client = "pub-3381531532877742";<vget v="nextline"></vget><vget v="nextline"></vget>/* 120x600, sidebar_big */<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_slot = "9995842720";<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_width = 120;<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_height = 600;<vget v="nextline"></vget><vget v="nextline"></vget>//--><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"<vget v="nextline"></vget><vget v="nextline"></vget>src="http://pagead2.googlesyndication.com/pagead/show_ads.js"><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget></div><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget><vget v="nextline"></vget></div>','<div class="r q"></div>',$text);
				
				$text=str_replace('<div id="searchui"><vget v="nextline"></vget><vget v="nextline"></vget><form method="get" id="searchform" action="http://www.google.cn/search"><vget v="nextline"></vget><vget v="nextline"></vget><p><label for="searched_content">Search:</label></p><vget v="nextline"></vget><vget v="nextline"></vget><p><input type="hidden" name="sitesearch" value="www.w3school.com.cn" /></p><vget v="nextline"></vget><vget v="nextline"></vget><p><vget v="nextline"></vget><vget v="nextline"></vget><input type="text" name="as_q" class="box"  id="searched_content" title="在此输入搜索内容。" /><vget v="nextline"></vget><vget v="nextline"></vget><input type="submit" value="Go" class="button" title="搜索！" /><vget v="nextline"></vget><vget v="nextline"></vget></p><vget v="nextline"></vget><vget v="nextline"></vget></form><vget v="nextline"></vget><vget v="nextline"></vget></div>','<div class="rs"></div>',$text);
				
				$text=str_replace('<div id="ad"><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"><!--<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_client = "pub-3381531532877742";<vget v="nextline"></vget><vget v="nextline"></vget>/* 120x600, sidebar_big */<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_slot = "9995842720";<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_width = 120;<vget v="nextline"></vget><vget v="nextline"></vget>google_ad_height = 600;<vget v="nextline"></vget><vget v="nextline"></vget>//--><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget><script type="text/javascript"<vget v="nextline"></vget><vget v="nextline"></vget>src="http://pagead2.googlesyndication.com/pagead/show_ads.js"><vget v="nextline"></vget><vget v="nextline"></vget></script><vget v="nextline"></vget><vget v="nextline"></vget></div>','<div class="a120x600"><script type="text/javascript">var cpro_id="u1293136";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>',$text);
				$text=str_replace('<div id="ad"><vget v="nextline"></vget><script type="text/javascript"><!--<vget v="nextline"></vget>google_ad_client = "pub-3381531532877742";<vget v="nextline"></vget>/* 120x600, sidebar_big */<vget v="nextline"></vget>google_ad_slot = "9995842720";<vget v="nextline"></vget>google_ad_width = 120;<vget v="nextline"></vget>google_ad_height = 600;<vget v="nextline"></vget>//--><vget v="nextline"></vget></script><vget v="nextline"></vget><script type="text/javascript"<vget v="nextline"></vget>src="http://pagead2.googlesyndication.com/pagead/show_ads.js"><vget v="nextline"></vget></script><vget v="nextline"></vget></div>','<div class="a120x600"><script type="text/javascript">var cpro_id="u1293136";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>',$text);
				
				$text=str_replace('<div id="ad"><vget v="nextline"></vget><script type="text/javascript"><!--<vget v="nextline"></vget>google_ad_client = "pub-3381531532877742";<vget v="nextline"></vget>/* 120x600, sidebar_big */<vget v="nextline"></vget>google_ad_slot = "9995842720";<vget v="nextline"></vget>google_ad_width = 120;<vget v="nextline"></vget>google_ad_height = 600;<vget v="nextline"></vget>//--><vget v="nextline"></vget></script><vget v="nextline"></vget><script type="text/javascript"<vget v="nextline"></vget>src="http://pagead2.googlesyndication.com/pagead/show_ads.js"><vget v="nextline"></vget></script><vget v="nextline"></vget></div>','<div class="a120x600"><script type="text/javascript">var cpro_id="u1293136";</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>',$text);
				
				$text=str_replace('<div id="ad"><vget v="nextline"></vget><script type="text/javascript"><!--<vget v="nextline"></vget>google_ad_client = "pub-3381531532877742";<vget v="nextline"></vget>/* 728x90, tiy_big */<vget v="nextline"></vget>google_ad_slot = "7947784850";<vget v="nextline"></vget>google_ad_width = 728;<vget v="nextline"></vget>google_ad_height = 90;<vget v="nextline"></vget>//--><vget v="nextline"></vget></script><vget v="nextline"></vget><script type="text/javascript"<vget v="nextline"></vget>src="http://pagead2.googlesyndication.com/pagead/show_ads.js"><vget v="nextline"></vget></script><vget v="nextline"></vget></div>','<div class="q a728x90"><script type="text/javascript">var cpro_id="u1163355"</script><script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>',$text);
				
			
				
			$text=str_replace('&quot;','&#34;',$text);
		$text=str_replace('<vget v="nextline"></vget><vget v="nextline"></vget>','<vget v="nextline"></vget>',$text);
		$text=str_replace('<vget v="nextline"></vget><vget v="nextline"></vget>','<vget v="nextline"></vget>',$text);
		$text=str_replace('<vget v="nextline"></vget><vget v="nextline"></vget>','<vget v="nextline"></vget>',$text);
		$text=str_replace('<vget v="nextline"></vget><vget v="nextline"></vget>','<vget v="nextline"></vget>',$text);
			$text=str_replace('<vget v="nextline"></vget>',"\n",$text);
			$text=str_replace('www.w3school.com.cn','e.v-get.com',$text);
			$text=str_replace('w3school.com.cn','e.v-get.com',$text);
			$text=str_replace('www.w3schools.com','e.v-get.com',$text);
			$text=str_replace('w3schools.com','e.v-get.com',$text);
			$text=str_replace('W3schools.com','E.V-Get.com',$text);
			$text=str_replace('W3school.com.cn','E.V-Get.com',$text);
			$text=str_replace('w3school','W3CSchool',$text);
			$text=str_replace('W3School','W3CSchool',$text);
			$text=str_replace('href="html_ref_standardattributes.html"','http://e.v-get.com/w3cschool/html/html_ref_standardattributes.html',$text);
		    $text=str_replace('href="html_ref_eventattributes.html"','http://e.v-get.com/w3cschool/html/html_ref_eventattributes.html',$text);
			$text=str_replace('quiz.asp','#',$text);
			$text=str_replace('/quiz/#','http://e.v-get.com/w3c/',$text);
			$text=str_replace('/http://e.v-get.com/w3c/','http://e.v-get.com/w3c/',$text);
				file_put_contents( $filepath . "/" . $fname.'.'.$filetype,$text);
				
				 
			



				
            }
        }
        closedir ( $ch );
    }
}}

//keepc('a');


function gb2utf8($filepath){
if (is_dir ( $filepath )) {   
    $ch = opendir ( $filepath );
    if ($ch) {
        while ( ($filename = readdir ( $ch )) != false ) {
		
	
            $filetype = substr ( $filename, strripos ( $filename, "." ) + 1 );
			 $fname = substr ( $filename, 0,strripos ( $filename, "." ) );
	if(($filetype=='js'||$filetype=='svg'||$filetype=='html'||$filetype=='css'||$filetype=='xml'||$filetype=='xsl')&&is_file ( $filepath . "/" . $filename )){
          
                $f = fopen ( $filepath . "/" . $filename, "r" );
				$text='';
				echo $filepath . "/" . $filename;
                while (! feof ( $f )) { $text.= fgets ( $f );}
                fclose($f);
				if($filetype!='html'||preg_match('/<meta\shttp\-equiv="Content\-Type"\scontent="text\/html;\scharset=gb2312"\s\/>/i',$text)){
				//这个只能执行一次，多次执行就乱码了
				 $text= iconv("gb2312","utf-8//IGNORE",$text);
				 $text=str_replace('e.v-get.com','www.w3school.com.cn',$text);
				 $text=str_replace('e.v-get.com','w3school.com.cn',$text);
				 $text=str_replace('e.v-get.com','W3school.com.cn',$text);
				 $text=str_replace('www.www.w3school.com.cn','www.w3school.com.cn',$text);
				 	$text=str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><vget v="nextline"></vget><vget v="nextline"></vget><html xmlns="http://www.w3.org/1999/xhtml"><vget v="nextline"></vget><vget v="nextline"></vget><head><vget v="nextline"></vget><vget v="nextline"></vget>','<!DOCTYPE html><html><head>',$text);
				$text=str_replace('<a href="../index.html" title="w3school 在线教程" style="float:left;">w3school 在线教程</a>','<a href="http://e.v-get.com/w3cschool/" title="W3CSchool 在线教程" style="float:left;">W3CSchool 在线教程</a>',$text);
				
					$text=str_replace('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><vget v="nextline"></vget><vget v="nextline"></vget><html xmlns="http://www.w3.org/1999/xhtml"><vget v="nextline"></vget><vget v="nextline"></vget><head><vget v="nextline"></vget><vget v="nextline"></vget>','<!DOCTYPE html><html><head>',$text);
					
		 $text=str_replace('<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />','<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',$text);
		 $text=str_replace('<meta name="author" content="w3school.com.cn" />','',$text);
		 $text=str_replace('<meta name="author" content="www.w3school.com.cn" />','',$text);
		 $text=str_replace('<meta name="Copyright" content="Copyright www.w3school.com.cn All Rights Reserved." />','',$text);
		 $text=str_replace('<meta name="Copyright" content="Copyright W3school.com.cn All Rights Reserved." />','',$text);
         $text=str_replace('<meta http-equiv="imagetoolbar" content="false" />','',$text);
$text=str_replace('<meta name="MSSmartTagsPreventParsing" content="true" />','',$text);
$text=str_replace('<meta name="robots" content="all" />','',$text);
$text=str_replace('<meta http-equiv="Content-Language" content="zh-cn" />','',$text);

				file_put_contents( $filepath . "/" . $fname.'.'.$filetype,$text);	
            }
        }
		}
        closedir ( $ch );
    }
}

}

function allfile(){
$files = opendir ('./');
if($files){
while ( ($allfile = readdir ( $files ))!= false ) {
// ../ 就是上层，避免把/e/给修改了，必须要判断一下
if($allfile!='..'){

//  这个已经不需要了，转一次就可以了。gb2utf8($allfile);
keepc($allfile);

//sitemap($allfile);
}
}
}
}
//gz();
allfile();
?>