<?php

class IntervalModel extends Model{

     public function __construct($dependencies) {
        parent::__construct($dependencies);
        
        $this->_table = 'presence_intervals';
     }
      
     public function store($intervals){
     
        return DB::putRecords($this->_db, $this->_table, $intervals);

     }
	 
	 public function get_user_summary($userid){
	 
		$sql = "SELECT *
				FROM ".$this->_table."
				WHERE `userid` = ?
				ORDER BY year,month,week";
				
		return DB::getAllRecords($this->_db, $sql, array($userid));
	 
	 }
	 
	 public function get_range_total($params){
		
		$sql = "SELECT SEC_TO_TIME(SUM(timediff)) as total
				FROM ".$this->_table."
				WHERE timestart BETWEEN ? AND ?";
				
		$result = DB::getRecord($this->_db, $sql , array(strtotime($params->dp_start), strtotime($params->dp_end)));
		
		$result->timestart = $params->dp_start;
		$result->timeend = $params->dp_end;
		
		return $result;
	 }

}
