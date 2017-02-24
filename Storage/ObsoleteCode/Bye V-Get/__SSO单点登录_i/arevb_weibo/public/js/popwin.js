function js_parser(htm) {
	var tag="script>",begin="<"+tag,end="</"+tag,pos=pos_pre=0,result=script="";
	while ((pos=htm.indexOf(begin,pos))+1) {
		result+=htm.substring(pos_pre,pos);
		pos+=8;
		pos_pre=htm.indexOf(end,pos);
		if (pos_pre<0){
			break
		}
		script+=htm.substring(pos,pos_pre)+";";
		pos_pre+=9
	}
	result+=htm.substring(pos_pre,htm.length);
	return{htm:result,js:function(){eval(script)}}
}
function center(b)
{
	return {left:(document.documentElement.offsetWidth-b.offsetWidth)/2+"px",top:(document.documentElement.clientHeight-b.offsetHeight)*0.45+"px"}
}
function pop_win(f,e) {
	if(!window.__pop_win) {
		var h=document.createElement("div");
		h.className="pop_win_bg";
		document.body.appendChild(h);
		var j=document.createElement("div");
		j.className="pop_win";
		document.body.appendChild(j);
		__pop_win={bg:h,body:j,body_j:$(j),bg_j:$(h)}
	}
	var c=__pop_win.body,d=__pop_win.body_j,i=js_parser(f);
	if(e!==true) {
		i.htm='<a onclick="pop_win.close()" href="javascript:;" class="pop_win_close">X</a>'+i.htm
	}
	c.innerHTML=i.htm;
	var g=center(c);
	if(document.documentElement.clientHeight<c.offsetHeight) {
		g.top="0";
		g.height=document.documentElement.clientHeight-40+"px";
		g.overflow="auto"
	}
	d.css({display:"block"}).css(g).css({visibility:"visible",zIndex:101});
	i.js();
	pop_win.fit();
	if(!window.XMLHttpRequest) {
		__pop_win.bg.style.top=""
	}
}
pop_win.fit=function() {
	if(window.__pop_win) {
		var c=__pop_win.body;
		__pop_win.bg_j.css({height:c.offsetHeight+20+"px",width:c.offsetWidth+20+"px",left:c.offsetLeft-10+"px",top:c.offsetTop-10+"px",zIndex:100}).show()
	}

};
pop_win.close=function() {
	$(__pop_win.bg).remove();
	$(__pop_win.body).remove();
	window.__pop_win=null
};
pop_win.load=function(c,b) {
	pop_win("加载中,请稍等...");
	$.ajax({url:c,success:pop_win,cache:b||false});
	return false
}