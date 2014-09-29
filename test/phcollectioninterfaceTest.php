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

        $this->assertEquals(false, $testCollection === $returnedCollection);
    }

    public function testMapReturnsModifiedCollection(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $expectedString = "5, 10, 15, 20";

        $returnedCollection = $testCollection->map(function($value){
            return $value * 5;
        });

        $this->assertEquals($expectedString, implode(", ", $returnedCollection->toArray()));
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
            return $value % 2 === 0;
        });

        $this->assertEquals($expectedResult, implode(", ", $returnedCollection->toArray()));
    }

    public function testFilterReturnsEmptyCollectionIfNoElementsMatch(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $returnedCollection = $testCollection->filter(function($value){
            return $value % 5 === 0;
        });

        $this->assertEquals(0, $returnedCollection->length());
    }
    
    public function testIdentityReturnsCallingCollection(){
        $testCollection = new PhCollection(array());
        $returnedCollection = $testCollection->identity();
        
        $this->assertEquals($testCollection, $returnedCollection);
    }
    
    public function testEveryExecutesForEachCollectionElement(){
        $testCollection = new PhCollection(array(1, 2));
        $finalArray = array();

        $testCollection->every(function ($value) use (&$finalArray){
            array_push($finalArray, $value * 2);
        });
        
        $this->assertEquals("2, 4", implode(", ", $finalArray));
    }
    
    public function testEveryReturnsCallingCollection(){
        $testCollection = new PhCollection(array(1, 2));
        $returnedCollection = $testCollection->every(function(){});
        
        $this->assertEquals($testCollection, $returnedCollection);
    }
    
    public function testPartialApplicationOperatesOnCallingCollection(){
        $testCollection = new PhCollection(array());
        
        $returnedValue = $testCollection->partial(function($collection){
            return $collection;
        });
        
        $this->assertEquals($testCollection, $returnedValue);
    }

    public function testThreadOperatesOnCallingCollection(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $sum = function ($a, $b){
            return $a + $b;
        };
        $collectionSum = function ($collection) use ($sum){
            $list = PHC::create("list", $collection->toArray());
            return $list->fold($sum);
        };
        $result = $testCollection->thread($collectionSum, function($value){
            return $value * 10;
        });

        $this->assertEquals(100, $result);
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