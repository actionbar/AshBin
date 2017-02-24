<?php

class c_search{
	public $FiledsString;
	public $Table;
	public $OrderBy='';
	
	public $SelectPerPage=10; // 每页显示的数量
    
    public $SelectPageLimitStart=0;  // 开始查询行数，static 在 new一次后，值不变，所以不能用 static
	public $SelectPageAll=0; //总页数
	public $Qs; // 搜索查询string，new一次之后，基本都会变，所以不用static
	public $Qsy; // select count(*)


	//private static $keywordsArr;   // 关键词数组    word1,word2

	// function __construct($multiKeywords){
	// 	//self::$keywordsArr = explode(',', $multiKeywords);
	// }
	function GetToSetPageLimitStart($get='sp'){
		$S_sp = empty($_GET[$get])?1:(int)$_GET[$get];
		$this->SelectPageLimitStart = ($S_sp-1) * 10;  // 设置
		return $S_sp;
	}

	function GetToSetPageAll($get='spz'){
		if(!empty($_GET[$get])){   //如果传递了 spz ，并且值不为0
			$S_spz = $_GET[$get];
			$this->SelectPageAll = $S_spz;
		}
	}

	function toUTF8($S_sk){
		if(empty($_GET['ie']) || 'utf8'!=$_GET['ie']){
			$is_utf8 = preg_match('/^([\xE4-\xE9][\x80-\xBF]{2})|([\xE4-\xE9][\x80-\xBF]{2}){2,}|([\xE4-\xE9]{1}[\x80-\xBF]{2})$/', $S_sk);
			$S_sk = $is_utf8 ? $S_sk : iconv('gb2312', 'UTF-8', $S_sk);
		}
		
		return $S_sk;
	}
	// public static function filter($sk){
	// 	// filter begin and end blank
	// 	$sk=trim($sk);

	// 	$sk=preg_replace('/[\s,]+/g',' ');
	// 	return $sk;

	// }

	function selectLimit($where, $limitStart = 0){
		return 'SELECT '. $this->FiledsString . ' FROM '. $this->Table . ' WHERE '. $where  . $this->OrderBy . ' LIMIT '. $limitStart .',' . $this->SelectPerPage;

	}
	function union($where){
		return '(SELECT '. $this->FiledsString .' FROM (SELECT '. $this->FiledsString .' FROM '. $this->Table .' '.'WHERE  '. $where . $this->OrderBy . ') '. $this->Table .')';
	}
	function count($where){
		return 'SELECT COUNT(*) FROM '. $this->Table .' WHERE '. $where;
	}
	function multiLikeLimit($sk, $filedsArr=array('h','f')){ // 传值前要保证 $sk 一定不为空
		$arr = preg_split('/[\s　,]+/',$sk);
		$likeArr = array();
		$setQs = '';
		$isMoreThanOneWords=isset($arr[1]); //是否有切分多个词汇

		$setQy = '';  // 返回count(*) 查询总数语句
		foreach($filedsArr as $filed){  // 置空所有值
 			$likeArr[$filed]='';
 			$wholeWordsLike = $filed . ' LIKE "%'. $sk .'%"';  // 找到完全匹配整个词组的
 			$setQs .= ' UNION ' . self::union($wholeWordsLike);
 			if(1 > $this->SelectPageAll && !$isMoreThanOneWords){  // 如果仅一个词汇，没有切分更多，count(*) 就执行一个
 				$setQy .= ' OR '. $wholeWordsLike;  // OR h like '' OR f like ''
 			}
 		}

 		if($isMoreThanOneWords){   // 如果长度超过1个
 			
		foreach($arr as $single_key){
 			if(isset($single_key{0})){
 				foreach($filedsArr as $filed){
 					$likeArr[$filed] .= ' OR '. $filed . ' LIKE "%'. $single_key .'%"';
 				}
 			
 			}
 		}
 		
 		// 进行 union处理 以及 设置 count 的 where
		foreach($likeArr as $filedLike){  // OR h LIKE "%seo%"OR h LIKE "%love%"
			if(1 > $this->SelectPageAll){
				$setQy .= $filedLike;
			}
			$filedLike = substr($filedLike, 3);  // h LIKE "%seo%"OR h LIKE "%love%"
			$setQs .= ' UNION '. self::union($filedLike);
		}
		}

		
		
 		// (SELECT i,h,d,g,t,k FROM (SELECT i,h,d,g,t,k FROM f2013 WHERE h="seo love" ORDER BY t DESC) f2013) UNON (SELECT i,h,d,g,t,k FROM (SELECT i,h,d,g,t,k FROM f2013 WHERE f="seo love" ORDER BY t DESC) f2013) UNION (SELECT i,h,d,g,t,k FROM (SELECT i,h,d,g,t,k FROM f2013 WHERE h LIKE "%seo%" OR h LIKE "%love%" ORDER BY t DESC) f2013) UNION (SELECT i,h,d,g,t,k FROM (SELECT i,h,d,g,t,k FROM f2013 WHERE f LIKE "%seo%" OR f LIKE "%love%" ORDER BY t DESC) f2013) ORDER BY t DESC LIMIT 0,10

 		$setQs = substr($setQs, 6);
 		$this->Qs = $setQs .' LIMIT '. $this->SelectPageLimitStart .','. $this->SelectPerPage;
 		if(1 > $this->SelectPageAll){  // 如果没有设置
 			$setQy = substr($setQy, 3);
 			$this->Qsy = self::count($setQy);
 		}
 		

 		

	}

}