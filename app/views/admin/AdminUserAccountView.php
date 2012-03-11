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
				<li><a href="' . $CONFIG->wwwroot . '/admin/report">Report</a></li>
            </ul>
            <ul class="nav pull-right no-hover-a">
				<p class="navbar-text pull-right"><a href="' . $CONFIG->wwwroot . '/auth/logout">Log Out</a></p>
            </ul>';

	}

	public function content(){

		global $CONFIG;

		return '
		<section id="user-account" class="well min-table">
            
            <ul class="nav nav-list well inline-menu">
                <li class="id-tab">
                    <i class="icon-user"></i>&nbsp;'.$this->_user->firstname.' '.$this->_user->lastname.'
                </li>
                <li>&nbsp;</li>

                <li>
                    <a href="'.$CONFIG->wwwroot.'/admin/user_details/'.$this->_user->id.'">
                        <i class="icon-edit"></i>&nbsp;Details</a>
                </li>
                <li >
                    <a href="'.$CONFIG->wwwroot.'/admin/user_activity/'.$this->_user->id.'">
                        <i class="icon-map-marker"></i>&nbsp;Activity</a></li>
                <li>
                    <a href="'.$CONFIG->wwwroot.'/admin/user_summary/'.$this->_user->id.'">
                        <i class="icon-list"></i>&nbsp;Summary</a></li>
                <li class="active">
                    <a href="'.$CONFIG->wwwroot.'/admin/user_account/'.$this->_user->id.'">
                        <i class="icon-cog"></i>&nbsp;Account</a></li>
            </ul>

			<form action="' . $CONFIG->wwwroot . '/admin/delete_user" method="post">
                <input type="submit" class="btn btn-danger" value="Delete Account">
                    <span class="help-inline">Warning! This action can not be undone!</span>
				<input type="hidden" name="userid" value="'.$this->_user->id.'">
			</form>
		</section>
		';

	}
}
