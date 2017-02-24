(function(){A('n','_self');if(L($5.pathname)<2){function mc(h,n){var a=$('mco^a');if(n==0||n)$('mc').scrollLeft=n*h;else {n=$('mc').scrollLeft/h;if(n==L(a)-1)n=0;else n++}F(a,function(o){C(o,'')});C(a[n],'mco')};M($('mc'),3,1,5500,I,mc);F($("mco^a"),function(o){E(o,$8,function(){F($("mco^a"),function(i,g){if(i==o)mc(728,g)})})});}if($k('view')&&'/logistics/news.html'==$5.pathname){J('http://wuliu.v-get.com/i/static/js/bbcode.js',function(){
var f=$('mf'),s=clearcode(H(f).replace(/\n/ig,'<br>'));

s=s.replace(/\[code\]([\s\S]+?)\[\/code\]/ig, function($1, $2) {return parsecode($2);});
s=$r(s,/\[url\]\s*((https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|thunder|qqdl|synacast){1}:\/\/|www\.)([^\[\"']+?)\s*\[\/url\]/ig,function($1,$2,$3,$4) {return cuturl($2 + $4);});
s=$r(s,/\[url=((https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|thunder|qqdl|synacast){1}:\/\/|www\.|mailto:)?([^\r\n\[\"']+?)\]([\s\S]+?)\[\/url\]/ig,'<a href="$1$3" target="_blank">$4</a>');
s=$r(s,/\[email\](.*?)\[\/email\]/ig,'<a href="mailto:$1">$1</a>');
s=$r(s,/\[email=(.[^\[]*)\](.*?)\[\/email\]/ig,'<a href="mailto:$1" target="_blank">$2</a>');
s=$r(s,/\[color=([^\[\<]+?)\]/ig,'<font color="$1">');
		s=$r(s,/\[size=(\d+?)\]/ig,'<font size="$1">');
		s=$r(s,/\[size=(\d+(\.\d+)?(px|pt)+?)\]/ig,'<font style="font-size: $1">');
		s=$r(s,/\[font=([^\[\<]+?)\]/ig,'<font face="$1">');
		s=$r(s,/\[align=([^\[\<]+?)\]/ig,'<div align="$1">');
s=$r(s,/\[p=(\d{1,2}|null),(\d{1,2}|null),(left|center|right)\]/ig,'<p style="line-height: $1px; text-indent: $2em; text-align: $3;">');
		s=$r(s,/\[float=left\]/ig,'<br style="clear: both"><span style="float: left; margin-right: 5px;">');
		s=$r(s,/\[float=right\]/ig,'<br style="clear: both"><span style="float: right; margin-left: 5px;">');
s=$r(s,/\[quote]([\s\S]*?)\[\/quote\]\s?\s?/ig,'<blockquote>$1</blockquote>');
for (i=0;i<4;i++) {s=$r(s,/\[table(?:=(\d{1,4}%?)(?:,([\(\)%,#\w ]+))?)?\]\s*([\s\S]+?)\s*\[\/table\]/ig,function($1,$2,$3,$4) {return parsetable($2,$3,$4);});}
F([['\\\[\\\/color\\\]','</font>'],['\\\[\\\/backcolor\\\]','</font>'],['\\\[\\\/size\\\]','</font>'],['\\\[\\\/font\\\]','</font>'],['\\\[\\\/align\\\]','</div>'],['\\\[\\\/p\\\]','</p>'],['\\\[b\\\]','<b>'],['\\\[\\\/b\\\]','</b>'],['\\\[i\\\]','<i>'],['\\\[\\\/i\\\]','</i>'],['\\\[u\\\]','<u>'],['\\\[\\\/u\\\]',,'</u>'],['\\\[s\\\]','<sike>'],['\\\[\\\/s\\\]','</sike>'],['\\\[hr\\\]','<hr class="l" />'],['\\\[list\\\]','<ul>'],['\\\[list=1\\\]','<ul>'],['\\\[list=a\\\]','<ul>'],['\\\[list=A\\\]','<ul>'],['\\s?\\\[\\\*\\\]','<li>'],['\\\[\\\/list\\\]','</ul>'],['\\\[indent\\\]','<blockquote>'],['\\\[\\\/indent\\\]','</blockquote>'],['\\\[\\\/float\\\]','</span>']],function(a){s=$r(s,RegExp(a[0],'ig'),a[1]);});

s=$r(s,/\[img\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/ig, '<img src="$1" border="0" alt="" style="max-width:400px" />');
s=$r(s,/\[img=(\d{1,4})[x|\,](\d{1,4})\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/ig, function ($1, $2, $3, $4) {return '<img' + ($2 > 0 ? ' width="' + $2 + '"' : '') + ($3 > 0 ? ' _height="' + $3 + '"' : '') + ' src="' + $4 + '" border="0" alt="" />'});
for(var i=0;i<= DISCUZCODE['num'];i++){s=$r(s,"[\tDISCUZ_CODE_" + i + "\t]", DISCUZCODE['html'][i]);}
H(f,s);
});}})();(function (b){H(b,'<span class="bds_more"></span><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><a class="bds_mshare"></a><a class="shareCount"></a>');C(b,'ff mg bdshare_t bds_tools get-codes-bdshare');$C('script','id=bdshare_js','',b);$g($('bdshare_js'),'data','type=tools&amp;uid=609302');$C('script','id=bdshell_js','',b);$('bdshell_js').src='http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion='+Math.ceil(new Date()/3600000);})($('bdshare'));