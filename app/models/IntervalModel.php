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

}
