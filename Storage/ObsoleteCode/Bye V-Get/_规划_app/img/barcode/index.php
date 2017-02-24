<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>二维码名片生成工具-二维码生成|在线二维码|安卓二维码|手机二维码|android二维码|Iphone二维码|PHP二维码|拓网科技|www.topwang.com</title>
<meta name="description" content="拓网科技提供在线PHP二维码生成系统、二维码名片生成工具。www.topwang.com" />
<meta name="keywords" content="拓网二维码生成系统、安卓二维码、手机二维码、二维码名片生成工具、PHP二维码、PHP在线二维码、商标二维码生成工具、安卓二维码|Iphone二维码" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<script language="JavaScript">
	function check_input(){
		var  uname=document.getElementById('name').value;
		var  zhiwu=document.getElementById('zhiwu').value;
		var  corp=document.getElementById('corp').value;
		var  tel=document.getElementById('tel').value;		
		var  mobile=document.getElementById('mobile').value;
		var  fax=document.getElementById('fax').value;		
		var  qq=document.getElementById('qq').value;
		var  email=document.getElementById('email').value;
		var  url=document.getElementById('url').value;
		var  address=document.getElementById('address').value;		
		var content=uname+zhiwu+corp+tel+mobile+fax+qq+email+url+address;
		if(content==''){
			alert('请填写内容。');
			return false;
		}
		var txt="BEGIN:VCARD\r\nVERSION:3.0\r\nFN:"+uname+"\r\nORG:"+corp+"\r\nTITLE:"+zhiwu+"\r\nTEL;TYPE=CELL,VOICE:"+mobile+"\r\nTEL;TYPE=WORK,VOICE:"+tel+"\r\nTEL;WORK;FAX:"+fax+"\r\nX-QQ:"+qq+"\r\nEMAIL;TYPE=PREF,INTERNET:"+email+"\r\nURL:"+url+"\r\nADR;WORK:"+address+"\r\nREV:20100426T103000Z\r\nEND:VCARD";
		document.getElementById('data').value=txt;
		//alert(txt);
		return true;
	}
</script>
</head>
<body>
    <?php
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_POST['level']) && in_array($_POST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_POST['level'];    

    $matrixPointSize = 4;
    if (isset($_POST['size']))
        $matrixPointSize = min(max((int)$_POST['size'], 1), 10);


    if (isset($_POST['data'])) { 
    
        //it's very important!
        if (trim($_POST['data']) == '')
            die('表单内容不能为空! <a href="?">返回</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_POST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_POST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
        //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('二维码名片生成工具', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
        
    //display generated file//
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    
    //config form
    echo '<form action="index.php" method="post" onsubmit="return check_input()">
        姓名:&nbsp;
        <input type="text" name="name" id="name" value="'.(isset($_POST['name'])?htmlspecialchars($_POST['name']):'').'" size="20" />&nbsp;<br/>
        职务:&nbsp;
        <input type="text" name="zhiwu" id="zhiwu" value="'.(isset($_POST['zhiwu'])?htmlspecialchars($_POST['zhiwu']):'').'" size="20" />&nbsp;<br/>
        公司:&nbsp;
        <input type="text" name="corp" id="corp" value="'.(isset($_POST['corp'])?htmlspecialchars($_POST['corp']):'').'" size="30" />&nbsp;<br/>  
              
        手机:&nbsp;
        <input type="text" name="mobile" id="mobile" value="'.(isset($_POST['mobile'])?htmlspecialchars($_POST['mobile']):'').'" size="20" />&nbsp;<br/>
        电话:&nbsp;
        <input type="text" name="tel" id="tel" value="'.(isset($_POST['tel'])?htmlspecialchars($_POST['tel']):'').'" size="20" />&nbsp;<br/> 
        传真:&nbsp;
        <input type="text" name="fax" id="fax" value="'.(isset($_POST['fax'])?htmlspecialchars($_POST['fax']):'').'" size="20" />&nbsp;<br/>
        
        Q&nbsp;&nbsp;Q:&nbsp;
        <input type="text" name="qq" id="qq" value="'.(isset($_POST['qq'])?htmlspecialchars($_POST['qq']):'').'" size="20" />&nbsp;<br/>
        邮箱:&nbsp;
        <input type="text" name="email" id="email" value="'.(isset($_POST['email'])?htmlspecialchars($_POST['email']):'').'" size="30" />&nbsp;<br/> 
       网址:&nbsp;
        <input type="text" name="url" id="url" value="'.(isset($_POST['url'])?htmlspecialchars($_POST['url']):'').'" size="30" />&nbsp;<br/> 
       地址:&nbsp;
        <input type="text" name="address" id="address" value="'.(isset($_POST['address'])?htmlspecialchars($_POST['address']):'').'" size="30" />&nbsp;<br/>                        
        <input name="data" id="data" value="'.(isset($_POST['data'])?htmlspecialchars($_POST['data']):'').'" type="hidden" />                
        图像的质量:&nbsp;<select name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>&nbsp;<br/>
        图像的大小:&nbsp;<select name="size">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp;<br/><br/>
        <input type="submit" value="生成二维码"></form><hr/>';
        
    // benchmark
    //QRtools::timeBenchmark();  
    ?>
  </body></html>  

    