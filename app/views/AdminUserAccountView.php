<?php

class AdminUserAccountView extends View{

	private $_user;

    public function __construct($user) {

        global $string;

        $this->_user = $user;

        $this->title($string['user']);
    }

	public function menu(){

		global $config;

        return '
			<ul class="nav">
				<li><a href="' . $config['wwwroot'] . '/admin/activity">Activity</a></li>
				<li class="active"><a href="' . $config['wwwroot'] . '/admin/users">Users</a></li>
                <li><a href="' . $config['wwwroot'] . '/admin/help">Help</a></li>
			</ul>
			<ul class="nav secondary-nav">
				<li><a href="' . $config['wwwroot'] . '/auth/logout">Log Out</a></li>
			</ul>';
	}

	public function content(){

		global $config;

		return '
        <ul class="tabs">
            <li><a href="'.$config['wwwroot'].'/admin/user_details/'.$this->_user['id'].'">Details</a></li>
            <li><a href="'.$config['wwwroot'].'/admin/user_activity/'.$this->_user['id'].'">Activity</a></li>
            <li><a href="#">Statistics</a></li>
            <li><a href="#">Summary</a></li>
			<li class="active"><a href="'.$config['wwwroot'].'/admin/user_account/'.$this->_user['id'].'">Account</a></li>
            <li class="id-tab">'.$this->_user['firstname'].' '.$this->_user['lastname'].'</li>
        </ul>
		<section id="account">
			<form action="' . $config['wwwroot'] . '/admin/delete_user" method="post">
				<input type="submit" class="btn danger" value="Delete Account"> This action cannot be undone!
				<input type="hidden" name="userid" value="'.$this->_user['id'].'">
			</form>
		</section>
		';

	}
}