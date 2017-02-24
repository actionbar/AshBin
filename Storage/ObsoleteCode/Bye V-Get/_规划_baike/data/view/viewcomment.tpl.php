<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php include $this->gettpl('header');?>
<style type="text/css">
<!--
.li_pading li {
	margin:5px 0;
	text-align:left;
}
-->
</style>
<script type="text/javascript">
	$._dialog.defaults.height=180;
	$._dialog.defaults.width=250;
	function colorTip(tip){
			return '<font color=red>'+tip+'</font>';
		}
	
	num=<?php echo $num?>;
	function closepop(){
		var name='tips';
		$.dialog.close(name);
	}
	function bytes(str){
		var len=0;
		for(var i=0;i<str.length;i++){
			if(str.charCodeAt(i)>127){
				len++;
			}
			len++;
		}
		return len;
	}
	function updateverifycode(num) {
		var img = "index.php?user-code-"+Math.random();
		$('#verifycode'+num).attr("src",img);
	}
		
	function aegis_comment(id){
		$.post("index.php?comment-aegis",{'id':id},function(xml){
			var message=xml.lastChild.firstChild.nodeValue;
			if(message>='0'){
				$('#a_'+id).html(parseInt($('#a_'+id).html())+1);
			}else{
				$.dialog.box('tips', '评论提示', colorTip('您已经点击过了。'));
				setTimeout("closepop()",1000);
			}
			$('#ae_'+id).html('已支持');
		});
	}
	
	function oppose_comment(id){
		$.post("index.php?comment-oppose",{'id':id},function(xml){
			var message=xml.lastChild.firstChild.nodeValue;
			if(message>='0'){
				$('#o_'+id).html(parseInt($('#o_'+id).html())+1);
			}else{
				$.dialog.box('tips', '评论提示', colorTip('您已经点击过了。'));
				setTimeout("closepop()",1000);
			}
			$('#op_'+id).html('已反对');
		});
	}
	
	function del_comment(id){
		$.ajax({
			url: "index.php?comment-remove",
			cache: false,
			dataType: "xml",
			type:"post",
			//async:false, 
			data: {id:id,did:<?php echo $doc['did']?>,page:$('#page').html()},
			success: function(xml){
				var	message=xml.lastChild.firstChild.nodeValue;
				if(message!=0){
					$.dialog.box('tips', '评论提示',colorTip( '删除评论成功！'));
					if(message!=1){
						$('#c_content').html(message);
					}else{
						$("#c_"+id).parent().parent().empty().hide();
					}
					$('#c_num').html(+$('#c_num').html()-1);
				}else{
					$.dialog.box('tips', '评论提示', colorTip('发生意外错误。'));
				}
				setTimeout("closepop()",1000);
			}
		});
	}
	
	function edit_comment(id){
		var comment=$('#c_'+id).html();
		var msg="<ul class='li_pading'><li><textarea id='editcomment' name='editcomment' cols='50' rows='6' >"+comment+"</textarea></li>"+
		"<li><input name='editsubmit' class='btn_inp' type='button' onclick='saveedit("+id+")' value='提交'>"+
		"&nbsp;&nbsp;&nbsp;<input name='cancel' class='btn_inp' type='button' onclick='closepop()' value='取消'></li>";
		$.dialog.box('tips', '评论修改', msg);
	}
	
	function reply_comment(id){
		var msg="<ul class='li_pading'><li><textarea id='replycomment' name='replycomment' cols='50' rows='6' ></textarea></li><?php if($setting['checkcode'] != "3") { ?><li class='yzm'>验证码：<input name='code' id='code2' type='text' size='4' /><label class='m-lr8'><img id='verifycode2' src='' onclick='updateverifycode(2);' /></label><a href='javascript:updateverifycode(2);'>换一个</a></li><?php } ?>"+"<li><?php if($anonymity) { ?><input id='replyanonymity' name='replyanonymity' type='checkbox'/>&nbsp;匿名<?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;评论长度最大为200个字符。</li>"+"<li><input name='replysubmit' class='btn_inp' type='button' onclick='submitcomment("+id+")' value='提交'>"+"&nbsp;<input name='cancel' class='btn_inp' type='button' onclick='closepop()' value='取消'></li></ul>";
		$.dialog.box('tips', '评论回复', msg);
		setTimeout("updateverifycode(2)",100);
	}
	
	function report_comment(id){
		var msg="<div>举报原因</div><textarea id='reportcomment' name='reportcomment' cols='50' rows='4' ></textarea><br/>				<input name='reportcomment' class='btn_inp' type='button' onclick='save_report("+id+")' value='提交'>&nbsp;&nbsp;&nbsp;<input name='cancel' type='button' class='btn_inp' onclick='closepop()' value='取消'>";
		$.dialog.box('tips', '评论举报', msg);
	}
	
	function save_report(id){
		var report=$("#reportcomment").val();
		if(report==""){
		    alert('举报原因不能为空。');
		    return false;
		}else if(bytes(report)>200){
			alert('举报原因长度最大为200个字符。');
			return false;
		}
		$.post("index.php?comment-report",{'id':id,'report':report},function(xml){
			var message=xml.lastChild.firstChild.nodeValue;
			if(message>=0){
				$.dialog.box('tips', '评论信息', colorTip('非常感谢，举报成功！'));
			}else{
				$.dialog.box('tips', '评论信息', colorTip('出现故障，举报失败！'));
			}
			setTimeout("closepop()",1000);
		});
	}
	
	function saveedit(id){
		var comment=$.trim($('#editcomment').val());
		if(comment==""){
			alert("评论不能为空。");
			return false;
		}else if(bytes(comment)>200){
			alert('评论长度最大为200个字符。');
			return false;
		}
		$.ajax({
			url: "index.php?comment-edit",
			dataType: "xml",
			type:"post",
			//async:false, 
			data: {id:id,comment:comment},
			success: function(xml){
				var message=xml.lastChild.firstChild.nodeValue;
				if(message=='1'){
					$.dialog.box('tips', '评论信息', colorTip('评论修改成功！'));
					$('#c_'+id).html(comment);
				}else{
					$.dialog.box('tips', '评论信息', colorTip('发生意外错误。'));
				}
				setTimeout("closepop()",1000);
			}
		});
	}
	
	function submitcomment(re_id){
		var comment,anonymity;
		if(re_id==0){
			var com_obj=$('#comment');
			var code=$('#code').val();
			anonymity =$('#anonymity').attr('checked')?1:0;
		}else{
			var com_obj=$('#replycomment');
			var code=$('#code2').val();
			anonymity =$('#replyanonymity').attr('checked')?1:0;
		}
		comment=$.trim(com_obj.val());
		if(comment==""){
		    alert('评论不能为空。');
		    return false;
		}else if(bytes(comment)>200){
			alert('评论长度最大为200个字符。');
			return false;
		}
		var c_class=((+$('#c_num').html()) % num==0||$('#page').html()>1)?1:0;
		$.ajax({
			url: "index.php?comment-add-<?php echo $doc['did']?>",
			dataType: "xml",
			type:"post",
			//async:false, 
			data: {comment:comment,c_class:c_class,re_id:re_id,anonymity:anonymity,code:code},
			success: function(xml){
				var message=xml.lastChild.firstChild.nodeValue;
				if(message.substr(0,2)!='0;'){
					$.dialog.box('tips', '评论提示', colorTip('发表评论成功。'));
					if(c_class){
						$('#c_content').html(message);
					}else{
						move(0,message,'add');
					}
					$('#c_num').html(+$('#c_num').html()+1);
					com_obj.val("");
					updateverifycode(1);
					$.post("index.php?hdapi-hdautosns-comment-<?php echo $doc['did']?>", {comment:comment.substr(0, 40)});
				}else{
					$.dialog.box('tips', '评论提示',colorTip(message.substr(2)));
				}
				setTimeout("closepop()",1000);
			}
		});
		
		
	}
	
	function move(id,message,type){
		if(type=='add'){
			var n=1;
			var stand=num-1;
			for(i=stand;i>id;i--){
				var content = $('#li_'+(i-1)).html();
				$('#li_'+i).html(content);
				if(content!==''){
					$('#li_'+i).show();
				}else{
					$('#li_'+i).hide();
				}
			}
			$('#li_0').html(message).show();
		}
	}
