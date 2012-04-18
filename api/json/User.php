<?php

class User extends API{

    public function __construct($action, $params){
        parent::__construct($action, $params);
        //check if the action is available for the resource
        if(!method_exists($this, $action)){
            HTTP::response('404');
        }
        //call the action on the resource
        $this->$action($params);
    }

    private function authenticate($params){
        //TODO: authenticate!!
        //$params->userid
        //$params->UUID
        //$params->mac
        $params->userid = 2;//TEST ONLY

        //check if this user doesn't have a valid token already!

        //generate the token
        $token = sha1(time());
        $sql = "INSERT INTO presence_tokens
                (userid, token, timeexpires)
                VALUES(?,?,?)";
        $expire_time = time()+(24*60*60);
        $response = DB::runSQL($sql, array($params->userid, $token, $expire_time));
        if($response){
            $auth = new stdClass();
            $auth->token = $token;
            $auth->expires = $expire_time;
            API::response($auth);
        }
    }

    private function activity(){
        $sql = "SELECT pa.id, pa.action, pa.timestamp
                FROM presence_activity pa
                JOIN presence_tokens pt ON pa.userid = pt.userid
                WHERE pt.token = ?";
        $response = DB::getAllRecords($sql, array($this->_token));
        return API::response($response);
    }

    private function status(){
		$sql = "SELECT action, timestamp, pu.firstname, pu.lastname, pu.position
				FROM presence_activity pa
                JOIN presence_tokens pt ON pa.userid = pt.userid
                JOIN presence_users pu ON pa.userid = pu.id
				WHERE pt.token = ? AND pa.action != ?
				ORDER BY timestamp DESC
				LIMIT 1";

		// fetch the record from the DB
		$last_activity = DB::getRecord($sql, array($this->_token, 'incidence'));

		switch($last_activity->action){
			case 'checkin':
				$response = array('code' => '1',
								  'timestamp' => $last_activity->timestamp,
                                  'user' => $last_activity->firstname.' '.$last_activity->lastname,
                                  'position' => $last_activity->position);
				break;
			case 'checkout':
				$response = array ('code' => '0',
                                   'timestamp' => $last_activity->timestamp,
                                   'user' => $last_activity->firstname.' '.$last_activity->lastname,
                                   'position' => $last_activity->position);
				break;
            default:
                $response = null;
		}
		return API::response($response);
	}
}