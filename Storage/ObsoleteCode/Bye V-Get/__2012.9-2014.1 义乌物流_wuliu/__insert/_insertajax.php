<?php
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('vwuliu',$QC);mysql_query('set names utf8');
$A=$_POST['v'];$B=$_POST['b'];
echo '<select name="fec"><option>c选项</option>';
$Qs='SELECT g,h FROM ct WHERE b='.$B.' AND e="'.$A.'" AND i MOD 10>0';
$Qq=mysql_query($Qs,$QC);
while($Qa=mysql_fetch_array($Qq)){
echo '<option value="',$Qa['g'],'">',$Qa['h'],'</option>';
}
echo '</select>';
?>