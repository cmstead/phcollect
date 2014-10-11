<?php

interface PhCollectionInterface{

    function create($newCollection);
    function every(callable $userFn);
    function filter(callable $comparator);
    function find(callable $comparator);
    function get($index);
    function identity();
    function length();
    function map(callable $userFn);
    function partial();
    function thread();
    function toArray();

}

?>