<?php

class User extends PresenceApi{
	
	private $_userid;

	public function __construct($dependencies, $action , $params){
		parent::__construct($dependencies);
		
		// check for required params
		if(!isset($params['userid'])){
			print json_encode(array( 'error' => '1',
									 'message' => 'Missing userid parameter'));
			return null;
		}else{
			$this->_userid = $params['userid'];
		}
		
        // check if api key is valid and action exists
        if ($this->check_api_key($params['api_key']) && method_exists($this, $action)) {
            $this->$action($params);
        }
	}
	
	private function getData($params){

		$sql = "SELECT email, firstname, lastname, role
                FROM presence_users
                WHERE `email` = ?";

        $st = $this->_db->prepare($sql);
        $st->execute(array($this->_userid));
        $user_data = $st->fetch(PDO::FETCH_ASSOC);
		
		print json_encode($user_data);
	}
	
	private function getActivity($params){
		
		// set maxrecords to 10 if is not set
        $max_records = isset($params['activities']) ? $params['activities'] : 10;

        $sql = "SELECT paa.id, paa.userid, paa.action, paa.timestamp
				FROM presence_activity paa
				JOIN presence_users pu ON `userid` = `email`
				WHERE `email` = ?
				ORDER BY id DESC LIMIT 10";

        $st = $this->_db->prepare($sql);
        $st->execute(array($this->_userid));
        $user_activity = $st->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($user_activity);
	}

}