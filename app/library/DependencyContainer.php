<?php

class DependencyContainer{
    
    private $_instances = array();
    private $_params = array();
    
    public function __construct($params){
        $this->_params = $params;
    }
    
    public function get_db(){
        
        if(empty($this->_instances['db']) ||
            !is_a($this->_instances,'PDO')){
            
            $this->_instances['db'] = new PDO(
                "mysql:host=".$this->_params['dbhost'].";
                 dbname=".$this->_params['dbname'],
                $this->_params['dbuser'],
                $this->_params['dbpassword']
            );
        }
        
        return $this->_instances['db'];
    }
}
