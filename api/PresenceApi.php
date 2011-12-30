<?php

class PresenceApi{

	protected $_db;

	public function __construct($dependencies){
		
		// get the connection to the database from the dependencies container
        $this->_db = $dependencies->get_db();

	}
	
	public function check_api_key($api_key){
		
        //TO DO: sanitize input
        $sql = "SELECT *
                FROM presence_api 
                WHERE `key` = ?";

        $st = $this->_db->prepare($sql);
        $st->execute(array($api_key));
        $result = $st->fetch(PDO::FETCH_ASSOC);

		if($result){
			return true;
		}else{ 
			return false;
		}
	}
}