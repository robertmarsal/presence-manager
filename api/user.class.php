<?php

class User extends API{

	public function __construct($dependencies, $action , $params){
		parent::__construct($dependencies);

        // check if action exists
        if (method_exists($this, $action)) {
            $this->$action($params);
        }else{
            API::errResponse('400', 'Bad Request');
        }
	}

    private function checkin($params){
	
		$userid = parent::validate($params);
		
		//TODO: check conditions
		
		// check if last action is checkout or incidence
		$sql = "SELECT action
				FROM presence_activity
				WHERE userid = ?
				ORDER BY timestamp DESC
				LIMIT 1";
				
		$st = $this->_db->prepare($sql);
		$st->execute(array($userid));
		$last_activity = $st->fetch(PDO::FETCH_ASSOC);

		if($last_activity['action'] == 'checkin'){
			API::errResponse('406', 'Not Acceptable');
		}
		
		//check geo-location
		
		
		// checkin
		$sql = "INSERT INTO presence_activity (userid, action, timestamp)
				VALUES(?,?,?)";
				
		$st = $this->_db->prepare($sql);
        $st->execute(array($userid, 'checkin', time()));	

    }
	
	private function checkout ($params){
	
	}
	
	private function incidence($params){
	
	}
	
	private function status($params){
	
		$userid = parent::validate($params);

		// return last action
		$sql = "SELECT action
				FROM presence_activity
				WHERE userid = ?
				ORDER BY timestamp DESC
				LIMIT 1";
				
		$st = $this->_db->prepare($sql);
		$st->execute(array($userid));
		$last_activity = $st->fetch(PDO::FETCH_ASSOC);

		$response = null;
		switch($last_activity['action']){
			case 'checkin': $response = 'checkedin';
				break;
			case 'checkout': $response = 'checkedout';
				break;
		}
		API::response(array('status' => $response));
	}
	
	
}