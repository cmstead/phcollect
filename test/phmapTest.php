<?php

require_once("../src/PhCollectionInterface.php");
require_once("../src/PhCollect.php");
require_once("../src/PhTuple.php");
require_once("../src/PhMap.php");

class PhMapTests extends PHPUnit_Framework_TestCase{

    public function testPhMapIsInstantiable(){
        $errorThrown = false;

        try{
            new PhMap();
        } catch (Exception $e) {
            $errorThrown = true;
        }

        $this->assertEquals($errorThrown, false);
    }

    public function testPhListIsInstantiableWithASingleValue(){
        $testMap = new PhMap(
            PHC::phtuple("test", "value")
        );
        $this->assertEquals($testMap->length(), 1);
    }

    public function testPhListIsInstantiableWithMultipleValues(){
        $testMap = new PhMap(
            PHC::phtuple("test1", "value1"),
            PHC::phtuple("test2", "value2"),
            PHC::phtuple("test3", "value3")
        );
        $this->assertEquals(3, $testMap->length());
    }

}

?>