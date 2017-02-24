var sProductName='Rainer\'s Handbook';
var sTrademark='Rainer\'s Handbook';
var sHomeURL='mailto:dhtmlet@hotmail.com?subject=Hello , Rainer ...';
var sCopyrightCh='苏昱作品·版权所有';
var sCopyrightEn='&copy;2002 Rainer Su . All rights reserved .';
var sStyleURL='rdl_method_selector.css';
var sParentURL='../l_methods.html';
var sParentNote='方法清单';

var sMethodName='';

var collFriends;

var oListTable;

function rdlMakeList(){

if (collListElements==null || oListTable==null || collListElements.length==0) return;

var oListHead=oListTable.createTHead();
var oListTR=oListHead.insertRow();
var oListTD=oListTR.insertCell();
with (oListTD) {innerText='方法名称 (Method)';className='cssListHead';}
var oListTD=oListTR.insertCell();
with (oListTD) {oListTD.innerText='应用于 (Applies To)';className='cssListHead';}

for (dLoop=0;dLoop<collListElements.length;dLoop++) {
var oListTR=oListTable.insertRow();
var oListTD=oListTR.insertCell();
var oListA=document.createElement('<a>');
oListTD.appendChild(oListA);
with (oListA) {href=''+sMethodName.replace(/\W/g,'')+'_'+dLoop.toString()+'.html';innerText=sMethodName;}

var oListTD=oListTR.insertCell();
for (bLoop=0;bLoop<collListElements[dLoop].length;bLoop++){
var oListA=document.createElement('a');
oListTD.appendChild(oListA);
with (oListA) {innerText=collListElements[dLoop][bLoop];href='../objects/'+(collListElements[dLoop][bLoop].toLowerCase()).replace(/\W/g,'')+'.html';className='cssListA';}
}
}

}

function rdlMakeOption(sOption,sPrefix,oSelect){

var oOption=document.createElement('option');
oSelect.options.add(oOption,0);

if (sOption=='0') {
oOption.innerText='------------------------------------------';
oOption.style.color='#99AACC';
oOption.value='0';
} 
else {
oOption.innerText='      '+sOption;
oOption.value=sPrefix+(sOption.replace(/\W/g,'')).toLowerCase()+'.html';
}

}


function rdlMakeOptions(collFriends,sPrefix,sFriendTitle,oSelect){

if (collFriends==null || collFriends.length==0) return;
//rdlMakeOption('No '+sFriendTitle+' or Init false...','',oSelect);else
for (mLoop=0;mLoop< collFriends.length;mLoop++) rdlMakeOption(collFriends[mLoop],sPrefix,oSelect);
rdlMakeOption('0','',oSelect);

}


function doSelect(e){
with (document.all('idSelect')){
var sValue=options[selectedIndex].value;
options[0].selected=true;
}
if (sValue!='0') window.location=sValue;
}


function rdlWindowLoad(e){

with (document) {charset='gb2312';createStyleSheet(sStyleURL);title=sProductName;}

var sHeadnote='<b>提示: <\/b> 您试图访问的<b> '+sMethodName+' <\/b>方法存在<b> '+(collListElements.length).toString()+' <\/b>个同名方法。请您从下方的列表中自主选择。';

var oHeadTable=document.createElement('<table id="idHeadTable">');
document.body.appendChild(oHeadTable);
oHeadTable.cellPadding=oHeadTable.cellSpacing=0;
var oHeadTR=oHeadTable.insertRow();
var oTrademarkTD=document.createElement('<td id="idTrademarkTD">');
oHeadTR.appendChild(oTrademarkTD);
var oTrademarkA=document.createElement('<a>');
oTrademarkTD.appendChild(oTrademarkA);
with (oTrademarkA) {innerHTML=sTrademark;href=sHomeURL;target='_blank';}
var oSelectTD=document.createElement('<td id="idSelectTD">');
oHeadTR.appendChild(oSelectTD);
var oParentA=document.createElement('<a>');
oSelectTD.appendChild(oParentA);
with (oParentA) {innerText=sParentNote;href=sParentURL;insertAdjacentText('afterEnd',' | 相关内容: ');}
var oFriendSelect=document.createElement('<select id="idSelect">');
oSelectTD.appendChild(oFriendSelect);
rdlMakeOptions(collFriends,'../l_','Lists',oFriendSelect);

var oOption=document.createElement('option');
oFriendSelect.options.add(oOption,0);
with (oOption) {innerText='See Also...';value='0';selected=true;}

var oContent=document.createElement('<div id="idContent">');
document.body.appendChild(oContent);

var oHeadnote=document.createElement('<div id="idHeadnote">');
oContent.appendChild(oHeadnote);
oHeadnote.innerHTML=sHeadnote;

oListTable=document.createElement('<table id="idListTable">');
oContent.appendChild(oListTable);
with (oListTable) cellPadding=cellSpacing=1;
rdlMakeList();

var oFootnote=document.createElement('<div id="idFootnote">');
oContent.appendChild(oFootnote);
var oCopyright=document.createElement('<div id="idCopyright">');
oContent.appendChild(oCopyright);
oCopyright.innerHTML=sCopyrightEn;
oCopyright.insertAdjacentText('beforeBegin',sCopyrightCh);

oFriendSelect.onchange=doSelect;

}


window.onload=rdlWindowLoad;


/* Part of RDL(TM) - Written by Rain1977 */
/* HomeSite: http://www.dhtmlet.com  E-Mail: dhtmlet@hotmail.com */