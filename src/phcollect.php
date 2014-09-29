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

    private static $supportedCollections = array(
        "list" => "PhList",
        "map" => "PhMap",
        "tuple" => "PhTuple"
    );

    public static function phtuple(){
        return self::create("tuple", func_get_args());
    }

    public static function phlist(){
        return self::create("list", func_get_args());
    }

    public static function phmap(){
        return self::create("map", func_get_args());
    }

    public static function create($type, $args){
        $className = (isset(self::$supportedCollections[$type]))
            ? self::$supportedCollections[$type]
            : null;

        if($className !== null){
            $collectionReflectionClass = new ReflectionClass($className);
            return $collectionReflectionClass->newInstanceArgs($args);
        }
    }
    
    /* Functional behaviors */
    
    public static function every($dataSet, callable $userFn){
        foreach($dataSet as $value){
            if($userFn($value) === false){
                break;
            }
        }
    }

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

    public static function identity($value){
        return $value;
    }

    public static function intersect(){
        $args = self::sanitizeArgumentList(func_get_args());
        $result = self::getInitialArgument($args);
        sort($result);

        for($i = 1; $i < sizeof($args); $i++){
            sort($args[$i]);
            $result = array_intersect($result, $args[$i]);
        }

        return $result;
    }

    public static function map($dataSet, callable $userFn){
        $finalSet = array_map($userFn, $dataSet);

        return $finalSet;
    }

    public static function partial($userValue){
        $functionArgs = array_slice(func_get_args(), 1);
        $userFn = (gettype($userValue) !== "object") ? self::staticPartial($userValue) : $userValue ;
        
        return function() use ($userFn, $functionArgs) {
            $allArgs = self::union($functionArgs, func_get_args());
            return call_user_func_array($userFn, $allArgs);
        };
    }

    public static function thread($initialValue){
        $finalValue = $initialValue;

        for($i = 1; $i < sizeof(func_get_args()); $i++){
            $userFn = func_get_arg($i);
            $finalValue = $userFn($finalValue);
        }

        return $finalValue;
    }

    public static function union(){
        $args = self::sanitizeArgumentList(func_get_args());
        $result = self::getInitialArgument($args);
        $result = ($result !== null) ? $result : array();
        sort($result);

        for($i = 1; $i < sizeof($args); $i++){
            sort($args[$i]);
            $result = self::pairUnion($result, array_values($args[$i]));
        }

        return $result;
    }
    
    /* private helper functions */

    private static function getInitialArgument($args){
        $initialArgument = null;
        
        if(sizeof($args) > 0){
            $initialArgument = $args[0];
        }
        
        return $initialArgument;
    }

    private static function pairUnion($a, $b){
        $result = array();
        $a = array_values(array_unique($a));
        $b = array_values(array_unique($b));
        $i = $j = 0;

        while($i < sizeof($a) && $j < sizeof($b)){
            if($a[$i] < $b[$j]){
                array_push($result, $a[$i++]);
            } else if($a[$i] > $b[$j]) {
                array_push($result, $b[$j++]);
            } else {
                array_push($result, $a[$i]);
                $i++;
                $j++;
            }
        }

        while($i < sizeof($a)){
            array_push($result, $a[$i++]);
        }
        while($j < sizeof($b)){
            array_push($result, $b[$j++]);
        }

        return $result;
    }
    
    private static function sanitizeArgumentList($argSet){
        $args = array();

        foreach($argSet as $arg){
            //If an argument is a PhCollection then get the array
            if(gettype($arg) !== "array" && method_exists($arg, "toArray")){
                array_push($args, $arg->toArray());
            } else {
                array_push($args, $arg);
            }
        }

        return $args;
    }
    
    private static function staticPartial($staticFunc){
        $staticFunc = (gettype($staticFunc) === "array") ? $staticFunc : array("PHC", $staticFunc);
        return function() use ($staticFunc){
            return forward_static_call_array($staticFunc, func_get_args());
        };
    }

}

class_alias("PhCollect", "PHC");

?>