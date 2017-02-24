<?php
function ss_open($save_path, $session_name)
{
	@mysql_connect('localhost','dDow0234Oe','sDIo20NDOOE02')				
	or die('数据库服务器连接失败open');
	@mysql_select_db('vv')			
	or die('数据库不存在或不可用');
	return true;
}

function ss_close(){return true;}

function ss_read()
{
	@mysql_connect('localhost','dDow0234Oe','sDIo20NDOOE02')				
	or die('数据库服务器连接失败read');
	@mysql_select_db('vv')				
	or die('数据库不存在或不可用');
	$expiry_time = time();	
    $I=session_id();	
	$query = @mysql_query('SELECT v FROM ss  WHERE i = "'.$I.'" AND t >'.$expiry_time)
	or die('SQL语句执行失败');
	if($row = mysql_fetch_array($query))
		{return $row['v'];}
	else
		{return false;}
}

function ss_write($key, $data)
{
	@mysql_connect('localhost','dDow0234Oe','sDIo20NDOOE02')				
	or die('数据库服务器连接失败write');
	@mysql_select_db('vv')					
	or die('数据库不存在或不可用');
	$expiry_time = time()+259200;	
    $I=session_id();	
	$query = @mysql_query('SELECT v FROM ss WHERE i = "'.$I.'"')
	or die('SQL语句执行失败');
	if(mysql_numrows($query) == 0)
	{	
		$query = @mysql_query("INSERT INTO ss VALUES('$I', '$data', $expiry_time)")
		or die('SQL语句执行失败');
	}
	else
	{
		
		$query = @mysql_query("UPDATE ss SET v = '$data', t = $expiry_time WHERE i = '$I'")
		or die('SQL语句执行失败');
	}
	return $query;
}

function ss_destroy()
{
	@mysql_connect('localhost','dDow0234Oe','sDIo20NDOOE02')				
	or die('数据库服务器连接失败destroy');
	@mysql_select_db('vv')				
	or die('数据库不存在或不可用');
	$I=session_id();
	$query = @mysql_query('DELETE FROM ss WHERE i = "'.$I.'"')
	or die('SQL语句执行失败');
	return $query;
}

function ss_gc($expiry_time)
{
	@mysql_connect('localhost','dDow0234Oe','sDIo20NDOOE02')				
	or die('数据库服务器连接失败gc');
	@mysql_select_db('vv')				
	or die('数据库不存在或不可用');
	$expiry_time = time();
	$query = @mysql_query('DELETE FROM ss WHERE t < '.$expiry_time)
	or die('SQL语句执行失败');
	return $query;
}

session_set_save_handler('ss_open',
	'ss_close',
	'ss_read',
	'ss_write',
	'ss_destroy',
	'ss_gc');
?>