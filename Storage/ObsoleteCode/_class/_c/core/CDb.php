<?php

/*
 * http://dev.mysql.com/doc/refman/5.1/zh/sql-syntax.html
 * $Qq query query
 * $Qa query a
 * $Qc  == connect
 * $Qs  query string
 * db  tb  field
 */

class CDb {
    public $Qs;
    private $Qc; // MySqli每次new了，一般都换账号，所以不用static

    function virtualSingleArr($Qa, $fields_arr, $fields_mapping) {
        foreach ($fields_arr as $field) {
            $arr_index = isset($fields_mapping[$field]) ? $fields_mapping[$field] : $field;
            $virtual_field_arr[$arr_index] = $Qa[$field];
        }
        return $virtual_field_arr;
    }

    function virtualMultiArr($Qq, $fields, $fields_mapping) {
        $fields = str_replace(' ', '', $fields); // 去掉里面的空格

        $fields_arr = $fields != '*' ? explode(',', $fields) : array_flip($fields_mapping);


        $virtualQq = [];
        foreach ($Qq as $Qq_index => $Qa) {
            $virtualQq[$Qq_index] = $this->VirtualSingleArr($Qa, $fields_arr, $fields_mapping);
        }
        return $virtualQq;
    }

    function conn($host, $user, $pwd, $db, $charset='utf8') {
        $this->Qc = new mysqli($host, $user, $pwd, $db);

        //utf8 的执行效率低于latin 1，如果系统默认设置的不是utf8,那么查询中文会出现问题
        // 这里默认 charset = utf8，为了性能，请连接的时候，判断是否是纯英文，如果是纯英文，就用 labin1

        $this->Qc->set_charset($charset);

        /*  if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            } */
    }

    /*
     * http://dev.mysql.com/doc/refman/5.1/zh/sql-syntax.html#create-database
     *
     * */
    function createDb($db_name) {
        $Qs = 'CREATE DATABASE IF NOT EXISTS ' . $db_name . '';
    }

    /*
     * http://dev.mysql.com/doc/refman/5.1/zh/sql-syntax.html#create-table
    */
    function createTb($tb_name) {
        $this->Qs = 'CREATE TABLE IF NOT EXISTS ' . $tb_name . ' ENGINE = INNODB';
    }


    /*
     * http://dev.mysql.com/doc/refman/5.1/zh/sql-syntax.html#delete
     * delete
     * @return deleted rows
     * @suggest U'd better use limit 1
     * 对于第一个语法，只删除列于FROM子句之前的表中的对应的行。对于第二个语法，只删除列于FROM子句之中（在USING子句之前）的表中的对应的行。作用是，您可以同时删除许多个表中的行，并使用其它的表进行搜索：

    DELETE t1, t2 FROM t1, t2, t3 WHERE t1.id=t2.id AND t2.id=t3.id;
    或：

    DELETE FROM t1, t2 USING t1, t2, t3 WHERE t1.id=t2.id AND t2.id=t3.id;
    注释：当引用表名称时，您必须使用别名（如果已给定）：

    DELETE t1 FROM test AS t1, test2 WHERE ...
    进行多表删除时支持跨数据库删除，但是在此情况下，您在引用表时不能使用别名。举例说明：

    DELETE test1.tmp1, test2.tmp2 FROM test1.tmp1, test2.tmp2 WHERE ...
     * */
    function delete($Qs, $close_connect = true) {
        $conn = $this->Qc;
        $Qq = $conn->query($Qs);
        $deleted_rows = $conn->affected_rows;
        //$Qq->close();
        if ($close_connect) {
            $conn->close();
        }
        return $deleted_rows;
    }

    /*
     *http://dev.mysql.com/doc/refman/5.1/zh/optimization.html#delete-speed
     * 如果想要删除一个表的所有行，使用TRUNCATE TABLE tbl_name 而不要用DELETE FROM tbl_name。
     * auto incresement id will restore to 1
     * */
    function truncateTb($tb_name, $close_connect = true) {
        $conn = $this->Qc;
        $Qq = $conn->query('TRUNCATE TABLE ' . $tb_name);
        $Qq->close();
        if ($close_connect) {
            $conn->close();
        }
    }


