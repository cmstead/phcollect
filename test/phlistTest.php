<?php

require_once("../src/phlist.php");

class PhlistTests extends PHPUnit_Framework_TestCase{

    public function testPhListIsInstantiable(){
        $errorThrown = false;

        try{
            new PhList();
        } catch (Exception $e) {
            $errorThrown = true;
        }

        $this->assertEquals($errorThrown, false);
    }

    public function testPhListInstanceHasToArrayMethod(){
        $testList = new PhList();

        $this->assertEquals(method_exists($testList, "toArray"), true);
    }

    public function testToArrayReturnsAnArray(){
        $testList = new PhList();
        $returnedValue = $testList->toArray();

        $this->assertEquals(gettype($returnedValue), "array");
    }

}

?>