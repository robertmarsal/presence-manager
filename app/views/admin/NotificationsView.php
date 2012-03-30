<?php

class NotificationsView extends View{

    public function __construct() {
        global $STRINGS;
        $this->title($STRINGS['notifications']);
    }

    public function menu() {
        return MenuHelper::admin_base_menu('notifications');
    }

    public function content() {

    }

}
