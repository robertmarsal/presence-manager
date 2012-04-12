<?php

class ActivityModel extends Model {

    public static function find_page($page) {

        $limit = 10;

		$sql = "SELECT pa.id, pa.userid, pa.action, pa.timestamp, pu.firstname, pu.lastname, pu.email
				FROM " . self::table() . " pa
				JOIN presence_users pu ON pa.userid = pu.id
				ORDER BY pa.timestamp DESC
                LIMIT ".$limit." OFFSET ".($limit*$page);

		return DB::getAllRecords($sql);
    }

    public static function find_all_by_user($user) {

        $sql = "SELECT pa.id, pa.userid, pa.action, pa.timestamp
				FROM " . self::table() . " pa
				JOIN presence_users pu ON `userid` = pu.id
				WHERE `userid` = ?
				ORDER BY id DESC";

		return DB::getAllRecords($sql, array($user));
    }

    public static function find_all_by_user_not_computed($user){

        $sql = "SELECT pa.id, pa.userid, pa.action , pa.timestamp
                FROM " . self::table() . " pa
                JOIN presence_users pu ON `userid` = pu.id
                WHERE `userid` = ? AND pa.action != ? AND pa.computed = ?
                ORDER BY pa.timestamp ASC";

        return DB::getAllRecords($sql, array($user, 'incidence', '0'));
    }

    public static function delete_all_by_user($user){
        return DB::deleteAllRecordsByField(self::table(), 'userid', $user);
    }

	public static function mark_as_computed($entries){

		$sql = "UPDATE ".self::table()."
				SET computed = ?
				WHERE id IN(".implode(',',$entries).")";

        return DB::runSQL($sql, array('1'));
	}

}
