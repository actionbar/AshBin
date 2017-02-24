<?php
/**
 * Template, more in /Tpl/
 *
 * assign   == 指定的替换
 * assignPartial
 * render
 * renderPartial
 *
 */
namespace C;

class Tpl{
    public static $siteTitle;
    public $createDir; // created root
    public static $layoutFile;
    public static $tplRoot; //  /___/
    public static $doTrim = true;
    public static $charset = 'utf-8';
    private static $tplDir;
    private $sh; // title
    private $sk; // keywords
    private $sd; // description


    private function html($before_doctype, $embed_style = '', $embed_script = '', $head = '', $body = ''){
        $embed_style = empty($embed_style) ? '' : '<style type="text/css">' . $embed_style . '</style>';
        $embed_script = empty($embed_script) ? '' : '<script type="text/javascript">' . $embed_script . '</script>';
        return $before_doctype . '<!DOCTYPE html>
                <html>
                <head>
                    <meta http-equiv="Content-type" content="text/html; charset=' . self::$charset . '">
              ' . $head . $embed_style . '
                </head>
                <body>' . $body . $embed_script . '
                </body>
                </html>
              ';
    }

    /*    <!--
                     layoutA  【如果不存在这个，那么就表示直接输出原文，如sitemap.xml】
                     sh={>$sk}中国  【注释中可以使用 {>$sk} 来表示<?php echo xxx;?> 】
                     sd=描述
                     sk=关键词
                     -->
            */
    private function layoutMatch($content){

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

    // head  description keywords
    public function getShdk(){

        $sh = empty($this->sh) ? self::$siteTitle : $this->sh;
        $rt = '<title>' . $sh . '</title>';
        if(!empty($this->sd)){
            $rt .= '<meta name="description" content="' . $this->sd . '">';
        }
        if(!empty($this->sk)){
            $rt .= '<meta name="keywords" content="' . $this->sk . '">';
        }
        return $rt;
    }

    private function splitJs($content){
        /* 必须要指定 view后，在</body>后面插入 js才有意义
            如果是 <script> 就直接放到尾部，如果是<script type=""> 就保持原位

        */
        preg_match_all('/<script>[\r\s\t\n]*(.+?)[\r\s\t\n]*<\/script>/U', $content, $js_match);
        $scripts = $js_match[0];
        $script_match_str = $js_match[1];
        $script_str = '';
        foreach($scripts as $script_index => $script){
            $content = str_replace($script, '', $content);
            $script_str .= $script_match_str[$script_index];
        }
        return [
            'content' => $content,
            'js' => $script_str
        ];
    }

    private function splitCss($content){
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
            'css' => $style_str
        ];
    }


    /**
     *  <{var}>
     */
    public function assignPartial($file, array $arr){
        $text = file_get_contents($file);
        foreach($arr as $i => $k){
            $i = '<{' . $i . '}>';
            $text = str_replace($i, $k, $text);
        }
        return $text;
    }

    /*
  * include
  * all include file  ==> /tpl_inc/
  * inc('xxx.htm', Url::now, 'no')  将xxx.htm中 a 链接为 Url::now 的添加一个class="xxx no"
    注意： Url::now  和 'http://sso.luexu.com/i/' 都可以，但是不能用 {^Url::now}
     inc('xxx.htm', Url::now, 'no', 'li');  就是必须a 链接在 li里面

    inc('sso/aa')  == >  inc('sso/aa.tpl')
  * */

