<?php

class AdminController extends Controller {

    private $_activity_model;
    private $_user_model;

    public function __construct($dependencies, $action, $params) {

        global $config;

        // get the dependencies
        $this->_dependencies = $dependencies;

        // instantiate the models
        $this->_activity_model = new ActivityModel($this->_dependencies);
        $this->_user_model = new UserModel($this->_dependencies);

        // check if is admin and if the required action is defined
        if ($this->check_role('admin') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            header('Location: ' . $config['wwwroot'] . '/error/notfound');
        }
    }

    public function activity() {

        $this->_view = new AdminActivityView($this->_activity_model->getAllActivity());

    }

    public function users() {

        $this->_view = new AdminUsersView($this->_user_model->getAllUsers());

    }

	public function user($params){

		$this->_view = new AdminUserView($this->_user_model->getUserData($params[0]), $this->_activity_model->getUserActivity($params[0]));

	}
}