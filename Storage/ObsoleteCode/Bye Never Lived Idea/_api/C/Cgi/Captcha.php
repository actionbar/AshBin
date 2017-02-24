<?php
namespace C\Cgi;
/*
 * 验证码类
 * 为了提高性能，作为统一研究，这里一律保证手机端、网页端同步
 * 验证码字符长度  =  4
 */


class Captcha{

    private $im; //图形资源句柄

    //类似百度，产生多种随机字体，字体要不容易机器认、必须同时支持 大写 、小写 + 数字
    public static $fontBasenameArr = [
        'angryletter.ttf',
        'halloffame.ttf',
        'cookies.ttf',
        'pantspatrol.ttf',
        'getreal.ttf'
    ];
    public static $fontDir = '/e/fonts';
    public static $bgColor = '#fff';
    public static $width = 100; //宽度
    public static $height = 40; //高度
    public static $fontSize = 20; //指定字体大小






    private function fontFile(){ // 字体文件夹
        $count_fonts = count(self::$fontBasenameArr) - 1;
        $font_rand = mt_rand(0, $count_fonts);
        return self::$fontDir . '/' . self::$fontBasenameArr[$font_rand];
    }


    private function hexToRGB(){
        $bg_color = str_replace('#', '', self::$bgColor);

        if(strlen($bg_color) > 4){
            $red = substr($bg_color, 0, 2);
            $green = substr($bg_color, 2, 2);
            $blue = substr($bg_color, 4, 2);
        }
        else{
            $red = substr($bg_color, 0, 1);
            $red .= $red;
            $green = substr($bg_color, 1, 1);
            $green .= $green;
            $blue = substr($bg_color, 2, 1);
            $blue .= $blue;
        }
        $red = hexdec($red);
        $green = hexdec($green);
        $blue = hexdec($blue);
        return [
            $red,
            $green,
            $blue
        ];
    }

    //生成背景
    private function createBg(){
        // imagecreatetruecolor() 创建jpeg,png等，不支持gif，代表了一幅大小为 x_size 和 y_size 的黑色图像。

        //用Imagecreate（）创建图像时，默认是空白，只要第一次分配颜色，所分配的颜色就是背景色了。
        $this->im = imagecreatetruecolor(self::$width, self::$height);
        $rgb = $this->hexToRGB();
        $bg_color = imagecolorallocate($this->im, $rgb[0], $rgb[1], $rgb[2]);
        // 背景色
        imagefilledrectangle($this->im, 0, self::$height, self::$width, 0, $bg_color);
    }

    //生成文字
    private function createFont($captcha_code){
        $captcha_strlen = strlen($captcha_code);
        $_x = self::$width / $captcha_strlen;
        for($i = 0; $i < $captcha_strlen; ++$i){
            $font_color = imagecolorallocate($this->im, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imagettftext($this->im, self::$fontSize, mt_rand(-30, 30), $_x * $i + mt_rand(1, 5), self::$height / 1.4, $font_color, $this->fontFile(), $captcha_code[$i]);
        }
    }

    //生成线条、雪花
    private function createLine(){
        //线条
        for($i = 0; $i < 6; $i++){
            $color = imagecolorallocate($this->im, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($this->im, mt_rand(0, self::$width), mt_rand(0, self::$height), mt_rand(0, self::$width), mt_rand(0, self::$height), $color);
        }
        //雪花
        for($i = 0; $i < 100; $i++){
            $color = imagecolorallocate($this->im, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->im, mt_rand(1, 5), mt_rand(0, self::$width), mt_rand(0, self::$height), '*', $color);
        }
    }


    //对外生成
    public function output($captcha_code){
        $this->createBg();
        //$this->createLine();
        $this->createFont($captcha_code);
        header('Content-type:image/png'); // 输出头
        imagepng($this->im);
        imagedestroy($this->im);
    }
}