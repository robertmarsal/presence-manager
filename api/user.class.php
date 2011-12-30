<?php

class User extends PresenceApi{

	public function __construct($dependencies, $action , $params){
		parent::__construct($dependencies);
		
        // check if api key is valid and action exists
        if ($this->check_api_key($params['api_key']) && method_exists($this, $action)) {
            $this->$action($params);
        }
	}

}