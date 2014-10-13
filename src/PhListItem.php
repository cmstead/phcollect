<?php

class PhListItem{

    private $value;
    private $previous;
    private $next;

    public function __construct($value, $previous, $next){
        $this->value = $value;
        $this->previous = $previous;
        $this->next = $next;
    }

    public function getNext(){
        return $this->next;
    }

    public function setNext($next){
        $this->next = $next;
    }

    public function getPrevious(){
        return $this->previous;
    }

    public function setPrevious($previous){
        $this->previous = $previous;
    }

    public function getValue(){
        return $this->value;
    }

    public function setValue($value){
        $this->value = $value;
    }

}

?>