<?php

class Helper{

    static function alert($type, $message){

        return '
            <div class="alert-message '.$type.' fade in" data-alert="alert">
                <a class="close" href="#">×</a>
                <p><strong>'.$message.'</strong></p>
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
            case 'checkout': return '';
            case 'incidence': return 'label-warning';
		}
    }

	static function redirect($url){
		header('Location: '.$url);
	}
	
}
