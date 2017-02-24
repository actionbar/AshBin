<?php
$QC=mysql_connect('localhost','root','qwdw114');mysql_select_db('ve',$QC);mysql_query('set names "UTF-8"');
$Query=FALSE;
$F='';$D='';
?>
<!DOCTYPE html><html><head><title>物流企业</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="http://localhost/tu.v-get.com/i.css" rel="stylesheet" type="text/css"  />
<link href="http://localhost/tu.v-get.com/f.css" rel="stylesheet" type="text/css"  />
<link href="http://localhost/tu.v-get.com/fe.css" rel="stylesheet" type="text/css"  />
<style>
</style>
</head>
<body>
<div style="height:28px;background:#333;color:#FFF;padding:0 3px;font-weight:700;line-height:28px" id="toptitle"><form method="get">查询l <input type="text"style="width:200px;border:0"   name="fel"><input type="submit" value="查询"></form></form></div>
<div class="p" style="width:46%">
<form id="fes" method="post">
<!-- fevgtsid 站点id-->
<input type="hidden" name="comes">
<input type="hidden" name="fevgtsid" value="33">
<input type="hidden" name="fevgtusr" value="FWnO62Mdvfom3">
<input type="hidden" name="fevgtpass" value="D2va0w5r32HjI56">

<p><label>i</label><input type="text" name="feio" placehold="fei" style="width:50px" value="" readonly="readonly"><input type="hidden" name="fei">
<label>m 英文</label><input type="text" name="femo" placeholder="fem:wuliu.v-get.com/yiwukb" style="width:135px" value=""><input type="hidden" name="fem">
<label>e 三级域名前缀</label><input type="text" placeholder="fee:yiwukb.wuliu.v-get.com" style="width:133px" name="feeo" value=""><input type="hidden" name="fee">
</p><p>
<select name="fea"><option>a类别</option><option value="1">托运</option><option value="2">仓库</option><option value="3">搬家</option><option value="4">货车</option><option value="5">客运</option><option value="6">保留</option><option value="7">联运货场</option><option value="8">设备</option><option value="9">货代</option></select>
<!--yiwu= sh= 用于上传图片的时候确定目录-->
<select name="feb"><option>b城市</option><option value="330782">yiwu=义乌市</option><option value="310000">sh=上海市</option></select>
<span id="cselect"></span>
<label>头像名称</label><input style="visibility:hidden" type="text"  name="fep" placeholder="fep" value="">
</p>
<p><label>标题：</label><input type="hidden" name="feh"/><input type="text" style="width:380px" id="feho"placeholder="feh" />75&gt;<span style="color:#080"></span><input type="text" style="width:120px;margin:0 5px;border:0;background:none;" name="fet" value="<?php echo date('Y-m-d H:i:s');?>" readonly="readonly"/><input type="checkbox" id="feto" title="点击此可以停止时间，用于修改时间"><input type="hidden" name="fett" value=""/></p>

<p><label>QQ等</label><input style="width:250px" type="text" placeholder="feq:Q23425^Eabc@qq.com"name="q" value="">
<select name="fev"><option value="0">0认证</option><option value="1">1个人</option><option value="2">2企业</option><option value="3">3法人</option></select>
<label>评分o</label><input placehold="feo:提交后自动计算" type="text" name="feo" value="">
</p><p>
<label>坐标</label><input type="text" placeholder="fez" name="fez" value=""><input type="button" style="margin:0 0 0 9px;width:50px;height:24px" value="发布" id="fesubmit"/></p>
<div style="height:60px"><span><label>简介：</label><textarea id="fedo" placeholder="fed" style="width:83%;height:60px"><?PHP echo $D;?></textarea>255&gt;<i style="color:#080"></i><input type="hidden" name="fed" value=""/></span></div>
<br>
<div id="tempf" class="pn"><?php echo $F;?></div>

<div class="o"></div>
</form>
</div>



<div id="fefrt"></div>
<script type="text/javascript" src="http://localhost/tu.v-get.com/i.js"></script>
<script type="text/javascript" src="http://localhost/tu.v-get.com/l.js"></script>
<script type="text/javascript" src="http://localhost/tu.v-get.com/fe.js"></script>
<script type="text/javascript" src="fe.js"></script>
<script type="text/javascript">
//这里必须放在fe.js上面
// 上传图片地址，要包含用户名+验证码，避免被黑客利用上传
//FEIUP是上传图片的，避免被黑客利用，所以这里伪装名称url_301 
var FE_IUP='#';
var FE_EditorClass=9;





//需要对echo出来的值转码， &#34;等 echo出来的就是 " 而textarea输出就是 " 而不是 &$34;
//而且也不能用 input存，因为f里面会有 "，遇到input会遇到麻烦
//不能用textarea，否则对pre 里面的 &#34;自动替换成 "
H($("fefo"),H($("tempf")));
</script>
</body></html>