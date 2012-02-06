<?php

class UserController extends Controller {

    private $_db;

    public function __construct($dependencies, $action, $params) {

        global $CONFIG;
     
        // get the dependencies
        $this->_dependencies = $dependencies;
       
        // instantiate the models
        $this->_activity_model = new ActivityModel($this->_dependencies);
        $this->_user_model = new UserModel($this->_dependencies);
        
        // check if is admin and if the required action is defined
        if ($this->check_role('user') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            Helper::redirect($CONFIG['wwwroot'] . '/error/notfound');
        }


    }

    function activity($params) {
        
        $user = $this->_user_model->get_user_by_email($_SESSION['user']);
        $this->_view = new UserActivityView($this->_activity_model->get_user_activity($user['id']));
    
    }

}
