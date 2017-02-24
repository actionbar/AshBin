<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>
<div class="l w-710">
	<div class="columns">
		<h2 class="col-h2">兑换规则</h2>
		<div class="jfhl_theme i6-ff">
		<p class="l">欢迎来到礼品商店，各种丰厚的礼品供您选择。只要您是本站的注册用户，并通过编辑词条积累了一定的金币，就可以在这里挑选兑换自己喜爱的礼品。</p>
		<img alt="换礼流程" src="style/default/jfhl/theme_bg.gif"/>
		</div>
	</div>
	
	<div id='block_price'><?php $data= $GLOBALS['blockdata'][11];$bid="11"?>﻿<div class="columns" bid="<?php echo $bid?>">
	<h2 class="col-h2">选择价格范围</h2>
	<ul class="col-ul i6-ff  list-s2">
	<?php foreach((array)$data['minprice'] as $index=>$price) {?>
		<li><a href="index.php?gift-default-<?php echo $price?>-<?php echo $data['page']?>" ><?php echo $price?>-<?php echo $data['maxprice'][$index]?> 金币</a></li>
	<?php }?>
	</ul>
</div></div>

	<div class="columns redeed_present">
		<h2 class="col-h2">兑换礼品</h2>
		<ul class="col-ul i6-ff j-zhong">
			<?php foreach((array)$giftlist as $gift) {?>
				<li>
				<a class="a-img1">
				<img name="img_gift" id="gift<?php echo $gift['id']?>" alt="<?php echo $gift['title']?>"  src="<?php echo $gift['image']?>" onclick="open_img(this)" />
				</a>
					<?php if($gift['credit']>$user['credit1'] ) { ?>
						<p title="<?php echo $gift['title']?>"><a href="javascript:alert('您的金币不够,攒够金币再来兑换吧-_-!');"><?php echo $gift['shorttitle']?></a>所需金币:<?php echo $gift['credit']?></p>
						<a href="javascript:alert('您的金币不够,攒够金币再来兑换吧-_-!');"  class="redeem"><img src="style/default/jfhl/nredeem.gif"/></a>
					<?php } else { ?>					
						<p title="<?php echo $gift['title']?>"><a id="title<?php echo $gift['id']?>" href="javascript:apply(<?php echo $gift['id']?>);"><?php echo $gift['shorttitle']?></a>所需金币:<?php echo $gift['credit']?></p>
						<a href="javascript:apply(<?php echo $gift['id']?>);"  class="redeem"><img src="style/default/jfhl/redeem.gif"/></a>	
					<?php } ?>
					
				</li>
				<div  id="credit<?php echo $gift['id']?>" style="display:none"><?php echo $gift['credit']?></div>
				<div  id="description<?php echo $gift['id']?>" style="display:none"><?php echo $gift['description']?></div>
			<?php } ?>
		</ul>
		 <div id="fenye" class="m-t10 a-r"> 
			<?php echo $departstr?>
		</div>
	</div>
</div>

<div class="r w-230">
	<div class="columns a-c p-b10">
		<p class="col-p a-l">如果有疑问，请<a href="index.php?doc-innerlink-<?php echo urlencode('联系我们')?>" >联系站长或管理员！</a></p>
		
	</div>
	<div class="columns p-b10">
		<p class="col-p m-t10 break">
		<?php echo $setting['gift_notice']?>
		</p>
	</div>
	<!--div id="block_right"><?php $data= $GLOBALS['blockdata'][12];$bid="12"?><div class="columns redeed_present" bid="<?php echo $bid?>">
<p class="red col-p"><?php echo $data?></p>
</div></div-->
	<div class="columns" id="zxdtold">
		<h2 class="col-h2">最新动态</h2>
		<div id="zxdt">
			<?php foreach((array)$loglist as $giftlog) {?>
			<p class="col-p"><a href="index.php?user-space-<?php echo $giftlog['uid']?>" class="red"><?php echo $giftlog['username']?></a>的<span color="blue"><?php echo $giftlog['title']?></span>兑换申请已经通过，请等候发放。</p>
			<p class="col-p"><a href="index.php?user-space-<?php echo $giftlog['uid']?>" class="red"><?php echo $giftlog['username']?></a>：给我来个<span color="blue"><?php echo $giftlog['title']?></span> 。</p>
			<?php } ?>
		</div>
	</div>	
</div>

