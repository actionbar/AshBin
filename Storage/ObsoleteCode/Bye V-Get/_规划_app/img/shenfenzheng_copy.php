<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>在线生成身份证复印件图片、WORD的DOCX文档，身份证号码查询</title>


</head>
<link rel="stylesheet" type="text/css" href="../index.css" />
<link rel="stylesheet" type="text/css" href="http://localhost:8080/v-get.com/app/index.css" />



<script type="text/javascript" src="http://localhost:8080/v-get.com/c/c.js"></script>


</head>
<body>
<div class="w">
<div class="t"><div class="q"><a href="">V-Get!首页</a>|<a href="">设为主页</a>|<a href="">收藏本站</a></div></div>
<div class="u">
<img src="http://localhost:8080/app.v-get.com/index.png" />
</div>
<div class="n"><a href="http://localhost:8080/app.v-get.com/">首页</a><a href="http://localhost:8080/app.v-get.com/biz/">商务办公</a><a href="http://localhost:8080/app.v-get.com/finance/">金融计算</a><a href="http://localhost:8080/app.v-get.com/life/">生活助手</a><a href="http://localhost:8080/app.v-get.com/img/" class="no">图片美工</a><a href="http://localhost:8080/app.v-get.com/edit/">文字设计</a><a href="http://localhost:8080/app.v-get.com/edu/">教育考试</a><a href="http://localhost:8080/app.v-get.com/game/">娱乐游戏</a><a href="http://localhost:8080/app.v-get.com/pc/">电脑优化</a></div>
<div class="w4"><a href="#"><img src="http://localhost:8080/v-get.com/i/wuliu/a/zzidc980.gif" /></a></div>
<!--这里不用include，因为基本这个部分是固定的；广告以后采用js替换，或者固定图片名称-->
<!--因为都在life文件夹下，而且涉及.no，所以这样更好-->
<div class="v">
<div class="p l">
<?php require 'l.htm';?>