    /*
     * 使用HANDLER接口代替常规的SELECT语句有多个原因：
HANDLER语句提供通往表存储引擎接口的直接通道。HANDLER可以用于MyISAM和InnoDB表。
·         HANDLER比SELECT更快：

o        一个指定的存储引擎管理程序目标为了HANDLER...OPEN进行整序。该目标被重新用于该表的后续的HANDLER语句；不需要对每个语句进行重新初始化。

o        涉及的分析较少。

o        没有优化程序或查询校验开销。

o        在两个管理程序请求之间，不需要锁定表。

o        管理程序接口不需要提供外观一致的数据（例如，允许无条理的读取），所以存储引擎可以使用优化，而SELECT通常不允许使用优化。

·         有些应用程序使用与ISAM近似的接口与MySQL连接。使用HANDLER可以更容易地与这些应用程序连接。

·         HANDLER允许您采用一种特殊的方式进出数据库。而使用SELECT时难以采用（或不可能采用）这种方式。有些应用程序可以提供一个交互式的用户接口与数据库连接。当与这些应用程序同时使用时，用HANDLER接口观看数据更加自然。*/
    function handler($Qs) {

    }

    /*
     *  select list
     * @return array(array())
     * output virtual fields for SQL security

     */

    function select($Qs, $fields = false, $fields_arr_mapping = false, $close_connect = true) {
        $conn = $this->Qc;
        $Qq = $conn->query($Qs);
        // 不能在这里关闭 $Qq ，否则就无法输出任何值了

        if ($close_connect) {
            $conn->close();
        }

        if ($Qq) {
            if ($fields_arr_mapping) { // 输出虚拟的字段名，一定不为空
                return $this->virtualMultiArr($Qq, $fields, $fields_arr_mapping);
            }
            return $Qq;
        }
        return false;
    }

    /*
     *  select one and return $Qa array
     * @return array()
     * output virtual fields for SQL security
     */

    function selectOne($Qs, $fields = '*', $fields_arr_mapping = false, $close_connect = true) {
        $Qs .= ' LIMIT 1';
        // 避免混合 select union select ，所以用Qs
        // $Qs = 'SELECT ' . $fields . ' FROM ' . $tb . ' WHERE ' . $where . ' LIMIT 1';
        $conn = $this->Qc;
        $Qq = $conn->query($Qs);

        //http://zhidao.baidu.com/link?url=HacWDTi3Gm0loesrcI870S_lvsShqdGcbDxgmRLrJHghjQuD33-8XQsYlLmXTCzZdRt_5OQNSb1hJrQ33pFmaq
        // 即使数据库存储的是int，输出仍然是 string
        // fetch_assoc() 该函数返回的字段名是区分大小写的。
        if ($Qq) {
            $Qa = $Qq->fetch_assoc();

            if ($fields_arr_mapping && $Qa) { // 输出虚拟的字段名，一定不为空
                $fields_arr = str_replace(' ', '', $fields); // Remove the spaces inside
                $fields_arr = $fields_arr != '*' ? explode(',', $fields_arr) : array_flip($fields_arr_mapping);

                return $this->virtualSingleArr($Qa, $fields_arr, $fields_arr_mapping);
            }
            return $Qa;
        }
        return false;


    }


    function countRows($Qs, $close_connect = true) {
        $conn = $this->Qc;
        $Qq = $conn->query($Qs);

        //echo $conn->error;
        $Qr = $Qq->fetch_row();

        $Qq->close();
        if ($close_connect) {
            $conn->close();
        }
        // MySQL 传来的都是string
        return (int)$Qr[0];
    }


    /*
     * update that must update one
     *  return how many rows had be updated
     * @suggest : use  limit 1 ast better for update in $Qs
     * */
    function update($Qs, $close_connect = true) {
        // prepare 用于 stmt 数据库操作更好
        $conn = $this->Qc;
        $Qq = $conn->query($Qs);

        $updated = $conn->affected_rows;


        //$Qq->close();
        if ($close_connect) {
            $conn->close();
        }

        return $updated;
    }