    public function inc($basenames, $a_hover_href = false, $a_hover_class_add = false, $a_parent_node = false){
        $basenames = (array)$basenames;
        $rtn = '';

        foreach($basenames as $basename){
            if(!preg_match('/\.\w+$/', $basename)){
                $basename .= '.tpl';
            }

            $file = self::$tplRoot . '/tpl_inc/' . $basename;
            $include_text = $this->render($file);
            $include_text = preg_replace('/^[^\w\'\"]*(\<\?php)/', '', $include_text);
            $include_text = preg_replace('/\?\>[^\w\'\"]*$/', '', $include_text);
            if($a_hover_href && $a_hover_class_add){ // 引入 class="no" 等
                // preg_quote 只转义 正则表达式特殊字符有： . \ + * ? [ ^ ] $ ( ) { } = ! < > | : -，
                // 所以需要添加 /
                $preg_a_hover_href = preg_quote($a_hover_href, '/');
                $pattern_parent = $a_parent_node ? ('<' . $a_parent_node . '[^>]*>') : '';
                $pattern = '/(' . $pattern_parent . '<a\s+href\s*\=\s*\"' . $preg_a_hover_href . '\")([^>]+class=\"([^\"]*)\")?/';
                $replacement = '$1 class="$3 ' . $a_hover_class_add . '"';
                $include_text = preg_replace($pattern, $replacement, $include_text);
            }
            $rtn .= $include_text;
        }
        unset($basenames);
        return $rtn;
    }