</div>
<div class="p r">
<style type="text/css">
<!--
.c{font-size:14px;padding:0 9px}
.c p{line-height:28px}
.c ol{list-style-position:inside;list-style-type:disc;margin:9px}
.c li{line-height:22px}
.c a{color:#06C}

-->
</style>
<h1>在线生成身份证复印件图片、WORD的DOCX文档</h1>

<div class="c">
<ol><li>暂时仅支持gif格式图片</li>
<li>为方便整蛊娱乐效果，本程序不直接提供彩色照转黑白照处理，如果您需要转黑白照，请到”“</li>
</ol>
<?php


if (empty($_POST["xm"]))
{
$tmp = array();
$tmp["n"] = rand(1960,1985);
$tmp["y"] = rand(1,12);
$tmp["r"] = rand(1,25);
$tmp["dz"] = rand(25,999);
$tmp["hm_2"] = rand(10,99);
$rm = file("shenfenzheng/rm.txt");
    echo '<div class="p"><form action="shenfenzheng_copy_ok.php" method="POST" onsubmit="var o=this;if($l(o.mz)&&$l(o.n)&&$l(o.y)&&$l(o.r)&&$l(o.dz)&&$l(o.hm)&&$l(o.tx)){o.submit}else {alert(\'V提示：请信息输入完整\');return false}" enctype="multipart/form-data">
    <p>姓名:<input type="text" name="xm" size="4" value="' . $rm[rand(0,count($rm)-1)] . '" /></p><p>
    性别:<select name="xb"><option value="男">男</option><option value="女">女</option></select>民族:<input type="text" name="mz" size="4" value="汉"/></p><p>
    出生:<input type="text" name="n" size="4" value="' . $tmp["n"] . '" />年<input type="text" name="y" size="2" value="' . $tmp["y"] . '" />月<input type="text" name="r" size="2" value="' . $tmp["r"] . '" />日</p><p>
    住址:<input type="text" name="dz" size="30" value="四川省富顺县釜江大道西段' . $tmp["dz"] . '号" /></p><p>
    公民身份号码:<input type="text" name="hm" size="18" value="510322' . $tmp["n"] . str_pad($tmp["y"],2,"0",STR_PAD_LEFT) . str_pad($tmp["r"],2,"0",STR_PAD_LEFT) . $tmp["hm_2"] . '1' . rand(3,9) . '" /></p><p>
    头像:<input type="file" name="tx" /></p><p>
    <input type="submit" value="生成" /></p></form></div><div class="q"><img src="http://localhost:8080/v-get.com/app/img/shenfenzheng/r.png" /></div>';
}
else
{
	
$xm = $_POST["xm"];
$xb = $_POST["xb"];
$mz = $_POST["mz"];
$n = $_POST["n"];
$y = $_POST["y"];
$r = $_POST["r"];
$dz = $_POST["dz"];
$hm = $_POST["hm"];
$tx = $_FILES["tx"]["tmp_name"];
	
	
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment; filename=".basename("身份证.docx"));
    $rand = date("ymdhis") . rand(1111,9999);
    if (!is_dir("tmp"))
        mkdir("tmp");
    if (!is_dir("tmp/" . $rand))
        mkdir("tmp/" . $rand);
    if (!is_dir("tmp/" . $rand . "/word"))
        mkdir("tmp/" . $rand . "/word");
    if (!is_dir("tmp/" . $rand . "/word/media"))
        mkdir("tmp/" . $rand . "/word/media");
    $im = imagecreatefrompng("shenfenzheng/hb.png");
    $ys = imagecolorallocate($im, 0, 0, 0);
    ImageTTFText($im, 11, 0, 69, 41, $ys,"shenfenzheng/hanzi.ttf", $xm);
    ImageTTFText($im, 10, 0, 69, 66, $ys,"shenfenzheng/hanzi.ttf", $xb);
    ImageTTFText($im, 9, 0, 134, 66, $ys,"shenfenzheng/hanzi.ttf", $mz);
    ImageTTFText($im, 10, 0, 69, 92, $ys,"shenfenzheng/shuzi.ttf", $n);
    if (strlen($y) == 1)
        ImageTTFText($im, 10, 0, 120, 92, $ys,"shenfenzheng/shuzi.ttf", $y);
    else
        ImageTTFText($im, 10, 0, 116, 92, $ys,"shenfenzheng/shuzi.ttf", $y);
    if (strlen($r) == 1)
        ImageTTFText($im, 10, 0, 151, 92, $ys,"shenfenzheng/shuzi.ttf", $r);
     else
        ImageTTFText($im, 10, 0, 147, 92, $ys,"shenfenzheng/shuzi.ttf", $r);
    if (strlen($dz) <= 33)
    {
        ImageTTFText($im, 9, 0, 69, 121, $ys,"shenfenzheng/hanzi.ttf", $dz);
    }
    else if (strlen($dz) > 33 && strlen($dz) <= 66)
    {
        $dz = str_split($dz,33);
        ImageTTFText($im, 9, 0, 69, 121, $ys,"shenfenzheng/hanzi.ttf", $dz[0]);
        ImageTTFText($im, 9, 0, 69, 140, $ys,"shenfenzheng/hanzi.ttf", $dz[1]);
    }
    ImageTTFText($im, 12, 0, 120, 188, $ys,"shenfenzheng/shuzi.ttf", $hm);
    copy($tx,"tmp/" . $rand . "/image1.gif");
    $strim = imagecreatefromgif("tmp/" . $rand . "/image1.gif");
    $size = getimagesize("tmp/" . $rand . "/image1.gif");
    imagecopy($im,$strim,220,30,0,0,$size[0],$size[1]);
    imagedestroy($strim);
    imagepng($im,"tmp/" . $rand . "/word/media/image1.png");
    imagedestroy($im);
    require_once('shenfenzheng/pclzip.lib.php');
    copy("shenfenzheng/sfz.docx","tmp/" . $rand . "/sfz.docx");
    $archive = new PclZip("tmp/" . $rand . "/sfz.docx");
    $v_list = $archive->add("tmp/" . $rand . "/word/media/image1.png",PCLZIP_OPT_REMOVE_PATH,"tmp/" . $rand);
    readfile("tmp/" . $rand . "/sfz.docx");
}
?>


</div>
<div class="o"></div>
</div>

</div>
<?php require 'c.htm';?>



</div>

</div>


</div>


<script language="javascript" type="text/javascript">
<!--
E($('ri'),'click',function(){this.src="http://localhost:8080/v-get.com/app/img.php?r="+Math.random();});
//-->
</script>
</body>
</html>