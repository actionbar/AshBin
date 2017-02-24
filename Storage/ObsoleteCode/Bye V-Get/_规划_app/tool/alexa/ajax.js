function newXMLHTTPRequest(){
    var xmlreq;
    if(window.XMLHttpRequest){
        xmlreq = new XMLHttpRequest();
    }
    else{
        try{
            xmlreq = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e){          
            xmlreq = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlreq;
}
function backFun(req,id,vType){
    return function (){
        if(req.readyState==4 && req.status == 200){
			if(id=="changestext"){
				var rText = req.responseText.split('|');
				document.getElementById('ranks1').innerHTML = rText[0];
				document.getElementById('ranks2').innerHTML = rText[1];
				document.getElementById('ranks3').innerHTML = rText[2];
				document.getElementById('ranks4').innerHTML = rText[3];
				document.getElementById('ranks5').innerHTML = rText[4];
				document.getElementById('ranks6').innerHTML = rText[5];
				document.getElementById('ranks7').innerHTML = rText[6];
				document.getElementById('ranks8').innerHTML = rText[7];
			}else{
				switch(vType){
					case "value":
						document.getElementById(id).value = req.responseText;
						break;
					case "html":
						document.getElementById(id).innerHTML = req.responseText;
						break;
					case "alert":
						alert(req.responseText)
						break;   
				}
			}
        }
    }
}
function talktoServer(url,id,vType){
    var req = newXMLHTTPRequest();
    var cbf = backFun(req,id,vType);
    req.onreadystatechange = cbf;
    req.open("POST",url,true);
	req.setRequestHeader( "Content-Type", "text/html;charset=UTF-8" ); 
    req.send(null);
}