<?php

class PhTuple extends PhCollectionInterface{

    public function __construct(){
        $this->_collection = array();
        $this->initCollectionValues(func_get_args());
    }

    public function create($newTuple){
        return $this->build(get_class($this), $newTuple);
    }

    public function first(){
        return (isset($this->_collection[0])) ? $this->_collection[0] : null;
    }

    public function last(){
        $lastIndex = sizeof($this->_collection) - 1;
        return ($lastIndex >= 0) ? $this->_collection[$lastIndex] : null;
    }

    public function nth($index){
        return $this->get($index);
    }

    public function rest(){
        $rest = array_slice($this->_collection, 1);
        return $this->create($rest);
    }

    /* Protected functions for initialization */

    protected function initCollectionValues($args){
        if(sizeof($args)){
            foreach($args as $argument){
                array_push($this->_collection, $argument);
            }
        }
    }

}

?>