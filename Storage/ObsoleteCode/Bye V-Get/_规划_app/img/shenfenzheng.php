<?php

$tmp = array();
$tmp["n"] = rand(1960,1985);
$tmp["y"] = rand(1,12);
$tmp["r"] = rand(1,25);
$tmp["dz"] = rand(25,999);
$tmp["hm_2"] = rand(10,99);
$rm = file("shengfenzheng/rm.txt");
if (empty($_POST["xm"]))
{
    header("Content-Type: text/html;charset=utf-8");
    echo '<form action="index.php" method="POST" onclick="" enctype="multipart/form-data">
    姓名:<input type="text" name="xm" size="4" value="' . $rm[rand(0,count($rm)-1)] . '" /><br />
    性别:<select name="xb"><option value="男">男</option><option value="女">女</option></select>民族:<input type="text" name="mz" size="4" value="汉"/><br />
    出生:<input type="text" name="n" size="4" value="' . $tmp["n"] . '" />年<input type="text" name="y" size="2" value="' . $tmp["y"] . '" />月<input type="text" name="r" size="2" value="' . $tmp["r"] . '" />日<br />
    住址:<input type="text" name="dz" size="30" value="四川省富顺县釜江大道西段' . $tmp["dz"] . '号" /><br />
    公民身份号码:<input type="text" name="hm" size="18" value="510322' . $tmp["n"] . str_pad($tmp["y"],2,"0",STR_PAD_LEFT) . str_pad($tmp["r"],2,"0",STR_PAD_LEFT) . $tmp["hm_2"] . '1' . rand(3,9) . '" /><br />
    头像:<input type="file" name="tx" /><br />
    <input type="submit" value="生成" /></form>';
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
    $im = imagecreatefrompng("shengfenzheng/hb.png");
    $ys = imagecolorallocate($im, 0, 0, 0);
    ImageTTFText($im, 11, 0, 69, 41, $ys,"shengfenzheng/hanzi.ttf", $xm);
    ImageTTFText($im, 10, 0, 69, 66, $ys,"shengfenzheng/hanzi.ttf", $xb);
    ImageTTFText($im, 9, 0, 134, 66, $ys,"shengfenzheng/hanzi.ttf", $mz);
    ImageTTFText($im, 10, 0, 69, 92, $ys,"shengfenzheng/shuzi.ttf", $n);
    if (strlen($y) == 1)
        ImageTTFText($im, 10, 0, 120, 92, $ys,"shengfenzheng/shuzi.ttf", $y);
    else
        ImageTTFText($im, 10, 0, 116, 92, $ys,"shengfenzheng/shuzi.ttf", $y);
    if (strlen($r) == 1)
        ImageTTFText($im, 10, 0, 151, 92, $ys,"shengfenzheng/shuzi.ttf", $r);
     else
        ImageTTFText($im, 10, 0, 147, 92, $ys,"shengfenzheng/shuzi.ttf", $r);
    if (strlen($dz) <= 33)
    {
        ImageTTFText($im, 9, 0, 69, 121, $ys,"shengfenzheng/hanzi.ttf", $dz);
    }
    else if (strlen($dz) > 33 && strlen($dz) <= 66)
    {
        $dz = str_split($dz,33);
        ImageTTFText($im, 9, 0, 69, 121, $ys,"shengfenzheng/hanzi.ttf", $dz[0]);
        ImageTTFText($im, 9, 0, 69, 140, $ys,"shengfenzheng/hanzi.ttf", $dz[1]);
    }
    ImageTTFText($im, 12, 0, 120, 188, $ys,"shengfenzheng/shuzi.ttf", $hm);
    copy($tx,"tmp/" . $rand . "/image1.gif");
    $strim = imagecreatefromgif("tmp/" . $rand . "/image1.gif");
    $size = getimagesize("tmp/" . $rand . "/image1.gif");
    imagecopy($im,$strim,220,30,0,0,$size[0],$size[1]);
    imagedestroy($strim);
    imagepng($im,"tmp/" . $rand . "/word/media/image1.png");
    imagedestroy($im);
    require_once('shengfenzheng/pclzip.lib.php');
    copy("shengfenzheng/sfz.docx","tmp/" . $rand . "/sfz.docx");
    $archive = new PclZip("tmp/" . $rand . "/sfz.docx");
    $v_list = $archive->add("tmp/" . $rand . "/word/media/image1.png",PCLZIP_OPT_REMOVE_PATH,"tmp/" . $rand);
    readfile("tmp/" . $rand . "/sfz.docx");
}
?>