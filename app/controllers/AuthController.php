<?php

class AuthController extends Controller {

    private $_db;

    public function __construct(DependencyContainer $dependencies, $action, $params) {

        // get the connection to the database from the dependencies container
        $this->_db = $dependencies->get_db();

        // check if the required action is defined
        if (method_exists($this, $action)) {
            $this->$action($params);
        }
    }

    private function login($params) {

        global $CONFIG;
        //TO DO: sanitize input
        $sql = "SELECT *
                FROM presence_users
                WHERE `email` = ?
                AND `password` = ?";

		$result = DB::getRecord($this->_db, $sql, array($params['email'], md5($params['password'])));

        if ($result) {
            $_SESSION['user'] = $result['email'];
            $_SESSION['role'] = $result['role'];

            header('Location: ' . $CONFIG->wwwroot . '/' . $result['role'] . '/activity/');
        } else {
            header('Location: ' . $CONFIG->wwwroot);
        }
    }

    private function logout() {

        global $CONFIG;

        session_unset();
        session_destroy();

        header('Location: ' . $CONFIG->wwwroot);
    }

    private function asklogin() {
        $this->view = new LoginView();
    }

}