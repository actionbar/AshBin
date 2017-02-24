<?php
$url = $_SERVER['PHP_SELF']; 
$filename= substr( $url , strrpos($url , '/')+2,-4);
if(!isset($_GET['sure'])){
echo '<a href="?sure=ok">确定更新e.v-get.com/host/'.$filename.'.html ？</a>';
exit;
}

require '../_/global.php';$QC=mysql_connect('localhost',constant('db_user'),constant('db_pass'));mysql_select_db(constant('database'),$QC);mysql_query('set names utf8');

$file=constant('uploadFile').'soho/'.$filename.'.html';
$fp=fopen($file,'w+');if(is_writable($file)==false) {die("文件没有找到");exit;}
else{

$text=constant('CSSJS').'<link rel="stylesheet" type="text/css" href="'.constant('LTU_8').'o/i.css" /><title>Call Center 呼叫中心淘宝客服招聘外包_E维科技_V-Get!</title><meta name="keywords" content="呼叫中心,客服外包,淘宝客服外包,客服招聘,客服托管,外包客服"/><meta name="description" content="E维科技快速组建Call Center 呼叫中心客服外包服务，价格便宜,功能齐全。适用于淘宝客服外包,客服招聘外包,客服托管等外包客服业务。E维科技，网络营销专家！"/>';

$text.=TUN('soho');
$text.='<div class="m mb">当前位置：<a href="'.constant('LK').'">E维科技</a> &gt;&gt; <a href="'.constant('LK').'soho/">家居办公</a> &gt;&gt; <a href="'.constant('LK').'soho/kefu.html">客服外包</a> &gt;&gt; 呼叫中心外包</div><div class="v"><div><img src="'.constant('LTP_8').'o/kf_callcenter1.gif" alt="E维科技呼叫中心解决方案" width="960" height="64" /></div><div><img src="'.constant('LTP_8').'o/kf_call2.gif" alt="选择E维科技电话客服，我们将为您做到" width="930" height="655" /></div><div><img src="'.constant('LTP_8').'o/kf_callcenter3.gif" alt="E维科技呼叫中心服务" width="930" height="277" /></div><div class="c3"><h3 class="f6">Call Center 呼叫中心外包给“E维客服外包”，我们帮你做到：</h3><ul><li>周一至周五 每天9:00-17:00轮班值守，标准工作时间；</li><li>专线、专人，确保信息隐私安全，保证接听速率；</li><li>专业、严谨、贴心的回答每个客户的咨询，体现公司的专业实力；</li><li>客户都是经过培训的，能充分利用销售技巧，促使客户尽快下单。</li></ul></div><p>&nbsp;</p><div><img src="'.constant('LTP_8').'o/kf_sales3.gif" alt="如何增加老客户回访率" width="930" height="247" /></div><div class="cc"><p><strong>Call Center 呼叫中心</strong>是指我们为中大型企业专业提供的客服外包服务，5*8小时的客服标准工作时间。</p><div class="cct"><ul><li><strong>服务对象</strong>：大型电子商城网站、中大型企业服务和增值业务服务需求。</li><li><strong>工作时间</strong>：周一至周五（加班费另算） 9:00-17:00</li><li><strong>收费标准</strong>：客服代表10-50人，10000-80000元/月（费用根据市场变动，具体价格请<a href="">咨询E维科技</a>）</li><li><strong>服务优势</strong>：</li></ul><p>①&nbsp; E维电话呼叫中心外包将为您处理客户售前咨询、售后服务、技术支持、投诉受理等电话呼入呼出服务</p><p>②&nbsp; 电话销售、售后体验、电话调查用户体验数据、安排会议等专业电话营销呼出服务</p><p>③&nbsp; 专业的客服团队，不定期的客服培训，让客服更专业，彰显您的企业应答能力</p><p>④&nbsp; 电话呼入客服外包不仅可以帮您降低营运成本，还可提高品质，集中优势资源，提高顾客满意度。</p></div><p>&nbsp;</p><div><img src="'.constant('LTP_8').'o/kf_call4.gif" alt="怎样保证客服外包培训服务质量和效果" width="930" height="321" /></div><div><img src="'.constant('LTP_8').'o/kf_call5.gif" alt="E维科技追求客服外包满意度" width="930" height="371" /></div><div class="ccc"><p>E维客服外包拥有完善的培训承接电话客服外呼推广项目。前期由质检听取所有人员录音，根据录音出具分析报告，培训根据分析报告，总结问题与解决问题的方法，后期培训根据问题展开一系列培训。培训实施过程中，讲解如何与客户有效的沟通，并告知推广人员沟通技巧与针对无意识的客户如何展开有效的挽留，再具体分析员工录音，让员工通过真实的模拟掌握沟通的方式方法。</p></div><div class="c3"><h3>一般外呼客服服务水平普遍会存在以下问题</h3><p>1、话术使用不灵活。</p><p>2、欠缺与客户主动沟通技巧。</p><p>3、销售意识欠佳。</p><p>4、缺乏销售技巧。</p><p>5、服务用语与礼貌用语使用不恰当。</p><p>6、抗压能力较差。</p></div><p>&nbsp;</p><p>通过E维客服培训，我们会从各个点出发，完善并提高客服服务质量。 下图为培训前后前十名客服人员业务受理结果走势图。</p><p>&nbsp;</p><div><img src="'.constant('LTP_8').'o/kf_call6.gif" alt="E维科技客服外包人员培训效果图" width="930" height="490" /></div><p class="c3">客服外包人员通过E维客服培训课程，人均业务推广能力均大幅提升。以11月为例，未经过培训，人均平均成功量22个，培训后人均31个！同时我们会通过监控系统时刻关注服务过程中存在的问题以及潜在危机。客服的服务会被多种途径收集并记录，以统计在数据报表中直观检视。每日完成情况、外呼明细、数据质量统计、故障日报等均为统计项目。</p><p>&nbsp;</p></div>'.constant('BOTTOM').'<div class="pn"><script type="text/javascript">'.JI0().constant('TONGJI').'</script></div></body></html>';
file_put_contents($file,$text);}
?>