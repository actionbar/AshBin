var Xpos = 0;
var Ypos = 0;
var Xwidht = 780;
var Ygravity = 0.5; //Between 0-1,0 is stop
var scrollPos = 0;
var oldScrollPos = 0;

function FloatMenu() {
docWidth = document.body.clientWidth; 
docHeight = document.body.clientHeight;
oldScrollPos = scrollPos;
scrollPos = document.body.scrollTop; 
Xpos = 0;
Yboundary = scrollPos + 100;
if (floater.offsetTop < Yboundary - 50) 
Ypos += 50;

if (floater.offsetTop > Yboundary + 50) 
Ypos -= 50;

Ypos *= Ygravity; // Slow object down
if (navigator.appName == "Netscape")
{
Xpos += "px";
Ypos = scrollPos + 80 + "px";
floater.style.left = Xpos;
floater.style.top = Ypos;
}
else {
floater.style.pixelLeft = Xpos;
floater.style.pixelTop += Ypos;
}
if (screen.width <= 800)
{
floater.style.display = "none";
}
if (getCookie("ShowFloat") == "Hide")
{
	floater.style.display = "none";
}
}

window.setInterval("FloatMenu()", 1);