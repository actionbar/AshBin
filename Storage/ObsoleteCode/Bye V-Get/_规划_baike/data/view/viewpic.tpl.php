<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>
<style type="text/css">
<!--
.a-img1 img {
max-width:60px;
max-height:60px;
width: expression(this.width > 60 && this.width/this.height >= 1 ? 60 : true);
height: expression(this.height > 60 && this.width/this.height < 1 ? 60 : true);
}
.arrleft {
	cursor: url("style/default/arr_left.cur"), auto;
}
.arrright {
	cursor: url("style/default/arr_right.cur"), auto;
}
-->
</style>

<script type="text/javascript">
function updateverifycode() {
	var img = "index.php?user-code-"+Math.random();
	$('#verifycode').attr("src",img);
}
var pic={
	max_num:<?php echo $max_num?>,//所有的相关图片总数量（相同did的图片总数）。
	all_key:<?php echo $all_key?>,//当前展示图片在总图片列表中的位置，不断变化，范围0 —（max_num-1）。
	li_key:<?php echo $li_key?>,//当前图片在本页显示的列表中的位置，不断变化，范围0 — 11。
	start_key:<?php echo $all_key?>-<?php echo $li_key?>,//本页面图片列表的起始值,变化的值，范围0 —（max_num-max_li）。
	max_li:<?php echo $max_num?><12?<?php echo $max_num?>-1:11,//本页展示的列表图片总数量-1的值。
	did:<?php echo $did?>,//词条的did。
	mousemove:false,
	obj:'',
	p:0,
	x:0,//记录鼠标位置
	
	change_pic:function(id,key) {//根据图片id返回本页面需要的数据。
		$.ajax({
			url: "index.php?pic-ajax",
			dataType: "xml",
			type:"post",
			data: { id:id },
			success: function(xml){
				pic.insert_data(xml);//插入更改数据。
			}
		});
		this.change_key(key);
	},
	insert_data:function(xml){
		data=xml.getElementsByTagName("pic")[0].childNodes;
		for(var i=0;i<=5;i++){
			$('#p_'+i).html(data[i].childNodes[0].nodeValue).fadeIn("slow");
		}
	},
	change_key:function(key){//图片改变了，相应的值也要改变。
		this.all_key+=key-this.li_key;
		this.li_key=key;
		this.pic_p_n();
	},
	pic_p_n:function(){
		pic.obj.removeClass('arrleft arrright');
		if(this.max_num==1){
			$('#pre_pic').hide();
			$('#next_pic').hide();
			pic.mousemove = false;
		}else if(this.all_key==0){
			$('#pre_pic').hide();
			$('#next_pic').show();
			pic.mousemove = false;
			pic.p = 1;
			pic.obj.addClass('arrright');
		}else if(this.all_key==this.max_num-1){
			$('#next_pic').hide();
			$('#pre_pic').show();
			pic.mousemove = false;
			pic.p = -1;
			pic.obj.addClass('arrleft');
		}else{
			$('#pre_pic').show();
			$('#next_pic').show();
			pic.mousemove = true;
			var pos = pic.obj.offset().left+(pic.obj.width()/2);
			pic.p = (pic.x>pos?1:-1);
			pic.pic_cursor();
		}
	},
	change_list:function(type){
		var startKey,i;
		startKey=(type==1)?this.start_key+type+12:this.start_key+type;
		if((arguments[1]!=null)||(this.max_num>12&&startKey>=0&&startKey<=this.max_num)){
		//从next_id过来的，或者满足条件：总数超过12个，并且start_key左翻、右翻，都在范围内。
			if(type==1){
				i=this.max_num-startKey;
				this.start_key=(i>12)?startKey:this.max_num-12;
			}else{
				i=this.start_key-12;
				this.start_key=(i>0)?i:0;
			}
			if(arguments[1]!=null){
				this.all_key+=type;
				this.li_key=this.all_key-this.start_key;
			}else{
				this.li_key=0;
				this.all_key=this.start_key;
			}
			$.ajax({
				url: "index.php?pic-ajax",
				dataType: "xml",
				type:"post",
				data: { did:this.did,start_key:this.start_key,li_key:this.li_key },
				success: function(xml){
					var	data=xml.getElementsByTagName("list")[0].childNodes[0].nodeValue;
					$('#pic_list').html(data);
					pic.insert_data(xml);
				}
			});
			this.li_p_n();
			this.pic_p_n();
		}
	},
	li_p_n:function(){
		if(this.start_key==0){
			$('#pre_li')[0].src='style/default/tpbk/view_prev2.jpg';
			$('#next_li')[0].src='style/default/tpbk/view_next.jpg';
		}else if(this.start_key+12==this.max_num){
			$('#pre_li')[0].src='style/default/tpbk/view_prev.jpg';
			$('#next_li')[0].src='style/default/tpbk/view_next2.jpg';
		}else{
			$('#pre_li')[0].src='style/default/tpbk/view_prev.jpg';
			$('#next_li')[0].src='style/default/tpbk/view_next.jpg';
		}
	},
	next_id:function(type) {
		var key=this.li_key+type;
		if(this.max_num>12&&((this.li_key==0&&type==-1)||(this.li_key==this.max_li&&type==1))){//可能需要翻页了。li_key已经到了两端。
			var isend=this.all_key+type;
			if(isend>=0&&isend<=this.max_num-1){//确实需要翻页。总数超过12个，并且本页的尽头并不是总图片的尽头(左边再往左翻就是负数)。
				this.change_list(type,true);
			}
		}else{
			$("#li_"+key).click();
		}
	},
	pic_next:function() {
		pic.obj.bind('click', function(){pic.next_id(pic.p);});
		pic.obj.mousemove(function(e){
			pic.x=e.clientX;//得到当前的鼠标值。
			if(pic.mousemove){
				var pos = pic.obj.offset().left+(pic.obj.width()/2);
				if(pic.p != (pic.x>pos?1:-1)){
					pic.p = (pic.x>pos?1:-1);
					pic.pic_cursor();
				}
			}
			return false;
		});
	},
	pic_cursor:function(){
		if(pic.p<0){
			pic.obj.removeClass('arrright');
			pic.obj.addClass('arrleft');
		}else{
			pic.obj.removeClass('arrleft');
			pic.obj.addClass('arrright');
		}
	}
}

