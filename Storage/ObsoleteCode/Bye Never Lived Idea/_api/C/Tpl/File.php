<?php


namespace C\Tpl;


class File{

    /*
        getcwd()  得当前工作目录,在某些 Unix 的变种下，如果任何父目录没有设定可读或搜索模式，即使当前目录设定了，getcwd() 还是会返回 FALSE。

    */


    /*
     * 返回文件格式 fifo，char，dir，block，link，file 和 unknown
     * */
    function type($file){
        //filetype() 要判断文件是否存在，
        //返回格式 fifo，char，dir，block，link，file 和 unknown。错误则返回 FALSE 。
        return filetype($file);
    }

    /*
     * 返回文件扩展名
     * */
    function ext($file){

    }

    /*
     * 返回文件信息
     * */
    function size($file){
        return filesize($file);
    }

    /*
     * 文件最后修改时间
     * */
    function time($file){
        return filemtime($file);
    }


    /*
        is_file 只判断文件是否存在
        file_exists 判断文件是否存在或者是目录是否存在
        is_dir 判断目录是否存在.
        文件存在的情况下，is_file比file_exists要快N倍；
        文件不存在的情况下，is_file比file_exists要慢；但可以忽略不计。
    */

    function read($file){
        // is_readable() 函数用于检查文件和目录是否可读
        return file_get_contents($file);
    }


    /*
     * fwrite：向文件写入内容，可安全用于二进制文件 。
     * file_put_contents：向文件写入内容，等同依次调用 fopen，fwrite 以及 fclose 函数。
     * */
    /* 写入文件 */
    function write($file, $text){
        fopen($file, 'w+');
        if(is_writable($file))
            file_put_contents($file, $text);
        else
            die('CFile.write() : ' . $file . ' is unwriteable...');

    }

    function copyFile($file, $copy_to = false){
        if(!$copy_to){ // 将写入系统临时文件夹，返回临时文件名
            // $tempdir = sys_get_temp_dir();
            $copy_to = tempname(); //在指定目录中建立一个具有唯一文件名的文件。如果该目录不存在，tempnam() 会在系统临时目录中生成一个文件，并返回其文件名。
        }

        copy($file, $copy_to);
        return $copy_to;
    }


    /*
     * delete a file
     * 如果文件不存在，就不删除，也不报错
     */

    function del($file){
        if(is_file($file) && !unlink($file))
            die('CFile.del() : cant create ' . $file);
    }


    /* gz是压缩文件，不是压缩包，和 txt一样可读，而不可压缩文件。gz_class 代表压缩程度，最大是 w9 */
    function gz($file, $text, $gz_class = 'w9'){
        $gz = gzopen($file, $gz_class);
        gzwrite($gz, $text);
        gzclose($gz);
    }


    /*  显示隐藏文件 如 .svn .htaccess*/

    /*    function paths($path){
            $dirs = [];
            $files = [];
            $file = '';

            if($handle = @opendir($path)){
                $dirs[] = $path;

                while (($file = readdir($handle))){
                    if($file!='.' && $file!='..'){
                        $arr2=paths($path.'/'.$file);
                        $dirs = array_merge($dirs, $arr2['dirs']);
                        $files = array_merge($files, $arr2['files']);

                    }
                }
                closedir($handle);
            }else{
                $files[] = $path;
            }


            return ['dirs' => $dirs,'files' => $files];
        }*/


    /*
    遍历当前目录下面文件，不遍历子目录
     【glob 性能最好，其次glob的数组是按照顺序排列的，被用在 CFile->delDir() 里面，按照倒叙删除
     Linux 下， . 开头的文件，如 .svn  .htaccess 是隐藏文件，不被显示，glob 也不显示这些文件
    】



      scandir('tpl')  遍历  tpl 目录下所有文件，及文件夹，不包括子文件夹下内容，会额外输出 .  ..
      glob('tpl/*')  可以正则遍历，也无法遍历子目录下内容
      glob('tpl/*.php')

    $C_file->MenuFileArr()  返回 ['dirs'=[], 'files'=[]] 数组

    */
    function globPaths($dir){
        $dirs = [];
        $files = [];
        $traversal = glob($dir . '/*');
        foreach($traversal as $single){
            if(is_dir($single)){
                $dirs[] = $single;
                $arr = $this->globPaths($single);
                $dirs = array_merge($dirs, $arr['dirs']);
                $files = array_merge($files, $arr['files']);
            }
            else{
                $files[] = $single;
            }
        }
        return [
            'dirs' => $dirs,
            'files' => $files
        ];
    }

    /*
     * create a directory
     * 如果文件夹存在，就不生成，也不报错
     */
    function createDir($dir){
        if(!is_dir($dir) && !mkdir($dir))
            die('CFile.createDir() : cant create ' . $dir);
    }

    /*
     * delete a directory
     * 如果文件夹不存在，就不删除，也不报错
     */
    function delDir($dir){
        if(is_dir($dir) && !rmdir($dir))
            die($dir . ' : Dir has not been deleted!');
    }

    /*
    $parent_dir 生成的文件所在目录
    $dir_names 要生成的目录数组
    $remove_pre 要生成目录数组去掉的前缀，如从 $C_file->paths() 里面都会生成一个前缀，这里可以去掉
    去掉母文件目录，只生成子目录的mkdir方式
    */
    function createDirs($parent_dir, $dir_names, $remove_pre = false){
        if($remove_pre !== false){
            $pre_len = strlen($remove_pre) + 1;
        }
        foreach($dir_names as $dir){
            if($remove_pre){
                $dir = substr($dir, $pre_len);
            }
            $dir = $parent_dir . '/' . $dir;
            if(!is_dir($dir)){
                mkdir($dir);
            }
        }
    }


    /*
    删除一个目录下所有内容
    */

    function clearDir($dir){
        $paths = $this->globPaths($dir);
        $files = $paths['files'];
        $dirs = $paths['dirs'];
        $dirs = array_reverse($dirs);
        foreach($files as $file){
            unlink($file);
        }
        foreach($dirs as $dir){
            rmdir($dir);
        }
    }
} 