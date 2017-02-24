<?php

/**
 * 模板类，不涉及文件夹
 * 模板文件类型见  ../template.txt
 */
class CTpl{
    static $doTrim = true;
    static $docRoot = '';
    static $charset = 'utf-8'; // html 编码
    private $layout; // layout  由于这个不同页面需要经常变，所以用，不然下面判断 empty()的时候如果用static，会容易出错
    private $sh; // title
    private $sk; // keywords
    private $sd; // description

    /*
     * /tpl_embed/
        都是临时嵌入，不会用于生成
        embed('xxx.htm', Url::now, 'no')  将xxx.htm中 a 链接为 Url::now 的添加一个class="xxx no"
       注意： Url::now  和 'http://sso.luexu.com/i/' 都可以，但是不能用 {^Url::now}
        embed('xxx.htm', Url::now, 'no', 'li');  就是必须a 链接在 li里面
    */
    function embed($basename, $a_hover_href = false, $a_hover_class_add = false, $a_parent_node = false){
        $file = self::$docRoot . '/___/tpl_embed/' . $basename;
        $embed_html = $this->read($file);
        $embed_html = preg_replace('/^[^\w\'\"]*(\<\?php)/', '', $embed_html);
        $embed_html = preg_replace('/\?\>[^\w\'\"]*$/', '', $embed_html);
        if($a_hover_href && $a_hover_class_add){ // 引入 class="no" 等
            // preg_quote 只转义 正则表达式特殊字符有： . \ + * ? [ ^ ] $ ( ) { } = ! < > | : -，
            // 所以需要添加 /
            $preg_a_hover_href = preg_quote($a_hover_href, '/');
            $pattern_parent = $a_parent_node ? ('<' . $a_parent_node . '[^>]*>') : '';
            $pattern = '/(' . $pattern_parent . '<a\s+href\s*\=\s*\"' . $preg_a_hover_href . '\")([^>]+class=\"([^\"]*)\")?/';
            $replacement = '$1 class="$3 ' . $a_hover_class_add . '"';
            $embed_html = preg_replace($pattern, $replacement, $embed_html);
        }
        return $embed_html;

    }

    function script($urls){
        
        $urls = (array)$urls;
       
        $rtn = '';
        foreach($urls as $url){
            preg_match('/\.([a-z]+)(\?.*)?$/', $url, $ext_match);
            $ext = $ext_match[1];
            if($ext == 'css'){
                $script = '<link href="' . $url . '" rel="stylesheet" type="text/css">';
            }
            else if($ext == 'js'){
                $script = '<script type="text/javascript" src="' . $url . '"></script>';
            }
            else{
                $script = $url;
            }
            $rtn .= $script;
        }

        return $rtn;
    }

    function getShdk($sh = '', $sd = '', $sk = ''){ // head  description keywords
        $sh = empty($this->sh) ? $sh : $this->sh;
        $sd = empty($this->sd) ? $sd : $this->sd;
        $sk = empty($this->sk) ? $sk : $this->sk;
        $rt = '<title>' . $sh . '</title>';
        if(!empty($sd)){
            $rt .= '<meta name="description" content="' . $sd . '">';
        }
        if(!empty($sk)){
            $rt .= '<meta name="keywords" content="' . $sk . '">';
        }
        return $rt;
    }


    /**  对【key1,key2,key3,key4】进行搜索链接正则，多个链接
     *  本地将数据库含逗号的keywords,转成 <a href=""></a>形式
     *  $l =  http://e.v-get.com/s?sk=$1  替换所有 $1  $c_template->search_url($K,'http://e.v-get.com/s?sk=$1&sp=2');
     */
    function searchLink($s, $l){
        $r = '';
        $s = explode(',', $s); // 将多个关键词切割
        foreach($s as $ak => $k){
            // 数据库里面存储的 + 都是 %2B
            $kwd = str_replace('%2B', '+', $k);
            $r .= '<a href="' . str_replace('$1', $k, $l) . '">' . $kwd . '</a>';
        }
        return $r;
    }


