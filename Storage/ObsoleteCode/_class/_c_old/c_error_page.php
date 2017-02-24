<?php
//  只有管理员才有的更新权限、如tech_sort更新、删除
class c_error_page{

	public function Error404($echo='404'){
		header('http/1.1 404 not found'); 
		header('status: 404 not found');
		echo $echo;
		die();
	}

	public function RedirectHTML($l, $tip = ''){  // js方式的跳转
		$l= !$l ? Yii::app()->homeUrl : $l;
		echo '<html>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<style>
				*{margin:0;padding:0}
				.w{width:1100px;margin:0 auto;overflow:hidden}
				</style>
				<body>
					<div class="w">
					<p><strong>'. $tip .'</strong> 将在<span id="totalSecond" style="color:#0c0">5</span>秒后跳转。<a href="'. $l .'">如果无法跳转，请点击此！</a></p>
				<script type="text/javascript">
					var g=function(){return document.getElementById("totalSecond")},s=parseInt(g().innerHTML); 
					setInterval("redirect()", 1000); 

					function redirect() {if (s<1) {location.href = "'. $l .'";} else { s--;g().innerHTML=s;}} 
				</script>
					</div>
				</body></html>';
		die();

	}

	

}