    /*
     * http://dev.mysql.com/doc/refman/5.1/zh/sql-syntax.html#replace
     *
     * 无法返回插入的id
     *
     * REPLACE的运行与INSERT很相像。只有一点除外，如果表中的一个旧记录与一个用于PRIMARY KEY或一个UNIQUE索引的新记录具有相同的值，则在新记录被插入之前，旧记录被删除。
     *注意，除非表有一个PRIMARY KEY或UNIQUE索引，否则，使用一个REPLACE语句没有意义。该语句会与INSERT相同，因为没有索引被用于确定是否新行复制了其它的行。
     * 所有列的值均取自在REPLACE语句中被指定的值。所有缺失的列被设置为各自的默认值，这和INSERT一样。
     * 您不能从当前行中引用值，也不能在新行中使用值。
     * 如果您使用一个例如“SET col_name = col_name + 1”的赋值，则对位于右侧的列名称的引用会被作为DEFAULT(col_name)处理。
     * 因此，该赋值相当于SET col_name = DEFAULT(col_name) + 1。

为了能够使用REPLACE，您必须同时拥有表的INSERT和DELETE权限。

     * REPLACE [LOW_PRIORITY | DELAYED]
    [INTO] tbl_name [(col_name,...)]
    VALUES ({expr | DEFAULT},...),(...),...
或：

REPLACE [LOW_PRIORITY | DELAYED]
    [INTO] tbl_name
    SET col_name={expr | DEFAULT}, ...
或：

REPLACE [LOW_PRIORITY | DELAYED]
    [INTO] tbl_name [(col_name,...)]
    SELECT ...
     * */
    function replaceInto($Qs) {
        $conn = $this->Qc;
        $Qq = $conn->query($Qs);

        if ($close_connect) {
            $conn->close();
        }
        return $Qq;
    }

    /*
     * insert
     *      INSERT INTO tb (a,b,c) VALUES (1,2,3) ON DUPLICATE KEY UPDATE c=c+1;
     *      INSERT INTO tb SELECT tb2.field_id FROM tb2 WHERE tb2.field_id >3  ==> insert multi-rows
     * INSERT [LOW_PRIORITY | DELAYED | HIGH_PRIORITY] [IGNORE]
    [INTO] tbl_name [(col_name,...)]
    VALUES ({expr | DEFAULT},...),(...),...
    [ ON DUPLICATE KEY UPDATE col_name=expr, ... ]
或：

INSERT [LOW_PRIORITY | DELAYED | HIGH_PRIORITY] [IGNORE]
    [INTO] tbl_name
    SET col_name={expr | DEFAULT}, ...
    [ ON DUPLICATE KEY UPDATE col_name=expr, ... ]
或：

INSERT [LOW_PRIORITY | HIGH_PRIORITY] [IGNORE]
    [INTO] tbl_name [(col_name,...)]
    SELECT ...
    [ ON DUPLICATE KEY UPDATE col_name=expr, ... ]
     * */
    function insert($Qs, $return_insert_id = false, $close_connect = true) { // 返回插入的自增id或者 插入了几行
        $conn = $this->Qc;
        $conn->query($Qs);
        //echo $conn->error;
        // insert_id 返回AUTO_INCREMENT的ID，所以一定是数字
        $is_success = $return_insert_id ? $conn->insert_id : $conn->affected_rows;

        //$Qq->close();
        if ($close_connect) {
            $conn->close();
        }


        return $is_success;
    }


    /*
     * select or insert one, to get the auto incresment primary key id
     * */

    function getUniqueIdBySelectInsert($tb, $query_field, $query_value, $get_field) {
        if (empty($query_value)) {
            return null;
        }


        $set_str = $query_field . ' = ';
        $set_str .= is_string($query_value) ? ('"' . $query_value . '"') : $query_value;

        /*
        这里不能将 conn 关闭了
        */
        $Qa = $this->selectToQaFromWhere($tb, $set_str, $get_field, false, false); // auto close conn

        if ($Qa) {
            return $Qa[$get_field];
        }
        // 没有找到，就插入，这里device设为了唯一性，所以防止了并发

        $Qs = 'INSERT INTO ' . $tb . ' SET ' . $set_str;

        return $this->insert($Qs, true);
    }


