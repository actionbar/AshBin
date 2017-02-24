<?php
	$L=$_POST['v'];
	$U="http://data.alexa.com/data/?cli=10&dat=snba&ver=7.0&url=".$L;
	echo file_get_contents($U);
?>