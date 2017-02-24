<? if(!defined('IN_MOOPHP')) exit('Access Denied');?>
<?php include MooTemplate("tools_header"); ?>
<div id="tab1">
	<div id="page">   
              <div class="toolbox">
            	<div class="title">
                	<div><?php echo $tpl_name; ?></div>
                </div><div class="inner" style="display:block"><div class="jsform">
                <form method="post" action="ip.php" onsubmit="this.action='ip.php?ip='+getElementById('ip').value;">
                	<input type="text" class="it" size="36" name="ip" id="ip" value="<?php echo $ip;?>" />
                	<input type="submit" class="bt" name="Submit" value="开始查询" hidefocus="true"  />
                </form>
                    <ul>
                        <li>您所查询的IP物理地址如下:</li>
                    </ul>
                </div><div class="result" style="padding:5px; background:#fff;">
                	<table cellpadding="5" cellspacing="0" id="tab">
                        <tr><td align="left">查询结果:<?php if($ip) { ?><?php echo convertip_full($ip, MOOPHP_ROOT.'/plugins/ipdata/wry.dat');?><?php } else { ?>请输入要查询的IP地址!<?php } ?></tr>
                    </table>
                </div></div></div>      
	</div>   
</div>
<?php include MooTemplate("tools_footer"); ?>