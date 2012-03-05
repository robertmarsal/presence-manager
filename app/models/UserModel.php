<?php

class UserModel extends Model {

    public function __construct($dependencies) {
        parent::__construct($dependencies);

        $this->_table = 'presence_users';
    }

    public function get_user_by_email($email){

        $sql = "SELECT id
                FROM ".$this->_table."
                WHERE `email` = ?";

		return DB::getRecord($this->_db, $sql, array($email));
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
