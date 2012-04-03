<?php

class API{
    
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
    
    protected function response($response){
        echo json_encode($response);
    }
    
    private function validate_token($token){
        $sql = "SELECT id
                FROM presence_tokens pt
                WHERE pt.token = ?
                AND pt.timeexpires < ?";
        
        $response = DB::getRecord($sql, array($token, time()));
        if(!$response){
            HTTP::response('401');
        }
        //set the request token
        $this->_token = $token;
    }
}
