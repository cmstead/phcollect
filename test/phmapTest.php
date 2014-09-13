<?php

$localDirectory = dirname(__FILE__);
require_once($localDirectory . "/../src/PhCollect.php");

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

    public function testPhMapIsInstantiableWithASingleValue(){
        $testMap = new PhMap(
            PHC::phtuple("test", "value")
        );
        $this->assertEquals($testMap->length(), 1);
    }

    public function testPhMapIsInstantiableWithMultipleValues(){
        $testMap = new PhMap(
            PHC::phtuple("test1", "value1"),
            PHC::phtuple("test2", "value2"),
            PHC::phtuple("test3", "value3")
        );
        $this->assertEquals(3, $testMap->length());
    }

    public function testPhMapCanSetANewValue(){
        $testMap = new PhMap(
            PHC::phtuple("test", "value")
        );

        $testMap->set(PHC::phtuple("test1", "value1"));

        $this->assertEquals(2, $testMap->length());
    }

    public function testPhMapSetCanUpdateAValue(){
        $testMap = new PhMap(
            PHC::phtuple("test", "test")
        );

        $testMap->set(PHC::phtuple("test", "value"));

        $this->assertEquals("value", $testMap->get("test"));
    }

}

?>