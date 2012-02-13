<?php

class DB {
	
	static function getRecord($db, $sql, $params){
	
		$st = $db->prepare($sql);
		$st->execute($params);
		return $st->fetch(PDO::FETCH_ASSOC);
		
	}
	
	static function getAllRecords($db, $sql, $params){
	
		$st = $db->prepare($sql);
        $st->execute($params);
        return $st->fetchAll(PDO::FETCH_ASSOC);
	}
	
}
