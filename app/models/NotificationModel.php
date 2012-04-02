<?php

class NotificationModel extends Model{

    static function find_all_by_status($status){

        $sql = "SELECT pn.id, pu.id as userid, pu.firstname, pu.lastname, pn.type, pn.message
                FROM ".self::table()." pn
                JOIN presence_users pu ON pn.userid = pu.id
                WHERE pn.status = ?";

        return DB::getAllRecords($sql, array($status));
    }
}
