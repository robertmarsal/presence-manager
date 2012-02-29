<?php

class AdminUserDetailsView extends View{

	private $_user;

    public function __construct($user, $alert = null) {
        parent::__construct($alert);

        global $STRINGS;

        $this->_user = $user;
        $this->_alert = $alert;

        $this->title($STRINGS['user']);
    }

	public function menu(){

		global $CONFIG;

        return '
			<ul class="nav">
				<li><a href="' . $CONFIG->wwwroot . '/admin/activity">Activity</a></li>
				<li class="active"><a href="' . $CONFIG->wwwroot . '/admin/users">Users</a></li>
				<li><a href="' . $CONFIG->wwwroot . '/admin/report">Report</a></li>
			</ul>
			<ul class="nav pull-right no-hover-a">
				<p class="navbar-text pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout">Log Out</a></p>
			</ul>';
	}

    public function subnav(){
    
        global $CONFIG;

        return '
		<ul class="nav nav-tabs">
            <li class="active"><a href="'.$CONFIG->wwwroot.'/admin/user_details/'.$this->_user['id'].'">Details</a></li>
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_activity/'.$this->_user['id'].'">Activity</a></li>
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_summary/'.$this->_user['id'].'">Summary</a></li>
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_account/'.$this->_user['id'].'">Account</a></li>
            <li class="id-tab">'.$this->_user['firstname'].' '.$this->_user['lastname'].'</li>
		</ul>';
    }

	public function content(){

		global $CONFIG;

		$selected_user = $this->_user['role'] == 'user' ? 'SELECTED' : '';
		$selected_admin = $this->_user['role'] == 'admin' ? 'SELECTED' : '';

		return '
        <section id="user-details">
            <form action="'.$CONFIG->wwwroot.'/admin/update_user/'.$this->_user['id'].'"  method="post">
                <label>First Name</label>
                <input type="text" name="firstname" value="'.$this->_user['firstname'].'">
                
                <label>Last Name</label>
                <input type="text" name="lastname" value="'.$this->_user['lastname'].'">
            
                <label>Email</label>
                <input type="text" name="email" value="'.$this->_user['email'].'">
           
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
