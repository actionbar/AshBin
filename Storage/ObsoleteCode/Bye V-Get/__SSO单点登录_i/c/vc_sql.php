<?php
function ss_open($save_path, $session_name)
{
	@mysql_connect('localhost','root','qwdw114')				//选择数据库之前需要先连接数据库服务器
	or die('数据库服务器连接失败');
	@mysql_select_db('vv')					//选择数据库mydb
	or die('数据库不存在或不可用');
	return true;
}

// ss 里面的 v字段 ：vc|s:3:"456";love|s:3:"123";   格式如右，里面包含 ""，所以写insert或者update的时候，千万不要'INSERT INTO ss VALUES("'.$key.'","'.$data.'", '.$expiry_time.')'  ；这种写法是无法写入数据库的

//ss 数据库  session 的 v必须要用 text，因为一个id所有session都记录在一个位置
function ss_close(){return true;}

//PHP文件才能使用 session，html/js等在远程服务器不可以使用，不然每次都会不同

function ss_read($I)
{
	@mysql_connect('localhost','root','qwdw114')				//选择数据库之前需要先连接数据库服务器
	or die('数据库服务器连接失败');
	@mysql_select_db('vv')					//选择数据库mydb
	or die('数据库不存在或不可用');
	$expiry_time = time();						//获取Session失效时间
	//执行SQL语句获得Session的值
	//$I=session_id();
	$query = @mysql_query('SELECT v FROM ss  WHERE i = "'.$I.'" AND t >'.$expiry_time)
	or die('SQL语句执行失败');
	if($row = mysql_fetch_array($query))
		{return $row['v'];}
	else
		{return false;}
}

function ss_write($I, $data)
{
	@mysql_connect('localhost','root','qwdw114')				//选择数据库之前需要先连接数据库服务器
	or die('数据库服务器连接失败');
	@mysql_select_db('vv')					//选择数据库mydb
	or die('数据库不存在或不可用');
	$expiry_time = time()+259200;						//获取Session失效时间  + 259200秒 =3天
	//查询Session的键值是否已经存在
	//$I=session_id(); //通过这种获得的id，比$key更准确
	$query = @mysql_query('SELECT v FROM ss WHERE i = "'.$I.'"')
	or die('SQL语句执行失败');
	//如果不存在，则执行插入操作，否则执行更新操作
	if(mysql_numrows($query) == 0)
	{	
		//执行SQL语句插入Session的值
		$query = @mysql_query("INSERT INTO ss VALUES('$I', '$data', $expiry_time)")
		or die('SQL语句执行失败');
	}
	else
	{
		//执行SQL语句更新Session的值
		$query = @mysql_query("UPDATE ss SET v = '$data', t = $expiry_time WHERE i = '$I'")
		or die('SQL语句执行失败');
	}
	return $query;
}

function ss_destroy($I)
{
	@mysql_connect('localhost','root','qwdw114')				//选择数据库之前需要先连接数据库服务器
	or die('数据库服务器连接失败');
	@mysql_select_db('vv')					//选择数据库mydb
	or die('数据库不存在或不可用');
	//执行SQL语句删除Session
	//$I=session_id();
	$query = @mysql_query('DELETE FROM ss WHERE i = "'.$I.'"')
	or die('SQL语句执行失败');
	return $query;
}

function ss_gc($expiry_time)
{
	@mysql_connect('localhost','root','qwdw114')				//选择数据库之前需要先连接数据库服务器
	or die('数据库服务器连接失败');
	@mysql_select_db('vv')					//选择数据库mydb
	or die('数据库不存在或不可用');
	$expiry_time = time();
	//执行SQL语句删除Session
	$query = @mysql_query('DELETE FROM ss WHERE t < '.$expiry_time)
	or die('SQL语句执行失败');
	return $query;
}

//设置用户自定义Session存储
session_set_save_handler('ss_open',
	'ss_close',
	'ss_read',
	'ss_write',
	'ss_destroy',
	'ss_gc');
?>