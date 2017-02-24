var xoImg=new Array();
var xnNew=0;
var xnOld=0;
/*作为id值，获取用户点击率，获取标题欢迎度
xapImg(0=>id,1=>src,2=>alt,3=>href*/
var xapImg=new Array();xapImg[0]="1"; xapImg[1]="MD/0.jpg";xapImg[2]="日本发生强震 自卫队战斗机撞上民房";xapImg[3]="#";  xoImg[0]=xapImg;
var xapImg=new Array();xapImg[0]="957930";xapImg[1]="MD/1.jpg";xapImg[2]="日本空自松岛地战机部队全灭 ";xapImg[3]="#";  xoImg[1]=xapImg;
var xapImg=new Array();xapImg[0]="1559726";xapImg[1]="MD/2.jpg";xapImg[2]="大肚女孩康复返乡";xapImg[3]="#";          xoImg[2]=xapImg;
var xapImg=new Array();xapImg[0]="1560115";xapImg[1]="MD/3.jpg";xapImg[2]="张柏芝浓妆 疑为整容后遗症";xapImg[3]="#";    xoImg[3]=xapImg;
var xapImg=new Array();xapImg[0]="1558262";xapImg[1]="MD/4.jpg";xapImg[2]="环球图片周刊_NO.31";xapImg[3]="#";         xoImg[4]=xapImg;
var xapImg=new Array();xapImg[0]="1558657";xapImg[1]="MD/5.jpg";xapImg[2]="《中国远征军》原型揭秘";xapImg[3]="#";      xoImg[5]=xapImg;
function Xn()
   {xnOld=xnNew;
    if(xnNew<xoImg.length-1){xnNew++ ;}else{xnNew=0;}
	XNew(xnNew);
	zpt=setTimeout("Xn()", 4000);}

function XNew(xnNew)
{   Xi("LT1I").src=xoImg[xnNew][1];/*图片地址改变*/
    Xi("LT1Z").innerHTML=xoImg[xnNew][2];
	Xi("LT1Z").href=xoImg[xnNew][3];
	Xi("LT1Z").title=xoImg[xnNew][2];
	Xi("XLT1I").href=xoImg[xnNew][3];
	Xi("XLT1I").title=xoImg[xnNew][2];
for(var i=0;i<6;i++){if(i==xnNew){Xi("DA"+i).className="YD0D";}else{Xi("DA"+i).className="";}}}

function XSlect(s){clearTimeout(zpt);xnOld=xnNew;xnNew=s;XNew(xnNew);}
