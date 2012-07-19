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
        $valid_params = isset($params->UUID) && isset($params->MAC);

        if(!$valid_params){
            return HTTP::response('400');
        }

        //validate the user
        $sql = "SELECT id
                FROM presence_users pu
                WHERE pu.UUID = ? AND pu.mac = ?";

        $user = DB::getRecord($sql, array(sha1($params->UUID), sha1($params->MAC)));

        //check if we obtained a numeric id
        if(!$user || !is_int((int)$user->id)){
            return HTTP::response('401');
        }

        //check if the user does not have a token already
        $old_token = $this->get_token($user->id);
        if($old_token){
            API::response($old_token);
        }

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

    private function data(){
        $sql = "SELECT pu.identifier, pu.firstname, pu.lastname, pu.position
                FROM presence_users pu
                JOIN presence_auth pau ON pu.id = pau.userid
                WHERE pau.token = ?";
        $data = DB::getRecord($sql, array($this->_token));
        return API::response($data);
    }

    private function status($params, $internal = false){
    	$sql = "SELECT action as status, timestamp
				FROM presence_activity pa
                JOIN presence_auth pau ON pa.userid = pau.userid
				WHERE pau.token = ? AND pa.action != ?
				ORDER BY timestamp DESC
				LIMIT 1";

		$status = DB::getRecord($sql, array($this->_token, 'incidence'));

		return API::response($status, $internal);

	}

    private function checkin(){
        //check the current status
        $user_status = $this->status(null, true);
        if($user_status->status != 'checkout'){ //the user is already checkedin
            return API::response(array('timestamp' => $user_status->timestamp));
        }

        //proceed with the check-in
        $checkin = new stdClass();
        $checkin->userid = $this->get_userid($this->_token);
        $checkin->action = 'checkin';
        $checkin->timestamp = time();
        $checkin->computed = 0;

        $sq_status = DB::putRecord('presence_activity', $checkin);

        if($sq_status){
            return API::response(array('timestamp' => $checkin->timestamp));
        }else{
            return API::response(array('timestamp'=> NULL));
        }
    }


	private function checkout(){
		//check the current status
		$user_status = $this->status(null, true);
		if($user_status->status != 'checkin'){ //the user is not checkedin
			return API::response(array('timestamp' => NULL));
		}

		//checkout
		$checkout = new stdClass();
		$checkout->userid = $this->get_userid($this->_token);
		$checkout->action = 'checkout';
		$checkout->timestamp = time();
		$checkout->computed = 0;

		$sq_status = Db::putRecord('presence_activity', $checkout);

		if($sq_status){
			return API::response(array('timestamp' => $checkout->timestamp));
		}else{
			return API::response(array('timestamp' => NULL));
		}
	}
}