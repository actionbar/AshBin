<?php
/*
ΣεΊ£ΘνΌώ[HaiPHP.COM] 
*/
include_once './config.php';
if($_GET[id]){
	$result=mysql_query("select * from `birthday` where id=$_GET[id]");
	$result_m=mysql_fetch_object($result);
	
	$content_txt=array(id=>$result_m->id,ip=>$ip,time=>time(),date=>$result_m->name);
	$text_class->add_line($content_txt);
	
	$seoname=strip_tags($result_m->name);
	$seoname = explode(" ", strip_tags($result_m->name));
  //echo $seoname[0]; // piece1

	$smarty->assign("name",$result_m->name);
	$smarty->assign("content",$result_m->content);
	$smarty->assign("seoname",$seoname[0]);
}
$history=$text_class->openFile();
sort($history,SORT_DESC);
$smarty->assign(history,$history);

$result=mysql_query("select * from `birthday`");
while($row=mysql_fetch_array($result)){
	$type=explode(':',$row[day]);
	if($row[month]==1){
		$type_1[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==2){
		$type_2[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==3){
		$type_3[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==4){
		$type_4[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==5){
		$type_5[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==6){
		$type_6[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==7){
		$type_7[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==8){
		$type_8[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==9){
		$type_9[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==10){
		$type_10[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==11){
		$type_11[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
	if($row[month]==12){
		$type_12[]=array(a=>$type[0],b=>$type[1],id=>$row[id]);
	}
}
$smarty->assign("type_1",$type_1);
$smarty->assign("type_2",$type_2);
$smarty->assign("type_3",$type_3);
$smarty->assign("type_4",$type_4);
$smarty->assign("type_5",$type_5);
$smarty->assign("type_6",$type_6);
$smarty->assign("type_7",$type_7);
$smarty->assign("type_8",$type_8);
$smarty->assign("type_9",$type_9);
$smarty->assign("type_10",$type_10);
$smarty->assign("type_11",$type_11);
$smarty->assign("type_12",$type_12);
$smarty->display('index.html');
?>