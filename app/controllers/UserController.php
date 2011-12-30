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

        // set maxrecords to 10 if is not set
        $max_records = isset($params['activity_maxrecords']) ? $params['activity_maxrecords'] : 10;

        $sql = "SELECT paa.id, paa.userid, paa.action, paa.timestamp
				FROM presence_admin_activity paa
				JOIN presence_users pu ON paa.userid = pu.email
				WHERE pu.email = ?
				ORDER BY id DESC LIMIT " . $max_records;

        $st = $this->_db->prepare($sql);
        $st->execute(array($_SESSION['user']));
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $activity_entries = $st->fetchAll();

        $this->_view = new UserActivityView($activity_entries);
    }

}