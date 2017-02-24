(function(d){if(d&&!T(H(d))){var h,s='';F($('c^h2'),function(o,i){h=H(o);H(o,'<a name="'+i+'"></a>'+h);s+='<li><a href="#'+i+'">'+h+'</a></li>';});if(T(s))H(d,'<div class="f"><p>目录</p><ul>'+s+'</ul></div>');}})($("d"));


/* // 代码高亮 http://alexgorbatchev.com/SyntaxHighlighter/manual/brushes/  
这个代码暂时不完善，对于比较长的字段，就会出错，而且采用滚动条非常不美观
(function (k){
if(k){
// 代码对应的js文件名
var l="http://tu.v-get.com/fcode/syntaxhighlighter/",a={bash:'Bash',css:'Css',html:'XML',js:'JScript',php:'Php',sql:'Sql'},x=[];
// 加载css
$C("link","id=shCSS");$("shCSS").type="text/css";$("shCSS").rel="stylesheet";$("shCSS").href=l+"styles/shCoreDefault.css";

F(k,function(p){var c=C(p),b=I;if(c){

c=(c=='php')?c:($s(c,1));C(p,'brush:'+c);
// 判断是否在数组内
F(x,function (e){if(e==c)b=O});
if(b)x.push(a[c]);


}});


J(l+'scripts/shCore.js',function(){
// 分别加载php js 等代码
F(x,function(s,j){J(l+"scripts/shBrush"+s+".js")});
SyntaxHighlighter.all();
});
}
})($('^pre')); */






// 多说评论，必须要用全局参数，不能闭包
if($("^div.ds-thread")){
var duoshuoQuery={short_name:"ev-get"};J("http://static.duoshuo.com/embed.js",function(s){s.async=I;s.charset="UTF-8"});
}

/* 百度分享，默认是小图标，如果是 */
(function (b){
if(b){
F(["bds_tsina","bds_qzone","bds_baidu","bds_renren","bds_more","shareCount"],function(a){H(b,H(b)+'<a class="'+a+'">')});
//这个用于float防浮动
$C('div','class=o','',b.parentNode);

C(b,'bdshare_t bds_tools get-codes-bdshare');
$C('script','id=bdshare_js','',b);
$g($('bdshare_js'),'data','type=tools&amp;uid=609302');
$C('script','id=bdshell_js','',b);
$('bdshell_js').src='http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion='+Math.ceil(new Date()/3600000);}})($('bdshare'));

// 百度图片分享
var bdShare_config_imgshare={"type":"list","size":"small","pos":"bottom","color":"black","list":["qzone","tsina","tqq","renren","t163"],"uid":"6820365"
};J("http://bdimg.share.baidu.com/static/js/imgshare_shell.js?cdnversion="+Math.ceil(new Date()/3600000));


// 百度赞后推荐，需要全局变量，不能闭包

if($("^div.bdlikebutton")){var bdShare_config={"type":"medium","color":"orange","uid":"6820365","likeText":"赞！","likedText":"赞过","share":"yes"};
J("http://bdimg.share.baidu.com/static/js/like_shell.js?t="+Math.ceil(new Date()/3600000));
}