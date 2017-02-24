<?php
/* 将【类里面的函数、函数、数组】转换成字符串 */
// 通过读取文件，然后截取这个function ，
/* 
function test($test_var0){$test_InnerVar_a='LOVE';return $test_InnerVar_a.$test_var0;}
function test2($test2_var0,$test2_var1){return 'TEST: '.$test2_var0.$test2_var1;}

func('test')==>返回 function test($test_var0){$test_InnerVar_a='LOVE';return $test_InnerVar_a.$test_var0;}

func('test','$return','$inner_var')  ==> 返回  $test_InnerVar_a='LOVE';$return=$test_InnerVar_a.$test_var0;

func('test2','$return2',array('$inner_var1','$inner_var2'))  ==> 返回  $return2='TEST: '.$inner_var1.$inner_var2;

×××××× 也可以对类里面的函数 ××××

func('obj2str->ifStrAddQuotes');  function ifStrAddQuotes($s){return is_string($s)?('\''.$s.'\''):$s;}
func('obj2str->ifStrAddQuotes','$class_return');   $class_return=is_string($s)?('\''.$s.'\''):$s
func('obj2str->ifStrAddQuotes','$class_return','$INNER_var');   $class_return=is_string($INNER_var)?('\''.$INNER_var.'\''):$INNER_var
 */


/*
 * func_return false /  string 【''  or 其他】
 *  如果 func_return = '' ，那么就取消  return，如果是其他字符串， 就把 return 赋值  $func_return，如是false，就不动
 * */


class CObj2Str {
    /*
     *  自定义类或者函数路径，每使用一次新的，都必须要new一下
     * 自定引入的class 或者 function 同名php文件包，或者单独一个php文件路径
     * path = 'E:/a/index.php'  直接引入这个文件
     * */
    static $path;


    function getRead($filename) { // 如果path 包含 . ，就是 path
        $CFile = new CFile();
        $file = self::$path . '/' . $filename . '.php';

        if (is_file($file)) {
            $r = $CFile->read($file);
            if ($r) {
                return $r;
            }

        }
        else { //is_file(self::$path)
            $r = $CFile->read(self::$path);
            if ($r) {
                return $r;
            }
        }

        var_dump(self::$path . '/' . $filename . '.php');
        exit(self::$path . ' or inside ' . self::$path . '/' . $filename . '.php is unreadable!');

    }


    /* 判断是字符串，还是整数 ==> 由于 arr() 里面多次调用了自己，所以里面不能再用内部function ，不然就Cannot redeclare ifStrAddQuotes() (previously declared 重复定义了 */
    function ifStrAddQuotes($s) {
        return is_string($s) ? ('\'' . $s . '\'') : $s;
    }

    function pregIfStrAddQuotes($var) { // 如 'localhost'    $var 由于特殊如 user pass db query_str 一定不能以 $开头，所以这里可以判断  【变量名必须以字母或下划线 "_" 开头，且只能是字母、数字、下划线】。否则的话，两边加上引号

        //  任何大写字母+下划线都是常量！  有些PHP常规变量   MYSQLI_ASSOC 等
        if (preg_match('/^[A-Z_]+$/', $var)) {
            return $var;
        }
        else if (preg_match('/^\s*(\$\w+)\s*$/', $var, $matches)) {
            return $matches[1];
        }
        else {
            return "'" . $var . "'";
        }


    }


    //将数组转化成相同的字符串  ，返回的是 array()  没有分号结尾（方便用于str_replace()替换）,也没有参数
    //参数型需要自定义
    //$arr= 数组
    function arr($arr) {
        $r = '';
        $i = 0;
        foreach ($arr as $x => $k) {
            $r .= ($i == $x) ? '' : ($this->ifStrAddQuotes($x) . '=>');
            if (is_array($k)) {
                $r .= $this->arr($k);
            }
            else {
                $r .= $this->ifStrAddQuotes($k);
            }
            $r .= ',';
            $i++;
        }
        $r = substr($r, 0, -1);
        $r = 'array(' . $r . ')';
        return $r;
    }

