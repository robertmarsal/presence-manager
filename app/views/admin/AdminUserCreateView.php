<?php

class AdminUserCreateView extends View {

    public function __construct($alert = null) {
        parent::__construct($alert);
    }


    public function menu() {
  
        global $CONFIG;

        return '
        <ul class="nav">
            <li class="active"><a href="' . $CONFIG->wwwroot . '/admin/activity">Activity</a></li>
            <li><a href="' . $CONFIG->wwwroot . '/admin/users">Users</a></li>
			<li><a href="' . $CONFIG->wwwroot . '/admin/report">Report</a></li>
        </ul>
        <ul class="nav pull-right no-hover-a">
			<p class="navbar-text pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout">Log Out</a></p>
        </ul>';
    }

    public function content() {
    
        global $CONFIG, $STRINGS;

        return '
	    <section id="new-user">
            <form action="'.$CONFIG->wwwroot.'/admin/create_user" method="post">
                <label>First Name</label>
                <input type="text" name="firstname">

                <label>Last Name</label>
                <input type="text" name="lastname">

                <label>Email</label>
                <input type="text" name="email">

                <label>Password</label>
                <input type="text" name="password">
                
                <label>Role</label>
                <select name="role">
                    <option>user</option>
                    <option>admin</option>
                </select>
                
                <label></label>
                <button type="submit" class="btn">'.$STRINGS['create:user'].'</button>
            </form>
        </section>';
    }

}
