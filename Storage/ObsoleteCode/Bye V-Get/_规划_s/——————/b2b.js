







function sx(i,n,x){/*box=是否是checkbox,n,x,*/
  
	var q=$p(x,"_"),q2;  if(q[1])q2=$i(q[1]);
	var a={0:'V-Get!',12:'百度',13:'谷歌',130:'Google',131:'谷歌台灣',140:'Yahoo',14:'雅虎',15:'搜狗',16:'搜搜',22:'凤凰',23:'新浪',24:'央视',25:'百度视频',26:'优酷',27:'库6',28:'土豆',32:'淘宝',33:'京东',34:'当当',35:'拍拍',36:'凡客',37:'亚马逊',38:'美团',42:'阿里巴巴',420:'Alibaba',43:'环球资源',44:'慧聪',460:'Made-In-China',52:'维基百科',520:'Wikipedia',53:'百度百科',54:'百度地图',55:'谷歌译中文',550:'谷歌译英文',62:'百度MP3',63:'QQ音乐',64:'百度图片',65:'百度贴吧',66:'天涯论坛',72:'太平洋',73:'狗狗软件',74:'手机软件',75:'天空软件',76:'电影天堂',77:'单机游戏'};
	var z=[[12,131,42,32,33,26,28],[12,13,130,14,140,15,16],[25,26,27,28,23,24,22],[32,33,34,35,36,37,38],[42,420,43,44,460],[53,520,55,550,54],[62,63,64,65,66],[72,73,74,75,76,77]][n];/*注意这里是z=[][n]*/
	var s='',k='checked="checked" t="';
	var q1=$i(q[0])||z[0]; 
	for(I=0;I<L(z);I++){
    var w=z[I],u='';
	if(w==q1){u=k+'1"'}	
	if(w==q2){u=k+'2"'}
	s+='<input type="checkbox" name="e[]" value="'+w+'" '+u+' /><a href="javascript:void(0)">'+a[w]+'</a>';
	}
	
	
	H($(i),s);$5["s"].t.value=n;
	
    /*sx  input和a显示部分*/	

   var e=$(i+'^INPUT'),aaa=$(i+'^A');
	
    var l=L(e),t=2;
	function sssx(o){if(o.checked){t++;
			o.setAttribute("t",t);
			var j=0,w=t;/*w设为最小的*/
			for(I=0;I<l;I++){var g=$i($g(e[I],"t"));if(g>0){j++;if(g<w){w=g}}}
			if(j>2){for(I=0;I<l;I++){g=$i($g(e[I],"t"));if(g==w){e[I].checked=0;e[I].removeAttribute("t")}}}		
         }
		else{o.removeAttribute("t")}	}
	
	
    for(I=0;I<l;I++){
		E(aaa[I],'click',function(){var j,o;for(j=0;j<l;j++){if(aaa[j]==this){o=e[j];if(o.checked)o.checked=0;else o.checked=1;sssx(o);return false}}});
		E(e[I],'click',function(){sssx(this)});
	}
    /*sx  input和a显示部分*/	
	
	
}

function ssx(i,n,x){n=n||0;var a=$("st^A"),l=L(a);for(I=0;I<l;I++){C(a[I],"");}C(a[n],"sto");
sx(i,n,x);
for(I=0;I<l;I++){a[I].onclick=function(){var j;for(I=0;I<l;I++){C(a[I],"");if(a[I]==this)j=I}C(this,"sto");sx(i,j,CG('sx'+j));return $0}}}

function searchs(o){o.x.value=CG('x');
var a=$('st^A'),x=$('sx^INPUT'),s='';for(I=0;I<L(a);I++){if(C(a[I])=='sto'){CS('st',I,99)}}
for(I=0;I<L(x);I++){if(x[I].checked)s+='_'+x[I].value}
CS('sx'+CG('st'),$s(s,1),99);
}


function OO(i,n,x){II($('c^A'));ssx(i,n,x);}





function O2(i,n,s,x){
	CS("x",x,99);
	ssx(i,n,s);

	
	}


	
	































