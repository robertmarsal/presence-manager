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
		$db = DB::getDB();
        $st = $db->prepare($sql);
		$st->execute($params);
		return $st->fetch(PDO::FETCH_OBJ);
	}

	static function getAllRecords($db, $sql, array $params = null){

		$st = $db->prepare($sql);
        $st->execute($params);
        return $st->fetchAll(PDO::FETCH_OBJ);
	}

    static function putRecord($db, $table, $record){

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

                $st = $db->prepare($sql);
                return $st->execute($params);

            }
       }
    }

    static function putRecords($db, $table, $records){

        foreach($records as $record){
            DB::putRecord($db, $table, $record);
        }

    }
}
