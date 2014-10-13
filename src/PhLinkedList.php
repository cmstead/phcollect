<?php

class PhLinkedList extends PhCollectionBase{

    private $root;
    private $current;

    public function __construct(){
        $this->root = null;
        $this->current = null;

        $this->initCollectionValues(func_get_args());
    }

    public function add($value){
        $listItem = $this->build($value);
        $this->insert($listItem);
    }

    public function create($listValues){
        return $this->build(get_class($this), $listValues);
    }

    public function delete(){
        $previous = $this->current->getPrevious();
        $next = $this->current->getNext();

        if($previous !== null){
            $previous->setNext($next);
        }

        if($next !== null){
            $next->setPrevious($previous);
        }

        $this->current = ($previous !== null) ? $previous : $next;
        $this->root = ($previous === null) ? $this->current : $this->root;
    }

    public function every(callable $userFn){}

    public function filter(callable $comparator){}

    public function find(callable $comparator){}

    public function get($index){
        $this->current = $this->root;

        for($position = 0; $position < $index; $position++){
            if($this->current->getNext() !== null){
                $this->current = $this->current->getNext();
            }
        }

        return $this->current->getValue();
    }

    public function getCurrent(){
        return $this->current->getValue();
    }

    public function getList(){
        return $this->root;
    }

    public function length(){
        $length = 0;
        $current = $this->root;

        while($current !== null){
            $current = $current->getNext();
            $length++;
        }

        return $length;
    }

    public function map(callable $userFn){
        $value = null;
        $current = $this->root;
        $newList = new PhLinkedList();

        while($current !== null){
            $value = $userFn($current->getValue());
            $newList->add($value);
            $current = $current->getNext();
        }

        return $newList;
    }

    public function toArray(){
        $finalArray = array();
        $current = $this->root;

        while($current !== null){
            array_push($finalArray, $current->getValue());
            $current = $current->getNext();
        }

        return $finalArray;
    }

    /* Utility Methods */

    protected function build($value){
        $next = ($this->current !== null) ? $this->current->getNext() : null;
        return new PhListItem($value, $this->current, $next);
    }

    protected function initCollectionValues($args){
        foreach($args as $value){
            $this->add($value);
            $this->root = ($this->root === null) ? $this->current : $this->root;
        }
    }

    protected function insert($listItem){
        if($this->current !== null){
            $this->current->setNext($listItem);
        }

        if($listItem->getNext() !== null){
            $listItem->getNext()->setPrevious($listItem);
        }

        $this->current = $listItem;
        $this->root = ($this->root === null) ? $listItem : $this->root;
    }

}

?>