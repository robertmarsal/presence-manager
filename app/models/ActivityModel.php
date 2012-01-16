<?php

class ActivityModel extends Model {

    public function __construct($dependencies) {
        parent::__construct($dependencies);

        $this->_table = 'presence_activity';
    }

    public function get_all_activity() {

		$sql = "SELECT pu.id, pa.userid, pa.action, pa.timestamp, pu.firstname, pu.lastname, pu.email
				FROM " . $this->_table . " pa
				JOIN presence_users pu ON pa.userid = pu.id
				ORDER BY pa.timestamp DESC LIMIT 15";

        $st = $this->_db->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_user_activity($userid) {

        $sql = "SELECT pa.id, pa.userid, pa.action, pa.timestamp
				FROM " . $this->_table . " pa
				JOIN presence_users pu ON `userid` = pu.id
				WHERE `userid` = ?
				ORDER BY id DESC LIMIT 15";

        $st = $this->_db->prepare($sql);
        $st->execute(array($userid));
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
	
	public function delete_user_activity($userid){
		
		$sql = "DELETE FROM ".$this->_table."
					WHERE `userid` = ?";

        $st = $this->_db->prepare($sql);
        $st->execute(array($userid));
	}

}