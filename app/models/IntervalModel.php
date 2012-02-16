<?php

class IntervalModel extends Model{

     public function __construct($dependencies) {
        parent::__construct($dependencies);
        
        $this->_table = 'presence_intervals';
     }
      
     public function store($intervals){
     
        return DB::putRecords($this->_db, $this->_table, $intervals);

     }

}
