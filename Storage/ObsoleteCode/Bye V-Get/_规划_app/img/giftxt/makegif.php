<?php
/*
	author:sticker qq:21376498  落伍首发
*/
error_reporting(E_ALL ^ E_NOTICE);
require_once "lib/GIFDecoder.class.php";
require_once "lib/GIFEncoder.class.php";
require_once "lib/lib.php";

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

$id = isset($_GET['id']) ? $_GET['id'] : '';
$txt = isset($_GET['txt']) ? $_GET['txt'] : '';
if (empty($id) || empty($txt)) exit;

$gifdir = 'gif/';
$userdir = 'u/';
$imgdir = 'img/';
include $gifdir.$id.'.gif.php';	
$cfg = $gif_config[$id];
$posX = 0;
$posY = $cfg['height'] - 2;
$postype = isset($cfg['pos']) ? $cfg['pos'] : 'bottom';
if ($postype == 'top') $posY = 20;

$giffile = $gifdir.$cfg['gif'];
$fp = fread ( fopen ( $giffile, "rb" ), filesize ( $giffile ) );
if ( $fp ) {
	$gifdec = new GIFDecoder ( $fp );
	$arr = $gifdec->GIFGetFrames ( );	
	$dly = $gifdec->GIFGetDelays ( );

	$xarr = array($posX,$posX-1,$posX-2);
	$yarr = array($posY,$posY-1,$posY-2);
	$carr = array("#FF0000","#00FF00","#0000FF");
	$frames = array();
	for ( $i = 0; $i < count ( $arr ); $i++ ) {
		$frames[] = $tmpfile = $i < 10 ? "$imgdir/{$id}_0{$i}.gif" : "$imgdir/{$id}_{$i}.gif";		
		fwrite (fopen ($tmpfile, "wb" ), $arr[ $i ] );
		$kk = array_rand($xarr);				
		writeTxt2Img(realpath($tmpfile), $xarr[$kk], $yarr[$kk], $txt, "fonts/ziyi.ttf", $cfg['fontsize'], $carr[$kk]);		
	}	
	$gifenc = new GIFEncoder($frames, $dly, 0, 2, 255,255,255, "url");	
	$savefile = $userdir.date('YmdHis',time()).rand(0,100).'.gif';
	FWrite (FOpen($savefile, 'wb'), $gifenc->GetAnimation ( ) );
	echo "<img src='$savefile' />";	
	$app = dirname($_SERVER['REQUEST_URI']);
	if ($app == "\\" || $app == "\/") $app = "";
	$url = 'http://'.$_SERVER['HTTP_HOST'].$app.'/'.$savefile;
	echo '<div>图片地址(URL)：<input size="50" readonly="readonly" onclick="CopyValue(this)" type="text" value="'.$url.'">';		
}
?>
