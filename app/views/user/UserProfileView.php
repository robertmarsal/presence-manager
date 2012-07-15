<?php

class UserProfileView extends View {
    
    public function menu(){
    	return MenuHelper::user_base_menu('profile');
    }
    
    public function content(){
    	
    	global $CONFIG, $STRINGS;
    	
    	parent::title($STRINGS['profile']);
    	
    	return '
    	<section id="user-profile" class="well">
    		<form action="'.$CONFIG->wwwroot.'/user/profile/'.$this->_data->user->id.'/update"  method="post">
    			<label>'.$STRINGS['firstname'].'</label>
                <input type="text" name="firstname" value="'.$this->_data->user->firstname.'">

                <label>'.$STRINGS['lastname'].'</label>
                <input type="text" name="lastname" value="'.$this->_data->user->lastname.'">
    		
                <label>'.$STRINGS['identifier'].'</label>
                <input type="text" name="identifier" value="'.$this->_data->user->identifier.'">
                
    			<label></label>
            	<button type="submit" class="btn">'.$STRINGS['update'].'</button>
    		</form>
    	</section>';
    }
}