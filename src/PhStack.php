<?php

class PhStack{
    
    var $list;
    
    public function __construct(PhLinkedList $list){
        $this->list = $list;
    }
    
    public function pop(){
        $finalValue = $this->list->getCurrent();
        $this->list->delete();
        
        return $finalValue;
    }
    
    public function push($value){
        $this->list->add($value);
    }
    
    public function peek(){
        return $this->list->getCurrent();
    }
    
}

?>