<?php

class PhMap extends PhCollectionInterface{

    public function __construct(){
        $this->initCollectionValues(func_get_args());
    }

    public function create($valueArray){
        $newMap = $this->buildTupleArray($valueArray);
        $this->build(get_class($this), $newMap);
    }

    public function set($tuple){
        list($key, $value) = $tuple->toArray();
        $this->_collection[$key] = $value;
    }

    /* Protected functions */

    protected function initCollectionValues($args){
        foreach($args as $tuple){
            list($key, $value) = $tuple->toArray();
            $this->_collection[$key] = $value;
        }
    }

    //Convert an associative array into a set of key/value tuples
    protected function buildTupleArray($valueArray){
        $tupleArray = array();
        foreach($valueArray as $key=>$value){
            $newTuple = PHC::phtuple($key, $value);
            array_push($tupleArray, $newTuple);
        }
    }
}

?>