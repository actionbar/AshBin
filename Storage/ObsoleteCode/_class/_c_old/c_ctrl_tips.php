<?php
class c_ctrl_tips{
	public $ReadFromDir = '../_c';  //读取文档
	public $C_obj2str;
	function __construct(){
		$this->C_obj2str = new c_obj2str();
	}
	
	function classArr(){  // 需要读取的文件，每个文件一个类
		$c_file = new c_file();
		$dir_arr = glob($this->ReadFromDir . '/*_ctrl.php');
		$class_arr = [];
		foreach($dir_arr as $pathindex=>$path){
			$text = $c_file->read($path);

			$this->C_obj2str->ClassOrFuncPath = $path;
			$single_arr = $this->SingleClassFunctions($text);
			if(!empty($single_arr)){
				$class_arr = array_merge($class_arr, $single_arr);
			}
			return $class_arr;
		}
	}

	function singleClassFunctions($text){
		/*
		 *  ["class"=>["func1"=>["request_param"=>["param"=>"","param2"=>"int"], "return"=>[]],"func2"=>[]]];

		*/


		// 一个里面只有一个类
		preg_match('/class\s+(\w+)[\r\t\n\s]*\{[\r\t\n\s]*/', $text, $function_class_matches);
		if(!$function_class_matches){
			return false;
		}



		$func_class=$function_class_matches[1];   // 这里对 func_class 进行替换
		$func_class = preg_replace('/^a_(\w*)_ctrl$/', '$1', $func_class);



		preg_match_all('/@return[\r\s\t\n\*]+([\[{]+([\r\s\t\n\*]*\w+::\w+\s*:[\s\"]*\w+[\"\r\s\t\n\*,;]*)*[}\]]+)[\r\t\n\s\*]*\*\/[\r\t\n\s]*function\s+([a-zA-Z]\w+)\s*\([^\)]*\)\{/', $text, $matches, PREG_SET_ORDER);



		foreach($matches as $matchindex=>$match){
			
			$func_name = $match[3];  // function_name
			$return_arr[$func_class][$func_name]['http_methods'] = 'GET';
			$return_arr[$func_class][$func_name]['param_optional'] = [];
			$return_arr[$func_class][$func_name]['param_required'] = [];
			$func_text = $this->C_obj2str->func($func_class.'->'.$func_name); 

			preg_match('/\$http_methods\s*\=\s*\$_(GET|POST)\s*;/', $func_text, $http_methods_matches);
			if($http_methods_matches){
				$return_arr[$func_class][$func_name]['http_methods'] = $http_methods_matches[1];
				
			 // 获取函数内容
			//var_dump($func_text);
			preg_match_all('/\s*(\((float|int|bool|string)\))?\s*\$http_methods\[\s*(\w+\:\:\w+)\s*\]/i', $func_text, $param_matches, PREG_SET_ORDER);


			

				foreach($param_matches as $param_index => $param_detail){

					$param_type = empty($param_detail[2])?'':$param_detail[2];// 为空，就是 string，否则就是 int
					$param_const = $param_detail[3];
					eval('$param = '. $param_const .';');
					// 如果匹配  empty($P[xxxx])  就表示是可选参数
					preg_match('/empty\(\s*\$http_methods\[\s*'. $param_const .'\s*\]\s*\)/', $text, $param_optional);
					
					if($param_optional){
						$return_arr[$func_class][$func_name]['param_optional'][$param]['param_type'] = $param_type;
					}
					else{
						$return_arr[$func_class][$func_name]['param_required'][$param]['param_type'] = $param_type;
					}
					//  "request_param"=>["param"=>"","param2"=>"int"]   ==>  {"param":"","param2":"int"}
				}
				// var_dump($param_matches);
			}
			$preg_return_str = $match[1];
		
				 /*a_task_const::REQUEST_TASK_ASKID : int
	 				a_task_const::REQUEST_TASK_ASKID2 : int*/
	 		preg_match_all('/(\w+::\w+)\s*:\s*(\w+)/', $preg_return_str, $preg_return_match_to_arr, PREG_SET_ORDER);
	 		if($preg_return_match_to_arr){
	 			foreach($preg_return_match_to_arr as $return_value){
	 				eval("\$return_param = $return_value[1];");
	 				$return_type = $return_value[2];
	 				$return_arr[$func_class][$func_name]['func_return'][$return_param]['param_type'] = $return_type;
	 			}
			}
			else{
				$return_arr[$func_class][$func_name]['func_return'] = [];
			}
		
		
			$check_is_array = $match[1];
			
			if('[' == $check_is_array{0}){ // 判断返回是否是数组，即列表，如果以 [ 开头，就是
				$return_arr[$func_class][$func_name]['func_return_is_arr'] = 1;
			}
			else{
				$return_arr[$func_class][$func_name]['func_return_is_arr'] = 0;
			}
	

		}

		return $return_arr;

	}


	function toJson(){
		$class_arr = $this->ClassArr();
		// var_dump($class_arr);
		return json_encode($class_arr);

	}



}

?>