</script>

<div id="map" class="hd_map"><a href="<?php echo WIKI_URL?>"><?php echo $setting['site_name']?></a> &gt;&gt;所属分类 &gt;&gt;<label id='catenavi'><?php foreach((array)$navigation as $category) {?> <a href="index.php?category-view-<?php echo $category['cid']?>" target=""> <?php echo $category['name']?> </a>&nbsp;&nbsp;<?php } ?></label></div>


<div class="l w-710 o-v comment">

<h1 class="title_thema bor_b-ccc" id="comment_tit"><strong class="l comment_thema" id="changename">关于“<?php echo $doc['title']?>”词条的评论（共<span id="c_num"><?php echo $doc['comments']?></span>条）</strong><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" class="r">返回词条</a></h1>
		<!--
		<cite><cite><span><label class="l">白色市<a href="#" target="_blank">momo</a>发表于40分钟前</label> 1楼</span>不错，去瞧瞧！！！赞！！！！</cite>
		<span><label class="l">白色市<a href="#" target="_blank">momo</a>发表于40分钟前</label> 1楼</span>不错，去瞧瞧！！！赞！！！！</cite>
		-->
<div id="c_content">
	<span id="page" style="display:none"><?php echo $page?></span>
	<?php foreach((array)$comments as $key=>$comment) {?>
	<?php if($comment!=='') { ?>
	<div class="columns" id="li_<?php echo $key?>">
		<span class="col-h2" id="u_<?php echo $comment['id']?>">
		<?php if($comment['authorid']==0 ) { ?><?php echo $comment['author']?><?php } else { ?><a href="index.php?user-space-<?php echo $comment['authorid']?>" ><?php echo $comment['author']?></a><?php } ?>
		</span>
		<span class="more gray">时间：<span class="gray"><?php echo $comment['time']?></span></span>
		<div class="com_content">

		<?php echo $comment['reply']?>
		<p class="m-t10" id="c_<?php echo $comment['id']?>"><?php echo $comment['comment']?></p>
		<p class="a-r">
			<span><img src="style/default/down.gif"/><span id="op_<?php echo $comment['id']?>"><a href="javascript:void(0)"  onclick="oppose_comment(<?php echo $comment['id']?>);">反对</a></span>(<span id="o_<?php echo $comment['id']?>"><?php echo $comment['oppose']?></span>)</span>
			
			<span><img src="style/default/up.gif"/><span id="ae_<?php echo $comment['id']?>"><a href="javascript:void(0)"  onclick="aegis_comment(<?php echo $comment['id']?>);" >支持</a></span>(<span id="a_<?php echo $comment['id']?>"><?php echo $comment['aegis']?></span>)</span>
			
			<?php if($audit_add) { ?>	
			<span><img src="style/default/reply.gif"/><a href="javascript:void(0)"  onclick="reply_comment(<?php echo $comment['id']?>);">回复</a></span>
			<?php } ?>
			
			<span><img src="style/default/jubao.gif"/><a href="javascript:void(0)"  onclick="report_comment(<?php echo $comment['id']?>);">举报</a></span>
			
			<?php if($audit_edit) { ?>
			<span><img src="style/default/ament.gif"/><a href="javascript:void(0)"  onclick="edit_comment(<?php echo $comment['id']?>);">修改</a></span>
			<?php } ?>
			
			<?php if($audit_delete) { ?>
			<span><img src="style/default/delete.gif"/><a href="javascript:void(0)"  onclick="del_comment(<?php echo $comment['id']?>);">删除</a></span>
			<?php } ?>
		  
		</p>
		</div>
	</div>
	<?php } else { ?>
	<div class="columns" id="li_<?php echo $key?>" style="display:none"></div>
	<?php } ?>
	<?php }?>
	
	<?php if($departstr) { ?>
	<div id="fenye" class="a-r m-t10"> 
	<?php echo $departstr?>
	</div>
	<?php } ?>
	
