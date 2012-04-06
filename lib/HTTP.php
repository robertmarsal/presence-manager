<?php

class HTTP{
    
    /**
     * Associative array containing the relation between HTTP codes and their 
     * meaning
     *  
     * @var Array
     */
    static private $responses = array(
        '200' => 'OK',
        '400' => 'Bad Request',
        '401' => 'Unauthorized',
        '404' => 'Not Found',
        '405' => 'Method Not Allowed'
    );
    
    /**
     * Returns a HTTP header, corresponding to the code passed as a parameter
     * 
     * @param Int $code 
     */
    static public function response($code){
        header('HTTP/1.1 '.$code.' '.HTTP::$responses[$code]);
		die();
    }
}