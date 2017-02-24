<?php
// 这里每个都不同，需要独立配置


define('YSX_DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('YSX_CORE_CLASS_DIR', 'E:/root/_class');
/*
 * $_SERVER['DOCUMENT_ROOT']  网站根目录，任何文件获得的值都一样 ==> 如果是虚拟主机，就是虚拟主机设置doc_root所在位置
 * $_SERVER['HTTP_HOST']
 * $_SERVER['PHP_SELF']  //当前正在执行脚本的文件相对网站根目录地址，就算该文件被其他文件引用也可以正确得到地址
 * $_SERVER['SCRIPT_NAME'];//当前正在执行脚本的文件相对网站根目录地址，但当该文件被其他文件引用时，只显示引用文件的相对地址，不显示该被引用脚本的相对地址。
 * $_SERVER['SCRIPT_FILENAME'];//当前执行脚本的绝对路径名
 * $_SERVER['DOCUMENT_ROOT'];//网站相对服务器地址即网站的绝对路径名 #当前运行脚本所在的文档根目录。在服务器配置文件中定义
 * 魔术常量__FILE__  取得当前文件的路径 D:\www\message2011\include\config.inc.php
 * dirname(__FILE__) 去掉上面路径的文件名，得到绝对文件夹
 * 返回一层目录到根目录：realpath(dirname(__FILE__).'/../')    D:\www\message2011
 * __DIR__ 当前打开页面脚本，所在目录  D:\www\message2011
 * */
// 不要使用 __DIR__ 因为打开文件相对路径不一样，就会出错


include(YSX_CORE_CLASS_DIR . '/_const/rqst.php');
include(YSX_CORE_CLASS_DIR . '/_const/err.php');

/*spl_autoload_register() 提供了一种更加灵活的方式来实现类的自动加载。因此，不再建议使用 __autoload() 函数，在以后的版本中它可能被弃用。*/

//include YSX_CORE_CLASS_DIR . '/_c/interface.php';

function load_c($class) {
    $file = YSX_CORE_CLASS_DIR . '/_c/core/' . $class . '.php';
    if (!file_exists($file)) {
        return false;
    }
    include $file;
}

function load_c_local($class) {
    $file = YSX_CORE_CLASS_DIR . '/_c/local/' . $class . '.php';
    if (!file_exists($file)) {
        return false;
    }
    include $file;
}

function load_c_output($class) {
    $file = YSX_CORE_CLASS_DIR . '/_c/output/' . $class . '.php';
    if (!file_exists($file)) {
        return false;
    }
    include $file;
}

function load_ca($class) {
    $file = YSX_DOC_ROOT . '/_ca/' . $class . '.php';
    if (!file_exists($file)) {
        return false;
    }
    include $file;
}

/*** nullify any existing autoloads ***/
/*spl_autoload_register(null, false);*/

/*** specify extensions that may be loaded ***/
/* spl_autoload_extensions('.php');*/


spl_autoload_register('load_c');
spl_autoload_register('load_c_output');
spl_autoload_register('load_c_local');
spl_autoload_register('load_ca');
