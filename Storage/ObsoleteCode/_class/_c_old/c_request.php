<?php

/**
  PHP 模拟POST / Get 发送信息
 */
class c_request{
    static $RequestMethod = 'POST';  // POST/GET
    static $RemoteServer;  // luexu.com
    static $RemotePath;  // /c-b/
    static $RequestString;  // a=love&b=100  必须是 urlencode 后d
    static $RequestCookie = false;
    static $Port = 80;
    static $TimeOut = 30;
    
    function API(){  // 获取API
       return $this->CurlPost();
    }
    function CurlPost(){
    $url = "http://192.168.1.3/";

        $post_data = 'f_n=AuthorizeLoginStatus&token=43FfdfanDw202';
        
        $ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);


    //curl_setopt($ch, CURLOPT_POST, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	// ob_start();  
    

    
    $output=curl_exec($ch);


    
	$result=ob_get_contents(); 
	ob_end_clean(); 

        return $result;
    }
   
/**
  * 通过  Socket 发送Post
  */
    function Socket(){

        $socket = fsockopen(self::$RemoteServer, self::$Port, $errno, $errstr, self::$TimeOut);
        if($socket){
        
        $fwrite = self::$RequestMethod . ' '. self::$RemotePath . " HTTP/1.0\r\n";  // 有换行符
        $fwrite .= 'HOST: '. self::$RemoteServer ."\r\n";
        
        $fwrite .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $content_length = strlen(self::$RequestString);
        $fwrite .= 'Content-length: '. $content_length ."\r\n";
        $fwrite .= self::$RequestString ."\r\n";
        
        
        if(self::$RequestCookie){
            $fwrite .= 'Cookie: '. self::$RequestCookie ."\r\n\r\n";
        }
        $fwrite .= "Connection: Close\r\n\r\n";
        //stream_set_blocking($socket, $block);
        //stream_set_timeout($socket, self::$TimeOut);
        fwrite($socket, $fwrite);
        $header = '';
        while ($str = trim(fgets($socket, 4096))) {
            $header .= $str;
        }
        $data = '';
        while (!feof($socket)) {
            $data .= fgets($socket, 4096);
        }
        
        fclose($socket);

        return $data;
        }
        else{
            fclose($socket);
            return "$errstr ($errno)<br />\n";
        }
        
    }

    
}

?>