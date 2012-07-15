<?php

class UserModel extends Model {

    public static function find_page($page){

        $limit = 10;

		$sql = "SELECT *
				FROM " . self::table() . "
                LIMIT ".$limit." OFFSET ".($limit*$page);

		return DB::getAllRecords($sql);
    }

    /**
     * Returns the id of the user identified by the identifier passed as a parameter
     *
     * @param String $identifier
     * @return Int
     */
    public static function find_by_identifier($identifier){
        $sql = "SELECT id, firstname, lastname, identifier
                FROM ".self::table()."
                WHERE `identifier` = ?";

		return DB::getRecord($sql, array($identifier));
    }
}
