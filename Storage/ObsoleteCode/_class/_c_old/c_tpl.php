<?php
/**
  * 模板类，不涉及文件夹
  * 模板文件类型见  ../template.txt  
  */


class c_tpl{
    static $SH;  // title
    static $SK;  // keywords
    static $SD;  // description

    function script($url, $ext = 'js'){
        if($ext == 'css'){return '<link href="'. $url .'" rel="stylesheet" type="text/css">';}
        return '<script type="text/javascript" src="'. $url .'"></script>';
    }
   
   function hdk(){  // head  description keywords
    $rt = '<title>'. self::$SH.'</title>';
    if(!empty(self::$SD)){$rt .= '<meta name="description" content="'. self::$SD .'">';}
    if(!empty(self::$SK)){$rt .= '<meta name="keywords" content="'. self::$SK .'">';}
    return $rt;
}
   
   
   
   
   
/**  对【key1,key2,key3,key4】进行搜索链接正则，多个链接 
 *  本地将数据库含逗号的keywords,转成 <a href=""></a>形式
 *  $l =  http://e.v-get.com/s?sk=$1  替换所有 $1  $c_template->search_url($K,'http://e.v-get.com/s?sk=$1&sp=2');
 */
   function search_link($s,$l){
      $r='';
      $s=explode(',',$s);  // 将多个关键词切割
      foreach($s as $ak=>$k){
         // 数据库里面存储的 + 都是 %2B
         $kwd=str_replace('%2B','+',$k);
         $r.='<a href="'.str_replace('$1',$k,$l).'">'.$kwd.'</a>';
      }
      return $r;
   }


/* 本地navigator   ，通过网站目录的 _/ global 设置 $nav*/
   function nav($nav_str, $no='',$class='no'){
   //$no='' 代表 index主页
   //$nav_str='<a href="http://localhost/sv_e.v-get.com/">首页</a><i></i><a href="http://localhost/sv_e.v-get.com/tech/">站长之家</a><i></i>';
   // 如果没有设置当前页面的文件名，那么就用路径获取法获取
    //$php_self = $_SERVER['PHP_SELF'];
    
    $filename=preg_replace('/^.+\/_+([\w-]+)\.[a-zA-Z]+$/','$1',$this->php_self);
    
    $no=isset($no{0})?$no:$filename;
    return preg_replace('/('.$no.'[^"]*")/','$1 class="'.$class.'"',$nav_str);
   }

  
   
   
 /* 对htm模板中的PHP代码转义，模板中使用 {>[^\s]+}  */     
function ysxCodeClass($str){
    preg_match_all('/{\s*[:：]\s*((\w+)\s*([:\->]{2})\s*([^\}]+))\s*\}/', $str, $arr);
    $class = $arr[2];
    $is_static = $arr[3];
    $vars_funcs = $arr[4];
    $arr_len=$arr[1];  // 返回所有{class::const}{class->func()}
    $replaced_arr=array();
    foreach($arr_len as $i => $replace_all){
    if(!in_array($replace_all, $replaced_arr)){  // 避免重复替换，消耗性能
        if($is_static[$i] == '::'){
            eval("\$replace_to = $replace_all;");
        }
        else{
            $cls = $class[$i];
            $cls = new $cls();
            $var_func = $vars_funcs[$i];
            eval("\$replace_to = \$cls->$var_func;");
        }
      $replacement = $arr[0][$i];  // {>class::xxx}  或者 {class::xxx}
              $str = str_replace($replacement, $replace_to, $str);
              array_push($replaced_arr, $replace_all);
    }
    }
  return $str;
}

function ysxCommentsEcho($str){  // 对注释中 <>  替换成 <?php echo xxx;?
/*     <!-- 
     layoutA  
     sh=<$sk>中国  【注释中可以使用 <> 来表示<?php echo xxx;?> 】
     sd=描述
     sk=关键词
     --> */
     return preg_replace('/<([^>]+)>/', '<?php echo $1;?>' ,$str);

}

function read($file){
    $C_file = new c_file();

    $rtn = $C_file->read($file);
    // 对代码里面的 进行 vcode 替换成menu 或者 lang里面的内容
    $rtn = $this->ysxCodeClass($rtn);
    return $rtn;
}


/*
$make_path 生成的文件所在目录
$tpl_files  要生成的文件数组
$remove_pre 要生成目录数组去掉的前缀，如从 $C_file->Paths() 里面都会生成一个前缀，这里可以去掉
去掉母文件目录，只生成子目录的mkdir方式
*/
function writes($make_path, $tpl_files, $remove_pre = false, $tplc_class = false){
    $C_file = new c_file();
    $C_trim = new c_trim();
    if(!$tplc_class){
        $tplc_class = new tplc_i();  // 默认是 tplc_i->viewA()
    }
    if($remove_pre){$pre_len = strlen($remove_pre) + 1;}

    foreach($tpl_files as $file){
        $content = $this->read($file);

/* 
 【全部可选】

【如果这个位置有内容，那么就放在<!DOCTYPE html> 前面，特别是如 $sk 的设定、session的启动】
    <!-- 
     layoutA  【如果不存在这个，那么就表示直接输出原文，如sitemap.xml】
     sh=<$sk>中国  【注释中可以使用 <> 来表示<?php echo xxx;?> 】
     sd=描述
     sk=关键词
     -->

     <script>
     <!--
     这里的js，都放在</body> 前面的文尾，如果是多个，那么就逐个叠加
     -->
     </script>

  <script>
     <!--
     这里的js，都放在</body> 前面的文尾，如果是多个，那么就逐个叠加
     -->
     </script>
     */

        preg_match('/[\s\r\t\n]*<!--[\s\r\t\n]*(layout[A-Z]+)(([\r\s\t\n]+\w+\s*\=\s*[^\r\n]+)*)[\s\r\t\n]*-->[\s\r\t\n]*/', $content, $match);

        if($match){
            if($match[2]){  // 有就开始
                $hdk = $match[2];
                preg_match_all('/(\w+)\s*=\s*([^\r\t\n]+)/', $hdk, $hdk_match);
                $hdk_indexs = $hdk_match[1];
                $hdk_keys = $hdk_match[2];
                foreach($hdk_indexs as $index => $hdk_index){
                    if($hdk_index == 'sh'){self::$SH = $this->ysxCommentsEcho($hdk_keys[$index]);}
                    if($hdk_index == 'sd'){self::$SD = $this->ysxCommentsEcho($hdk_keys[$index]);}
                    if($hdk_index == 'sk'){self::$SK = $this->ysxCommentsEcho($hdk_keys[$index]);}
                }
            }
        }

        if($match && !empty($match[1])) {
            //$content = str_replace($match[0], '', $content);  // 去掉开头注释
            $content_split = explode($match[0], $content);
            $before_doctype = $content_split[0]; // 在 <!DOCTYPE html> 前面的代码
            $content = $content_split[1];
            $layout = $match[1];


            /* 必须要指定 view后，在</body>后面插入 js才有意义*/
            preg_match_all('/<script[^>]*>[\r\s\t\n]*<!--(([\r\s\t\n]*[^\r\n]*)*?)-->[\r\s\t\n]*<\/script>/U', $content, $js_match);
            $scripts = $js_match[0];
            $script_match_str = $js_match[1];
            $script_str = '';
            foreach($scripts as $script_index=>$script){
                $content = str_replace($script, '', $content);
                $script_str .= $script_match_str[$script_index];
            }

            
            $html = $tplc_class->$layout($content, $before_doctype, $script_str);
        }
        else{
            $html = $content; // 当 $match[1] 为空，或者没有match到的时候，就是不使用模板layout
        }
        


   
   // 如果模板文件是 php 的，那么就自动添加上 function __autoload($class){require $_SERVER['DOCUMENT_ROOT'] . '/_c/'. $class .'.php';}
        if('.php' == substr($file, -4)){
            $html = '<?php function __autoload($class){require $_SERVER[\'DOCUMENT_ROOT\'] . \'/_c/\'. $class .\'.php\';} ?>' . $html;
        }



        //$html = $C_trim->mix($html);
        if($remove_pre){$file = substr($file, $pre_len);}

    // echo $make_path . '/'. $file;
        $C_file->write($make_path . '/'. $file, $html);
    }
}

}
?>