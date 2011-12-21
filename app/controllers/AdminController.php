<?php

class AdminController extends Controller{
    
    public function __construct($dependencies, $action, $params) {
        
        // check if the required action is defined
        if(method_exists($this, $action)){ 
            $this->$action($params);
        }
    }
    
    public function index(){
        $this->_view = new AdminIndexView();
    }
}