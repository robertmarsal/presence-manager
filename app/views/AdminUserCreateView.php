<?php

class AdminUserCreateView extends View {

    public function __construct($alert = null) {
        parent::__construct($alert);
    }


    public function menu() {
        global $CONFIG;

        return '
			<ul class="nav">
				<li><a href="' . $CONFIG['wwwroot'] . '/admin/activity">Activity</a></li>
				<li class="active"><a href="' . $CONFIG['wwwroot'] . '/admin/users">Users</a></li>
                <li><a href="' . $CONFIG['wwwroot'] . '/admin/help">Help</a></li>
			</ul>
			<ul class="nav secondary-nav">
				<li><a href="' . $CONFIG['wwwroot'] . '/auth/logout">Log Out</a></li>
			</ul>';
    }

    public function content() {
        global $CONFIG, $STRINGS;

        return '
			<form class="form-stacked left-form" method="post" action="' . $CONFIG['wwwroot'] . '/admin/create_user">
				<fieldset>
					<div class="clearfix">
						<label for="firstname">First Name</label>
						<div class="input">
						<input class="xlarge" id="xlInput" name="firstname" size="30" type="text"/>
						</div>
					</div>
					<div class="clearfix">
						<label for="lastname">Last Name</label>
						<div class="input">
						<input class="xlarge" id="xlInput" name="lastname" size="30" type="text"/>
						</div>
					</div>
					<div class="clearfix">
						<label for="email">Email</label>
						<div class="input">
						<input class="xlarge" id="xlInput" name="email" size="30" type="text"/>
						</div>
					</div>
                    <div class="clearfix">
						<label for="password">Password</label>
						<div class="input">
						<input class="xlarge" id="xlInput" name="password" size="30" type="text"/>
						</div>
					</div>
					<div class="clearfix">
						<label for="role">Role</label>
						<div class="input">
						<select name="role" class="span5" id="stackedSelect">
							<option>user</option>
							<option>admin</option>
						</select>
					</div>
					</div><!-- /clearfix -->
					<div class="custom-actions">
                        <input type="submit" class="btn success" value="'.$STRINGS['create:user'].'">
                    </div>
				</fieldset>
			</form>
		';
    }

}