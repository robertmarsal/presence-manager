<?php

class AdminController extends Controller {

    private $_db;

    public function __construct($dependencies, $action, $params) {

        global $config;

        // get the connection to the database from the dependencies container
        $this->_db = $dependencies->get_db();

        // check if is admin and if the required action is defined
        if ($this->check_role('admin') && method_exists($this, $action)) {
            $this->$action($params);
        } else {
            header('Location: ' . $config['wwwroot'] . '/error/notfound');
        }
    }

    public function activity($params) {

        // set maxrecords to 10 if is not set
        $max_records = isset($params['activity_maxrecords']) ? $params['activity_maxrecords'] : 10;

        $sql = "SELECT pu.id, pa.userid, pa.action, pa.timestamp, pu.firstname, pu.lastname, pu.email
				FROM presence_activity pa
				JOIN presence_users pu ON pa.userid = pu.id
				ORDER BY id DESC LIMIT " . $max_records;

        $st = $this->_db->prepare($sql);
        $st->execute();
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $activity_entries = $st->fetchAll();

        $this->_view = new AdminActivityView($activity_entries);
    }

    public function users() {

        $sql = "SELECT *
				FROM presence_users
				ORDER BY lastname ASC";
        $st = $this->_db->prepare($sql);
        $st->execute();
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $presence_users = $st->fetchAll();

        $this->_view = new AdminUsersView($presence_users);
    }

	public function viewUser($params){
		
		global $config;
	
		$raw_user_data = file_get_contents($config['api_root'].'/?method=user&action=getData&api_key='.$config['api_key'].'&userid='.$params[0]);

		$user = json_decode($raw_user_data, true);

		$this->_view = new AdminViewUserView($user);
	}
}