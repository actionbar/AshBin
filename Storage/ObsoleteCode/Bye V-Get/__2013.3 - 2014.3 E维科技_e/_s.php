<?php
//sk=关键词  sc=类型/全部/1=文章/2=  sp=数量，不是页面，避免计算
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 

if(!isset($_GET['sure'])){echo '<a href="?sure=ok">确定更新e.v-get.com/'.$filename.'.php?</a>';exit;}

require '_/global.php';

$file=constant('uploadFile').$filename.'.php';

$c_mysql_page=new mysql_page();

$text='<?php 
$SK=$_GET[\'sk\'];'.$OBJ2STR->func('str->sql_injection','$SK','$SK').'if(empty($SK)){header(\'Location: http://e.v-get.com\');exit();}if(!isset($_GET[\'ie\'])||\'utf-8\'!=$_GET[\'ie\']){'.$OBJ2STR->func('unicode->is_utf8','$is_utf8','$SK').'$SK=$is_utf8?$SK:iconv($encode,\'UTF-8\',$SK);}$sp=empty($_GET[\'sp\'])?1:(int)$_GET[\'sp\'];$Qp=($sp-1)*10;
$SE=isset($_GET[\'se\'])&&\'w3c\'==$_GET[\'se\']?\'w3c\':\'\';
$allSE=($SE==\'\')?true:false;
?><!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link href="'.constant('LTU').'i.css" rel="stylesheet" type="text/css"  /><link href="'.constant('LTU').'s.css" rel="stylesheet" type="text/css"  /><?php echo \'<title>\',$SK,\'_'.constant('SITENAME_E').'_V-Get!</title><link href="'.constant('LK').'s?\',($allSE?\'\':(\'se=\'.$SE.\'&\')),\'sk=\',str_replace('.GO_KEEP4SEARCH(0).','.GO_KEEP4SEARCH(1).',$SK),\'" rel="canonical" /><meta name="keywords" content="\'.$SK.\'"/>\';?></head><body><div class="ws"><div class="ts"></div><div class="s"><form action="'.constant('LK').'s"><input type="hidden" name="ie" value="utf-8"><?php echo $allSE?\'\':(\'<input type="hidden" name="se" value="\'.$SE.\'">\');?><span class="skw"><input type="text" name="sk" class="sk" value="<?php echo $SK;?>"></span><span class="ssw"><input id="ss" type="submit" value="'.constant('SITENAME_E').'"></span></form></div><br><div class="v"><div class="p l"><div id="c"><?php 

if($allSE){
'.constant('DB_VE_F20XX').'
$Qq=mysql_query(\'(SELECT i,h,d,g,t FROM f2013 WHERE h LIKE "%\'.$SK.\'%" OR k LIKE "%\'.$SK.\'%") UNION (SELECT i,h,d,g,t FROM (SELECT i,h,d,g,t FROM f2013 WHERE d LIKE "%\'.$SK.\'%" OR f LIKE "%\'.$SK.\'%" ORDER BY t DESC) f2013) LIMIT \'.$Qp.\',10\',$QC);
$Qy=mysql_query(\'SELECT COUNT(*) FROM f2013 WHERE h LIKE "%\'.$SK.\'%" OR f LIKE "%\'.$SK.\'%"\');
while($Qa=mysql_fetch_array($Qq)){$T=$Qa[\'t\'];$t=strtotime($T);$t=date(\'Ymd/His\',$t);$G=$Qa[\'g\'];echo \'<h2><a href="'.constant('VE').'tech/top\',$G,\'_1.html" class="fg\',$G,\'"></a><a href="'.constant('LK').'tech/\',$t,$Qa[\'i\'],\'.html">\',$Qa[\'h\'],\'</a><i>\',$T,\'</i></h2><p>\',$Qa[\'d\'],\'</p>\';}
}
else {
'.constant('DB_VE_W3C').'
$Qq=mysql_query(\'(SELECT l,h,d FROM w3c WHERE a ="$SK") UNION (SELECT l,h,d FROM w3c WHERE x LIKE "%\'.$SK.\'%" OR h LIKE "%\'.$SK.\'%" OR g LIKE "%\'.$SK.\'%" OR k LIKE "%\'.$SK.\'%") UNION (SELECT l,h,d FROM w3c WHERE d LIKE "%\'.$SK.\'%" OR f LIKE "%\'.$SK.\'%" OR g LIKE "%\'.$SK.\'%") LIMIT \'.$Qp.\',10\',$QC);
$Qy=mysql_query(\'SELECT COUNT(*) FROM w3c WHERE h LIKE "%\'.$SK.\'%" OR f LIKE "%\'.$SK.\'%"\');
while($Qa=mysql_fetch_array($Qq)){echo \'<h2><a href="'.constant('VE').'w3c/\',$Qa[\'l\'],\'.html">\',$Qa[\'h\'],\'</a></h2><p>\',$Qa[\'d\'],\'</p>\';}
}
$Qz=mysql_fetch_array($Qy);$Qt=$Qz[0];$Pz=ceil($Qt/10);
echo \'<div class="o mh mg"></div>\';'.$c_mysql_page->show('sp1','http://e.v-get.com/s?sk=[$SK]','http://e.v-get.com/s?sk=[$SK]&sp={_}','$Pz','$sp').'?></div></div><div class="q r"></div></div><div class="o mh"></div><div class="s"><form action="'.constant('LK').'s"><input type="hidden" name="ie" value="utf-8"><?php echo $allSE?\'\':(\'<input type="hidden" name="se" value="\'.$SE.\'">\');?><span class="skw"><input type="text" name="sk" class="sk" value="<?php echo $SK;?>"></span><span class="ssw"><input id="ss" type="submit" value="'.constant('SITENAME_E').'"></span></form></div></div><div class="pn"><script type="text/javascript" src="'.constant('LTU').'i.js"></script><script type="text/javascript">E($("ss"),"mousedown",function(){SP(this,-100,0);});E($("ss"),$9,function(){SP(this,0,0);});'.constant('TONGJI').'</script></div>'.constant('ADxuanfu_issue_right_ad').'</body></html>';



$FILE->write($file,$text);





?>