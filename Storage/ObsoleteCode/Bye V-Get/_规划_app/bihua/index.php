<?php

//演示：http://www.buscx.cn/zid/bs/
$servername ='localhost';
$dbname='zdian';			//数据库名
$dbusername ='root';	//数据库用户名
$dbpassword ='root';	//数据库密码

mysql_connect($servername,$dbusername,$dbpassword);
mysql_select_db($dbname) or die("不能连接数据库,请修改php中MySQL连接密码");
mysql_query("SET NAMES 'gbk'");

$zi=$_GET["zi"];

function c($str){
	  $ret=array();
	  for($i=0;$i<strlen($str);$i++){
		   $p=ord(substr($str,$i,1));
		   if($p>160){
		   $q=substr($str,$i,2);
		   $i++;
		   }
		   else $q=substr($str,$i,1);
		   $ret[]=$q;
	  }
	  return $ret;
}

$czi=c($zi);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<style>
body{text-align:center;  margin:0 auto;font-family: geneva, arial, helvetica, sans-serif}
a {
	color: #0353ce
}
div{text-align:center;  margin: auto}
a:visited {
	color: #0353ce
}
.top{ width:778px; height:60px;
}
.bleft{  width:100px; height:40px; margin:auto; float:left; font-weight:bold; font-size:24px;padding:10px 10px; text-align:left}
.bmid{  width:478px; height:60px; margin:auto; float:left;  font-size:16px;padding:0px}

.mu{ text-align:left;border-bottom: #dfdfdf 1px solid; background-color: #f7f7f7;width:778px; height:24px; border-top::#dfdfdf 1px solid; line-height:24px; margin-bottom:10px;margin-top:6px
}


.pdingt{ border-right: #b2d0ea 1px solid; border-top: #b2d0ea 1px solid; border-left: #b2d0ea 1px solid; border-bottom: #b2d0ea 1px solid; width:700px; margin-top:5px
}
.pot{padding-right: 10px; padding-left: 10px; background: #edf7ff; padding-bottom: 0px; color: #014198; padding-top: 0px; line-height:26px; width:680px;font-weight: bold;text-align:left;}
.dingt{ border-right: #b2d0ea 1px solid; border-top: #b2d0ea 1px solid; border-left: #b2d0ea 1px solid; border-bottom: #b2d0ea 1px solid; width:700px; margin-top:15px;text-align:left;
}
.ot{padding-right: 10px; padding-left: 10px; background: #edf7ff; padding-bottom: 0px; color: #014198; padding-top: 0px; line-height:26px; width:680px;font-weight: bold;}
.od{padding-right: 10px; padding-left: 10px; background: #fff; padding-bottom: 5px; color: #014198; padding-top: 5px;  width:680px}

.footer { margin-top:5px;
	padding-right: 0px; padding-left: 0px; padding-top: 8px; color: #9c9c9c;  padding-top: 8px; text-align: center; width:778px
}
.footer a {
	color: #9c9c9c
}
.footer a:visited {
color: #9c9c9c
}

</style>

<title>常用汉字笔顺查询</title>
<meta name="keywords" content="常用汉字笔顺查询" />
<meta name="description" content="常用汉字笔顺查询" />
</head>

<body>


<div class="mu"><a href="http://www.buscx.cn/">首页</a> > <a href="http://www.buscx.cn/zid/">字典</a> > 常用汉字笔顺查询</div>

<form action="" method="get"><div class="mu">

    <div align="center" >
      <input name="zi" type="text" id="zi" size="50" value="<? echo $zi; ?>" /> 　
      <input name="aaa" type="submit" id="aaa" value="查询"/>
    　　</div>
</div></form>




 <div class="dingt">
<div class="pot">查询结果</div>

 <div class="od">

					
                    <table width="360" border="0" cellspacing="1" bordercolor="#b2d0ea" bgcolor="#b2d0ea">
                      <tr>
                        <td width="90" bgcolor="#FFFFFF"><div align="center">汉字</div></td>
                        <td width="90" bgcolor="#FFFFFF"><div align="center">拼音</div></td>
                        <td width="90" bgcolor="#FFFFFF"><div align="center">偏旁部首</div></td>
                        <td width="90" bgcolor="#FFFFFF"><div align="center">五笔编码</div></td>
                      </tr>
					<?
					foreach ($czi as $k=>$v) {
					$sql="SELECT * FROM `zi22` WHERE `zi`='$v'";
					$q=mysql_query($sql);
					$rs=mysql_fetch_array($q);
					?>
                       <tr>
                        <td width="90" bgcolor="#FFFFFF"><div align="center"><? echo $v; ?></div></td>
                        <td width="90" bgcolor="#FFFFFF"><div align="center"><? echo $rs["py"]; ?></div></td>
                        <td width="90" bgcolor="#FFFFFF"><div align="center"><? echo $rs["bs"]; ?></div></td>
                        <td width="90" bgcolor="#FFFFFF"><div align="center"><? echo $rs["wb"]; ?></div></td>
                      </tr>
					  <? if($rs["swf"]<>'') {?>
					  <tr>
                        <td width="360"  colspan="4" bgcolor="#FFFFFF"><div align="center"><object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0' width='300' height='300'>
<param id='movie_hsk0' name='movie' value='<? echo $rs["swf"]; ?>'>
<param name='quality' value='high'>
<param name='wmode' value='transparent'><embed id='embed_hsk0' src='<? echo $rs["swf"]; ?>' width='300' height='300' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' wmode='transparent'></embed></object></div></td>
                      
                      </tr>
				<? } } ?>

                    </table>
 </div>
</div>
 
 </body>
</html>
