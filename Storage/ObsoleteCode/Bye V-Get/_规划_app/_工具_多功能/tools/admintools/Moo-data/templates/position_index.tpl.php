<? if(!defined('IN_MOOPHP')) exit('Access Denied');?>
<?php include MooTemplate("tools_header"); ?>
<div id="tab1">
	<div id="page">   
       <div class="toolbox">
            	<div class="title">
								<div><?php echo $tpl_name; ?> </div>
							</div>
									
             <div class="inner" style="display:block">
		             	<div class="jsform">
		                <form method="post" action="position.php">
		                	<input type="text" class="it" size="36" name="value" id="value" value="<?php echo $value;?>" />
		                	<input type="submit" class="bt" name="Submit" value="开始查询" />
							<br />
						<span style="margin-left: -270px;">
							<input type="radio" name="radiobutton" value="baidu" <?php if($SearchE !== 'google') { ?>checked="checked" <?php } ?> />百度
							<input type="radio" name="radiobutton" value="google" <?php if($SearchE == 'google') { ?>checked="checked" <?php } ?> />Google
						</span>
		                </form>
		                    <ul>
		                        <li>查询结果如下:</li>
		                    </ul>
		               </div>
	                 <div class="result" style="padding:5px; background:#fff;">
	                	<table cellpadding="5" cellspacing="0" id="tab">
	                        <tr><td align="left"><?php if($value) { ?>
							<?php if($BaiduP || $GoogleP) { ?>
							您网站 <font color=green><?php echo $domain;?></font> 的关键词: <font color=red><strong><?php echo str_replace('+', ' ', $keyword);?></strong></font> 在<?php if($SearchE == 'google') { ?> <strong>Google</strong> <?php } else { ?> <strong>百度</strong> <?php } ?>搜索结果中排名第 <strong><?php echo $BaiduP; echo $GoogleP;?></strong>
							<?php } elseif ($BaiduP == '0' || $GoogleP == '0') { ?>
							很遗憾, 您网站 <font color=green><?php echo $domain;?></font> 里的关键字<font color=red><strong><?php echo str_replace('+', ' ', $keyword);?></strong></font> 没有进<?php if($SearchE == 'google') { ?> <strong>Google</strong> <?php } else { ?> <strong>百度</strong> <?php } ?>的前100位, 加紧努力哦
							<?php } elseif (!$keyword) { ?>
								请检查您输入的格式是否正确! 正确的格式实例: <font color=blue>www.kqiqi.com:客齐齐</font>(网站地址:关键字)
							<?php } ?>
						<?php } else { ?>	
							 例如: <font color=blue>www.kqiqi.com:客齐齐</font>(网站地址:关键字)
							 <br />只检索搜索引擎前100位, 再往后将不检测
							 <br />请注意: kqiqi.com和www.kqiqi.com是不一样的
						<?php } ?></td></tr>
	                    </table>
	                 </div>
              </div>
       </div>      
	</div>
</div>
<?php include MooTemplate("tools_footer"); ?>