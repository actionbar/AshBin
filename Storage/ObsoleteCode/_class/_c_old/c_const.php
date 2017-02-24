<?php

class c_const{  // 编码格式转换

	public static $ArrForCoding = [];  // 返回用于编译成json的数组


	const SSO_TOKEN = 'ok';
	const SSO_SESSION_ID = 'ssosess';
// 从 sso 返回的值
	const SSO_USERNAME = 'u';
	const SSO_USER_STATUS = 'us';
	const SSO_AVATAR = 'ua';
	const SSO_AVATAR_DEFAULT = 'uad';
	const SSO_AVATAR_MIDDLE_URL = 'uam';
	const SSO_AVATAR_BID_URL = 'uab';
	const REQUEST_LONGITUDE = 'lo';
	const REQUEST_LATITUDE = 'la';
	const REQUEST_IP = 'ip';

	const REQUEST_PAGE = 'pg';

	const REQUEST_TITLE = 'sh';
	const REQUEST_KEYWORDS = 'sk';
	const REQUEST_DESCRIPTION = 'sd';
	const REQUEST_TEXT = 'sf';
	const REQUEST_TIME = 'st';



	const LUEXU_ERRORID = 'ERR';
	static $ErrId = 0;  // 这个必须，用于判断是否成功

	function Json($arr){
		if($arr && is_array($arr)){
			$arr['ErrId'] = self::$ErrId;
		}
		else{
			$arr = [];
		}
		return json_encode($arr);

	}

	static function Error($error_id){  // 无论是网页，还是APP，一旦出现数据库错误，就直接停止，输出json错误
		// if(self::$ErrId == 0){
		// 	self::$ErrId = $error_id;
		// }
		echo json_encode([self::LUEXU_ERRORID=>$error_id]);
		exit();
	}


//  公用错误，仅用于前台显示 1 - 99  ，http 状态码  100 - 505


	// 验证错误  ==> 登陆、验证、授权错误 7
	const ERR_VERIFY = 7;  // 验证错误、需要登陆验证、用户名或者密码错误
	const ERR_NOT_LOGIN = 71; // 必须要登陆
	const ERR_CAPTCHA = 72;  // 验证码错误


	// 服务器错误、数据库错误 8
	const ERR_SERVER = 8;
	const ERR_DB_ILLEGAL_WORDS = 81; // 传递了非法字符，如引号、敏感词汇
	const ERR_DB_NOT_FOUND = 82; // 没有找到，查询失败，语句正确
	const ERR_DB_VALUE_REPEATED = 83; // 值已找到，无法重复插入
}

?>