/* 编辑器，所有js都要以E开头 */

/* EL() ==vget_link() 对外链进行 s.v-get.com/l?l处理 */
function EL(l){
var d='(v-get.com|weigeti.com)$';
l=$r(l,/^https?\:\/\//,'');
//防止 thunder://  ftp:// 这种情况
if(l.match(/^\w+\:\/\/.+$/))return l;
if(!l.match(/.+\..+/))return '#';
if(!$p(l,'/')[0].match(RegExp($r(d,'.','\.')))){l=encodeURIComponent(l);l='http://s.v-get.com/l?l='+l;}

l=($s(l,0,4)=='http')?l:($2+l);
return l
}