<?php 
/*-------------------------------------------------------------
**描述：这是用于给指定图片加底部水印（不占用图片显示区域）的自定义类，需创建对象调用
**创建：2007-10-09
**更新：2007-10-09
**说明：1、需要gd库支持，需要iconv支持（php5已经包含不用加载）
        2、只适合三种类型的图片，jpg/jpeg/gif/png，其它类型不处理
        3、注意图片所在目录的属性必须可写
        4、调用范例：
            $objImg = new MyWaterDownChinese();
            $objImg->Path = "images/";
            $objImg->FileName = "1.jpg";
            $objImg->Text = "HAHAKONGJIAN[url]HTTP://HI.BAIDU.COM/LYSONCN[/url]";
            $objImg->Font = "./font/simhei.ttf";
            $objImg->Run();
**成员函数：
----------------------------------------------------------------*/
class MyWaterDownChinese{
          var $Path = "./"; //图片所在目录相对于调用此类的页面的相对路径
          var $FileName = "prod_img.gif"; //图片的名字，如"1.jpg"
          var $Text = "fdfd";   //图片要加上的水印文字，支持中文
          var $TextColor = "#ffffff"; //文字的颜色，gif图片时，字体颜色只能为黑色
          var $TextBgColor = "#000000"; //文字的背景条的颜色
          var $Font = "c://windows//fonts//simhei.ttf"; //字体的存放目录，相对路径
          var $OverFlag = true; //是否要覆盖原图，默认为覆盖，不覆盖时，自动在原图文件名后+"_water_down"，如"1.jpg"=> "1_water_down.jpg"
          var $BaseWidth = 200; //图片的宽度至少要>=200，才会加上水印文字。
         
//------------------------------------------------------------------
//功能：类的构造函数(php5.0以上的形式)
//参数：无
//返回：无
function __construct(){;}

//------------------------------------------------------------------
//功能：类的析构函数(php5.0以上的形式)
//参数：无
//返回：无
function __destruct(){;}
//------------------------------------------------------------------

//------------------------------------
//功能：对象运行函数，给图片加上水印
//参数：无
//返回：无
function Run()
{
    if($this->FileName == "" || $this->Text == "")
        return;
    //检测是否安装GD库
    if(false == function_exists("gd_info"))
    {
        echo "系统没有安装GD库，不能给图片加水印.";
        return;
    }
    //设置输入、输出图片路径名
    $arr_in_name = explode(".",$this->FileName);
    //
    $inImg = $this->Path.$this->FileName;
    $outImg = $inImg;
    $tmpImg = $this->Path.$arr_in_name[0]."_tmp.".$arr_in_name[1]; //临时处理的图片，很重要
    if(!$this->OverFlag)
        $outImg = $this->Path.$arr_in_name[0]."_water_down.".$arr_in_name[1];
    //检测图片是否存在
    if(!file_exists($inImg))
        return ;
    //获得图片的属性
    $groundImageType = @getimagesize($inImg); 
    $imgWidth = $groundImageType[0]; 
    $imgHeight = $groundImageType[1];
    $imgType = $groundImageType[2];
    if($imgWidth < $this->BaseWidth) //小于基本宽度，不处理
        return;
    
    //图片不是jpg/jpeg/gif/png时，不处理
    switch($imgType)
    {
         case 1: 
              $image = imagecreatefromgif($inImg); 
              $this->TextBgColor = "#ffffff"; //gif图片字体只能为黑，所以背景颜色就设置为白色
              break; 
         case 2: 
              $image = imagecreatefromjpeg($inImg);
              break; 
         case 3: 
              $image = imagecreatefrompng($inImg);
              break; 
         default: 
              return;
              break;
    }
    //创建颜色
    $color = @imagecolorallocate($image,hexdec(substr($this->TextColor,1,2)),hexdec(substr($this->TextColor,3,2)),hexdec(substr($this->TextColor,5,2))); //文字颜色
    //生成一个空的图片，它的高度在底部增加水印高度
    $newHeight = $imgHeight+20;
    $objTmpImg = @imagecreatetruecolor($imgWidth,$newHeight);
    $colorBg = @imagecolorallocate($objTmpImg,hexdec(substr($this->TextBgColor,1,2)),hexdec(substr($this->TextBgColor,3,2)),hexdec(substr($this->TextBgColor,5,2))); //背景颜色    
    //填充图片的背景颜色
    @imagefill ($objTmpImg,0,0,$colorBg);
    //把原图copy到临时图片中
    @imagecopy($objTmpImg,$image,0,0,0,0,$imgWidth,$imgHeight);
    //创建要写入的水印文字对象
    $objText = $this->createText($this->Text);
    //计算要写入的水印文字的位置
    $x = 5;
    $y = $newHeight-5;
    //写入文字水印
    @imagettftext($objTmpImg,10,0,$x,$y,$color,$this->Font,$objText);    
    //生成新的图片，临时图片
    switch($imgType)
    {
         case 1: 
              imagegif($objTmpImg,$tmpImg);
              break; 
         case 2: 
              imagejpeg($objTmpImg,$tmpImg);
              break; 
         case 3: 
              imagepng($objTmpImg,$tmpImg);
              break; 
         default: 
              return;
              break;
    }    
    //释放资源
    @imagedestroy($objTmpImg);
    @imagedestroy($image);
    //重新命名文件
    if($this->OverFlag)
    {
        //覆盖原图
        @unlink($inImg);
        @rename($tmpImg,$outImg);
    }
    else
    {
        //不覆盖原图
        @rename($tmpImg,$outImg);
    }
}

//--------------------------------------
//功能：创建水印文字对象
//参数：无
//返回：创建的水印文字对象
function createText($instring)
{
   $outstring="";
   $max=strlen($instring);
   for($i=0;$i<$max;$i++)
   {
       $h=ord($instring[$i]);
       if($h>=160 && $i<$max-1)
       {
           $outstring .= "&#".base_convert(bin2hex(iconv("gb2312","ucs-2",substr($instring,$i,2))),16,10).";";
           $i++;
       }
       else
       {
           $outstring .= $instring[$i];
       }
   }
   return $outstring;
}

}//class
?>
