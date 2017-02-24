	var c = 0;

	variants = new Array("FF", "CC", "99", "66", "33", "00")
  

 
 function Set () {
  var by = document.getElementById("sample");
    
  var txt = document.forms.colors;
  
  by.style.fontFamily = txt[6].options[txt[6].selectedIndex].text;

  by.style.fontSize = txt[7].value + txt[8].options[txt[8].selectedIndex].text;  
  
  
   by.style.backgroundColor = txt[0].value;
   
   by.style.color = txt[1].value;  
   
   alink("an", txt[2].value,txt[3].value);
   
   alink("aa", txt[4].value,txt[3].value);
   
   alink("av", txt[5].value,txt[3].value);
  
  
  var tarea = document.forms.css;
  
  
  var csstext = '<style type="text/css">\n\n';
 
 csstext += 'body {\n background-color:'+ txt[0].value + ';\n';
 
 csstext += ' color:' + txt[1].value + ';\n' ;
 
 csstext += ' font-family:' + txt[6].options[txt[6].selectedIndex].text + ';\n' ;
 
 csstext += ' font-size:' + txt[7].value + txt[8].options[txt[8].selectedIndex].text + ';\n' ;
 
 csstext += ' margin-top:' + txt[9].value + txt[10].options[txt[10].selectedIndex].text + ';\n' ;
 
 csstext += ' margin-left:' + txt[11].value + txt[12].options[txt[12].selectedIndex].text + ';\n' ;

 csstext += ' margin-right:' + txt[13].value + txt[14].options[txt[14].selectedIndex].text + ';\n' ;
 
 csstext += ' margin-bottom:' + txt[15].value + txt[16].options[txt[16].selectedIndex].text + ';\n' ; 
 
 csstext += '} \n\n';
 
 
 csstext += 'td {\n';
 
 csstext += ' font-family:' + txt[6].options[txt[6].selectedIndex].text + ';\n' ;
 
 csstext += ' font-size:' + txt[7].value + txt[8].options[txt[8].selectedIndex].text + ';\n' ;
 
 csstext += '} \n\n';
 
 
 csstext += 'a:link {color:'+ txt[2].value +'} \n\n';
 
 csstext += 'a:visited {color:'+ txt[5].value +'} \n\n';
 
 csstext += 'a:hover {color:'+ txt[4].value +'} \n\n';
 
 csstext += 'a:active {color:'+ txt[3].value +'} \n\n';
  
 csstext += '</style>'; 
  
 tarea[0].value = csstext;
   
 }
  
 function alink(el, ac, hc) {
 
        var al = document.getElementById(el);
   
        al.style.color = ac;
	
		al.onmouseover = function() {
			this.style.color = hc;
        }
        al.onmouseout = function() {
			this.style.color = ac;
        }	
	
	
  
 }
  
  
  function SetColor(color) {
  
   
   var by = document.getElementById("sample");
     
   var txt = document.forms.colors;   
   
      
   txt[c].value = color; 

   Set ();
   
   } 
   


    function MakeArray() {
      i = 0
      for (var blue = 0; blue < 6; blue++) 
        for (var red = 0; red < 6; red++) 
          for (var green = 0; green < 6; green++) 
            this[i++] = variants[red]+variants[green]+variants[blue]
      return this
    }

    theColors = new MakeArray()

    function makeTable() {
      var content = "<div align=center><table border=1 cellpadding=0 cellspacing=0>"
      content += "<tr>"
      for (var i = 0; i < 216; i++) {
        if ((i+1) % 6 == 5 || (i+1) % 6 == 4) {
          content += "<th onClick = 'SetColor(this.bgColor);' " + "width='20' height='20' bgcolor=" + theColors[i] + "></th>"
        } else if ((i+1) % 6 == 0) {
          content += "<th onClick = 'SetColor(this.bgColor);' " + "width='20' height='20' bgcolor=" + theColors[i] + "></th>"
        } else {
          content += "<th onClick = 'SetColor(this.bgColor);' " + "width='20' height='20' bgcolor=" + theColors[i] + "></th>"
        }
        if ((i+1) % 6 == 0) {
          content += "</tr><tr>"
        }
      }
      content += "</tr></TABLE></div>"
      document.write(content)
    }