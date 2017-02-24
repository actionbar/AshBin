function fetch(){
document.getElementById('logo_image').src ="images/wait.gif";
var txt=encodeURI(document.getElementById("per").value);
var icon=encodeURI(document.getElementById("icon").value);
var m=encodeURI(document.getElementById("mirror").value);
var font=encodeURI(document.getElementById("font").value);
var fsize=encodeURI(document.getElementById("fsize").value);
var clr=encodeURI(document.getElementById("clr").value);
var clr1=encodeURI(document.getElementById("clr1").value);
var clr2=encodeURI(document.getElementById("clr2").value);
var alpha=encodeURI(document.getElementById("alpha").value);
var output=encodeURI(document.getElementById("output").value);
var spacing=encodeURI(document.getElementById("spacing").value);
var shadow=encodeURI(document.getElementById("shadow").value);
var top=encodeURI(document.getElementById("top_spacing").value);
var left=encodeURI(document.getElementById("left_spacing").value);
var size=encodeURI(document.getElementById("icon_size").value);
var test = document.getElementById("iconic").value;
var transparent=encodeURI(document.getElementById("transparent").value);
document.getElementById('logo_image').src ="image."+output+"?fsize="+fsize+"&font="+font+"&text="+txt+"&mirror="+m+"&color="+clr+"&vcolor="+clr1+"&bgcolor="+clr2+"&alpha="+alpha+"&output="+output+"&spacing="+spacing+"&shadow="+shadow+"&transparent="+transparent+"&icon="+icon+"&iconic="+test+"&top_spacing="+top+"&left_spacing="+left+"&icon_size="+size;
return false;
}