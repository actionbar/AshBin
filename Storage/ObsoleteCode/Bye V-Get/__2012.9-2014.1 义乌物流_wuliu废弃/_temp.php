<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><title>修改县</title><link href="http://weigeti.com/p0/favicon.ico" type="image/ico" rel="shortcut icon"/><body><?php
 require('c.php');
 if(empty($_POST['xx'])){
 echo '<form method="post" style="text-align:center;margin-top:50px"><input type="text" name="xx" value=""/> <select name="pc"><option value="县">县</option><option value="市">市</option><option value="区">区</option><option value="镇">镇</option><option value="街道">街道</option><option value="村">村</option><option value="盟">盟</option></select><input type="submit" /></form>';
 
 }
 else 
{$xx=$_POST['xx'];$pc=$_POST['pc'];
 echo '<form method="post" style="text-align:center;margin-top:50px" onsubmit="if(this.xx.value==this.ok.value){return false}else this.submit();"><input type="text" name="xx" value=""/> <select name="pc"><option value="县">县</option><option value="市">市</option><option value="区">区</option><option value="镇">镇</option><option value="街道">街道</option><option value="村">村</option><option value="盟">盟</option></select> <input type="text" name="ok" value="',$xx,'" readonly="readonly"/><input type="submit" /></form>';
mysql_query('update c set d=replace(d,"'.$xx.'","'.$xx.$pc.'")');
mysql_query('update c set d=replace(d,"'.$pc.$pc.'","'.$pc.'")');


}
 ?>
 </body></html>