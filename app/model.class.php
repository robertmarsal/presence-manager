<?php

class Model{

    protected $_db;
    protected $_table;

    public function __construct($dependencies){
        $this->_db = $dependencies->get_db();
    }
}