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
		$sql = "SELECT action, timestamp
				FROM presence_activity pa
                JOIN presence_tokens pt ON pa.userid = pt.userid
				WHERE pt.token = ?
				ORDER BY timestamp DESC
				LIMIT 1";

		// fetch the record from the DB
		$last_activity = DB::getRecord($sql, array($this->_token));

		switch($last_activity->action){
			case 'checkin':
				$response = array('status' => 'checkedin',
								  'timestamp' => $last_activity->timestamp);
				break;
			case 'checkout' || 'incidence':
				$response = array ('status' => 'checkedout',
                                   'timestamp' => $last_activity->timestamp);
				break;
            default:
                $response = null;
		}
		return API::response($response);
	}
}