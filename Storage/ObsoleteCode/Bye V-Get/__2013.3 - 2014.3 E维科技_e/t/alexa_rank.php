<?php
	// $L='v-get.com';
$L=$_POST['v'];
$L="http://data.alexa.com/data/?cli=10&dat=snba&ver=7.0&url=".$L;
$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$L);curl_exec($ch);curl_close($ch);
	
	/* <ALEXA VER="0.9" URL="v-get.com/" HOME="0" AID="=">
	<RLS PREFIX="http://" more="0">
</RLS><SD TITLE="A" FLAGS="" HOST="v-get.com">
<CLAIMED DATE="2012-09-21T23:04:23Z"/>
<ALEXAPRO TIER="intro"/>
<LINKSIN NUM="23"/>    外链数量
<SPEED TEXT="395" PCT="95"/>
<CHILD SRATING="0"/></SD>
<SD><POPULARITY URL="v-get.com/" TEXT="166037" SOURCE="panel"/>  排名
<REACH RANK="236127"/>    
<RANK DELTA="-629818"/> 排名趋势
<COUNTRY CODE="CN" NAME="China" RANK="19071"/> 中国网站排名
</SD></ALEXA> */
	
?>