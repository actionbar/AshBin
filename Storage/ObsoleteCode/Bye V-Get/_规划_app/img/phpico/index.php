<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>  
<title>ico图标下载,ico制作,ico图标制作,ico在线生成,ico在线转换,ico在线制作,ico图标,png转ico,ico图标制作软件,ico,favicon.ico</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="ico图标下载,ico制作,ico图标制作,ico在线生成,ico在线转换,ico在线制作,ico图标,png转ico,ico图标制作软件,ico,favicon.ico" />  
<meta name="Description" content="ico图标制作,ico在线生成,ico在线转换,ico在线制作,目前支持JPG、gif、png三种转ico格式" />
<meta name="Generator" content="ico.sevme.cn" />
<link rel="bookmark" href="/favicon.ico"/>
</head>  
<body>  


		<form action="index.php?action=make" method="post" enctype='multipart/form-data'>		<h3>ICO图标在线制作，ICO格式转换</h3>
        <p>■选择本地文件后，该工具会自动转化，生成预览图。点击并下载相应大小的ICO文件保存即可。</p>
<p>■本  支持格式 png、jpg、gif在线转换成.ico图标。如果你选用其他格式的图片，请到<a href="#">&ldquo;在线图片格式转码&rdquo;</a>转码</p>
<p>■图像大小任意，该程序会将其自动缩放。但由于图片缩放可能会稍微影响质量，
推荐你使用与转化后的尺寸相同的原始图片，即16*16(网站FAVICON)或48*48(软件图标)</p>
<p>■网站图标使用方法：生成后网站ICO后(16*16像素的那个)，保存为favicon.ico,然后上传到网站根目录。</p><p><input type="file" name="upimage" size="30">  <input type="submit" style="width:150px; height:30px;" value="在线生成.ico图标"></p></form> 
<div>


</div>


			<?PHP  

