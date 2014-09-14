<?php

abstract class PhCollectionInterface{

    var $_collection;

    public abstract function create($newCollection);
    protected abstract function initCollectionValues($collectionValues);

    public function find(callable $comparator){
        $finalValue = null;

        foreach($this->_collection as $value){
            if($comparator($value)){
                $finalValue = $value;
                break;
            }
        }

        return $finalValue;
    }

    public function get($index){
        return (isset($this->_collection[$index])) ? $this->_collection[$index] : null;
    }

    public function length(){
        return count($this->_collection);
    }

    public function map(callable $userFn){
        $dataSet = array();

        foreach($this->_collection as $key=>$value){
            $finalValue = $userFn($value);
            $dataSet[$key] = $finalValue;
        }

        return $this->create($dataSet);
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