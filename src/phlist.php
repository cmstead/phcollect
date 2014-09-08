<?php

class PhList{

    private $list;

    public function __construct(){
        $this->list = array();
        $this->initListValues(func_get_args());
    }

    public function first(){
        return $this->list[0];
    }

    public function last(){
        $lastIndex = sizeof($this->list) - 1;
        return $this->list[$lastIndex];
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
        $listReflectionClass = new ReflectionClass('PhList');
        $restList = array_slice($this->list, 1);
        return $listReflectionClass->newInstanceArgs($restList);
    }
    
    public function shift(){
        $firstValue = $this->first();
        $this->list = array_slice($this->list, 1);
        return $firstValue;
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