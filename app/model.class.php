<?php

class Model{

    protected $_db;
    protected $_table;

    public function __construct($dependencies){
        $this->_db = $dependencies->get_db();
    }
    
    public function find($id){
        $sql = "SELECT *
                FROM ".$this->_table."
                WHERE `id` = ?";
        
        return DB::getRecord($this->_db, $sql, array($id));
    }
}