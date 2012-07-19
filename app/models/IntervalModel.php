<?php

class IntervalModel extends Model{

	public static function find_all_by_week_and_user($userid, $week = null){
	
		// if the week is not provided set actual
		empty($week) ? $week = date("W") : null;
	
		$sql = "SELECT *
		FROM ".self::table()." pi
		WHERE week = ?
		AND pi.userid = ?";

		return DB::getAllRecords($sql, array($week, $userid));
	}
	
	
     public static function create_multiple($records){
         return DB::putRecords(self::table(), $records);
     }
     
     public static function find_all_by_user($user){

        $sql = "SELECT *
				FROM ".self::table()."
				WHERE `userid` = ?
				ORDER BY year,month,week";

		return DB::getAllRecords($sql, array($user));

     }

	 public static function get_range_total($params){

		$sql = "SELECT SEC_TO_TIME(SUM(timediff)) as total
				FROM ".self::table()."
				WHERE timestart BETWEEN ? AND ?
                AND `userid` = ?";

		$result = DB::getRecord($sql , array(strtotime($params->dp_start),
                                                         strtotime($params->dp_end),
                                                         $params->user));

		$result->timestart = $params->dp_start;
		$result->timeend = $params->dp_end;

		return $result;
	 }

     public static function get_between($params){

         $sql = "SELECT *
				 FROM ".self::table()."
				 WHERE timestart BETWEEN ? AND ?
                 AND `userid` = ?";

         return DB::getAllRecords($sql , array(strtotime($params->dp_start),
                                                         strtotime($params->dp_end),
                                                         $params->user));
     }

}
