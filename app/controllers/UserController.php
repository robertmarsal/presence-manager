<?php

class UserController extends Controller {

	protected $_user;

    /**
     * Checks the role and if the called action exists
     *
     * @global Object $CONFIG
     * @param String $action
     * @param Array $params
     */
    public function __construct($action, $params, $extra_action = null) {
        global $CONFIG;

		$this->_user = UserModel::find_by_email($_SESSION['user']);
		
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
        $this->_view = new UserActivityView(ActivityModel::find_all_by_user($this->_user->id));
    }
	
	public function report(){
		$this->_view = new UserReportView($this->_user);
	}
	
	/**
     * Builds a report using the passed parameters, and displays the result
     * using the report show view
     *
     * @param Array $params
     */
    public function report_build($params) {
        $formdata = (object) $params;
        $this->_view = new UserReportShowView(UserModel::find($formdata->user),
                        IntervalModel::get_range_total($formdata), IntervalModel::get_between($formdata),
                        ActivityModel::find_all_incidences($formdata->user));
    }
}
