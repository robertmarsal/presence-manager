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

        //check if we obtained a numeric id
        if(!$user || !is_int((int)$user->id)){
            return HTTP::response('401');
        }

        //check if the user does not have a token already
        $old_token = $this->get_token($user->id);
        if($old_token){
            API::response($old_token);
        }

        //TODO: check if the user is in network --> ARP ?

        //generate the token
        $auth = new stdClass();
        $auth->userid = $user->id;
        $auth->token = sha1(time());
        $auth->timeexpires = time()+(24*60*60);

        $auth_response = DB::putRecord('presence_auth', $auth);

        if($auth_response){
            unset($auth->userid);
            API::response($auth);
        }
    }

    private function activity(){
        $sql = "SELECT pa.id, pa.action, pa.timestamp
                FROM presence_activity pa
                JOIN presence_auth pau ON pa.userid = pau.userid
                WHERE pau.token = ?";
        $response = DB::getAllRecords($sql, array($this->_token));
        return API::response($response);
    }

    private function status(){
		$sql = "SELECT action, timestamp, pu.firstname, pu.lastname, pu.position
				FROM presence_activity pa
                JOIN presence_auth pau ON pa.userid = pau.userid
                JOIN presence_users pu ON pa.userid = pu.id
				WHERE pau.token = ? AND pa.action != ?
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