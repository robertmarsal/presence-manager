<?php

class Model{
    
    protected $_db;
    protected $_table;
    
    public function __construct($db){
        $this->_db = $db;
    }
}