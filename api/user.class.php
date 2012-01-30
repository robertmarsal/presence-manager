<?php

class User extends API{

	public function __construct($dependencies, $action , $params){
		parent::__construct($dependencies);

        // check if action exists
        if (method_exists($this, $action)) {
            $this->$action($params);
        }else{
            parent::errResponse('400', 'Bad Request');
        }
	}

    private function checkin($params){
	
	//TODO: validate user
		

    }
}