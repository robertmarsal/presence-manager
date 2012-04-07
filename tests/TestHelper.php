<?php

class TestHelper{
    
    /**
     * Returns a private or protected method of a class as public
     * 
     * @param String $class
     * @param String $method
     * @return Method
     */
    public static function getAccessibleMethod($class, $method){
        $reflectionClass = new ReflectionClass($class);
        $method = $reflectionClass->getMethod($method);
        $method->setAccessible(true); 
        return $method;
    }
    
    /**
     * Returns a private or protected attribute of a class as public
     * 
     * @param String $class
     * @param String $attribute
     * @return Attribute
     */
    public static function getAccessibleAttribute($class, $attribute){
        $reflectionClass = new ReflectionClass($class);
        $attr = $reflectionClass->getProperty($attribute);
        $attr->setAccessible(true);
        return $attr;
    }
}