//<script type="text/javascript" src="http://localhost/www.v-get.com/i0/c.js"></script>
//<script>

//身份证验证与生成

function checkPID(x,e,s){

var d=0,a=[7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2],b=[1,0,11,9,8,7,6,5,4,3,2],g=$i(Math.random()*10),h=[0,2,4,6,8][$i(Math.random()*5)],l=0;
//生成 x=省份6位，h=生日6位，s=性别，true:男
 if(e){
y=x+e+(L(g)>1?'':'0')+g+(s?(h+1):h);
F(y,function(o,i){d+=o*a[i]});
for(l;l<12;l++){if(b[d%11]==l)break}
l=(l==11)?'X':l;
return y+l
 
	}
	//验证省份证
else {
	F($s(x,0,17),function(o,i){d+=o*a[i]});
	l=(x[17]=='X')?11:$i(x[17]);
	d=b[d%11]-l;
	return d==0?I:O
}
	
}
//alert(checkPID('340524','19800101',I));

//checkPID("340524198001010124");
//</script>