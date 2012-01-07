<?php

class AdminController extends Controller {
    
    public function __construct($dependencies, $action, $params) {

        global $config;

        // get the dependencies
        $this->_dependencies = $dependencies;
        
        // check if is admin and if the required action is defined
        if ($this->check_role('admin') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            header('Location: ' . $config['wwwroot'] . '/error/notfound');
        }
    }

    public function activity() {
        
        $activity_model = new ActivityModel($this->_dependencies->get_db());
        $this->_view = new AdminActivityView($activity_model->getAllActivity());
        
    }

    public function users() {

        $user_model = new UserModel($this->_dependencies->get_db());
        $this->_view = new AdminUsersView($user_model->getAllUsers());
        
    }

	public function user($params){
		
        $user_model = new UserModel($this->_dependencies->get_db());
		$this->_view = new AdminUserView($user_model->getUserData($params[0]));
        
	}
}