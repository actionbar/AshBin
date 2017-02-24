<?php
include './include/common.inc.php';
$Shortcut = "[InternetShortcut]
URL={$_config['info']['siteurl']}
IDList=IconFile={$_config['info']['siteurl']}/favicon.ico
IconIndex=1
[{000214A0-0000-0000-C000-000000000046}]
Prop3=19,2";
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename={$_config['info']['sitename']}.url;");
echo $Shortcut;
?>