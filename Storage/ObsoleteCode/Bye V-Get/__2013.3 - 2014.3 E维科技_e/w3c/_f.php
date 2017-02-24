<?php
require '_/global.php';
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('vea',$QC);mysql_query('set names "UTF-8"');


$file=constant('uploadFile').'w3c/f.php';




$text='<?php '.constant('DB_w3c').'$L=$_GET[\'l\'];'.$OBJ2STR->func('str->sql_injection','$L','$L').'$Qq=mysql_query(\'SELECT * FROM w3c WHERE l="\'.$L.\'" LIMIT 1\',$QC);$Qa=mysql_fetch_array($Qq);$Qr=mysql_num_rows($Qq);if($Qr==0){header(\'HTTP/1.1 404 Not Found\');exit();}$A=$Qa[\'a\'];$G=$Qa[\'g\'];$H=$Qa[\'h\'];$K=$Qa[\'k\'];$D=$Qa[\'d\'];$F=$Qa[\'f\'];?>';
$text.=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU').'/f.css" /><link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'tech/f.css" /><head><title><?php echo $H,\'_W3CSchool 在线教程_V-Get!</title><meta name="keywords" content="\'.$K.\'"/><meta name="description" content="\'.$D.\'"/>\';?>'.TUN('').'<div class="o mh"></div><div class="mg a960x60">'.constant('AD960x60pic').'</div><div class="v"><div class="m mb">您的位置：<a href="'.constant('VE').'">首页</a>&nbsp;&gt;&nbsp;<a href="'.constant('VE').'w3c/">W3CSchool 在线教程</a><?php echo \'&nbsp;&gt;&nbsp;<a href="'.constant('VE').'w3c/\',$A,\'.html">\',$A,\'</a>&nbsp;&gt;&nbsp;\',$G,\'<span></span></div><div class="o"></div><div class="l"><div class="c"><h1>\',$H,\'</h1><div class="ct"><div id="bdshare"></div></div><div id="d"></div><div class="o mh"></div>
<div id="c">\',$Qa[\'f\'],\'<p>W3CSchool 在线教程 中HTML代码可以与<a href="'.constant('LK').'tool/html_editor.html">HTML 在线编辑器</a>配合学习。</p><p>作者观点与本站无关，转载需保留'.constant('SITENAME_E').'及本文链接，并获得<a href="'.constant('LK').'tech/">本站</a>授权。未经授权，严禁转载！</p></div>\';$aK=explode(\',\',$K);echo \'<div class="ck">\';
foreach($aK as $akey=>$k){echo \'<a href="'.constant('LK').'s?se=w3c&sk=\',$k,\'">\',str_replace(\'%2B\',\'+\',$k),\'</a>\';}
echo \'<i>(网络编辑：<a href="'.constant('LK').'tech/u/\',$A,\'_1.html">\',$A,\'</a>)</i></div>\';?></div><div class="ds-thread"></div><div id="hm_t_3749"></div></div><div class="r"></div>';
$text.=constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().'J("'.constant('LTU').'f.js");var duoshuoQuery={short_name:"ev-get"};J("http://static.duoshuo.com/embed.js",function(s){s.async=I;s.charset="UTF-8"});'.constant('TONGJI').'</script></div></body></html>';
$FILE->write($file,$text);
?>