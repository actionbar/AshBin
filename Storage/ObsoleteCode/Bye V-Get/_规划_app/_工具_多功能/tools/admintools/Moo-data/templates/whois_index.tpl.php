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
		                <form method="post" action="whois.php"  onsubmit="this.action='whois.php?domain='+getElementById('domain').value;">
		                	<input type="text" class="it" size="36" name="domain" id="domain" value="<?php echo $domain;?>"/>
		                	<input type="submit" class="bt" name="Submit" value="开始查询" />
		                </form>
		                    <ul>
		                        <li>whois查询结果如下:</li>
		                    </ul>
		               </div>
	                 <div class="result" style="padding:5px; background:#fff;">
	                	<table cellpadding="5" cellspacing="0" id="tab">
	                        <tr><td align="left"><?php if($domain) { ?><?php echo startwhois(); ?><?php } else { ?>请属于要查询的域名<?php } ?></td></tr>
	                    </table>
	                 </div>
              </div>
       </div>      
	</div>
</div>
<?php include MooTemplate("tools_footer"); ?>