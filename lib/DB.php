<?php

class DB {

    private static $_instance;
    private $_connection;

    private static function getInstance(){
        if(self::$_instance == null){
            $class = __CLASS__;
            self::$_instance = new $class();
        }

        return self::$_instance;
    }

    public static function setUp($params){
        $db = self::getInstance();
        $db->_connection = new PDO("mysql:host=" . $params->dbhost . ";
                                    dbname=" . $params->dbname,
                                               $params->dbuser,
                                               $params->dbpassword);

    }

    public static function getDB(){
        $db = self::getInstance();
        return $db->_connection;
    }

	static function getRecord($sql, array $params){
        $st = self::getDB()->prepare($sql);
		$st->execute($params);
		return $st->fetch(PDO::FETCH_OBJ);
	}

	static function getAllRecords($sql, array $params = null){

		$st = self::getDB()->prepare($sql);
        $st->execute($params);
        return $st->fetchAll(PDO::FETCH_OBJ);
	}

    static function putRecord($table, $record){

        if(!$record){
            return false;
        }else{

            foreach($record as $field => $value){
               $fields[] = $field;
               $values[] = '?';
               $params[] = $value;
            }

            if($fields && $values && $params){

                $sql = "INSERT INTO ".$table."
                       (".implode(',', $fields).")
                        VALUES(".implode(',', $values).")";

                $st = self::getDB()->prepare($sql);
                return $st->execute($params);

            }
       }
    }

    static function putRecords($table, $records){

        foreach($records as $record){
            DB::putRecord($table, $record);
        }

    }

    static function deleteRecord($table, $id){

        if(empty($id)){
            return null;
        }

        $sql = "DELETE FROM ".$table."
			    WHERE `id` = ?";

		$st = self::getDB()->prepare($sql);
        return $st->execute(array($id));
    }

    static function deleteAllRecordsByField($table, $field, $id){

        if(empty($id) || empty($field)){
            return null;
        }

        $sql = "DELETE FROM ".$table."
			    WHERE `".$field."` = ?";

		$st = self::getDB()->prepare($sql);
        return $st->execute(array($id));
    }

    static function updateRecord($table, $id, $fields){

        if(empty($id)){
            return null;
        }

        $update_params = array();
        foreach($fields as $key => $field){
            $update_params [] = '`'.$key.'`="'.$field.'"';
        }

        $sql = "UPDATE " . $table . "
                SET ".implode(',', $update_params)."
                WHERE `id` = ?";

        $st = self::getDB()->prepare($sql);
        return $st->execute(array($id));
    }

    static function runSQL($sql, array $params){
        $st = self::getDB()->prepare($sql);
		return $st->execute($params);
    }
}
