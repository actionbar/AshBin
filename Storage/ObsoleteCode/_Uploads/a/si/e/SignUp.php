<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>V-Get! 帐号</title>
<link href="http://weigeti.com/i0/i.ico" type="image/ico" rel="shortcut icon" />
</head>
<link href="http://weigeti.com/i0/c.css" type="text/css" rel="stylesheet" />
<link href="http://weigeti.com/i0/vi/e/sign.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://weigeti.com/i0/c.js"></script>
</head>
<body>
<div class="wt">
<div class="w">
<div class="i"></div>
<div class="v"><div class="mh"></div>
<div class="a"><a href="#" class="ao">个人注册</a><a href="#">企业注册</a><div class="o"></div></div>

<div class="l p">
<form action="http://i.v-get.com/e/SignUpNotify?lk=<?php echo urlencode('http://www.v-get.com/');?>" method="post" id="s">
<div class="s"><label><i>*</i>用户名：</label><input type="text" name="su" placeholder="姓名/中英文/昵称"/><span class="s0">中文2-15位/英文4-30位<a href="#" title="注册之后，不能修改">？</a></span><span class="s1">中文2-15位/英文4-30位</span><span class="s2">&nbsp;</span><span class="s3">该用户名已注册，请<a href="#">直接登录</a></span><div class="o"></div></div>
<div class="s"><label><i>*</i>邮箱：</label><input type="text" name="se" size="20"/><span class="s0">没有邮箱？<a href="">用手机注册</a></span><span class="s1">请输入正确的邮箱地址</span><span class="s2">&nbsp;</span><span class="s3">该邮箱已注册，请<a href="#">直接登录</a></span><div class="o"></div></div>
<div class="s"><label><i>*</i>密码：</label><input type="password" name="sp" size="16"/><span class="s0">密码为6-16位</span><span class="s1">密码为6-16位</span><span class="s2">&nbsp;</span><div class="o"></div></div>

<div class="s"><label><i>*</i>验证码：</label><input type="text" name="svc" class="svc" maxlength="4"/><span id="svi"><img src="http://i.v-get.com/j/svc?r=<?php echo time();?>" /></span><span></span><div class="o"></div></div>
<div class="o mh"></div>
<div class="s"><label>&nbsp;</label><input type="submit" value="立即注册" class="ss"/><div class="o"></div></div>
</form>
<div class="lb"><p><a href="#">用户注册服务使用协议</a></p><p><a href="#">全国人大常委会关于加强网络信息保护的决定</a></p></div>

</div>

<div class="r p">
<p class="rt">已有帐号，<a href="#">直接登录»</a></p><p class="r2">您可以同时登录：</p><p class="f7">物流查询：</p><p class="f6"><a href="http://wuliu.v-get.com/">商务物流网</a></p><p class="f7">互联网营销：</p><p class="f6"><a href="http://e.v-get.com/">E维科技，互联网营销专家</a></p><p class="f7">更多的商务站点登录服务</p>
</div>
<div class="o mh"></div>
<div class="b">
<a href="#">商务客服</a><a href="#">意见反馈</a><a href="#">企业认证及合作</a><a href="#">开放平台</a><a href="#">招贤纳才</a><a href="#">商务网导航</a><a href="#">不良信息举报</a></p>
<p>客服电话：400 000 0000（个人） 400 888 8888（企业） (按当地市话标准计费)</p>
<p style="position:relative"><i></i>浙江商务营销网络技术有限公司 <a href="#">浙网文[2011]0398-130号</a><a href="http://www.miibeian.gov.cn" rel="nofollow">备ICP证12013909号</a><span class="h4r">Copyright &copy; 2012-2013 V-Get!</span></p>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="http://weigeti.com/i0/l.js"></script>
<script type="text/javascript">

E($('svi'),$7,function(){var d=new Date();$('^img',this)[0].src='http://i.v-get.com/j/svc?r='+d.getTime();});

(function(s){var u=s.su,e=s.se,p=s.sp,a=[u,e,p],n=function(o,n){return $('^span',o.parentNode)[n?n:0]},d=function(o){return o.style.display!='none'?$1:$0};

function f(){F(a,function(x,j){var k=L8(x.value),a=n(x,1),b=n(x,2),h=function(j){
if(j){D(b,1);D(a)}else{D(b);D(a,1)}};
if(d(n(x)))D(n(x));if(k<1){D(a);D(b)}
if(k>0){
if(j==0)h(k>3&&k<31);if(j==1)h(/^([\w\.\-])+\@(([\w\-\.])+\.)+([a-z0-9]{2,4})+$/.test(x.value));if(j==2)h(k>5&&k<17);
}
});}

F(a,function(o,i){
for(var r=0;r<3;r++)D(n(o,r));

E(o,'mousedown',function(){D(n(u,3));D(n(e,3));f();if(!N(this.value)&&!d(n(this,2))&&!d(n(this,1)))D(n(this),1);});
E(o,'input',function(){if(i==1)this.value=this.value.toLowerCase();f()});
s.onsubmit=function(){var b=$0;
F($('^span.s2'),function(x){b=d(x)});

if(b&&L(s.svc.value)==4){

$A('http://i.v-get.com/j/SignUp_check','&su='+u.value,0,function(h){
if(h==1||h=='1'){D(n(u,2));D(n(u,3),1)}else $A('http://i.v-get.com/j/SignUp_check','&se='+e.value,0,function(h){if(h==1||h=='1'){D(n(e,2));D(n(e,3),1)}else s.submit()});
});
return $0;
}
else {alert("请按要求填写完整");return $0}}
});






})($('s'));
</script>
</body></html>