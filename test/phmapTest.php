<?php

require_once("../src/PhCollectionInterface.php");
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

    /*public function testPhListIsInstantiableWithASingleValue(){
        $testMap = new PhList("test value 1");
        $this->assertEquals($testMap->length(), 1);
    }*/

    /*public function testPhListIsInstantiableWithMultipleValues(){
        $testMap = new PhMap("1", "2", "3");
        $this->assertEquals($testMap->length(), 3);
    }*/

}

?>