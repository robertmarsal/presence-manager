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

    public function find_all(){
        $sql = "SELECT *
                FROM ".$this->_table;

        return DB::getAllRecords($this->_db, $sql);
    }
	
	public function create($record){
		return DB::putRecord($this->_db, $this->_table, $record);
	}
}