<?php

class AuthController extends Controller{
    
    private $_db;
    
    public function __construct(DependencyContainer $dependencies, $action, $params) {

        // get the connection to the database from the dependencies container
        $this->_db = $dependencies->get_db();

        // check if the required action is defined
        if(method_exists($this, $action)){ 
            $this->$action($params);
        }
    }
    
    private function login($params){

        global $config;
        
        $sql = "SELECT * 
                FROM presence_users
                WHERE email = ?
                AND password = ?";
        
        $st = $this->_db->prepare($sql);
        $st->execute(array($params['email'], md5($params['password'])));
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $result = $st->fetch();

        if($result){
            session_start();
            $_SESSION['user'] = $result['email'];
            $_SESSION['role'] = $result['role'];
        
            header('Location: '.$config['wwwroot'].'/'.$result['role'].'/index/');
        }else{
            header('Location: '.$config['wwwroot']);
        }
        
    }
    
    private function logout(){
        
        global $config;
        
        session_start();
        session_unset(); 
        session_destroy(); 
        
        header('Location: '.$config['wwwroot']);
    }
}