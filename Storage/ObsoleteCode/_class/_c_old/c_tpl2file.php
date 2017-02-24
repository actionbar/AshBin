<?php
/**
  * 本地文件夹控制类
  */
class c_tpl2file{
    public static $DOCUMENT_ROOT;  // $_SERVER['DOCUMENT_ROOT']
    public static $PHP_SELF;  // $_SERVER['PHP_SELF']
    public static $WEB_ROOT_DIRNAME;  // 网站根目录，/sv_e.v-get.com 
    public static $WEB_ROOT_DIRECTORY;   //网站根目录详细路径  E:/sv_e.v-get.com
    public static $WEB_ROOT_DIRECTORY_GLOBAL_ARRAY;   // 网站根目录下 E:/sv_e.v-get.com/_   所有公用文件夹
   
    function __construct(){
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        self::$DOCUMENT_ROOT = $document_root;
        self::$PHP_SELF = $_SERVER['PHP_SELF'];
        $web_root_dirname = $this->web_root_dirname();
        self::$WEB_ROOT_DIRNAME = $web_root_dirname;
        self::$WEB_ROOT_DIRECTORY = $document_root . '/' . $web_root_dirname;
        self::$WEB_ROOT_DIRECTORY_GLOBAL_ARRAY = $this->web_root_directory_global_array();
    }
   
    function web_root_dirname(){  // 网站根目录，/sv_e.v-get.com   ==>  /sv_e.v-get.com   ___upload/sv_e.v-get.com
        $php_self = self::$PHP_SELF;
        $dirname_slash_pos = strpos($php_self, '/', 1);   //    第二个 / 位置，/sv_e.v-get.com/_/_global.php
        // 返回  /sv_e.v-get.com    或者  localhost/index.php  直接返回  /
        
        return ($dirname_slash_pos > 1)?substr($php_self, 0, $dirname_slash_pos):'/';
       
        }
   
    function web_root_directory_global_array(){   // 网站根目录下 _   所有公用文件夹
        $web_root_directory = self::$WEB_ROOT_DIRECTORY;
        $root = $web_root_directory . '/_';
        $arr['root'] = $root;
        
        $arr['_remote_server_config'] = $root . '/___remote_server_config.php';
        
        
        $arr['_var'] = $root . '/var/index.php';
        $arr['class'] = $root . '/class';
        $tempalte = $root . '/template';
        $arr['template'] = $tempalte;
        $arr['template_i'] = $tempalte . '/i';  // 模板根文件夹
        return $arr;
    }
   
   
   function all_sure_iframes_and_files_list($files){
      if(isset($_GET['sure'])){
          foreach($files as $i=>$v){
          //因为经常localhost和 远程共用，所以会出现用Localhost生成的__.html是localhost路径，这里对于需要直接修改单个页面的，需要重新修改一次右侧
          //用 rightok 就可以避免内页单独更新时需要独立更新一次 __.php了
             echo '<iframe src="',$i,'?sure=ok&rightok=ok" style="width:80px;height:80px;border:0" scrolling="auto"></iframe>';
          }
      echo '<p>等待加载完毕，看ico图标，加载完毕后再跳转！！！</p></p><p>tech/i.php  f.php i2.php ig.php 必须要先修改tech/_.php之后生成的.html之后，修改完这个html之后，再修改 ，请到页面内对照tech/f.php 修改 tech/_.html</p>';
      }
	  
	  echo '<h2><a href="?sure=ok">确定更新所有的页面？</a></h2><hr>';
      foreach($files as $i=>$v){echo '<p><a href="',$i,'">',$v,'</a></p>';}
	  
   }
   

   
   function create_to_upload_or_local(){
      
      if(isset($_GET['createto'])){
         if(!is_writable($this->file_require_create_to_upload_or_local)){
		    die($this->file_require_create_to_upload_or_local.'文件没有找到');
		  }
         else {
		    $create_to=$_GET['createto'];
            if($create_to==''||$create_to=='local'){
               $text="<?php \n/**  生成文件在本地 \n  *  这里通过 /global/class/refresh2createfile.php 页的按钮生成，判断生成的文件在本地，还是服务器 \n  */ \n define('CREATE_TO_UPLOAD_OR_LOCAL','_local');?>";
               echo '<p style="color:#FF0000">当前生成：<strong style="color:#00C">本地Localhost</strong>页面</p>';
            }
            else {
               $text="<?php \n/** 生成文件在服务器上 \n  *  这里通过 /global/class/refresh2createfile.php 页的按钮生成，判断生成的文件在本地，还是服务器 \n  */ \n define('CREATE_TO_UPLOAD_OR_LOCAL','');?>";
               echo '<p style="color:#FF0000">当前生成：<strong style="color:#0C0">服务器Upload</strong>上传页面</p>';
			}
      file_put_contents($this->file_require_create_to_upload_or_local,$text);

         }
      }
      else {
         require_once $this->file_require_create_to_upload_or_local;
         $isupld=constant('CREATE_TO_UPLOAD_OR_LOCAL');
         $isupld=($isupld=='')?'uploadfile文件':'localhost本地';
         echo '<p style="color:#FF0000">当前生成：<strong style="color:#0C0">'.$isupld.'</strong></p>';
      }
   }
   
   function single_created_file(){
      $php_self = self::$PHP_SELF;
      $web_root_dirname = self::$WEB_ROOT_DIRNAME;
      
	  /* 生成文件，开头下划线数量
      一个  _ 表示目录
	  二个 __  表示没有后缀 ，如  s?sk=seo
      三个：php 如 ___s.php 
      
      五个：生成.html  _____index.php
      六个：生成htm  ______
	  八个：生成.css 如 ________css.php
	  九个： .js    _________
     */
     
      // $php_self 路径可能是  192.168.x.x/z/include/______n.php  或者是 localhost/sv_e.v-get.com/
      // $php_self =  /sv_e.v-get.com/z/include/______n.php   /192.168.1.1/z/include/______n.php
    
      $pathinfo = pathinfo($php_self);
      $dirname =  $pathinfo['dirname'];  //    /sv_e.v-get.com/z/include  或者 /z/include
      $create_dirname = str_replace($web_root_dirname, '', $dirname);   //替换掉 /sv_e.v-get.com 保留  /z/include
      
      $basename = $pathinfo['basename'];   // 文件名，带 ____ 和  .php
      $create_filename = preg_replace('/_+([a-zA-Z\d]+[^\/]*)\.php/','$1');
      $length_of_underline = strlen($basename) - strlen($create_filename) -  4;   // strlen('.php') = 4
      
     
      
      //var_dump($matches);


	  switch ($length_of_underline){
	     case 3:$created_filetype='.php';break;
		 case 4:$created_filetype='.css';break;
		 case 5:$created_filetype='.html';break;
         case 6:$created_filetype='.htm';break;
         case 8:$created_filetype='.css';break;
         case 9:$created_filetype='.js';break;
		 default:$created_filetype='';
	  }
     
    
      $create_as_file = $this->create_to_path_site_root . $create_dirname .'/'. $create_filename . $created_filetype;
    
	  return $create_as_file;
   
   }
   
   function single_sure_to_refresh($created_file){
      //$created_file=$this->single_created_file();
	  
      if(!isset($_GET['sure'])){
	     echo '<a href="?sure=ok">确定更新 <span style="color:#F00">', $created_file ,'</span> 吗？</a>';
		 exit;
      }
      
   }
}
?>