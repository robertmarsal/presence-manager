<?php

class UserController extends Controller {

    private $_db;

    public function __construct($dependencies, $action, $params) {

        global $config;

        // get the connection to the database from the dependencies container
        $this->_db = $dependencies->get_db();

        // check if is user and the required action is defined
        if ($this->check_role('user') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            header('Location: ' . $config['wwwroot'] . '/error/notfound');
        }
    }

    public function activity($params) {

		global $config;

        $count = isset($params['count']) ? $params['count'] : 10;
	
		$raw_activity_entries = file_get_contents($config['api_root'].'/?method=user&action=getActivity&api_key='.$config['api_key'].'&userid='.$_SESSION['user'].'&count='.$count);

		$activity_entries = json_decode($raw_activity_entries, true);

        $this->_view = new UserActivityView($activity_entries);
    }

}