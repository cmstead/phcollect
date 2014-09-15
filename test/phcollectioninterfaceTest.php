<?php

$localDirectory = dirname(__FILE__);
require_once($localDirectory . "/../src/phcollect.php");

class PhCollectionInterfaceTest extends PHPUnit_Framework_TestCase{

    public function testToArrayReturnsAnArray(){
        $testCollection = new PhCollection(array());
        $returnedValue = $testCollection->toArray();

        $this->assertEquals("array", gettype($returnedValue));
    }

    public function testGetReturnsValueAtIndex(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $this->assertEquals(3, $testCollection->get(2));
    }

    public function testGetReturnsNullIfIndexIsNotDefined(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $this->assertEquals(null, $testCollection->get(5));
    }

    public function testLengthReturnsCountOfListElements(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $this->assertEquals(4, $testCollection->length());
    }

    public function testMapReturnsANewCollection(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $returnedCollection = $testCollection->map(function($value){
            return $value * 5;
        });

        $this->assertEquals(false, $testCollection == $returnedCollection);
    }

    public function testMapReturnsModifiedCollection(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $expectedString = "5, 10, 15, 20";

        $returnedCollection = $testCollection->map(function($value){
            return $value * 5;
        });

        $this->assertEquals($expectedString, implode(", ", $returnedCollection->toArray()));
    }

    public function testFindReturnsElementIfFound(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $returnedValue = $testCollection->find(function($value){
            return $value % 3 == 0;
        });

        $this->assertEquals(3, $returnedValue);
    }

    public function testFindReturnsNullIfElementIsNotFound(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $returnedValue = $testCollection->find(function($value){
            return $value % 5 == 0;
        });

        $this->assertEquals(null, $returnedValue);
    }

    public function testFilterReturnsACollection(){
        $testCollection = new PhCollection(array());
        $returnedCollection = $testCollection->filter(function(){});

        $this->assertEquals("PhCollection", get_class($returnedCollection));
    }

    public function testFilterReturnsMatchingElements(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $expectedResult = "2, 4";
        $returnedCollection = $testCollection->filter(function($value){
            return $value % 2 == 0;
        });

        $this->assertEquals($expectedResult, implode(", ", $returnedCollection->toArray()));
    }

    public function testFilterReturnsEmptyCollectionIfNoElementsMatch(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $returnedCollection = $testCollection->filter(function($value){
            return $value % 5 == 0;
        });

        $this->assertEquals(0, $returnedCollection->length());
    }
    
    public function testIdentityReturnsPassedObject(){
        $testCollection = new PhCollection(array());
        $returnedCollection = PHC::identity($testCollection);
        $this->assertEquals($testCollection, $returnedCollection);
    }
    
    public function testIdentityReturnsCallingCollection(){
        $testCollection = new PhCollection(array());
        $returnedCollection = $testCollection->identity();
        
        $this->assertEquals($testCollection, $returnedCollection);
    }
    
    public function testForeveryExecutesForEachArrayElement(){
        $testArray = array(1, 2);
        $finalArray = array();

        PHC::forevery($testArray, function ($value) use (&$finalArray){
            array_push($finalArray, $value * 2);
        });
        
        $this->assertEquals("2, 4", implode(", ", $finalArray));
    }
    
    public function testForeveryExitsWhenFalseIsRetured(){
        $testArray = array(1, 2);
        $finalArray = array();

        PHC::forevery($testArray, function ($value) use (&$finalArray){
            array_push($finalArray, $value * 2);
            return false;
        });
        
        $this->assertEquals("2", implode(", ", $finalArray));
    }

    public function testForeveryExecutesForEachCollectionElement(){
        $testCollection = new PhCollection(array(1, 2));
        $finalArray = array();

        $testCollection->forevery(function ($value) use (&$finalArray){
            array_push($finalArray, $value * 2);
        });
        
        $this->assertEquals("2, 4", implode(", ", $finalArray));
    }
    
    public function testForeveryReturnsCallingCollection(){
        $testCollection = new PhCollection(array(1, 2));
        $returnedCollection = $testCollection->forevery(function(){});
        
        $this->assertEquals($testCollection, $returnedCollection);
    }

}

class PhCollection extends PhCollectionInterface{

    public function __construct($collection){
        $this->_collection = $collection;
    }

    public function create($newCollection){
        return new PhCollection($newCollection);
    }

    protected function initCollectionValues($args){}
}

?>