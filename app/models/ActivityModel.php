<?php

class ActivityModel extends Model {

    public function __construct($dependencies) {
        parent::__construct($dependencies);

        $this->_table = 'presence_activity';
    }

    public function get_all_activity() {

		$sql = "SELECT pa.id, pa.userid, pa.action, pa.timestamp, pu.firstname, pu.lastname, pu.email
				FROM " . $this->_table . " pa
				JOIN presence_users pu ON pa.userid = pu.id
				ORDER BY pa.timestamp DESC";

		return DB::getAllRecords($this->_db, $sql, null);
    }
    
    public function get_user_activity($userid) {

        $sql = "SELECT pa.id, pa.userid, pa.action, pa.timestamp
				FROM " . $this->_table . " pa
				JOIN presence_users pu ON `userid` = pu.id
				WHERE `userid` = ?
				ORDER BY id DESC";

		return DB::getAllRecords($this->_db, $sql, array($userid));
    }

    public function get_user_activity_no_incidence($userid){
        
        $sql = "SELECT pa.id, pa.userid, pa.action , pa.timestamp
                FROM " . $this->_table . " pa
                JOIN presence_users pu ON `userid` = pu.id
                WHERE `userid` = ? AND pa.action != ? AND pa.computed = ?
                ORDER BY pa.timestamp ASC";
        
        return DB::getAllRecords($this->_db, $sql, array($userid, 'incidence', '0'));
    }

	public function delete_user_activity($userid){

		$sql = "DELETE FROM ".$this->_table."
					WHERE `userid` = ?";

        $st = $this->_db->prepare($sql);
        return $st->execute(array($userid));
	}
	
	public function mark_as_computed($entries){
			
		$sql = "UPDATE ".$this->_table."
				SET computed = ?
				WHERE id IN(".implode(',',$entries).")";
			
		$st = $this->_db->prepare($sql);
		return $st->execute(array('1'));
		
	}

}
