<?php
//  为了避免$Qs 和字段之类的被获取，
class c_db {

    private $_mysqli;  // MySqli每次new了，一般都换账号，所以不用static

    function virtualSingleArr($Qa, $fileds_arr, $fileds_mapping){
        foreach($fileds_arr as $filed_index => $filed){
            $arr_index = $fileds_mapping[$filed];
            $virtual_filed_arr[$arr_index] = $Qa[$filed];
        }
        return $virtual_filed_arr;
    }

    function virtualMultiArr($Qq, $fileds, $fileds_mapping){
        $fileds = str_replace(' ', '', $fileds);  // 去掉里面的空格

        $fileds_arr = $fileds != '*' ? explode(',', $fileds) : array_flip($fileds_mapping) ;


        $virtualQq = [];
            foreach($Qq as $Qq_index =>$Qa){
                $virtualQq[$Qq_index] = $this->VirtualSingleArr($Qa, $fileds_arr, $fileds_mapping);
            }
            return $virtualQq;
    }

    function SetMysqli($arr){
        $this->MySqli = new mysqli($arr['host'], $arr['user'], $arr['password'], $arr['datebase']);
        /*  if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            } */
    }

    function FilterContactInfo($str){  // 过滤手机号码、QQ号、邮箱、地址
        $str = preg_replace('/(Q|Ｑ|扣扣|企鹅|扣|联系|手机|电话|号)+[：[:punct:]一二三四五六七八九零壹贰叁肆伍陆柒捌玖\d１２３４５６７８９０①②③⑤]+/i', '', $str);
        // 过滤网址、邮箱
        $str = preg_replace('/(网址|邮箱)*[\:：]*[a-z]*\@?[a-z\-]+([\.\。][a-z]+)+/i', '', $str);

        return $str;
    }

     // 只能匹配 【非空】 md(5)后的密码、用户名（含中文）、邮箱、手机号，字符串长度小于32
    // 过滤特殊字符    '  "  \ ，标题、简洁都是允许有空格的，而且空格不涉及安全
    // Filter直接设置成静态，这要保证传递进来的字符串长度并不大，最长只能varchar255==> descrition，而text不能用到Filter
    static function Filter($str){   // 一般过滤 【' " \ < >】，需要用到  \\\ 来表示  \ 
        if(preg_match('/[\'\"\\\<>]/', $str)){
            c_const::Error(c_const::ERR_DB_ILLEGAL_WORDS);
        }
        return $str;
    }

    function FilterTitleDescription($str){   // 过滤标题
        self::Filter($str);
        return $this->FilterContactInfo($str);
    }

    function FilterText($str){  // 转义双引号、
        //对表单传递的字符需要不需要进行addslashes()需要先看看php.ini有没有开启magic_quotes_gpc，如果已经开启了，就不需要使用，PHP会自动addslashes()。【' " \ \0 】
        // 如果用于插入数据库，就需要对"转义，如果是重新post出去，就不能，就需要用stripslashes() 对默认转义反解
        // 适用各个 PHP 版本的用法

         /* 禁止【"<>\】 允许双引号 " ，单引号内转义，需要用到  \\\ 来表示  \ */
        if(preg_match('/[\'\\\<>]/', $str)){
            c_const::Error(c_const::ERR_DB_ILLEGAL_WORDS);
        }
        if (!get_magic_quotes_gpc()) {$str = addslashes($str);}
        return $str;
    }

    function QueryRows($Qs){
        $mysqli = $this -> MySqli;
        $Qq = $mysqli->query($Qs);
        return $Qq -> num_rows;
    }

    function Query($Qs, $must_success_or_fileds = true, $fileds_arr_mappding =false){
        $mysqli = $this -> MySqli;
        $Qq = $mysqli->query($Qs);
        if($Qq){
            if($fileds_arr_mappding){  // 输出虚拟的字段名，一定不为空
                return $this->VirtualMultiArr($Qq, $must_success_or_fileds, $fileds_arr_mappding);
            }
            return $Qq;
        }
        if($must_success_or_fileds){c_const::Error(c_const::ERR_DB_NOT_FOUND);}
        else {return false;}

    }

    function QueryToQa($Qs, $must_success_or_fileds = true, $fileds_arr_mappding =false){
        $mysqli = $this -> MySqli;
        $Qq = $mysqli->query($Qs);
        
        if($Qq->num_rows > 0){
            $Qa = $Qq->fetch_assoc();
            if($fileds_arr_mappding && $Qa){  // 输出虚拟的字段名，一定不为空
        
                $fileds_arr = str_replace(' ', '', $must_success_or_fileds);  // 去掉里面的空格
                $fileds_arr = $fileds_arr != '*' ? explode(',', $fileds_arr) : array_flip($fileds_arr_mappding) ;
            
                return $this->VirtualSingleArr($Qa, $fileds_arr, $fileds_arr_mappding);
            }
            return $Qa;
        }
        
        if($must_success_or_fileds){c_const::Error(c_const::ERR_DB_NOT_FOUND);}
        else{return false;}
       

        
    }
    
