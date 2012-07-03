<?php

class Controller {

    /**
     * Checks that the role assigned to this session corresponds to the one
     * passed as a parameter
     *
     * @param String $role
     * @return Boolean
     */
    protected function check_role($role) {
        return (!empty($_SESSION['role']) && $_SESSION['role'] == $role);
    }
}