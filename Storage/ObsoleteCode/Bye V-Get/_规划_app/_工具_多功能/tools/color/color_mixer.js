
var hexValues = new Array('00','01','02','03','04','05','06','07','08','09','0A','0B','0C','0D','0E','0F','10','11','12','13','14','15','16','17','18','19','1A','1B','1C','1D','1E','1F','20','21','22','23','24','25','26','27','28','29','2A','2B','2C','2D','2E','2F','30','31','32','33','34','35','36','37','38','39','3A','3B','3C','3D','3E','3F','40','41','42','43','44','45','46','47','48','49','4A','4B','4C','4D','4E','4F','50','51','52','53','54','55','56','57','58','59','5A','5B','5C','5D','5E','5F','60','61','62','63','64','65','66','67','68','69','6A','6B','6C','6D','6E','6F','70','71','72','73','74','75','76','77','78','79','7A','7B','7C','7D','7E','7F','80','81','82','83','84','85','86','87','88','89','8A','8B','8C','8D','8E','8F','90','91','92','93','94','95','96','97','98','99','9A','9B','9C','9D','9E','9F','A0','A1','A2','A3','A4','A5','A6','A7','A8','A9','AA','AB','AC','AD','AE','AF','B0','B1','B2','B3','B4','B5','B6','B7','B8','B9','BA','BB','BC','BD','BE','BF','C0','C1','C2','C3','C4','C5','C6','C7','C8','C9','CA','CB','CC','CD','CE','CF','D0','D1','D2','D3','D4','D5','D6','D7','D8','D9','DA','DB','DC','DD','DE','DF','E0','E1','E2','E3','E4','E5','E6','E7','E8','E9','EA','EB','EC','ED','EE','EF','F0','F1','F2','F3','F4','F5','F6','F7','F8','F9','FA','FB','FC','FD','FE','FF');
cSelected=false;

xDivs = new Array("dRed","dGreen","dBlue");
xColors = new Array("red","green","blue");

function initPage() {
	buildDropdowns();
	sx=10;
	for(i=0;i<xDivs.length;i++) { document.getElementById(xDivs[i]).style.pixelLeft=sx;sx+=55; }
}

function doHex() {
	r =  document.frm1.red.value;
	g = document.frm1.green.value;
	b = document.frm1.blue.value;
	derivedColor = hexValues[r] + hexValues[g] + hexValues[b];
	document.getElementById("palette").style.backgroundColor = derivedColor;
	document.getElementById("dRed").style.backgroundColor = hexValues[r] + "0000";
	document.getElementById("dGreen").style.backgroundColor = "00" + hexValues[g] + "00";
	document.getElementById("dBlue").style.backgroundColor = "0000" + hexValues[b];

	for(i=0;i<xDivs.length;i++)document.getElementById(xDivs[i]).title= document.getElementById(xDivs[i]).style.backgroundColor.toUpperCase();
	document.getElementById("hex").value = "#" + derivedColor;
}
function buildDropdowns() {
	for(x=0;x<3;x++) {
		targetSelect = document.forms['frm1'].elements[xColors[x]];
		createColorRange(xColors[x]);
		document.frm1[xColors[x]].style.color=xColors[x];
		for(i=0;i<256;i++)targetSelect.options[targetSelect.options.length] = new Option(i,i);
	}
}
function createColorRange(who) {
	startY=0;startX=0;trackRow=0;
	mHTML="";
	for(i=0;i<256;i+=1) {
		switch(who) {
			case "red": hx=hexValues[i] + "0000";break;
			case "green": hx="00" + hexValues[i] + "00";break;
			case "blue": hx="0000" + hexValues[i];break;
		}
		mHTML+="<div onmouseover=\"handleMouseOver('" + who + "'," + i + ")\" class=\"individualColor\" onclick=\"setColor('" + who + "'," + i + ");\" id=\"rc" + i + "\" style=\"position:absolute;background-color:" + hx +";top:0px;font-size:1px;width:3px;height:3px;top:" + startY + ";left:" + startX + ";\"></div>";
		startX+=3;trackRow++;
		if(trackRow==16) {
			trackRow=0;
			startY+=3;
			startX=0;
		}
	}
	eval('document.getElementById("colorRange_' + who + '").innerHTML = mHTML');
}
function handleMouseOver(who,dColor) {
	if(!cSelected) {
		eval('document.frm1.' + who + '.selectedIndex=' + dColor);
		doHex();
	}
}
function setColor(who,dColor) {
	if(!cSelected){
		eval('document.frm1.' + who + '.selectedIndex=' + dColor);
		doHex();
		cSelected=true;
		hs_lock(1);
	} else {
		cSelected=false;
		hs_lock(0);
	}
}
function hs_lock(which) {
	which?document.getElementById("mLock").style.visibility="visible":document.getElementById("mLock").style.visibility="hidden";
}
function dd_onChange() {
	doHex();
	cSelected=true;
	hs_lock(1);
}