    /*
     * 不同于上面，这里不是对 key ==> 用 RPELACE 替换
     * */
    function updateInsert($write_account, $table, $set_str, $where_no_auto_increment_key, $auto_increment_key = false, $auto_increment_key_value = 0) {
        /*
        UPDATE i_resume_career SET a=100 WHERE careerid=7 AND u="中国"
        INSERT INTO i_resume_career SET a=100, u="中国"  【判断是不是自增id】
            UniqueUpIn($write_account, $table, 'a=100',  'u="中国"', 'careerid' 7);   返回 7
            UniqueUpIn($write_account, $table, 'a=100',  'u="中国"', 'careerid' 0);   返回 7
        INSERT INTO i_resume_career SET a=100, u="中国"
        UPDATE i_resume_career SET a=100 WHERE u="中国"
            UniqueUpIn($write_account, $table, 'a=100',  'u="中国"');
        */
        $this->setConnect($write_account);

        $Qs_update = 'UPDATE ' . $table . ' SET ' . $set_str;
        $Qs_update .= ' WHERE ' . ($auto_increment_key ? ($auto_increment_key . '= ' . $auto_increment_key_value . ' AND ') : '') . $where_no_auto_increment_key;

        // $auto_increment_key_str 用于避免 Update传递相同值，没有执行成功，重复插入

        //if($auto_increment_key_value<1 && ($auto_increment_key || !$this->Update($Qs_update, false) )) 不能这样，否则当插入带有id的，将永远无法执行 Update，必须把 !update 放在前面
        if (!$this->Update($Qs_update, false) && $auto_increment_key_value < 1) {

            $Qs_insert = 'INSERT INTO ' . $table . ' SET ' . $where_no_auto_increment_key . ', ' . $set_str;
            //echo $Qs_insert;
            if ($auto_increment_key) {
                return $this->InsertSet($Qs_insert, true); // 返回自增插入的id
            }
            else {
                $this->InsertSet($Qs_insert);
            }
        }
        return $auto_increment_key ? $auto_increment_key_value : true; // 使用带有 auto_increment_key 的，成功后，返回之前的id，如果不是auto key 的，就返回update 正确
    }


    /* 事务
    无法返回 自增id
    */
    function transaction($Qs_arr_not_return, $Qs_return = false, $close_connect = true) {
        $conn = $this->Qc;
        $conn->autocommit(false); // 设置为非自动提交——事务处理
        $Qq_success = true;
        foreach ($Qs_arr_not_return as $Qs) {
            $Qq = $conn->query($Qs);
            //echo $conn->error;
            if (!$Qq) {
                $Qq_success = false;
                break;
            }
        }
        if ($Qq_success) {
            if ($Qs_return) {
                $rtn = $conn->query($Qs_return); // 返回的是Qq
                if ($rtn) {
                    $conn->commit();
                }
                else {
                    $rtn = $conn->rollback();
                }
            }
            else {
                $rtn = $conn->commit();
            }
        }
        else {
            $rtn = $conn->rollback();
        }
        $conn->autocommit(true);
        if ($close_connect) {
            $conn->close();
        }
        return $rtn;
    }

    function FilterContactInfo($str) { // 过滤手机号码、QQ号、邮箱、地址
        $str = preg_replace('/(Q|Ｑ|扣扣|企鹅|扣|联系|手机|电话|号)+[：[:punct:]一二三四五六七八九零壹贰叁肆伍陆柒捌玖\d１２３４５６７８９０①②③⑤]+/i', '', $str);
        // 过滤网址、邮箱
        $str = preg_replace('/(网址|邮箱)*[\:：]*[a-z]*\@?[a-z\-]+([\.\。][a-z]+)+/i', '', $str);

        return $str;
    }

    // 只能匹配 【非空】 md(5)后的密码、用户名（含中文）、邮箱、手机号，字符串长度小于32
    // 过滤特殊字符    '  "  \ ，标题、简洁都是允许有空格的，而且空格不涉及安全
    // Filter直接设置成静态，这要保证传递进来的字符串长度并不大，最长只能varchar255==> descrition，而text不能用到Filter
    static function Filter($str) { // 一般过滤 【' " \ < >】，需要用到  \\\ 来表示  \
        if (preg_match('/[\'\"\\\<>]/', $str)) {
            exit();
        }
        return $str;
    }

    function FilterTitleDescription($str) { // 过滤标题
        self::Filter($str);
        return $this->FilterContactInfo($str);
    }

    function FilterText($str) { // 转义双引号、
        //对表单传递的字符需要不需要进行addslashes()需要先看看php.ini有没有开启magic_quotes_gpc，如果已经开启了，就不需要使用，PHP会自动addslashes()。【' " \ \0 】
        // 如果用于插入数据库，就需要对"转义，如果是重新post出去，就不能，就需要用stripslashes() 对默认转义反解
        // 适用各个 PHP 版本的用法

        /* 禁止【"<>\】 允许双引号 " ，单引号内转义，需要用到  \\\ 来表示  \ */
        if (preg_match('/[\'\\\<>]/', $str)) {
            exit();
        }
        if (!get_magic_quotes_gpc()) {
            $str = addslashes($str);
        }
        return $str;
    }


}