<?php

class PhMap extends PhCollectionInterface{

    public function __construct(){
        $this->initCollectionValues(func_get_args());
    }

    public function create($newMap){
        $this->build(get_class($this), $newMap);
    }

    /* Protected functions */

    protected function initCollectionValues($args){
        foreach($args as $argument){
            $this->_collection[$argument->get(0)] = $argument->get[1];
        }
    }
}

?>