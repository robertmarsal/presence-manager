<?php

class IntervalModel extends Model{

     public static function create_multiple($records){
         return DB::putRecords(self::table(), $records);
     }

     /**
      * Returns the last 10 records ordered by timestart in reversed order
      * 
      * @param type $user
      * @return type 
      */
     public static function find_last($user){
         
         $sql = "SELECT *
                 FROM ".self::table()."
                 WHERE `userid` = ?
                 ORDER BY timestart DESC
                 LIMIT 10";
         
         return DB::getAllRecords($sql,array($user));
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
