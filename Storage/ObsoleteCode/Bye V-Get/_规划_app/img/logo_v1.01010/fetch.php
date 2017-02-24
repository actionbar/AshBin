<?php
foreach($_GET AS $key => $value) {
${$key} = $value;
} 
foreach($_POST AS $key => $value) {
${$key} = $value;
}
if($action=="yes"){
$j=1;
echo "<table width=600><tr height=\"55\">";
$handles1 = @opendir("bgstyle/sep/48");
while (false !== ($folder = (readdir($handles1)))) {
if ($folder=='.' || $folder=='..'||$folder=='index.html'||$folder=='Thumbs.db') { continue; }
if($folder!=""){
$rip=str_replace("_48.png","",$folder);
if($j==1){
$checked="yes";
}else{
$checked="no";
}
echo "<td width=\"85\" align=\"center\" style='border:#e6e6e6 1px solid;'><label><img src=\"bgstyle/sep/48/$folder\"><BR><input type=radio id=pick name=pick checked=\"$ch\" value=\"$folder\" onclick=makeit('$rip')></label></td>";
if($j%7==0){
echo "</tr><tr height=\"55\">";
}
$j++;
}else{
continue;
}
}
@closedir($handles1);
echo "<input type=hidden id=\"iconic\" name=\"iconic\" value=\"$rip\">";
echo "</tr></table>";
}else{
echo "<input type=hidden id=iconic name=iconic value=\"\">";
echo "<input type=hidden id=left_spacing name=left_spacing value=\"\">";
echo "<input type=hidden id=top_spacing name=top_spacing value=\"\">";
echo "<input type=hidden id=icon_size name=icon_size value=\"\">";
}

?>