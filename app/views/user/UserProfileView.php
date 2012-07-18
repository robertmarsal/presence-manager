<?php

class UserProfileView extends View {
    
	public function title(){
		global $STRINGS;
		return $STRINGS['profile'];
	}
	
    public function menu(){
    	return MenuHelper::user_base_menu('profile');
    }
    
    public function content(){
    	global $CONFIG, $STRINGS;
    	
    	return '
    	<section id="user-profile" class="well">
    		<form action="'.$CONFIG->wwwroot.'/user/profile/'.$this->_data->user->id.'/update"  method="post">
    			
    			<label>'.Lang::get('firstname').'</label>
                <input type="text" name="firstname" value="'.$this->_data->user->firstname.'">

                <label>'.Lang::get('lastname').'</label>
                <input type="text" name="lastname" value="'.$this->_data->user->lastname.'">
    		
                <label>'.Lang::get('identifier').'</label>
                <input type="text" name="identifier" value="'.$this->_data->user->identifier.'">
                
                <label>'.Lang::get('password').'</label>
                <input type="password" name="password" value="">
                
    			<label></label>
            	<button type="submit" class="btn">'.Lang::get('update').'</button>
    		</form>
    	</section>';
    }
}