/* <pre class="php/pjs/phtm/pvb/pcpp/pjava/pconf"> 
http://alexgorbatchev.com/SyntaxHighlighter/manual/brushes/
按照这个高亮，来
a={bash:'Bash',css:'Css',html:'XML',js:'JScript',php:'PHP',sql:'Sql'} 

pas：as3
php：PHP
pjs：js
pxml： html htm shtml xml
psql: sql mysql
pcss:   css
pdelphi：delphi/pascal
pdiff：diff/patch
ppl：perl
paspx  asp.net
pvb：vb
pcpp： c c++
pcsharp：C#
pjava：java
pconf：conf  用 #注释的文档
pbash：shell/bash
不独立css，使用phtm 里面替换css
*/


(function(){F($('^pre'),function(o){

if($g(o,'code')=='html'){


var j="Anchor Applet Area Arguments Array Boolean Button Checkbox Collection Crypto Date Dictionary Document Drive Drives Element Enumerator Event File FileObject FileSystemObject FileUpload Folder Folders Form Frame Function Global Hidden History HTMLElement Image Infinity Input JavaArray JavaClass JavaObject JavaPackage JSObject Layer Link Math MimeType Navigator Number Object Option Packages Password Plugin PrivilegeManager Random RegExp Screen Select String Submit Text Textarea URL VBArray Window WScript",m="above abs acos action activeElement alert alinkColor all altKey anchor anchors appCodeName applets apply appName appVersion arguments arity asin assign atan atan2 atob availHeight availLeft availTop availWidth ActiveXObject back background below bgColor big blink blur bold border borderWidths bottom btoa button call callee caller cancelBubble captureEvents ceil charAt charCodeAt charset checked children classes className clear clearInterval clearTimeout click clientInformation clientX clientY close closed colorDepth compile complete concat confirm constructir contains contextual cookie cos crypto ctrlKey current data defaultCharset defaultChecked defaultSelected defaultStatus defaultValue description disableExternalCapture disablePrivilege document domain E Echo element elements embeds enabledPlugin enableExternalCapture enablePrivilege encoding escape eval event exec exp expando FromPoint fgColor fileName find fixed floor focus fontColor fontSize form forms forward frames fromCharCode fromElement getAttribute get getClass getDate getDay getFullYear getHours getMember getMilliseconds getMinutes getMonth getSeconds getSelection getSlot getTime getTimezoneOffset getUTCDate getUTCDay getUTCFullYear getUTCHours getUTCMilliseconds getUTCMinutes getUTCMonth getUTCSeconds getWindow getYear global go HandleEvent Height hash hidden history home host hostName href hspace id ids ignoreCase images index indexOf inner innerHTML innerText innerWidth insertAdjacentHTML insertAdjacentText isFinite isNAN italics java javaEnabled join keyCode Links LN10 LN2 LOG10E LOG2E lang language lastIndex lastIndexOf lastMatch lastModified lastParen layers layerX layerY left leftContext length link linkColor load location locationBar log lowsrc MAX_VALUE MIN_VALUE margins match max menubar method mimeTypes min modifiers moveAbove moveBelow moveBy moveTo moveToAbsolute multiline NaN NEGATIVE_INFINITY name navigate navigator netscape next number offscreenBuffering offset offsetHeight offsetLeft offsetParent offsetTop offsetWidth offsetX offsetY onabort onblur onchange onclick ondblclick ondragdrop onerror onfocus onHelp onkeydown onkeypress onkeyup onload onmousedown onmousemove onmouseout onmouseover onmouseup onmove onreset onresize onsubmit onunload open opener options outerHeight outerHTML outerText outerWidth POSITIVE_INFINITY PI paddings pageX pageXOffset pageY pageYOffset parent parentElement parentLayer parentWindow parse parseFloat parseInt pathname personalbar pixelDepth platform plugins pop port pow preference previous print prompt protocol prototype push random readyState reason referrer refresh releaseEvents reload removeAttribute removeMember replace resizeBy resizeTo returnValue reverse right rightcontext round SQRT1_2 SQRT2 screenX screenY scroll scrollbars scrollBy scrollIntoView scrollTo search select selected selectedIndex self setAttribute setDay setFullYear setHotkeys setHours setInterval setMember setMilliseconds setMinutes setMonth setResizable setSeconds setSlot setTime setTimeout setUTCDate setUTCFullYear setUTCHours setUTCMillseconds setUTCMinutes setUTCMonth setUTCSeconds setYear setZOptions shift shiftKey siblingAbove siblingBelow signText sin slice smallsort source sourceIndex splice split sqrt src srcElement srcFilter status statusbar stop strike style sub submit substr substring suffixes sun sup systemLanguage TYPE tagName tags taint taintEnabled tan target test text title toElement toGMTString toLocaleString toLowerCase toolbar top toString toUpperCase toUTCString type typeOf UTC unescape unshift untaint unwatch userAgent userLanguage value valueOf visibility vlinkColor vspace watch which width window write writeln x y zIndex",k="abstract break byte case catch char class const continue default delete do double else extends false final finally float for function goto if implements import in instanceof int interface long native null package private protected public reset return short static super switch synchronized this throw transient true try var void while with";
//var OPS="! $ % & * + - // / : < = > ? [ ] ^ | ~ is  new sizeof  typeof unchecked";


//[ (] 里面是有个空格的，要注意
F($p(j,' '),function(r){s=$r(s,RegExp('('+r+')','g'),'<span class="f0">$1</span>');});

F($p(k,' '),function(r){s=$r(s,RegExp('('+r+')([ (])','gim'),'<strong class="f12">$1</strong>$2');});
F($p(m,' '),function(r){s=$r(s,RegExp('([\.])('+r+')','gim'),'$1<span class="f13">$2</span>');s=$r(s,RegExp('('+r+')([ (])','gim'),'<span class="f13">$1</span>$2');});

H(o,'<li><span class="f13">&lt;script language="javascript" /&gt;</span></li>'+s+'<li><span class="f13">&lt;/script&gt;</span></li>');

}

F($('^li',o),function(o){
H(o,$r(H(o),/([\s;}>])(\/\/.+)/g,'$1<span class="f1">$2</span>'));
H(o,$r(H(o),/("f1">\/\/.+)<span class="\w+">([^<]+)<\/span>/g,'$1$2'));
H(o,$r(H(o),/(\/\*.+\*\/)/g,'<span class="f1">$1</span>'));
H(o,$r(H(o),/("f1">\/\*.+)<span class="\w+">([^<]+)<\/span>(.+\*\/)/g,'$1$2$3'))
});
})})();