$output="";  
if(isset($_GET['action'])&&$_GET['action'] == 'make'){  
    if(isset($_FILES['upimage']['tmp_name']) && $_FILES['upimage']['tmp_name'] && is_uploaded_file($_FILES['upimage']['tmp_name'])){  
        echo $_FILES['upimage']['type'];
        $fileext=array("image/jpeg","image/gif","image/png");  
        if(!in_array($_FILES['upimage']['type'],$fileext)){  
            echo "你上传的文件格式不正确 仅支持 jpg，gif，png";  
        }  
        if($im=@imagecreatefrompng($_FILES['upimage']['tmp_name']) or $im=@imagecreatefromgif($_FILES['upimage']['tmp_name']) or $im=@imagecreatefromjpeg($_FILES['upimage']['tmp_name'])){  
            $imginfo=@getimagesize($_FILES['upimage']['tmp_name']);  
            if(!is_array($imginfo)){echo "图形格式错误！";}  
      
			$resize_im=@imagecreatetruecolor(16,16);$size=16;
			/*$size=32;$resize_im=@imagecreatetruecolor(32,32);
			$resize_im=@imagecreatetruecolor(48,48);$size=48*/
			
            imagecopyresampled($resize_im,$im,0,0,0,0,$size,$size,$imginfo[0],$imginfo[1]);  
            class phpthumb_ico { 
    function phpthumb_ico() { 
        return true; 
    } 
    function GD2ICOstring(&$gd_image_array) { 
        foreach ($gd_image_array as $key => $gd_image) { 
            $ImageWidths[$key]  = ImageSX($gd_image); 
            $ImageHeights[$key] = ImageSY($gd_image); 
            $bpp[$key]          = ImageIsTrueColor($gd_image) ? 32 : 24; 
            $totalcolors[$key]  = ImageColorsTotal($gd_image); 
            $icXOR[$key] = ''; 
            for ($y = $ImageHeights[$key] - 1; $y >= 0; $y--) { 
                for ($x = 0; $x < $ImageWidths[$key]; $x++) { 
                    $argb = $this->GetPixelColor($gd_image, $x, $y); 
                    $a = round(255 * ((127 - $argb['alpha']) / 127)); 
                    $r = $argb['red']; 
                    $g = $argb['green']; 
                    $b = $argb['blue']; 
                    if ($bpp[$key] == 32) { 
                        $icXOR[$key] .= chr($b).chr($g).chr($r).chr($a); 
                    } elseif ($bpp[$key] == 24) { 
                        $icXOR[$key] .= chr($b).chr($g).chr($r); 
                    } 
                    if ($a < 128) { 
                        @$icANDmask[$key][$y] .= '1'; 
                    } else { 
                        @$icANDmask[$key][$y] .= '0'; 
                    } 
                } 
                // mask bits are 32-bit aligned per scanline 
                while (strlen($icANDmask[$key][$y]) % 32) { 
                    $icANDmask[$key][$y] .= '0'; 
                } 
            } 
            $icAND[$key] = ''; 
            foreach ($icANDmask[$key] as $y => $scanlinemaskbits) { 
                for ($i = 0; $i < strlen($scanlinemaskbits); $i += 8) { 
                    $icAND[$key] .= chr(bindec(str_pad(substr($scanlinemaskbits, $i, 8), 8, '0', STR_PAD_LEFT))); 
                } 
            } 
        } 
        foreach ($gd_image_array as $key => $gd_image) { 
            $biSizeImage = $ImageWidths[$key] * $ImageHeights[$key] * ($bpp[$key] / 8); 
            // BITMAPINFOHEADER - 40 bytes 
            $BitmapInfoHeader[$key]  = ''; 
            $BitmapInfoHeader[$key] .= "\x28\x00\x00\x00";                              // DWORD  biSize; 
            $BitmapInfoHeader[$key] .= $this->LittleEndian2String($ImageWidths[$key], 4);      // LONG   biWidth; 
            // The biHeight member specifies the combined 
            // height of the XOR and AND masks. 
            $BitmapInfoHeader[$key] .= $this->LittleEndian2String($ImageHeights[$key] * 2, 4); // LONG   biHeight; 
            $BitmapInfoHeader[$key] .= "\x01\x00";                                      // WORD   biPlanes; 
               $BitmapInfoHeader[$key] .= chr($bpp[$key])."\x00";                          // wBitCount; 
            $BitmapInfoHeader[$key] .= "\x00\x00\x00\x00";                              // DWORD  biCompression; 
            $BitmapInfoHeader[$key] .= $this->LittleEndian2String($biSizeImage, 4);            // DWORD  biSizeImage; 
            $BitmapInfoHeader[$key] .= "\x00\x00\x00\x00";                              // LONG   biXPelsPerMeter; 
            $BitmapInfoHeader[$key] .= "\x00\x00\x00\x00";                              // LONG   biYPelsPerMeter; 
            $BitmapInfoHeader[$key] .= "\x00\x00\x00\x00";                              // DWORD  biClrUsed; 
            $BitmapInfoHeader[$key] .= "\x00\x00\x00\x00";                              // DWORD  biClrImportant; 
        } 
        $icondata  = "\x00\x00";                                      // idReserved;   // Reserved (must be 0) 
        $icondata .= "\x01\x00";                                      // idType;       // Resource Type (1 for icons) 
        $icondata .= $this->LittleEndian2String(count($gd_image_array), 2);  // idCount;      // How many images? 
        $dwImageOffset = 6 + (count($gd_image_array) * 16); 
        foreach ($gd_image_array as $key => $gd_image) { 
            // ICONDIRENTRY   idEntries[1]; // An entry for each image (idCount of 'em) 
            $icondata .= chr($ImageWidths[$key]);                     // bWidth;          // Width, in pixels, of the image 
            $icondata .= chr($ImageHeights[$key]);                    // bHeight;         // Height, in pixels, of the image 
            $icondata .= chr($totalcolors[$key]);                     // bColorCount;     // Number of colors in image (0 if >=8bpp) 
            $icondata .= "\x00";                                      // bReserved;       // Reserved ( must be 0) 
            $icondata .= "\x01\x00";                                  // wPlanes;         // Color Planes 
            $icondata .= chr($bpp[$key])."\x00";                      // wBitCount;       // Bits per pixel 
            $dwBytesInRes = 40 + strlen($icXOR[$key]) + strlen($icAND[$key]); 
            $icondata .= $this->LittleEndian2String($dwBytesInRes, 4);       // dwBytesInRes;    // How many bytes in this resource? 
            $icondata .= $this->LittleEndian2String($dwImageOffset, 4);      // dwImageOffset;   // Where in the file is this image? 
            $dwImageOffset += strlen($BitmapInfoHeader[$key]); 
            $dwImageOffset += strlen($icXOR[$key]); 
            $dwImageOffset += strlen($icAND[$key]); 
        } 
        foreach ($gd_image_array as $key => $gd_image) { 
            $icondata .= $BitmapInfoHeader[$key]; 
            $icondata .= $icXOR[$key]; 
            $icondata .= $icAND[$key]; 
        } 
        return $icondata; 
    } 
    function LittleEndian2String($number, $minbytes=1) { 
        $intstring = ''; 
        while ($number > 0) { 
            $intstring = $intstring.chr($number & 255); 
            $number >>= 8; 
        } 
        return str_pad($intstring, $minbytes, "\x00", STR_PAD_RIGHT); 
    } 
    function GetPixelColor(&$img, $x, $y) { 
        if (!is_resource($img)) { 
            return false; 
        } 
        return @ImageColorsForIndex($img, @ImageColorAt($img, $x, $y)); 
    } 
}  
            $icon=new phpthumb_ico();  
            $gd_image_array=array($resize_im);  
            $icon_data=$icon->GD2ICOstring($gd_image_array);  
            $filename="temp/".date("Ymdhis").rand(1,1000).".ico";  
            if(file_put_contents($filename, $icon_data)){  
                echo '<img src="'.$filename.'" />生成成功！请点右键->另存为 保存到本地<br><a href="javascript:void(0)" onclick="javascript:document.all.WebBrowser.ExecWB(4,1)">点击下载</a>';  
            }  
        }else{  
            echo "生成错误请重试！";  
        }  
    }      
}  
?>  


</body>  
</html>