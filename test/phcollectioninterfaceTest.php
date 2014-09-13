<?php

$localDirectory = dirname(__FILE__);
require_once($localDirectory . "/../src/PhCollect.php");

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