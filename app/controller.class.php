<?php

class Controller {

    /**
     * Contains the data to be passed to the view
     * 
     * @var type Object
     */
    private $_data;
    
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