<?php

class PhList extends PhTuple{

    public function add($index, $value){
        $newCollection = array();

        for($i = 0; $i < sizeof($this->_collection); $i++){
            if($i === $index){
                array_push($newCollection, $value);
            }

            array_push($newCollection, $this->_collection[$i]);
        }

        $this->_collection = $newCollection;
    }

    public function clear(){
        $this->_collection = array();
    }

    public function contains($value){
        return in_array($value, $this->_collection, true);
    }

    public function delete($index){
        unset($this->_collection[$index]);

        $this->_collection = array_values($this->_collection);
    }

    public function indexOf($value){
        return array_search($value, $this->_collection);
    }

    public function intersect(){
        $args = func_get_args();
        array_push($args, $this->_collection);

        $result = forward_static_call_array(array("PHC", "intersect"), $args);

        return $this->create($result);
    }

    public function isEmpty(){
        return ($this->length() === 0);
    }

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
        $sliceList = ($length !== null)
            ? array_slice($this->_collection, $offset, $length) 
            : array_slice($this->_collection, $offset);
        return $this->create($sliceList);
    }

    public function sort(callable $comparator = null){
        if($comparator === null){
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

}

?>