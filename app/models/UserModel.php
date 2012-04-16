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
     * Returns the id of the user identified by the email passed as a parameter
     *
     * @param String $email
     * @return Int
     */
    public static function find_by_email($email){
        $sql = "SELECT id
                FROM ".self::table()."
                WHERE `email` = ?";

		return DB::getRecord($sql, array($email));
    }
}
