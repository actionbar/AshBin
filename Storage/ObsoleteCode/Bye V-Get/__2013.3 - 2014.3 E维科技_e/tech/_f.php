<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.php?</a>';
exit;
}

//因为经常localhost和 远程共用，所以会出现用Localhost生成的__.html是localhost路径，这里对于需要直接修改单个页面的，需要重新修改一次右侧
if(empty($_GET['rightok'])){echo '<iframe src="http://localhost/www.v-get.com/e/tech/__.php?sure=ok" style="display:none"></iframe>';}

require '../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'tech/'.$filename.'.php';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{
$id_out='';  /* 用于判断该id是否被用过，用过就不再用 i!=100 AND i!=201*/
/* y-m-d h-f-s   i */
$text='<?php
'.constant('Upload_database').' $SY=$_GET[\'y\'];$SM=$_GET[\'m\'];$SD=$_GET[\'d\'];$SH=$_GET[\'h\'];$SF=$_GET[\'f\'];$SS=$_GET[\'s\'];$T=$SY.\'-\'.$SM.\'-\'.$SD.\' \'.$SH.\':\'.$SF.\':\'.$SS;$I=$_GET[\'i\'];$Qq=mysql_query(\'SELECT a,b,c,h,k,d,f,m,n,t FROM f\'.$SY.\' WHERE i=\'.$I.\' AND t="\'.$T.\'" LIMIT 1\',$QC);$Qa=mysql_fetch_array($Qq);$Qr=mysql_num_rows($Qq);if($Qr==0){header(\'HTTP/1.1 404 Not Found\');header("status: 404 Not Found");include \'../a/404.php\';exit();}$K=$Qa[\'k\'];$M=$Qa[\'m\'];$H=$Qa[\'h\'];$A=$Qa[\'a\'];$B=$Qa[\'b\'];$C=$Qa[\'c\'];'.constant('TECHF').'
?>';
$text.=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU').'f.css" /><link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'tech/f.css" /><head><title><?php echo $H,\'_站长之家_V-Get!</title><meta name="keywords" content="\',$K,\'"/><meta name="description" content="\',$Qa[\'d\'],\'"/>\';?>';

$text.=TUN('tech');

$text.='<div class="o mh"></div><div class="a960x60">'.constant('A960x60a').'</div><div class="v"><div class="m mb">您的位置：<a href="'.constant('VE').'">首页</a>&nbsp;&gt;&nbsp;<a href="'.constant('VE').'tech/">站长之家</a><?php echo \'&nbsp;&gt;&nbsp;<a href="'.constant('VE').'tech/\',$asa[$A][0],\'_1.html">\',$asa[$A][1],\'</a>&nbsp;&gt;&nbsp;<a href="'.constant('VE').'tech/\',$asb[$B][0],\'_1.html">\',$asb[$B][1],\'</a>&nbsp;&gt;&nbsp;<a href="'.constant('VE').'tech/\',$asc[$C][0],\'_1.html">\',$asc[$C][1],\'</a>\';unset($asa);unset($asb);unset($asc);?>&nbsp;&gt;&nbsp;正文<span></span></div><div class="o"></div><div class="l"><div class="c"><?php
echo \'<h1>\',$H,\'</h1><div class="ct"><a href="http://e.v-get.com">'.constant('LK').'</a><i>\',$T,\'</i> \',$Qa[\'n\'],\'<div id="bdshare"></div></div><div id="d"></div><div class="o mh"></div>
<div id="c">\',$Qa[\'f\'],\'<p>作者观点与本站无关，转载需保留'.constant('SITENAME_E').'及本文链接，并获得<a href="'.constant('LK').'tech/">V-Get!</a>授权。未经授权，严禁转载！</p></div>\';$aK=explode(\',\',$K);echo \'<div class="ck">\';
foreach($aK as $akey=>$k){echo \'<a href="'.constant('LK').'s?sk=\',$k,\'">\',str_replace(\'%2B\',\'+\',$k),\'</a>\';}
echo \'<i>(网络编辑：<a href="'.constant('LK').'tech/u/\',$M,\'_1.html">\',$M,\'</a>)</i></div>\';?></div><div class="bdlikebutton"></div><div id="hm_t_3749"></div><div class="ds-thread"></div></div><div class="r">';
/* 读取由_.php生成的_.html 并且修改后的_.html *//* 这里是tech文章右侧，服务器不需要有，所以本地 */
$htmlrt=fopen('_.html','r') or exit("Unable to open file!");
while(!feof($htmlrt)){$text.=fgets($htmlrt);}
fclose($htmlrt);

$text.='</div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().'J("'.constant('LTU').'f.js");'.constant('TONGJI').'</script></div>'.constant('AD120x270xfleft').'</body></html>';
file_put_contents($file,$text);}
?>


<script type="text/javascript">

</script>