    function Update($Qs, $must_success = true){ // 返回更新了几行
        // prepare 用于 stmt 数据库操作更好
        $mysqli = $this -> MySqli;  
        $updated = $mysqli->query($Qs);
        $updated = $mysqli->affected_rows;
        if($must_success && $updated < 1){
            c_const::Error(c_const::ERR_SERVER);
        }
        return $updated;
    }

    function Insert($Qs, $return_insert_id=false, $must_success = true){ // 返回插入的自增id或者 插入了几行
        $mysqli = $this -> MySqli;
        $Qq = $mysqli->query($Qs);
     
        // insert_id 返回AUTO_INCREMENT的ID，所以一定是数字
        $is_success = $return_insert_id ? $mysqli->insert_id : $mysqli->affected_rows;

        if($must_success && $is_success<1 ){
            c_const::Error(c_const::ERR_SERVER);
        }

        return $is_success;
    }
    
    function InsertSet($Qs, $return_insert_id=false, $must_success = true){ // insert into db set a='a'
        return $this->Insert($Qs, $return_insert_id, $must_success);
    }




    function UniqueSeIn($read_account, $write_account, $table, $set_str, $key_filed){
        if(empty($set_str)){  // 如果没有设置，就返回0
            return 0;
        }
        $this->SetMysqli($read_account);
        $Qs = 'SELECT '. $key_filed .'  FROM '. $table .' WHERE '. $set_str;

        $Qa = $this->QueryToQa($Qs, false);
        if($Qa){
            return $Qa[$key_filed];
        }
         // 没有找到，就插入，这里device设为了唯一性，所以防止了并发
  
        $this->SetMysqli($write_account);
        $Qs = 'INSERT INTO '. $table .' SET '. $set_str;
        return $this->InsertSet($Qs, true); 
    }

    function UniqueUpIn($write_account, $table, $set_str,  $where_no_auto_increment_key, $auto_increment_key = false, $auto_increment_key_value = 0){
/*
UPDATE i_resume_career SET a=100 WHERE careerid=7 AND u="中国"
INSERT INTO i_resume_career SET a=100, u="中国"  【判断是不是自增id】
    UniqueUpIn($write_account, $table, 'a=100',  'u="中国"', 'careerid' 7);   返回 7
    UniqueUpIn($write_account, $table, 'a=100',  'u="中国"', 'careerid' 0);   返回 7
INSERT INTO i_resume_career SET a=100, u="中国"
UPDATE i_resume_career SET a=100 WHERE u="中国"
    UniqueUpIn($write_account, $table, 'a=100',  'u="中国"');
*/
        $this->SetMysqli($write_account);

        $Qs_update = 'UPDATE '. $table .' SET '. $set_str .' WHERE '. ($auto_increment_key ? ($auto_increment_key .'= '. $auto_increment_key_value .' AND ') : '') . $where_no_auto_increment_key;



        // $auto_increment_key_str 用于避免 Update传递相同值，没有执行成功，重复插入

       //if($auto_increment_key_value<1 && ($auto_increment_key || !$this->Update($Qs_update, false) )) 不能这样，否则当插入带有id的，将永远无法执行 Update，必须把 !update 放在前面
        if(!$this->Update($Qs_update, false) && $auto_increment_key_value<1){

            $Qs_insert = 'INSERT INTO '. $table .' SET '. $where_no_auto_increment_key .', '. $set_str;
            //echo $Qs_insert;
            if($auto_increment_key){
                return $this->InsertSet($Qs_insert, true);  // 返回自增插入的id
            }
            else{$this->InsertSet($Qs_insert);}
        }
        return $auto_increment_key ? $auto_increment_key_value : true;  // 使用带有 auto_increment_key 的，成功后，返回之前的id，如果不是auto key 的，就返回update 正确
    }



    function Delete($Qs, $must_success = true){ // 返回删除了几行
        $mysqli = $this -> MySqli;  
        //$Qs = 'DELETE FROM '. self::$Table .' WHERE '. self::$Where;
        $del = $mysqli->query($Qs);
        $del = $mysqli->affected_rows;
        if($must_success && $del < 1){
            c_const::Error(c_const::ERR_SERVER);
        }
        return $del;
    }

    
    function SelectCount($Qs, $not_zero = true){
        $mysqli = $this -> MySqli;
        // $Qs = 'SELECT COUNT(*) FROM '. self::$Table .' WHERE '. self::$Where;
        $Qq = $mysqli->query($Qs);

        $Qr = $Qq->fetch_row();
        $rows = $Qr[0];
        if($not_zero && $rows<1){  // 必须要查到
            c_const::Error(c_const::ERR_DB_NOT_FOUND);
        }
        return $rows;
    }

}