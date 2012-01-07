<?php

class ActivityModel extends Model{
    
    public function __construct($db){
        parent::__construct($db);
        
        $this->table = 'presence_activity';
    }
    
    public function getAllActivity(){
        
        $sql = "SELECT pu.id, pa.userid, pa.action, pa.timestamp, pu.firstname, pu.lastname, pu.email
				FROM ".$this->_table." pa
				JOIN presence_users pu ON pa.userid = pu.id
				ORDER BY pa.timestamp DESC LIMIT 100";

        $st = $this->_db->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);

    }
}