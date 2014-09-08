<?php

class PhList{

    private $list;

    public function __construct(){
        $this->list = array();
        $this->initListValues(func_get_args());
    }

    public function last(){
        $lastIndex = sizeof($this->list) - 1;
        return $this->list[$lastIndex];
    }
    
    public function push($value){
        array_push($this->list, $value);
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