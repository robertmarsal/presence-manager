<?php

class UserController extends Controller {

    /**
     * Checks the role and if the called action exists
     *
     * @global Object $CONFIG
     * @param String $action
     * @param Array $params
     */
    public function __construct($action, $params) {
        global $CONFIG;
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
    function activity() {
        $user = UserModel::find_by_email($_SESSION['user']);
        $this->_view = new UserActivityView(ActivityModel::find_all_by_user($user->id));
    }
}
