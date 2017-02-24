<?php

$do_trim = !empty($_GET['dotrim']);

/* xdebug 很耗费性能，这里关闭*/

require __DIR__ . '/../api.luexu.com/c_tf.php';
require __DIR__ . '/TplLayouts.php';

$CTplFile = new \C\Tpl\File();
$cls_dir = __DIR__ . '/lang';
$cls_files = $CTplFile->globPaths($cls_dir);
$cls_files = $cls_files['files'];
foreach($cls_files as $file){
    require $file;
}




$CTpl = new \C\Tpl();
\C\Tpl::$siteTitle = '掠需网';
\C\Tpl::$doTrim = $do_trim;
\C\Tpl::$layoutFile = new TplLayouts();
\C\Tpl::$tplRoot = __DIR__;
$CTpl->createDir = __DIR__ . '/..';
$CTpl->create();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <style>
        body {
            font: 400 14px/22px "微软雅黑";
            text-align: center;
            margin: 50px
        }

        p {
            line-height: 22px;
        }

        select {
            cursor: pointer;
            height: 30px;
            font: 400 14px/30px "微软雅黑";
        }

        .submit {
            margin: 0 9px;
            width: 99px;
            height: 30px;
            font: 400 16px/30px "微软雅黑"
        }
    </style>

</head>
<body>
<h1>需等待图标加载完全后再执行下一步！！！</h1>

<p>请关闭php.ini里xdebug 的 xdebug.profiler_enable 功能。这个很耗费性能，需要默认关闭，测试性能的时候再开启。</p>

<p>在PHP中，使用 ini_set('xdebug.profiler_enable', 'Off'); 无法关闭；要测试性能，需要开启xdebug.profiler_enable功能</p>

<div>
    <form>
        <select name="dotrim">
            <option value="1">上线代码 = 压缩代码</option>
            <option value="0">本地调试 = 不压缩代码</option>
        </select>
        <input type="submit" class="submit" value="生成">
        <a href="#">压缩并上传</a>
    </form>
</div>