<?php

class API{
	
	protected $_db;
	
	public function __construct($dependencies){
		// get the connection to the database from the dependencies container
        $this->_db = $dependencies->get_db();
	}

	static function errResponse($code, $message){
		header('HTTP/1.1 '.$code.$message);
		print (json_encode($message));
	}
}