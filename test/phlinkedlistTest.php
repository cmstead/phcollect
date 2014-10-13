<?php

$localDirectory = dirname(__FILE__);
require_once($localDirectory . "/../src/phcollect.php");

class PhLinkedListTest extends PHPUnit_Framework_TestCase{

    public function testPhLinkedListIsInstantiable(){
        $errorThrown = false;

        try{
            new PhLinkedList();
        } catch (Exception $e){
            $errorThrown = true;
        }

        $this->assertEquals(false, $errorThrown);

    }

    public function testPhLinkedListImplementsCollectionInterface(){
        $testList = new PhLinkedList();

        $this->assertEquals(true, $testList instanceof PhCollectionInterface);
    }

    public function testGetListReturnsALinkedList(){
        $testList = new PhLinkedList("Item 1");
        $linkedList = $testList->getList();

        $this->assertEquals(true, $linkedList instanceof PhListItem);
    }

    public function testGetListReturnsLinkedListRoot(){
        $testList = new PhLinkedList("Item 1", "Item 2");
        $linkedList = $testList->getList();

        $this->assertEquals(null, $linkedList->getPrevious());
    }

    public function testConstructorCreatesListFromValues(){
        $testList = new PhLinkedList("Item 1", "Item 2");
        $linkedList = $testList->getList();
        $listValues = array();

        array_push($listValues, $linkedList->getValue());
        array_push($listValues, $linkedList->getNext()->getValue());

        $this->assertEquals("Item 1, Item 2", implode(", ", $listValues));
    }

    public function testAddInsertsItemAtCurrentLocation(){
        $testList = new PhLinkedList("Item 1", "Item 2");
        $testList->add("Item 3");
        $addedItem = $testList->getList()->getNext()->getNext();

        $this->assertEquals("Item 3", $addedItem->getValue());
    }

    public function testAddMovesToInsertedItem(){
        $testList = new PhLinkedList("Item 1", "Item 2");
        $testList->add("Item 3");

        $this->assertEquals("Item 3", $testList->getCurrent());
    }

    public function testAddSetsRootIfNoRootIsDefined(){
        $testList = new PhLinkedList();
        $testList->add("Item 1");

        $this->assertNotEquals(null, $testList->getList());
    }

    public function testGetReturnsItemAtFirstPosition(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $returnedValue = $testList->get(0);

        $this->assertEquals("Item 1", $returnedValue);
    }

    public function testGetReturnsSecondItem(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $returnedValue = $testList->get(1);

        $this->assertEquals("Item 2", $returnedValue);
    }

    public function testGetCurrentReturnsCurrentValue(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $testList->get(1);

        $this->assertEquals("Item 2", $testList->getCurrent());
    }

    public function testLengthReturnsCurrentListLength(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");

        $this->assertEquals(3, $testList->length());
    }

    public function testDeleteRemovesCurrentElement(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $testList->get(1);
        $testList->delete();

        $this->assertEquals(2, $testList->length());
    }

    public function testDeleteSetsCurrentToPreviousElement(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $testList->get(1);
        $testList->delete();

        $this->assertEquals("Item 1", $testList->getCurrent());
    }

    public function testDeleteSetsCurrentToNextIfCurrentIsRoot(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $testList->get(0);
        $testList->delete();

        $this->assertEquals("Item 2", $testList->getCurrent());
    }

    public function testDeleteSetsCurrentToRootWhenDeletedWasRoot(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $testList->get(0);
        $testList->delete();
        $linkedList = $testList = $testList->getList();

        $this->assertEquals("Item 2", $linkedList->getValue());
        $this->assertEquals(null, $linkedList->getPrevious());
    }

    public function testToArrayReturnsArray(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $returnedArray = $testList->toArray();

        $this->assertEquals("array", gettype($returnedArray));
    }

    public function testToArrayReturnsArrayOfValues(){
        $testList = new PhLinkedList("Item 1", "Item 2", "Item 3");
        $returnedArray = $testList->toArray();

        $this->assertEquals("Item 1, Item 2, Item 3", implode(", ", $returnedArray));
    }

    public function testMapReturnsALinkedList(){
        $testList = new PhLinkedList(1, 2, 3, 4);
        $returnedList = $testList->map(function($value){
            return $value * 3;
        });

        $this->assertEquals(true, $returnedList instanceof PhLinkedList);
    }

    public function testMapReturnsANewLinkedList(){
        $testList = new PhLinkedList(1, 2, 3, 4);
        $returnedList = $testList->map(function($value){
            return $value * 3;
        });

        $this->assertNotEquals($testList, $returnedList);
    }

    public function testMapReturnsLinkedListWithFunctionApplied(){
        $testList = new PhLinkedList(1, 2, 3, 4);
        $returnedList = $testList->map(function($value){
            return $value * 3;
        });

        $valueArray = $returnedList->toArray();

        $this->assertEquals("3, 6, 9, 12", implode(", ", $valueArray));
    }

    public function testFindReturnsLocatedValue(){
        $testList = new PhLinkedList(1, 2, 3, 4, 5, 6);
        $returnedValue = $testList->find(function($value){
            return $value % 2 === 0;
        });

        $this->assertEquals(2, $returnedValue);
    }

    public function testFindReturnsNullIfValueIsNotFound(){
        $testList = new PhLinkedList(1, 2, 3, 4, 5, 6);
        $returnedValue = $testList->find(function($value){
            return $value % 13 === 0;
        });

        $this->assertEquals(null, $returnedValue);
    }

    public function testFilterReturnsLinkedList(){
        $testList = new PhLinkedList(1, 2, 3, 4, 5, 6);
        $returnedList = $testList->filter(function($value){
            return $value % 2 === 0;
        });

        $this->assertEquals(true, $returnedList instanceof PhLinkedList);
    }

    public function testFilterReturnsAFilteredList(){
        $testList = new PhLinkedList(1, 2, 3, 4, 5, 6);
        $returnedList = $testList->filter(function($value){
            return $value % 2 === 0;
        });

        $this->assertEquals("2, 4, 6", implode(", ", $returnedList->toArray()));
    }

    public function testEveryReturnsTheOriginalLinkedList(){
        $testList = new PhLinkedList();
        $returnedList = $testList->every(function($value){
            //noop
        });

        $this->assertEquals($testList, $returnedList);
    }

    public function testEveryExecutesPassedFunctionForEachValue(){
        $testList = new PhLinkedList(1, 2, 3);
        $outputArray = array();

        $testList->every(function($value) use (&$outputArray){
            array_push($outputArray, $value * 2);
        });

        $this->assertEquals("2, 4, 6", implode(", ", $outputArray));
    }

    public function testEveryExitsOnReturnFalse(){
        $testList = new PhLinkedList(1, 2, 3);
        $outputArray = array();

        $testList->every(function($value) use (&$outputArray){
            array_push($outputArray, $value * 2);

            return false;
        });

        $this->assertEquals("2", implode(", ", $outputArray));
    }

}

?>