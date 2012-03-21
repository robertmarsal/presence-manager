<?php

class UserModel extends Model {

    public function __construct($dependencies) {
        parent::__construct($dependencies);

        $this->_table = 'presence_users';
    }

    public static function find_by_email($email){

        $sql = "SELECT id
                FROM ".self::table()."
                WHERE `email` = ?";

		return DB::getRecord($sql, array($email));
    }
}
