<?php
require('c.php');
$S=$_GET['s'];$A=$_GET['a'];$B=$_GET['b'];$C=$_GET['c'];
$rw='';
if($S){$rw='(s=0 OR s='.$S.')';} 
if($A){$rw.=' AND (a=0 OR a='.$A.')';}if($B){$rw.=' AND (b=0 OR b='.$B.')';}if($C){$rw.=' AND (c=0 OR c='.$C.')';}
$p=empty($_GET['p'])?1:$_GET['p'];
$P=($p-1)*20;
$sx=array('','物流');$sy=array('','wuliu');$SX=$sx[$S];$SY=$sy[$S];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php echo $SX;?>资讯_商务百科_V-Get!网</title><meta name="keywords" content="物流,货代,船公司,物流,托运,托运公司,搬家公司,国际快递,国际货运代理,长途汽车查询,货车出租" /><meta name="description" content="V-Get!物流网提供7X24小时物流信息查询服务，内容覆盖义乌全市托运、搬家搬厂、长途巴士汽车客运查询、仓库出租、货代、货车出租、物流加盟、物流设备商及国际货运代理。" />
<link href="http://localhost/www.v-get.com/favicon.ico" type="image/ico" rel="shortcut icon" />
<style type="text/css">
*{padding:0;margin:0}
body {background:#fff;font-size:12px;color:#333;font-family:Tahoma,SimSun}
ul{list-style-position:outside;list-style-type:none}
ol{list-style-position:inside}
li{white-space:nowrap;text-overflow:ellipsis;-o-text-overflow:ellipsis;overflow:hidden}
li,a{cursor:pointer}
select,input,img{vertical-align:middle}
a{color:#1C3D72;text-decoration:none}a:hover{text-decoration:underline}
img {border-width:0}
.p{float:left}.o{clear:both}.q{float:right}
.f{border:#ddd 1px solid;border-radius:5px;filter:progid:DXImageTransform.Microsoft.Shadow(color=#ddd,direction=120,strength=4);-moz-box-shadow:2px 2px 10px #ddd;-webkit-box-shadow:2px 2px 10px #ddd;box-shadow:2px 2px 10px #ddd;}
.f1{color:#f00}
dt,dd{ float:left;display:inline-block}
.w{margin:0px auto; width:960px}
.t{height:28px;line-height:28px;border-bottom:#eee 1px solid}
.t a{margin:0 5px;color:#888}
.n{height:30px;line-height:30px;margin:9px 0;}
.n select{height:20px}
#sk{height:18px;margin:0 3px}
.ss{height:22px}
.c{padding:13px;min-height:1762px}
#m{height:28px;line-height:28px;background:#E5ECF9;border:#E5ECF9 1px solid;border-radius:3px;padding:0 9px}
.pg{text-align:right;height:28px;line-height:28px}
.pg a{margin:0 5px}
.pg .po{color:#999;text-decoration:none}
#c{padding:0 65px 0 11px;width:540px;border-top:#e5ecf9 1px solid;border-bottom:#e5ecf9 1px solid}
#c a{text-decoration:underline;color:#00c}
#c div{margin:15px 0}
#c h2{font-size:14px;line-height:20px}
#c h2 a{margin-right:15px}
#c h2 a:visited{color:#810081}
#c h2 span{color:#666;font-size:11px;font-weight:400}
#c p{line-height:22px}
#c p a{color:#7A77C8}
.r{width:300px}
h5{height:28px;line-height:28px;font-size:14px;padding:0 9px;border-bottom:#ddd 1px solid}
.r li{line-height:24px}
.rw{margin:9px 0}
.r ul{margin:9px;clear:both}
.pu li{float:left;width:140px;text-align:center}
.r .ru{margin:15px}
.ru li{padding-left:16px;background:url(http://localhost/www.v-get.com/li.png) no-repeat;background-position:0 -388px}
.b {margin:9px 0;text-align:center;color:#666}
.bt a {margin:0px 14px}
.b p {line-height:30px}</style></head><body>
<div class="w">
<div id="at"><img src="http://localhost/www.v-get.com/p2/960x45/1.gif" width=" 960"/></div>
<div class="t"><a href="http://www.v-get.com/">V-Get!首页</a>-<a href="http://baike.v-get.com/">商务百科</a>-<a href="http://wuliu.v-get.com/">物流信息</a></div>
<div class="n">
<div class="p nl"><img src="http://localhost/www.v-get.com/v160x30.png" /></div>
<div class="q s">
<form action="http://www.baidu.com/baidu" target="_blank">
<input type="hidden" name="tn" value="bds" /><input type="hidden" name="cl" value="3" /><input type="hidden" name="ct" value="2097152" /><input type="hidden" name="ie" value="utf-8" />
<select name="si"><option value="v-get.com">全网</option></select>
<input type="text" name="word" id="sk" />
<input type="submit" value="搜索" class="ss" />
</form></div>
</div>
<div class="v">
<div class="p f c">
<?php
echo '<div id="m">您的位置：<a href="http://baike.v-get.com/">商务百科</a>&nbsp;&gt;&nbsp;<a href="http://'.$SY.'.v-get.com/">'.$SX.'网</a>&nbsp;&gt;&nbsp;<a href="http://news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-'.'-'.$P.'.html">相关新闻</a>&nbsp;&gt;&nbsp;资讯列表</div>';
if(strlen($rw)){$rw=' WHERE '.$rw;}
$ry=mysql_query("SELECT COUNT(*) FROM news $rw");
$rq=mysql_query("SELECT * FROM news $rw ORDER BY t DESC LIMIT $P,20");
$rz=mysql_fetch_array($ry);
$Iz=$rz[0];$Pz=ceil($Iz/20);$pg='';
if($Pz>1){
$Pp=$p-1;$Pn=$p+1;
$Pq=($Pp==1)?'':'-'.$Pp;
switch ($p)
{ case 1:$pg='<div class="pg"><a class="po">首页</a><a class="po">前一页&lt;</a>第<b>1</b>页<a href="http://localhost/news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-2.html" target="_self">&gt;下一页</a><a href="http://localhost/news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-'.$Pz.'.html" target="_self">共'.$Pz.'页</a></div>';break;
 case $Pz:$pg='<div class="pg"><a href="http://localhost/news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-1.html" target="_self">首页</a><a href="http://localhost/news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-1.html" target="_self">前一页&lt;</a>第<b>'.$p.'</b>页<a class="po">&gt;下一页</a><a class="po">第'.$p.'页</a></div>';break;
  default:$pg='<div class="pg"><a href="http://localhost/news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-1.html" target="_self">首页</a><a href="http://localhost/news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-'.$Pp.'.html" target="_self">前一页&lt;</a>第<b>'.$p.'</b>页<a href="http://localhost/news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-'.$Pn.'.html" target="_self">&gt;下一页</a><a href="http://localhost/news.v-get.com/list/'.$S.'-'.$A.'-'.$B.'-'.$C.'-'.$Pz.'.html" target="_self">第'.$Pz.'页</a></div>';break;
}}
echo $pg.'<div id="c">';
while($r=mysql_fetch_array($rq)){
$I=$r['i'];
echo '<div><h2><a href="http://localhost/news.v-get.com/2013-01-01/'.$I.'.html" target="_blank">'.$r['h'].'</a><span>'.$r['t'].'</span></h2><p>'.$r['d'].'<a href="http://www.baidu.com/baidu?tn=bds&cl=3&ct=2097152&si=v-get.com&ie=utf-8&word='.$r['k'].'">相似阅读</a></p></div>';
}
echo '</div>'.$pg;
?>

</div>
<?php require ('r.htm');?>
</div>
<div class="o"></div>
<div class="b">
<p class="f bt">
<a href="http://www.v-get.com/about.html">关于我们</a>|<a href="http://www.v-get.com/partners.html">合作伙伴</a>|<a href="#">营销中心</a>|<a href="http://www.v-get.com/">联系我们</a>|<a href="http://wuliu.v-get.com/sitemap.html">网站地图</a>|<a href="http://www.weigeti.com/">微个体网</a>|<a href="http://www.v-get.com/copyright.html">版权声明</a>
</p>
<p>CopyRight &copy; 2012 <a href="http://www.v-get.com/">V-Get.com</a> All Right Reserved 版权所有</p>
</div>
</div>
<script type="text/javascript" src="http://localhost/www.v-get.com/c.js"></script>
<script type="text/javascript">Q();$A('','_blank');</script>
</body></html>