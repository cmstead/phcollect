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
    
    /* Functional behaviors */
    
    public static function filter($dataSet, callable $comparator){
        $finalOutput = array();

        foreach($dataSet as $key=>$value){
            if($comparator($value)){
                $finalOutput[$key] = $value;
            }
        }
        
        return $finalOutput;
    }
    
    public static function find($dataSet, callable $comparator){
        $finalValue = null;

        foreach($dataSet as $value){
            if($comparator($value)){
                $finalValue = $value;
                break;
            }
        }
        
        return $finalValue;
    }
    
    public static function forevery($dataSet, callable $userFn){
        foreach($dataSet as $value){
            if($userFn($value) === false){
                break;
            }
        }
    }

    public static function map($dataSet, callable $userFn){
        $finalSet = array();

        foreach($dataSet as $key=>$value){
            $finalValue = $userFn($value);
            $finalSet[$key] = $finalValue;
        }

        return $finalSet;
    }
    
    public static function identity($value){
        return $value;
    }
    
    public static function partial(callable $userFn){
        $functionArgs = array_slice(func_get_args(), 1);
        
        return function() use ($userFn, $functionArgs) {
            $allArgs = array_merge($functionArgs, func_get_args());
            return call_user_func_array($userFn, $allArgs);
        };
    }
    
}

class_alias("PhCollect", "PHC");

?>