    /*
     * embed script / css / video
     *
     * */
    public function embed($urls){
        $urls = (array)$urls;
        $rtn = '';
        foreach($urls as $url){
            preg_match('/\.([a-z]+)(\?.*)?$/', $url, $ext_match);
            $ext = strtolower($ext_match[1]);
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
        unset($urls);
        return $rtn;
    }



    /*
   * output variable directly
   * {>$var}   ==>  <?php echo $var;?>
   * {>PHP_EOL}
   *
   * */

    /*     <!--
         layoutA
         sh={>$sk}中国  【注释中可以使用 <> 来表示<?php echo xxx;?> 】
         sd=描述
         sk=关键词
         --> */
    public function replaceEcho($str){
        return preg_replace('/{[\r\s\t\n]*\>[\r\s\t\n]*([^\s\{\}]+)[\r\s\t\n]*}/', '<?php echo $1;?>', $str);
    }


    public function render($file){

        $text = file_get_contents($file);
        // 对代码里面的 进行 vcode 替换成menu 或者 lang里面的内容
        $text = $this->replaceEcho($text);
        $text = $this->sysAssign($text);

        return $text;
    }


    /*
     *  {<class::const}
        {<class::$var}
        {<class::func()}
        {<c_tpl->script('ss')}
     *
     * */
    public function sysAssign($str){

        /* 模板说明  {^  } 模板界定  --> 模板界定符内，禁止出现 {} 和 ，如果必须要传递，
           请用 $var 的外部方式传递
       */
        if(preg_match('/{[\r\s\t\n]*\<[\r\s\t\n]*[^\}]*[\{][^\}]*[\r\s\t\n]*\}/', $str, $ysx_delimiter_match)){
            exit(' there is a "{" or "}" in the block "{<  }" ---- ' . $ysx_delimiter_match[0]);
        }


        // 下面必须要  [^\{\}]  ，别人不知道界定
        preg_match_all('/\{[\r\s\t\n]*\<[\r\s\t\n]*(([\w\\\]+)*[\r\s\t\n]*([:\-\>]{2})*[\r\s\t\n]*([^\{\}\|]+))([\r\s\t\n]*\|[\r\s\t\n]*(\w+))?[\r\s\t\n]*\}/', $str, $arr);


        $replacements = $arr[0];
        $arr_len = $arr[1]; // 返回所有class::const  或  class->func()
        $class = $arr[2];
        $is_static = $arr[3];
        $vars_funcs = $arr[4];
        $build_in_funcs = $arr[6]; // strtolower / strtoupper / ucfirst / ucwords

        $replaced_arr = array();
        foreach($arr_len as $i => $replace_all){
            if(!in_array($replace_all, $replaced_arr)){ // 避免重复替换，消耗性能
                if($is_static[$i] == '->'){
                    $var_func = $vars_funcs[$i];
                    $cls = $class[$i];
                    if(empty($cls) || $cls == '\C\Tpl'){
                        eval("\$replace_to = \$this->$var_func;");
                    }
                    else{
                        $cls = new $cls();
                        eval("\$replace_to = \$cls->$var_func;");
                    }

                }
                else{
                    eval("\$replace_to = $replace_all;");
                    /*  if('/' == substr($replace_to, 0,1) && 'Url' == substr($replace_all,0,3)){
                          $url_class = explode('::', $replace_all)[0];
                          $url_server_http_host = $url_class::_;
                          $replace_to = $url_server_http_host . $replace_to;
                      }*/


                }

                $build_in_func = $build_in_funcs[$i];
                if(!empty($build_in_func)){
                    $replace_to = $build_in_func($replace_to);
                }

                $replacement = $replacements[$i];
                $str = str_replace($replacement, $replace_to, $str);
                array_push($replaced_arr, $replace_all);
            }
        }
        return $str;
    }

    /*
     * create nessarry dirs
     *
     * */

    public function globCreateDirsThenGetTplFiles(){
        $TplFile = new \C\Tpl\File();
        self::$tplDir = self::$tplRoot . '/tpl';
        $tpl_paths = $TplFile->globPaths(self::$tplDir);
        $tpl_dirs = $tpl_paths['dirs'];

        //$TplFile->clearDir($this->createDir); // 删除生成文件夹下所有文件

        // 生成模板文件夹下所有目录
        $TplFile->createDirs($this->createDir, $tpl_dirs, self::$tplDir);
        return $tpl_paths['files'];
    }

    /*
    $make_path 生成的文件所在目录
    $tpl_files  要生成的文件数组
    $remove_pre 要生成目录数组去掉的前缀，如从 $C_file->Paths() 里面都会生成一个前缀，这里可以去掉
    去掉母文件目录，只生成子目录的mkdir方式
    */
    public function create(){
        $tpl_files = $this->globCreateDirsThenGetTplFiles();
        $TplTrim = new \C\Tpl\Trim();
        foreach($tpl_files as $file){
            $content = $this->render($file);

            $layout_match = $this->layoutMatch($content);

            if($layout_match && !empty($this->layout)){
                //$content = str_replace($match[0], '', $content);  // 去掉开头注释
                $content_split = explode($layout_match, $content);
                $before_doctype = $content_split[0]; // 在 <!DOCTYPE html> 前面的代码
                $content = $content_split[1];
                $layout = $this->layout;

                $content_scripts = $this->splitJs($content);
                $content = $content_scripts['content'];
                $embed_script = $content_scripts['js'];

                $content_styles = $this->splitCss($content);
                $content = $content_styles['content'];
                $embed_style = $content_styles['css'];


                $head_pre = $this->getShdk();
                $head_body = self::$layoutFile->$layout($head_pre, $content);
                $head = $head_body ['head'];
                $body = $head_body ['body'];

                $html = $this->html($before_doctype, $embed_style, $embed_script, $head, $body);
            }
            else{
                $html = $content; // 当 $match[1] 为空，或者没有match到的时候，就是不使用模板layout
            }


            /*   // 如果模板文件是 php 的，那么就自动添加上 function __autoload($class){require $_SERVER['DOCUMENT_ROOT'] . '/_c/'. $class .'.php';}
               if('.php' == substr($file, -4)){
                   $html = '<?php include \'' . self::$docRoot . '/_c.php\'; ?>' . $html;
               }*/


            if(self::$doTrim){
                $html = $TplTrim->all($html);
            }

            $pre_len = strlen(self::$tplDir) + 1;


            $file = substr($file, $pre_len);
            // 去掉 .tpl 后缀，如果没有后缀，那么就直接输出该类型
            $file = preg_replace('/\.tpl$/', '', $file);

            // echo $make_path . '/'. $file;
            file_put_contents($this->createDir . '/' . $file, $html);
        }
    }


} 