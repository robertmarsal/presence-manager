<?php

class ErrorController extends Controller {

    public function __construct($action, $params) {
        // check if the required action is defined
        if (method_exists($this, $action)) {
            $this->$action($params);
        }
    }

    private function notfound() {
        $this->_view = new NotFoundView();
    }

}