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
            case 'success': return 'Check-In';
            case 'important': return 'Check-Out';
            case 'warning': return 'Incidence';
		}
	}
	
	static function redirect($url){
		header('Location: '.$url);
	}
		
}