    /* 返回字符串开始，到成对的某个括号
    $str='function a($a_str){echo 'nove';function xx(){echo 'bb';} }
    function b(){}';

    getBracketsBlock($str)  返回 function a($a_str){echo 'nove';function xx(){echo 'bb';} }
    getBracketsBlock($str,'(',')') 返回 $a_str
    $inner_only =ture 表示只保持括号内部的内容
    */
    function getBracketsBlock($text, $inner_only = true, $left = '{', $right = '}') {
        // 这个压缩必须放在前面，避免注释里面包含 {} 等
        $CTrim = new CTrim();
        $text = $CTrim->all($text);

        // 防止正则里面的  \( \{ 等影响配对
        //$preg='\\'.$left.'\\'.$right;
        // $text=preg_replace('/\\\['.$preg.']/','  ',$text);
        // 采用判断function(){} 最后一个 }位置来截取
        $arr = str_split($text);
        $i = 0; // { 数量
        $j = 0; // } 数量
        $last = 0; // 最后一个 }位置
        foreach ($arr as $x => $char) {
            // 匹配 { 但是要避免正则里面的  \{ 等
            if ($char == $left && ($x = 0 || '\\' != $arr[$x - 1])) {
                $i++;
            }
            if ($x > 0 && $char == $right && '\\' != $arr[$x - 1]) {
                $j++;
            }
            // 匹配 } 但是要避免正则里面的  \} 等
            if ($j > 0 && $i == $j) {
                $last = $x;
                break;
            }
        }
        if ($last > 0) {

            if ($inner_only) {
                $first = strpos($text, $left) + 1;
                // 注意substr $last 是长度，不是 substring
                $last = $last - $first;
                $r = substr($text, $first, $last);
            }
            else {
                $last++;
                $r = substr($text, 0, $last);
            }

            // 对返回代码进行压缩

            return $r;
        }
        else {
            return false;
        }

    }


    function funcVarReplace($str, $old, $new) {
        // 参数里面一定没有空格，避免空格  ，但是由于有时候传递的不一定是参数，可能是字符串，所以保证首尾没有空格

        $old = str_replace(' ', '', $old);
        //$new=str_replace(' ','',$new);  ### $old （参数）一定没有空格，而 $new（参数或者字符串） 可能有空格


        // 判断是不是以$开头，之后替换第一个参数为新参数
        //$new=substr($new,0,1)=='$'?$new:('$'.$new);   由于可能传递的参数是字符串，所以不一定必须是参数
        // 避免 func ($var='xx', $var2)
        $old = explode('=', $old)[0];
        //替换第一个参数为新参数，要避免对正则里面的参数替换
        $old = str_replace('$', '\$', $old);
        // PHP 正则里面  \ 必须要用 \\\ 表示
        // 下面不能合并，否则出错， [^\\\]? 或者 [^\\\]* 及时遇到  \$function 也会符合条件
        $new = $this->pregIfStrAddQuotes($new);
        $str = preg_replace('/^\s*' . $old . '([^\w]+)$/', '$1' . $new . '$2', $str);
        $str = preg_replace('/([^\\\])' . $old . '([^\w]+)/', '$1' . $new . '$2', $str);
        return $str;
    }


    function readFunc($func) {
        $CFile = new CFile();
        $CTrim = new CTrim();

        // $func = 'obj2str->func'（在class目录下找）  或者 'is_utf8'（在function/目录下找）
        $class_func = strpos($func, '->');
        $class_func = empty($class_func) ? strpos($func, '::') : $class_func;

        if (!empty($class_func)) {
            $class = substr($func, 0, $class_func);
            /* $CFile->read 不能通过 obj2str-> 读取 obj2str里面的内容，所以需要重新写一个临时 */

            if ($class == __CLASS__) {

                $this_file = self::$path . '/' . __CLASS__ . '.php';
                $temp_file = $CFile->copyFile($this_file);
                $r = $CFile->read($temp_file);
                $CFile->del($temp_file);
            }
            else {
                $r = $this->getRead($class);
            }

            $class_func += 2;
            $func = substr($func, $class_func);
        }
        else {
            $class = '';
            $r = $this->getRead($class_func);
        }
        /*  将函数内函数标志替换掉 */
        /* 没有压缩， .+ 必须要用换行 */
        //$r = preg_replace('/\/\*(replaceCommentFunc_START)\s*(\{\s*[^\}]+\s*\})\s*\*\/.+?\/\*(replaceCommentFunc_END)\s*(\{\s*[^\}]+\s*\})\s*\*\//s', '$1$2$3$4', $r);

        // 这里必须先压缩，不然注释里面很可能用 function xxx(){}


        $r = $CTrim->php($r);
        //echo $r;
        return [$r, $class, $func];
    }

