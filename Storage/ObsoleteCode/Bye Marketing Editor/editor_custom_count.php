<!DOCTYPE html><html><head><title>E维科技网站编辑数量</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link href="http://tu.v-get.com/i.ico" type="image/ico" rel="shortcut icon" />
<script type="text/javascript" src="http://tu.v-get.com/i.js"></script>
<script type="text/javascript" src="http://tu.v-get.com/l.js"></script>
<link href="http://tu.v-get.com/i.css" rel="stylesheet" type="text/css"  />
<style>
</style>
</head>
<body>
<div class="w"><div style="height:25px"></div>
<?php
if(isset($_POST['cus'])){
$cus=$_POST['cus'];$cpass=$_POST['cpass'];
$cusCheck=array('www.xxxxx.com'=>array('xxxxx','http://www.xxxxx.com/bbs/xxxxx_editor_discuz.php','ningjing','2013-05-11 05:00:00','VGETID1IdwVd',500));
$cpasscheck=$cusCheck[$cus][0];
if(!$cusCheck[$cus]||$cpass!=$cpasscheck){echo '用户名或密码错误';exit;}
echo '<form method="post" action="',$cusCheck[$cus][1],'" target="_blank"><input type="hidden" name="vgetid" value="',$cusCheck[$cus][4],'"/><input type="hidden" name="count" value="1"/><input type="hidden" name="users" value="',$cusCheck[$cus][2],'"/> <label>查询起始时间：</label><input type="text" name="lasttime" value="',$cusCheck[$cus][3],'"/> <label>单篇字数：</label><input type="text" name="charless" value="',$cusCheck[$cus][5],'"/><input style="height:24px;margin:0 9px;padding:0 9px" type="submit" value="查询网编文章数量"></form>';
}
else{
echo '<form method="post"><label>网址：</label><input type="text" name="cus" placeholder="e.v-get.com"/> <label>密码：</label><input type="text" name="cpass"/><input style="height:24px;margin:0 9px;padding:0 9px" type="submit" value="查询网编文章数量"></form>';}
?>
</div>
</body></html>