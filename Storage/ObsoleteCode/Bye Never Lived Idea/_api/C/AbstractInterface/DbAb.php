<?php
namespace C\AbstractInterface;



/*
 * 一般情况下都用接口,如果学过java设计模式的话可以看到适配器模式，这里面为什么会把很多的父类设定为抽象类，因为抽象类中的方法你可以做空实现处理，如果一个子类直接继承了你这个父类，其实我只是要用你里面的一个方法，如果做成接口的话，我必须每个方法都要去实现，但是抽象类的话，你只需要去覆盖你需要的方法即可。
 * 当你关注一个事物的本质的时候，用抽象类；当你关注一个操作的时候，用接口。
 * */


abstract class DbAb{
    private $Qc;
    public static $charset = 'utf8';

    /*
     * 所有db基本都用同一种连接方式，如 MySQLi  ->query  以及  PDO的 excute
     *
     * CRUD = create read update/insert delete
     *
     * Qs = query_string
     *
     * 类似 memcached 都不需要验证密码，默认只允许本地连接，可以通过设置连接ip实现远程访问，减少了传输密码的性能问题
     *
     **/

    abstract public function conn($host, $port);

    /*
 * 判断一个表里面的条件是否存在
 * $query_string = 'SELECT EXISTS(SELECT 1 FROM ' . $tb . ' WHERE ' . $cond . 'LIMIT 1)';
    return $this->selectVal($query_string);
 **/
    abstract public function existsVal($tb, $cond);



    /*
     * PDO和MySQLi默认方法，记录有返回值的，一般用于 select
     **/
    abstract public function query($Qs);

    /*
     * $Qa = $Qq->fetch_assoc();
     **/
    abstract public function queryOne($Qs);

    /*
     * 只查询获取一个字段，直接返回这个字段的值
     * $val = $Qq->fetch_array()[0];
     */
    abstract public function queryVal($Qs);





    /*
     *@return int
     **/
    abstract public function queryCount($Qs);


    /*
   * PDO的默认方法，返回的是影响的行数,用来执行有影响行数的，update, delete insert, other
   * affected_rows
     * $return int
   **/
    abstract public function exec($Qs);

    /*
     * insert_id
     * @return int
     **/
    abstract public function execId($Qs);

    abstract public function close();
}