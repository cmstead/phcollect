<?php

$localDirectory = dirname(__FILE__);
require_once($localDirectory . "/../src/phcollect.php");

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

    public function testPhListHasAddMethod(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(true, method_exists($testList, "add"));
    }

    public function testPhListAddMethodInsertsValue(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $testList->add(2, 9);

        $this->assertEquals(9, $testList->nth(2));
    }

    public function testPhListHasContainsMethod(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(true, method_exists($testList, "contains"));
    }

    public function testPhListHasClearMethod(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(true, method_exists($testList, "clear"));
    }

    public function testPhListClearEmptiesList(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $testList->clear();

        $this->assertEquals(0, $testList->length());
    }

    public function testPhListContainsReturnsTrueIfValueExists(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(true, $testList->contains(3));
    }

    public function testPhListContainsReturnsFalseIfValueDoesNotExist(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(false, $testList->contains(6));
    }

    public function testPhListHasDeleteMethod(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(true, method_exists($testList, "delete"));
    }

    public function testPhListDeleteRemovesCorrectValue(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $testList->delete(2);

        $this->assertEquals(4, $testList->nth(2));
    }

    public function testPhListHasIndexOfMethod(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(true, method_exists($testList, "indexOf"));
    }

    public function testPhListIndexOfReturnsIndexOfExistingElement(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(1, $testList->indexOf(2));
    }

    public function testPhListIndexOfReturnsFalseIfElementDoesNotExist(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(false, $testList->indexOf(6));
    }

    public function testPhListHasIsEmptyMethod(){
        $testList = new PhList();

        $this->assertEquals(true, method_exists($testList, "isEmpty"));
    }

    public function testPhListIsEmptyReturnsTrueIfListIsEmpty(){
        $testList = new PhList();

        $this->assertEquals(true, $testList->isEmpty());
    }

    public function testPhListIsEmptyReturnsFalsIfListIsNotEmpty(){
        $testList = new PhList(1, 2, 3, 4, 5);

        $this->assertEquals(false, $testList->isEmpty());
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

            if($a % 2 === 0 && $b % 2 !== 0){
                $direction = -1;
            } else if($a % 2 !== 0 && $b % 2 === 0){
                $direction = 1;
            }

            if($direction === 0 && $a > $b){
                $direction = 1;
            } else if($direction === 0 && $a < $b){
                $direction = -1;
            }

            return $direction;
        });

        $this->assertEquals($testList->toArray(), $expectedSet);
    }

    public function testUnionReturnsAList(){
        $testList = new PhList(1, 2, 3);
        $returnedValue = $testList->union();

        $this->assertEquals("PhList", get_class($returnedValue));
    }

    public function testUnionReturnsUnionOfListAndArrays(){
        $testList = new PhList(1, 2, 3);
        $returnedValue = $testList->union(array(2, 3, 4), array(5, 1, 3));

        $this->assertEquals("1, 2, 3, 4, 5", implode(", ", $returnedValue->toArray()));
    }

    public function testUnionAcceptsLists(){
        $testList = new PhList(1, 2, 3);
        $list1 = new PhList(2, 3, 4);
        $list2 = new PhList(5, 3, 1);

        $result = $testList->union($list1, $list2);

        $this->assertEquals("1, 2, 3, 4, 5", implode(", ", $result->toArray()));
    }

    public function testIntersectReturnsAList(){
        $testList = new PhList(1, 2, 3);
        $returnedValue = $testList->intersect();

        $this->assertEquals("PhList", get_class($returnedValue));
    }

    public function testIntersectReturnsIntersectionOfListAndArrays(){
        $testList = new PhList(1, 2, 3);
        $returnedValue = $testList->intersect(array(2, 3, 4), array(5, 1, 3));

        $this->assertEquals("3", implode(", ", $returnedValue->toArray()));
    }

    public function testUIntersectAcceptsLists(){
        $testList = new PhList(1, 2, 3);
        $list1 = new PhList(2, 3, 4);
        $list2 = new PhList(5, 3, 1);

        $result = $testList->intersect($list1, $list2);

        $this->assertEquals("3", implode(", ", $result->toArray()));
    }

    public function testPhListActionsAreChainable(){
        $testList = new PhList(4, 2, 1, 3);
        $finalOutput = $testList->sort()
                                ->map(function($value){
                                    return $value * 5;
                                })
                                ->push(5)
                                ->slice(1, 3)
                                ->rest()
                                ->last();
        $this->assertEquals($finalOutput, 20);
    }

}

?>