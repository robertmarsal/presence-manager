<?php

class AdminUserAccountView extends View{

	private $_user;

    public function __construct($user) {

        global $STRINGS;

        $this->_user = $user;

        $this->title($STRINGS['user']);
    }

	public function menu(){

		global $CONFIG;
    
        return '
            <ul class="nav">
                <li><a href="' . $CONFIG->wwwroot . '/admin/activity">Activity</a></li>
                <li class="active"><a href="' . $CONFIG->wwwroot . '/admin/users">Users</a></li>
            </ul>
            <ul class="nav pull-right">
                <a class="btn btn-warning" href="' . $CONFIG->wwwroot . '/auth/logout">Log Out</a>
            </ul>';

	}

    public function subnav(){
    
        global $CONFIG;

        return '
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_details/'.$this->_user['id'].'">Details</a></li>
            <li><a href="'.$CONFIG->wwwroot.'/admin/user_activity/'.$this->_user['id'].'">Activity</a></li>
            <li><a href="#">Statistics</a></li>
            <li><a href="#">Summary</a></li>
            <li class="active-pill"><a href="'.$CONFIG->wwwroot.'/admin/user_account/'.$this->_user['id'].'">Account</a></li>
            <li class="id-tab">'.$this->_user['firstname'].' '.$this->_user['lastname'].'</li>';
    }

	public function content(){

		global $CONFIG;

		return '
		<section id="user-account" class="well">
			<form action="' . $CONFIG->wwwroot . '/admin/delete_user" method="post">
                <input type="submit" class="btn btn-danger" value="Delete Account">
                    <span class="help-inline">Warning! This action can not be undone!</span>
				<input type="hidden" name="userid" value="'.$this->_user['id'].'">
			</form>
		</section>
		';

	}
}
