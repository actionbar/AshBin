<?php
namespace C\Db;

/*
 * http://dev.mysql.com/doc/refman/5.1/zh/sql-syntax.html
 * $Qq query query
 * $Qa query a
 * $Qc  == connect
 * $Qs  query string
 * db  tb  field
 */


class MySqli extends \C\AbstractInterface\DbAb{
    public $connUser;
    public $connPwd;
    public $Db;

    /*
     * utf8 的执行效率低于latin 1，如果系统默认设置的不是utf8,那么查询中文会出现问题
     * 这里默认 charset = utf8，为了性能，请连接的时候，判断是否是纯英文，如果是纯英文，就用 labin1
     *
     * 由于分布式数据库的话，那么 $host 会有多种可能
     * */

    public function conn($host, $port = 3360){
        // 系统类，如mysqli 如果出现在 namespace中，引用的时候必须要在前面加 new \mysqli() 否则会报错
        $this->Qc = new \mysqli($host, $this->connUser, $this->connPwd, $this->Db);
        $this->Qc->set_charset(self::$charset);

        if(mysqli_connect_errno()){
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function existsVal($tb, $cond){
        $Qs = 'SELECT EXISTS(SELECT 1 FROM ' . $tb . ' WHERE ' . $cond . ' LIMIT 1)';
        return $this->queryVal($Qs);
    }

    public function query($Qs){
        $Qq = $this->Qc->query($Qs);
        /* http://zhidao.baidu.com/link?url=HacWDTi3Gm0loesrcI870S_lvsShqdGcbDxgmRLrJHghjQuD33-8XQsYlLmXTCzZdRt_5OQNSb1hJrQ33pFmaq
         即使数据库存储的是int，输出仍然是 string
         fetch_assoc() 该函数返回的字段名是区分大小写的。*/
        return $Qq;
    }

    public function queryOne($Qs){
        $select_multi = $this->Qc->query($Qs);
        return $select_multi ? $select_multi->fetch_assoc() : null;
    }

    public function queryVal($Qs){
        $select_multi = $this->Qc->query($Qs);
        return $select_multi ? $select_multi->fetch_array()[0] : null;
    }


    public function queryCount($Qs){
        $Qq = $this->Qc->query($Qs);

        //echo $conn->error;
        $Qr = $Qq->fetch_row();

        // MySQL 传来的都是string
        return (int)$Qr[0];
    }

    /*
       * update that must update one
       *  return how many rows had be updated
       * @suggest : use  limit 1 ast better for update in $Qs
       * */
    public function exec($Qs){
        $Qq = $this->Qc->query($Qs);
        return (int)$this->Qc->affected_rows;
    }

    public function execId($Qs){
        $Qq = $this->Qc->query($Qs);
        //echo $Qs , '<br>', $this->Qc->error ,'<br>';
        // insert_id 返回AUTO_INCREMENT的ID，所以一定是数字
        return (int)$this->Qc->insert_id;
    }

    public function close(){

    }

}