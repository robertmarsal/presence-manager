<?php

class IntervalModel extends Model{

     public function __construct($dependencies) {
        parent::__construct($dependencies);

        $this->_table = 'presence_intervals';
     }

     public function store($intervals){

        return DB::putRecords($this->_table, $intervals);

     }

	 public function get_user_summary($userid){

		$sql = "SELECT *
				FROM ".$this->_table."
				WHERE `userid` = ?
				ORDER BY year,month,week";

		return DB::getAllRecords($sql, array($userid));

	 }

	 public function get_range_total($params){

		$sql = "SELECT SEC_TO_TIME(SUM(timediff)) as total
				FROM ".$this->_table."
				WHERE timestart BETWEEN ? AND ?
                AND `userid` = ?";

		$result = DB::getRecord($sql , array(strtotime($params->dp_start),
                                                         strtotime($params->dp_end),
                                                         $params->user));

		$result->timestart = $params->dp_start;
		$result->timeend = $params->dp_end;

		return $result;
	 }

}
