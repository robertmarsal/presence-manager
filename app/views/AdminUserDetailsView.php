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
				<li><a href="' . $CONFIG['wwwroot'] . '/admin/activity">Activity</a></li>
				<li class="active"><a href="' . $CONFIG['wwwroot'] . '/admin/users">Users</a></li>
			</ul>
			<ul class="nav pull-right">
				<li><a href="' . $CONFIG['wwwroot'] . '/auth/logout">Log Out</a></li>
			</ul>';
	}

	public function content(){

		global $CONFIG;

		$selected_user = $this->_user['role'] == 'user' ? 'SELECTED' : '';
		$selected_admin = $this->_user['role'] == 'admin' ? 'SELECTED' : '';

		return '
        <div class="subnav-fixed">
            <div class="subnav-fixed-inner">
                <div class="container">
                <ul class="subnav-pills">
                    <li class="active-pill"><a href="'.$CONFIG['wwwroot'].'/admin/user_details/'.$this->_user['id'].'">Details</a></li>
                    <li><a href="'.$CONFIG['wwwroot'].'/admin/user_activity/'.$this->_user['id'].'">Activity</a></li>
                    <li><a href="#">Statistics</a></li>
                    <li><a href="#">Summary</a></li>
			        <li><a href="'.$CONFIG['wwwroot'].'/admin/user_account/'.$this->_user['id'].'">Account</a></li>
                    <li class="id-tab">'.$this->_user['firstname'].' '.$this->_user['lastname'].'</li>
                </ul>
                </div>
            </div>
        </div>

		<section id="details">
			<form class="form-stacked left-form" method="post" action="'.$CONFIG['wwwroot'].'/admin/update_user/'.$this->_user['id'].'">
				<fieldset>
					<div class="clearfix">
						<label for="firstname">First Name</label>
						<div class="input">
						<input class="xlarge" id="xlInput" name="firstname" size="30" type="text" value="'.$this->_user['firstname'].'" />
						</div>
					</div><!-- /clearfix -->
					<div class="clearfix">
						<label for="lastname">Last Name</label>
						<div class="input">
						<input class="xlarge" id="xlInput" name="lastname" size="30" type="text" value="'.$this->_user['lastname'].'"/>
						</div>
					</div><!-- /clearfix -->
					<div class="clearfix">
						<label for="email">Email</label>
						<div class="input">
						<input class="xlarge" id="xlInput" name="email" size="30" type="text" value="'.$this->_user['email'].'"/>
						</div>
					</div><!-- /clearfix -->
					<div class="clearfix">
						<label for="role">Role</label>
						<div class="input">
						<select name="role" class="span5" id="stackedSelect">
							<option '.$selected_user.'>user</option>
							<option '.$selected_admin.'>admin</option>
						</select>
					</div>
					</div><!-- /clearfix -->
					<div class="custom-actions">
                        <input type="submit" class="btn primary" value="Save Changes">&nbsp;
                        <button type="reset" class="btn">Cancel</button>
                    </div>
				</fieldset>
			</form>
		<section>
		';

	}

}
