<?php
if(isset($_SESSION['i'])){
	echo $_SESSION['i'];
	}
else {echo 'window.open("http://localhost:8080/v-get.com/shop/log.php")';}
?>