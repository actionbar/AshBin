<?php

$file = "./svnlog.txt";
$str = file_get_contents($file);

$arr = explode("\nRevision", $str);

//var_dump($arr);die;

$main_arr = array();
foreach($arr as $v){
    $log_arr = explode("\n", $v);

    if(!isset($main_arr[$log_arr[1]])){
        $main_arr[$log_arr[1]]['msg'] = array();
        $main_arr[$log_arr[1]]['file'] = array();
    }

	$main_arr[$log_arr[1]]['msg'][] = $log_arr[4];
	$files = array_slice($log_arr, 6);
	array_pop($files);
	$main_arr[$log_arr[1]]['file'] = array_merge($main_arr[$log_arr[1]]['file'], $files);
}

//var_dump($main_arr);die;

foreach($main_arr as $k => $v){
	$msg = array_unique($v['msg']);
	$file = array_unique($v['file']);

    echo $k;
    echo "<br/>";
    echo implode("<br/>", $msg);
    echo "<br/>";
    echo implode("<br/>", $file);
    echo "<br/>";
	echo "<br/>";
}