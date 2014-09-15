<?php

abstract class PhCollectionInterface{

    var $_collection;

    public abstract function create($newCollection);
    protected abstract function initCollectionValues($collectionValues);

    public function filter(callable $comparator){
        return $this->create(PhCollect::filter($this->_collection, $comparator));
    }

    public function find(callable $comparator){
        return PhCollect::find($this->_collection, $comparator);
    }
    
    public function forEvery(callable $userFn){
        PHC::forevery($this->_collection, $userFn);
        return $this;
    }

    public function get($index){
        return (isset($this->_collection[$index])) ? $this->_collection[$index] : null;
    }
    
    public function identity(){
        return $this;
    }

    public function length(){
        return count($this->_collection);
    }

    public function map(callable $userFn){
        return $this->create(PhCollect::map($this->_collection, $userFn));
    }

    public function toArray(){
        return $this->_collection;
    }

    /* Protected functions */

    protected function build($className, $arguments){
        $reflectionClass = new ReflectionClass($className);
        return $reflectionClass->newInstanceArgs($arguments);
    }
}

?>