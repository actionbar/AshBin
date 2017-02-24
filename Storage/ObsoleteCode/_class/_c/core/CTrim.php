<?php
/**
 * 验证文件是否存在
 *
 */
class CTrim
{

    /* 删除换行符 */
    function removeNewlineCharacters($str)
    {
        //替换换行，注意\r \r\n 必须使用双引号，不能使用单引号，必须用双引号
        // PHP_EOL 常量，会自动判断平台，然后根据平台来添加，所以不适用取消所有平台产生的换行符
        return preg_replace("/\s*[\r\n\t]+\s*/", '', $str);
    }

    /*
     * 自定义的界定符
     * 避免使用正则符，只能使用符合   <_;`&#@_>
    */
    private  function selfDelimiter($tag)
    {
        return '<_;`&#@_>' . $tag . '<_;`&#@_>';
    }





    /*  为了在正则上保持原有的换行，
        换行不能使用 explode7
        用 preg_split('//s',$s); 来切分带换行的，但是会自动忽略换行符*/
    private function replaceNewlineMarks($str, $return_newline = false)
    {
        $newline_transfer_arr = array(
            "\n" => 'WindowsNewline',  // \n \t \r  must be enclosed in double quotation marks!
            "\t" =>'Tab',
            "\r" => 'MacNewline'
        );
        $newline_marks = array_keys($newline_transfer_arr);

        return $return_newline ? str_replace($newline_transfer_arr, $newline_marks, $str) : str_replace($newline_marks,$newline_transfer_arr, $str);
    }

    /*
 * keep newline marks, eg. <script> / <style> / <pre>
 * 用于对 html中 <script>fdsadf</script>、<style></style> <pre> </pre> 进行替换
 * 替换成 【自定义界定符】script type="javascript/text"【自定义界定符】
 */
    private function replaceScriptBlock($tag, $s)
    {


        $preg_tag = '/(<' . $tag . '[^>]*>)(.+?)(<\/' . $tag . '>)/s';
        /* 替换代替字符 */
        $replaced = $this->selfDelimiter($tag);
        preg_match_all($preg_tag, $s, $matches);
        $s = preg_replace($preg_tag, $replaced, $s);

        //$matches[0][0] 第一个匹配整体，$matches[0][1] 第二个整体
        //$matches[1][0] 第一个第一个小括号<pre>  $mathces[2][0] 第一个第二个小括号，也就是标签内部内容，

        //$r=$this->pregTagReturn($tag,$matches,$s);

        $r = array('trimedContent'=>$s, 'match'=>$matches);
        return $r;
    }


    /* 用于对 html中 js、css <pre> 还原 */
    /* $s 是已经替换后的标签 */
    private function recoverScriptBlock($tag, $matches, $s)
    {

        $Bcss = ('style' == $tag) ? TRUE : FALSE;
        $Bjs = ('script' == $tag) ? TRUE : FALSE;
        //$Bpre=('pre'==$tag)?TRUE:FALSE;
        // 注意preg_match 的 $matches 不同之处 $matches=array(array('<pre>','<pre class="php">'),array('内容1','内容2')【,array('</pre>','</pre>')】);
        $replaced = $this->selfDelimiter($tag);

        // 由于同时包含很多标签，所以不能在这里removeNewlineCharacters()换行，但是 换行不能使用 explode，所以需要替换
        //$s=$this->removeNewlineCharacters($s);
        // 用 preg_split('//s',$s); 来切分带换行的，但是会自动忽略换行符
        //$arr_s=preg_split('/'.$replaced.'/s',$s);
        $s = $this->replaceNewlineMarks($s);
        $arr_s = explode($replaced, $s);
        $r = $arr_s[0];
        // 这里是 $matches[2] ，$matches[0] 是全部
        $arr_txt = $matches[2];
        foreach ($arr_txt as $atxt => $txt) {
            $txt = $Bcss ? ($this->jsCss($txt)) : $txt;
            $txt = $Bjs ? ($this->jsCss($txt)) : $txt;
            //$txt=$Bpre?($this->pre($txt)):$txt;
            // 这里是 $matches[1] ，$matches[0] 是全部
            $tag_begin = $matches[1][$atxt];
            $tag_end = $matches[3][$atxt];
            $r .= $tag_begin . $txt . $tag_end . $arr_s[$atxt + 1];
        }

        $r = $this->replaceNewlineMarks($r, true);

        return $r;
    }



