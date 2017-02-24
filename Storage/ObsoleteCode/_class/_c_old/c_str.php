<?php

class c_str{
       // 判断是不是utf-8编码,preg_match( '@[\xE0-\xFE][\x80-\xE0]([\x80-\xE0]{1,4})@' , $str )
   static function isUtf8($str){
      return preg_match('/^([\xE4-\xE9][\x80-\xBF]{2})|([\xE4-\xE9][\x80-\xBF]{2}){2,}|([\xE4-\xE9]{1}[\x80-\xBF]{2})$/',$str);
   }

   static function FilterToUtf8($str){
    // 一般toUTF8都是从浏览器传递来的，所以一定要先过滤
        $str = self::Filter($str);

        if(!self::isUTF8($str)){
            return iconv('gb2312','UTF-8',$str);
        }
        else{
            return $str;
        }
   }
   
   
   
   private static $SUB_INVALID_CHARACTER_ARRAY=array('/的/u');   //sub 函数中替换为空的字符集
   
    /* 对中文字符串截取，2.5个英文等于一个汉字*/
    function subUtf8($s,$l){
//$s = '91abcd行驶里程';
        $s=preg_replace( self::$SUB_INVALID_CHARACTER_ARRAY ,'',$s);
        preg_match_all("/./us", $s, $c_str_sub_utf8_match);
        $c_str_sub_utf8_count= count($c_str_sub_utf8_match[0]); // 返回单元个数

        $pa = '/[\x{4e00}-\x{9fa5}]/siu';
        preg_match_all($pa, $s, $r);
 
        $c_str_sub_utf8_hanzicount = count($r[0]);//获取汉字个数

        $c_str_sub_utf8_alpha_amount=$c_str_sub_utf8_count-$c_str_sub_utf8_hanzicount;//英文个数
        if($l<20&&$c_str_sub_utf8_alpha_amount>8){$c_str_sub_utf8_alpha_amount/=2.5;$c_str_sub_utf8_alpha_amount=(int)$c_str_sub_utf8_alpha_amount;}
        else {$c_str_sub_utf8_alpha_amount=0;}
        return mb_substr($s,0,$l+$c_str_sub_utf8_alpha_amount,'utf8');

    }

  function toBytesArr($str){  // 字符串转字节数组
    $arr = str_split($str);
    foreach($arr as $s){
        $int_arr[]=ord($s);
    }
    return $int_arr;
  }

  function Utf8ToBase32($str){  // 将任意utf8格式中英文、特殊字符转成 base32，小写、去掉尾部等于号的base32
    $table = str_split('abcdefghijklmnopqrstuvwxyz234567');
    $bytes = $this->toBytesArr($str);
    $len = count($bytes) * 8;  //bit长度
    $ret = '';
    array_push($bytes,0);  // 补充一个0 ，防止下面 pos+1
    
    for($i=0; $i<$len; $i+=5){
        $n=0;//5bit值
    $pos=(INT)($i/8);//偏移字节
    $offset=$i - $pos*8;//偏移位数

    if($offset<3){
      $n=($bytes[$pos]>>(3-$offset))&0x1f;
    }else if($offset==3){
      $n=$bytes[$pos]&0x1f;
    }else{
      //pos+1 不会超出范围 因为补0了
      $n=(($bytes[$pos]<<($offset-3))|($bytes[$pos+1]>>(11-$offset)))&0x1f;
    }
  
    $ret .= $table[$n];//追加到字符串
    }
    return $ret;
  }

}
?>