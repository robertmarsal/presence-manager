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

        //check if all the params are supplied
        $valid_params = $params->UUID && $params->mac;

        if(!$valid_params){
            return HTTP::response('400');
        }

        //validate the user
        $sql = "SELECT id
                FROM presence_users pu
                WHERE pu.UUID = ? AND pu.mac = ?";

        $user = DB::getRecord($sql, array($params->UUID, $params->mac));

        //TODO: authenticate!!
        //$params->UUID
        //$params->mac
        //$params->userid

        //TODO: check if this user doesn't have a valid token already!

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

    private function checkin(){
        //check the current status
        $user_status = $this->status();
        if($user_status->code != 0){ //the user is already checkedin
            return API::response(array('code' => '0',
                                       'timestamp'=> '0'));
        }

        //proceed with the check-in
        $checkin = new stdClass();
        $checkin->userid = $this->get_userid($this->_token);
        $checkin->action = 'checkin';
        $checkin->timestamp = time();
        $checkin->computed = 0;

        $sq_status = DB::putRecord('presence_activity', $checkin);

        if($sq_status){
            return API::response(array('code' => '1',
                                       'timestamp' => $checkin->timestamp));
        }else{
            return API::response(array('code' => '0',
                                       'timestamp'=> '0'));
        }
    }
}