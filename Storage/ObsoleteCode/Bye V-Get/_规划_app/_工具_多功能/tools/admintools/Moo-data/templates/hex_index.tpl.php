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
		                <form method="post" action="hex.php" onsubmit="this.action='hex.php?url='+getElementById('url').value;">
		                	<input type="text" class="it" size="36" name="url" id="url" value="<?php echo $url;?>"/>
		                	<input type="submit" class="bt" name="Submit" value="开始转换" />
		                </form>
		                    <ul>
		                        <li>转换结果如下:</li>
		                    </ul>
		               </div>
	                 <div class="result" style="padding:5px; background:#fff;">
	                	<table cellpadding="5" cellspacing="0" id="tab">
	                        <tr><td align="left">
						<?php if($url) { ?>
							http://<?php echo $HexUrl;?>
						<?php } else { ?>
							 请输入要查询的URL网址, 例如:
							 <br />http://www.kqiqi.com 转换结果:http://%77%77%77%2e%6b%71%69%71%69%2e%63%6f%6d%20
							 <br />普通网址转换为16进制的网址,两者完全等效的访问 
						<?php } ?>
						</td>	
	                        </tr>
	                    </table>
	                 </div>
              </div>
       </div>      
	</div>
</div>
<?php include MooTemplate("tools_footer"); ?>