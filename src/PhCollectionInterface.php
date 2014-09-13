<?php

abstract class PhCollectionInterface{

    var $_collection;

    public abstract function create($newCollection);

    public function get($index){
        return (isset($this->_collection[$index])) ? $this->_collection[$index] : null;
    }

    public function length(){
        return count($this->_collection);
    }

    public function toArray(){
        return $this->_collection;
    }

}

?>