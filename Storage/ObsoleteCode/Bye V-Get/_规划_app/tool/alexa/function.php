<?php
function vvar_export($input,$t=null){
	$output = '';
	if (is_array($input)) {
		$output .= "array(\r\n";
		foreach ($input as $key => $value) {
			$output .= $t."\t".vvar_export($key,$t."\t").' => '.vvar_export($value,$t."\t");
			$output .= ",\r\n";
		}
		$output .= $t.')';
	} elseif (is_string($input)) {
		$output .= "'".str_replace(array("\\","'"),array("\\\\","\'"),$input)."'";
	} elseif (is_int($input) || is_double($input)) {
		$output .= "'".(string)$input."'";
	} elseif (is_bool($input)) {
		$output .= $input ? 'true' : 'false';
	} else {
		$output .= 'NULL';
	}
	return $output;
}

function writeover($filename,$data,$method="rb+"){
	@touch($filename);
	if($handle=@fopen($filename,$method)){
		flock($handle,LOCK_EX);
		fputs($handle,$data);
		if($method=="rb+") ftruncate($handle,strlen($data));
		fclose($handle);
	}
}
?>