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

		//TODO: more user data for validation
		$sql = "SELECT *
				FROM `presence_users`
				WHERE `mac` = ?";
				
		$st = $this->_db->prepare($sql);
		$st->execute(array($params['mac']));
		$user = $st->fetch();
		
		$id = $user['id'];
		
		if($id == null){
			parent::errResponse('401', 'Unauthorized');
			return null;
		}
		
		//TODO: check conditions
		
		// check if last action is checkout or incidence
		$sql = "SELECT action
				FROM presence_activity
				WHERE userid = ?
				ORDER BY timestamp DESC
				LIMIT 1";
				
		$st = $this->_db->prepare($sql);
		$st->execute(array($id));
		$last = $st->fetch(PDO::FETCH_ASSOC);

		if($last['action'] == 'checkin'){
			parent::errResponse('406', 'Not Acceptable');
			return null;
		}
		
		// checkin
		$sql = "INSERT INTO presence_activity (userid, action, timestamp)
				VALUES(?,?,?)";
				
		$st = $this->_db->prepare($sql);
        $st->execute(array($id, 'checkin', time()));	

    }
}