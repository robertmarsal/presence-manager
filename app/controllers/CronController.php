<?php

class CronController extends Controller{

    private $_activity_model;
    private $_user_model;
    
    public function __construct($dependencies, $action, $params) {
  
        global $CONFIG;
            
        // get the dependencies
        $this->_dependencies = $dependencies;
     
        // instantiate the models
        $this->_activity_model = new ActivityModel($this->_dependencies);
        $this->_user_model = new UserModel($this->_dependencies);
    
        // check if the required action is defined
        if (method_exists($this, $action)) {
            $this->$action($params);
        }
    }

    private function run() {
    
        global $CONFIG;

        $verbose = $CONFIG['verbose'];

        //get all users
            $verbose && print_r("Fetching All Users\n");
        
        $users = $this->_user_model->get_all_users();
       
            ($verbose && $users) ? print_r("Ok\n") : print_r("Failed!\n");
        
        foreach($users as $user) {
            
            //get activity
            //TODO: get only not calculated activity
            $activity = $this->_activity_model->get_user_activity($user['id']);
            if($activity){
                //group 2 by 2

            }
        }
    }

}
