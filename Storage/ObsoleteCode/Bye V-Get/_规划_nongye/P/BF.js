// blog's format
/*下面以后都用编程解决格式问题。
思路：字数在110汉字=220英文为界限；百度desription的限制
1.采用先获取数据库article
2.先把article存在str里面，对其"？！"等进行转化为"。"
*/


var tx=Xi("XC").innerHTML; //x blog
pun=Array('！','？');
upun=Array('”','"');//要保证不是“我爱你！”和 符号"。"的妙用
String.prototype.XcL=function(){return this.replace(/[^\x00-\xff]/g,"rr").length;}/*由于中文等于两个英文字符，所以要转化一个中文为两个英文字符str.clen()调用*/
Array.prototype.XinArr=function(c){for(t=0;t<this.length;t++){if(this[t]==c)return true;}return false;}/*设计函数类似php in_array*/
var a='abcd？“！”wo ？ ?!我 的."。"';
var x=0;
var b="";
st= new Array();
for(i=0;i<a.length;i++){
	var c=a[i];
    var d=a[i+1];
	if(pun.XinArr(c)&&!upun.XinArr(d)){b+="。";}/*如果当前符号在分隔符处，且下一字符不在特殊处*/
	else b+=c;
	
	x+=1;
	}
for(i=0;i<b.length;i++){
	if(b[i]=='。'){
		st}
	x+=1;}