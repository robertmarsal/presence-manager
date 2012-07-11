<?php

class UserProfileView extends View {
	
	private $_userdata;
	
	public function __construct($userdata) {

        global $STRINGS;

        $this->_userdata = $userdata;

        $this->title($STRINGS['profile']);
    }
    
    public function menu(){
    	return MenuHelper::user_base_menu('profile');
    }
    
    public function content(){
    	
    	return '
    	<section id="user-profile" class="well">
    	
    	</section>';
    }

}