    /**
     * 去除php代码中的空白、注释、换行
     * @param string $str 代码内容
     * @return string
     * 分析php源码，这样直接对T_COMMENT、T_DOC_COMMENT 、T_WHITESPACE 去掉，就可以了，
     * 但是这个代码仅适合包含首尾标签完整的PHP代码
     * 如果是js、css、html、php 混合的代码，只能替换掉<？php ？> 部分内容
     * 包含其他代码，只替换<？php ？> 内容，其他代码换行符依旧保持
     */
    function php($str)
    {
        $s = '';
        $php_tag = true;
        // 这里必须要判断是不是完整的带 <？php ？>
        if (!preg_match('/^[\s\r\n\t]*<\?php.+\?>[\s\r\n\t]*$/', $str)) {
            $php_tag = false;
            $str = '<?php ' . $str . '?>';
        }

        $tokens = token_get_all($str);
        $last_space = false;
        for ($i = 0, $j = count($tokens); $i < $j; $i++) {
            if (is_string($tokens[$i])) {
                $last_space = false;
                $s .= $tokens[$i];
            } else {
                switch ($tokens[$i][0]) {
                    //过滤各种PHP注释
                    case T_COMMENT:
                    case T_DOC_COMMENT:
                        break;
                    //过滤空格
                    case T_WHITESPACE:
                        if (!$last_space) {
                            $s .= ' ';
                            $last_space = true;
                        }
                        break;
                    default:
                        $last_space = false;
                        $s .= $tokens[$i][1];
                }
            }
        }
        if (!$php_tag) {
            $s = preg_replace('/(^[\s\r\n\t]*<\?php)|(\?>[\s\r\n\t]*$)/', '', $s);
        }

        // 避免以后压缩的时候，导致的 <?php 换行问题，这里对 <?php 换行换成空格 <?php if
        $s = preg_replace('/([>]*)[\s\r\n\t]*<\?php[\s\r\n\t]+/', '$1<?php ', $s);

        return $s;
    }


    /* 删除 // /××/  注释
       不删除html 注释，避免<!-- if(ie6)-->  */
    function jsCss($str)
    {

        /* \n 需要放在双引号里面  */
        /* 防止 'http://e.v-get.com'
            background:url(http://e.v-get.com/);
            // 注释后面一定不能有 引号、括号
           */
        $str = preg_replace("/(\s*\/\/[^\n\r\'\")]*)?\s*[\n\t\r]+\s*/", '', $str);

        $str = preg_replace('/\/\*.*?\*\//', '', $str);
        $str = preg_replace('/;\}/', '}', $str);
        return $str;
    }


    /* 对混合型css/js/html/php 压缩 */
    function all($s)
    {
        // 所有替换都需要先把最开始和结束的换行符换掉！！！，否则会出错，尾部必须加 /s ，因为包含换行符
        $s = preg_replace('/^[\s\r\n\t]*([^\s\r\n\t].+[^\s\r\n\t])[\s\r\n\t]*$/s', '$1', $s);
        // 替换PHP 使用只能替换PHP的函数，而且要放在最开始
        $s = $this->php($s);
        $arr = array();
        $langs = array('pre');
        foreach ($langs as $la => $lang) {
            $x = $this->replaceScriptBlock($lang, $s);
            $s = $x['trimedContent'];
            $arr[$lang] = $x['match'];
        }


        // 替换掉所有 连续的PHP代码段
        $s = str_replace('?><?php ', '', $s);


        $s = $this->removeNewlineCharacters($s);  // 上面已经把出现换行的替换掉了，这里直接取消换行

        // 删除html 注释， <!--[if IE]> <![endif]--> <!--#require()-->（shtml  -和 #之间没有空格）
        $s = preg_replace('/<\!\-\-[^\[\#].*?-\-\>/', '', $s);

        $r[0] = $s;

        foreach ($arr as $tag => $matches) {

            $s = $this->recoverScriptBlock($tag, $matches, $s);
        }

        return $s;


    }








}


?>