    /* 替换 function 内部的 function ，注意 memcache 必须要用类或函数
    如果返回false，就表示没有找到，也就不会进行内部函数替换，那么就不用再判断内部函数的内部，有没有内部函数了
    */

    function commentFuncArr($r, $return_arr = false) {
        $match = preg_match_all('/replaceCommentFunc_START\{([^\}]+)\}replaceCommentFunc_END\{([^\}]+)\}/', $r, $arr);

        return $return_arr ? array($match, $arr) : $match;
    }

    function replaceCommentFunc($r) {
        /* 上面 read的时候，已经先压缩，这样获取单个函数的内部、内部、内部，可以节省很多内存 */
        // 这里已经在 func_read 里面正则纠错过了  replaceCommentFunc_START(obj2str->ifStrAddQuotes)replaceCommentFunc_END(obj2str->ifStrAddQuotes)
        $check = $this->commentFuncArr($r, true);
        $match = $check[0];

        $arr = $check[1];


        if ($match) {

            $replaced_arr = $arr[0];
            // {memcache->aa}
            // {memcache->aa,$func_return}
            // {memcache->aa,$func_return,'$inner_var'}

            // {memcache->aa,$func_return,array('$inner_var0','$inner_var1')}

            $func_lefts = $arr[1];
            $func_rights = $arr[2];

            foreach ($replaced_arr as $i => $func_replaced) {
                // 上面整句
                $func_left = $func_lefts[$i];
                $func_right = $func_rights[$i];

                if ($func_left == $func_right) {

                    // 判断是否有逗号  {memcache->aa}   {memcache->aa,$return}  {memcache->aa,$return,inner_var} {memcache->aa,$return,array($var0,$var2……)

                    $func_vars = explode(',', $func_left);
                    if (isset($func_vars[2])) {
                        $replace_to = $this->funcOnce($func_vars[0], $func_vars[1], $func_vars[2]);
                    }
                    else if (isset($func_vars[1])) {
                        $replace_to = $this->funcOnce($func_vars[0], $func_vars[1]);
                    }
                    else {
                        $replace_to = $this->funcOnce($func_left);
                    }

                    $r = str_replace($func_replaced, $replace_to, $r);

                }

            }
            return $r;
        }
        else {
            return false;
        }
    }


    function func($class_func, $func_return = false, $func_var = false, $func_path = false) {
        if ($func_path) {
            self::$path = $func_path;
        }

        return $this->funcOnce($class_func, $func_return, $func_var);

        /* 使用局部函数，避免全局替换，之后再循环替换所有函数的内函数、内函数，就很慢了，这里就聚焦 */

        // 因为在$this->bracktes中用字符长度，所以后面的会被忽略，所以只需要去除开头，就可以了。
      /*

        $readFunc = $this->readFunc($class_func);

        $r = $readFunc[0];
        $func = $readFunc[1];
      $r = preg_replace('/^<\?php/', '', $r);
        // 从类中返回这个函数开头，到结尾，包括类的那个 }
        $r = preg_replace('/^.+function\s+(' . $func . ')\s*\(\s*([^\)]*)\s*\)[\t\n\r\s]*\{(.+)[\t\n\r\s]*\?>[\t\n\r\s]*$/', 'function $1($2){$3', $r);

        $r = $this->getBracketsBlock($r);

        // 如果没有找到replaceCommentFunc，就执行一次替换

        if ($this->commentFuncArr($r)) {


            while ($this->commentFuncArr($r)) {
                $r = $this->replaceCommentFunc($r);

                //if(!$r){echo '_____________________________';break;}
                //print_r($r);
                //echo "\n____\n";
                //break;
            }

            return $r;
        }
        else {


        }*/
    }


