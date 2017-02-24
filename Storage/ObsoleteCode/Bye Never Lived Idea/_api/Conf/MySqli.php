<?php
namespace Conf;


class MySqli{
    private static $host = 'localhost';
    private static $port = 3306;

    final public static function readSso(){
        $DbMySqli = new \C\Db\MySqli();
        $DbMySqli->connUser = 'root';
        $DbMySqli->connPwd = 'root';
        $DbMySqli->Db = 'table_name';
        $DbMySqli->conn(self::$host, self::$port);
        return $DbMySqli;
    }

    final public static function writeSso(){
        $DbMySqli = new \C\Db\MySqli();
        $DbMySqli->connUser = 'root';
        $DbMySqli->connPwd = 'root';
        $DbMySqli->Db = 'table_name';
        $DbMySqli->conn(self::$host, self::$port);
        return $DbMySqli;
    }


    final public static function readTask(){
        $DbMySqli = new \C\Db\MySqli();
        $DbMySqli->connUser = 'root';
        $DbMySqli->connPwd = 'root';
        $DbMySqli->Db = 'table_name';
        $DbMySqli->conn(self::$host, self::$port);
        return $DbMySqli;
    }

    final public static function writeTask(){
        $DbMySqli = new \C\Db\MySqli();
        $DbMySqli->connUser = 'root';
        $DbMySqli->connPwd = 'root';
        $DbMySqli->Db = 'table_name';
        $DbMySqli->conn(self::$host, self::$port);
        return $DbMySqli;
    }
}