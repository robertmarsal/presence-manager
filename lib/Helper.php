<?php

class Helper{

    static function alert($type, $message){

        return '
            <div class="alert fade in alert-'.$type.'">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <strong>'.$message.'</strong>
            </div>';

    }

	static function get_event_description($event) {
        switch ($event) {
            case 'checkin': return 'Check-In';
            case 'checkout': return 'Check-Out';
            case 'incidence': return 'Incidence';
		}
	}

    static function get_label_for_action($action){
       switch ($action) {
            case 'checkin': return 'label-success';
            case 'checkout': return 'label-important';
            case 'incidence': return 'label-warning';
		}
    }

	static function redirect($url){
		header('Location: '.$url);
	}
	
}
