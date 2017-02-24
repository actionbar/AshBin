
<?php
function jiweijiu($array){
	$count = count($array)-1;
	$flag = true;
	$bottom = 0;
	while($flag){
		$flag = false;
		for($i=$bottom;$i<$count;$i++){
			if($array[$i]>$array[$i+1]){
				$tmp = $array[$i];
				$array[$i] = $array[$i+1];
				$array[$i+1] = $tmp;                
			}
			$flag = true;
		}
		$count--;
		for($j=$count;$j>$bottom;$j--){
			if($array[$j]<$array[$j-1]){
				$tmp = $array[$j-1];
				$array[$j-1] = $array[$j];
				$array[$j] = $tmp;
			}
			$flag = true;
		}
		$bottom++;
	}
	return $array;
}
$array = array(12,45,89,3,24);
$a = jiweijiu($array);
print_r($a);
?> 