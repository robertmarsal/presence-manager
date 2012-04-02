<?php

class BootstrapHelper extends Helper{

    static function alert($type, $title, $message){    
        return '
            <div class="alert fade in alert-'.$type.'">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <strong>'.$title.'</strong>&nbsp;'.$message.'
            </div>';
    }
    
    static function get_event_description($event) {
        global $STRINGS;
        switch ($event) {
            case 'checkin': return $STRINGS['event:checkin'];
            case 'checkout': return $STRINGS['event:checkout'];
            case 'incidence': return $STRINGS['event:incidence'];
		}
	}

    static function get_label_for_action($action){
       switch ($action) {
            case 'checkin': return 'label-success';
            case 'checkout': return 'label-important';
            case 'incidence': return 'label-warning';
		}
    }
}
