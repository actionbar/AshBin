<?php
/*
	author:sticker qq:21376498 落伍首发
*/
include 'head.php';
$gifdir = 'gif/';
if ( $dh = opendir ( $gifdir ) ) {
	while ( false !== ( $dat = readdir ( $dh ) ) ) {
		if ( preg_match('/.gif.php$/i',$dat ) ) {
			include $gifdir.$dat;
		}
	}
	closedir ( $dh );
}
echo '<h3>请选择一个gif图片开始制作：</h3>';
foreach($gif_config as $id=>$cfg)
{		
	$gif_file = file_exists($gifdir.$id.'.example.gif') ? $gifdir.$id.'.example.gif' : $gifdir.$id.'.gif';
	echo '<div class="gifdiv"><p><a href="gif.php?id='.$id.'"><img src="'.$gif_file.'" /></a></p></div>';
}
include 'foot.php';
?>