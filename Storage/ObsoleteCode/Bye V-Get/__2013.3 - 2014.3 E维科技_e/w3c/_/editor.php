<?php
//对表单传递的字符需要不需要进行addslashes()需要先看看php.ini有没有开启magic_quotes_gpc，如果已经开启了，就不需要使用，PHP会自动addslashes()。【' " \ \0 】
// 如果用于插入数据库，就需要对"转义，如果是重新post出去，就不能，就需要用stripslashes() 对默认转义反解
$GMQG=get_magic_quotes_gpc()?TRUE:FALSE;

$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve',$QC);mysql_query('set names "UTF-8"');
function AA($o=''){
$r='';
$aa=array('','HTML','CSS','JS','jQuery','PHP','Memcache');
foreach($aa as $a=>$k){$r.='<option value="'.$k.'"'.($o==$k?' selected="selected"':'').'>'.$k.'</option>';}
return $r;
}



$A='';$L='';$X='';$G='';$H='';$K='';$D='';$F='';$Qs='';

//启用更新技术
$Query=FALSE;

// 启动插入数据库post fel
if(isset($_POST['fel'])){

$l=$_POST['fel'];
$update=$_POST['update'];
$a=$_POST['fea'];$x=$_POST['fex'];$g=$_POST['feg'];$h=$_POST['feh'];
$k=$_POST['fek'];$d=$_POST['fed'];$f=$_POST['fef'];$t=$_POST['fet'];

$sqlF=$GMQG?$f:addslashes($f);
//$f=str_replace('"','\\"',$f);

$curl_f=$GMQG?stripslashes($f):$f;

if($l==$update){
//如果是更新，就表示之前查询过get，之后就可以更新，没有查询过表示插入
$Qs='UPDATE ve.w3c SET a="'.$a.'",g="'.$g.'",x="'.$x.'",h="'.$h.'",k="'.$k.'",d="'.$d.'",f="'.$sqlF.'",t="'.$t.'" WHERE l="'.$l.'";';
mysql_query($Qs) or die ('Update IMG failed: '.mysql_error());
}
else{
$Qs='INSERT INTO ve.w3c (l,a,g,x,h,k,d,f,t) VALUES ("'.$l.'","'.$a.'","'.$g.'","'.$x.'","'.$h.'","'.$k.'","'.$d.'","'.$sqlF.'","'.$t.'");';
mysql_query($Qs) or die ('Update IMG failed: '.mysql_error());
} 


//&#39; 里面&是  下面的传递切割，所以需要对传递的进行 urlencode
$urlH=urlencode($h);$urlF=urlencode($curl_f);$urlD=urlencode($d);
$post_data='update='.$update.'&l='.$l.'&a='.$a.'&x='.$x.'&g='.$g.'&h='.$urlH.'&d='.$urlD.'&k='.$k.'&f='.$urlF.'&t='.$t.'&vgetid=TmvoCdw03v_nadsfs2D';
//如果是远程文件，curl才是首选。file_get_contents用来读取本地文件才是首选。而curl是对socket封装后的工具，所以最简洁的是socket
//但是socket不支持多线程，就是同步多个编辑就会出问题，还是用curl比较好
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_URL,'http://e.v-get.com/a/editor_w3c.php');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	 ob_start();  
	curl_exec($ch);
	$result=ob_get_contents(); 
	ob_end_clean(); 
	
//echo $result;if($result=='v'){$OK=1;header('location: '.$_POST['comes']);exit;}else {$OK=0;}
}

//没有post fel，有get fel 就是查询、更新
if(isset($_GET['fel'])&&!isset($_POST['fel'])){
$Qs='SELECT * FROM w3c WHERE l="'.$_GET['fel'].'" LIMIT 1';
$Qq=mysql_query($Qs);
$Qa=mysql_fetch_array($Qq);
$Qr=mysql_num_rows($Qq);if($Qr>0){
$L=$Qa['l'];$A=$Qa['a'];$X=$Qa['x'];$G=$Qa['g'];$H=$Qa['h'];$K=$Qa['k'];$D=$Qa['d'];$F=$Qa['f'];
//下面两个是必须的，否则输出d f会出现 把&34;替换成 " 的情况
$D=htmlspecialchars($D);$F=htmlspecialchars($F);
$Query=TRUE;
}

}


?>

