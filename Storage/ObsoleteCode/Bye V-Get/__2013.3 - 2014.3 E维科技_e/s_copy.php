<?php
$QC=mysql_connect('localhost','EOn20LDmO10','Emvo21FEW2Q30e');mysql_select_db('v8',$QC);mysql_query('set names utf8');
//sk=关键词  sc=类型/全部/1=文章/2=  sp=数量，不是页面，避免计算
$SK=$_GET['sk'];$SK=preg_replace('/[[:punct:]]/','',$SK);
if(strlen($SK)<1){header('Location: http://e.v-get.com');exit();}
$sp=empty($_GET['sp'])?1:$_GET['sp'];$Qp=($sp-1)*10;
$Qsk='h LIKE "%'.$SK.'%" AND f LIKE "%'.$SK.'%"';
$Qq=mysql_query('SELECT i,h,d,g,t FROM f2013 WHERE '.$Qsk.' ORDER BY t DESC LIMIT '.$Qp.',10',$QC);
$Qy=mysql_query('SELECT COUNT(*) FROM f2013 WHERE '.$Qsk);
$Qz=mysql_fetch_array($Qy);
$Qt=$Qz[0];$Pz=ceil($Qt/10);
?>
<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link href="http://localhost/www.v-get.com/tu/i.ico" type="image/ico" rel="shortcut icon" /><link href="http://localhost/www.v-get.com/tu/i.css" rel="stylesheet" type="text/css"  /><link href="http://localhost/www.v-get.com/tu/s.css" rel="stylesheet" type="text/css"  /><script type="text/javascript" src="http://localhost/www.v-get.com/tu/i.js"></script><?php echo '<title>',$SK,'_E维科技_V-Get!</title><meta name="keywords" content="'.$SK.'"/>';?></head><body>
<div class="ws">
<div class="ts"></div>
<div class="s"><form action="http://localhost/e.v-get.com/s"><span class="skw"><input type="text" name="sk" class="sk" value="<?php echo $SK;?>"></span><span class="ssw"><input id="ss" type="submit" value="E维科技"></span></form></div>
<br>
<div class="v">
<div class="p l">
<div id="c">
<?php
while($Qa=mysql_fetch_array($Qq)){
$T=$Qa['t'];$t=strtotime($T);$t=date('Y-m-d',$t);$G=$Qa['g'];
echo '<h2><a href="http://localhost/e.v-get.com/tech/top',$G,'_1.html" class="fg',$G,'"></a><a href="http://localhost/e.v-get.com/tech/',$t,'/',$Qa['i'],'.html">',$Qa['h'],'</a><i>',$T,'</i></h2><p>',$Qa['d'],'</p>';
}
echo '<div class="o mh mg"></div>';
if($Pz>1){
$Pp=$sp-1;$Pn=$sp+1;
switch ($sp)
{ case 1:echo '<div class="pg"><a class="po">首页</a><a class="po">前一页&lt;</a>第<i>1</i>页<a href="http://localhost/e.v-get.com/s?sk=',$SK,'&sp=',$Pn,'" target="_self">&gt;下一页</a><a href="http://localhost/e.v-get.com/s?sk=',$SK,'&sp=',$Pz,'" target="_self">共'.$Pz.'页</a></div>';break;
 case $Pz:echo '<div class="pg"><a href="http://localhost/e.v-get.com/s?sk=',$SK,'" target="_self">首页</a><a href="http://localhost/e.v-get.com/s?sk=',$SK,'&sp=',$Pp,'" target="_self">前一页&lt;</a>第<i>'.$sp.'</i>页<a class="po">&gt;下一页</a><a class="po">第<i>'.$sp.'</i>页</a></div>';break;
  default:echo '<div class="pg"><a href="http://localhost/e.v-get.com/s?sk=',$SK,'" target="_self">首页</a><a href="http://localhost/e.v-get.com/s?sk=',$SK,'&sp=',$Pp,'" target="_self">前一页&lt;</a>第<i>'.$sp.'</i>页<a href="http://localhost/e.v-get.com/s?sk=',$SK,'&sp=',$Pn,'" target="_self">&gt;下一页</a><a href="http://localhost/e.v-get.com/s?sk=',$SK,'&sp=',$Pz,'" target="_self">第<i>'.$Pz.'页</i></a></div>';break;
}}
?>
</div></div><div class="q r"></div></div>
<div class="o mh"></div>
<div class="s"><form action="http://localhost/e.v-get.com/s"><span class="skw"><input type="text" name="sk" class="sk" value="<?php echo $SK;?>"></span><span class="ssw"><input id="ss" type="submit" value="E维科技"></span></form></div></div>
<script type="text/javascript">J("http://localhost/www.v-get.com/tu/s.js");</script>
</body></html>