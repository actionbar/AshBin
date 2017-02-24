<?php

class CFuncList
{
    public $funcFiles = '/_ca/*Ctrl.php'; //读取文档
    function classArr()
    { // 需要读取的文件，每个文件一个类
        $CFile = new CFile();
        $dir_arr = glob($this->funcFiles);

        $class_arr = [];
        foreach ($dir_arr as $path) {
            $text = $CFile->read($path);
            // 需要强制重置，避免$evaluated_cobj2str 里面已经赋值的 setPhpFile，对以后其他引用的造成赋值
            $single_arr = $this->singleClassFunctions($text, $path);

            if (!empty($single_arr)) {
                $class_arr = array_merge($class_arr, $single_arr);
            }
            return $class_arr;
        }
    }

    function singleClassFunctions($text, $cobj2str_path)
    {
        $Cobj2str = new CObj2str();


        /*
         *  ["class"=>["func1"=>["request_param"=>["param"=>"","param2"=>"int"], "return"=>[]],"func2"=>[]]];

        */


        // 一个里面只有一个类
        preg_match('/class\s+(\w+)[\r\t\n\s]*\{[\r\t\n\s]*/', $text, $function_class_matches);
        if (!$function_class_matches) {
            return false;
        }


        $func_class = $function_class_matches[1]; // 这里对 func_class 进行替换
        $func_class = preg_replace('/^(\w*Ctrl)$/', '$1', $func_class);


        preg_match_all('/@\s*return[\r\s\t\n\*]+([\[\{]+([\r\s\t\n\*]*\w+[\w\:\s]*\w+\s*:[\s\"]*\w+[\"\r\s\t\n\*,;]*)*[\}\]]+)[\r\t\n\s\*]*\*\/[\r\t\n\s]*function\s+(\w+)\s*\(\s*\$([^\)]+)*\s*\)[\r\t\n\s]*\{/', $text, $matches, PREG_SET_ORDER);


        foreach ($matches as $matchindex => $match) {


            $func_name = $match[3]; // function_name
            $http_methods = $match[4];
            $return_arr[$func_class][$func_name]['http_methods'] = $http_methods;
            $return_arr[$func_class][$func_name]['param_optional'] = [];
            $return_arr[$func_class][$func_name]['param_required'] = [];

            $func_text = $Cobj2str->func($func_class . '->' . $func_name,false, false,$cobj2str_path);


            // 获取函数内容
            //var_dump($func_text);
            preg_match_all('/\s*(\((float|int|bool|string)\))?\s*\$' . $http_methods . '\[\s*([\w\:\s]+)\s*\]/i', $func_text, $param_matches, PREG_SET_ORDER);


            foreach ($param_matches as $param_index => $param_detail) {

                $param_type = empty($param_detail[2]) ? '' : $param_detail[2]; // 为空，就是 string，否则就是 int
                $param_const = $param_detail[3];


                eval('$param = ' . $param_const . ';');

                // 如果匹配  empty($P[xxxx])  就表示是可选参数
                preg_match('/empty\(\s*\$(get|post)\[\s*' . $param_const . '\s*\]\s*\)/', $text, $param_optional);

                if ($param_optional) {
                    $return_arr[$func_class][$func_name]['param_optional'][$param]['param_type'] = $param_type;
                } else {
                    $return_arr[$func_class][$func_name]['param_required'][$param]['param_type'] = $param_type;
                }
                //  "request_param"=>["param"=>"","param2"=>"int"]   ==>  {"param":"","param2":"int"}
            }
            // var_dump($param_matches);

            $preg_return_str = $match[1];

            /*
             * a_task_const::REQUEST_TASK_ASKID : int
              RQST_HEADER : str
            */
            preg_match_all('/([\w\:]+)\s*:\s*(flt|str|int|string|integer|float)/', $preg_return_str, $preg_return_match_to_arr, PREG_SET_ORDER);

            if ($preg_return_match_to_arr) {
                foreach ($preg_return_match_to_arr as $return_value) {

                    eval("\$return_param = $return_value[1];");

                    $return_type = $return_value[2];
                    $return_arr[$func_class][$func_name]['func_return'][$return_param]['param_type'] = $return_type;
                }
            } else {
                $return_arr[$func_class][$func_name]['func_return'] = [];
            }


            $check_is_array = $match[1];

            if ('[' == $check_is_array{0}) { // 判断返回是否是数组，即列表，如果以 [ 开头，就是
                $return_arr[$func_class][$func_name]['func_return_is_arr'] = 1;
            } else {
                $return_arr[$func_class][$func_name]['func_return_is_arr'] = 0;
            }


        }

        return $return_arr;

    }


}

?>