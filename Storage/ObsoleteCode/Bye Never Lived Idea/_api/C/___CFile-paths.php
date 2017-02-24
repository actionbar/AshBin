<?php
/*
 * compare the performance of traversal the paths
 * WinCacheGrind
 * */

/*
 * Apache
 * total 680ms
 * is_dir  388ms
 * dir 90ms
 *
*/
function paths($dir){
    $dirs = [];
    $files = [];
    $traversal = dir($dir);
    while($file = $traversal->read()){
        $single = $dir . '/' . $file;
        if((is_dir($single)) AND ($file != '.') AND ($file != '..')){
            $dirs[] = $single;
            $dirs = array_merge($dirs, paths($single)['dirs']);
            $files = array_merge($files, paths($single)['files']);
        }
        else{
            $files[] = $single;
        }
    }

    $traversal->close();
    return array(
        'dirs' => $dirs,
        'files' => $files
    );
}