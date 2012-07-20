<?php

class AdminController extends Controller {

    /**
     * Checks if an extra_action is available and updates the action attribute
     * accordingly, if the caller is admin, and if the required action exists
     *
     * @global Object $CONFIG
     * @param String $action
     * @param Array $params
     * @param String $extra_action
     */
    public function __construct($action, $params, $extra_action = null) {
        global $CONFIG;

        // if the extra action is defined update action
        isset($extra_action) ? $action = $action . '_' . $extra_action : null;

        // check if is admin and if the required action is defined
        if ($this->check_role('admin') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            RoutingHelper::redirect($CONFIG->wwwroot . '/error/notfound');
        }
    }

    /**
     * Obtains the recent activity and sets the activity view as active
     */
    public function activity($params) {
        $this->_data->page = isset($params[0]) ? $params[0] : 0; //page number
        $this->_data->activity = ActivityModel::find_page($this->_data->page);
        new AdminActivityView($this->_data);
    }

    /**
     * Obtains all users and sets the users view as active
     */
    public function users($params) {
        $this->_data->page = isset($params[0]) ? $params[0] : 0; //page number
        $this->_data->users = UserModel::find_page($this->_data->page); 
        new AdminUsersView($this->_data);
    }

    /**
     * Obtains the details of the user, identified by the id contained in the
     * params array, and sets the user details view as active
     *
     * @param Array $params
     */
    public function users_details($params) {
    	$this->_data->user = UserModel::find($params[0]);
        new AdminUserDetailsView($this->_data);
    }

    /**
     * Displays account options using the user account view
     *
     * @param Array $params
     */
    public function users_account($params) {
    	$this->_data->user = UserModel::find($params[0]);
        new AdminUserAccountView($this->_data);
    }

    /**
     * Displays the user create form contained in the user create view
     */
    public function users_add() {
        new AdminUserCreateView();
    }

    /**
     * Creates a new user using the information received in the parameters
     *
     * @global Array $STRINGS
     * @param Array $params
     */
    public function users_create($params) {
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

        //remove url params
        $params = array_slice($params, 2);
        // cast the params to object
        $user = (object) $params;

        // check if the identifier is already registred
        if (UserModel::find_by_identifier($user->identifier) == true) {
            $duplicate = true;
        }

        if ($valid && !$duplicate) {
            $result = UserModel::create($user);
            ($result == true)
                ? $alert = BootstrapHelper::alert('success', $STRINGS['event:success'], $STRINGS['user:create:success'])
                : $alert = BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:create:failed']);
            $this->_data->page = 0;
            $this->_data->users = UserModel::find_page(0);
            new AdminUsersView($this->_data, $alert);
        } else if (!$valid && !$duplicate) {
            new AdminUserCreateView(null, BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:create:failed']));
        } else if ($duplicate) {
        	$this->_data->page = 0;
        	$this->_data->users = UserModel::find_page(0);
            new AdminUsersView($this->_data, BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:create:duplicate']));
        }
    }

    /**
     * Deletes a user identified in the 'params' parameter
     *
     * @global Array $STRINGS
     * @param Array $params
     */
    public function users_delete($params) {
        global $STRINGS;

        $result = false;
        if (isset($params[0])) {
            // delete the user data
            $op1 = UserModel::delete($params[0]);
            // delete the user activity
            $op2 = ActivityModel::delete_all_by_user($params[0]);

            $result = $op1 && $op2;
        }

        ($result == true)
            ? $alert = BootstrapHelper::alert('success', $STRINGS['event:success'], $STRINGS['user:delete:success'])
            : $alert = BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:delete:failed']);
        $this->_data->page = 0;
        $this->_data->users = UserModel::find_page(0); 
        new AdminUsersView($this->_data, $alert);
    }

    /**
     * Updates the info of a user using the 'params' data
     *
     * @global Array $STRINGS
     * @param Array $params
     */
    public function users_update($params) {
        global $STRINGS;

        $userid = array_shift($params);
        //remove url params
        $params = array_slice($params, 1);

        $success = UserModel::update($userid, $params);
        ($success == true)
            ? $alert = BootstrapHelper::alert('success', $STRINGS['event:success'], $STRINGS['user:update:success'])
            : $alert = BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:update:failed']);	
        $this->_data->user = UserModel::find($userid);
        new AdminUserDetailsView($this->_data, $alert);
    }
    
    
    public function users_updateaccount($params){
    	global $STRINGS;
    	
    	$userid = array_shift($params);
    	//remove url params
    	$params = array_slice($params, 1);
    	
    	if(empty($params['uuid'])){
    		unset($params['uuid']);
    	}
    	if(isset($params['uuid'])){
    		$params['uuid'] = sha1($params['uuid']);
    	}
    	if(empty($params['mac'])){
    		unset($params['mac']);
    	}
    	if(isset($params['mac'])){
    		$params['mac'] = sha1($params['mac']);
    	}
    	
    	$success = UserModel::update($userid, $params);
    	($success == true)
    	? $alert = BootstrapHelper::alert('success', $STRINGS['event:success'], $STRINGS['user:update:success'])
    	: $alert = BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:update:failed']);
    	$this->_data->user = UserModel::find($userid);
    	new AdminUserAccountView($this->_data, $alert);
    }

    /**
     * Displays a new report form using the report view
     */
    public function report() {
    	$this->_data->users = UserModel::find_all(); 
        new AdminReportView($this->_data);
    }

    /**
     * Builds a report using the passed parameters, and displays the result
     * using the report show view
     *
     * @param Array $params
     */
    public function report_build($params) {
        global $STRINGS;
        $formdata = (object) $params;
        
        $this->_data->user = UserModel::find($formdata->user);
        $this->_data->range = IntervalModel::get_range_total($formdata);
        $this->_data->intervals = IntervalModel::get_between($formdata);
        $this->_data->incidences =  ActivityModel::find_all_incidences($formdata->user);

        //check if the report is not empty
        if(empty($this->_data->range->total) && empty($this->_data->intervals) &&
            empty($this->_data->incidences)){
            $alert = BootstrapHelper::alert('info', $STRINGS['event:noactivity'],
                $STRINGS['event:noactivityinterval:message']);
            new AdminReportView(UserModel::find_all(), $alert);
        }else{
            new AdminReportShowView($this->_data);
        }
    }
}