<?php
$L=$_POST['v'];
if(@get_headers($L)){
$a=get_headers($L);
foreach($a as $j){echo $j,'|';}
}
?>