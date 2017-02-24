<?php
/**
 * 验证文件是否存在
 * 
 * @param 类型 变量名*
 * @param string $dir_path
 * @return 返回类型或变量  注释*
 * @return mix  对混合型css/js/html/php 压缩
 * @return css 对css压缩
 * @return js
 * @return html
 * @return php
 * @return removeLine() 删除\s*[\r\t\n]+\s*
 *
 */

class c_trim{

/**
 * 去除php代码中的空白、注释、换行
 * @param string $str 代码内容
 * @return string
 * 分析php源码，这样直接对T_COMMENT、T_DOC_COMMENT 、T_WHITESPACE 去掉，就可以了，
 * 但是这个代码仅适合包含首尾标签完整的PHP代码
 * 如果是js、css、html、php 混合的代码，只能替换掉<？php ？> 部分内容
 * 包含其他代码，只替换<？php ？> 内容，其他代码换行符依旧保持
 */
 function php($str) {
    $s='';
	$php_tag=true;
	// 这里必须要判断是不是完整的带 <？php ？>
	if(!preg_match('/^[\s\r\n\t]*<\?php.+\?>[\s\r\n\t]*$/',$str)){
	$php_tag=false;
	$str='<?php'.$str.'?>';}
	
    $tokens=token_get_all($str);
    $last_space=false;
    for ($i=0,$j=count($tokens);$i<$j;$i++) {
        if (is_string($tokens[$i])) {$last_space=false;$s.=$tokens[$i];}
		else {
            switch ($tokens[$i][0]) {
                //过滤各种PHP注释
                case T_COMMENT:
                case T_DOC_COMMENT:
                    break;
                //过滤空格
                case T_WHITESPACE:if (!$last_space){$s.=' ';$last_space=true;}break;
                default:$last_space=false;$s.= $tokens[$i][1];
            }
        }
    }
	if(!$php_tag){
	 $s=preg_replace('/(^[\s\r\n\t]*<\?php)|(\?>[\s\r\n\t]*$)/','',$s);
	}
	
    return $s;
 }





/* 删除 // /××/  注释 
   不删除html 注释，避免<!-- if(ie6)-->  */   
   function js_css($str){
   
   /* \n 需要放在双引号里面  */
   /* 防止 'http://e.v-get.com'
       background:url(http://e.v-get.com/);
       // 注释后面一定不能有 引号、括号
      */
   $str=preg_replace("/(\s*\/\/[^\n\r\'\")]*)?\s*[\n\t\r]+\s*/",'',$str);
   
   $str=preg_replace('/\/\*.*?\*\//','',$str);
   $str=preg_replace('/;\}/','}',$str);
   return $str;
   }

