<?php

class RoutingHelper extends Helper{
    	
    static function redirect($url){
		header('Location: '.$url);
	}
}