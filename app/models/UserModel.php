<?php

class UserModel extends Model {

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
