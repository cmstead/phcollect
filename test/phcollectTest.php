<?php

class PhCollectTest extends PHPUnit_Framework_TestCase{
    
    public function testFindReturnsElementIfFound(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $returnedValue = $testCollection->find(function($value){
            return $value % 3 == 0;
        });

        $this->assertEquals(3, $returnedValue);
    }

    public function testFindReturnsNullIfElementIsNotFound(){
        $testCollection = new PhCollection(array(1, 2, 3, 4));
        $returnedValue = $testCollection->find(function($value){
            return $value % 5 == 0;
        });

        $this->assertEquals(null, $returnedValue);
    }

    public function testEveryExecutesForEachArrayElement(){
        $testArray = array(1, 2);
        $finalArray = array();

        PHC::every($testArray, function ($value) use (&$finalArray){
            array_push($finalArray, $value * 2);
        });
        
        $this->assertEquals("2, 4", implode(", ", $finalArray));
    }
    
    public function testEveryExitsWhenFalseIsRetured(){
        $testArray = array(1, 2);
        $finalArray = array();

        PHC::every($testArray, function ($value) use (&$finalArray){
            array_push($finalArray, $value * 2);
            return false;
        });
        
        $this->assertEquals("2", implode(", ", $finalArray));
    }

    public function testIdentityReturnsPassedObject(){
        $testCollection = new PhCollection(array());
        $returnedCollection = PHC::identity($testCollection);
        $this->assertEquals($testCollection, $returnedCollection);
    }
    
    public function testIntersectReturnsAnArray(){
        $result = PHC::intersect(array());
        
        $this->assertEquals("array", gettype($result));
    }
    
    public function testIntersectReturnsSingleArray(){
        $result = PHC::intersect(array(1, 2, 3));
        
        $this->assertEquals("1, 2, 3", implode(", ", $result));
    }
    
    public function testIntersectReturnsIntersectionOfTwoArrays(){
        $result = PHC::intersect(array(1, 2, 3), array(2, 3, 4));
        
        $this->assertEquals("2, 3", implode(", ", $result));
    }

    public function testIntersectReturnsIntersectionOfMultipleArrays(){
        $result = PHC::intersect(array(1, 2, 3), array(2, 3, 4), array(1, 3, 5), array(7, 5, 3));
        
        $this->assertEquals("3", implode(", ", $result));
    }

    public function testPartialReturnsAFunction(){
        $partial = PHC::partial(function(){});
        
        $this->assertEquals(true, is_callable($partial));
    }
    
    public function testPartialApplicationAppliesOneVariable(){
        $add = function($a, $b){
            return $a + $b;
        };
        
        $addFive = PHC::partial($add, 5);
        
        $this->assertEquals(7, $addFive(2));
    }
    
    public function testPartialApplicationAppliesMultipleVariables(){
        $add = function(){
            $args = func_get_args();
            $sum = 0;

            foreach($args as $value){
                $sum += $value;
            }

            return $sum;
        };
        
        $addExtendible = PHC::partial($add, 1, 2, 3);
        
        $this->assertEquals(15, $addExtendible(4, 5));
    }
    
    public function testPartialAcceptsStaticFunctionNameArrayAndCallsThrough(){
        $filterPartial = PHC::partial(array("PHC", "filter"), array(1, 2, 3, 4, 5, 6));
        $result = $filterPartial(function($value){
            return $value % 2 == 0;
        });

        $this->assertEquals("2, 4, 6", implode(", ", $result));
    }
    
    public function testPartialAcceptsPHCStaticFunctionNameAndCallsThrough(){
        $filterPartial = PHC::partial("filter", array(1, 2, 3, 4, 5, 6));
        $result = $filterPartial(function($value){
            return $value % 2 == 0;
        });

        $this->assertEquals("2, 4, 6", implode(", ", $result));
    }
    
    public function testUnionReturnsAnArray(){
        $unionResult = PHC::union();

        $this->assertEquals("array", gettype($unionResult));
    }

    public function testUnionReturnsSingleArray(){
        $result = PHC::union(array(1, 2, 3));

        $this->assertEquals("1, 2, 3", implode(", ", $result));
    }

    public function testUnionReturnsArrayAsUnionOfTwoSortedArrays(){
        $result = PHC::union(array(1, 2, 3), array(2, 3, 4));

        $this->assertEquals("1, 2, 3, 4", implode(", ", $result));
    }

    public function testUnionReturnsArrayAsUnionOfTwoUnsortedArrays(){
        $result = PHC::union(array(3, 2, 1), array(4, 3, 2));

        $this->assertEquals("1, 2, 3, 4", implode(", ", $result));
    }

    public function testUnionReturnsArrayAsUnionOfMultipleArrays(){
        $result = PHC::union(array(1, 2), array(2, 3, 4), array(5, 3, 1));

        $this->assertEquals("1, 2, 3, 4, 5", implode(", ", $result));
    }
    
}

?>