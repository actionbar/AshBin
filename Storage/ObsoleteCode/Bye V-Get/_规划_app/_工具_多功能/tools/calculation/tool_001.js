function gjjloan1(obj)
{
  var gryjce;//住房公积金个人月缴存额
  var poyjce;//配偶住房公积金个人月缴存额
  var grjcbl;//缴存比例
  var pojcbl;//配偶缴存比例
  var xy; //个人信用
  var fwzj;//房屋总价
  var fwxz;//房屋性质
  var dknx;//贷款申请年限
  var syhk; //首月还款额
  
  var dked;//需要贷款额度
  var hkfs;//还款方式
  var bxhj; //本息合计
  var bxhj2; //本息合计等本金

//中间变量
 var gbl;
 var jtysr; //家庭月收入
 var r;//月还款
 var gjjdka;//住房公积金贷款额度a
 var gjjdkb;//住房公积金贷款额度b
 var gjjdkc;//住房公积金贷款额度c

 

 gryjce=obj.mount2.value;
if(gryjce<=0){alert('住房公积金个人月缴存额不能为空,请输入');
                     obj.mount2.value='';return;}

 poyjce=obj.mount3.value;
if (obj.jcbl[0].checked==true){grjcbl=0.08;}
else {grjcbl=0.1;}

if (obj.p_bl[0].checked==true){pojcbl=0.08;}
else {pojcbl=0.1;}

if (obj.xz[0].checked==true){fwxz=0.9;}
else {fwxz=0.95;}

if (obj.xy[0].checked==true){xy=1.3;}
else if(obj.xy[1].checked==true){xy=1.15;}
else {xy=1;}

 
 fwzj=obj.mount.value;

if(fwzj<=0){alert('房屋总价不能为空,请输入');
                     obj.mount.value='';return;}
 
 dknx=Math.round(obj.mount10.value);

if(dknx<=0){alert('贷款申请年限不能为空,请输入');
                     obj.mount10.value='';return;}
if(dknx>30){alert('贷款申请年限不能大于30年,请重新输入');
                     obj.mount10.value='';return;}
 

 
 

switch(dknx){         //月均还款速算表
  case 1 : r=852.14;        break;
  case 2 : r=432.4710697;   break;
  case 3 : r=293.46378;     break;
  case 4 : r=224.0050146;   break;
  case 5 : r=182.3656265;   break;
  case 6 : r=156.6797508;   break;
  case 7 : r=136.9183397;   break;
  case 8 : r=122.1254826;   break;
  case 9 : r=110.6449335;   break;
  case 10 : r=101.4829378;  break;
  case 11 : r=94.0070996;   break;
  case 12 : r=87.79581584;  break;
  case 13 : r=82.55720217;  break;
  case 14 : r=78.0827649;   break;
  case 15 : r=74.21960416;  break;
  case 16 : r=70.85304091;  break;
  case 17 : r=67.89537559;  break;
  case 18 : r=65.27839391;  break;
  case 19 : r=62.94823917;  break;
  case 20 : r=60.86182298;  break;
  case 21 : r=58.98426138;  break;
  case 22 : r=57.28701034;  break;
  case 23 : r=55.74648753;  break;
  case 24 : r=54.34303869;  break;
  case 25 : r=53.06015214;  break;
  case 26 : r=51.88385442;  break;
  case 27 : r=50.80224037;  break;
  case 28 : r=49.80510385;  break;
  case 29 : r=48.88364483;  break;
  case 30 : r=48.03023512;  break;
  }

jtysr=Math.ceil((gryjce/grjcbl+poyjce/pojcbl)*10)/10;
if(jtysr<=400){alert('家庭月收入低于400，不符合贷款条件');
                     return;}

gjjdka=Math.min(Math.round((jtysr-400)/r*10000*10)/10,400000);
gjjdkb=Math.round(gjjdka*xy*10)/10;
gjjdkc=Math.round(fwzj*fwxz*10)/10; 
//obj.ze2.value=gjjdka; //jtysr;
obj.ze2.value=Math.floor(Math.min(gjjdkb,gjjdkc)/10000*10)/10;

zgdk=obj.ze2.value; //最高贷款额度













//计算申请的最高贷款额度

/*
说明 
家庭月收入＝住房公积金个人月缴存额÷缴存比例+配偶住房公积金个人月缴存额÷缴存比例

住房公积金贷款额度a＝（家庭月收入－400）÷等额均还月还款额每万元月还款额，且不大于40万元

对于个人信用等级为AAA的，住房公积金贷款额度b＝住房公积金贷款额度a×130％

对于个人信用等级为AA的，住房公积金贷款额度b＝住房公积金贷款额度a×115％

对于个人信用等级其它的，住房公积金贷款额度b＝住房公积金贷款额度a

对房屋性质为商品房期房的，住房公积金贷款额度c＝房屋总价×90％

对房屋性质为其它的，住房公积金贷款额度c＝房屋总价×95％

最高贷款额度d＝min（b，c）

等额均还还款公式：

 
等额本金还款公式

首月还款额=P/（n×12）+借款总额×I

其中：P为贷款本金，I为月利率，n为贷款年限。
 

  */

}
