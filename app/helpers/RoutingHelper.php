<?php

class RoutingHelper extends Helper{
    	
    /**
     * Redirects to the url indicated by the url parameter
     * @param type $url 
     */
    static public function redirect($url){
		header('Location: '.$url);
	}
}