   function js($s){return $this->js_css($s);}
   function css($s){return $this->js_css($s);}





/* 对混合型css/js/html/php 压缩 */
   function mix($s){
   // 所有替换都需要先把最开始和结束的换行符换掉！！！，否则会出错，尾部必须加 /s ，因为包含换行符
   $s=preg_replace('/^[\s\r\n\t]*([^\s\r\n\t].+[^\s\r\n\t])[\s\r\n\t]*$/s','$1',$s);
   // 替换PHP 使用只能替换PHP的函数，而且要放在最开始
   $s=$this->php($s);
   $arr=array();
   $langs=array('style','pre','script');
   foreach($langs as $la=>$lang){
      $x=$this->mixPre($lang,$s);
      $s=$x[0];
      $arr[$lang]=$x[1];
   }
   $s=$this->removeLine($s);
   
   // 删除html 注释， <!--[if IE]> <![endif]--> <!--#require()-->（shtml  -和 #之间没有空格）
   $s=preg_replace('/<\!\-\-[^\[\#].*?-\-\>/','',$s);
   
   $r[0]=$s;
   
   foreach($arr as $tag=>$matches){
   $s=$this->mixPreReturn($tag,$matches,$s);
   }
   
   return $s;
   
   
   }
/* 避免使用正则符，只能使用符合   <_;`&#@_>  */
   function replacedTag($tag){return '<_;`&#@_>'.$tag.'<_;`&#@_>';}

/* 用于对 html中 js、css <pre> 替换 */
   function mixPre($tag,$s){
   
 
 
  $preg_tag='/(<'.$tag.'[^>]*>)(.+?)(<\/'.$tag.'>)/s';
   /* 替换代替字符 */
   $replaced=$this->replacedTag($tag);
   $p=preg_match_all($preg_tag,$s,$matches);
   $s=preg_replace($preg_tag,$replaced,$s);
   
   //$matches[0][0] 第一个匹配整体，$matches[0][1] 第二个整体
   //$matches[1][0] 第一个第一个小括号<pre>  $mathces[2][0] 第一个第二个小括号，也就是标签内部内容，
   
   //$r=$this->pregTagReturn($tag,$matches,$s);
   
   $r=array($s,$matches);
   return $r;
   }
   
   
/* 用于对 html中 js、css <pre> 还原 */   
/* $s 是已经替换后的标签 */
   function mixPreReturn($tag,$matches,$s){
   
   $Bcss=('style'==$tag)?TRUE:FALSE;
   $Bjs=('script'==$tag)?TRUE:FALSE;
   //$Bpre=('pre'==$tag)?TRUE:FALSE;
   // 注意preg_match 的 $matches 不同之处 $matches=array(array('<pre>','<pre class="php">'),array('内容1','内容2')【,array('</pre>','</pre>')】);
   $replaced=$this->replacedTag($tag);
   
   // 由于同时包含很多标签，所以不能在这里removeLine()换行，但是 换行不能使用 explode，所以需要替换
   //$s=$this->removeLine($s);
   // 用 preg_split('//s',$s); 来切分带换行的，但是会自动忽略换行符
   //$arr_s=preg_split('/'.$replaced.'/s',$s);
   $s=$this->changeLine($s);
   $arr_s=explode($replaced,$s);
   $r=$arr_s[0];
   // 这里是 $matches[2] ，$matches[0] 是全部
   $arr_txt=$matches[2];
   foreach($arr_txt as $atxt=>$txt){
   $txt=$Bcss?($this->js_css($txt)):$txt;
   $txt=$Bjs?($this->js_css($txt)):$txt;
   //$txt=$Bpre?($this->pre($txt)):$txt;
   // 这里是 $matches[1] ，$matches[0] 是全部
   $tag_begin=$matches[1][$atxt];
   $tag_end=$matches[3][$atxt];
   $r.=$tag_begin.$txt.$tag_end.$arr_s[$atxt+1];
   }
  
   $r=$this->changeLine($r,true);
  
   return $r;
   }
   
/* 删除多余空格和 \r \n，需要兼容 */
   function removeLine($removeLine_var0){
        //替换换行，注意\r \r\n 必须使用双引号，不能使用单引号，必须用双引号
        $removeLine_var0=preg_replace("/\s*[\r\n\t]+\s*/",'',$removeLine_var0);
		return $removeLine_var0;
   }
   
/*  为了在正则上保持原有的换行，
    换行不能使用 explode
	用 preg_split('//s',$s); 来切分带换行的，但是会自动忽略换行符*/
   function changeLine($changeLine_var0,$changeLine_var1=false){
   // 换行 \n 必须用双引号
   $old=array("\n","\t","\r");
   /* 避免使用正则符，只能使用符合   <_;`&#@_>   */
   $new=array('<_;`&#@_>NEW_LINE<_;`&#@_>','<_;`&#@_>NEW_TAB<_;`&#@_>','<_;`&#@_>NEW_R<_;`&#@_>');
   
   $changeLine_var0=$changeLine_var1?str_replace($new,$old,$changeLine_var0):str_replace($old,$new,$changeLine_var0);
   return $changeLine_var0;
   }

}


?>