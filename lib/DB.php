<?php

class DB {

	static function getRecord($db, $sql, array $params){
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
