<?php

class ErrorController extends Controller {

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
     * Displays the 404 not found page
     */
    private function notfound() {
        $this->_view = new NotFoundView();
    }
}