<?php

$localDirectory = dirname(__FILE__);

$collectionFiles = array(
    "PhCollectionInterface",
    "PhTuple",
    "PhList",
    "PhMap"
);

foreach($collectionFiles as $name){
    require_once($localDirectory . "/" . $name . ".php");
}

class PhCollect{

    public static function phtuple(){
        return self::create("PhTuple", func_get_args());
    }

    public static function phlist(){
        return self::create("PhList", func_get_args());
    }

    public static function phmap(){
        return self::create("PhMap", func_get_args());
    }

    protected static function create($type, $args){
        $collectionReflectionClass = new ReflectionClass($type);
        return $collectionReflectionClass->newInstanceArgs($args);
    }
}

class_alias("PhCollect", "PHC");

?>