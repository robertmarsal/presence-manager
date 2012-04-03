<?php

class API{
    
    protected $_token;
 
    protected function response($response){
        echo json_encode($response);
    }
    
    static function validate_token($token){
        $sql = "SELECT id
                FROM presence_tokens
                WHERE token = ?";
        $response = DB::getRecord($sql, array($token));

        if(!$response){
            HTTP::response('401');
        }
    }
}
