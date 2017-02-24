<?php


namespace Conf;


class Memcache {
    private static $host = '127.0.0.1';
    private static $port = 11211;
    final public static function countSignInTimes(){
        $CMemcache = new \C\Cache\Memcache();
        $CMemcache->conn(self::$host, self::$port);
        return $CMemcache;
    }

} 