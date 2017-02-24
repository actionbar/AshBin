<?php
if(isset($_POST['cid'])&&isset($_POST['h'])){
$CID=$_POST['cid'];$A=$_POST['a'];$B=$_POST['b'];$C=$_POST['c'];
$H=$_POST['h'];$D=$_POST['d'];$K=$_POST['k'];$F=$_POST['f'];$G=$_POST['g'];
$USER=$_POST['user'];$N=$_POST['n'];$M=$_POST['m'];$PASS=$_POST['pass'];$T=$_POST['t'];$TM=$_POST['tm'];$editorClass=$_POST['editorclass'];$FL=$_POST['fl'];$FUNIT=$_POST['funit'];
//$H=str_replace("'","&#39;",$H);$H=str_replace('"',"&#34;",$H);

//post_data需要转义，由于这里是不含代码的编辑器，所以一律变成 &#39;
$F=str_replace("'","&#39;",$F);$D=str_replace("'","&#39;",$D);$N=str_replace("'",'&#39;',$N);

require('editor_user.php');
$Auser=$Usercheck[$USER];
$Apass=$Auser[0];$Aweb=$Auser[2];
if($Apass!=$PASS||$Aweb!=$CID){echo 'Your Password is wrong!';exit;}


$CUS=$CUScheck[$CID];
$VGETID=$CUS[0];

//&#39; 里面&是  下面的传递切割，所以需要对传递的进行 urlencode
$urlH=urlencode($H);$urlF=urlencode($F);$urlD=urlencode($D);


$post_data='g='.$G.'&m='.$M.'&n='.$N.'&fl='.$FL.'&funit='.$FUNIT.'&a='.$A.'&b='.$B.'&c='.$C.'&h='.$urlH.'&editorclass='.$editorClass.'&d='.$urlD.'&k='.$K.'&f='.$urlF.'&t='.$T.'&tm='.$TM.'&user='.$USER.'&vgetid='.$VGETID;




//如果是远程文件，curl才是首选。file_get_contents用来读取本地文件才是首选。而curl是对socket封装后的工具，所以最简洁的是socket
//但是socket不支持多线程，就是同步多个编辑就会出问题，还是用curl比较好
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_URL,$CUS[1]);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	 ob_start();  
	curl_exec($ch);
	$result=ob_get_contents(); 
	ob_end_clean(); 
if($result=='v'){$OK=1;}else {$OK=0;}



/* 为了避免编辑与客户接触，编辑撰写的文章传递到这里e.v-get.com  然后模拟PHP传递给客户网站，而只要调配好本地的curl 就可以了 */

/* 
grant all privileges on editor.* to EDTvgt301mo03@localhost identified by 'F1ckU01Dwcl';
 */
$Qc=mysql_connect('localhost','EDTvgt301mo03','F1ckU01Dwcl');mysql_select_db('editor',$Qc);mysql_query('set names utf8');

//替换必须在上面传递值后
//对$F前端已经转码为 \"了，而 <> 是mysql 大于小于，所以如果用 "insert ... '$F'"遇到大小于有的php会自动替换成&nbsp; 而通过再传递Post，会把 \" 替换成\\\" ，所以前台一律不对f /d 修改引号
 $D=str_replace('"','\"',$D);
 $F=str_replace('"','\"',$F);
$N=str_replace('"','\"',$N);
$TB='w'.$CID;
$Qs="INSERT INTO $TB (cid,co,a,b,c,h,d,k,f,n,m,t,fl,fu,user,ok) VALUES ($CID,$editorClass,'$A','$B','$C','$H','$D','$K','$F','$N','$M','$T',$FL,$FUNIT,'$USER',$OK)";
mysql_query($Qs) or die ('Insert Into E.V-Get.com Aritle failed: '.mysql_error());



$back=$_POST['comes'];
//远程服务器跳转不了  file:///C: 
header('location: '.$back);exit;
}
else {header('location: http://e.v-get.com/tech/');}
?>