    /* 对htm模板中的PHP代码转义，模板中使用 {^[^\s]+}  */
    function ysxCodeClass($str){

        /* 模板说明  {^  } 模板界定  --> 模板界定符内，禁止出现 {} 和 ，如果必须要传递，
           请用 $var 的外部方式传递
       */
        if(preg_match('/{\s*\^\s*[^\}]*[\{][^\}]*\s*\}/', $str, $ysx_delimiter_match)){
            throw new Exception(' there is a "{" in the block "{^  }" ---- ' . $ysx_delimiter_match[0]);
        }


        // 下面必须要  [^\{\}]  ，别人不知道界定
        preg_match_all('/{\s*\^\s*((\w+)\s*([:\-\>]{2})*\s*([^\{\}]+))\s*\}/', $str, $arr);

        $class = $arr[2];
        $is_static = $arr[3];
        $vars_funcs = $arr[4];
        $arr_len = $arr[1]; // 返回所有{^class::const}{^class->func()}
        $replaced_arr = array();
        foreach($arr_len as $i => $replace_all){
            if(!in_array($replace_all, $replaced_arr)){ // 避免重复替换，消耗性能
                if($is_static[$i] == '->'){
                    $cls = $class[$i];
                    $cls = new $cls();
                    $var_func = $vars_funcs[$i];
                    eval("\$replace_to = \$cls->$var_func;");
                }
                else{
                    eval("\$replace_to = $replace_all;");
                }
                $replacement = $arr[0][$i];
                $str = str_replace($replacement, $replace_to, $str);
                array_push($replaced_arr, $replace_all);
            }
        }
        return $str;
    }

    function ysxEchoVar($str){ // 对 {$var} 替换成 <?php echo $var;?》
        /*     <!--
             layoutA
             sh=<$sk>中国  【注释中可以使用 <> 来表示<?php echo xxx;?> 】
             sd=描述
             sk=关键词
             --> */
        return preg_replace('/{\s*(\$\w+[^\=\;\}\>\<]+)\s*}/', '<?php echo $1;?>', $str);

    }

    function read($file){
        $CFile = new CFile();
        $rtn = $CFile->read($file);
        // 对代码里面的 进行 vcode 替换成menu 或者 lang里面的内容
        $rtn = $this->ysxEchoVar($rtn);
        try{
            $rtn = $this->ysxCodeClass($rtn);
        } catch(Exception $e){
            echo 'CTpl->read() : file "', $file, '": ', $e->getMessage();
        }
        return $rtn;
    }

    private function layoutMatch($content){
        /*    <!--
                 layoutA  【如果不存在这个，那么就表示直接输出原文，如sitemap.xml】
                 sh=<$sk>中国  【注释中可以使用 <> 来表示<?php echo xxx;?> 】
                 sd=描述
                 sk=关键词
                 -->
        */
        preg_match('/[\s\r\t\n]*<!--[\s\r\t\n]*(layout[A-Z]\w*)(([\r\s\t\n]+\w+\s*\=\s*[^\r\n]+)*)[\s\r\t\n]*-->[\s\r\t\n]*/', $content, $match);

        if($match){
            if($match[2]){ // 有就开始
                $hdk = $match[2];
                preg_match_all('/(\w+)\s*=\s*([^\r\t\n]+)/', $hdk, $hdk_match);
                $hdk_indexs = $hdk_match[1];
                $hdk_keys = $hdk_match[2];
                foreach($hdk_indexs as $index => $hdk_index){
                    if($hdk_index == 'sh'){
                        $this->sh = $hdk_keys[$index];
                    }
                    if($hdk_index == 'sd'){
                        $this->sd = $hdk_keys[$index];
                    }
                    if($hdk_index == 'sk'){
                        $this->sk = $hdk_keys[$index];
                    }
                }
            }
            $this->layout = $match[1];
            return $match[0]; // 返回整个匹配，用于在<doc> 前面添加内容
        }

    }

