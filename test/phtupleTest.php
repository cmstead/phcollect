<?php

require_once("../src/PhCollectionInterface.php");
require_once("../src/PhTuple.php");

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

}

?>