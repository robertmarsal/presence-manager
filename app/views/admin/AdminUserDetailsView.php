<?php

class AdminUserDetailsView extends View{

    public function title(){
    	global $STRINGS;
    	return $STRINGS['user'];
    }
    
	public function menu(){
        return MenuHelper::admin_base_menu('users');
	}

	public function content(){

		global $CONFIG, $STRINGS;

		$selected_user = $this->_data->user->role == 'user' ? 'SELECTED' : '';
		$selected_admin = $this->_data->user->role == 'admin' ? 'SELECTED' : '';

		return '
        <section id="user-details" class="well">
        '.MenuHelper::admin_submenu('details', $this->_data->user).'
            <form action="'.$CONFIG->wwwroot.'/admin/users/'.$this->_data->user->id.'/update"  method="post">
                <label>'.$STRINGS['firstname'].'</label>
                <input type="text" name="firstname" value="'.$this->_data->user->firstname.'">

                <label>'.$STRINGS['lastname'].'</label>
                <input type="text" name="lastname" value="'.$this->_data->user->lastname.'">

                <label>'.$STRINGS['identifier'].'</label>
                <input type="text" name="identifier" value="'.$this->_data->user->identifier.'">

                <label>'.$STRINGS['position'].'</label>
                <input type="text" name="position" value="'.$this->_data->user->position.'">

                <label>'.$STRINGS['role'].'</label>
                <select name="role">
                    <option '.$selected_user.'>user</option>
                    <option '.$selected_admin.'>admin</option>
                </select>
                <label></label>
                <button type="submit" class="btn">'.$STRINGS['update'].'</button>
            </form>
        </section>';
	}

}
