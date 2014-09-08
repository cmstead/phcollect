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
    
    public function testFirstGetsFirstValueOfList(){
        $testList = new PhList(1, 2, 3, 4);
        $this->assertEquals($testList->first(), 1);
    }
    
    public function testFirstReturnsNullIfNoFirstValue(){
        $testList = new PhList();
        $this->assertEquals($testList->first(), null);
    }
    
    public function testLastGetsLastValueOfList(){
        $testList = new PhList(1, 2, 3, 4);
        $this->assertEquals($testList->last(), 4);
    }
    
    public function testLastReturnsNullIfArrayIsEmpty(){
        $testList = new PhList();
        $this->assertEquals($testList->last(), null);
    }
    
    public function testLengthReturnsCountOfListElements(){
        $testList = new PhList(1, 2, 3, 4);
        $this->assertEquals($testList->length(), 4);
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
    
    public function testRestReturnsNewListInstance(){
        $testList = new PhList(1, 2, 3, 4);
        $newList = $testList->rest();
        $this->assertEquals(get_class($newList), "PhList");
    }
    
    public function testRestReturnsListWithoutFirstElement(){
        $testList = new PhList(1, 2, 3, 4);
        $newList = $testList->rest();
        $this->assertEquals($newList->first(), 2);
        $this->assertEquals($newList->length(), 3);
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
    
    public function testGetReturnsValueAtIndex(){
        $testList = new PhList(1, 2, 3, 4);
        $this->assertEquals($testList->get(2), 3);
    }
    
    public function testGetReturnsNullIfIndexIsNotDefined(){
        $testList = new PhList(1, 2, 3, 4);
        $this->assertEquals($testList->get(5), null);
    }
    
    public function testPhListActionsAreChainable(){
        $testList = new PhList(1, 2, 3, 4);
        $finalOutput = $testList->slice(1, 2)->rest()->last();
        $this->assertEquals($finalOutput, 3);
    }

}

?>