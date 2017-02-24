<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>刷新wuliu数据库排名</title><link href="http://weigeti.com/p0/favicon.ico" type="image/ico" rel="shortcut icon"/><body><?php
 require('c.php');
 if(empty($_POST['pw'])){
 echo '<form method="post">刷新数据库排名：<input type="password" name="pw" value="Refresh_12"/><input type="submit" /></form>';
 
 }
 else 
{$pw=$_POST['pw']; if($pw=='Refresh_12'){
$sql="SELECT * FROM c WHERE v<255";
$rq=mysql_query($sql);
while($r=mysql_fetch_array($rq)){
$V=$r['v'];$Q=$r['q'];$Ra=150*$V;$Rz=$Ra+149;if($Q!=NULL && count($Q)>0){$Ra+=100;$Rz+=100;}$rd=rand($Ra,$Rz);
mysql_query('update c set o='.$rd.' where i='.$r['i']);
}
echo '<script>alert("刷新完成，上传到网络数据库吧！！！");window.close();</script>';
}
else {echo 'You dont have the permission to do it....';}
}
 ?>
 </body></html>