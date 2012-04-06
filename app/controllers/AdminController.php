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
    public function activity() {
        $this->_view = new AdminActivityView(ActivityModel::find_all());
    }

    /**
     * Obtains all users and sets the users view as active 
     */
    public function users() {
        $this->_view = new AdminUsersView(UserModel::find_all());
    }

    /**
     * Obtains the details of the user, identified by the id contained in the 
     * params array, and sets the user details view as active
     * 
     * @param Array $params
     */
    public function users_details($params) {
        $this->_view = new AdminUserDetailsView(UserModel::find($params[0]));
    }

    /**
     * Obtains the activity of a user, identified by the id contained in the 
     * params array, and sets the user activity view as active
     * 
     * @param Array $params 
     */
    public function users_activity($params) {
        $this->_view =
                new AdminUserActivityView(UserModel::find($params[0]),
                        ActivityModel::find_all_by_user($params[0]));
    }

    public function users_summary($params) {
        $this->_view =
                new AdminUserSummaryView(UserModel::find($params[0]),
                        IntervalModel::find_all_by_user($params[0]));
    }

    public function users_account($params) {
        $this->_view = new AdminUserAccountView(UserModel::find($params[0]));
    }

    public function users_add() {
        $this->_view = new AdminUserCreateView();
    }

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

        // check if the email is already registred
        if (UserModel::find_by_email($user->email) == true) {
            $duplicate = true;
        }

        if ($valid && !$duplicate) {
            $result = UserModel::create($user);
            ($result == true) ? $alert = BootstrapHelper::alert('success', $STRINGS['event:success'], $STRINGS['user:create:success']) : $alert = BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:create:failed']);

            $this->_view = new AdminUsersView(UserModel::find_all(), $alert);
        } else if (!$valid && !$duplicate) {
            $this->_view =
                    new AdminUserCreateView(BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:create:failed']));
        } else if ($duplicate) {
            $this->_view =
                    new AdminUsersView(UserModel::find_all(),
                            BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:create:duplicate']));
        }
    }

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

        ($result == true) ? $alert = BootstrapHelper::alert('success', $STRINGS['event:success'], $STRINGS['user:delete:success']) : $alert = BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:delete:failed']);

        $this->_view = new AdminActivityView(ActivityModel::find_all(), $alert);
    }

    public function users_update($params) {
        global $STRINGS;

        $userid = array_shift($params);
        //remove url params
        $params = array_slice($params, 1);

        $success = UserModel::update($userid, $params);
        ($success == true) ? $alert = BootstrapHelper::alert('success', $STRINGS['event:success'], $STRINGS['user:update:success']) : $alert = BootstrapHelper::alert('error', $STRINGS['event:error'], $STRINGS['user:update:failed']);

        $this->_view = new AdminUserDetailsView(UserModel::find($userid), $alert);
    }

    public function report() {
        $this->_view = new AdminReportView(UserModel::find_all());
    }

    public function report_build($params) {
        $formdata = (object) $params;
        $this->_view = new AdminReportShowView(UserModel::find($formdata->user),
                        IntervalModel::get_range_total($formdata), IntervalModel::get_between($formdata));
    }

    public function notifications() {
        $this->_view = new NotificationsView(NotificationModel::find_all_by_status('pending'));
    }
}