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
    
    public function testPhListIsInstantiableWithASingleValue(){
        $testList = new PhList("test value 1");
        $this->assertEquals(sizeof($testList->toArray()), 1);
    }
    
    public function testPhListIsInstantiableWithMultipleValues(){
        $testList = new PhList("1", "2", "3");
        $this->assertEquals(sizeof($testList->toArray()), 3);
    }
    
    public function testLastGetsLastValueOfList(){
        $testList = new PhList(1, 2, 3, 4);
        $this->assertEquals($testList->last(), 4);
    }
    
    public function testPushAddsValueToEndOfList(){
        $testList = new PhList(1, 2);
        $testList->push(3);
        
        $this->assertEquals($testList->last(), 3);
    }
    
    public function testPushThrowsErrorIfNoValueIsProvided(){
        $testList = new PhList(1, 2);
        $exceptionThrown = false;
        
        try{
            $testList->push();
        } catch (Exception $e){
            $exceptionThrown = true;
        }
        
        $this->assertEquals($exceptionThrown, true);
    }

}

?>