<div id="gift_dialog" style="display:none">
	<form id="giftform"  action="index.php?gift-apply" method="post">
	<input id="gid"  type="hidden" name="gid" value="" />
	<div class="i6-ff lp_info" style="text-align:left;line-height:22px;">
		<div class="l j-zhong lp_img_turn">			
			<img id="giftdiv" src="style/default/jfhl/lp_01.jpg" width="106px" height="106px"/>
		</div>
		<h3 class="h2 blue m-t8" id="titlediv">kjhkjhkjh</h3>
		<ul class="m-t8">
			<li	id="creditdiv">lkj</li>
			<li	id="descriptiondiv">lkjklj</li>
		</ul>
	</div> 
	<p class="red col-p"><img src="style/default/jfhl/redeem_tips.gif"/>提示：请认真填写您的信息，以确保兑换的礼品能准确及时送达！</p>
	<ul class="m-t8 ul_l_s real_info" style="text-align:left">
	<li><span>真实姓名：</span><input id="truename" name="truename" type="text" class="inp_txt" value="<?php echo $user['truename']?>"/><label class="red">*</label><label class="red" id="v_truename">（很重要，请仔细填写）</label></li>
	<li><span>电话：</span><input id="telephone" name="telephone" type="text" class="inp_txt" value="<?php echo $user['telephone']?>"/><label class="red">*</label><label class="red" id="v_telephone">（很重要，请仔细填写）</label></li>
	<li><span>E-mail：</span><input id="email" name="email" type="text" class="inp_txt" value="<?php echo $user['email']?>"/><label class="red">*</label><label class="red" id="v_email"></label></li>
	<li><span>邮寄地址：</span><input id="location" name="location" type="text" class="inp_txt" size="50" value="<?php echo $user['location']?>"/><br/><label class="red">*</label><label class="red" id="v_location">（很重要，请仔细填写）</label></li>
	<li><span>邮编：</span><input id="postcode" name="postcode" type="text" class="inp_txt" value="<?php echo $user['postcode']?>"/><label class="red">*</label><label class="red" id="v_postcode"></label></li>
	<li><span>备注：</span><textarea name="extra" rows="3" cols="45"></textarea></li>
	<li><span>QQ号：</span><input name="qq" type="text"class="inp_txt" value="<?php echo $user['qq']?>" /></li>
	<li><input name="submit" type="submit" value="确定" class="btn_inp"/><input name="cancel" type="button" value="取消" class="btn_inp" onclick="javascript:mycancel();" /></li>
	</ul>
	</form>
</div>
<div class="c-b"></div>
<script type="text/javascript" src="js/validator.js"></script>
<script type="text/javascript">
var Validator_giftform;

$(document).ready(function(){
	if($("#zxdt").height()>464){
		$("#zxdt").height(440);
		$("#zxdt").css("overflow","hidden");
	};
	
	(function(zxdt, delay, speed, lh){
		 var rotator = document.getElementById(zxdt);
		 var delay = delay || 3000, speed = speed || 20, lh = lh || 20;
		 var tid = null, pause = false;
		 var start = function(){
			 tid = setInterval(rotation, speed);
		 }
		 var rotation = function(){
			 if (pause) return;
			 rotator.scrollTop += 1;
			 if (rotator.scrollTop % lh == 0){
				 clearInterval(tid);
				 if(typeof(rotator.getElementsByTagName('p')[0]) != "undefined"){
					 rotator.appendChild(rotator.getElementsByTagName('p')[0]);
					 rotator.scrollTop = 0;
					 setTimeout(start, delay);
				 }
			 }
		 }
		rotator.onmouseover = function(){ pause = !pause; }
		rotator.onmouseout = function(){ pause = !pause; }
		setTimeout(start, 1000);
	})('zxdt', 3000, 40, 440);
});

function apply(gid){
	$("#gid").attr('value',gid);
	$("#giftdiv").attr("src",$("#gift"+gid).attr("src"));
	$("#titlediv").html(' 您兑换的奖品：'+$("#title"+gid).html() );
	$("#creditdiv").html( '<span >所需金币：</span><b class="red">'+$("#credit"+gid).html()+'</b>' );
	$("#descriptiondiv").html( '<span >礼品描述：</span>'+$("#description"+gid).html() );
	
	//$.dialog.open('gift', '奖品兑换申请', 'selector:#gift_dialog');
	$.dialog({
		id:'gift',
		title:'奖品兑换申请',
		type:'selector',
		content:'#gift_dialog',
		width:500
		
	});
	$("#gift_dialog").empty();
	
	if(!Validator_giftform){
		Validator_giftform=new Validator("giftform",false,null);
		Validator_giftform.bind("truename",[["empty","真实姓名不能为空"]]);
		Validator_giftform.bind("telephone",[["empty","电话不能为空"],["phone","电话格式不正确"]]);
		Validator_giftform.bind("email",[["empty","email不能为空"],["email","email格式不正确"]]);
		Validator_giftform.bind("location",[["empty","邮寄地址不能为空"]]);
		Validator_giftform.bind("postcode",[["empty","邮编不能为空"],["zip","邮编格式不正确"]]);
	}
}

function mycancel(){
	$.dialog.close('gift');
}

function open_img(E){
	var path=E.src;
	$.dialog.open('gift_img', E.alt, 'img:'+path.replace("_s.", '.'),'c');
}
</script>
<?php include $this->gettpl('footer');?>
