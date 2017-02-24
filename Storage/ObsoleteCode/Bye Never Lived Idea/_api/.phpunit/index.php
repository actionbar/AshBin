<?php
require '../c_tf.php';

class Index extends PHPUnit_Framework_TestCase
{
    public function testRandGenNum(){
        $Rand = new \C\Rand();
        $rand_int = $Rand->genNum(4);
        $len = strlen($rand_int);
        $this->assertEquals(4, $len);
    }

} 