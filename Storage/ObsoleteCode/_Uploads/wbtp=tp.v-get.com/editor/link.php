<?php
//对表单传递的字符需要不需要进行addslashes()需要先看看php.ini有没有开启magic_quotes_gpc，如果已经开启了，就不需要使用，PHP会自动addslashes()。【' " \ \0 】
// 如果用于插入数据库，就需要对"转义，如果是重新post出去，就不能，就需要用stripslashes() 对默认转义反解
$GMQG=get_magic_quotes_gpc()?TRUE:FALSE;

if(isset($_POST['fevgtsid'])&&isset($_POST['feh'])){
$CID=$_POST['fevgtsid'];$A=$_POST['fea'];$B=$_POST['feb'];$C=$_POST['fec'];

$E=$_POST['fee'];

$H=$_POST['feh'];$D=$_POST['fed'];$K=$_POST['fek'];$F=$_POST['fef'];$G=$_POST['feg'];
$USER=$_POST['fevgtusr'];$N=$_POST['fen'];$M=$_POST['fem'];$PASS=$_POST['fevgtpass'];$T=$_POST['fet'];$TM=$_POST['fett'];$editorClass=$_POST['fevgtuc'];$FL=$_POST['fevgtfl'];$FUNIT=$_POST['fevgtfu'];
$IMGS=$_POST['feimgsql'];
$back=$_POST['comes'];
//$H=str_replace("'","&#39;",$H);$H=str_replace('"',"&#34;",$H);

//post_data需要转义，由于这里是不含代码的编辑器，所以一律变成 &#39;
//$F=str_replace("'","&#39;",$F);$D=str_replace("'","&#39;",$D); $N=str_replace("'",'&#39;',$N);
// 取消自动的addslashes()

$urlF=$GMQG?stripslashes($F):$F;
$urlN=$GMQG?stripslashes($N):$N;
// 下面需要输入到数据库，所以需要转义
$F=$GMQG?$F:addslashes($F);
$N=$GMQG?$F:addslashes($N);






require('user.php');
$Auser=$Usercheck[$USER];
$Apass=$Auser[0];

if($Apass!=$PASS){echo 'Your Password is wrong!';exit;}
$CUS=$CUScheck[$CID];
$VGETID=$CUS[0];
//&#39; 里面&是  下面的传递切割，所以需要对传递的进行 urlencode
$urlG=urlencode($G);$urlM=urlencode($M);$urlH=urlencode($H);$urlF=urlencode($urlF);$urlD=urlencode($D);$urlN=urlencode($urlN);$urlT=urlencode($T);$urlK=urlencode($K);
$post_data='g='.$urlG.'&m='.$urlM.'&n='.$urlN.'&fl='.$FL.'&funit='.$FUNIT.'&a='.$A.'&b='.$B.'&c='.$C.'&e='.$E.'&h='.$urlH.'&editorclass='.$editorClass.'&d='.$urlD.'&k='.$urlK.'&f='.$urlF.'&t='.$urlT.'&tm='.$TM.'&user='.$USER.'&vgetid='.$VGETID;
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

header('location: '.$back);exit();



/* 为了避免编辑与客户接触，编辑撰写的文章传递到这里e.v-get.com  然后模拟PHP传递给客户网站，而只要调配好本地的curl 就可以了 */

/* 
grant all privileges on editor.* to EDTvgt301mo03@localhost identified by 'F1ckU01Dwcl';
 */
$Qc=mysql_connect('hdm-094.hichina.com','hdm0940519','MySQL0img1314');mysql_select_db('hdm0940519_db',$Qc);mysql_query('set names utf8');

//替换必须在上面传递值后
//对$F前端已经转码为 \"了，而 <> 是mysql 大于小于，所以如果用 "insert ... 

$TB='vgt_w'.$CID;
//不能用8，
if(empty($IMGS{7})){$P=0;}else {$P=1;
$VGT_T='vgt_t'.$CID;
//防止sql注入，以及 对\" 替换，因为传递过来的"都是\"
$imgs=array('\\','\'');
$IMGS=str_replace($imgs,'',$IMGS);
$Qsi="UPDATE $VGT_T set u=1 WHERE $IMGS";
mysql_query($Qsi) or die ('Update IMG failed: '.mysql_error());
}

$Qs="INSERT INTO $TB (cid,co,a,b,c,h,d,k,f,n,m,t,fl,fu,user,ok,p) VALUES ($CID,$editorClass,'$A','$B','$C','$H','$D','$K','$F','$N','$M','$T',$FL,$FUNIT,'$USER',$OK,$P)";
mysql_query($Qs) or die ('Insert Into E.V-Get.com Aritle failed: '.mysql_error());

//远程服务器跳转不了  file:///C: 
header('location: '.$back);exit();
}
else {header('location: http://e.v-get.com/');}
?>