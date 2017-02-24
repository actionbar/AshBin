<?php


namespace C\Cache;


class Memcache implements \ArrayAccess{
    private $Qc;
    public $exp_time_in_sec = 0;  //expiration in seconds, default is 0, which means it's never expires
    public static $destoryDelaySec = 0; // do destory delay in Secs
    public static $compressed = 0;
    

    public function conn($host = '127.0.0.1', $port = 11211){
        $this->Qc = new \Memcache();
        return $this->Qc->connect($host, $port);
    }
    
    public function offsetExists($offset){
        return isset($this->$Qc->get($offset));
    }

    public function offsetSet($offset, $value){
        return $this->Qc->set($offset, $value, self::$compressed, $this->exp_time_in_sec);
    }

    public function offsetGet($offset){
        return $this->Qc->get($offset);
    }

    public function offsetUnset($offset){
        return $this->Qc->delete($offset);
    }

    /*
     *
     * Memcached::flush()立即（默认）或者在delay延迟后作废所有缓存中已经存在的元素。 在作废之后检索命令将不会有任何返回（除非在执行Memcached::flush()作废之后，该key下被重新存储过）。flush不会 真正的释放已有元素的内存， 而是逐渐的存入新元素重用那些内存。
     * */
    public function destroy(){
        return $this->Qc->flush(self::$destoryDelaySec);
    }


}