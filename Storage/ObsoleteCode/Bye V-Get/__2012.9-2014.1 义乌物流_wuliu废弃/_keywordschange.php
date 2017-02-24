<?php
require('c.php');
$rq=mysql_query("SELECT * FROM c where a=1 and b=154");
while($r=mysql_fetch_array($rq)){
$H=$r['h'];
if(preg_match('/义乌宾王\d+号/',$H,$mt)){
//mysql_query('update c set h=concat(h,"行李托运") where i='.$r['i']);
//echo $H.'<br />';
}


else {$n=rand(0,99);
if($n==0){$H.='托运站';}
else if($n==1){$H.='托运处';}
else if($n==2||$n==3){$H.='快运公司';}
else if($n>3&&$n<9){$H.='专线物流';}
else if($n>8&&$n<14){$H.='运输公司';}
else if($n>13&&$n<19){$H.='物流货运';}
else if($n>18&&$n<27){$H.='托运公司';}
else if($n>26&&$n<36){$H.='物流专线';}
else if($n>35&&$n<46){$H.='托运部';}
else if($n>45&&$n<56){$H.='货运物流';}
else if($n>55&&$n<68){$H.='货运公司';}
else if($n>67){$H.='物流公司';}
//echo $H.'<br />';
//mysql_query('update c set h="'.$H.'" where i='.$r['i']);
}
}
?>