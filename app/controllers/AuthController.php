<?php

class AuthController extends Controller {

    /**
     * Checks if the called action exists and calls it if so
     *
     * @param String $action
     * @param Array $params
     */
    public function __construct($action, $params) {
        // check if the required action is defined
        if (method_exists($this, $action)) {
            $this->$action($params);
        }
    }

    /**
     * Validates the user, and sets the language
     *
     * @global Object $CONFIG
     * @param Array $params
     */
    private function login($params) {

        global $CONFIG;

        $sql = "SELECT *
                FROM presence_users
                WHERE `identifier` = ?
                AND `password` = ?";

		$result = DB::getRecord($sql, array($params['identifier'], sha1($params['password'])));

        if ($result) {
            $_SESSION['user'] = $result->identifier;
            $_SESSION['role'] = $result->role;

            //set language
            $_SESSION['lang'] = $params['lang'];

            RoutingHelper::redirect($CONFIG->wwwroot . '/' . $result->role . '/activity/');
        } else {
            RoutingHelper::redirect($CONFIG->wwwroot);
        }
    }

    /**
     * Closes the user session
     *
     * @global Object $CONFIG
     */
    private function logout() {

        global $CONFIG;

        session_unset();
        session_destroy();

        RoutingHelper::redirect($CONFIG->wwwroot);

    }

    /**
     * Redirects to the main login form
     */
    private function asklogin() {
        new LoginView();
    }
}