<?php

abstract class Model{

    /**
     * Returns a single record, containing all the information, identified by
     * the id parameter, from the table corresponding to the model
     *
     * @param Int $id
     * @return Object
     */
    public static function find($id){
        $sql = "SELECT *
                FROM ".self::table()."
                WHERE `id` = ?";

        return DB::getRecord($sql, array($id));
    }

    /**
     * Return all the records, from the table corresponding to the model
     *
     * @return Array
     */
    public static function find_all(){
        $sql = "SELECT *
                FROM ".self::table();

        return DB::getAllRecords($sql);
    }

    /**
     * Inserts the record object, received as a parameter into the table of the
     * model
     *
     * @param Object $record
     * @return Boolean
     */
	public static function create($record){
		return DB::putRecord(self::table(), $record);
	}

   /**
    * Deletes the record, identified by the id parameter, from the table of the
    * model
    *
    * @param Int $id
    * @return Boolean
    */
    public static function delete($id){
        return DB::deleteRecord(self::table(), $id);
    }

    /**
     * Updates a database row, identified by the id parameter, with the values
     * contained in the associative array fields
     *
     * @param Int $id
     * @param Array $fields
     * @return Boolean
     */
    public static function update($id, array $fields){
        return DB::updateRecord(self::table(), $id, $fields);
    }

    /**
     * Returns the name of the table corresponding to the model
     *
     * @return String
     */
    protected static function table(){
        $prefix = 'presence_';
        $caller = get_called_class();
        $class = lcfirst(substr($caller, 0, -5));

        return $prefix.self::pluralise($class);
    }

    /**
     * Returns the number of available pages for a table. 10 rows per page
     *
     * @return int $pages
     */
    public static function pages(){

        $sql = "SELECT COUNT(*) as count
                FROM ".self::table();

        $total = DB::getRecord($sql,array());

        ($total->count % 10) > 0 ? $rest = 1 : $rest = 0;

        return (int)(($total->count - ($total->count % 10)) / 10) + $rest;
    }

    /**
     * Returns a pluralised version of a word (very basic)
     * DO NOT USE OUTSIDE THIS CLASS!
     *
     * @param String $word
     * @return String
     */
    private static function pluralise($word){
        $exceptions = array();
        $exceptions['activity'] = 'activity';
        $exceptions['auth'] = 'auth';

        empty($exceptions[$word])
            ? $plural = $word.'s'
            : $plural = $exceptions[$word];

        return $plural;
    }
}