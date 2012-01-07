<?php

class AdminUserView extends View{

	private $_user;

    public function __construct($user) {

        global $string;

        $this->_user = $user;
        $this->title($string['user']);
    }
	
	public function menu(){
		
		global $config;

        return '
        <div class="topbar" id="topbar-container">
			<div class="topbar-inner">
				<div class="container">
					<a class="brand" href="' . $config['wwwroot'] . '">Presence</a>
					<ul class="nav">
						<li><a href="' . $config['wwwroot'] . '/admin/activity">Activity</a></li>
						<li class="active"><a href="' . $config['wwwroot'] . '/admin/users">Users</a></li>
					</ul>
					<ul class="nav secondary-nav">
						<li><a href="' . $config['wwwroot'] . '/auth/logout">Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>';
	}
	
	public function content(){

		global $config;
	
		$selected_user = $this->_user['role'] == 'user' ? 'SELECTED' : '';
		$selected_admin = $this->_user['role'] == 'admin' ? 'SELECTED' : '';
		
		return '
		<section id="details">
			<div class="page-header">
				<h3>Details</h1>
			</div>
			<form class="form-stacked" action="'.$config['wwwroot'].'/admin/modUser/">
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
					<div class="clearfix">
                        <input type="submit" class="btn primary" value="Save Changes">&nbsp;
                        <button type="reset" class="btn">Cancel</button>
                        </div>

				</fieldset>
			</form>
		<section>
		<section id="activity">
			<div class="page-header">
				<h3>Activity</h1>
			</div>
		</section>
		';
		
	}

}