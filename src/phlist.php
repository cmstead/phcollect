<?php

class PhList{

    private $list;

    public function __construct(){
        $this->list = array();
        $this->initListValues(func_get_args());
    }

    public static function create($newList){
        $listReflectionClass = new ReflectionClass('PhList');
        return $listReflectionClass->newInstanceArgs($newList);
    }

    public function first(){
        return (isset($this->list[0])) ? $this->list[0] : null;
    }
    
    public function get($index){
        return (isset($this->list[$index])) ? $this->list[$index] : null;
    }

    public function last(){
        $lastIndex = sizeof($this->list) - 1;
        return ($lastIndex >= 0) ? $this->list[$lastIndex] : null;
    }
    
    public function length(){
        return count($this->list);
    }
    
    public function pop(){
        return array_pop($this->list);
    }
    
    public function push($value){
        array_push($this->list, $value);
    }
    
    public function rest(){
        $restList = array_slice($this->list, 1);
        return self::create($restList);
    }
    
    public function shift(){
        $firstValue = $this->first();
        $this->list = array_slice($this->list, 1);
        return $firstValue;
    }
    
    public function slice($offset, $length=null){
        $sliceList = ($length != null) 
            ? array_slice($this->list, $offset, $length) 
            : array_slice($this->list, $offset);
        return self::create($sliceList);
    }

    public function toArray(){
        return $this->list;
    }

    /* Private functions for initialization */
    
    private function initListValues($args){
        if(sizeof($args)){
            foreach($args as $key=>$argument){
                array_push($this->list, $argument);
            }
        }
    }
    
}

?>