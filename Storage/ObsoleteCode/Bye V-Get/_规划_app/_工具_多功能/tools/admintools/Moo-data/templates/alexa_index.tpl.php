<? if(!defined('IN_MOOPHP')) exit('Access Denied');?>
<?php include MooTemplate("tools_header"); ?>
<script>
showrank=function(item) {
	for(var i=1;i<=5;i++) {
		if( i == item) {
			document.getElementById("rank" + i).style.display="block";
		} else {
			document.getElementById("rank" + i).style.display="none";
		}
	}
}
showreachs=function(item) {
	for(var i=1;i<=5;i++) {
		if( i == item) {
			document.getElementById("reachs" + i).style.display="block";
		} else {
			document.getElementById("reachs" + i).style.display="none";
		}
	}
}
showpageviews=function(item) {
	for(var i=1;i<=5;i++) {
		if( i == item) {
			document.getElementById("pageviews" + i).style.display="block";
		} else {
			document.getElementById("pageviews" + i).style.display="none";
		}
	}
}
</script>
<div id="tab1">
	<div id="page">   
       <div class="toolbox">
            <div class="title">
				<div><?php echo $tpl_name; ?> </div>
			</div>
									
             <div class="inner" style="display:block">
		             	<div class="jsform">
		                <form method="post" action="alexa.php"  onsubmit="this.action='alexa.php?url='+getElementById('url').value;">
		                	<input type="text" class="it" size="36" name="url" id="url" value="<?php echo $url;?>"/>
		                	<input type="submit" class="bt" name="Submit" value="开始查询" />
		                </form>
		                    <ul>
		                        <li>Alexa信息查询结果如下:</li>
		                    </ul>
		               </div>
	                 <div class="result" style="padding:5px; background:#fff;">
	                	<table cellpadding="5" cellspacing="0" id="tab">
	                        <tr><td align="left">
						<?php if($url) { ?>
							<?php if(!$isExist) { ?>域名不合法或者不存在!请输入正确的域名<?php } else { ?><strong><?php echo $url;?></strong>目前的流量排名(traffic rank)是:<font color=red><strong> <?php echo $TRank;?></strong></font>
<div id="box">
<div id="title">网站日平均排名走势图 [点击时间段查看相应时段曲线]</div>
<div id="boxOutside">
<div class="boxInside"><a href="###" onclick="showrank(1);">六个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showrank(2);">三个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showrank(3);">一个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showrank(4);">半个月数据</a></div>
<div class="boxInside2"><a href="###" onclick="showrank(5);">一星期数据</a></div>
</div>
<div class="clear"></div>
<div id="boxAlexa">
<div id=rank1><img src="http://traffic.alexa.com/graph?w=750&h=280&r=6m&y=t&u=<?php echo $url;?>"></div>
<div id=rank2 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=3m&y=t&u=<?php echo $url;?>"></div>
<div id=rank3 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=1m&y=t&u=<?php echo $url;?>"></div>
<div id=rank4 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=15.0m&y=t&u=<?php echo $url;?>"></div>
<div id=rank5 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=7.0&y=t&u=<?php echo $url;?>"></div>
</div>
</div>
<div id="box">
<div id="title">日平均访问人数走势图 [点击时间段查看相应时段曲线]</div>
<div id="boxOutside">
<div class="boxInside"><a href="###" onclick="showreachs(1);">六个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showreachs(2);">三个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showreachs(3);">一个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showreachs(4);">半个月数据</a></div>
<div class="boxInside2"><a href="###" onclick="showreachs(5);">一星期数据</a></div>
</div>
<div class="clear"></div>
<div id="boxAlexa">
<div id=reachs1><img src="http://traffic.alexa.com/graph?w=750&h=280&r=6m&y=r&u=<?php echo $url;?>"></div>
<div id=reachs2 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=3m&y=r&u=<?php echo $url;?>"></div>
<div id=reachs3 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=1m&y=r&u=<?php echo $url;?>"></div>
<div id=reachs4 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=15.0m&y=r&u=<?php echo $url;?>"></div>
<div id=reachs5 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=7.0&y=r&u=<?php echo $url;?>"></div>
</div>
</div>
<div id="box">
<div id="title">日页面浏览量走势图 [点击时间段查看相应时段曲线]</div>
<div id="boxOutside">
<div class="boxInside"><a href="###" onclick="showpageviews(1);">六个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showpageviews(2);">三个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showpageviews(3);">一个月数据</a></div>
<div class="boxInside"><a href="###" onclick="showpageviews(4);">半个月数据</a></div>
<div class="boxInside2"><a href="###" onclick="showpageviews(5);">一星期数据</a></div>
</div>
<div class="clear"></div>
<div id="boxAlexa">
<div id=pageviews1><img src="http://traffic.alexa.com/graph?w=750&h=280&r=6m&y=p&u=<?php echo $url;?>"></div>
<div id=pageviews2 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=3m&y=p&u=<?php echo $url;?>"></div>
<div id=pageviews3 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=1m&y=p&u=<?php echo $url;?>"></div>
<div id=pageviews4 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=15.0m&y=p&u=<?php echo $url;?>"></div>
<div id=pageviews5 style="display: none"><img src="http://traffic.alexa.com/graph?w=750&h=280&r=7.0&y=p&u=<?php echo $url;?>"></div>
</div>
</div>
							<?php } ?>
						<?php } else { ?>
							 请输入要查询的域名
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