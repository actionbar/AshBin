// This function is used for coping text from text area

function copyText( obj ) {
 if (obj.type=="text" || obj.type=="textarea"){
  var rng = obj.createTextRange();
 } else {
  var rng = document.body.createTextRange();
  rng.moveToElementText(obj);
 }
 rng.scrollIntoView();
 rng.select();
 rng.execCommand("Copy");
 rng.collapse(false);
 rng.select();
}

// Variables for printColor function

  fixed="B";
  left="R";
  upper="G";
  value=Array;
  value[0]="N/A";
  value[1]="00";
  value[2]="33";
  value[3]="66";
  value[4]="99";
  value[5]="CC";
  value[6]="FF";

// Function printColor prints the web-colors into the table  
  
function printColor() {
  
  for (fixedamount=1; fixedamount<=6;fixedamount=fixedamount+1)
{
  fixedvalue=value[fixedamount];
  document.write("<table border='0'><tr><td>"); 

  for (row=0; row<=6;row=row+1)
 { document.write("<tr>");
  for (table=1; table<=3; table=table+1)
 {
  if (table==1) {fixed="B"; left="R";  upper="G";}
  if (table==2) {fixed="R"; left="G";  upper="B";}
  if (table==3) {fixed="G"; left="B";  upper="R";}

  for (column=0; column<=6; column=column+1)
  {
   if (fixed=="R") {redvalue=fixedvalue; fixedcolor="#CC0000"};
   if (fixed=="G") {greenvalue=fixedvalue; fixedcolor="#009900"};
   if (fixed=="B") {bluevalue=fixedvalue; fixedcolor="#0000CC"};
   if (left=="R") {redvalue=value[row]; leftcolor="#CC0000"};
   if (left=="G") {greenvalue=value[row]; leftcolor="#009900"};
   if (left=="B") {bluevalue=value[row]; leftcolor="#0000CC"};
   if (upper=="R") {redvalue=value[column]; uppercolor="#CC0000"};   
   if (upper=="G") {greenvalue=value[column]; uppercolor="#009900"};   
   if (upper=="B") {bluevalue=value[column]; uppercolor="#0000CC"};   

   if (column==0 && row==0) {document.write("<td bgColor="+fixedcolor+"><font color='#FFFFFF' size='1'>"+value[fixedamount]+"</font></td>")};
   if (column==0 && row!=0) {document.write("<td bgColor="+leftcolor+"><font color='#FFFFFF'  size='1'>"+value[row]+"</font></td>")};
   if (column!=0 && row==0) {document.write("<td bgColor="+uppercolor+"><font color='#FFFFFF' size='1'>"+value[column]+"</font></td>")};
   hexcolortext="#"+redvalue+greenvalue+bluevalue;
   hexcolorwords="#RRGGBB: ";   pixelstring="<a href='#' an=color alt='Click to see the hexcode' onClick=\"setB('"+hexcolortext+"');return false\">&nbsp;&nbsp;&nbsp;</a>";

   if (column!=0 && row!=0){document.write("<td bgColor=#"+redvalue+greenvalue+bluevalue+">"+pixelstring+"</td>")};
  } if (table<3) {document.write("<td bgColor=#f0f0f0>&nbsp;&nbsp;&nbsp;&nbsp;</td>")};
 }
 document.write("</font></tr>");
 } 
 document.write("</td></tr></table>");
}

}

// The function setB carry outs several purposes. The main task is CSS code generation. Also the function changes the main page CSS attributes to demonstrate how selected color looks.

function setB(c_color) {

 var bd = document.getElementById('bd');
 bd.setAttribute('bgColor',c_color);
 
 
 var Rc = c_color.substring(1,3);
 var Gc = c_color.substring(3,5);
 var Bc = c_color.substring(5,7);

 
 var cnt = parseInt(Rc,16)+parseInt(Gc,16)+parseInt(Bc,16);
 var n=(((765 - cnt)< 380)||(parseInt(Rc,16)==255)||(parseInt(Gc,16)==255)||(parseInt(Bc,16)==255))?-190:190; 
 
 var tn = Math.floor(n*3/2);
 
 
 var Tc = '#' + changeHex(Rc, tn)+changeHex(Gc,tn)+changeHex(Bc,tn);
 
 var Ac = '#' + changeHex(Rc,n)+changeHex(Gc,n)+changeHex(Bc,n);
 
 
 bd.style.color=Tc;

 
 var tn = Math.floor(n*3/4);
 
 var Avc = '#' + changeHex(Rc, tn)+changeHex(Gc,tn)+changeHex(Bc,tn);

 var tn = Math.floor(n*4/3);
 
 var Aac = '#' + changeHex(Rc, tn)+changeHex(Gc,tn)+changeHex(Bc,tn);

 var a_arr = document.getElementsByTagName('a'); 
 
 for (var i = 0; i < a_arr.length; i++) {
   if (!a_arr[i].getAttribute('an')) {
   
    a_arr[i].style.color = Ac;
	a_arr[i].style.backgroundColor = c_color;
	
		a_arr[i].onmouseover = function() {
            this.style.backgroundColor = Ac;
			this.style.color = c_color;
        }
        a_arr[i].onmouseout = function() {
            this.style.backgroundColor = c_color;
			this.style.color = Ac;
        }	
	}
 }	
 
 var tA = document.forms.copy 

 var txt_css = '<style type="text/css">\n\n';
 
 txt_css += 'body {background-color:'+ c_color +'; color:' + Tc + '} \n\n';
 
 txt_css += 'a:link {color:'+ Ac +'} \n\n';
 
 txt_css += 'a:visited {color:'+ Avc +'} \n\n';
 
 txt_css += 'a:active {color:'+ Aac +'} \n\n';
 
 txt_css += 'a:hover {color:'+ c_color +'; background-color:'+ Ac +'} \n\n';
 
 txt_css += '</style>'; 
 
 tA[0].value = txt_css; 
 
}


// This auxiliary function is used to change Hex number.

function changeHex(h, n){
 h=(typeof(h) == "string") ? parseInt(h,16) : h;
 if((h == 0 && n < 0)||(h == 255 && n > 0)){n = 0} 
 h += n;
 h = (h > 255) ? 255 : (h < 0) ? 0 : h;
 return (h <= 15) ? "0" + h.toString(16) : h.toString(16);
}