var txt;
function flip(){
		var xmlHttpReq = false;
		var self = this;
		txt=encodeURI(document.getElementById("icon").value);
		var WriteURI = 'fetch.php?action='+txt;
		if (window.XMLHttpRequest) {
		self.xmlHttpReq = new XMLHttpRequest();
		}
		else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		self.xmlHttpReq.open('POST', WriteURI, true);
		self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		self.xmlHttpReq.send('');
		document.getElementById("txt").innerHTML = "<img src=\"images/wait.gif\">";
		self.xmlHttpReq.onreadystatechange = handleResponse;
		return false;

}
function handleResponse() {
	 if(xmlHttpReq.readyState == 4 && xmlHttpReq.status == 200){
	      var response = xmlHttpReq.responseText;
				if(response) {
				//document.getElementById("txt").value = response;
				//document.getElementById("scat").innerHTML = response;
				document.getElementById("txt").innerHTML = response;
				}
	}
}
