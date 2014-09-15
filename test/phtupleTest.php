<?php

$localDirectory = dirname(__FILE__);
require_once($localDirectory . "/../src/phcollect.php");

class PhTupleTest extends PHPUnit_Framework_TestCase{

    public function testTupleIsInstantiable(){
        $exceptionThrown = false;

        try{
            new PhTuple();
        } catch (Exception $e){
            $exceptionThrown = true;
        }

        $this->assertEquals(false, $exceptionThrown);
    }

    public function testTupleIsInstantiableWithOneArgument(){
        $testTuple = new PhTuple(1);
        $this->assertEquals(1, $testTuple->length());
    }

    public function testFirstGetsFirstValueOfList(){
        $testTuple = new PhTuple(1, 2, 3, 4);
        $this->assertEquals($testTuple->first(), 1);
    }

    public function testFirstReturnsNullIfNoFirstValue(){
        $testTuple = new PhTuple();
        $this->assertEquals($testTuple->first(), null);
    }

    public function testLastGetsLastValueOfList(){
        $testTuple = new PhTuple(1, 2, 3, 4);
        $this->assertEquals($testTuple->last(), 4);
    }

    public function testLastReturnsNullIfArrayIsEmpty(){
        $testTuple = new PhTuple();
        $this->assertEquals($testTuple->last(), null);
    }

    public function testRestReturnsNewListInstance(){
        $testTuple = new PhTuple(1, 2, 3, 4);
        $newList = $testTuple->rest();
        $this->assertEquals(get_class($newList), "PhTuple");
    }

    public function testRestReturnsListWithoutFirstElement(){
        $testTuple = new PhTuple(1, 2, 3, 4);
        $newList = $testTuple->rest();
        $this->assertEquals($newList->first(), 2);
        $this->assertEquals($newList->length(), 3);
    }

    public function testFoldReturnsNullIfCollectionIsEmpty(){
        $testTuple = new PhTuple();
        $returnedValue = $testTuple->fold(function(){});

        $this->assertEquals(null, $returnedValue);
    }

    public function testFoldPerformsUserOperationOnTwoElementCollection(){
        $testTuple = new PhTuple(1, 2);
        $returnedValue = $testTuple->fold(function($oldResult, $nextValue){
            return $oldResult * $nextValue;
        });

        $this->assertEquals(2, $returnedValue);
    }

    public function testFoldPerformsUserOperationOnNElements(){
        $testTuple = new PhTuple(1, 2, 3, 4);
        $result = $testTuple->fold(function($operand1, $operand2){
            return $operand1 * $operand2;
        });

        $this->assertEquals(24, $result);
    }

}

?>