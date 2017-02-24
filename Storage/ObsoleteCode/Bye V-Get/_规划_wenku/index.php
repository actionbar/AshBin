<?php
header("Content-type: text/html; charset=utf-8");
$c=mysql_connect("localhost","root","qwdw114");mysql_select_db("v9",$c);mysql_query("set names utf8");
$rq=mysql_query('SELECT * FROM l');
echo '<ul>';
while($r=mysql_fetch_array($rq)){
echo '<li><a href="'.$r['l'].'">'.$r['h'].'</a><a href="http://localhost/wenku.v-get.com/view/'.$r['h'].'.pdf">下载</a></li>';

}
echo '</ul>';
?>