$(function(){
	pic.obj = $("#p_0");
	pic.pic_p_n();
	if(pic.max_num<=12){
		$('#pre_li')[0].src='style/default/tpbk/view_prev2.jpg';
		$('#next_li')[0].src='style/default/tpbk/view_next2.jpg';
	}else{
		pic.li_p_n();
	}
	pic.pic_next();
});
</script>

<div class="tupk_view">
<div class="m-t10  view_img">
<a href="javascript:pic.change_list(-1)"  class="view_p"><img id="pre_li" src="style/default/tpbk/view_prev.jpg"/></a>

<ul class="j-zhong" id="pic_list">
<?php foreach((array)$piclist as $key=>$data) {?>
<li id="li_<?php echo $key?>" onclick="pic.change_pic(<?php echo $data['id']?>,<?php echo $key?>)"><a href="javascript:void(0);" class="a-img1"><img src="<?php echo $data['attachment']?>" alt="<?php echo $data['description']?>" /></a></li>
<?php }?>
</ul>

<a href="javascript:pic.change_list(1)" class="view_n"><img id="next_li" src="style/default/tpbk/view_next.jpg" /></a>
</div>


<div class="a-c"><!--需要控制ie6下图片的最大宽度为930px;-->
<p class="view_datu" id="p_0"><img src="<?php echo $pic['attachment']?>"/></p>
<p id="fenye" class="w-230 wrap"><span id="pre_pic"><a href="javascript:pic.next_id(-1)" class="m-lr8">上一张</a></span><span id="next_pic"><a href="javascript:pic.next_id(1)" class="m-lr8">下一张</a></span></p>
	<div class="w-630 wrap">
	<table cellpadding="0" cellspacing="0" class="table m-t10 a-l tupian_info" >
		<colgroup>
			<col class="bg-gray" style="width:190px;"></col>
			<col style="width:450px;"></col>
		</colgroup>
		<tr>
			<td>图片标题</td>
			<td id="p_1"><?php echo $pic['description']?></td>
		</tr>
		<tr>
			<td>所属词条</td>
			<td><?php echo $pic['title']?></td>
		</tr>
		<tr>
			<td>内容简介</td>
			<td><?php echo $pic['summary']?> ... [ <a href="wiki/<?php echo rawurlencode($pic['rawtitle']);?>" target="_blank">进入词条</a> ][ <a href="index.php?comment-view-<?php echo $pic['did']?>" target="_blank">查看评论</a> ]</td>
		</tr>
		<tr>
			<td>图片尺寸</td>	
			<td id="p_2"><?php echo $pic['fileborder']?></td>
		</tr>	
		<tr>
			<td>图片大小</td>
			<td id="p_3"><?php echo $pic['filesize']?></td>
	
		</tr>
		<tr>
			<td>图片格式</td>
			<td id="p_4"><?php echo $pic['filetype']?></td>
		</tr>	
		<tr>
			<td>上传作者</td>
			<td id="p_5"><a href="index.php?user-space-<?php echo $pic['uid']?>" target="_blank"><?php echo $pic['username']?></a></td>
		</tr>
		</table>
	</div>
	<div class="w-630 a-l wrap columns comment">
		<h2 class="col-h2">相关词条评论</h2>
		<a href="index.php?comment-view-<?php echo $pic['did']?>" target="_blank" class="more">查看更多&gt;&gt;</a>
		<table width="100%" cellpadding="0" cellspacing="0" class="table tpbk_content" >
		<thead>
		<tr>
			<td width="65%" >内容</td>
			<td width="20%" >作者</td>
			<td width="15%" >时间</td>
		</tr>
		</thead>
		<tbody>
		
		<?php foreach((array)$comments as $key=>$comment) {?>
		<tr>
			<td><?php echo $comment['comment']?></td>
			<td><a href="index.php?user-space-<?php echo $comment['authorid']?>" target="_blank"><?php echo $comment['author']?></a></td>
			<td><?php echo $comment['time']?></td>
		</tr>
		<?php }?>
		
		</tbody>
		</table>
		<form method="post" action="index.php?comment-add-<?php echo $pic['did']?>">
		<ul class="col-ul">
			<li>
			<textarea id="comment" name="comment" rows="10" cols="80"  class="area"></textarea> 
			<?php if($setting['comments']) { ?>
			<input id='anonymity' name="anonymity" type="checkbox"  />&nbsp;匿名
			<?php } ?>
			</li>
			
			<li class="yzm">
			<?php if($setting['checkcode'] != "3") { ?>
			<span>验证码: </span><input name="code" type="text" /><label class="m-lr8"><img id="verifycode" src="index.php?user-code" onclick="updateverifycode();" /></label><a href="javascript:updateverifycode();">换一个</a>
			<?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;
			<span>注: 评论长度最大为200个字符。</span>
			</li>
			<li>
			<input name="submit" type="submit" value="发表评论" class="btn_inp"/>
			</li>
		</ul>
		</form>
	</div>
	</div>

</div>
<?php include $this->gettpl('footer');?>