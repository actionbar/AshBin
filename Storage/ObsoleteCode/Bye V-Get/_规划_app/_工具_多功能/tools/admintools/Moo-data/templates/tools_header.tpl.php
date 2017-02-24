<? if(!defined('IN_MOOPHP')) exit('Access Denied');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title><?php echo $tpl_name; ?> - 站长工具</title>
<link href="<?php echo MOOPHP_TEMPLATE_URL;?>/sitetools.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php $url_name = $_SERVER['PHP_SELF']; $file_name = end(explode('/', $url_name)); ?>
<div id="top">
	<div class="top">
		<div style="float:right">
		<a href="index.php">首页</a> |
	    <a href="pr.php" >pr值查询</a> |
		<a href="site.php" >收录与反向链接</a> |
		<a href="position.php" >查看关键字排名</a> |
	    <a href="alexa.php" >Alexa查询</a> |
		<a href="ip.php">ip物理查询</a> |
		<a href="whois.php" >whois查询</a> |
	    <a href="hex.php" >网址转HEX编码</a> |
                   <a href="md5.php" >MD5计算</a>
	</div>
			<a href="http://tools.kqiqi.com" >网站首页</a> |
	    <a href="http://tools.kqiqi.com/" >客齐齐实用查询工具</a> |
<script>
function addfavorite()
{
   if (document.all)
   {
      window.external.addFavorite("http://tools.kqiqi.com/admintools/<?php echo $file_name; ?>", "<?php echo $tpl_name; ?> - 站长工具");
   }
   else if (window.sidebar)
   {
      window.sidebar.addPanel("<?php echo $tpl_name; ?> - 站长工具", "http://tools.kqiqi.com/admintools/<?php echo $file_name; ?>", "");
   }
} 
</script>
<a href="#" onclick="addfavorite()">加入收藏夹</a>
	</div>
</div>
<div id="header"><a href="index.php"><img src="Moo-templates/images/logo.jpg" /></a></div>