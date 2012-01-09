<?php

class Controller {

    protected $_view;
    protected $_dependencies;

    protected function check_role($role) {

        return (!empty($_SESSION['role']) && $_SESSION['role'] == $role);
    }

}