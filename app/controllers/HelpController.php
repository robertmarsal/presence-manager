<?php

class HelpController extends Controller {

	public function __construct($action, $params) {

		// check if the required action is defined
		if (method_exists($this, $action)) {
            $this->$action($params);
		}
    }

    private function main() {
        $this->_view = new HelpView();
    }

}