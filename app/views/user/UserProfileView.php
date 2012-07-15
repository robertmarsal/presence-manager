<?php

class UserProfileView extends View {
	
	private $_user;
	
	public function __construct($user, $alert = null) {

        global $STRINGS;

        $this->_user= $user;
		$this->_alert = $alert;
        $this->title($STRINGS['profile']);
    }
    
    public function menu(){
    	return MenuHelper::user_base_menu('profile');
    }
    
    public function content(){
    	
    	global $CONFIG, $STRINGS;
    	
    	return '
    	<section id="user-profile" class="well">
    		<form action="'.$CONFIG->wwwroot.'/user/profile/'.$this->_user->id.'/update"  method="post">
    			<label>'.$STRINGS['firstname'].'</label>
                <input type="text" name="firstname" value="'.$this->_user->firstname.'">

                <label>'.$STRINGS['lastname'].'</label>
                <input type="text" name="lastname" value="'.$this->_user->lastname.'">
    		
                <label>'.$STRINGS['identifier'].'</label>
                <input type="text" name="identifier" value="'.$this->_user->identifier.'">
                
    			<label></label>
            	<button type="submit" class="btn">'.$STRINGS['update'].'</button>
    		</form>
    	</section>';
    }

}