    function funcOnce($class_func, $func_return = false, $func_var = false, $func_path = false) {
        if ($func_path) {
            self::$path = $func_path;
        }
        $readFunc = $this->readFunc($class_func);
        $r = $readFunc[0];
        $class = $readFunc[1];
        $func = $readFunc[2];

        // $r=$this->replaceCommentFunc($r);


        // 因为在$this->bracktes中用字符长度，所以后面的会被忽略，所以只需要去除开头，就可以了。
        $r = preg_replace('/^<\?php/', '', $r);
        // 从类中返回这个函数开头，到结尾，包括类的那个 } ，同时要防贪婪


        // 这个正则必须包含 /s ，否则会出错，，同时要防贪婪如 echo $c_obj2str->func('obj2str->ifStrAddQuotes');
        $r = preg_match('/function\s+(' . $func . ')\s*\(\s*([^\)]*)\s*\)[\t\n\r\s]*\{.+$/s',  $r, $func_match);
        if(!$func_match){
            exit($class_func.' no function');
        }
        $r = $func_match[0];



        // 返回包括 function sss(){} 整体的结构
        $r = $this->getBracketsBlock($r, false);

        $r = preg_replace('/\s*function\s+' . $func . '\s*\(\s*([^\)]*)\s*\)[\t\n\r\s]*\{/s', 'function '.$func.'($1){', $r);


        /* 如果里面有 $this / self 就需要在里面 new 一下，而不是外面， 避免和外面的出现冲突 */
        if(preg_match('/(\$this|self)\s*[\:\-\>]{2}/', $r)){
            $r = preg_replace('/function\s+' . $func . '\([^\)]*\)\{/', '$0\$'.$class.'=new '. $class.'();', $r);
            $r = preg_replace('/(\$this|self)\s*([\:\-\>]{2})/', '\$'.$class.'$2', $r);
        }


        /*
        由于多个return的php，可能会因为忽略了else，无法正确识别，所以这个仅能对只有一个return的函数进行
        */
        if (is_string($func_return)) { // ''===$function_return 表示 取消 return


            // 获取 function xxx($var0,$var1……){} 参数数组
            $vars = preg_replace('/^function\s' . $func . '\(([^\)]*)\).+$/', '$1', $r);

            $var_arr = explode(',', $vars);


            /*
             * 由于多个return的php，可能会因为忽略了else，无法正确识别，所以这个仅能对只有一个return的函数进行
             * */
            preg_match_all('/[^\$\w]?return\s+/', $r, $return_matchs, PREG_SET_ORDER);
            $more_than_one_return = 1 < count($return_matchs);


            if ($more_than_one_return) { // 多个 return


                if ('' != $func_return) { // 判断是不是以$开头
                    $func_return = substr($func_return, 0, 1) == '$' ? $func_return : ('$' . $func_return);
                    $r .= $func_return . '=' . $func . '(';

                }
                else {
                    $r .= $func . '(';
                }

                if (isset($var_arr[0])) {
                    if (is_string($func_var)) {
                        $r .= $func_var;
                    }
                    else if (is_array($func_var)) {
                        $new_param = $vars;
                        foreach ($func_var as $i => $inner_var) {
                            // 避免 func ($var='xx', $var2)
                            $i = explode('=', $i)[0];
                            //替换第一个参数为新参数，要避免对正则里面的参数替换
                            $i = str_replace('$', '\$', $i);
                            $new_param = preg_replace('/(' . $i . '([\s,]+))|(' . $i . '$)/', $inner_var . '$2', $new_param);

                        }
                        $r .= $new_param;
                    }
                }

                $r .= ');';

            }
            else { // 只有一个return 或 没有return
                $r = $this->getBracketsBlock($r); // 获取 function (){} 大括号内部的

                if (isset($var_arr[0])) {
                    if (is_string($func_var)) {
                        $r = $this->funcVarReplace($r, $var_arr[0], $func_var);
                    }
                    else if (is_array($func_var)) {
                        foreach ($func_var as $i => $inner_var) {
                            $r = $this->funcVarReplace($r, $var_arr[$i], $inner_var);
                        }
                    }
                }


                // 上面已经将代码压缩过了，没有换行符了
                if ('' != $func_return) {
                    // 判断是不是以$开头
                    $func_return = substr($func_return, 0, 1) == '$' ? $func_return : ('$' . $func_return);
                    $r = preg_replace('/[^\$]return\s+/', $func_return . '=', $r);
                }
                else {
                    $r = preg_replace('/[^\$]return\s+/', '', $r);
                }

            }


        }

        return $r;
    }


}

?>