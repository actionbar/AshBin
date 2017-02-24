<?php


class c_file{

/* 判断文件是否是以 / 结尾，如果不是添加上，如果是就不需要添加 */
/*    function file_with_slash($file_str){
      return (!isset($file_str{1})||'/'==substr($file_str,-1))?$file_str:($file_str.'/');
   }
   
   
   // 将 __ 两个横线前缀的php 转换成html文件，把 ___ 三个横线的转成 php文件
   function file__name($file,$type='html'){
     $file=$this->file_with_slash($file);
     $url = $_SERVER['PHP_SELF']; 
	 if($type=='html'){$strrpos=3;}
	 if($type=='php'){$strrpos=4;}
	 // 因为  .php 是 4位长度，所以要 -4
     $filename=substr($url, strrpos($url , '/')+$strrpos,-4); 
	 //echo $file;
     return $file.$filename.'.'.$type;
   
   }
 */

    function fileExists($file){
        return file_exists($file);
    }
   function read($file){
      // file_get_contents 性能更高
      return file_exists($file)?file_get_contents($file):'';
   }
   
   /* 写入文件 */
   function write($file,$text){
      $fp=fopen($file,'w+');
      if(is_writable($file)==false) {die('File is not writeable...');exit;}
      else{file_put_contents($file,$text);}
   }
   
   function copy($file_old,$file_new){
      return copy($file_old,$file_new);
   }
   function del($file){
      if (file_exists($file)) {
       $result=unlink ($file);
  }
   
   
   }

   
   /* gz是压缩文件，不是压缩包，和 txt一样可读，而不可压缩文件。gz_class 代表压缩程度，最大是 w9 */
  function gz($file,$text,$gz_class='w9'){
    $gz=gzopen($file,$gz_class);
    gzwrite($gz,$text);
    gzclose($gz);
  }



/*
遍历当前目录下面文件，不遍历子目录 
  scandir('tpl')  遍历  tpl 目录下所有文件，及文件夹，不包括子文件夹下内容，会额外输出 .  ..
  glob('tpl/*')  可以正则遍历，也无法遍历子目录下内容
  glob('tpl/*.php')

$C_file->MenuFileArr()  返回 ['dirs'=[], 'files'=[]] 数组

*/


function paths($path){
    $dirs = [];
    $files = [];
    $globs = glob($path.'/*');
    foreach($globs as $single){
        if(is_dir($single)){
            $dirs[]= $single;
            $dirs = array_merge($dirs, $this->paths($single)['dirs']);
            $files = array_merge($files, $this->paths($single)['files']);
        }
        else{
            $files[] = $single;
        }
    }
    return ['dirs' => $dirs, 'files' => $files];
}


/* 
$make_path 生成的文件所在目录
$dirs 要生成的目录数组
$remove_pre 要生成目录数组去掉的前缀，如从 $C_file->Paths() 里面都会生成一个前缀，这里可以去掉
去掉母文件目录，只生成子目录的mkdir方式
*/
  function mkdirSubMenus($make_path, $dirs, $remove_pre = false){
    if($remove_pre){$pre_len = strlen($remove_pre) + 1;}
    foreach($dirs as $dir){
       if($remove_pre){$dir = substr($dir, $pre_len);}
       $dir = $make_path . '/' . $dir;
       if(!is_dir($dir)){
          mkdir($dir);
       }
    }
  }




/*
删除一个目录下所有内容
*/

function rmRf($path){
    $paths = $this->paths($path);
    $files = $paths['files'];
    $dirs = $paths['dirs'];
    $dirs = array_reverse($dirs);
    foreach($files as $file){
        if(!unlink($file)){
             die($file.' : File has not been deleted!');
        }
    }
    foreach($dirs as $dir){
          if(!rmdir($dir)){
             die($dir.' : Dir has not been deleted!');
          }
    }
}


}

?>