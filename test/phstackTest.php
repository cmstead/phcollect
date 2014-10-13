<?php

$localDirectory = dirname(__FILE__);
require_once($localDirectory . "/../src/phcollect.php");

class PhStackTest extends PHPUnit_Framework_TestCase{
    
    private $stack;
    
    public function setUp(){
        $this->stack = new PhStack(new PhLinkedList());
    }
    
    public function testPhStackIsInstantiable(){
        try{
            $testStack = new PhStack(new PhLinkedList());
        } catch (Exception $e){
            $testStack = null;
        }
        
        $this->assertEquals(true, $testStack instanceof PhStack);
    }
    
    public function testPushIsAvailable(){
        $testStack = $this->stack;
        
        $this->assertEquals(true, method_exists($testStack, "push"));
    }
    
    public function testPushAddsValueToStack(){
        $testStack = $this->stack;
        $testStack->push("Push Test");
        
        $this->assertEquals("Push Test", $testStack->peek());
    }
    
    public function testPeekReturnsInsertedValue(){
        $testStack = $this->stack;
        $testStack->push("Peek Test");
        
        $this->assertEquals("Peek Test", $testStack->peek());
    }
    
    public function testPopReturnsPushedValue(){
        $testStack = $this->stack;
        $testStack->push("Pop test");
        
        $this->assertEquals("Pop test", $testStack->pop());
    }
    
    public function testPopRemovesPoppedValue(){
        $testStack = $this->stack;
        $testStack->push("Item 1");
        $testStack->push("Item 2");
        $testStack->pop();
        
        $this->assertEquals("Item 1", $testStack->peek());
    }
    
}

?>