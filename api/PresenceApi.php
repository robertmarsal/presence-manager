<?php

class PresenceApi{

	protected $_db;

	public function __construct($dependencies){

		// get the connection to the database from the dependencies container
        $this->_db = $dependencies->get_db();

	}

    /**
     * Checks if all the required params are passed
     *
     * @param type $params - the given params
     * @param type $required - the required params
     * @return boolean
     */
    public function required_params($params, $required){

        foreach($required as $req_param){
            if(!isset($params[$req_param])){
                return false;
            }
        }

        return true;
    }
}