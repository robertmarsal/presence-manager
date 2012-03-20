<?php

class User extends API{

	private $_userid;

	public function __construct($dependencies, $action , $params){
		parent::__construct($dependencies);

		//validate the user
		$this->_userid = API::validate($params);

        // check if action exists
        if (method_exists($this, $action)) {
            $this->$action($params);
        }else{
            API::errResponse('400', 'Bad Request');
        }
	}

    private function checkin($params){

		// check that the user is not already checked in

		$sql = "SELECT action
				FROM presence_activity
				WHERE userid = ?
				ORDER BY timestamp DESC
				LIMIT 1";

		// fetch the record of the last activity
		$last_activity = DB::getRecord($sql, array($this->_userid));

		// if last activity is checkin do not allow another checkin
		if($last_activity->action == 'checkin'){
			API::errResponse('406', 'Not Acceptable');
		}

		//TODO: check geo-location

		// checkin
		$sql = "INSERT INTO presence_activity (userid, action, timestamp)
				VALUES(?,?,?)";

		$st = $this->_db->prepare($sql);
        $st->execute(array($this->_userid, 'checkin', time()));

    }

	private function checkout ($params){

	}

	private function incidence($params){

	}

	private function status($params){

		$sql = "SELECT action, timestamp
				FROM presence_activity
				WHERE userid = ?
				ORDER BY timestamp DESC
				LIMIT 1";

		// fetch the record from the DB
		$last_activity = DB::getRecord($sql, array($this->_userid));

		$response = null;
		switch($last_activity->action){
			case 'checkin':
				$response = array('status' => 'checkedin',
								  'timestamp' => $last_activity->timestamp);
				break;
			case 'checkout' || 'incidence':
				$response = array ('status' => 'checkedout');
				break;
		}

		API::response($response);
	}


}