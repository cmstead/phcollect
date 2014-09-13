<?php

require_once("../src/PhCollectionInterface.php");
require_once("../src/PhTuple.php");
require_once("../src/PhList.php");

class PhListTests extends PHPUnit_Framework_TestCase{

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

    public function testPhListIsInstantiableWithASingleValue(){
        $testList = new PhList("test value 1");
        $this->assertEquals($testList->length(), 1);
    }
    
    public function testPhListIsInstantiableWithMultipleValues(){
        $testList = new PhList("1", "2", "3");
        $this->assertEquals($testList->length(), 3);
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
    
    public function testPopReturnsLastElementOfList(){
        $testList = new PhList(1, 2, 3, 4);
        
        $this->assertEquals($testList->pop(), 4);
    }
    
    public function testPopRemovesLastElementOfList(){
        $testList = new PhList(1, 2, 3, 4);
        $testList->pop();
        
        //These asserts verify that the element int 4 was correctly removed
        $this->assertEquals($testList->last(), 3);
        $this->assertEquals($testList->length(), 3);
    }
    
    public function testShiftReturnsFirstElementOfList(){
        $testList = new PhList(1, 2, 3, 4);
        $this->assertEquals($testList->shift(), 1);
    }
    
    public function testShiftRemovesFirstElementOfList(){
        $testList = new PhList(1, 2, 3, 4);
        $testList->shift();
        
        $this->assertEquals($testList->first(), 2);
        $this->assertEquals($testList->length(), 3);
    }
    
    public function testSliceReturnsNewListInstance(){
        $testList = new PhList(1, 2, 3, 4);
        $newList = $testList->slice(1);
        $this->assertEquals(get_class($newList), "PhList");
    }
    
    public function testSliceReturnsListSlicedAtOffset(){
        $testList = new PhList(1, 2, 3, 4);
        $newList = $testList->slice(1);
        
        $this->assertEquals($newList->first(), 2);
        $this->assertEquals($newList->length(), 3);
    }
    
    public function testSliceReturnsListSliceThatEndsAtLength(){
        $testList = new PhList(1, 2, 3, 4);
        $newList = $testList->slice(1, 2);
        
        $this->assertEquals($newList->first(), 2);
        $this->assertEquals($newList->last(), 3);
    }
    
    public function testSortSortsAList(){
        $testList = new PhList(2, 5, 1, 9, 6, 4);
        $expectedSet = array(1, 2, 4, 5, 6, 9);

        $testList->sort();
        $this->assertEquals($testList->toArray(), $expectedSet);
    }

    public function testSortSortsAListWithAPassedComparator(){
        $testList = new PhList(2, 9, 1, 5, 6, 4);
        $expectedSet = array(2, 4, 6, 1, 5, 9);

        $testList->sort(function($a, $b){
            $direction = 0;

            if($a % 2 == 0 && $b % 2 != 0){
                $direction = -1;
            } else if($a % 2 != 0 && $b % 2 == 0){
                $direction = 1;
            }

            if($direction == 0 && $a > $b){
                $direction = 1;
            } else if($direction == 0 && $a < $b){
                $direction = -1;
            }

            return $direction;
        });

        $this->assertEquals($testList->toArray(), $expectedSet);
    }
    
    public function testPhListActionsAreChainable(){
        $testList = new PhList(4, 2, 1, 3);
        $finalOutput = $testList->sort()
                                ->push(5)
                                ->slice(1, 3)
                                ->rest()
                                ->last();
        $this->assertEquals($finalOutput, 4);
    }

}

?>