</div>


<?php if($audit_add) { ?>
<div class="columns comment">
	<h2 class="col-h2">对词条发表评论</h2>
	<form id="formcomment" name="formcomment"  method="POST" onsubmit="javascript:return false;">
	<ul class="col-ul">
		<li>
		<textarea id="comment" name="comment" rows="10" cols="95"  class="area"></textarea> 
		<?php if($anonymity) { ?>
		<input id='anonymity' name="anonymity" type="checkbox"  />&nbsp;匿名
		<?php } ?>
		</li>
		
		<li class="yzm">
		<?php if($setting['checkcode'] != "3") { ?>
		<span>验证码: </span><input name="code" id="code" type="text" /><label class="m-lr8"><img id="verifycode1" src="index.php?user-code" onclick="updateverifycode(1);" /></label><a href="javascript:updateverifycode(1);">换一个</a>
		<?php } ?>&nbsp;&nbsp;&nbsp;&nbsp;
		<span>注: 评论长度最大为200个字符。</span>
		</li>
		
		<li>
		<input name="button" type="button" value="发表评论" onclick="submitcomment(0)" class="btn_inp"/>
		</li>
		
	</ul>
	</form>
	
</div>
<?php } ?>
</div>


<div class="r w-230">
    <div id="block_right"><?php $data= $GLOBALS['blockdata'][15];$bid="15"?><div bid="<?php echo $bid?>" class="columns rpct <?php echo $data['config']['style']?>">
	<h2 class="col-h2">热评词条</h2>
	<ul class="col-ul">
		<?php foreach((array)$data['hotcomment'] as $key=>$doc) {?>
		<li><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" target="_blank"><?php echo htmlspecialchars(stripslashes($doc['title']));?>(<?php echo $doc['num']?>)</a></li>
		<?php }?>
	</ul>
</div></div>
    
	<div class="columns">
	<h2 class="col-h2">同分类词条</h2>
	<ul class="col-ul">
		<?php foreach((array)$categorydocs as $key=>$doc) {?>
		<li><a href="wiki/<?php echo rawurlencode($doc['rawtitle']);?>" target="_blank"><?php echo $doc['title']?></a></li>
		<?php }?>
	</ul>
	
	</div>
</div>

<?php include $this->gettpl('footer');?>
