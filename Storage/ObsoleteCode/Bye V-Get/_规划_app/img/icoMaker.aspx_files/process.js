//等待8秒提交
var parselimit=0;
var Btn;
var BtnValue;
var buttonName="_ctl0_ContentPlaceHolder1_BtnCreate";

function process()
{
if(document.getElementById(buttonName)==null) return;
Btn=document.getElementById(buttonName);
BtnValue=Btn.value;
Btn.disabled="disabled";
begintimer();
}

function begintimer(){
if (parselimit==0)
{
Btn.disabled="";
Btn.value=BtnValue;
}
else{ 
parselimit-=1;
Btn.value=BtnValue + "(稍等" + parselimit + "秒)";
ctimer=setTimeout('begintimer()',1000);
}
}

process();