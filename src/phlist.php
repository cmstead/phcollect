<?php

class PhList{

    private $list;

    public function __construct(){
        $this->list = array();
    }

    public function toArray(){
        return $this->list;
    }

}

?>