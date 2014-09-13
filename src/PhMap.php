<?php

class PhMap extends PhCollectionInterface{

    public function __construct($collection = array()){
        $this->_collection = $collection;
    }

    public function create($newMap){
        return new PhMap($newMap);
    }

}

?>