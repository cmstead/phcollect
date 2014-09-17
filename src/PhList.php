<?php

class PhList extends PhTuple{

    public function pop(){
        return array_pop($this->_collection);
    }
    
    public function push($value){
        array_push($this->_collection, $value);
        return $this;
    }
    
    public function shift(){
        $firstValue = $this->first();
        $this->_collection = array_slice($this->_collection, 1);
        return $firstValue;
    }
    
    public function slice($offset, $length=null){
        $sliceList = ($length != null) 
            ? array_slice($this->_collection, $offset, $length) 
            : array_slice($this->_collection, $offset);
        return $this->create($sliceList);
    }

    public function sort(callable $comparator = null){
        if($comparator == null){
            sort($this->_collection);
        } else {
            usort($this->_collection, $comparator);
        }
        return $this;
    }

    public function union(){
        $args = func_get_args();
        array_push($args, $this->_collection);

        $result = forward_static_call_array(array("PHC", "union"), $args);

        return $this->create($result);
    }

    public function intersect(){
        $args = func_get_args();
        array_push($args, $this->_collection);

        $result = forward_static_call_array(array("PHC", "intersect"), $args);

        return $this->create($result);
    }

}

?>