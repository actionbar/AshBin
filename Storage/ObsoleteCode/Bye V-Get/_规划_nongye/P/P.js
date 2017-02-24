var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var xti;/*全局函数，timerout，interval时间间隔*/
function Xi(i){return document.getElementById(i)}
function Xoo(n,a,t)/*n是[A-Z]的数字形式即选项n（包括0）的数字形式；该选项共有a（包括0）个选项；此时选择第t（包括0）个*/
{if(xti){clearTimeout(xti)};
/*setTimeout("函数",间隔)里面函数无法直接取外面参数的，如a="love", setTimeout("alert(a)",1000); setTimeout("'"+alert(a)+"'",1000)...等操作都无法实现
只有使用function(){alert(a)}的形式，才可以；*/
 xti=setTimeout(function(){
  cN="YD"+n+"D";/**/
  s=str.charAt(n);
  q="D"+s;/*获取第几个*/
  p=s+"_";	
  b=a+1;
for(var j=0;j<b;j++){if(j!=t){Xi(q+j).className="";Xi(p+j).style.display="none";}
else {Xi(q+t).className=cN;Xi(p+t).style.display="";}}},150);}
function XCti(){if(xti){clearTimeout(xti)};}/*当onMouseout的时候，清空时间；使时间间隔无法到达间隔值*/
function Xo(n){ for(i=0;i<n;i++){iD="D"+str.charAt(i)+"0";cN="YD"+i+"D";Xi(iD).className=cN;}
               zpt=setTimeout("Xn()", 4000);}