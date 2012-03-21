<?php

class UserModel extends Model {

    public static function find_by_email($email){

        $sql = "SELECT id
                FROM ".self::table()."
                WHERE `email` = ?";

		return DB::getRecord($sql, array($email));
    }
}
