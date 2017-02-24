<?php
	require './include/common.inc.php';
	$pagetitle='快递之家';
function morehead(){
	echo <<<HEADHTML
<meta name="description" content="爱查快递【iCKD.cn】快递之家集成常用速递电话和单号查询，包括申通快递、顺丰、圆通、挂号信、韵达、天天、鑫飞鸿、汇通、宅急送、信丰、德邦物流、中通、平邮包裹及EMS等" />
<meta name="keywords" content="快递网点、价格、电话及单号查询" />
  <script language="javascript">
  function submitform(o){
	  var f=o.form;
	  if(f.elements["mailNo"].value){
	  	  var url="http://www.ickd.cn/"+o.id+"-"+f.elements["mailNo"].value+".html";
	  f.action=url;
	  }else{
		  f.elements["mailNo"].focus();
		  return false;
	  }
  }
  </script>

HEADHTML;
	}
	require TW_ROOT.'./template/other_header.php';
?>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt>申通备用查询</dt>
        <dd title="申通单号是由12位纯数字组成，申通客服电话：0571-82122222">
          <div class="name">填写申通单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="shentong" value="查询" id="shentong" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 顺丰快递查询</dt>
        <dd title="顺丰快递单号由12位数字组成，中间无空格，目前常见以电话区号后三位开头，顺丰公司全国统一电话：4008111111 香港:00852-27300273 投诉：0755-83151111">
          <div class="name">顺丰快递单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="shunfeng" value="查询" id="shunfeng" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt>圆通快递查询</dt>
        <dd title="圆通快递单号由10位数字组成，圆通公司客户服务电话：021-69777888 投诉：021-69777999 限时件：021-69777806/69777807">
          <div class="name">填写圆通单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="yuantong" value="查询" id="yuantong" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 邮政EMS查询</dt>
        <dd title="邮政EMS单号由13位字母和数字组成，一般开头和结尾二位是字母，中间是数字，EMS客服电话：11185">
          <div class="name">填写EMS单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="ems" value="查询" id="ems" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 平邮/挂号信查询</dt>
        <dd title="挂号信/包裹的单号由13位字母和数字组成，开头二位是字母，后面十一位是数字组成，邮政挂号信暂无统一查询电话，投诉电话：010-12305">
          <div class="name">填邮政对应单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="pingyou" value="查询" id="pingyou" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 中通快递查询</dt>
        <dd title="中通单号由12位数字组成，目前常见以01*、2008**、6**等开头，中通客服电话：021-59130789/59130271 投诉：021-69974284/69974281">
          <div class="name">填写中通单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="zhongtong" value="查询" id="zhongtong" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 韵达快运查询</dt>
        <dd title="韵达单号由13位数字组成，目前常见以10*、12*等开头，服务电话：021-62215588 市场部：021-39296978">
          <div class="name">填写韵达运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="yunda" value="查询" id="yunda" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 汇通快运查询</dt>
        <dd title="汇通单号由13位数字组成，目前常见以00**、02**、B0*等开头，汇通总部服务电话：021-59114488  投诉：021-69117270/69117290">
          <div class="name">填写汇通单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="huitong" value="查询" id="huitong" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 宅急送快运</dt>
        <dd title="宅急送单号由10位数字组成，目前常见以7**、6**、5**等开头，全国客服电话：400-6789-000">
          <div class="name">填写宅急送单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="zhaijisong" value="查询" id="zhaijisong" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 鑫飞鸿速递</dt>
        <dd title="鑫飞鸿单号由10位数字组成，目前常见以9*、8*、2*等开头，查询电话 020-61249033(华南) 021-39873577(华东) 010-85512488(华北)">
          <div class="name">鑫飞鸿运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="xinfeihong" value="查询" id="xinfeihong" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 天天快递查询</dt>
        <dd title="天天快单号由14位数字组成，目前常见以6**、5*、00*等开头，客户查件电话：021-67662333 总部电话：021-34627557 投诉：400-8208198 全国VIP热线：400 8208515">
          <div class="name">填写天天运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="tiantian" value="查询" id="tiantian" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 港中能达追踪</dt>
        <dd title="港中能达单号由10位或12位数字组成，目前常见以8800*、3000*、50*等开头，能达客服电话：021-60739320、021-60739323">
          <div class="name">填能达运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="nengda" value="查询" id="nengda" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 全一快运跟踪</dt>
        <dd title="全一物流单号由12位数字组成，目前常见以1110*、1100*等开头，客户服务电话：400-6781515/021-52695816 投诉：021-52695805">
          <div class="name">输入全一运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="quanyi" value="查询" id="quanyi" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> <strong>优速物流查询</strong></dt>
        <dd title="优速物流单号由12位数字组成，目前常见以666*等开头，优速物流服务电话：400 1111119">
          <div class="name">优速快递单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="huitong7" value="查询" id="huitong7" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> <strong>速尔快递查询</strong></dt>
        <dd title="速尔物流客户服务电话：0769-85010803 投诉监督：4008822168">
          <div class="name">输入速尔运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="sure" value="查询" id="sure" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 龙邦物流追踪</dt>
        <dd title="龙邦快递客服：0769-85703777/85702777">
          <div class="name">填写龙邦单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="longbang" value="查询" id="longbang" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 德邦物流查询</dt>
        <dd title="德邦物流查询电话：400 8305555">
          <div class="name">德邦物流运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="debang" value="查询" id="debang" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 信丰物流查询</dt>
        <dd title="信丰物流客服热线：4008306333 0769-81518333">
          <div class="name">填写信丰单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="xinfeng" value="查询" id="xinfeng" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> <strong>联昊通物流</strong></dt>
        <dd title="联昊通客户服务电话：0769-0769-88620000/85116666">
          <div class="name">联昊通运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="lianhaotong" value="查询" id="lianhaotong" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 安信达快运</dt>
        <dd title="安信达客户服务：010-64008484">
          <div class="name">输入安信达单</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="anxinda" value="查询" id="anxinda" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 希伊艾斯CCES快件</dt>
        <dd title="希伊艾斯客服电话：021-51559603/62967777 4006773777">
          <div class="name">希伊艾斯CCES单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="cces" value="查询" id="cces" />
        </dd>
      </dl>
    </form>
  </div>
  <div class="exp">
    <form method="post" action="">
      <dl>
        <dt> 全日通速递</dt>
        <dd title="全日通物流总部电话：020-86298999">
          <div class="name">填写全日通运单号</div>
          <input name="mailNo" type="text" maxlength="12" />
          <input type="submit" onclick="return submitform(this)" name="quanritong" value="查询" id="quanritong" />
        </dd>
      </dl>
    </form>
  </div>
<?php
	require TW_ROOT.'./template/other_footer.php';
?>
