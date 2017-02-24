<?php
$hu = 'yuan';
@require_once('header.php');
@require_once('global.php');
$domain = $_POST['domain'];
if($domain){
	if(substr($domain,0,7) != "http://") {
	   $domain = "http://".$domain;
    }
	$content = @file_get_contents($domain);
	@require_once('cache.php');
	if(file_exists("cache/yuan.php")){
		@require_once("cache/yuan.php");
		$urls = filehave($urls,$domain);
	}else{
		$urls = fileno($domain);
	}
	writeover("cache/yuan.php","<?php\r\n\$urls=".vvar_export($urls).";\r\n?>");
}
?>
<div class="main"> 
   <div class="box">
      <div id="b_1">
        <h1><div class="titleft">查看页面源代码</div></h1>
           <div class="box1">
             <div class="info1">
             <form id="f" action="" method="POST">
              &nbsp;&nbsp;请输入要查询的页面：<input name="domain" type="text" id="domain" class="input" size="40" url="true" value="<?php echo $domain?>"/>&nbsp;&nbsp;&nbsp;&nbsp;<input name="btnS" class="but" type="submit" value="查询"  id="sub"/> <div align="center" style="padding-top:10px;"></form>
                <textarea id="content" name="content" style="width:850px;height:850px;border:1px solid #c5e2f2;overflow:visible;" cols="20" rows="85"><?php echo $content;?></textarea>
                </div>
        </div>
      </div>
   </div>
 </div>
<div id="b_14">
<h1>最近查询：</h1>
<div class="box1">
<span class="info2"> 
<table>
<tr><td align="left" style= "word-wrap:break-word;word-break:break-all">
<?php
@require_once('cache/yuan.php');
if($urls){
foreach ($urls as $key=>$v){
	echo "<a href=http://".$urls[$key]." target=_blank>".$urls[$key]."</a>&nbsp;&nbsp;";
}}?></td></tr>
</table>
</span>
</div>
<div class="box">
<div id="b_14">
<h1>工具简介</h1>
<div class="box1">
<span class="info2"> 
<p>查看页面源代码</p>
</span>
</div>
</div>
<?php @require_once('foot.php');?>