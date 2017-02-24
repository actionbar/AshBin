<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4); 
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新'.$filename.'.php?</a>';
exit;
}
require '../_/co.php';
$file=constant('uploadFile').'/co/'.$filename.'.php';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{

$text='<?php '.constant('CO_SQL').'$Qq=mysql_query(\'SELECT b,h,he,k,l,b,r,q,lt,x,y,z,zz,t,adt,tj FROM co WHERE e="\'.$E.\'" LIMIT 1\');$Qr=mysql_num_rows($Qq);if($Qr==0){header(\'Location: http://wuliu.v-get.com/\');exit();}$Qa=mysql_fetch_array($Qq);$B=$Qa[\'b\'];$H=$Qa[\'h\'];$K=$Qa[\'k\'];$Z=$Qa[\'z\'];$LT=$Qa[\'lt\'];$TA=$Qa[\'adt\'];$now=time();$ad=($TA>$now)?false:true;echo \'<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>诚信认证_\',$H,\'_\',$Z,$K,\'_商务物流网_V-Get!</title><meta name="keywords" content="\',$K,\'" /><meta name="description" content="\',$H,\'诚信认证，专业提供\',$Z,$Qa[\'l\'],\'"/>\';?>'.COTUN($filename).'<div class="q r"><div class="o mh"></div><div class="m cc"><div>您现在的位置：<?php echo \'<a href="http://\',$E,\'.wuliu.v-get.com/">\',$H,\'</a>\';?> &gt; 诚信认证</div></div><div class="mf"><div class="c_ca mg"><h5><a href="#">企业<i class="iv">V</i>认证</a>（2013年02月22日通过认证）</h5><p>通过第三方公益性认证机构，对企业合法性，真实性的核实及申请人是否隶属该企业且经过企业授权的查证。</p><?php $Qqc=mysql_query(\'SELECT * FROM coc WHERE e="\'.$E.\'" LIMIT 1\');while($Qac=mysql_fetch_array($Qqc)){$cH=$Qac[\'h\'];$cB=$Qac[\'b\'];$cA=$Qac[\'a\'];$cA*=25;$cAa=$cA-24;$cC=$Qac[\'c\'];$cC*=15;$cCa=$cC-14;echo \'<p>企业名称：\',$cH,\' <span class="f0">[已认证]</span></p><p>注册资金：人民币  \',$Qac[\'m\'],\' 万元 <span class="f0">[已认证]</span></p><p>工商登记号：\',$Qac[\'j\'],\' <span class="f0">[已认证]</span></p><p>法人代表：</td><td>\',$Qa[\'x\'],\' <span class="f0">[已认证]</span></p><p>注册日期：</td><td>\',$Qa[\'t\'],\' <span class="f0">[已认证]</span></p><p>注册地址：</td><td>\',$Qac[\'l\'],\' <span class="f0">[已认证]</span></p><p>物流公司类型：</td><td>\',$Qac[\'w\'],\' <span class="f0">[已认证]</span></p><p>员工人数：</td><td>\',$cAa,\' - \',$cA,\' 人 <span class="f0">[已认证]</span></p><p>配送车辆：</td><td>\',$cCa,\' - \',$cC,\' 辆 <span class="f0">[已认证]</span></p><p>执照期限：</td><td>\',$Qac[\'t\'],\' <span class="f0">[已认证]</span></p><p>发证机关：</td><td>\',$Qac[\'u\'],\' <span class="f0">[已认证]</span></p><p>以上信息来源于工商执照信息，最终解释权归公司和工商总局所有。</p>\';}?></div></div></div><div class="o mh"></div>'.constant('CO_VBB');
file_put_contents($file,$text);}
?>