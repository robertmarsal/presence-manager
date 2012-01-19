<?php

class User extends PresenceApi{

	private $_userid;

	public function __construct($dependencies, $action , $params){
		parent::__construct($dependencies);

        // check if api key is valid and action exists
        if (method_exists($this, $action)) {
            $this->$action($params);
        }else{
            print json_encode(array( 'error' => '1',
                                     'message' => 'The required action does not exist!'));
        }
	}

    private function checkin($params){

        //check required params
        $required_params = array('mac');
        $status = $this->required_params($params, $required_params);

        if(!$status){
            print json_encode(array( 'error' => '1',
                                     'message' => 'Missing required params!'));
        }else{
            print json_encode(array('status' => 'ok'));
        }
    }
}