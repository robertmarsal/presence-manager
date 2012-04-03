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
        
        //generate the token
        $token = sha1(time());
        $sql = "INSERT INTO presence_tokens
                (userid, token, timeexpires)
                VALUES(?,?,?)";
        $expire_time = time()+24;
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
}