<!DOCTYPE html><html><head><title>W3C 编辑器</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link href="http://tu.v-get.com/i.ico" type="image/ico" rel="shortcut icon" />
<!-- 安全宝设置了禁止localhost本地使用静态地址，所以这里禁止使用 -->
<link href="http://localhost/www.v-get.com/tu/i.css" rel="stylesheet" type="text/css"  />
<link href="http://localhost/www.v-get.com/tu/f.css" rel="stylesheet" type="text/css"  />
<link href="http://localhost/www.v-get.com/tu/fe.css" rel="stylesheet" type="text/css"  />
<style>*
.fq{text-algin:right;}
</style>
</head>
<body>
<div style="height:28px;background:#333;color:#FFF;padding:0 3px;font-weight:700;line-height:28px" id="toptitle"><form method="get">查询l <input type="text"style="width:200px;border:0" name="fel"><input type="submit" value="查询"></form></form></div>
<div style="float:left;width:46%">
<form method="post" id="fes">
<!-- update 用以更新，如果update和post l值一致，就表示是更新，如果update为空，而l 值已存在就表示这个l不能用了-->
<input type="hidden" name="update" value="<?php echo $L;?>">
<!--feimgkey 用于提示，唯一值是id=felo，命名为   $($("feimgkey").value).value+'1'  $g($("feimgkey"),"feimgmenu") 用于目录 -->
<input type="hidden" name="fevgtsid" value="8">
<input type="hidden" id="feimgkey" value="felo" feimgmenu="w3c">
<!-- comes 用以返回当前编辑页面，用js获取当前页面-->
<input type="hidden" name="comes" value="">
<p><span><label>标题：</label><input type="hidden" name="feh"/><input type="text" value="<?PHP echo $H;?>" style="width:380px" id="feho" placeholder="feh" />75&gt;<i style="color:#080"></i></span>

<input type="text" style="width:120px;margin:0 5px;border:0;background:none;" name="fet" value="" readonly="readonly"/><input type="checkbox" id="feto" title="点击此可以停止时间，用于修改时间"><input type="hidden" name="fett" value=""/></p>


<p>语言a：<select name="fea"><?php echo AA($A);?></select>
<span><label>短称g：</label><input type="text" value="<?PHP echo $G;?>" style="width:200px" id="fego"/>33&gt;<i style="color:#080"></i><input type="hidden" name="feg" /></span>

</p>
<p><span><label>关词：</label><input type="text" style="width:300px" id="feko" placeholder="fek" value="<?PHP echo $K;?>" />60&gt;<input type="hidden" name="fek"/><i style="color:#080"></i> </span>
<span><label>函数x：</label><input type="text" value="<?PHP echo $X;?>" style="width:150px" id="fexo" />150&gt;<i style="color:#080"></i></span>
</p>
<div style="height:60px"><span><label>简介：</label><textarea id="fedo" placeholder="fed" style="width:83%;height:60px"><?PHP echo $D;?></textarea>255&gt;<i style="color:#080"></i><input type="hidden" name="fed" value=""/></span></div>
<div class="o mh"></div>
<p><span><label>唯一名 l：</label><input type="text" value="<?PHP echo $L;?>" style="width:150px" id="felo" readonly="readonly"/><input type="hidden" name="fel"/>150&gt;<i style="color:#080"></i><i></i></span> 
<input type="hidden" name="fex" /><input type="button" id="fesubmit" value="提交"></p>
<div id="tempf" class="pn"><?php echo $F;?></div>

<div class="o"></div>
</form>
</div>
<div id="fefrt"></div>
<script type="text/javascript" src="http://localhost/www.v-get.com/tu/i.js"></script>
<script type="text/javascript" src="http://localhost/www.v-get.com/tu/l.js"></script>
<script type="text/javascript" src="http://localhost/www.v-get.com/tu/fe.js"></script>
<script type="text/javascript" src="fe.js"></script>
<script type="text/javascript">
//这里必须放在fe.js上面
// 上传图片地址，要包含用户名+验证码，避免被黑客利用上传
//FEIUP是上传图片的，避免被黑客利用，所以这里伪装名称url_301 
var FE_IUP='http://tp.v-get.com/editor/url_301.php?user=e&check=imgUpload_Vwe223v&';
var FE_EditorClass=9;





//需要对echo出来的值转码， &#34;等 echo出来的就是 " 而textarea输出就是 " 而不是 &$34;
//而且也不能用 input存，因为f里面会有 "，遇到input会遇到麻烦
//不能用textarea，否则对pre 里面的 &#34;自动替换成 "
H($("fefo"),H($("tempf")));
</script>


</body></html>