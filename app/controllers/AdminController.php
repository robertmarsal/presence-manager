<?php

class AdminController extends Controller {

    public function __construct($dependencies, $action, $params) {

        global $CONFIG;

        // get the dependencies
        $this->_dependencies = $dependencies;

        // check if is admin and if the required action is defined
        if ($this->check_role('admin') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            Helperx::redirect($CONFIG->wwwroot . '/error/notfound');
        }
    }

    public function activity() {

        $this->_view = new AdminActivityView(ActivityModel::find_all());
    }

    public function users() {

        $this->_view = new AdminUsersView(UserModel::find_all());
    }

    public function report(){

        $this->_view = new AdminReportView(UserModel::find_all());
    }

	public function report_build($params){
		$formdata = (object) $params;
		$this->_view = new AdminReportShowView(UserModel::find($formdata->user),
        IntervalModel::get_range_total($formdata));
	}

    public function user_details($params) {

        $this->_view = new AdminUserDetailsView(UserModel::find($params[0]));
    }

    public function user_activity($params) {

        $this->_view = new AdminUserActivityView(UserModel::find($params[0]), ActivityModel::find_all_by_user($params[0]));
    }

	public function user_summary($params){
		$this->_view = new AdminUserSummaryView(UserModel::find($params[0]), IntervalModel::find_all_by_user($params[0]));
	}

    public function user_account($params) {

        $this->_view = new AdminUserAccountView(UserModel::find($params[0]));
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

		// cast the params to object
		$user = (object) $params;

        // check if the email is already registred
        if (UserModel::find_by_email($user->email) == true) {
            $duplicate = true;
        }

        if ($valid && !$duplicate) {
            $result = UserModel::create($user);
            ($result == true)
                ? $alert = Helperx::alert('success', $STRINGS['user:create:success'])
                : $alert = Helperx::alert('error', $STRINGS['user:create:failed']);

            $this->_view = new AdminUsersView(UserModel::find_all(), $alert);
        } else if (!$valid && !$duplicate) {
            $this->_view = new AdminUserCreateView(Helperx::alert('error', $STRINGS['user:create:failed']));
        } else if ($duplicate) {
            $this->_view = new AdminUsersView(UserModel::find_all(), Helperx::alert('error', $STRINGS['user:create:duplicate']));
        }
    }

    public function delete_user($params) {

        global $STRINGS;

        $result = false;
        if (isset($params['userid'])) {
            // delete the user data
            $op1 = UserModel::delete($params['userid']);
            // delete the user activity
            $op2 = ActivityModel::delete_all_by_user($params['userid']);

            $result = $op1 && $op2;
        }

        ($result == true)
            ? $alert = Helperx::alert('success', $STRINGS['user:delete:success'])
            : $alert = Helperx::alert('error', $STRINGS['user:delete:failed']);

        $this->_view = new AdminActivityView(ActivityModel::find_all(), $alert);
    }

    public function update_user($params) {

        global $STRINGS;

        $userid = array_shift($params);
        $success = UserModel::update($userid, $params);
        ($success == true)
            ? $alert = Helperx::alert('success', $STRINGS['user:update:success'])
            : $alert = Helperx::alert('error', $STRINGS['user:update:failed']);

        $this->_view = new AdminUserDetailsView(UserModel::find($userid), $alert);
    }

    public function settings() {

        $this->_view = new AdminSettingsView();
    }

    public function help() {

        $this->_view = new AdminHelpView();
    }

}