    private function comtentScripts($content){
        /* 必须要指定 view后，在</body>后面插入 js才有意义*/
        preg_match_all('/<script(\stype\=\"text\/javascript\")?>[\r\s\t\n]*(([\r\s\t\n]*[^\r\n]*)*?)[\r\s\t\n]*<\/script>/U', $content, $js_match);
        $scripts = $js_match[0];
        $script_match_str = $js_match[2];
        $script_str = '';
        foreach($scripts as $script_index => $script){
            $content = str_replace($script, '', $content);
            $script_str .= $script_match_str[$script_index];
        }
        return [
            'content' => $content,
            'scripts' => $script_str
        ];
    }

    private function contentStyles($content){
        /* 必须要指定 view后，在</head>后面插入 css才有意义*/
        preg_match_all('/<style[^>]*>[\r\s\t\n]*(([\r\s\t\n]*[^\r\n]*)*?)[\r\s\t\n]*<\/style>/U', $content, $css_match);
        $styles = $css_match[0];
        $style_match_str = $css_match[1];
        $style_str = '';
        foreach($styles as $style_index => $style){
            $content = str_replace($style, '', $content);
            $style_str .= $style_match_str[$style_index];
        }
        return [
            'content' => $content,
            'styles' => $style_str
        ];
    }

    private function html($before_doctype, $embed_style = '', $embed_script = '', $head = '', $body = ''){
        $embed_style = empty($embed_style) ? '' : '<style type="text/css">' . $embed_style . '</style>';
        $embed_script = empty($embed_script) ? '' : '<script type="text/javascript">' . $embed_script . '</script>';

        return $before_doctype . '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta http-equiv="Content-type" content="text/html; charset=' . self::$charset . '">
              ' . $head . $embed_style . '
                </head>
                <body>' . $body . $embed_script . '
                </body>
              ';
    }

    /*
    $make_path 生成的文件所在目录
    $tpl_files  要生成的文件数组
    $remove_pre 要生成目录数组去掉的前缀，如从 $C_file->Paths() 里面都会生成一个前缀，这里可以去掉
    去掉母文件目录，只生成子目录的mkdir方式
    */
    function writes($make_path, $tpl_local_cls, $tpl_files, $remove_pre = false){
        $CFile = new CFile();
        $CTrim = new CTrim();

        if($remove_pre){
            $pre_len = strlen($remove_pre) + 1;
        }

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
            $layout_match = $this->layoutMatch($content);

            if($layout_match && !empty($this->layout)){
                //$content = str_replace($match[0], '', $content);  // 去掉开头注释
                $content_split = explode($layout_match, $content);
                $before_doctype = $content_split[0]; // 在 <!DOCTYPE html> 前面的代码
                $content = $content_split[1];
                $layout = $this->layout;

                $content_scripts = $this->comtentScripts($content);
                $content = $content_scripts['content'];
                $embed_script = $content_scripts['scripts'];

                $content_styles = $this->contentStyles($content);
                $content = $content_styles['content'];
                $embed_style = $content_styles['styles'];

                $head_body = $tpl_local_cls->$layout($content);
                $head = $head_body ['head'];
                $body = $head_body ['body'];

                $html = $this->html($before_doctype, $embed_style, $embed_script, $head, $body);
            }
            else{
                $html = $content; // 当 $match[1] 为空，或者没有match到的时候，就是不使用模板layout
            }


            // 如果模板文件是 php 的，那么就自动添加上 function __autoload($class){require $_SERVER['DOCUMENT_ROOT'] . '/_c/'. $class .'.php';}
            if('.php' == substr($file, -4)){
                $html = '<?php include \'' . self::$docRoot . '/_c.php\'; ?>' . $html;
            }


            if(self::$doTrim){
                $html = $CTrim->all($html);
            }
            if($remove_pre){
                $file = substr($file, $pre_len);
            }

            // echo $make_path . '/'. $file;
            $CFile->write($make_path . '/' . $file, $html);
        }
    }

}

?>