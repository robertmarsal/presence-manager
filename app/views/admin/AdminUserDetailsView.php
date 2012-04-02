<?php

class AdminUserDetailsView extends View{

	private $_user;

    public function __construct($user, $alert = null) {

        global $STRINGS;

        $this->_user = $user;
        $this->_alert = $alert;

        $this->title($STRINGS['user']);
    }

	public function menu(){
        return MenuHelper::admin_base_menu('users');
	}

	public function content(){

		global $CONFIG;

		$selected_user = $this->_user->role == 'user' ? 'SELECTED' : '';
		$selected_admin = $this->_user->role == 'admin' ? 'SELECTED' : '';

		return '
        <section id="user-details" class="well">
        '.MenuHelper::admin_submenu('details', $this->_user).'
            <form action="'.$CONFIG->wwwroot.'/admin/users/'.$this->_user->id.'/update"  method="post">
                <label>First Name</label>
                <input type="text" name="firstname" value="'.$this->_user->firstname.'">

                <label>Last Name</label>
                <input type="text" name="lastname" value="'.$this->_user->lastname.'">

                <label>Email</label>
                <input type="text" name="email" value="'.$this->_user->email.'">

                <label>Position</label>
                <input type="text" name="position" value="'.$this->_user->position.'">

                <label>Role</label>
                <select name="role">
                    <option '.$selected_user.'>user</option>
                    <option '.$selected_admin.'>admin</option>
                </select>
                <label></label>
                <button type="submit" class="btn">Update</button>
            </form>
        </section>';
	}

}
