<?php

class UserController extends Controller{
    
    public function __construct($dependencies, $action, $params) {
        
        global $config;
        
        // check if the required action is defined
        if(method_exists($this, $action)){ 
            $this->$action($params);
        }else{
            header('Location: '.$config['wwwroot'].'/error/notfound');
        }
    }
    
    public function activity(){
        $this->_view = new UserActivityView();
    }

}