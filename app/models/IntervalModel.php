<?php

class IntervalModel extends Model{

     public function __construct($dependencies) {
        parent::__construct($dependencies);
        
        $this->_table = 'presence_intervals';
     }
      
     public function store($intervals){
     
        foreach($intervals as $interval){
           
            $sql = "INSERT INTO ".$this->_table."
                    (userid, timestart, timestop, y, m ,h ,d ,i ,s)
                    VALUES(?,?,?,?,?,?,?,?,?)";
            $st = $this->_db->prepare($sql);
            $status = $st->execute(array($interval->userid, $interval->timestart, $interval->timestop,
                                  $interval->y, $interval->m, $interval->h, $interval->d,
                                  $interval->i, $interval->s));
        }

        return $status;
     }

}
