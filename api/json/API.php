<?php

class API{

    /**
     * The token that identifies the device making the request
     *
     * @var String
     */
    protected $_token;

    public function __construct($action, $params){
        //check if token exists and is still valid
        if(key_exists('token', $params)){
            $this->validate_token($params->token);
        }else{
            //only allow authentication calls
            if($action != 'authenticate'){
                HTTP::response('401');
            }
        }
    }

    protected function response($response, $internal = false){
        if($internal == false){
        	echo json_encode($response);
        	die();
        }else{
        	return $response;
        }
    }

    private function validate_token($token){
        $sql = "SELECT id
                FROM presence_auth pa
                WHERE pa.token = ?
                AND pa.timeexpires > ?";

        $response = DB::getRecord($sql, array($token, time()));
        if(!$response){
            HTTP::response('401');
        }
        //set the request token
        $this->_token = $token;
    }

    protected function get_token($userid){
        $sql = "SELECT token, timeexpires
                FROM presence_auth pa
                WHERE pa.userid = ?
                AND pa.timeexpires > ?";

        return $response = DB::getRecord($sql, array($userid, time()));
    }

    protected function get_userid($token){
        $sql = "SELECT userid
                FROM presence_auth pa
                WHERE pa.token = ?";
        $user = DB::getRecord($sql, array($token));
        return $user->userid;
    }
}
