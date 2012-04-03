<?php

class User extends API{
    
    public function __construct($action, $params){
        //check if the action is available for the resource
        if(!method_exists($this, $action)){
            HTTP::response('404');
        }
        //call the action on the resource
        $this->$action($params);
    }
        
    private function authenticate($params){
        //TODO: authenticate!!
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