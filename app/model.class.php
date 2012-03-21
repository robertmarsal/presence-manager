<?php

class Model{

    protected $_db;
    protected $_table;

    public function __construct($dependencies){
        $this->_db = $dependencies->get_db();
    }

    public static function find($id){

        $sql = "SELECT *
                FROM ".self::table()."
                WHERE `id` = ?";

        return DB::getRecord($sql, array($id));
    }

    public static function find_all(){
        $sql = "SELECT *
                FROM ".self::table();

        return DB::getAllRecords($sql);
    }

	public static function create($record){
		return DB::putRecord(self::table(), $record);
	}
    
    public static function delete($id){
        return DB::deleteRecord(self::table(), $id);
    }

    public static function update($id, array $fields){
        return DB::updateRecord(self::table(), $id, $fields);
    }
    /**
     * Returns the name of the table corresponding to the model
     *
     * @return string
     */
    protected static function table(){
        $prefix = 'presence_';
        $caller = get_called_class();
        $class = lcfirst(substr($caller, 0, -5));

        return $prefix.self::pluralise($class);
    }

    /**
     * Returns a pluralised version of a word (very basic)
     *
     * @param type $word string
     * @return string
     */
    private static function pluralise($word){
        $exceptions = array();
        $exceptions['activity'] = 'activity';

        empty($exceptions[$word])
            ? $plural = $word.'s'
            : $plural = $exceptions[$word];

        return $plural;
    }
}