<?php
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('vwuliu',$QC);mysql_query('set names utf8');

/* 分别生成不同城市的.php
$SUB_CT=array(array(330782,'yiwu','义乌','义乌市'),array(310000,'sh','上海','上海市'));

 */
 $SUB_CT=array();
$Qsct='SELECT b,e,g,h FROM ct WHERE (i MOD 100)=0 AND i<99999999';
$Qqct=mysql_query($Qsct,$QC);
while($Qact=mysql_fetch_array($Qqct)){
$SUB_CT[]=array($Qact['b'],$Qact['e'],$Qact['g'],$Qact['h']);
}
?>