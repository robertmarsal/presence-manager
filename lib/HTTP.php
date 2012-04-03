<?php

class HTTP{
    
    static $responses = array(
        '200' => 'OK',
        '400' => 'Bad Request',
        '401' => 'Unauthorized',
        '404' => 'Not Found',
        '405' => 'Method Not Allowed'
    );
    
    static function response($code){
        header('HTTP/1.1 '.$code.' '.HTTP::$responses[$code]);
		die();
    }
}