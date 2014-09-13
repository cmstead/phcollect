<?php

class PhMap extends PhCollectionInterface{

    public function __construct(){
        $this->initCollectionValues(func_get_args());
    }

    public function create($newMap){
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
}

?>