<?php

class UserModel extends Model {

    public function __construct($dependencies) {
        parent::__construct($dependencies);

        $this->_table = 'presence_users';
    }

    public function getAllUsers() {

        $sql = "SELECT *
				FROM " . $this->_table . "
				ORDER BY lastname ASC";

        $st = $this->_db->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserData($userid) {

        $sql = "SELECT email, firstname, lastname, role
                FROM " . $this->_table . "
                WHERE `id` = ?";

        $st = $this->_db->prepare($sql);
        $st->execute(array($userid));
        return $st->fetch(PDO::FETCH_ASSOC);
    }

}