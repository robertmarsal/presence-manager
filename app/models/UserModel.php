<?php

class UserModel extends Model {

    public function __construct($dependencies) {
        parent::__construct($dependencies);

        $this->_table = 'presence_users';
    }

    public function get_all_users() {

        $sql = "SELECT *
				FROM " . $this->_table . "
				ORDER BY lastname ASC";

        $st = $this->_db->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_user_data($userid) {

        $sql = "SELECT id, email, firstname, lastname, role
                FROM " . $this->_table . "
                WHERE `id` = ?";

        $st = $this->_db->prepare($sql);
        $st->execute(array($userid));
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function create_user($user){

        $sql = "INSERT INTO ".$this->_table."
                    (email, password, role, firstname, lastname)
                VALUES (?, ?, ?, ?, ?)";

        $st = $this->_db->prepare($sql);
        return $st->execute(array($user['email'], md5($user['password']),$user['role'],
            $user['firstname'], $user['lastname']));
    }

    public function update_user($userid, $params){

        if(isset($userid)){

            $update_params = array();
            foreach($params as $key => $param){
                $update_params [] = '`'.$key.'`="'.$param.'"';
            }

            $sql = "UPDATE " . $this->_table . "
                    SET ".implode(',', $update_params)."
                    WHERE `id` = ?";

            $st = $this->_db->prepare($sql);
            return $st->execute(array($userid));
        }

    }

	public function delete_user($userid){

		if (isset($userid)){

			$sql = "DELETE FROM ".$this->_table."
					WHERE `id` = ?";

			$st = $this->_db->prepare($sql);
            return $st->execute(array($userid));
		}
	}

}