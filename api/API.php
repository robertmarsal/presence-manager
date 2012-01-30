<?php

class API{
	
	protected $_db;
	
	public function __construct($dependencies){
		// get the connection to the database from the dependencies container
        $this->_db = $dependencies->get_db();
	}

	protected function validate($params){
	
		//TODO: more user data for validation
		$sql = "SELECT *
				FROM `presence_users`
				WHERE `mac` = ?";
				
		$st = $this->_db->prepare($sql);
		$st->execute(array($params['mac']));
		$user = $st->fetch();
		
		if($user['id'] == null){
			API::errResponse('401', 'Unauthorized');
		}
		return $user['id'];
	}
	
	static function response($message){
		header('HTTP/1.1 202 Accepted');
		print (json_encode($message));
		die();
	}
	
	static function errResponse($code, $message){
		header('HTTP/1.1 '.$code.$message);
		print (json_encode($message));
		die();
	}
}