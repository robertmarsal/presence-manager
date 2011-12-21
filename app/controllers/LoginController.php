<?php

class LoginController extends Controller{
        
    public function __construct($dependencies, $action, $params) {
        
        // check if the required action is defined
        if(method_exists($this, $action)){ 
            $this->$action($params);
        }
    }
    
    private function ask_login(){
        $this->view = new LoginView();
    }
    
}