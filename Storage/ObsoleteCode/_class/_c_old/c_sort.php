<?php
//  分块管理，techf   /  case 这样方便以后独立管理
/*
数据库表字段  
 	sid    
	eng 
 	cn   
	filed （文章数据库分类字段名 用于生成文章分类json，json分类主键 [afiled1:{},{}]）
 	filedid  数字型分类

*/
class c_sort{

/*  这个需要重新架构 static 被滥用了  */
	public static $Db;
	public static $DbTable;
	private static $Sid;
	private static $Seng;
	private static $Scn;
	private static $Filed;  // 数据库字段
	private static $FiledId;  // 数据库字段
	
	function sortAll($where='1'){

		$order_by = empty($_GET['order'])?'':' ORDER BY '. $_GET['order'];
		
		
		$Qs='SELECT * FROM '. self::$DbTable . ' WHERE '. $where . $order_by;
		$Qq = self::$Db->createCommand($Qs)->query();
        return $Qq;
	}

	function sortChange(){
		self::$Seng = $_POST['eng'];
		self::$Scn = $_POST['cn'];
		self::$Filed = $_POST['filed'];
		self::$FiledId = $_POST['filedid'];
			// 插入不需要sid，即使sid不按顺序，也不影响性能，所以这里简化
		if(empty($_POST['sid'])){  // 没有 sid 就是插入
			return self::sortInsert();
		}
		else{
			self::$Sid = $_POST['sid'];
			return self::sortUpdate();
		}
	}

	function sortUpdate(){
		$Qs='UPDATE '. self::$DbTable .' SET eng="'. self::$Seng  .'", cn="'. self::$Scn .'", filed = "'. self::$Filed .'", filedid='. self::$FiledId .' WHERE sid='.self::$Sid;
		$isUpdated = self::$Db->createCommand($Qs)->execute();
        return $isUpdated;
	}

	function sortInsert(){
		$Qs='INSERT INTO '. self::$DbTable .' (eng, cn, filed, filedid) VALUE ("'. self::$Seng .'", "'. self::$Scn .'", "'. self::$Filed .'", '. self::$FiledId .')';
		
		try{
			$isUpdated = self::$Db->createCommand($Qs)->execute();
        	return self::$Db->getLastInsertID();  //返回自动增加的id
    	}
    	catch(Exception $e){return '0';}
	}



	function writeJson($file, $jsonkeyArry){
		// $jsonkeyArry = array('field1'=>0/1, 'field2'=>0/1, 'filed3');  
		// $select_necessary 如果为0，表示不添加空，有默认值，如果为1，表示添加空，必填
		// 生成 assets/api/tech/sort.js
		$C_file = new c_file();

		
		$json = 'var sveSortJson={';

		foreach($jsonkeyArry as $jsonKey=>$select_necessary){
			$Qq=self::sortAll('filed="'. $jsonKey .'"');
			$json .= '"sve'. $jsonKey .'":[{';   
			$json .= '"select_necessary":'. $select_necessary .',';// 如果第一个为 "":"" 就表示这个选项必填
			foreach($Qq as $Qa){
				$json .= '"'. $Qa['cn'] .'":'. $Qa['sid'] .',';
			}
			$json.='}],';

		}
		


		$json .= '};';


		$C_file->write($file, $json);
	}


}

?>