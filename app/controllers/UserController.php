<?php

class UserController extends Controller {

    /**
     * Checks the role and if the called action exists
     *
     * @global Object $CONFIG
     * @param String $action
     * @param Array $params
     */
    public function __construct($action, $params, $extra_action = null) {
        global $CONFIG;

		$this->_data->user = UserModel::find_by_identifier($_SESSION['user']);

		// if the extra action is defined update action
        isset($extra_action) ? $action = $action . '_' . $extra_action : null;

        // check if is admin and if the required action is defined
        if ($this->check_role('user') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            RoutingHelper::redirect($CONFIG->wwwroot . '/error/notfound');
        }
    }

    /**
     * Displays the user recent activity
     *
     * @param Array $params
     */
    public function activity() {
    	$this->_data->activity = ActivityModel::find_all_by_user($this->_data->user->id);
        new UserActivityView($this->_data);
    }

    /**
     * Shows the report form
     */
	public function report(){
		new UserReportView($this->_data);
	}

	/**
     * Builds a report using the passed parameters, and displays the result
     * using the report show view
     *
     * @param Array $params
     */
    public function report_build($params) {
        $formdata = (object) $params;
        $this->_data->range = IntervalModel::get_range_total($formdata);
        $this->_data->intervals = IntervalModel::get_between($formdata);
        $this->_data->incidences = ActivityModel::find_all_incidences($formdata->user);
        new UserReportShowView($this->_data);
    }

    /**
     * Shows the user data and allows modifying it
     */
    public function profile(){
    	new UserProfileView($this->_data);
    }

    /**
     * Updates the user data
     *
     * @global type $STRINGS
     * @param type $params
     */
    public function profile_update($params){
    	global $STRINGS;

    	$userid = array_shift($params);
        //remove url params
        $params = array_slice($params, 1);
		//check if the password is set
		if(empty($params['password'])){
			//no password is provided -> remove key
			unset($params['password']);
		}else{
			//compute new password and store
			$params['password'] = sha1($params['password']);
		}

        $success = UserModel::update($userid, $params);
        ($success == true)
            ? $alert = BootstrapHelper::alert('success', $STRINGS['event:success'], $STRINGS['user:update:success'])
            : $alert = BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:update:failed']);
		//refresh the user data
        $this->_data->user = UserModel::find($userid);
        new UserProfileView($this->_data, $alert);
    }
}
