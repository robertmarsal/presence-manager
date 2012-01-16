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
			Helper::redirect($config['wwwroot'] . '/error/notfound');
        }
    }

    public function activity() {

        $this->_view = new AdminActivityView($this->_activity_model->get_all_activity());
    }
	
    public function users() {

        $this->_view = new AdminUsersView($this->_user_model->get_all_users());
    }

    public function user_details($params) {

        $this->_view = new AdminUserDetailsView($this->_user_model->get_user_data($params[0]));
    }

    public function user_activity($params) {

        $this->_view = new AdminUserActivityView($this->_user_model->get_user_data($params[0]), $this->_activity_model->get_user_activity($params[0]));
    }

    public function update_user($params) {

        global $string;

        $userid = array_shift($params);
        $success = $this->_user_model->update_user($userid, $params);
        $success == true ? $alert = Helper::alert('success', $string['user:update:success']) : $alert = Helper::alert('error', $string['user:update:failed']);

        $this->_view = new AdminUserDetailsView($this->_user_model->get_user_data($userid), $alert);
    }

    public function settings(){

        $this->_view = new AdminSettingsView();
    }

    public function help(){

        $this->_view = new AdminHelpView();
    }

}