<?php

class DB {
	
	static function getRecord($db, $sql, $params){
	
		$st = $db->prepare($sql);
		$st->execute($params);
		return $st->fetch(PDO::FETCH_ASSOC);
		
	}
	
	
}
