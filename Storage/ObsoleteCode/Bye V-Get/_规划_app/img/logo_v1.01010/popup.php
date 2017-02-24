<HTML>
<HEAD>
<TITLE>Fonts Preview</TITLE>
<link rel="stylesheet" type="text/css" href="style.css" media="all"/>
</HEAD>
<BODY>
<?php
foreach($_GET AS $key => $value) {
${$key} = $value;
} 
foreach($_POST AS $key => $value) {
${$key} = $value;
}
echo "<Table width=\"80%\" align=center><TR height=\"55\"><TD align=\"center\"><B>Font List</B></TD></TR>";
$handles = @opendir("sample/");
while (false !== ($file = (readdir($handles)))) {
if ($file=='.' || $file=='..'||$file=='Thumbs.db') { continue; }
$cur_directory[] = $file;
}
sort($cur_directory);
foreach ($cur_directory as $file) {
$font=$file;
}
@closedir($handles);

$list_per_page=50;
foreach ($cur_directory as $file) {
$gi+=1;
$ipp[$gi] = "$file";
} 
if($gi>=1){
if($page==""){
$page="0";
}
if($gi>2){
$start=$page*$list_per_page;
$end = $start+$list_per_page;
}else{
$start=0;
$end=$gi;
}
$tpage=$gi/$list_per_page;
$hex=explode(".",$tpage);
$cpage=$page+1;
for($y=$start;$y<$end;$y++) {
if($ipp[$y]!=""){
echo "<TR height=\"41\"><TD width=\"100%\"><img src=\"sample/$ipp[$y]\"></TD></TR>";
}
}
echo "<TR height=\"20\"><TD width=\"100%\">&nbsp;</TD></TR>";
echo "<table width=80% align=center><tr>";
$pages=$gi/$list_per_page;
for($i=0;$i<=$pages;$i++){
if($i!=$page){
if($page>0){
$ii=$page-1;
echo "<TD width=\"20%\" align=center><a href=\"?page=$ii\"><img src=\"images/previous.png\" border=0 alt=\"Previous Page\"></a></TD>";
}else{
echo "<TD width=\"20%\">&nbsp;&nbsp;</TD>";
}
echo "<TD align=center width=60%>";
for($i=0;$i<=$pages;$i++){
$sh=$i+1;
if($i!=$page){
echo " <a href='?page=$i'><font size=4><b>$sh</b></a> ";
}else{
echo " <font size=4><b>$sh</b> ";
}
}
echo "</TD>";
if($page<$pages-1){
$ij=$page+1;
$showpage=$i+1;
echo "<TD width=\"20%\" align=center><a href=\"?page=$ij\"><img src=\"images/next.png\" border=0 alt=\"Next Page\"></a></TD>";
}else{
echo "<TD width=\"20%\">&nbsp;&nbsp;</TD>";
}
}else{
}
}
echo "</tr></table>";
}
echo "<TR height=\"20\"><TD width=\"100%\">&nbsp;</TD></TR>";
echo "</Table>";
?>
</BODY>
</HTML>