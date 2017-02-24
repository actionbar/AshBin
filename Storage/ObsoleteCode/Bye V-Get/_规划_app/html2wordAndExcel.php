<?PHP 


class word 
{ 
function start() 
{ 
ob_start(); 
print'<html xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:w="urn:schemas-microsoft-com:office:word" 
xmlns="http://www.w3.org/TR/REC-html40">'; 
} 

function save($path) 
{ 
print "</html>"; 
$data = ob_get_contents(); 

ob_end_clean(); 
$this->wirtefile ($path,$data); 
} 
function wirtefile ($fn,$data) 
{ 
$fp=fopen($fn,"wb"); 
fwrite($fp,$data); 
fclose($fp); 
} 
} 
/*-------word class End-------*/ 
$word=new word; 
$word->start(); 
echo "<table width='500'><tr><td>love</td></tr><table>"; 
$wordname="word.doc"; 
$word->save($wordname);//保存word并且结束. 
?> 
<div align="center"><a href="<?php echo $wordname ; ?>" target=_blank class="unnamed1">试卷已经生成，请点击这里查看</a>  
</div>  
