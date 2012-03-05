<?php

class AdminController extends Controller {

    private $_activity_model;
    private $_user_model;
	private $_interval_model;

    public function __construct($dependencies, $action, $params) {

        global $CONFIG;

        // get the dependencies
        $this->_dependencies = $dependencies;

        // instantiate the models
        $this->_activity_model = new ActivityModel($this->_dependencies);
        $this->_user_model = new UserModel($this->_dependencies);
		$this->_interval_model = new IntervalModel($this->_dependencies);

        // check if is admin and if the required action is defined
        if ($this->check_role('admin') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            Helper::redirect($CONFIG->wwwroot . '/error/notfound');
        }
    }

    public function activity() {

        $this->_view = new AdminActivityView($this->_activity_model->get_all_activity());
    }

    public function users() {

        $this->_view = new AdminUsersView($this->_user_model->find_all());
    }

    public function report(){

        $this->_view = new AdminReportView($this->_user_model->find_all());
    }
	
	public function report_build($params){
		//TODO
	}

    public function user_details($params) {

        $this->_view = new AdminUserDetailsView($this->_user_model->find($params[0]));
    }

    public function user_activity($params) {

        $this->_view = new AdminUserActivityView($this->_user_model->find($params[0]), $this->_activity_model->get_user_activity($params[0]));
    }

	public function user_summary($params){
		$this->_view = new AdminUserSummaryView($this->_user_model->find($params[0]), $this->_interval_model->get_user_summary($params[0]));
	}

    public function user_account($params) {

        $this->_view = new AdminUserAccountView($this->_user_model->find($params[0]));
    }

    public function user_add() {

        $this->_view = new AdminUserCreateView();
    }

    public function create_user($params) {

        global $STRINGS;

        $valid = true;
        $duplicate = false;

        // check all the params
        foreach ($params as $param) {
            if (empty($param)) {
                $valid = false;
                break;
            }
        }

        // check if the email is already registred
        if ($this->_user_model->get_user_by_email($params['email']) == true) {
            $duplicate = true;
        }

        if ($valid && !$duplicate) {
            $result = $this->_user_model->create_user($params);
            ($result == true)
                ? $alert = Helper::alert('success', $STRINGS['user:create:success'])
                : $alert = Helper::alert('error', $STRINGS['user:create:failed']);

            $this->_view = new AdminUsersView($this->_user_model->find_all(), $alert);
        } else if (!$valid && !$duplicate) {
            $this->_view = new AdminUserCreateView(Helper::alert('error', $STRINGS['user:create:failed']));
        } else if ($duplicate) {
            $this->_view = new AdminUsersView($this->_user_model->find_all(), Helper::alert('error', $STRINGS['user:create:duplicate']));
        }
    }

    public function delete_user($params) {

        global $STRINGS;

        $result = false;
        if (isset($params['userid'])) {
            // delete the user data
            $op1 = $this->_user_model->delete_user($params['userid']);
            // delete the user activity
            $op2 = $this->_activity_model->delete_user_activity($params['userid']);

            $result = $op1 && $op2;
        }

        ($result == true)
            ? $alert = Helper::alert('success', $STRINGS['user:delete:success'])
            : $alert = Helper::alert('error', $STRINGS['user:delete:failed']);

        $this->_view = new AdminActivityView($this->_activity_model->get_all_activity(), $alert);
    }

    public function update_user($params) {

        global $STRINGS;

        $userid = array_shift($params);
        $success = $this->_user_model->update_user($userid, $params);
        ($success == true)
            ? $alert = Helper::alert('success', $STRINGS['user:update:success'])
            : $alert = Helper::alert('error', $STRINGS['user:update:failed']);

        $this->_view = new AdminUserDetailsView($this->_user_model->find($userid), $alert);
    }

    public function settings() {

        $this->_view = new AdminSettingsView();
    }

    public function help() {

        $this->_view = new AdminHelpView();
    }

}