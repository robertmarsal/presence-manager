<?php

class UserController extends Controller {

    private $_db;

    public function __construct($action, $params) {

        global $CONFIG;

        // check if is admin and if the required action is defined
        if ($this->check_role('user') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            Helperx::redirect($CONFIG->wwwroot . '/error/notfound');
        }


    }

    function activity($params) {
        
        $user = UserModel::find_by_email($_SESSION['user']);
        $this->_view = new UserActivityView(ActivityModel::find_all_by_user($user['id']));
    
    }

}
